<?php
class Login extends Controller{
	function index($strip=""){
	
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
		$this->load->model('networkmanager');
	
		$myuser=$this->input->post('username');
		$mypass=$this->input->post('password');
		$data['username']=$myuser;
		if($myuser && $mypass){
			// login flow.
			if($this->Auth_model->Login($myuser,$mypass)){
				$admin_wanaccess = false;
				$data['authfail'] = false;
				if ($myuser == 'admin') {
					$this->session->set_userdata("AllowRemote", false);
					$wanip = get_interface_info($this->networkmanager->get_wan_interface());
					if(count($wanip)>0 && $_SERVER["SERVER_ADDR"] == $wanip[0]) {
						$admin_wanaccess = true;
					}
				}
				if(file_exists("/home/$myuser/.bubbacfg")){
					$conf=parse_ini_file("/home/$myuser/.bubbacfg");
					if($admin_wanaccess) {
						//print_r($conf);
						if(isset($conf['AllowRemote'])) {
							if(!$conf['AllowRemote']) {
								$data['authfail'] = true;
								$data['auth_err_remote'] = true;
							}
						} else {
							$data['authfail'] = true;
							$data['auth_err_remote'] = true;
						}
					}
					if (!$data['authfail']) {
						if(is_array($conf)){
							if(array_key_exists("theme",$conf)){
								if(file_exists(APPPATH.'views/'.$conf["theme"])){
									$this->session->set_userdata("theme", $conf["theme"]);
								}
							}
							if(array_key_exists("language",$conf)){
								$this->session->set_userdata("language", $conf["language"]);
							}
							if(array_key_exists("AllowRemote",$conf)){
								$this->session->set_userdata("AllowRemote", $conf["AllowRemote"]);
							} else {
								$this->session->set_userdata("AllowRemote", false);
							}
							if(array_key_exists("network_profile",$conf)){
								$this->session->set_userdata("network_profile", $conf["network_profile"]);
							}
							if(array_key_exists("run_wizard",$conf)){
								if($conf['run_wizard']) {
									$this->session->set_userdata("run_wizard", true);
								}
							}
						}
					}
				} elseif ($admin_wanaccess) { // no config file exists.
					$data['authfail']=true;
					$data['auth_err_remote'] = true;
				}

				$this->session->set_userdata("version",get_package_version("bubba-frontend"));

				if ($data['authfail']) {
					//$this->Auth_model->Logout();
				} else {
					if($strip!="json"){
						if($this->session->userdata('caller')){
							redirect($this->session->userdata('caller'));
							$this->session->unset_userdata('caller');
						}else{
							redirect('');
						}
						exit();
					}
				}
			}else{
				$data['authfail']=true;
			}
		}else{ // no post or data missing.
			if(!$myuser){
				$data['uidmissing']=true;
			}
			if(!$mypass){
				$data['pwdmissing']=true;
			}
			// is there an active session?
			$data["ui_login_user_lock"]  = "ui-login-state-lock fn-login-state-lock";
			$data["ui_login_admin_lock"] = "ui-login-state-lock fn-login-state-lock";
			if($this->Auth_model->CheckAuth()) {
				$data["valid_user"] = $this->session->userdata('user');
				if($data["valid_user"] == "admin") {
					$data["ui_login_admin_lock"] = "ui-login-state-nolock";
				} else {
					$data["ui_login_user_lock"]  = "ui-login-state-nolock";
				}
			}
			
			// is there a redirect uri? Then show the login-page.
			if($this->session->userdata('caller')) {
				$data["show_login"] = true;
				$data["redirect_uri"] = FORMPREFIX.$this->session->userdata('caller');
				$this->session->unset_userdata('caller');
				$data["redirect_user"] = $this->session->userdata('user');
				if($this->session->userdata('required_user') == 'admin') {
					$data["require_admin"] = true;
					$this->session->unset_userdata('required_user');
				}
			}
		}
		
		/*  output data */
		if($strip=="json"){
			header("Content-type: application/json");
			print json_encode($data);
		}elseif($strip){
			$this->load->view(THEME.'/loginview',$data);
		}else{
			$mdata["navbar"]="";
			$mdata["subnav"]="";
			$mdata["head"]=$this->load->view(THEME.'/login_head_view',$data,true);;
			$mdata["content"]=$this->load->view(THEME.'/loginview',$data,true);
			$this->load->view(THEME.'/main_view',$mdata);
		}
		
	}
	
	function checkauth() {
		if($json_data["valid_session"] = $this->Auth_model->CheckAuth()) {
			$json_data["user"] = $this->session->userdata('user');
		}
		
		echo json_encode($json_data);
	}

}
?>
