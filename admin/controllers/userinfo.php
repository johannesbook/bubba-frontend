<?php

class Userinfo extends Controller{
	
	function Userinfo(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth();

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}		

	function _renderfull($content){
		$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view','',true);
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
		$mdata["subnav"]="";
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function update($strip=""){
		$realname=$this->input->post("realname");
		$uname=$this->input->post("uname");
		
		$data["err_usrinvalid"]=false;
		$data["err_opfailed"]=false;		
		$data["success"]=false;
		if($uname!=USER){		
			$data["err_usrinvalid"]=true;
		}else if( !update_user($realname,"\"\"",$uname)){
			$data["success"]=true;
		}else{
			$data["err_opfailed"]=true;
		}

		if($strip){
			$this->load->view(THEME.'/userinfo/userinfo_update_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/userinfo/userinfo_update_view',$data,true));
		}
	}	

	function chpwd($strip=""){
		if(!$this->input->post("uname")){
			redirect("users");
			exit();
		}
		$data["uname"]=$this->input->post("uname");
	
		if($strip){
			$this->load->view(THEME.'/userinfo/userinfo_chpwd_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/userinfo/userinfo_chpwd_view',$data,true));
		}
	}

	function dochpwd($strip=""){
		$pass1 = $this->input->post("pass1");
		$pass2 = $this->input->post("pass2");
		$uname = $this->input->post("uname");
		
		$data["uname"]=$uname;
		$data["mismatch"]=false;
		$data["illegal"]=false;
		$data["success"]=false;
		$data["sambafail"]=false;
		$data["passwdfail"]=false;
		$data["err_usrinvalid"]=false;
		
		if (strcmp($pass1,$pass2)) {
			// Passwords dont match
			$data["mismatch"]=true;
		}elseif( !preg_match('/^\w+$/',$pass1)){
			// Password with illegal chars
			$data["illegal"]=true;		
		}else if($uname!=USER){
			$data["err_usrinvalid"]=true;		
		} else {
			if(set_unix_password($uname,$pass1)==0){
				if(set_samba_password($uname,$pass1,$pass2)==0){
					// Success
					$data["success"]=true;				
				}else{
					// Samba fail
					$data["sambafail"]=true;		
				}
			}else{
				// passwd fail
				$data["passwdfail"]=true;
			}
		}

		if($strip){
			$this->load->view(THEME.'/userinfo/userinfo_dochpwd_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/userinfo/userinfo_dochpwd_view',$data,true));
		}
	}

	function index($strip=""){

		require_once(APPPATH."/legacy/user_auth.php");
		$users=get_userinfo();
	
		$uinfo=$users[USER];
	
		$data["uname"]=USER;
		$data["realname"]=$uinfo["realname"];
		$data["shell"]=$uinfo["shell"];
	
		if($strip){
			$this->load->view(THEME.'/userinfo/userinfo_index_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/userinfo/userinfo_index_view',$data,true));
		}
	}


 }
 ?>
