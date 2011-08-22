<?php
$CI =& get_instance();
define("BACKEND","/usr/lib/web-admin/backend.pl");
define("BACKUP","/usr/lib/web-admin/backup.pl");
define("RESTORE_LOCKFILE","/var/lock/restore.lock");
define("BACKUP_LOCKFILE","/var/lock/backup.lock");

define("UPDATER","/usr/lib/web-admin/updater.pl");
define("PRINTFS","/usr/lib/web-admin/print.pl");
define("FIREWALL","/usr/lib/web-admin/firewall.pl");
define("DISK","/usr/lib/web-admin/disk.pl");
define("ADMINFUNCS","/usr/lib/web-admin/adminfunctions.php");
define("IPCFUNCS","/usr/share/ftd/ipc.php");
define("EASYFIND_CONF","/etc/network/easyfind.conf");
define("PWFILE","/etc/shadow");
define("UINFOFILE","/etc/passwd");
define("VERSION","BUBBA_VERSION");
define("FORMPREFIX","/admin");
define("FALLBACKIP","192.168.10.1");
define("BUBBA_VERSION","/etc/bubba.version");
define("USER_CONFIG",".bubbacfg");
define("ADMINCONFIG","/home/admin/".USER_CONFIG);

if(isB3()) {
	define("NAME","B3");
    define("EASYFIND", "myownb3.com");
    define("DEFAULT_HOST", "b3");
} else {
    define("EASYFIND", "bubbaserver.com");
	define("NAME","Bubba|2");
    define("DEFAULT_HOST", "bubba");
}

if($CI->session->userdata("language")){
	define("LANGUAGE",$CI->session->userdata("language"));
	define("CURRENT_LOCALE",$CI->session->userdata("locale"));
}else{
	if(file_exists(ADMINCONFIG)) {
		$conf = parse_ini_file(ADMINCONFIG);
		if(isset($conf['default_lang'])) {
			define("LANGUAGE",$conf['default_lang']);
		} else {
			// Default, make a guess?
			define("LANGUAGE","en");
        }
		if(isset($conf['default_locale'])) {
			define("CURRENT_LOCALE",$conf['default_locale']);
		} else {
			// Default, make a guess?
			define("CURRENT_LOCALE","en_US");
		}	

	} else {
		// Default, make a guess?
		define("LANGUAGE","en");
        define("CURRENT_LOCALE","en_US");
	}
}
				
if($CI->session->userdata("theme")){
	define("THEME",$CI->session->userdata("theme"));
}else{
	// Default
	define("THEME","default");
}

if($CI->session->userdata("user")){
	define("USER",$CI->session->userdata("user"));
}else{
	// Default - should not be possible
	define("USER","none");
}


?>
