<?php
class Ajax_backup extends Controller {

    var $json_data=Array(
        'error' => 1,
        'html' => 'Ajax Error: Invalid Request'
    );

    function __construct() {
        parent::Controller();
        $this->load->model("backup");
        require_once(APPPATH."/legacy/defines.php");
        require_once(ADMINFUNCS);

        $this->Auth_model->EnforceAuth('web_admin');
        $this->Auth_model->enforce_policy('web_admin','administer', 'admin');
        load_lang("bubba",THEME.'/i18n/'.LANGUAGE);

        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
        $this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    function get_backup_jobs() {
        $data = array();
        foreach( $this->backup->get_jobs() as $job ) {
            try {
                $settings = $this->backup->get_settings($job);

            } catch( NoSettingsException $e ) {
                # as we might have bad data, ignore the job for now
                continue;
            }
            try {
                $schedule = $this->backup->get_schedule($job);
            } catch( NoScheduleException $e ) {
                $schedule = array(
                    "type" => "disabled",
                );
            }
            $status = $this->backup->get_status($job);
            $date = "";
            switch($schedule["type"]) {
            case "hourly":
                $date = t("Hourly");
                break;
            case "daily":
                $date = t("Each day");
                break;
            case "weekly":
                $date = t("Once a week");
                break;
            case "monthly":
                $date = t("Every month");
                break;
            case "disabled":
                $date = t("Never");
                break;
            default:
                $date = t("Once in a while");
            }

            $target = $settings["target_protocol"];

            switch(strtolower($target)) {
            case "file":
                $target = "USB/eSATA";
                break;
            case "ftp":
                $target = 'FTP';
                break;
            case "ssh":
                $target = 'SSH';
                break;
            default:
                $target = "???";
            }
            $cur = array(
                "name" => $job,
                "target" => $target,
                "schedule" => $date,
                "status" => "N/A"
            );

            if( $status["running"] ) {
                $cur["running"] = true;
                $cur["status"] = t("Running");
            } else {
                if( $status["error"] ) {
                    $cur["status"] = t("Failed");
                    $cur["failed"] = true;
                } elseif($status["done"]) {
                    $cur["status"] = t("OK");
                } else {
                    $cur["status"] = t("Not run");
                }
            }
            unset($status);
            unset($schedule);
            unset($settings);
            $data[] = $cur;
        }
        $this->json_data = $data;
    }

    function get_backup_job_information() {
        $name = $this->input->post("name");
        $this->json_data = $this->backup->list_backups($name);
    }

    public function get_restore_data() {
        $this->load->helper('struct');

	    $subpath = $this->input->post('path');
        $name = $this->input->post('name');
        $date = $this->input->post('date');
        $orig = $subpath = preg_replace("#(^|\/)\.\.?(\/|$)#", '/', $subpath);
        $subpath = preg_replace("#/home/?#", '', $subpath);

        $data = array(
            'meta' => array(),
            'root' => $subpath != "" ? "/home/$subpath" : '/home',
            'aaData'  => array()
        );

		$map = array();

        foreach( $this->backup->get_restore_data_list($name, $date) as $entry ) {
			if( preg_match("#^".preg_quote($subpath, "#")."(?P<given>.*)#", $entry['path'], $m) && $m['given'] != '' ) {
				$map[$m['given']] = $entry['date'];
			}
        }

		foreach(explodeTree($map, '/', true) as $k => $v) {
			if(is_array($v)) {
				$date = $v['__base_val'];
				$type = 'dir';
			} else {
				$date = $v;
				$type = 'file';
			}
			$data['aaData'][] = array(
				$type,
				$k,
				date_create($date)->format("r")
			);

		}
        $this->json_data = $data;
    }

    function dirs() {
        function formatBytes($bytes, $precision = 2) {
            $units = array('B', 'KB', 'MB', 'GB', 'TB');

            $bytes = max($bytes, 0);
            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
            $pow = min($pow, count($units) - 1);

            $bytes /= (1 << (10 * $pow));

            return round($bytes, $precision) . ' ' . $units[$pow];
        }
	    $subpath = $this->input->post('path');
        $modified_subpath = preg_replace("#(^|\/)\.\.?(\/|$)#", '/', $subpath);
		$path = "/home/$modified_subpath";

        $data = array(
            'meta' => array(),
            'root' => $modified_subpath,
            'aaData'  => array()
        );
        if (file_exists($path) && is_dir($path) && is_readable($path)) {
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {
                    if( $file == '.'  || $file == '..' || !is_dir($path) ) {
                        continue;
                    }
                    $filename = $path . '/' . $file;
                    $data['aaData'][] = array(
                        filetype($filename),
                        $file,
                        date ("o-m-d H:i:s", filemtime($filename)),
                        formatBytes(filesize($filename))
                    );
                }
                closedir($dh);
            }
        } else {
            $data["meta"]["permission_denied"]=true;
        }
        $this->json_data = $data;

    }

