<?php

class Users extends Controller{

	function Users(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);
		$this->Auth_model->EnforceAuth();

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	private function _renderfull($content, $head = ''){
		if( ! $head ) {
			$mdata["head"] = $this->load->view(THEME.'/users/user_head_view','',true);
		} else {
			$mdata['head'] = $head;
		}
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		if($this->session->userdata('run_wizard')) {
			$mdata["dialog_menu"] = "";
			$mdata["content"]="";
			$mdata["wizard"]=$content;
		} else {
			$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
			$mdata["content"]=$content;
			$mdata["wizard"]="";
		}
		$this->load->view(THEME.'/main_view',$mdata);
	}

	private function _get_uinfo() {

		$userinfo=get_userinfo();
		$allow_list_users = $this->Auth_model->policy("userdata","list");
		$result = array();
		foreach($userinfo as $uname => $value){
			if($value["uid"]<1000 || $value["uid"]>60000){
				continue;
			}
			if ( $allow_list_users || ($this->session->userdata("user")==$uname) ) {

				$value["allow:enable_shell"] = $this->Auth_model->policy( 'userdata', 'allow:enable_shell', $uname);
				$value["allow:enable_rename"] = $this->Auth_model->policy( 'userdata', 'allow:enable_rename', $uname);
				$value["allow:disable_remote"] = $this->Auth_model->policy( 'userdata', 'allow:disable_remote', $uname);
				$value["remote"] = $this->session->userdata("AllowRemote");
				$value["shell"] = trim($value["shell"])=="/bin/bash" && $value["allow:enable_shell"];
				$value['username'] = $uname;
				$result[] = $value;
			}
		}
		return $result;

	}	

