<?php

class NoSettingsException extends Exception {}
class NoScheduleException extends Exception {}

class Backup extends Model {
    public function __construct() {
        parent::Model();
        require_once(APPPATH."/legacy/defines.php");

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
        return array( "running" =>  $running );
    }

    public function get_jobs() {
        $dir = "/home/admin/.backup";
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
}
