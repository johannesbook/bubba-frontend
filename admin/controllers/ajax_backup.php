<?php
class Ajax_backup extends Controller {

    var $json_data=Array(
        'error' => 1,
        'html' => 'Ajax Error: Invalid Request'
    );

    function __construct() {
        parent::Controller();
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
        $this->json_data =
            array(
                array(
                    "name" => "My Music", 
                    "target" => "FTP", 
                    "schedule" => "Daily", 
                    "status" => "OK"  
                ),
                array( 
                    "name" => "My email",
                    "target" => "USB",
                    "schedule" => "Hourly",
                    "status" => "Failed",
                    "failed" => true  
                ),
                array(
                    "name" => "Testing",
                    "target" => "USB",
                    "schedule" => "Every monday",
                    "status" => "Not run"
                ),
                array(
                    "name" => "Carl's stuff",
                    "target" => "SSH",
                    "schedule" => "Every century",
                    "status" => "Running", 
                    "running" => true  
                ),
            );
    }

    function get_backup_job_information() {
        $name = $this->input->post("name");
        $this->json_data = array(
            array(
                "date" => "Mon, 18 Apr 2011 12:16:42 +0200",
                "type" => "Full",
                "status" => "OK"
            ),
            array(
                "date" => "Sun, 17 Apr 2011 12:13:32 +0200",
                "type" => "Incremental",
                "status" => "OK"
            ),
            array(
                "date" => "Sat, 16 Apr 2011 12:21:13 +0200",
                "type" => "Incremental",
                "status" => "Failed [Why?]",
                "failed" => true  
            ),
            array(
                "date" => "Fri, 15 Apr 2011 12:32:01 +0200",
                "type" => "Full",
                "status" => "OK"
            ),
        );
    }

    function _output($output) {
        echo json_encode($this->json_data);
    }

}
