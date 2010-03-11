<?php

class Auth_model extends Model{

	private $policies = array(
		"userdata" 		=> array(
			"list" 		=> array(
				"allow" => array("admin")
			),
			"add"  		=> array(
				"allow" => array("admin")
			),
			"delete"    => array( 
				"allow" => array("admin")
			),
			"edit_allusers" => array(
				"allow" => array("admin")
			),			
			"allow:enable_rename"    => array(
				"deny"  => array("admin")
			),
			"allow:enable_shell"     => array(
				"deny"  => array("admin")
			),
			"allow:disable_remote"     => array(
				"allow"  => array("admin")
			),
			
		),
		"menu"				=> array(
			"show_level1" => array(
				"allow" => array("admin")
			)
		),
		"mail"				=> array(
			"edit_allusers" => array(
				"allow" => array("admin")
			)
		)
	);
		
	function Auth_model(){
		parent::Model();
	 }
	
	function Auth($username, $password){
		require_once(APPPATH."/legacy/user_auth.php");
		
		return validate_user($username,$password);
	} 

	function Login($username, $password){
		if($this->Auth($username,$password)){
			$this->session->set_userdata('valid', true);
			$this->session->set_userdata('user', $username);
			return true;
		}else{
			/* Do nothing on a failed login */
			/*
			$this->session->set_userdata('valid', false);
			$this->session->unset_userdata('user');
			*/
			return false;
		}
	}

	function Logout(){
		$this->session->destroy();
	}	
	
	function CheckAuth(){
		return $this->session->userdata('valid');
	}	

	function RequireUser($user){
		
		if( $this->session->userdata('user') == $user ){
			return;
		}
		$this->session->set_userdata('caller', $this->uri->uri_string());
		$this->session->set_userdata('required_user', $user);
		redirect('login');
		exit();	
	}
	function DenyUser($user){
		
		if( $this->session->userdata('user') != $user ){
			return;
		}
		$this->session->set_userdata('caller', $this->uri->uri_string());
		redirect('login');
		exit();	
	}
	
	function EnforceAuth(){
		if($this->CheckAuth()){
			return;
		}
		$this->session->set_userdata('caller', $this->uri->uri_string());
		redirect('login');
		exit();
	}
	
	function policy($policy, $method, $user=null) {
		if( ! $user ) {
			$user = $this->session->userdata("user");
		}
		if(isset($this->policies[$policy][$method]["deny"])) {
			if(in_array($user,$this->policies[$policy][$method]["deny"])) {
				return false;
			}
		}
		if(isset($this->policies[$policy][$method]["allow"])) {
			if(!in_array($user,$this->policies[$policy][$method]["allow"])) {
				return false;
			}
		}
		return true;
	}
}
?>
