<?php

class System extends Model {
	public function __construct() {
		parent::Model();
	}

	public function set_timezone($timezone) {

		$target = "/usr/share/zoneinfo/$timezone";
		if(!file_exists($target)) {
			throw new Exception("Timezone $timezone doesn't exists");
		}
		unlink('/etc/localtime');
		symlink($target, '/etc/localtime');
		file_put_contents('/etc/timezone', $timezone);
	}

	public function get_timezone() {
		return trim(file_get_contents('/etc/timezone'));
	}

	# Lists all timezones with region, UTC has region false
	public function list_timezones() {
		$timezones = array();
		foreach(DateTimeZone::listIdentifiers() as $ts) {
			if(strpos($ts,'/')) {
				list($region, $country) = explode('/', $ts);
				$timezones[$country] = $region;
			} else {
				$timezones[$ts] = false;
			}
		}
		ksort($timezones);
		return $timezones;
	}
}