    function get_available_devices() {

        $this->load->model("Disk_model");

        $disks = $this->Disk_model->list_disks();

        $usable_disks = array();

        foreach($disks as $disk) {
            if(preg_match("#/dev/sda#",$disk["dev"])) {
                continue;
            }
            if(isset($disk["partitions"]) && is_array($disk["partitions"])) {
                foreach($disk["partitions"] as $partition) {
                    if( !strcmp($partition["usage"],"mounted") || !strcmp($partition["usage"],"unused") && $partition["uuid"]) {
                        if($partition["label"]) {
                            $diskdata["label"] = $partition["label"];
                        } else {
                            if(preg_match("#dev/\w+(\d+)#",$disk["dev"],$partition_number)) {
                                $diskdata["label"] = "$disk[model]:$partition_number[1]";
                            } else {
                                $diskdata["label"] = "$disk[model]:1";
                            }
                        }
                        $diskdata["uuid"] = $partition["uuid"];
                        $usable_disks[$disk["model"]][]=$diskdata;
                    } else {

                    }
                }
            } else {
                if( !strcmp($disk["usage"],"mounted") || !strcmp($disk["usage"],"unused") && $disk["uuid"]) {
                    if($disk["label"]) {
                        $diskdata["label"] = $disk["label"];
                    } else {
                        if(preg_match("#dev/\w+(\d+)#",$disk["dev"],$partition_number)) {
                            $diskdata["label"] = "$disk[model]:$partition_number[1]";
                        } else {
                            $diskdata["label"] = "$disk[model]:1";
                        }
                    }
                    $diskdata["uuid"] = $disk["uuid"];
                    $usable_disks[$disk["model"]][]=$diskdata;
                }
            }
        }

        $this->json_data = array( "disks" => $usable_disks );
    }

    public function get_job_info() {
        $name = $this->input->post('name');
        if(!$name) {
            throw new Exception("Required parameter name not given");
        }

        $settings = $this->backup->get_settings($name);
        if( !array_key_exists('selection_type', $settings) || $settings['selection_type'] == 'custom' ) {
            $settings['selection_type'] = 'custom';
            $backupfiles = $this->backup->get_backupfiles($name);
            $settings['files'] = $backupfiles['include'];
        }

        $this->json_data = $settings;

    }

    public function remove() {
        $name = $this->input->post('name');
        if(!$name) {
            throw new Exception("Required parameter name not given");
        }
        $this->backup->remove($name);
        $this->json_data = array('error' => false);

    }

    public function run() {
        $name = $this->input->post('name');
        if(!$name) {
            throw new Exception("Required parameter name not given");
        }
        $this->backup->run($name);
        $this->json_data = array('error' => false);
    }

	public function restore() {
        $name = $this->input->post('name');
        $date = $this->input->post('date');
        $action = $this->input->post('action');
        $target = $this->input->post('target');
        if(!$name || !$date || !$action) {
            throw new Exception("Required parameter name not given");
		}
		if( $action == 'newdir' && !$target ) {
            throw new Exception("newdir action requires target");
		}

		$target = preg_replace('#(^|/)\.\./#', '/', $target);
		$this->backup->restore($name, $date, $action, $target);
	}

    public function edit() {

        $this->create(false);
    }

