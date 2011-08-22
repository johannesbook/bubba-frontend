<?php
class Shutdown extends Controller{

	function Shutdown(){
		parent::Controller();
		
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->enforce_policy('web_admin','administer', 'admin');

	}
	
	function index($strip=""){
		confirm();	
	}
	
	function confirm($strip=""){
		if(!$this->input->post('action') || $this->input->post('cancel')) {
			redirect('/stat');
		} else {
			$action = $this->input->post('action');
			if($action == "shutdown") {
				$data["shutdown"] = true;
				power_off();
			} elseif ($action == "reboot") {
				$data["reboot"] = true;
				reboot();
			} else {
				echo "redirect";
				redirect('');
				exit();
			}
			if($strip) {
			} else {
				$mdata["navbar"]="";
				$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
				$mdata["content"]=$this->load->view(THEME.'/shutdown_view',$data,true);
				$this->load->view(THEME.'/main_view',$mdata);
	
			}
			$this->Auth_model->Logout();
		}
	}
}	
?>
