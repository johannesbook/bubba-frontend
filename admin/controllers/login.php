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
								$data['authill'] = true;
							}
						} else {
							$data['authfail'] = true;
							$data['authill'] = true;
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
					$data['authill'] = true;
				}

				if ($data['authfail']) {
					$this->Auth_model->Logout();
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
		}else{
			if(!$myuser){
				$data['uidmissing']=true;
			}
			if(!$mypass){
				$data['pwdmissing']=true;
			}
		}
		if($strip=="json"){
			header("Content-type: application/json");
			print json_encode($data);
		}elseif($strip){
			$this->load->view(THEME.'/loginview',$data);
		}else{
			$mdata["navbar"]="";
			$mdata["subnav"]="";
			$mdata["content"]=$this->load->view(THEME.'/loginview',$data,true);
			$this->load->view(THEME.'/main_view',$mdata);
		}
		
	}
}
?>
