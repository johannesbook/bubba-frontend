<?php

class Mail extends Controller{

	function Mail(){
		parent::Controller();
		
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->load->helper('update_msg');
		$this->Auth_model->EnforceAuth('web_admin');

	}

	function _renderfull($content,$head = "", $mdata){
		if( ! $head ) {
			$mdata["head"] = $this->load->view(THEME.'/mail/mail_head_view','',true);
		} else {
			$mdata['head'] = $head;
		}
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function _parse_mailcfg($mc) {

		$this->Auth_model->enforce_policy('web_admin','administer', 'admin');

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

		$this->Auth_model->enforce_policy('web_admin','administer', 'admin');

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
					if($this->Auth_model->policy("mail","fetch",$user)) {
						$userlist[]=$user;
					}
				}
			}
		}
		return $userlist;
	}

	function add_fetchmail_account($strip=""){
		if( $strip == 'json' ) {
			$error = false;

			$server=$this->input->post('server');
			$protocol=$this->input->post('protocol');
			$ruser=$this->input->post('ruser');
			$pwd=$this->input->post('password');
			$luser=$this->input->post('luser');
			$ssl=$this->input->post('usessl');
			$keep=$this->input->post('keep');

			// TODO remove this uglyness
			$keep = $keep == 'on' ? 'keep' : 'NONE';
			$ssl = $ssl == 'on' ? 'ssl' : 'NONE';
			if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$luser) ) {
				$error = _("Authorization failed");
			} else {
				if($server && $protocol && $ruser && $pwd && $luser ){
					add_fetchmailaccount($server,$protocol,$ruser,$pwd,$luser,$ssl,$keep);
					if(query_service("fetchmail") && !service_running("fetchmail")){
						start_service("fetchmail");
					}
				} else {
					$error = _("Validation of input failed");
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
	function edit_fetchmail_account($strip=""){
		if( $strip == 'json' ) {
			$error = false;

			$old_server=$this->input->post('old_server');
			$server=$this->input->post('server');
			$old_protocol=$this->input->post('old_protocol');
			$protocol=$this->input->post('protocol');
			$old_ruser=$this->input->post('old_ruser');
			$ruser=$this->input->post('ruser');
			$pwd=$this->input->post('password');
			$luser=$this->input->post('luser');
			$ssl=$this->input->post('usessl');
			$keep=$this->input->post('keep');

			// TODO remove this uglyness
			$keep = $keep == 'on' ? 'keep' : 'NONE';
			$ssl = $ssl == 'on' ? 'ssl' : 'NONE';
			if( $pwd=="" || is_null($pwd) ){
				$pwd = "\"\"";
			}
			if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$luser) ) {
				$error = _("Authorization failed");
			} else {
				if($server && $protocol && $ruser && $pwd && $luser ){
					update_fetchmailaccount(
						$old_server,
						$old_protocol,
						$old_ruser,
						$server,
						$protocol,
						$ruser,
						$pwd,
						$luser,
						$ssl,
						$keep
					);	
					if(query_service("fetchmail") && !service_running("fetchmail")){
						start_service("fetchmail");
					}
				} else {
					$error = _("Validation of input failed");
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

	function delete_fetchmail_account($strip=""){
		if( $strip == 'json' ) {
			$error = false;

			$server=$this->input->post('server');
			$protocol=$this->input->post('protocol');
			$ruser=$this->input->post('ruser');
			$luser=$this->input->post('luser');

			if( ($this->session->userdata("user")!="admin")&&($this->session->userdata("user")!=$luser) ) {
				$error = _("Authorization failed");
			} else {
				if($server && $protocol && $ruser ){ // XXX luser?
					delete_fetchmailaccount($server,$protocol,$ruser);
					if(query_service("fetchmail") && !service_running("fetchmail")){
						start_service("fetchmail");
					}
				} else {
					$error = _("Validation of input failed");
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

	function mc_update($strip="") {

		$domain=$this->input->post('domain');
		$current_mc = $this->_parse_mailcfg(get_mailcfg());
		$update_postfix = false;
		if( $current_mc["domain"] != $domain ) {
			// domain updated
			write_receive_mailcfg($domain);
			$update_postfix=true;
			$data["update"] = array(
				'success' => true,
				'message' => _('Update successful')
			);
		}

		if($update_postfix){
			if(query_service("postfix")){
				stop_service("postfix");
				start_service("postfix");
			}
		}
		$this->server_settings("",$data);
	}

	function server_update($strip=""){

		$this->Auth_model->enforce_policy('web_admin','administer', 'admin');
	
		$current_mc = $this->_parse_mailcfg(get_mailcfg());

		$smarthost=$this->input->post('smarthost');
		$useauth=$this->input->post('useauth');
		$use_plain_auth=$this->input->post('useunsecure');
		$smtpuser=$this->input->post('smtpuser');
		$smtppasswd=$this->input->post('smtppasswd');
		$smtp_passwd_mask=$this->input->post('smtp_passwd_mask');

		$update_postfix=false;
		$data['update'] = array(
			'success' => true,
			'message' => _("Update successful")
		);

		if(
			$current_mc["smarthost"] != $smarthost ||
			$current_mc["smtp_auth"] != $useauth ||
			$current_mc["smtp_plain_auth"] != $use_plain_auth ||
			$current_mc["smtp_user"] != $smtpuser ||
			$smtppasswd
		) {	// outbound smtp updated
			if($smarthost!="" && $useauth=="yes"){
				if($smtpuser=="" || $smtppasswd==""){
					$data['update'] = array(
						'success' => false,
						'message' => _("Missing mail server password")
					);
				}else{
					write_send_mailcfg($smarthost,true,$smtpuser,$smtppasswd, $use_plain_auth == "yes");
					$update_postfix=true;
				}
			}else{
				write_send_mailcfg($smarthost,false,"","", false);
				$update_postfix=true;
			}
		}
		
		if($update_postfix){
			if(query_service("postfix")){
				stop_service("postfix");
				start_service("postfix");
			}
		}
		$this->server_settings("",$data);
	}	
	
	
	function viewfetchmail($strip=""){

		require_once(APPPATH."/legacy/user_auth.php"); // TODO here?


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
					"keep"=>isset($line[6])?$line[6]:""
				);
			}
		}
		$data["accounts"]=$accounts;

		if( $strip == 'json' ) {
			header("Content-type: application/json");
			echo json_encode( $data );
		} else {
			$data["userlist"]=$this->_getUsers();
			$data["edit_allusers"] = $this->Auth_model->policy("mail","edit_allusers");	


			$this->_renderfull(
				$this->load->view(THEME.'/mail/mail_retrieve_view',$data,true),
				$this->load->view(THEME.'/mail/mail_retrieve_head_view',$data,true)
			);
		}
	}
	
	function server_settings($strip="",$data = array()){

		$this->Auth_model->enforce_policy('web_admin','administer', 'admin');

		$mc=get_mailcfg();
		$data = array_merge($data,$this->_parse_mailcfg($mc));

		$data["receive"] = $this->_get_receivesettings();

		if($strip){
			$this->load->view(THEME.'/mail/mail_server_view',$data);
		}else{
			$this->_renderfull(
				$this->load->view(THEME.'/mail/mail_server_view',$data,true),
				$this->load->view(THEME.'/mail/mail_server_head_view',$data,true),
				$data
			);
		}
	}
	
	function index($strip=""){

		$this->viewfetchmail();

	}

}
