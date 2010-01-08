<?php

class Mail extends Controller{

	function Mail(){
		parent::Controller();
		
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->RequireUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content,$head = null){
		if( !is_null($head) ) {
			$mdata["head"] = $this->load->view(THEME.$head,'',true);
		}
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
		$mdata["subnav"]=$this->load->view(THEME.'/mail/mail_submenu_view','',true);;
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
		}else if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$luser) ) {
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
			$this->load->view(THEME.'/mail/mail_addfac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_addfac_view',$data,true));
		}
	}	

	function editfac($strip=""){

		require_once(APPPATH."/legacy/user_auth.php");

		$server=$this->input->post('server');
		$protocol=$this->input->post('proto');
		$ruser=$this->input->post('ruser');
		$luser=$this->input->post('luser');
		$ssl=$this->input->post('ssl');
		$keep=$this->input->post('keep');
		$rpassword=$this->input->post('password');

		$data["server"]=$server;
		$data["protocol"]=$protocol;
		$data["ruser"]=$ruser;
		$data["luser"]=$luser;
		$data["ssl"]=$ssl;
		$data["keep"]=$keep;
		$data["rpassword"]=$rpassword;
		$data["userlist"]=$this->_getUsers();

		if($strip){
			$this->load->view(THEME.'/mail/mail_editfac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_editfac_view',$data,true));
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
 
		if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$data["luser"]) ) {
			$data["err_userinvalid"]=true;
		}else{   
			$data["success"]=true;   
		}   	
		
		if($strip){
			$this->load->view(THEME.'/mail/mail_deletefac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_deletefac_view',$data,true));
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
		
		if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$luser) ) {
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
			$this->load->view(THEME.'/mail/mail_updatefac_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_updatefac_view',$data,true));
		}
	}	
	
	function recieve($strip=""){

		$domain=$this->input->post('domain');
		
		write_receive_mailcfg($domain);
		
		if(query_service("postfix")){
			stop_service("postfix");
			start_service("postfix");
		}
		
		$this->viewreceivemail($strip);
	}
	
	function send($strip=""){

		$smarthost=$this->input->post('smarthost');
		$useauth=$this->input->post('useauth');
		$use_plain_auth=$this->input->post('useunsecure');
		$smtpuser=$this->input->post('smtpuser');
		$smtppasswd=$this->input->post('smtppasswd');
		$update_postfix=false;

		$data["userpwdmissing"]=false;
		$data["servermissing"]=false;		
		$data["success"]=false;
		if($smarthost!="" && $useauth=="yes"){
			if($smtpuser=="" || $smtppasswd==""){
				$data["userpwdmissing"]=true;
			}else{
				write_send_mailcfg($smarthost,true,$smtpuser,$smtppasswd, $use_plain_auth == "yes");
				$data["success"]=true;				
				$update_postfix=true;
			}
		}else if($smarthost!=""){
			write_send_mailcfg($smarthost,false,"","", false);
			$update_postfix=true;
			$data["success"]=true;
		}else{
			if($useauth=="yes"){
				$data["servermissing"]=true;
			}else{
				write_send_mailcfg($smarthost,false,"","", false);
				$update_postfix=true;
				$data["success"]=true;
			}
		}

		if($update_postfix){
			if(query_service("postfix")){
				stop_service("postfix");
				start_service("postfix");
			}
		}
			
		if($strip){
			$this->load->view(THEME.'/mail/mail_send_done_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_send_done_view',$data,true));
		}
	}	
	
	function _getUsers(){
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
	
	function viewfetchmail($strip=""){

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
						"proto"=>$line[1],
						"ruser"=>$line[2],
						"rpassword"=>preg_replace("/./","*",$line[3]),
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
	
	function viewmailsend($strip=""){
		$mc=get_mailcfg();
		$domain=$mc[0];
		$smarthost=$mc[1];
		$hostname=$mc[2];
		$smtp_auth=$mc[3]=="yes";
		$smtp_plain_auth = strpos( $mc[4], 'noplaintext' ) === false;
		$smtp_user=$mc[5];

		if(!query_service("postfix")){
			$smtpstatus=true;
		}else{
			$smtpstatus=false;
		}

		$senddata["smtpstatus"]=$smtpstatus;
		$senddata["smarthost"]=$smarthost;
		$senddata["smtp_auth"]=$smtp_auth;
		$senddata["smtp_plain_auth"]=$smtp_plain_auth;
		$senddata["smtp_user"]=$smtp_user;

		if($strip){
			$this->load->view(THEME.'/mail/mail_send_view',$senddata);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_send_view',$senddata,true), '/mail/mail_send_head_view');
		}
	}

	function viewreceivemail($strip=""){
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

		if($strip){
			$this->load->view(THEME.'/mail/mail_recieve_view',$recievedata);
		}else{
			$this->_renderfull($this->load->view(THEME.'/mail/mail_recieve_view',$recievedata,true));
		}
	}
	
	function index($strip=""){

		$this->viewfetchmail();

	}

}
