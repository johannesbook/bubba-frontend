<?php
class Ajax_notify extends Controller {

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
	}

	function _output($output) {
		echo json_encode($this->json_data);
	}

	function ack() {
		$uuid = $this->input->post('uuid');
		if( $uuid ) {
			$this->load->model('notify');
			if( $this->notify->allowed_to_ack( $uuid, $this->session->userdata('user') ) ) {
				$this->notify->ack( $uuid );
			}
			$this->json_data['error'] = 0;
			$this->json_data['html'] = "";
		}
	}
}
