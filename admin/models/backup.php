<?php

class NoSettingsException extends Exception {}
class NoScheduleException extends Exception {}
class DuplicityExecutionException extends Exception {}
class DuplicateJobException extends Exception {}
class IllegalJobNameException extends Exception {}
class BackupPLException extends Exception {}

class Backup extends Model {
	private $diskmanager = "/usr/sbin/diskmanager";

    public function list_backups($job) {
        // change this to read a history file with status of each job and time
        $path = "/home/admin/.backup/$job/fileinfo/*.info";
        $files = glob($path);
        $ret = array();
        foreach($files as $file) {
            unset($matches);
            if(preg_match("/(?P<date>\d{4}-\d{2}-\d{2})-(?P<time>\d{2}:\d{2}:\d{2})\.(?P<error>[err]*)?.*/",$file,$matches)) {
                $date = date_create("$matches[date] $matches[time]")->format('r');
                if(!$matches['error']) {
                    $ret[] = array(
                        'date' => $date,
                        'file' => $file
                    );
                }
            }
        }
        return $ret;
    }

    public function __construct() {
        parent::Model();
        require_once(APPPATH."/legacy/defines.php");
        $this->load->model("disk_model");
    }


    public function old_list_backups($job) {
        $settings = $this->get_settings($job);

        $data = $this->_run_duplicity($job, 'collection-status', '--num-retries', 2);
        $collection_status = $this->_grep_duplicity_log($data, 'INFO', 3);
        if( count( $collection_status ) ) {
            $collection_status = $collection_status[0];
            preg_match_all("#^ (?P<type>inc|full) (?P<datetime>\\S+) (?P<count>\d+)#m", $collection_status, $m, PREG_SET_ORDER );
            $m = array_map(function($a){
                return array(
                    'date' => date_create($a['datetime'])->format("r"),
                    'type' => $a['type']
                );

            }, $m);

            return $m;
        } else {
            return array();
        }
    }

    private function _run_duplicity(/* $job, $args */) {
        $args = func_get_args();
        $job = array_shift($args);
        $duplicity_opts = $this->_generate_duplicity_options($job);
        $target_opts = $this->_target_opts($job);

        $shell_cmd = escapeshellargs(
            array_merge(
                array('duplicity', '--log-fd', 3),
                $duplicity_opts['cmd'],
                $args,
                array($target_opts['target'])
            )
        );
        $descriptors = array(
            3 => array("pipe", "w")
        );
        $data = '';
        $proc = proc_open($shell_cmd, $descriptors, $pipes, "/", $duplicity_opts['env'] );
        if( is_resource($proc) ) {
            $data = stream_get_contents($pipes[3]);
            fclose($pipes[3]);
            $retval = proc_close($proc);
            if( $retval != 0 ) {
                #throw new DuplicityExecutionException("Process exited with non-zero return value");
            }
        } else {
            throw new DuplicityExecutionException("Failed to open process");
        }

        if( $target_opts['mounted'] ) {
            $this->disk_model->userumount( $target_opts['mountpath'] );
            @rmdir( $target_opts['mount'] );
        }
        return $this->_parse_duplicity_log($data);
    }

