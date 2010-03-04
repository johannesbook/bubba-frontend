<?php

class Mail extends Controller{

	function Mail(){
		parent::Controller();
		
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->load->helper('update_msg');
		$this->Auth_model->EnforceAuth();

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content,$head = ""){
		if( ! $head ) {
			$mdata["head"] = $this->load->view(THEME.'/filemanager/filemanager_head_view','',true);
		} else {
			$mdata['head'] = $head;
		}
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function _parse_mailcfg($mc) {

		$this->Auth_model->RequireUser('admin');

		if(!query_service("postfix")){
			$smtp["smtpstatus"]=true;
		}else{
			$smtp["smtpstatus"]=false;
		}
		$smtp["domain"]=$mc[0];
		$smtp["smarthost"]=$mc[1];
		$smtp["hostname"]=$mc[2];
		$smtp["smtp_auth"]=$mc[3]=="yes";
		$smtp["smtp_plain_auth"] = strpos( $mc[4], 'noplaintext' ) === false;
		$smtp["smtp_user"]=$mc[5];
		
		return $smtp;

	}
	function _get_receivesettings() {

		$this->Auth_model->RequireUser('admin');

		$mc=get_mailcfg();
		$domain=$mc[0];
		$smarthost=$mc[1];
		$hostname=$mc[2];
		$smtp_auth=$mc[3]=="yes";
		$smtp_user=$mc[4];

		if(!query_service("postfix")){
			$smtpstatus=false;
		}else{
			$smtpstatus=true;
		}

		$recievedata["smtpstatus"]=$smtpstatus;
		$recievedata["domain"]=$domain;
		
		return $recievedata;
	}

	function _getUsers(){
		
		require_once(APPPATH."/legacy/user_auth.php");

		$userlist=array();		
		$userinfo = get_userinfo();
		foreach($userinfo as $user=>$info){
			if ( ($this->session->userdata("user")=="admin")||($this->session->userdata("user")==$user) ) {
				if($info["uid"]>999 && $info["uid"]<30000){
					$userlist[]=$user;
				}
			}
		}
		return $userlist;
	}

	function addfac($strip=""){
	
		$server=$this->input->post('server');
		$protocol=$this->input->post('protocol');
		$ruser=$this->input->post('ruser');
		$pwd=$this->input->post('password');
		$luser=$this->input->post('luser');
		$ssl=$this->input->post('usessl');
		$keep=$this->input->post('keep');

		$errors = array();
		$data["update"]["success"]=false;
		$data["ruser"]=$ruser;
		$data["server"]=$server;
		$data["protocol"]=$protocol;
		$data["luser"]=$luser;
		$data["usessl"]=$ssl;
		
		if(mb_strlen($server)==0 || 
			mb_strlen($protocol)==0 || 
			mb_strlen($ruser)==0 ||
			mb_strlen($pwd)==0 ||
			mb_strlen($luser)==0){
			$errors["infoincomp"]=true;
		}else if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$luser) ) {
			$errors["usrinvalid"]=true;
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
			add_fetchmailaccount($server,$protocol,$ruser,$pwd,$luser,$ssl,$keep);
			if(service_running("fetchmail")){

			}else{
				if(query_service("fetchmail")){
					start_service("fetchmail");
				}
			}
		}

		if(sizeof($errors) == 0) {
			$data = array();
		}
		$data["update"] = create_updatemsg($errors,"mail_addok");

