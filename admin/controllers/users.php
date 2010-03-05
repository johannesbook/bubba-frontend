<?php

class Users extends Controller{

	function Users(){
		parent::Controller();
		
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);
		$this->Auth_model->EnforceAuth();

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content){
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$navdata["show_level1"] = $this->Auth_model->policy("menu","show_level1");
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		$mdata["head"] = "";
		if($this->session->userdata('run_wizard')) {
			$mdata["dialog_menu"] = "";
			$mdata["content"]="";
			$mdata["wizard"]=$content;
		} else {
			$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view','',true);
			$mdata["content"]=$content;
			$mdata["wizard"]="";
		}
		$this->load->view(THEME.'/main_view',$mdata);
	}
	
	function _get_uinfo() {

		$userinfo=get_userinfo();
		$allow_list_users = $this->Auth_model->policy("userdata","list");
		foreach($userinfo as $uname => $value){
			if ( $allow_list_users || ($this->session->userdata("user")==$uname) ) {

				if($value["uid"]<1000 || $value["uid"]>60000){
					unset($userinfo[$uname]);
					continue;
				}
				if($uname=="admin"){
					$userinfo[$uname]["shell"]="";
				}
				
				if(trim($value["shell"])=="/bin/bash"){
					$userinfo[$uname]["shell"]=true;;
				}else{
					$userinfo[$uname]["shell"]=false;
				}
			} else {
				unset($userinfo[$uname]);
			}
		}
		return $userinfo;
				
	}	

	function add($strip=""){
		// if $strip == -1 $data will be returned and no view loaded.
		
		require_once(APPPATH."/legacy/user_auth.php");

		$uname=$this->input->post("uname");
		$realname=$this->input->post("realname");
		$shell=$this->input->post("shell");
		$pass1=$this->input->post("pass1");
		$pass2=$this->input->post("pass2");

		$lc_uname=strtolower($uname);
	
		$uinfo=get_userinfo();
		
		$data["uname"]=$uname;
		$data["realname"]=$realname;
		$data["shell"]=$shell;

		$data["update"]=array();
		$data['update']['success'] = false;

		$data["usr_caseerr"]=false;
		$data["usr_existerr"]=false;
		$data["usr_nonameerr"]=false;
		$data["usr_spacerr"]=false;
		$data["pwd_charerr"]=false;
		$data["usr_charerr"]=false;
		$data["usr_longerr"]=false;
		$data["pwd_mismatcherr"]=false;
		
		if ($lc_uname != $uname) {	
			// Uppercase letters in username
			$data['update']['message'] = "usr_caseerr";
		}elseif (isset($uinfo[$uname])||$uname=="root"||$uname=="storage"||$uname=="web") {
			// user already exists or is admin account
			$data['update']['message'] = "usr_existerr";
		}elseif ($uname == "") {
			// No username given
			$data['update']['message'] = "usr_nonameerr";
		}elseif (count(explode(" ",$uname))!=1) {
			// Username contains spaces
			$data['update']['message'] = "usr_spacerr";
		}elseif (!preg_match('/^\w+$/',$pass1)){
			// Illegal chars in passwd
			$data['update']['message'] = "pwd_charerr";
		}elseif (!preg_match('/^[a-z0-9 _-]+$/',$uname)){
			// Illegal chars in username
			$data['update']['message'] = "usr_charerr";
		}elseif ( strlen($uname)>32){
			// Username to long
			$data['update']['message'] = "usr_longerr";
		}elseif ($uname[0]=='-'){
			// Illegal chars in username cant start with -
			$data['update']['message'] = "usr_charerr";
		}else{
			// data valid
			if ((trim($pass1) == trim($pass2)) && (trim($pass1)!="" ||trim($pass2)!="")) {
				$group="users";
				if(add_user($realname,$group,$shell,$pass1,$uname)){
					$data['update']['message'] = "usr_createerr";
				}else{
					$data['update']["success"]=true;
					$data['update']['message'] = "usr_addok";
				}
			}else{
				// Passwords dont match or passwd empty
				$data['update']['message'] = "pwd_mismatcherr";
			}
		}
		

		if(!$data["update"]["success"]) {

			// enter the input data again
			$data["shellyes"]=false;
			$data["shellno"]=true;
			$data["uname"]=$this->input->post("uname")?$this->input->post("uname"):"";
			$data["realname"]=$this->input->post("realname")?$this->input->post("realname"):"";
			if($this->input->post("shell")){
				if($this->input->post("shell")=="/bin/bash"){
					$data["shellyes"]=true;
					$data["shellno"]=false;
				}
			}
		}

		$this->index(false, $data);
	}	

	function askdelete($strip=""){
		$data["uname"]=$this->input->post("uname");
		
		if($strip){
			$this->load->view(THEME.'/users/user_askdelete_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/users/user_askdelete_view',$data,true));
		}
	}

	function dodelete($strip=""){
		$this->Auth_model->RequireUser('admin');
		if(!$this->input->post("proceed") || !$this->input->post("uname")){
			redirect("users");
			exit();
		}
		$uname=$this->input->post("uname");
		$userdata=$this->input->post("userdata");
		
		// TODO: fix this to only allow users with uid>999 to be deleted
		if($uname=="root" || $uname=="admin"){		
			print"User [$uname] is root or admin<br/>";			
			//redirect("users");
			exit();
		}
		$data["deluserdata"]=$userdata;
		$data["delusersuccess"]=false;
		$data["deldatasuccess"]=false;
		$data["uname"]=$uname;
		if(del_user($uname)==0){
			$data["delusersuccess"]=true;
			if($userdata){
				if(rm("/home/$uname","root")==0){
					$data["deldatasuccess"]=true;
				}else{
					$data["deldatasuccess"]=false;
				}

				try {
					purge_horde( $uname );
					$data["deldatasuccess"] |= true;
				} catch( AdminException $e ) {
					$data["deldatasuccess"] = false;
				}
			}
		}else{
			$data["delusersuccess"]=false;
		}

		if($strip){
			$this->load->view(THEME.'/users/user_dodelete_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/users/user_dodelete_view',$data,true));
		}
	}	
	
	function chpwd($strip=""){
		if(!$this->input->post("uname")){
			redirect("users");
			exit();
		}
		$data["uname"]=$this->input->post("uname");
		if($strip){
			$this->load->view(THEME.'/users/user_chpwd_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/users/user_chpwd_view',$data,true));
		}
	}

	function _dochpwd($uname,$pass1,$pass2){
		
		$result["mismatch"]=false;
		$result["illegal"]=false;
		$result["success"]=false;
		$result["sambafail"]=false;
		$result["passwdfail"]=false;

		if (strcmp($pass1,$pass2)) {
			// Passwords dont match
			$result["mismatch"]=true;
		}elseif( !preg_match('/^\w+$/',$pass1)){
			// Password with illegal chars
			$result["illegal"]=true;		
		} else {
			if(set_unix_password($uname,$pass1)==0){
				if(set_samba_password($uname,$pass1,$pass2)==0){
					// Success
					$result["success"]=true;				
				}else{
					// Samba fail
					$result["sambafail"]=true;		
				}
			}else{
				// passwd fail
				$result["passwdfail"]=true;
			}
		}
		return $result;
	}

	function update($strip=""){
		
		if($this->input->post("cancel")) {
			redirect("users");
			exit();
		}
		$data["update"]["success"] = false;

		$realname=$this->input->post("realname");
		$shell=$this->input->post("shell")=="true"?"/bin/bash":"/sbin/nologin";
		$uname=$this->input->post("uname");
		$remote = $this->input->post("remote");

		if($this->Auth_model->policy("mail","edit_allusers") || $this->session->userdata("user")==$user) {
	
			if($this->input->post('pwd1') && $this->input->post('pwd2')) {
				$change_pwdres = $this->_dochpwd($uname,$this->input->post('pwd1'),$this->input->post('pwd2'));
			}
			
			if( isset($change_pwdres["success"]) && !$change_pwdres["success"] ) {
				// password errors, do not try to change anything else
				$data["update"]["message"] = "";
				foreach($change_pwdres as $key => $error) {
					if($error) {
						$data["update"]["message"] .= " " . t($key);
					}
				}
	
				if($uname=='admin') {
					$data["remote"] = $remote;
				} else {
					$data["shell"] = $shell;
				}
				$data["realname"] = $realname;
				$data["uname"] = $uname;
				
			} else {
				if($uname=='admin') {
					if ($remote=="true") {
						if($this->session->userdata("AllowRemote")) {
							// do nothing already allowing remote access
						} else {
							update_bubbacfg("admin","AllowRemote","yes");
							$this->session->set_userdata("AllowRemote", true);
						}
					} else {
						if($this->session->userdata("AllowRemote")) {
							update_bubbacfg("admin","AllowRemote","no");
							$this->session->set_userdata("AllowRemote", false);
						} else {
							// do nothing already not allowing remote access
						}
					}				
				}		
						
				if( !update_user($realname,$shell,$uname)){
					$data["update"]["success"] = true;
					$data["update"]["message"] = "user_update_ok";
				}else{
					$data["update"]["message"] = "user_update_error";
				}
			}		
		} else {
				$data["update"]["message"] = "user_update_error_auth_fail";
		}
		if($data["update"]["success"]) { // return to main page.
			$this->index(false,$data);
		} else {
			if($strip){
				$this->load->view(THEME.'/users/user_edit_view',$data);
			}else{
				$this->_renderfull($this->load->view(THEME.'/users/user_edit_view',$data,true));
			}
		}
	}	
	
	function edit($strip=""){
		require_once(APPPATH."/legacy/user_auth.php");
		$uinfo=$this->_get_uinfo();

		if(isset($uinfo[$this->input->post("uname")])) {
			$uname = $this->input->post("uname");
		} else {
			$uname = $this->session->userdata("user");
		}

		$data=$uinfo[$uname];
		$data["uname"]=$uname;
		if($data["uname"] == "admin") {
			$data["user_is_admin"] = true;
			$data["remote"] = $this->session->userdata("AllowRemote");
		} else {
			if(trim($data["shell"])=="/bin/bash"){
				$data["shell"]=true;
			}else{
				$data["shell"]=false;
			}
		}		
		$data["show_deleteuser"] = $this->Auth_model->policy("userdata","delete");

		if($strip){
			$this->load->view(THEME.'/users/user_edit_view',$data);		
		}else{
			$this->_renderfull($this->load->view(THEME.'/users/user_edit_view',$data,true));
		}
		
	}	
	
	function index($strip="", $data = array()){
		require_once(APPPATH."/legacy/user_auth.php");
		
		$data["userinfo"]= $this->_get_uinfo();
		$data["show_adduser"] = $this->Auth_model->policy("userdata","add");	
		// userinfo can be set and called from by "add" function.
		if(!isset($data["shellyes"])) $data["shellyes"]=false;
		if(!isset($data["shellno"])) $data["shellno"]=true;
		if(!isset($data["uname"])) $data["uname"]="";
		if(!isset($data["realname"])) $data["realname"]="";
		if($strip){
			$this->load->view(THEME.'/users/user_list_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/users/user_list_view',$data,true));
		}
	}

	function wizard($strip="") {
	
		require_once(APPPATH."/legacy/user_auth.php");


		$data['wiz_data'] = $this->input->post('wiz_data');
		if(isset($data['wiz_data']['back'])) {
			redirect("/settings/wizard");
		}

		if(isset($data['wiz_data']['cancel'])) {
			exit_wizard();
		}
		if(!$this->session->userdata("run_wizard")) {
			redirect("/stat");
		} else {
			if(isset($data['wiz_data']['postingpage']) || isset($data['wiz_data']['adduser'])) {
				// --- POSTPROCESSING USERS ----

				//d_print_r("POSTPROCESS: users");
				//d_print_r($data);
				if( isset($data['wiz_data']['adduser']) ) {
					// add user
					$ret['info'] = $this->add(-1);
					if(!$ret['info']['success']) {
						//d_print_r($ret['info']);
						$error = true;
						$data['err']['uname'] = "";
						$data['err']['pwd'] = "";
						$data['uname'] = $ret['info']['uname'];
						if($ret['info']['shell'] == "/bin/bash")
							$data['shell'] = true;
						$data['realname'] = $ret['info']['realname'];
						if($ret['info']["usr_existerr"])
							$data['err']['uname'] .= t("Error, user exists")."<br>";
						if($ret['info']["usr_caseerr"])
							$data['err']['uname'] .= t("Error, uppercase letters in username")."<br>";
						if($ret['info']["usr_nonameerr"])
							$data['err']['uname'] .= t("Error, no username")."<br>";
						if($ret['info']["usr_spacerr"])
							$data['err']['uname'] .= t("Error, space in username")."<br>";
						if($ret['info']["usr_charerr"])
							$data['err']['uname'] .= t("Error, illegal characters in username")."<br>";
						if($ret['info']["usr_longerr"])
							$data['err']['uname'] .= t("Error, username too long")."<br>";
						if($ret['info']["pwd_charerr"])
							$data['err']['pwd'] .= t("Error, illegal characters in password")."<br>";
						if($ret['info']["pwd_mismatcherr"])
							$data['err']['pwd'] .= t("Error, passwords do not match")."<br>";
						if(!$data['err']['uname'])
							unset($data['err']['uname']);
						if(!$data['err']['pwd'])
							unset($data['err']['pwd']);
					}

					// get userlist.
					$data['wiz_data']['ulist'] = $this->_get_uinfo();

				}
			} else {
				// --- PREPROCESSING USERS ----
				//d_print_r("PREPROCESS: users");
				// get userlist.
				$data['wiz_data']['ulist'] = $this->_get_uinfo();
			}
			
			if(  isset($error) ||
			   (!isset($data['wiz_data']['postingpage'])) || 
			   (isset($data['wiz_data']['adduser']))
			  ) { // if error/add or called from "stat" controller load the same view again.
				if($strip){
					$this->load->view($this->load->view(THEME.'/users/user_wizard_view',$data));
				}else{
					$this->_renderfull($this->load->view(THEME.'/users/user_wizard_view',$data,true));
				}
			} else {
				redirect("network/wizard");
			}
		}
	}

}
?>
