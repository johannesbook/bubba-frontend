<?php

class Help extends Controller{

	function help(){
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");

		load_lang("help",THEME.'/i18n/'.LANGUAGE);
	}
	
	function load($strip="",$uri="") {
		$a_manual_page = explode("_",$uri);
		if(sizeof($a_manual_page)>1) {
			$manual_page = $a_manual_page[1];
		} else {
			$manual_page = $a_manual_page[0];
		}
		if($this->session->userdata("user") != "admin") {
			$manual_page = "user_" . $manual_page;
		}
		if(t("help_".$manual_page) == "help_".$manual_page) { // no translation, send to first page in manual
			$manual_page = "";
		}
		if($strip == "html") {
			$footer  =" <div id='help-box-further-info'></div>";
			$footer .= "<div id='help-box-external-links'>";
			$footer .= "<div class='help-box-external-link'><a target='_blank' href='/manual/'>".t('help_box_manual_link')."</a> | ";
			$footer .= "<a target='_blank' href='http://forum.excito.net/index.php'>".t('help_box_forum_link')."</a> | ";
			$footer .= "<a target='_blank' href='http://www.excito.com'>".t('help_box_excito_link')."</a></div>";
			$footer .= "</div>";
			echo t("help_box_".$uri);
			echo $footer;			
		}
	}
	
	function index () {
	}
}
