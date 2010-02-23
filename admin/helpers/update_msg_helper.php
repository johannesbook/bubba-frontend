<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function create_updatemsg( $errors, $ok_string = "Update successful" ) {
		
		/*-----------------------
		  * First argument is an array with the key to be translated.
		  	- to be interpreted as an error it shall be true.
		  	- ie $errors["mail_add_err"] = true
		  * Second argument is the default "OK" string to be used.
		-------------------------*/
		$update = array();

		if(is_array($errors) ){
			if( sizeof($errors)) {
				$update["success"]=false;
				$update["message"]="";
				$messages = array();
				foreach($errors as $error => $args) {
					if( !is_array( $args ) ) {
						if( $args === false ) {
							continue;
						}
						$args = array();
					}
					array_unshift( $args, $error );
					$messages[] = call_user_func_array( 't', $args );
				}
				$update["message"] = implode( ". ", $messages );
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