		$this->viewfetchmail("",$data);	
	}	

	function editfac($strip="",$data = array()){

		if(sizeof($data) == 0) {
			// no data is passed, get the posts.
			$data["server"]=$this->input->post('server');
			$data["protocol"]=$this->input->post('protocol');
			$data["ruser"]=$this->input->post('ruser');
			$data["luser"]=$this->input->post('luser');
			$data["ssl"]=$this->input->post('ssl');
			$data["keep"]=$this->input->post('keep');
			$data["password"]=$this->input->post('password');
		}

		$data["userlist"]=$this->_getUsers();

		if($strip){
			$this->load->view(THEME.'/mail/mail_editfac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_editfac_view',$data,true),'/mail/mail_head_view');
		}
	}	
	
	function dodeletefac($strip=""){

		$server=$data["server"]=$this->input->post('server');
		$protocol=$this->input->post('protocol');
		$ruser=$data["ruser"]=$this->input->post('ruser');
		$luser=$this->input->post('luser');
	
		$data["success"]=false;
		$data["err_usrinvalid"]=false;
		
		if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$luser) ) {
			$data["err_usrinvalid"]=true;		
		}else{
			delete_fetchmailaccount($server,$protocol,$ruser);
			$data["success"]=true;		
		}
	
		if($strip){
			$this->load->view(THEME.'/mail/mail_dodeletefac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_dodeletefac_view',$data,true));
		}
	}	
	
	function updatefac($strip=""){
	
		$data["o_server"]=$this->input->post('old_server');
		$data["o_proto"]=$this->input->post('old_protocol');
		$data["o_ruser"]=$this->input->post('old_ruser');
		$data["server"]=$this->input->post('server');
		$data["protocol"]=$this->input->post('protocol');
		$data["ruser"]=$this->input->post('ruser');
		$data["pwd"]=$this->input->post('password');
		$data["luser"]=$this->input->post('luser');
		$data["ssl"]=$this->input->post('usessl');	
		$data["keep"]=$this->input->post('keep');	
		$data["password"]=$this->input->post('password');	
	
		$errors = array();
		
		if( ($this->session->userdata("user") != "admin") && ($this->session->userdata("user") != $data["luser"]) ) {
			$errors["mail_err_usrinvalid"]=true; 
		}else{
			if($data["ssl"] == "on"){
				$data["ssl"]="ssl";
			}else{
				$data["ssl"]="NONE";
			}
			if($data["keep"] == "on"){
				$data["keep"]="keep";
			}else{
				$data["keep"]="NONE";
			}
			if($data["pwd"]==""||$data["pwd"]==NULL){
				$data["pwd"]="\"\"";
			}
			update_fetchmailaccount(
				$data["o_server"],
				$data["o_proto"],
				$data["o_ruser"],
				$data["server"],
				$data["protocol"],
				$data["ruser"],
				$data["pwd"],
				$data["luser"],
				$data["ssl"],
				$data["keep"]
			);	
		}
		
		$update = create_updatemsg($errors,"mail_editok");
		
		if(sizeof($errors)) {
			// errors detected, load editfac again
			$data["update"] = $update;
			$this->editfac("",$data);
		} else {
			// no errors, clear data and return to main page
			$data = array();
			$data["update"] = $update;
			$this->viewfetchmail("",$data);
		}
	}	
		
	function server_update($strip=""){

		$this->Auth_model->RequireUser('admin');
	
		$smarthost=$this->input->post('smarthost');
		$useauth=$this->input->post('useauth');
		$use_plain_auth=$this->input->post('useunsecure');
		$smtpuser=$this->input->post('smtpuser');
		$smtppasswd=$this->input->post('smtppasswd');
		$domain=$this->input->post('domain');
		$smtp_passwd_mask=$this->input->post('smtp_passwd_mask');

		$update_postfix=false;
		$errors = array();

		$current_mc = $this->_parse_mailcfg(get_mailcfg());
		if( $current_mc["domain"] != $domain ) {
			// domain updated
			write_receive_mailcfg($domain);
			$update_postfix=true;
		}
		if(
			$current_mc["smarthost"] != $smarthost ||
			$current_mc["smtp_auth"] != $useauth ||
			$current_mc["smtp_plain_auth"] != $use_plain_auth ||
			$current_mc["smtp_user"] != $smtpuser ||
			$smtppasswd
		) {	// outbound smtp updated
			if($smarthost!="" && $useauth=="yes"){
				if($smtpuser=="" || $smtppasswd==""){
					$errors["mail_server_userpwdmissing"]=true;
				}else{
					write_send_mailcfg($smarthost,true,$smtpuser,$smtppasswd, $use_plain_auth == "yes");
					$update_postfix=true;
				}
			}else if($smarthost!=""){
				write_send_mailcfg($smarthost,false,"","", false);
				$update_postfix=true;
			}else{
				if($useauth=="yes"){
					$errors["mail_server_servermissing"]=true;
				}else{
					write_send_mailcfg($smarthost,false,"","", false);
					$update_postfix=true;
				}
			}
		}
		
		if($update_postfix){
			if(query_service("postfix")){
				stop_service("postfix");
				start_service("postfix");
			}
		}
		$data["update"] = create_updatemsg($errors);
		$this->server_settings("",$data);
	}	
	
	
	function viewfetchmail($strip="",$retdata = array()){

		require_once(APPPATH."/legacy/user_auth.php");

		if(!query_service("fetchmail")){
			$fetchmailstatus=false;
		}else{
			$fetchmailstatus=true;
		}

		$fa=get_fetchmailaccounts();
		$accounts=array();
		foreach($fa as $account){
			$line=explode(" ",$account);
			if ( ($this->session->userdata("user")=="admin")||($this->session->userdata("user")==$line[4]) ) {
				$accounts[]=array(
						"server"=>$line[0],
						"protocol"=>$line[1],
						"ruser"=>$line[2],
						"password"=>preg_replace("/./","*",$line[3]),
						"luser"=>$line[4],
						"ssl"=>isset($line[5])?$line[5]:"",
						"keep"=>isset($line[6])?$line[6]:"");
			}
		}

		$retdata["fstatus"]=$fetchmailstatus;
		$retdata["accounts"]=$accounts;
		$retdata["userlist"]=$this->_getUsers();

		if($strip){
			$this->load->view(THEME.'/mail/mail_retrieve_view',$retdata);
		}else{	
			$this->_renderfull($this->load->view(THEME.'/mail/mail_retrieve_view',$retdata,true));
		}
	}
	
	function server_settings($strip="",$data = array()){

		$this->Auth_model->RequireUser('admin');

		$mc=get_mailcfg();
		$data = array_merge($data,$this->_parse_mailcfg($mc));

		$data["receive"] = $this->_get_receivesettings();

		if($strip){
			$this->load->view(THEME.'/mail/mail_server_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_server_view',$data,true), '/mail/mail_head_view');
		}
	}
	
	function index($strip=""){

		$this->viewfetchmail();

	}

}