    public function create($create = true) {
        $name = $this->input->post("name");
        $selection = $this->input->post("selection");
        $protocol = $this->input->post("protocol");
        $schedule_type = $this->input->post("schedule-type");
        $security = $this->input->post("security");

        $target_hostname = $this->input->post("target-hostname");
        $target_username = $this->input->post("target-username");
        $target_password = $this->input->post("target-password");
        $target_device = $this->input->post("target-device");

        $schedule_dayhour = $this->input->post("schedule-dayhour");
        $schedule_weekhour = $this->input->post("schedule-weekhour");
        $schedule_monthhour = $this->input->post("schedule-monthhour");
        $schedule_weekday = $this->input->post("schedule-weekday");
        $schedule_monthday = $this->input->post("schedule-monthday");
        $schedule_timeline = $this->input->post("schedule-timeline");

        $security_password = $this->input->post("security-password");
        $security_password2 = $this->input->post("security-password2");

        $settings = array(
            'local_user' => 'admin'
        );

        /* Basic checks that all data is present and ok, content validation are client side */

        if( !$name || !$selection || !$protocol || !$schedule_type ) {
            throw new Exception("jobname, selection, protocol, or schedule not defined");
        }

        if( !in_array($protocol, array('ftp', 'ssh', 'file')) ) {
            throw new Exception("not valid protocol");
        }

        if( $protocol == 'ftp' || $protocol == 'ssh' ) {
            if( !$target_hostname || !$target_username || !$target_password ) {
                throw new Exception("ftp or ssh without host and/or username/password combo");
            }
        }

        if( $protocol == 'file' && !$target_device ) {
            throw new Exception("file protocol without target disk");
        }

        if( !in_array($selection, array('data', 'email', 'music', 'photo', 'video', 'storage', 'custom')) ) {
            throw new Exception("invalid schedule type");
        }

        if( $schedule_type == 'monthly' && (!$schedule_monthhour || ! $schedule_monthday) ) {
            throw new Exception("monthly schedule without day or hour");
        }

        if( $schedule_type == 'weekly' && (!$schedule_weekhour || ! $schedule_weekday) ) {
            throw new Exception("weekly schedule without day or hour");
        }

        if( $schedule_type == 'daily' && !$schedule_dayhour ) {
            throw new Exception("daily schedule without hour");
        }

        if( $schedule_type == 'disabled' && !$schedule_timeline ) {
            throw new Exception("missing timeline");
        }

        if( $security && (!$security_password || $security_password != $security_password2) ) {
            throw new Exception("choosen security setting without specifying password, or password missmatch");
        }

        if( $create ) {
        /* Backup job name */
            $this->backup->create_job($name);
        }

        $settings['jobname'] = $name;

        /* Backup protocol */

        $settings['target_protocol'] = $protocol;
        if( $protocol == 'file' ) {
            $settings['disk_uuid'] = $target_device;
        } else {
            $settings['target_host'] = $target_hostname;
            $settings['target_user'] = $target_username;
            $settings['target_FTPpasswd'] = $target_password;
        }

        /* Backup schedule */

        $settings['schedule_type'] = $schedule_type;
        $this->backup->set_schedule(
            $name,
            $schedule_type,
            $schedule_monthday,
            $schedule_monthhour,
            $schedule_weekday,
            $schedule_weekhour,
            $schedule_dayhour
        );
        $settings['schedule_monthday'] = $schedule_monthday;
        $settings['schedule_monthhour'] = $schedule_monthhour;
        $settings['schedule_weekday'] = $schedule_weekday;
        $settings['schedule_weekhour'] = $schedule_weekhour;
        $settings['schedule_dayhour'] = $schedule_dayhour;

        // XXX always only one fullbackup?
        $settings['nbr_fullbackups'] = 1;
        $settings['full_expiretime'] = $schedule_timeline;


        if( $security ) {
            $settings['GPG_key'] = $security_password;
        }

        $settings['selection_type'] = $selection;

        $this->load->helper('ini');
        write_ini_file("/home/admin/.backup/$name/jobdata", $settings);

        /* Backup file selection */
        $include = array();
        $exclude = array();
        switch( $selection ) {
        case 'data':
            $include[] = '/home/*';
            $exclude[] = '/home/admin';
            $exclude[] = '/home/storage';
            $exclude[] = '/home/web';
            break;
        case 'email':
            $include[] = '/home/*/Mail';
            break;
        case 'music':
            $include[] = '/home/storage/music';
            break;
        case 'photo':
            $include[] = '/home/storage/photo';
            break;
        case 'video':
            $include[] = '/home/storage/video';
            break;
        case 'storage':
            $include[] = '/home/storage';
            break;
        case 'custom':
            $include = $this->input->post('dirs');
            break;
        default:
            $this->err("Wrong selection type: $selection");
            return;
        }

        $this->backup->set_backup_files($name, $include, $exclude);

    }

    public function validate() {
        if($name = $this->input->post('name')) {
            if( in_array( $name, $this->backup->get_jobs() ) ) {
                $this->json_data = false;
            } else {
                $this->json_data = true;
            }
        }
    }

    function err($what) {
        $this->json_data['html'] = $what;
    }
    function _output($output) {
        echo json_encode($this->json_data);
    }

}
