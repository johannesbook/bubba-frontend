<?php
/******************************************************************************
* File that handles user verification                                         *
* Copyright 2005,2008, Excito HB                                                   *
* Three functions available:                                                   *
*    - get_userlist($pwfile)                                                  *
*        input a path to a file containing encrypted passwords (/etc/shadow)  *
*        returns a keyed list username <-> encrypted password                 *
*    - get_userinfo($infofile)                                                *
*        input a path to a file containing user information (/etc/passwd)     *
*        returns an array 'userinfo' with information of all 'real' users     *
*           userinfo[username]                                                *
*                        ->[uid]       users user id (numeric)                *
*                        ->[gid]       users group id (numeric)               *
*                        ->[realname]  users real name                        *
*                        ->[homedir]   path of users home directory           *
*                        ->[shell]     users login shell                      *
*    - validate_user($user,$user_pass,$pwfile)                                *
*        input username, entered password and path to encrypted password file  *
*        returns true if the user is valid in the system, otherwise false     *
******************************************************************************/
require_once(ADMINFUNCS);

function get_userlist() {

	$lines = dump_file(PWFILE);
	foreach($lines as $line) {
		// parsing passwordfile
		list($uid,$passwd,$rest) = explode(":",$line);
		if ($passwd != "!!" && $passwd !="*" && $passwd !="") {
			// add user and password to list.
			$userlist[$uid] = $passwd;
		}
	}
	return $userlist;
}

function get_userinfo() {

  $file = @fopen(UINFOFILE,"r") or 
  	die ("Failed opening passwd");
  	
	while (!feof($file)) {
		$buffer = fgets($file);
		if($buffer){
			// parsing passwordfile
			list($uname,$x,$uid,$gid,$realname,$homedir,$shell) = explode(":",$buffer);
			// add user and password to list.
			$userinfo[$uname]["uname"] = $uname;
			$userinfo[$uname]["uid"] = $uid;
			$userinfo[$uname]["gid"] = $gid;
			$userinfo[$uname]["realname"] = $realname;
			$userinfo[$uname]["homedir"] = $homedir;
			$userinfo[$uname]["shell"] = $shell;
		}
	}
	fclose($file);
	
	return $userinfo;
}

function validate_user($user,$user_pass) {

	if (!strcmp($user,'root')) {
		return false;
	} else {
		$userlist = get_userlist();
			
		if (isset($userlist[$user]) && ($userlist[$user] == crypt($user_pass,$userlist[$user]))) {
			return true;
		} else {
			return false;
		}
	}
}

?>
