<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


if (! function_exists('load_lang') ){
	function load_lang($langfile,$language){
		global $lang;
		if( !isset($lang) ){
            if( $language != THEME.'/i18n/en' ) {
                /* Include the english language file for base filling of untranslated strings*/
				include(APPPATH.'views/'.THEME.'/i18n/en'.$langfile."_lang.php");
            }
			if(file_exists(APPPATH.'views/'.$language.'/'.$langfile."_lang.php")){
				include(APPPATH.'views/'.$language.'/'.$langfile."_lang.php");
			}
		}
	}
}

if (! function_exists('t'))
{
	function t($string){
		global $lang;
		if( isset($lang[$string]) ){
			$string = $lang[$string];
		}else{
//			$CI = &get_instance();
//			$CI->firephp->warn($string, "not defined in \$lang" );
			$string = $string;
		}
		$nbr_args = func_num_args();
		if( $nbr_args > 1 ) {
			$args = func_get_args();
			array_shift($args);
			$string = vsprintf( $string, $args );
		}

		return $string;
	}
}

function get_languages() {

	$i18n_dir = APPPATH.'views/'.THEME.'/i18n/*/description.ini';
	$langs = glob($i18n_dir);
	foreach($langs as $lang) {
		//$lang_desc = $i18n_dir."/".$lang."/description.ini";
		// print $lang_desc;
		$desc = parse_ini_file($lang);
		if(isset($desc['short_name'])) {
			if(isset($desc['status']) && ( $desc['status'] == 'official' || $desc['status'] == 'user') ) {
				$available_langs[$desc['short_name']] = $desc;
			}
		}
	}
	
	if( $default_lang = _get_default_lang() ) {
		$available_langs[$default_lang]['default'] = true; 
	}
	
	ksort($available_langs);
	return $available_langs;
}

function _get_default_lang() {
	$conf = parse_ini_file(ADMINCONFIG);
	if(isset($conf['default_lang'])) {
		return $conf['default_lang'];
	} else {
		return LANGUAGE;
	}
}


?>
