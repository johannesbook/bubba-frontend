<?php

class Auth_model extends Model{

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
			$this->session->set_userdata('valid', false);
			$this->session->unset_userdata('user');
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
		redirect('');
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
}
?>
