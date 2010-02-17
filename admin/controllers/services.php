<?php
class Services extends Controller{
	
	function Services(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->RequireUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content){
		$mdata["head"] = $this->load->view(THEME.'/services/services_head_view','',true);
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
		$mdata["subnav"]="";
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	
	
	function index($strip=""){
	
		$ftp_enabled = $this->input->post('ftp_enabled');
		$anon_ftp = $this->input->post('anon_ftp');
		$ftp_status=!query_service("proftpd");
		$anon_status=ftp_check_anonymous();

   		$afp_enabled = $this->input->post('afp_enabled');
		$afp_status = query_service("netatalk");

		$daap_status=query_service("mt-daapd");
		$daap_enabled=$this->input->post('daap_enabled');

		$upnp_status=query_service("mediatomb");
		$upnp_enabled=$this->input->post('upnp_enabled');   
   
		$squeezecenter_packagename='squeezecenter';
		$squeezecenter_status=query_service("squeezecenter");
		$squeezecenter_installed=is_installed($squeezecenter_packagename);
		$squeezecenter_enabled=$this->input->post('squeezecenter_enabled');   
   
		$print_status=query_service("cups");
		$print_enabled=$this->input->post('print_enabled');

		$download_status=query_service("filetransferdaemon");
		$download_enabled=$this->input->post('download_enabled');

		$imap_status=query_service("dovecot");
		$imap_enabled=$this->input->post('imap_enabled');

		$fetchmail_status=query_service("fetchmail");
		$fetchmail_enabled=$this->input->post('fetchmail_enabled');

		$smtp_status=query_service("postfix");
		$smtp_enabled=$this->input->post('smtp_enabled');

		if($this->input->post('update')){
			$data['update'] = array(
				'success' => true,
				'message' => "service_update_success",
			);
			$reload_ftp=false;
			
			if($anon_ftp && !$anon_status){
				ftp_set_anonymous(1);
				if($ftp_status){
					add_service("proftpd");
					start_service("proftpd");
					$ftp_status=0;
					$ftp_enabled=1;
				}
				$anon_status=1;
				$reload_ftp=true;
			}else if(!$anon_ftp && $anon_status){
				ftp_set_anonymous(0);
				$anon_status=0;
				$reload_ftp=true;
			}

			if($ftp_enabled && $ftp_status){
				add_service("proftpd");
				start_service("proftpd");
				$ftp_status=0;
			}else if(!$ftp_enabled && !$ftp_status){
				remove_service("proftpd");
				stop_service("proftpd");
				ftp_set_anonymous(0);
				$ftp_status=1;
			}else if($reload_ftp){
				stop_service("proftpd");
				start_service("proftpd");
			}
        
			if($afp_status && !$afp_enabled){
				remove_service("netatalk");
				stop_service("netatalk");
				$afp_status=0;
			}else if(!$afp_status && $afp_enabled){
				add_service("netatalk",50);
				start_service("netatalk");
				$afp_status=1;
			}

			if($daap_status && !$daap_enabled){
				remove_service("mt-daapd");
				stop_service("mt-daapd");
				$daap_status=0;
			}else if(!$daap_status && $daap_enabled){
				add_service("mt-daapd");
				start_service("mt-daapd");
				$daap_status=1;        
			}           

			if($upnp_status && !$upnp_enabled){
				remove_service("mediatomb");
				stop_service("mediatomb");
				$upnp_status=0;
			}else if(!$upnp_status && $upnp_enabled){
				add_service("mediatomb", 26);
				start_service("mediatomb");
				$upnp_status=1;        
			}           
			if($squeezecenter_status && !$squeezecenter_enabled){
				remove_service("squeezecenter");
				stop_service("squeezecenter");
				$squeezecenter_status=0;
			}else if(!$squeezecenter_status && $squeezecenter_enabled){
				add_service("squeezecenter");
				start_service("squeezecenter");
				$squeezecenter_status=1;        
			}       

			if($print_status && !$print_enabled){
				remove_service("cups");
				stop_service("cups");
				$print_status=0;
			}else if(!$print_status && $print_enabled){
				add_service("cups");
				start_service("cups");
				$print_status=1;        
			}

			if($download_status && !$download_enabled){
				remove_service("filetransferdaemon");
				stop_service("filetransferdaemon");
				$download_status=0;
			}else if(!$download_status && $download_enabled){
				add_service("filetransferdaemon");
				start_service("filetransferdaemon");
				$download_status=1;        
			}

			if($fetchmail_status && !$fetchmail_enabled){
				remove_service("fetchmail");
				stop_service("fetchmail");
				$fetchmail_status=0;
			}else if(!$fetchmail_status && $fetchmail_enabled){
				add_service("fetchmail");
				start_service("fetchmail");
				$fetchmail_status=1;        
			}

			if($imap_status && !$imap_enabled){
				remove_service("dovecot");
				stop_service("dovecot");
				$imap_status=0;
			}else if(!$imap_status && $imap_enabled){
				add_service("dovecot");
				start_service("dovecot");
				$imap_status=1;        
			}

			if($smtp_status && !$smtp_enabled){
				remove_service("postfix");
				stop_service("postfix");
				$smtp_status=0;
			}else if(!$smtp_status && $smtp_enabled){
				add_service("postfix");
				start_service("postfix");
				$smtp_status=1;        
			} 			

		}
		$data["ftp_status"]=$ftp_status;
		$data["anon_status"]=$anon_status;
		$data["afp_status"]=$afp_status;
		$data["upnp_status"]=$upnp_status;
		$data["squeezecenter_status"]=$squeezecenter_status;
		$data["squeezecenter_installed"]=$squeezecenter_installed;
		$data["squeezecenter_packagename"]=$squeezecenter_packagename;
		$data["daap_status"]=$daap_status;
		$data["smtp_status"]=$smtp_status;
		$data["imap_status"]=$imap_status;
		$data["fetchmail_status"]=$fetchmail_status;
		$data["print_status"]=$print_status;
		$data["download_status"]=$download_status;

		if($strip){
			$this->load->view(THEME.'/services/services_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/services/services_view',$data,true));
		}
	}

}
?>
