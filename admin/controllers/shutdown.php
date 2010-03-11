<?php
class Shutdown extends Controller{

	function Shutdown(){
		parent::Controller();
		
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->RequireUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}
	
	function index($strip=""){
	
		if($strip){
			$this->load->view(THEME.'/shutdown_confirm_view');
		}else{
			$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view','',true);
			$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
			$mdata["subnav"]="";
			$mdata["content"]=$this->load->view(THEME.'/shutdown_confirm_view','',true);
			$this->load->view(THEME.'/main_view',$mdata);
		}
	}
	
	function confirm($strip=""){
		if(!$this->input->post('shutdown') || $this->input->post('cancel')) {
			redirect('/stat');
		} else {
			power_off();
			$this->Auth_model->Logout();
			if($strip) {
				$json_data['error'] = false;
				echo json_encode($json_data);				
			} else {
				$mdata["navbar"]="";
				$mdata["content"]=$this->load->view(THEME.'/shutdown_view','',true);
				$this->load->view(THEME.'/main_view',$mdata);
	
			}
		}
	}
}	
?>
