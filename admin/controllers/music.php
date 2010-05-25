<?php

class Music extends Controller{

	function Music(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth('web_admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}
		
	function index($strip=""){
		if($strip == "") {
			$host = explode(":",$_SERVER["HTTP_HOST"]);
			$data["host"] = $host[0];
			if(sizeof($host) > 1) {
				$data["port"] = $host[1];	
			} else {
				$data["port"] = "";
			}	
			$this->load->view(THEME.'/music/music_view',$data);
		} else {
			echo "No data available";
		}
	}
}

?>