<?php

class Usermail extends Controller{
	
	function Usermail(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth();

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}		

	function _renderfull($content){
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
		$mdata["subnav"]="";
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	


	function addfac($strip=""){
	
		$server=$this->input->post('server');
		$proto=$this->input->post('protocol');
		$ruser=$this->input->post('ruser');
		$pwd=$this->input->post('password');
		$luser=$this->input->post('luser');
		$ssl=$this->input->post('usessl');
		$keep=$this->input->post('keep');

		$data["infoincomp"]=false;
		$data["usrinvalid"]=false;
		$data["success"]=false;
		$data["ruser"]=$ruser;
		$data["server"]=$server;
		$data["protocol"]=$proto;
		$data["luser"]=$luser;
		$data["usessl"]=$ssl;
		
		if(mb_strlen($server)==0 || 
			mb_strlen($proto)==0 || 
			mb_strlen($ruser)==0 ||
			mb_strlen($pwd)==0 ||
			mb_strlen($luser)==0){
			$data["infoincomp"]=true;
		}else if($this->session->userdata("user")!=$luser) {
			$data["usrinvalid"]=true;
		}else{
			if($keep == "on"){
				$keep="keep";
			}else{
				$keep="NONE";
			}
			if($ssl == "on"){
				$ssl="ssl";
			}else{
				$ssl="NONE";
			}
			add_fetchmailaccount($server,$proto,$ruser,$pwd,$luser,$ssl,$keep);
			if(service_running("fetchmail")){

			}else{
				if(query_service("fetchmail")){
					start_service("fetchmail");
				}
			}
      
			$data["success"]=true;
		}
		if($strip){
			$this->load->view(THEME.'/usermail/usermail_addfac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/usermail/usermail_addfac_view',$data,true));
		}
	}	

	function editfac($strip=""){

		require_once(APPPATH."/legacy/user_auth.php");

		$server=$this->input->post('server');
		$protocol=$this->input->post('proto');
		$ruser=$this->input->post('ruser');
		$luser=$this->input->post('luser');
		$keep=$this->input->post('keep');
		$ssl=$this->input->post('ssl');
		$rpassword=$this->input->post('password');

		$data["server"]=$server;
		$data["protocol"]=$protocol;
		$data["ruser"]=$ruser;
		$data["luser"]=$luser;
		$data["ssl"]=$ssl;
		$data["keep"]=$keep;
		$data["rpassword"]=$rpassword;

		if($strip){
			$this->load->view(THEME.'/usermail/usermail_editfac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/usermail/usermail_editfac_view',$data,true));
		}
	}	

	function updatefac($strip=""){
	
		$o_server=$this->input->post('old_server');
		$o_proto=$this->input->post('old_protocol');
		$o_ruser=$this->input->post('old_ruser');
		$server=$this->input->post('server');
		$proto=$this->input->post('protocol');
		$ruser=$this->input->post('ruser');
		$pwd=$this->input->post('password');
		$luser=$this->input->post('luser');
		$ssl=$this->input->post('usessl');	
		$keep=$this->input->post('keep');	
	
		$data["success"]=false;
		$data["err_usrinvalid"]=false;
		
		if( $this->session->userdata("user")!=$luser ) {
			$data["err_usrinvalid"]=true; 
		}else{
			if($ssl == "on"){
				$ssl="ssl";
			}else{
				$ssl="NONE";
			}
			if($keep == "on"){
				$keep="keep";
			}else{
				$keep="NONE";
			}
			if($pwd==""||$pwd==NULL){
				$pwd="\"\"";
			}
			update_fetchmailaccount($o_server,$o_proto,$o_ruser,$server,$proto,$ruser,$pwd,$luser,$ssl,$keep);	
			$data["success"]=true;		
		}

		if($strip){
			$this->load->view(THEME.'/usermail/usermail_updatefac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/usermail/usermail_updatefac_view',$data,true));
		}
	}	

	function deletefac($strip=""){
		$data["server"]=$this->input->post('server');
		$data["protocol"]=$this->input->post('protocol');
		$data["ruser"]=$this->input->post('ruser');
		$data["luser"]=$this->input->post('luser');
		$data["ssl"]=$this->input->post('ssl');
		$data["success"]=false;   
		$data["err_userinvalid"]=false;   
 
		if( $this->session->userdata("user")!=$data["luser"] ) {
			$data["err_userinvalid"]=true;
		}else{   
			$data["success"]=true;   
		}   	
		
		if($strip){
			$this->load->view(THEME.'/usermail/usermail_deletefac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/usermail/usermail_deletefac_view',$data,true));
		}
	}	

	function dodeletefac($strip=""){

		$server=$data["server"]=$this->input->post('server');
		$protocol=$this->input->post('protocol');
		$ruser=$data["ruser"]=$this->input->post('ruser');
		$luser=$this->input->post('luser');
	
		$data["success"]=false;
		$data["err_usrinvalid"]=false;
		
		if( $this->session->userdata("user")!=$luser ) {
			$data["err_usrinvalid"]=true;		
		}else{
			delete_fetchmailaccount($server,$protocol,$ruser);
			$data["success"]=true;		
		}
	
		if($strip){
			$this->load->view(THEME.'/usermail/usermail_dodeletefac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/usermail/usermail_dodeletefac_view',$data,true));
		}
	}	

	function index($strip=""){

		if(!query_service("fetchmail")){
			$fetchmailstatus=false;
		}else{
			$fetchmailstatus=true;
		}

		$fa=get_fetchmailaccounts();
		$accounts=array();
		foreach($fa as $account){
			$line=explode(" ",$account);
			if ( $this->session->userdata("user")==$line[4] ) {
				$accounts[]=array(
						"server"=>$line[0],
						"proto"=>$line[1],
						"ruser"=>$line[2],
						"rpassword"=>preg_replace("/./","*",$line[3]),
						"luser"=>$line[4],
						"ssl"=>isset($line[5])?$line[5]:"",
						"keep"=>isset($line[6])?$line[6]:"");
			}
		}


		$data["fstatus"]=$fetchmailstatus;
		$data["accounts"]=$accounts;
		$data["user"]=USER;

		if($strip){
			$this->load->view(THEME.'/usermail/usermail_index_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/usermail/usermail_index_view',$data,true));
		}
	}

}
