<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Firephp_load {
	function __construct() {
		$CI = &get_instance();
		$CI->load->config('fireignition');
		if ($CI->config->item('fireignition_enabled')) {
			$CI->load->library('firephp', '', 'firephp');
			$CI->firephp->registerErrorHandler();
			$CI->firephp->registerExceptionHandler();
			$CI->firephp->registerAssertionHandler();
		} else {
			$CI->load->library('firephp_fake', '', 'firephp');
		}
	}
}

