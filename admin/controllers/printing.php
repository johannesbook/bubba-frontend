<?php

class Printing extends Controller{

	function Printing(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->RequireUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}
	
	function state($strip=""){
		$name=$this->input->post('name');
		$state=$this->input->post('state');
		
		if($name && $state=="start"){
			enable_printer($name);
		}else if ($name && $state=="stop"){
			disable_printer($name);
		}else{
			// ERR
		}
		$this->index($strip);
	}	

	function _renderfull($content){
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	


	function update($strip=""){
		if($this->input->post('cancel')){
			$this->index();
			return;
		}

		$data["name"]=$name=$this->input->post('name');
		$data["info"]=$info=$this->input->post('info');
		$data["url"]=$url=$this->input->post('url');
		$data["loc"]=$loc=$this->input->post('loc');

		$data["success"]=true;
		$data["err_noname"]=false;
		$data["err_noinfo"]=false;
		$data["err_nopath"]=false;
		$data["err_updatefail"]=false;

		if(!$name){
			$data["err_noname"]=true;		
			$data["success"]=False;
		}
		if(!$info){
			$data["err_noinfo"]=true;			
			$data["success"]=false;
		}
		if(!$url){
			$data["err_nopath"]=true;		
			$data["success"]=false;
		}	

		if($data["success"]){
			if(!add_printer($name,$url,$info,$loc)){
			}else{
				$data["err_updatefail"]=true;
				$data["success"]=false;
			}
		}
		
		if($strip){
			$this->load->view(THEME."/printing/print_update_view",$data);
		}else{
			$this->_renderfull($this->load->view(THEME."/printing/print_update_view",$data,true));
		}
	}	

	function edit($strip=""){

		$info=$this->input->post('info');
		$loc=$this->input->post('loc');
		$s_name=$_POST['name'];
		$iprinters=get_installed_printers();
		$url="";
		
		foreach($iprinters as $name=>$cfg){
			if($name==$s_name){
				if(!$info){
					$info=trim($cfg["Info"]," \"");
				}
				if(!$loc){
					$loc=isset($cfg["Location"])?trim($cfg["Location"]," \""):"";
				}
				$url=trim($cfg['DeviceURI']," \"");			
			}
		}
		
		$data["name"]=$s_name;		
		$data["info"]=$info;
		$data["loc"]=$loc;
		$data["url"]=$url;
		
		if($strip){
			$this->load->view(THEME.'/printing/print_edit_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_edit_view',$data,true));
		}
	}

	function askadd($strip="", $data=array()){
		if( empty( $data ) ) { // no need to reget those
			$data["url"]=$this->input->post("url");
			$data["name"]=$this->input->post("name");
			$data["loc"]=$this->input->post("loc");
			$data["info"]=$this->input->post("info");
		}
      
		if($strip){
			$this->load->view(THEME.'/printing/print_askadd_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_askadd_view',$data,true));
		}
	}

	function doadd( $strip = false ){

		$data["name"]=$name=trim($this->input->post('name'));
		$data["info"]=$info=trim($this->input->post('info'));
		$data["url"]=$url=trim($this->input->post('url'));
		$data["loc"]=$loc=$this->input->post('loc');
	
		if($name && !preg_match('/^[a-z,A-Z,\_]+$/',$name)){
			$data['update'] = array(
				'success' => false,
				'message' => t("printing_add_error_invalid_characters"),
			);
			$this->askadd( false, $data );
			return;
		}
		if(!$name){
			$data['update'] = array(
				'success' => false,
				'message' => t("printing_add_error_no_name"),
			);			
			$this->askadd( false, $data );
			return;
		}
		if(!$info){
			$data['update'] = array(
				'success' => false,
				'message' => t("printing_add_error_no_printer_name"),
			);					
			$this->askadd( false, $data );
			return;
		}
		if(!$url){
			$data['update'] = array(
				'success' => false,
				'message' => t("printing_add_error_no_printer_path"),
			);					
			$this->askadd( false, $data );
			return;
		}

		if(!add_printer($name,$url,$info,$loc)){ 
			$data['update'] = array(
				'success' => true,
				'message' => t("printing_add_success", $name),
			);				
		}else{
			$data['update'] = array(
				'success' => false,
				'message' => t("printing_add_error_operation_failed"),
			);					
		}
		$this->index($strip, $data);
	}
	
	function add($strip=""){
		
		$printers=array();
	   $aprinters=get_attached_printers();
		foreach($aprinters as $aprinter){
			$pieces=explode(" ",$aprinter,2);
			$printers[$pieces[0]]=$pieces[1];
		}
		
		$data["printers"]=$printers;
	
		if($strip){
			$this->load->view(THEME.'/printing/print_add_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_add_view',$data,true));
		}
	}	

	function dodelete( $strip = false ){
		if($this->input->post('cancel')){
			$this->index( $strip );
			return;
		}

		$data["name"]=$name=$this->input->post('name');	

		if(!delete_printer($name)){
			$data['update'] = array(
				'success' => true,
				'message' => t("printing_delete_success", $name),
			);				
		}else{
			$data['update'] = array(
				'success' => false,
				'message' => t("printing_delete_error_operation_failed"),
			);					
		}		
		$this->index($strip, $data);

	}

	function delete($strip=""){
		$data["name"]=$this->input->post('name');

		if($strip){
			$this->load->view(THEME.'/printing/print_delete_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_delete_view',$data,true));
		}
	}	

	
	function index($strip="", $data=array()){

		$iprinters=get_installed_printers();

		foreach($iprinters as $name=>$cfg){
			$iprinters[$name]["Info"]=trim($iprinters[$name]["Info"]," \"");
			$iprinters[$name]["State"]=trim($iprinters[$name]["State"]," \"");
		}
	
		$data["printing_enabled"]=true;
		$data["installed_printers"]=$iprinters;

		if($strip){
			$this->load->view(THEME.'/printing/print_list_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_list_view',$data,true));
		}
	}

}

?>
