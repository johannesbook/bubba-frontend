<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class browser_cap {
	private $bc;
	public function __construct() {
		$CI = &get_instance();
		$CI->load->config('browser_cap', true);

		require_once('Browscap_raw.php');
		$this->bc = new Browscap($CI->config->item('cache_path', 'browser_cap'));
		$this->bc->doAutoUpdate = $CI->config->item('auto_update', 'browser_cap'); // prevent autoupdates
		$this->bc->localFile = $CI->config->item('ini_file', 'browser_cap'); // the shipped ini file
	}
	public function updateCache() {
		return $this->bc->updateCache();
	}
	public function getBrowser(/*$user_agent = null, $return_array = false*/) {
		$args = func_get_args();
		return call_user_func_array(array($this->bc, 'getBrowser'), $args);
	}

}

