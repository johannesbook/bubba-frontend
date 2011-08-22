<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."/legacy/defines.php");
/**
 * Gettext class
 */
class Gettext {
	private $core, $path, $domain;
	private static $languages = null;
	public function __construct() {
		$this->core =& get_instance();
		$this->domain = $this->core->config->item('textdomain');
		$this->path = $this->core->config->item('lang_path');
		setlocale(LC_MESSAGES, CURRENT_LOCALE);
		bindtextdomain($this->domain, $this->path);
		textdomain($this->domain);
		bind_textdomain_codeset($this->domain, 'UTF-8');
	}

	public function get_languages() {

		/* read all possible languages */
		if(is_null(self::$languages)) {
			self::$languages = parse_ini_file("{$this->path}/languages.ini", true);

            $default_lang = $this->get_default_lang();
			if( $default_lang && isset(self::$languages[$default_lang]) ) {
				self::$languages[$default_lang]['default'] = true;
			}

            self::$languages = array_filter(self::$languages, function($a){
                return isset($a['status'])
                    && ($a['status'] == 'official' || $a['status'] == 'user');
            });
			ksort(self::$languages,SORT_LOCALE_STRING);
		}

		return self::$languages;
	}

	private function get_default_lang() {
		$conf = parse_ini_file(ADMINCONFIG);
		if(isset($conf['default_lang'])) {
			return $conf['default_lang'];
		} else {
			return LANGUAGE;
		}
	}
}