	private function _dochpwd($uname,$pass1,$pass2){

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

	public function check_username($strip="") {
		if( $strip == 'json' ) {
			$username=strtolower(trim($this->input->post('input_username')));


			header("Content-type: application/json");
			echo json_encode( !user_exists( $username ) );

		}
	}

	public function add_user_account($strip=""){
		if( $strip == 'json' ) {
			require_once(APPPATH."/legacy/user_auth.php");
			$error = false;

			$username=strtolower(trim($this->input->post('username')));
			$realname=trim($this->input->post('realname'));
			$password1=trim($this->input->post('password1'));
			$password2=trim($this->input->post('password2'));
			$shell=$this->input->post('shell');
			if($this->Auth_model->policy("userdata","allow:enable_shell", $username) && $shell ) {
				$shell = '/bin/bash';
			} else {
				$shell = '/usr/sbin/nologin'; 
			}
			$group = 'users'; // Static group for em all

			$uinfo=get_userinfo();

			if (
				isset($userinfo[$username])
				|| $username == "root"
				|| $username == "storage"
				|| $username == "web"
				|| $username == ""
				|| strpos($username, ' ') !== false
				|| !preg_match('/^\w+$/',$password1)
				|| !preg_match('/^[a-z0-9 _-]+$/',$username)
				|| strlen($username) > 32
				|| $username[0] == '-'
				|| $password1 == ""
				|| $password1 != $password2
			) {
				$error = t('users-add-account-validation-error');
			} else {
				if(add_user($realname,$group,$shell,$password1,$username)){
					$error = t('users-add-account-error');
				}
			}

			$data['success'] = !$error;
			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			return;
		}
	}

	public function edit_user_account($strip=""){
		if( $strip == 'json' ) {
			require_once(APPPATH."/legacy/user_auth.php");
			$error = false;

			$username=strtolower(trim($this->input->post('username')));
			$realname=trim($this->input->post('realname'));
			$password1=trim($this->input->post('password1'));
			$password2=trim($this->input->post('password2'));
			$shell=$this->input->post('shell');
			$remote = $this->input->post("remote");
			$sideboard = $this->input->post("sideboard");

			if( $this->Auth_model->policy("userdata","allow:enable_shell", $username) && $shell ) {
				$shell = '/bin/bash';
			} else {
				$shell = '/usr/sbin/nologin'; 
			}


			if($this->Auth_model->policy("userdata","edit_allusers") || $this->session->userdata("user")==$username) {

				if( $password1 && $password2 ) {
					$result_chpwd = $this->_dochpwd(
						$username,
						$password1,
						$password2
					);
				}

				if( isset($result_chpwd["success"]) && !$result_chpwd["success"] ) {
					$error = "";
					// password errors, do not try to change anything else
					$data["update"]["message"] = "";
					foreach($result_chpwd as $key => $error) {
						if($error) {
							$error .= " " . t($key);
						}
					}
				}

				if( !$error && $this->Auth_model->policy("userdata","allow:disable_remote", $username) ) {
					update_bubbacfg("admin","AllowRemote",$remote ? 'yes': 'no' );
					$this->session->set_userdata("AllowRemote", $remote);
				}

				if( !$error && $username == 'admin' ) {
					update_bubbacfg("admin","default_sideboard", $sideboard ? "yes" : "no" );
				}

				if( !$error && update_user($realname,$shell,$username)){
					$error = t("users-edit-account-error '%s' '%s' '%s'", $realname, $shell, $username);
				}		
			} else {
				$error = t("user_update_error_auth_fail");
			}

			$data['success'] = !$error;
			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			return;
		}
	}	

	public function delete_user_account($strip=""){
		if( $strip == 'json' ) {
			require_once(APPPATH."/legacy/user_auth.php");
			$error = false;

			$username=strtolower(trim($this->input->post('username')));
			$userdata=$this->input->post('userdata');

			if($this->Auth_model->policy("userdata","delete")) {

				// TODO: fix this to only allow users with uid>999 to be deleted
				if( $username == "root" || $username == "admin" ){		
					$error = t('users-delete-bad-user-error');
					exit();
				}
				if(del_user($username)==0){
					$data["delusersuccess"]=true;
					if($userdata){
						if(rm("/home/$username","root")==0){
						}else{
							$error = t('users-delete-userdata-error');
						}
						try {
							purge_horde( $username );
						} catch( AdminException $e ) {
							$error = t('users-delete-userdata-error');
						}
					}
				}else{
					$error = t('users-delete-account-error');
				}
			} else {
				$error = t("generic-permission-denied");
			}
			$data['success'] = !$error;
			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			return;
		}
	}	

	public function index($strip="", $data = array()){
		require_once(APPPATH."/legacy/user_auth.php");

		$data["accounts"]= $this->_get_uinfo();

		if($strip == "json" ){
			header("Content-type: application/json");
			echo json_encode( $data );
		}else{
			$data["show_adduser"] = $this->Auth_model->policy("userdata","add");	
			$data["show_allusers"] = $this->Auth_model->policy("userdata","edit_allusers");	
			$data["allow_delete"] = $this->Auth_model->policy("userdata","delete");	
			$conf=parse_ini_file("/home/admin/.bubbacfg");

			$data["default_sideboard"] =  (!isset($conf["default_sideboard"]) || $conf["default_sideboard"]);

			$this->_renderfull(
				$this->load->view(THEME.'/users/user_list_view',$data,true),
				$this->load->view(THEME.'/users/user_list_head_view',$data,true)
			);
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
					$this->_renderfull(
						$this->load->view(THEME.'/users/user_wizard_view',$data,true),
						$this->load->view(THEME.'/users/user_wizard_head_view',$data,true)
					);
				}
			} else {
				redirect("network/wizard");
			}
		}
	}

	function config($strip="",$parameter,$value) {
		if( $strip == 'json' ) {
			if($this->Auth_model->policy("config",$parameter)) {
				update_bubbacfg($this->session->userdata("user"),$parameter,$value);
				$this->session->set_userdata($parameter,$value);
			}
		}
	}
}
