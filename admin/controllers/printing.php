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
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
		$mdata["subnav"]="";
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

	function askadd($strip=""){
		$data["url"]=$this->input->post("url");
		$data["name"]=$this->input->post("name");
		$data["loc"]=$this->input->post("loc");
		$data["info"]=$this->input->post("info");
      
		if($strip){
			$this->load->view(THEME.'/printing/print_askadd_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_askadd_view',$data,true));
		}
	}

	function doadd($strip=""){
		$data["name"]=$name=trim($this->input->post('name'));
		$data["info"]=$info=trim($this->input->post('info'));
		$data["url"]=$url=trim($this->input->post('url'));
		$data["loc"]=$loc=$this->input->post('loc');
	
		$data["name"]=$name;
		$data["success"]=true;
		$data["err_illegalchar"]=false;
		$data["err_noname"]=false;
		$data["err_noprintname"]=false;
		$data["err_nopath"]=false;
		$data["err_opfailed"]=false;
		
//		if($name && !preg_match('/^\w+$/',$name)){
		if($name && !preg_match('/^[a-z,A-Z,\_]+$/',$name)){
			$data["err_illegalchar"]=true;
			$data["success"]=false;
		}
		if(!$name){
			$data["err_noname"]=true;
			$data["success"]=false;
		}
		if(!$info){
			$data["err_noprintname"]=true;
			$data["success"]=false;
		}
		if(!$url){
			$data["err_nopath"]=true;
			$data["success"]=false;
		}

		if($data["success"]){
			if(!add_printer($name,$url,$info,$loc)){ 
			}else{
				$data["err_opfailed"]=true;
				$data["success"]=false;
			}
		}

		if($strip){
			$this->load->view(THEME.'/printing/print_doadd_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_doadd_view',$data,true));
		}
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

	function dodelete($strip=""){
		if($this->input->post('cancel')){
			$this->index();
			return;
		}

		$data["name"]=$name=$_POST['name'];	
		$data["success"]=false;

		if(delete_printer($name)){
		}else{
			$data["success"]=true;
		}		
		
		if($strip){
			$this->load->view(THEME.'/printing/print_dodelete_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_dodelete_view',$data,true));
		}
	}

	function delete($strip=""){
		$data["name"]=$this->input->post('name');

		if($strip){
			$this->load->view(THEME.'/printing/print_delete_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_delete_view',$data,true));
		}
	}	

	
	function index($strip=""){

		$iprinters=get_installed_printers();

		foreach($iprinters as $name=>$cfg){
			$iprinters[$name]["Info"]=trim($iprinters[$name]["Info"]," \"");
			$iprinters[$name]["State"]=trim($iprinters[$name]["State"]," \"");
		}
	
		$data["printstatus"]=false; //query_service("cupsys");;
		$data["iprinters"]=$iprinters;

		if($strip){
			$this->load->view(THEME.'/printing/print_list_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/printing/print_list_view',$data,true));
		}
	}

}

?>
