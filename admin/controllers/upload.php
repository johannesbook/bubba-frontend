<?php

class Upload extends Controller{
	
	function Upload(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth('web_admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}		

	function index(){
		$data["path"]="/".join("/",array_slice($this->uri->segment_array(),2));
		$this->load->view(THEME.'/upload/upload_index_view',$data);
	}

}

?>
