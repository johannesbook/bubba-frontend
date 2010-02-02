<?php

class Settings extends Controller{

	function Settings(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->RequireUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content){

		$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
		if($this->session->userdata("run_wizard")) {
				$mdata["subnav"]="";
				$mdata["content"]="";
				$mdata["wizard"]=$content;
		} else {
				$mdata["subnav"]=$this->load->view(THEME.'/settings/settings_submenu_view','',true);
				$mdata["content"]=$content;
				$mdata["wizard"]="";
		}

		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function _datetime() {

		if(service_running("ntpd")) {
			$data['use_ntp']= true;
		}
		
		$data['t_zone'] = get_current_tz();
		date_default_timezone_set($data['t_zone']);

		$data['t_zoneinfo'] = get_timezone_info();
		if(isset($data['t_zoneinfo']['US'])) {
			unset($data['t_zoneinfo']['US']);
		}
		if(isset($data['t_zoneinfo']['Etc'])) {
			unset($data['t_zoneinfo']['Etc']);
		}
		if(isset($data['t_zoneinfo']['other'])) {
			unset($data['t_zoneinfo']['other']);
		}
		$data['date'] = date("Ymd");
		$data['time'] = date("Hi");

		return $data;
	}
	function netupdate($strip=""){
	
		$hostname = $this->input->post('hostname');
		$workgroup = $this->input->post('workgroup');


		$orig_workgroup=get_workgroup();
		
		$data["success"]=true;
		$data["err_hostinvalid"]=false;		
		$data["err_ip"]=false;
		$data["err_gw"]=false;
		$data["err_dns"]=false;
		$data["err_netmask"]=false;

		$namechange=false;
		$restart_network=false;		
		
		// Check hostname change
		if ($hostname!=php_uname('n')) {	
			if(preg_match("/^[A-Za-z0-9-]+$/",$hostname)){
				//change_hostname($hostname);
				$namechange=true;
			}else{
				$data["err_hostinvalid"]=true;
				$data["success"]=false;			
			}
		}
		
		// Check if workgroup changed
		if ($orig_workgroup!=$workgroup) {
			//set_workgroup($workgroup);
			$namechange=true;
		}
		

		if($data["success"]){
			if($namechange){
				restart_samba();
			}
		
			if ($restart_network) {
				restart_network("eth0");
			}
		}

		$data["namechange"]=$namechange;
		$data["networkrestart"]=$restart_network;
		
		if($strip){
			$this->load->view(THEME.'/settings/settings_netupdate_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_netupdate_view',$data,true));
		}
	}	

