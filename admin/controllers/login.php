<?php
class Login extends Controller{
	function index($strip=""){
	
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
		$this->load->model('networkmanager');
	
		$myuser=$this->input->post('username');
		$mypass=$this->input->post('password');
		$caller = $this->session->flashdata('caller');
		$required_user = $this->session->flashdata('required_user');
		$data['username']=$myuser;
		if($myuser && $mypass){
			// login flow.
			if($this->Auth_model->Login($myuser,$mypass)){
				$admin_wanaccess = false;
				$data['authfail'] = false;
				if ($myuser == 'admin') {
					$this->session->set_userdata("AllowRemote", false);
					if($this->networkmanager->access_interface() == "wan") {
						$admin_wanaccess = true;
					}
				}
				if(file_exists("/home/$myuser/.bubbacfg")){
					$conf=parse_ini_file("/home/$myuser/.bubbacfg");
					if($admin_wanaccess) {
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
								unset($conf["theme"]);
							}
							foreach($conf as $key => $value) {
								$this->session->set_userdata($key, $value);
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
						if($caller){
							redirect($caller);
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
				$data['authfail'] = true;
			}
			if(!$mypass){
				$data['pwdmissing']=true;
				$data['authfail'] = true;
			}
			
			// is there a redirect uri? Then show the login-page.
			if($caller) {
				$data["show_login"] = true;
				$data["redirect_uri"] = FORMPREFIX.$caller;
				$data["redirect_user"] = $this->session->userdata('user');
				if($required_user) {
					$data["required_user"] = $required_user;
				}
			}
			$conf=parse_ini_file("/home/admin/.bubbacfg");
			$data["show_sideboard"] = (!isset($conf["default_sideboard"]) || $conf["default_sideboard"]);
			if(isset($conf["run_wizard"]) && $conf["run_wizard"]) {
				$data["show_login"] = true;
				$data["required_user"] = "admin";
				$data["redirect_uri"] = FORMPREFIX."/settings/wizard";
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
			$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
			$mdata["head"]=$this->load->view(THEME.'/login_head_view',$data,true);;
			$mdata["content"]=$this->load->view(THEME.'/login_view', $this->menu->get_dialog_menu(),true);
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
