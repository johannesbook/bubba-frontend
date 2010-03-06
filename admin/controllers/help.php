<?php

class Help extends Controller{

	function help(){
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");

		load_lang("help",THEME.'/i18n/'.LANGUAGE);
	}
	
	function load($strip="",$uri="") {
		$section = strtr($uri,"/","_");
		$a_manual_page = split("/",$uri);
		if(sizeof($a_manual_page)>1) {
			$manual_page = $a_manual_page[1];
		} else {
			$manual_page = $a_manual_page[0];
		}
		if($strip == "html") {
			$footer  = "<div id='help-box-external-links'>";
			$footer .= "<div class='help-box-external-link'><a target='_blank' href='/manual'>".t('help_box_manual_link')."</a></div>";
			$footer .= "<div class='help-box-external-link'><a target='_blank' href='http://forum.excito.net/index.php'>".t('help_box_forum_link')."</a></div>";
			$footer .= "<div class='help-box-external-link'><a target='_blank' href='http://www.excito.com'>".t('help_box_excito_link')."</a></div>";
			$footer .= "</div>";
			echo t("help_box_".$section);
			echo $footer;			
		}
	}
	
	function index () {
	}
}
