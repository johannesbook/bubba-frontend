<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


if (! function_exists('load_lang') ){
	function load_lang($langfile,$language){
		global $lang;
		if( !isset($lang) ){
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

?>
