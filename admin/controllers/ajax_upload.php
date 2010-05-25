<?php
class Ajax_upload extends Controller {

	var $json_data=Array(
		'error' => 1,
		'html' => 'Ajax Error: Invalid Request'
	);

	function __construct() {
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth('web_admin');
		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);

		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}

	function _output($output) {
		echo json_encode($this->json_data);
	}

	function progress(){
		require_once(IPCFUNCS);
		$dl=new Downloader;

		$uuid=$this->input->post('uuid');
		$user=$this->session->userdata("user");
		$res=$dl->querybyUUID($user,$uuid);
		
		if( !is_null($res) && $res["info"]["type"] == "upload" ){
			$res["info"] = $res["info"]["name"];
		}
		if( is_null($res) ) {
			$this->json_data['html'] = t('Download not found');
			$this->json_data['user'] = $user;
			$this->json_data['uuid'] = $uuid;
		} else {
			$this->json_data['error'] = 0;
			$this->json_data['html']  = "";
			$this->json_data = array_merge( $this->json_data, $res );
		}
	}

}