    private function _target_opts($job) {

        $settings = $this->get_settings($job);
        $tmpdir = '';
        if( $settings['target_protocol'] == 'file' ) {

            $tmpdir = "/mnt/bubba-backup/admin/$job";
            if(! file_exists($tmpdir) ) {
                @mkdir($tmpdir, 0777, true);
            }

            $this->disk_model->usermount( $settings['disk_uuid'], $tmpdir );
            $settings['target_path'] = $tmpdir . ($settings['target_path'] != '' ? '/'.$settings['target_path'] : '' );
        }
        $target = $settings['target_protocol'] . '://';

        if( isset($settings['target_user']) && $settings['target_user'] != '' ) {
            $target .= $settings['target_user'] . '@';
        }

        if( isset($settings['target_host']) && $settings['target_host'] != '' ) {
            $target .= $settings['target_host'];
        }

        if( isset($settings['target_path']) && $settings['target_path'] != '' ) {
            $target .= ($settings['target_protocol'] == 'file' ? '' : '/') . $settings['target_path'];
        }

        $target .= '/' . $settings['jobname'];

        return array(
            'mounted' => $settings['target_protocol'] == 'file',
            'mountpath' => $tmpdir,
            'target' => $target
        );

    }
    private function _generate_duplicity_options($job) {
        $settings = $this->get_settings($job);
        $ret = array(
            'env' => array(),
            'cmd' => array(),
            'target' => ''
        );
        if(isset($settings["GPG_key"])) {
            $ret['env']['PASSPHRASE'] = $settings["GPG_key"];
        } else {
            $ret['cmd'][] = '--no-encryption';
        }

        if(
            $settings["target_protocol"] == 'scp' ||
            $settings["target_protocol"] == 'FTP'
        ){
            if(isset($settings["target_keypath"])) {
                $ret['cmd'][] = '--ssh-options';
                $ret['cmd'][] = "-oIdentityFile='$settings[target_keypath]'";
            } else {
                $ret['env']['FTP_PASSWORD'] = $settings['target_FTPpasswd'];
                if( $settings['target_protocol'] == 'ssh' ) {
                    $ret['cmd'][] = '--ssh-askpass';
                    $ret['cmd'][] = '--ssh-options';
                    $ret['cmd'][] = "-oStrictHostKeyChecking='no' -oConnectTimeout='5'";
                }
            }
        }

        if( isset($settings['full_expiretime']) ) {
            $ret['cmd'][] = "--full-if-older-than";
            $ret['cmd'][] = $settings['full_expiretime'];
        }

        $ret['env']['TMPDIR'] = "/home/admin/.tmp";

        return $ret;
    }

    private function _tempdir() {
        $tempfile=tempnam('','bkup');
        if (file_exists($tempfile)) {
            unlink($tempfile);
        }
        mkdir($tempfile);
        if (is_dir($tempfile)) {
            return $tempfile;
        }
    }

    private function _grep_duplicity_log($data, $keyword, $level) {
        $data = array_filter($data, function($a) use ($keyword, $level){
            return $a["keyword"] == $keyword && $a["level"] == $level;
        });
        return array_map(function($a){return $a["data"];}, array_values($data));
    }

    private function _parse_duplicity_log($data) {
        preg_match_all("#^(?P<keyword>\\w+) (?P<level>\\d+)(?P<data>.*?)\\n\\n#ms", $data, $m, PREG_SET_ORDER );
        $m = array_map(function($a){
            return array(
                'data' => trim(preg_replace('#^\\..*(?:\\n|$)#m', '', $a["data"])),
                'keyword' => $a['keyword'],
                'level' => $a["level"]
            );

        }, $m);

        return $m;
    }

    private function _get_running_job() {

        if( file_exists( BACKUP_LOCKFILE ) ) {
            $data = file_get_contents( BACKUP_LOCKFILE );
            list($user, $jobname,) = explode( " ", $data );
            return array(
                "running" => true,
                "user" => $user,
                "jobname" => $jobname
            );
        } else {
            return array( "running" => false );
        }
    }

    public function get_status($job) {

        $running = $this->_get_running_job();
        $running = $running["running"] && $running["jobname"] == $job;

        $ret = array(
            "running" => $running,
            "error" => false,
            "done" => false
        );
        if(!$running) {
            $logs = glob("/var/log/backup/admin/$job/*.log");

            if( count($logs) ) {
                $ret["done"] = true;
                usort( $logs, function($a, $b) {
                    preg_match('#(?P<date>\\d{4}-\\d{2}-\\d{2})-(?P<time>\\d{2}:\\d{2}:\\d{2})\.log#', $a, $da);
                    preg_match('#(?P<date>\\d{4}-\\d{2}-\\d{2})-(?P<time>\\d{2}:\\d{2}:\\d{2})\.log#', $b, $db);

                    $da = new DateTime("$da[date] $da[time]");
                    $db = new DateTime("$db[date] $db[time]");

                    if( $da == $db ) {
                        return 0;
                    }

                    return $da < $db ? -1 : 1 ;
                });

                $latest_log = end($logs);
                unset($logs);
                $data = file_get_contents($latest_log);
                $error = preg_match("#^ERROR#m", $data);
                $ret["error"] = $error;
            }
        }
        return $ret;
    }

