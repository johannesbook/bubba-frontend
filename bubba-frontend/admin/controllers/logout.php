<?php

class Logout extends Controller{

	function Logout(){
		parent::Controller();
	}
	
	function index(){
		$this->Auth_model->Logout();
		$this->session->unset_userdata("caller");
		redirect("login");
	}

}
?>
