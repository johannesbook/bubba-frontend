<?php

class Printing extends Controller{

	function Printing(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->RequireUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content, $head = ''){
		if(  $head ) {
			$mdata['head'] = $head;
		}
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}		


	public function check_printername($strip="") {
		if( $strip == 'json' ) {
			$name=trim($this->input->post('input_username'));

			header("Content-type: application/json");
			echo json_encode( !array_key_exists( $name, get_installed_printers() ) );
		}
	}

	public function add_printer($strip=""){
		if( $strip == 'json' ) {
			$error = false;

			$name=trim($this->input->post('name'));
			$printer=trim($this->input->post('printer'));
			$location=trim($this->input->post('location'));
			$info=trim($this->input->post('info'));

			if ( 
				!$name
				|| !$printer
				|| !preg_match('/^[a-z,A-Z,\_]+$/',$name)
			) {
				$error = t('printing-add-validation-error');
			} else {
				if(add_printer($name,$printer,$info,$location)) {
					$error = t('printing-add-error');
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

	public function edit_printer($strip=""){
		if( $strip == 'json' ) {
			$error = false;

			$name=trim($this->input->post('name'));
			$printer=trim($this->input->post('printer'));
			$location=trim($this->input->post('location'));
			$info=trim($this->input->post('info'));

			if ( 
				!$name
				|| !preg_match('/^[a-z,A-Z,\_]+$/',$name)
			) {
				$error = t('printing-edit-validation-error');
			} else {
				if(add_printer($name,$printer,$info,$location)) {
					$error = t('printing-edit-error');
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

	public function delete_printer($strip=""){
		if( $strip == 'json' ) {
			$error = false;
			$name=trim($this->input->post('name'));

			if( ! $name ) {
				$error = t('printing-startstop-validation-error');
			} else {
				if($this->Auth_model->policy("printing","delete")) {
					if(delete_printer($name)){ // true == false
						$error = t('printing-delete-error');
					}
				} else {
					$error = t("generic-permission-denied");
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

	public function startstop_printer($strip=""){
		if( $strip == 'json' ) {
			$error = false;
			$name = trim($this->input->post('name'));
			$active = $this->input->post('active');
			if( ! $name ) {
				$error = t('printing-startstop-validation-error');
			} else {
				if($this->Auth_model->policy("printing","startstop")) {
					if( $active ) {
						enable_printer( $name );
					} else {
						disable_printer( $name );
					}
				} else {
					$error = t("generic-permission-denied");
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
	
	function index($strip="", $data=array()){

		$installed_printers = array();
		$attached_printers = array();


		foreach(get_installed_printers() as $name=>$cfg){
			$installed_printers[] = array(
				'name' => $name,
				'info' => trim($cfg["Info"]," \""),
				'state' => trim($cfg["State"]," \""),
				'location' => trim($cfg['Location'], " \""),
				'url' => trim($cfg['DeviceURI'], " \""),
			);
		}
	
		foreach(get_attached_printers() as $printer){
			preg_match('#(usb://.*?) "(.*?)"#', $printer, $matches);

			$attached_printers[] = array(
				'url' => $matches[1],
				'description' => $matches[2]
			);
		}		

		$data["installed_printers"]=$installed_printers;
		if($strip == "json" ){
			header("Content-type: application/json");
			echo json_encode( $data );
		}else{		
			$data["attached_printers"]=$attached_printers;
			$data["allow_delete"] = $this->Auth_model->policy("printing","delete");	
			$data["allow_startstop"] = $this->Auth_model->policy("printing","startstop");	

			$this->_renderfull(
				$this->load->view(THEME.'/printing/print_list_view',$data,true),
				$this->load->view(THEME.'/printing/print_list_head_view',$data,true)
			);
		}
	}

}

?>