	function backup($strip=""){
	
		$this->load->model('disk_model');

		$data["success"]=false;	
		$data["err_nomedia"]=false;
		$data["err_opfailed"]=false;

		$part=$this->input->post("unit");
		if($part && $this->disk_model->is_mounted($part)){
			$info = $this->disk_model->partition_info(substr($part,5));
			$path = $info['mountpath'];
			$mounted = true;
		}else{
			$path = $this->disk_model->mount_partition( $part );
		}
		if(!$path) {
			$data["err_opfailed"]=true;
		} else {
			$data["success"]=!backup_config($path);
			if(!isset($mounted)) {
				// only unmount if not mounted to start with.
				$this->disk_model->umount_partition( $part );
			}
		}

		if($strip){
			$this->load->view(THEME.'/settings/settings_backup_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_backup_view',$data,true));
		}
	}	

	function restore($strip=""){

		$this->load->model('disk_model');

		$data["success"]=false;	
		$data["err_nomedia"]=false;
		$data["err_opfailed"]=false;

		$part=$this->input->post("unit");

		if($part && $this->disk_model->is_mounted($part)){
			$info = $this->disk_model->partition_info(substr($part,5));
			$path = $info['mountpath'];
			$mounted = true;
		}else{
			$path = $this->disk_model->mount_partition( $part );
		}

		$data["success"]=!restore_config($path);
		if(!$data["success"]){
			$data["err_opfailed"]=true;
		}			

		if(!isset($mounted)) {
			$this->disk_model->umount_partition($part);
		}
		
		if($strip){
			$this->load->view(THEME.'/settings/settings_restore_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_restore_view',$data,true));
		}
	}	

	function fwupdate(){
		$this->load->helper('bubba_socket');
		$output = '';
		switch( $this->input->post( 'action' ) ) {
		case 'hotfix_run':
			$enabled = $this->input->post('hotfix_enabled') == 'true';
			update_bubbacfg( 'admin', 'hotfix', $enabled );
			if( $enabled ) {
				if( file_exists('/tmp/bubba-apt.pid') ) {
					$pid = intval(file_get_contents( '/tmp/bubba-apt.pid' ));
					$running=posix_kill($pid, 0);
					if(posix_get_last_error()==1) /* EPERM */
						$running=true;
					if( $running ) {
						$this->output->set_output( json_encode( array( 'done' => 1, 'stop' => 0, 'statusMessage' => 'Upgrade is running' ) ) );
						return;
					}
				} 
			} else {
				$this->output->set_output( json_encode( array( 'done' => 1, 'stop' => 0, 'statusMessage' => 'Hotfix check disabled per request' ) ) );
				return;
			}
			hotfix_run();
			$output = hotfix_query_progress();
			break;
		case 'hotfix_progress':
			$output = hotfix_query_progress();
			break;
		case 'upgrade':
			apt_upgrade_packages();
			$output = apt_query_progress();
			break;
		case 'install':
			apt_install_package( $this->input->post( 'package' ) );
			$output = apt_query_progress();
			break;
		case 'progress':
			$output = apt_query_progress();
			break;
		case 'get_versions':
			$versions = get_package_version("bubba-frontend bubba-backend bubba-album filetransferdaemon squeezecenter");
			$this->session->set_userdata("version",$versions['bubba-frontend']);
			$output = json_encode($versions);
			break;
		}
		syslog( LOG_DEBUG, $output );
		$this->output->set_output($output);
	}
		
	function settraffic($strip=""){
	
		$data["success"]=true;	
		$data["err_srvunavail"]=false;
		$data["err_setulfail"]=false;
		$data["err_setdlfail"]=false;
		$ftd_enabled=query_service("filetransferdaemon");
		if($ftd_enabled){
		
			require_once(IPCFUNCS);
			
			$btdl_throttle=(int)$this->input->post('torrent_download');
			$btul_throttle=(int)$this->input->post('torrent_upload');
			
			if($btdl_throttle<-1){
				$btdl_throttle=-1;
			}

			if($btul_throttle<-1){
				$btul_throttle=-1;
			}

			$dl=new Downloader;
			if(!$dl->set_download_throttle("torrent",$btdl_throttle==-1?-1:$btdl_throttle*1024)){
				/* Failed */
				$data["err_setdlfail"]=true;			
			}
			if(!$dl->set_upload_throttle("torrent",$btul_throttle==-1?-1:$btul_throttle*1024)){
				/* Failed */
				$data["err_setulfail"]=true;			
			}

		}else{
			//Service not running
			$data["success"]=false;
			$data["err_srvunavail"]=true;		
		}
		$data["btul_throttle"]=$btul_throttle;
		$data["btdl_throttle"]=$btdl_throttle;
		$data["ftd_enabled"]=$ftd_enabled;
		$data["completed"] = true;
		
		if($strip){
			$this->load->view(THEME.'/settings/settings_traffic_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_traffic_view',$data,true));
		}
	}
	
	function setdate($strip=""){
		// $strip = -1 will not load any view, instead return "$data"
		$data['success'] = true;
		$uri = THEME.'/settings/settings_setdate_view';

		// -- Get input data
		if($strip == "-1") {
			$wiz_data = $this->input->post('wiz_data');

			$user_tz = $wiz_data['user_tz']; // always exists, but might be ""
			$ntp = isset($wiz_data['use_ntp'])?true:false;
			$date = isset($wiz_data['date'])?$wiz_data['date']:"";
			$time = isset($wiz_data['time'])?$wiz_data['time']:"";		
		} else {
			$ntp = $this->input->post("use_ntp");
			$date=$this->input->post("date");	
			$time=$this->input->post("time");
			$user_tz = $this->input->post("user_tz");
		}


		//  -- timezone --
		if($user_tz) {
			$ret = set_timezone($user_tz);
			if($ret != 0) {
				$error = true;
				$data['success'] = false;
				$data['err']['timezone'] = "Failed to set timezone";
			}
		}
		
		//  -- date and time --
		if(!$ntp) {
			if(service_running("ntpd")) {
				// turn off ntp
				stop_service("ntp");
				remove_service("ntp");
			}

			// -- Set date and time
			$res = set_time($time,$date,$ntp);
			if($res <> 0) {
				$error = true;
				$data['date'] = $date;
				$data['time'] = $time;
				$data['t_zone'] = get_current_tz();
				if($ntp) $data['use_ntp'] = true;
				
				$data['success'] = false;
				$data['err']['timedate'] = "Failed to set date/time";
				$uri = THEME.'/settings/settings_datetime_view';
				unset($data['wiz_data']['postingpage']); // unset to run wizard PREPROCESSING again.
			}
		} else { // use ntp
				if(!service_running("ntpd")) {
				// turn on ntp
				start_service("ntp");
				add_service("ntp");
			}
		}
		
		if(query_service("dovecot") && !service_running("dovecot")) {
			// restart dovecot
			d_print_r("Restart dovecot\n");
			start_service("dovecot");
		}

		if($strip == -1) {
			return $data;
		} else if($strip){
			$this->load->view($uri,$data);
		}else{
			$this->_renderfull($this->load->view($uri,$data,true));
		}
	}	
	
	function trafficsettings($strip=""){
		$trafdata["ftd_enabled"]=query_service("filetransferdaemon");
		if($trafdata["ftd_enabled"]){
			require_once(IPCFUNCS);
			$dl=new Downloader;
			
			$trafdata["btul_throttle"]=$dl->get_upload_throttle("torrent");
			if($trafdata["btul_throttle"]>-1){
				$trafdata["btul_throttle"]=$trafdata["btul_throttle"]/1024;
			}
			$trafdata["btdl_throttle"]=$dl->get_download_throttle("torrent");
			if($trafdata["btdl_throttle"]>-1){
				$trafdata["btdl_throttle"]=$trafdata["btdl_throttle"]/1024;
			}
		}else{
			$trafdata["btul_throttle"]=t('n/a');
			$trafdata["btdl_throttle"]=t('n/a');
		}
		
		$trafdata["completed"] = false;
		if($strip){
			$this->load->view(THEME.'/settings/settings_traffic_view',$trafdata);
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_traffic_view',$trafdata,true));
		}
	}
	
	function datetime($strip=""){
	
		$data = $this->_datetime();
		
		if($strip){
			$this->load->view(THEME.'/settings/settings_datetime_view');		
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_datetime_view',$data,true));
		}
	}

	function backuprestore($strip=""){

		$this->load->model('disk_model');
		$data['disks'] = array();
		$disks=$this->disk_model->list_external_disks(false,true,false,true); // allow removable, not RAID, allow USB, list partitions
		if(sizeof($disks)) {
			foreach($disks as $disk) {
				foreach($disk as $part) {
					$data["disks"][] = $part;
				}
			}
			sort($data["disks"]);
		}
		if($strip){
			$this->load->view(THEME.'/settings/settings_backuprestore_view',$data);		
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_backuprestore_view',$data,true));
		}
	}
	
	function software($action = 'upgrade', $package = null ){
		$data['action'] = $action;
		$data['package'] = $package;
		$hotfix_enabled = query_bubbacfg( 'admin', 'hotfix' );
		if( is_null( $hotfix_enabled ) ) {
			$hotfix_enabled = true;
		}
		$data['hotfix_enabled'] = $hotfix_enabled;
		$this->_renderfull($this->load->view(THEME.'/settings/settings_software_view',$data,true));
	}

	function logs($strip=""){
		$base_path = '/var/log/';
		# mapping of log file name and path
		$logs = array(
			'syslog' => 'syslog',
			'auth.log' => 'auth.log',
			'daemon.log' => 'daemon.log',
			'debug' => 'debug',
			'dpkg.log' => 'dpkg.log',
			'faillog' => 'faillog',
			'kern.log' => 'kern.log',
			'mail.log' => 'mail.log',
			'mediatomb.log' => 'mediatomb.log',
			'user.log' => 'user.log',
			'horde' => array(
				'horde' => 'horde/horde3.log',
			),
			'samba' => array(
				'log.all' => 'samba/log.all',
				'log.nmbd' => 'samba/log.nmbd',
				'log.smbd' => 'samba/log.smbd',
			),
			'apache2' => array(
				'access.log' => 'apache2/access.log',
				'error.log' => 'apache2/error.log',
			),
			'cups' => array(
				'access_log' => 'cups/access_log',
				'error_log' => 'cups/error_log',
			),
			'proftpd' => array(
				'controls.log' => 'proftpd/controls.log',
				'proftpd.log' => 'proftpd/proftpd.log',
				'xferlog' => 'proftpd/xferlog',
				'xferreport' => 'proftpd/xferreport',
			),


		);
		
		function array_values_recursive($array) {
			$flat = array();

			foreach ($array as $value) {
				if (is_array($value)){
					$flat = array_merge($flat, array_values_recursive($value));
				}else{
					$flat[] = $value;
				}
			}
			return $flat;
		}

		if($this->input->post('log') ){
			$current_log = $this->input->post('log');
			if( in_array( $current_log, array_values_recursive($logs) ) ) {
				$filename = $current_log;
				$data['log_name'] = $current_log;
				$data['content'] = dump_file($base_path.$filename);
			}
		}
		$data['logs']=$logs;
		if($strip){
			$this->load->view(THEME.'/settings/settings_logs_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_logs_view',$data,true));
		}
	}


	function index($strip=""){

		if($this->session->userdata("run_wizard")) {
			$this->wizard();
		} else {
			$this->startwizard();
		}

	}

	function startwizard($strip="") {
		if($strip){
			$this->load->view(THEME.'/settings/settings_wizard_view',"");
		}else{
			$this->_renderfull($this->load->view(THEME.'/settings/settings_wizard_view',"",true));
		}
	}		

	function wizard($strip="") {
	
		$data['wiz_data'] = $this->input->post('wiz_data');

		if(isset($data['wiz_data']['start'])) {
			$this->session->set_userdata("run_wizard", true);
		}

		// should not be needed, no back functions from first page.
		if(isset($data['wiz_data']['back'])) {
			redirect("/stat/wizard");
		}

		if(isset($data['wiz_data']['cancel'])) {
			exit_wizard();
		}
		
		if(!$this->session->userdata("run_wizard")) {
			redirect("/stat");
			
		} else {
			
			// ------------ WIZARD START -------------
			
			if(isset($data['wiz_data']['postingpage'])) {
				// --- POSTPROCESSING SETTINGS ----
				//d_print_r("POSTPROCESS: settings");
				//d_print_r($data);
				
				$res = $this->setdate("-1"); 
				
			}
			if(!isset($data['wiz_data']['postingpage'])) {
				// --- PREPROCESSING SETTINGS ----
				//d_print_r("PREPROCESS: settings");
				
				if(service_running("ntpd")) {
					$data['wiz_data']['use_ntp']= true;
				}
				
				$data['wiz_data']['t_zone'] = get_current_tz();
				date_default_timezone_set($data['wiz_data']['t_zone']);

				$data['wiz_data']['t_zoneinfo'] = get_timezone_info();

				$data['wiz_data']['date'] = date("Ymd");
				$data['wiz_data']['time'] = date("Hi");
			}

			// --- LOADING view SETTINGS ----
			//d_print_r("LOADING view\n");
			//d_print_r($data);
			if(isset($error) || (!isset($data['wiz_data']['postingpage'])) ) { // if error or called from "stat" controller load the same view again.
				if($strip){
					$this->load->view($this->load->view(THEME.'/settings/settings_wizard_view',$data));
				}else{
					$this->_renderfull($this->load->view(THEME.'/settings/settings_wizard_view',$data,true));
				}
			} else {
				redirect("users/wizard");
			}
		}
	}

}

?>