    public function get_jobs() {
        $dir = "/home/admin/.backup";
        $jobs = array();
        foreach( scandir($dir) as $file ) {
            if( !is_dir( "$dir/$file" ) || $file == "." || $file == ".." ) {
                continue;
            }
            $jobs[] = $file;
        }
        return $jobs;
    }

    public function get_settings($job) {
        $dir = "/home/admin/.backup";
        $jobdata = "$dir/$job/jobdata";
        if( file_exists($jobdata) ) {
            return parse_ini_file($jobdata);
        } else {
            throw new NoSettingsException("jobdata for job $job doesn't exists");
        }
    }

    public function get_all_settings() {
        $dir = "/home/admin/.backup";
        $settings = array();
        foreach( $this->get_jobs() as $job ) {
            try {
                $settings[$job] = $this->get_settings($job);
            } catch( Exception $e ) {
                # XXX do nothing?
            }
        }
        return $settings;
    }

    public function get_restore_data_list($job, $date) {

        $date = new DateTime($date);
        $dupdate = $date->format("Y-m-d-H:i:s");
        $file = "/home/admin/.backup/$job/fileinfo/$dupdate.info";


        if(file_exists($file)) {
            $fh = fopen($file,'r');
            if(filesize($file)) {
                $data = fread($fh,filesize($file));
            }
            fclose($fh);
        }
        if(isset($data)) {
            $filelist = array();
            if(preg_match_all("/\sadmin\/(?!\.backup).*/",$data,$foo)) {
                // then there is more than ".backup" in the users folder, then show all
                $noshow_userfiles = "";
            } else {
                $noshow_userfiles = "|^admin";
            }
            $pattern = "/\.\$$noshow_userfiles/";  // show ".backup" folder if the folder is included.
            $a_data = explode("\n",$data);
            foreach($a_data as $line) {
                preg_match("#(?P<date> \w{3} \s \w{3} \s{1,2} \d{1,2} \s \d{2}:\d{2}:\d{2} \s \d{4}) \s (?P<path>.*)#x",$line,$m);
                if($m && ! preg_match($pattern, $m['path'])) {
                    array_push( $filelist, array(
                        'date' => $m['date'],
                        'path' => $m['path']
                    ));
                }
            }
            return $filelist;
        } else {
            return array();
        }

    }

    public function get_schedule($job) {
        $schedules = $this->get_all_schedules(); # TODO cache
        if(array_key_exists($job, $schedules)) {
            return $schedules[$job];
        } else {
            throw new NoScheduleException("No schedule found for job $job");
        }
    }

    public function get_all_schedules() {
        $jobs = trim(file_get_contents("/etc/cron.d/bubba-backup"));

        $schedules = array();

        if($jobs) {
            foreach(explode("\n", $jobs) as $job) {
                $schedule = array(
                    'type' => 'unknown'
                );
                list(
                    $minute,
                    $hour,
                    $day_of_month,
                    $month,
                    $day_of_week,
                    /* $run_as */,
                    /* script_name */,
                    /* $command */,
                    /* $user */,
                    $job_name
                ) = preg_split("#\\s+#", $job);

                if( $minute == 0 ) {
                    $schedule["type"] = "hourly";
                    $schedule["hourly"] = 1;
                    if( preg_match("#^\\*\\/(\\d+)$#", $hour, $time) ) {
                        $schedule["hourly"] = $time[1];
                    }
                    if( preg_match("#^\\d+$#", $hour) ) {
                        $schedule["time_of_day"] = $hour;
                        if( preg_match("#^[\\w\\,]+$#", $day_of_week) ) {
                            $schedule["type"] = "weekly";
                            $schedule["days"] = explode(",", $day_of_week);
                            if(count($schedule["days"]) == 7) {
                                unset($schedule["days"]);
                                $schedule["type"] = "daily";
                            }
                        } elseif( preg_match("#^\\d+$#", $day_of_month) ) {
                            $schedule["type"] = "monthly";
                            $schedule["day_of_month"] = $day_of_month;
                        }
                    }
                }

                $schedules[$job_name] = $schedule;
            }

            return $schedules;
        }
    }

