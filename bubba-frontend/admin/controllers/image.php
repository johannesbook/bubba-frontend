<?php
class Image extends Controller {
	function __construct() {
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);
	}
	function index() {
	}
	function thumb( $id ) {
			$this->load->helper('album');
		$this->output->set_header('Content-Type: image/jpg');
		$this->load->model("Album_model");
		$path = $this->Album_model->get_thumbnail( $id );
		if( cache_control( $path ) ) {
				$this->output->set_output(file_get_contents($path));
		}
	}
}
