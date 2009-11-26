<?php

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

if($this->session->userdata("language")){
	define("LANGUAGE",$this->session->userdata("language"));
}else{
	// Default
	define("LANGUAGE","default");
	//define("LANGUAGE","sv");
}
				
if($this->session->userdata("theme")){
	define("THEME",$this->session->userdata("theme"));
}else{
	// Default
	define("THEME","default");
}

if($this->session->userdata("user")){
	define("USER",$this->session->userdata("user"));
}else{
	// Default - should not be possible
	define("USER","none");
}


?>
