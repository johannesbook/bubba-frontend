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

            switch($target) {
            case "file":
                $target = "USB";
                break;
            case "FTP":
            case "SSH":
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

    function _output($output) {
        echo json_encode($this->json_data);
    }

}
