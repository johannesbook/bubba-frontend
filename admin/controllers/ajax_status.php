<?php
class Ajax_status extends Controller {

    var $json_data=Array(
        'error' => 1,
        'html' => 'Ajax Error: Invalid Request'
    );

    function __construct() {
        parent::Controller();
        require_once(APPPATH."/legacy/defines.php");
        require_once(ADMINFUNCS);
        $this->Auth_model->EnforceAuth('web_admin');

		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
    )}
    function printers() {
        $json =  _system('cups-list-printers');
        $this->json_data = json_decode(implode($json),true);
    }

    function disks() {
        $this->load->model('disk_model');
        $disks =  $this->disk_model->list_disks();
        foreach( $disks as &$disk ) {
            $disk['hdtemp'] = get_hdtemp($disk['dev']);
            foreach( $disk['partitions'] as &$partition ) {
                if(isset($partition['mountpath'] && $partition['mountpath'] != "") {
                    $partition['free_space'] = disk_free_space($partition['mountpath'])
                }
            }
            unset($partition);
        }

        unset($disk);

        $this->json_data = $disks;
    }

    function vgs() {
        $this->load->model('disk_model');
        $this->json_data = $this->disk_model->list_vgs();
    }

    function mds() {
        $this->load->model('disk_model');
        $this->json_data = $this->disk_model->list_mds();
    }

    function fstab() {
        $this->load->model('disk_model');
        $this->json_data = $this->disk_model->list_fstab();
    }

    function _output($output) {
        echo json_encode($this->json_data);
    }

}