    public function create_job($jobname) {

        $jobs = $this->get_jobs('admin');
        foreach ($jobs as $existingjob) {
            if($jobname == $existingjob) {
                throw new DuplicityExecutionException();
            }
        }

        if(preg_match("/[^\w-]/",$jobname)) {
            throw new IllegalJobNameException();
        }

        $output = _system(BACKUP, "createjob", 'admin', $jobname);
        if(preg_match("/Error/i",implode("\n",(array)$output)) ){
            throw new BackupPLException($output);
        }
    }

    public function set_backup_files($job, $includes, $excludes) {
        $inc = is_array($includes) ? implode("\n", array_map(function($a){return "+ $a";}, $includes)) : '';
        $exc = is_array($excludes) ? implode("\n", array_map(function($a){return "- $a";}, $excludes)) : '';
        file_put_contents("/home/admin/.backup/$job/includeglob.list", $inc);
        file_put_contents("/home/admin/.backup/$job/excludeglob.list", $exc);
    }
    public function set_schedule($jobname, $type, $monthday, $monthhour, $weekday, $weekhour, $dayhour) {
        $schedule = array( 0, '*', '*', '*', '*' );

        switch( $type ) {
        case 'monthly':
            $schedule[2] = $monthday;
            $schedule[1] = $monthhour;
            break;
        case 'weekly':
            $conv = array(
                'monday' => 1,
                'mon' => 1,
                'tuesday' => 2,
                'tue' => 2,
                'wednesday' => 3,
                'wed' => 3,
                'thursday' => 4,
                'thu' => 4,
                'friday' => 5,
                'fri' => 5,
                'saturday' => 6,
                'sat' => 6,
                'sunday' => 7,
                'sun' => 7,
                'weekdays' => '1-5',
                'weekend' => '6-7'
            );
            if( array_key_exists( strtolower($weekday), $conv ) ) {
                $schedule[4] = $conv[strtolower($weekday)];
            } else {
                $schedule[4] = $weekday;
            }
            $schedule[1] = $weekhour;
            break;
        case 'daily':
            $schedule[1] = $dayhour;
            break;
        }

        $output = _system(BACKUP, "writeschedule", 'admin', $jobname, implode(' ', $schedule));
        if(preg_match("/Error/i",implode("\n",(array)$output)) ){
            throw new BackupPLException($output);
        }

    }
    private function _read_backupfiles($file) {

        if(file_exists($file)) {
            $fh = fopen($file,'r');
            if(filesize($file)) {
                $data = fread($fh,filesize($file));
            }
            fclose($fh);
            if(isset($data)) {
                $data = rtrim($data);
                $a_data = explode("\n",$data);
                return array_map(create_function('$str','return substr($str,2);'),$a_data);
            } else {
                return array();
            }
        } else return array();
    }

    public function get_backupfiles($jobname) {
        $files = array();

        $files["include"] = $this->_read_backupfiles("/home/admin/.backup/".$jobname."/includeglob.list");
        $files["exclude"] = $this->_read_backupfiles("/home/admin/.backup/".$jobname."/excludeglob.list");
        return $files;
    }

    public function remove($jobname) {
        $output = _system(BACKUP, "deletejob", 'admin', $jobname);
        if(preg_match("/Error/i",implode("\n",(array)$output)) ){
            throw new BackupPLException($output);
        }
    }

    public function run($jobname) {
        $cmd = array(BACKUP, "backup", 'admin', $jobname);

        $proc = proc_open(escapeshellargs($cmd)." &", array(), $pipes, '/');
        if( !is_resource($proc) ) {
            throw new Exception(sprintf("Failed to execute command `%s`", escapeshellargs($cmd)));
        }
        // we just wont close this process...
    }

    public function restore($jobname, $date, $action, $target, $selection) {

		date_default_timezone_set(get_current_tz());
		if($date) {
			$date = date("c",strtotime($date));
		}

		if( $action == 'overwrite' ) {
			$force = 'overwrite';
		} elseif( $action == 'newdir' ) {
			$force = $target;
		} else {
			throw new Exception("action $action not valid");
		}

		$cmd = array(BACKUP, "restorefiles", 'admin', $jobname, $force, $date, $selection);

		$proc = proc_open(escapeshellargs($cmd)." &", array(), $pipes, '/');
		if( !is_resource($proc) || true ) {
			throw new Exception(sprintf("Failed to execute command `%s`", escapeshellargs($cmd)));
		}
		// we just wont close this process...
    }


}
