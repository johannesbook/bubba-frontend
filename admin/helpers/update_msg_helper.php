<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function create_updatemsg($errors,$ok_string = "Update successful") {
		
		/*-----------------------
		  * First argument is an array with the key to be translated.
		  	- to be interpreted as an error it shall be true.
		  	- ie $errors["mail_add_err"] = true
		  * Second argument is the default "OK" string to be used.
		-------------------------*/
		
		if(is_array($errors) ){
			if( sizeof($errors)) {
				$update["success"]=false;
				$update["message"]="";
				foreach($errors as $err_name => $error) {
					$update["message"] .= " " . t($err_name);
				}
			} else {
				// clear all data
				$update["success"]=true;
				$update["message"]=t($ok_string);
			}
		} else {
			$update["success"]=false;
			$update["message"]="Unknown error message";
		}
		return $update;
	}	


?>