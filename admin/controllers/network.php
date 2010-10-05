<?php

class Network extends Controller{

	function Network(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->enforce_policy('web_admin','administer', 'admin');
		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
		$this->load->helper('network');
		$this->load->model('networkmanager');
	}


	function _renderfull($content, $head = '/network/network_head_view', $data = ''){

		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		if($this->session->userdata("run_wizard")) {
			$mdata["dialog_menu"] = "";
			$mdata["head"] = $this->load->view(THEME.$head,$data,true);
			$mdata["content"]="";
			$mdata["wizard"]=$content;
		} else {
			$dialog_menu["main_menu"] = $this->menu->get_dialog_menu();
			$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
			$mdata["head"] = $this->load->view(THEME.$head,$data,true);
			$mdata["content"]=$content;
			$mdata["wizard"]="";
		}
		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function wanupdate($strip=""){

		if ($this->session->userdata("network_profile") == "router") {
			$data["disable_gw"] = 0;
		} else {
			if( $this->session->userdata("network_profile") != "server" ) {
				$data['disable_network'] = true;
			}
			$data["disable_gw"] = 1;
		}			

		$ip=$this->input->post("IP");
		$mask=$this->input->post('mask');
		$gw=$this->input->post('gw');
		$dns=$this->input->post('dns');

		$netcfg = $this->input->post('netcfg');
		$restart = false;
		$data["err_ip"] = false;
		$data["err_gw"] = false;
		$data["err_mask"] = false;
		$data["err_dns"] = false;

		$ifc=$this->networkmanager->get_networkconfig($this->networkmanager->get_wan_interface());
		$data["dhcp"]=$ifc["dhcp"];
		$oip = parse_ip( $ifc["address"] );
		$omask = parse_ip( $ifc["netmask"] );		
		$ogw = parse_ip( $ifc["gateway"] );		
		$odns = parse_ip( $ifc["dns"] );

		// Has the user changed network configuration?	
		if ( $netcfg=="static" ) {
			$err=false;
			$data["oip"] = $ip;	
			$data["ogw"] = $gw;	
			$data["odns"] = $dns;	
			$data["omask"] = $mask;
			if($ip==$oip && $mask==$omask && $gw==$ogw && $dns==$odns){
				// No change of ip
				//Did they change from dhcp
				if($data["dhcp"]){
					$cfg=array(
						"address"=>array("$ip[0].$ip[1].$ip[2].$ip[3]"),
						"netmask"=>array("$mask[0].$mask[1].$mask[2].$mask[3]"),
						"gateway"=>array("$gw[0].$gw[1].$gw[2].$gw[3]"));
					$this->networkmanager->setstatic($this->networkmanager->get_wan_interface(),$cfg);

					$this->networkmanager->setns(array("servers"=>array("$dns[0].$dns[1].$dns[2].$dns[3]")));

					$restart_network=true;
					$data["dhcp"] = false;	
				}
			}else{
				// IP data changed

				$data["dhcp"] = false;	

				if(!validate_ip($ip)){
					$data["err_ip"]=$err=true;
				}
				if(!validate_ip($mask)){
					$data["err_mask"]=$err=true;
				}
				if($gw && !validate_ip($gw)){
					$data["err_gw"]=$err=true;
				}
				if($dns && !validate_ip($dns)){
					$data["err_dns"]=$err=true;
				}
				if(!$err){
					$cfg=array(
						"address"=>array("$ip[0].$ip[1].$ip[2].$ip[3]"),
						"netmask"=>array("$mask[0].$mask[1].$mask[2].$mask[3]"),
						"gateway"=>array("$gw[0].$gw[1].$gw[2].$gw[3]"));
					$this->networkmanager->setstatic($this->networkmanager->get_wan_interface(),$cfg);

					$this->networkmanager->setns(array("servers"=>array("$dns[0].$dns[1].$dns[2].$dns[3]")));

					$restart=true;
				}else{
					$data["success"]=false;
				}	
			}

		}else{
			// DHCP selected
			if($data["dhcp"]){
			}else{
				// User changed from static to dynamic ip
				$this->networkmanager->setdynamic($this->networkmanager->get_wan_interface());
				$restart=true;
			}
		}
		if($restart) {
			$this->networkmanager->ifrestart($this->networkmanager->get_wan_interface());
		}

		$ifc=$this->networkmanager->get_networkconfig($this->networkmanager->get_wan_interface(),true); // force reread network config

		$data["oip"] = parse_ip( $ifc["address"] );
		$data["omask"] = parse_ip( $ifc["netmask"] );		
		$data["ogw"] = parse_ip( $ifc["gateway"] );		
		$data["odns"] = parse_ip( $ifc["dns"] );
		$data["dhcp"]=$ifc["dhcp"];	

		$this->_renderfull($this->load->view(THEME.'/network/network_wan_view.php',$data,true));

	}

	function lanupdate($strip=""){

		if ($this->session->userdata("network_profile") == "server") {
			$data["disable_gw"] = 0;
		} else {
			if( $this->session->userdata("network_profile") != "router" ) {
				$data['disable_network'] = true;
			}
			$data["disable_gw"] = 1;
		}

		$restart = false;		
		$data["success"]="success";
		$data["err_ip"]=false;
		$data["err_netmask"]=false;
		$data["err_dnsmasq"]["dns"]=false;
		$data["err_dnsmasq"]["dhcpd"]=false;		
		$data["err_dnsmasq"]["dhcpdrange"]=false;
		$data["update"]=true;

		// Get post
		$data["olip"]=$this->input->post("ip");
		$data["olmask"]=$this->input->post('mask');
		$data["olgw"]=$this->input->post('gw');
		$data["oldns"]=$this->input->post('dns');
		$data["jumbo"]=$this->input->post('jumbo');;

		// Check mtu change
		$mtu=$this->networkmanager->get_mtu($this->networkmanager->get_lan_interface());
		if($mtu!=9000 && $data["jumbo"]){
			// Turn jumbo on
			set_mtu(9000);
		}else if($mtu==9000 && !$data["jumbo"]){
			// Turn jumbo off
			set_mtu(1500);
		}

		// Get original config
		$lifc=$this->networkmanager->get_networkconfig($this->networkmanager->get_lan_interface());

		$ip = parse_ip( $lifc["address"] );
		$mask = parse_ip( $lifc["netmask"] );
		$gw = parse_ip( $lifc["gateway"] );
		$dns = parse_ip( $lifc["dns"] );

		// LAN IP settings
		if(strcmp($this->input->post('netcfg'),"static")) {  // inverted match
			// dhcp selected
			$data["dhcp"] = true;
			if($lifc["dhcp"]){
			}else{
				// User changed from static to dynamic ip
				$this->networkmanager->setdynamic($this->networkmanager->get_lan_interface());
				$restart = true;
			}
		} else {
			// static is selected
			d_print_r("STATIC selected");
			d_print_r($ip);
			d_print_r($data["olip"]);
			$data["dhcp"] = false;
			if(!validate_ip($data["olip"])){
				$data["err_ip"]=true;
				$data["success"]=false;
			}else if(!validate_ip($data["olmask"])){
				$data["err_netmask"]=true;
				$data["success"]=false;
			}else if($data["olgw"] && (!validate_ip($data["olgw"])) ){
				$data["err_gw"]=true;
				$data["success"]=false;
			}else if($data["oldns"] && (!validate_ip($data["oldns"])) ){
				$data["err_dns"]=true;
				$data["success"]=false;
			}else{
				if( $lifc["dhcp"] ||
					($ip!=$data["olip"]) || 
					($mask!=$data["olmask"]) ||
					($gw!=$data["olgw"]) ||
					($dns!=$data["oldns"])
				){
					d_print_r("Config changed");
					// config changed

					$cfg=array(
						"address"=>array(implode(".",$data["olip"])),
						"netmask"=>array(implode(".",$data["olmask"]))
					);

					if($data["olgw"] && $data["oldns"]) {

						if(intval($data["olgw"][0])!=0){
							$cfg["gateway"]=array(implode(".",$data["olgw"]));
						}

						$this->networkmanager->setstatic($this->networkmanager->get_lan_interface(),$cfg);

						$this->networkmanager->setns(array("servers"=>array(implode(".",$data["oldns"]))));
					} else {
						$this->networkmanager->setstatic($this->networkmanager->get_lan_interface(),$cfg);
					}
					$restart = true;
				}
			}
		}
		if($restart) {
			$this->networkmanager->ifrestart($this->networkmanager->get_lan_interface());
			$lifc=$this->networkmanager->get_networkconfig($this->networkmanager->get_lan_interface(),true);  // force reread network config
			$data["olip"] = parse_ip( $lifc["address"] );
			$data["olmask"] = parse_ip( $lifc["netmask"] );
		}
		// DNSMASQ settings
		$dnsmasq = $this->input->post('dnsmasq');
		$valid_range = true;
		if(isset($dnsmasq["dhcpd"])) {

			$valid_range = validate_ip_range($dnsmasq["range_start"],$dnsmasq["range_end"],$data["olip"],$data["olmask"]);
		}
		if ($valid_range==false) {
			$data["err_dnsmasq"]["dhcpdrange"] = true;
			$data["dnsmasq_settings"] = $dnsmasq;
			// if range fails deactivate dhcpd
			$dnsmasq["dhcpd"]=0;
			configure_dnsmasq($dnsmasq);
			$data["dnsmasq_settings"]=get_dnsmasq_settings();
		} else {
			if($data["success"]) {  // only update if LAN is ok.
				$data["err_dnsmasq"] = configure_dnsmasq($dnsmasq);
				$data["dnsmasq_settings"]=get_dnsmasq_settings();
			} else {
				if(!isset($dnsmasq["dhcpd"])) $dnsmasq["dhcpd"]="";  
				$data["dnsmasq_settings"] = $dnsmasq;
			}		
		}	

		$data["olgw"] = parse_ip( $lifc["gateway"] );		
		$data["oldns"] = parse_ip( $lifc["dns"] );

		$data["dhcpd_leases"] = get_leases();


		$data["dhcpd"]=!$data['dhcp'];
		if(!$data["success"]) {
			$data['update_msg'] = t("Error applying settings");
		} else {
			$data['update_msg'] = t("LAN configuration updated");
		}
		if($strip){
			$this->load->view(THEME.'/network/network_lan_view.php',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/network/network_lan_view.php',$data,true));
		}

	}

	function fwupdate($strip="") {

		d_print_r($_POST);
		$data["success"]=false;
		$data["updated"]=true;
		$errmsg = "";

		$current_fw = get_fwsettings();

		if($update=$this->input->post("update")) { // Updating open ports

			$B2port = array(); 
			//Get post
			if($data["allowFTP"]=$this->input->post("allowFTP")) {
				// allow FTP
				if($current_fw["allowFTP"]) { 
					// already allowed do nothing.
				} else { 
					$B2port[21]=true;
				}
			} else { 
				// close FTP
				if($current_fw["allowFTP"]) { 
					// Allowed, close port
					$B2port[21]=false;
				} else { 
					// already closed, do nothing.
				}
			}

			if($data["allowSSH"]=$this->input->post("allowSSH")) {
				// allow SSH
				if($current_fw["allowSSH"]) { 
					// already allowed do nothing.
				} else { 
					$B2port[22]=true;
				}
			} else { 
				// close SSH
				if($current_fw["allowSSH"]) { 
					// Allowed, close port
					$B2port[22]=false;
				} else { 
					// already closed, do nothing.
				}
			}

			if($data["allowWWW"]=$this->input->post("allowWWW")) {
				// allow WWW
				if($current_fw["allowWWW"]) { 
					// already allowed do nothing.
				} else { 
					$B2port[80]=true;
				}
			} else { 
				// close WWW
				if($current_fw["allowWWW"]) { 
					// Allowed, close port
					$B2port[80]=false;
				} else { 
					// already closed, do nothing.
				}
			}

			if($data["allowPing"]=$this->input->post("allowPing")) {
				// allow ping
				if($current_fw["allowPing"]) { 
					// already allowed do nothing.
				} else { 
					$B2port["ping"]=true;
				}
			} else { 
				// close ping
				if($current_fw["allowPing"]) { 
					// Allowed, close port
					$B2port["ping"]=false;
				} else { 
					// already closed, do nothing.
				}
			}

			if($data["allowMail"]=$this->input->post("allowMail")) {
				// allow Mail
				if($current_fw["allowMail"]) { 
					// already allowed do nothing.
				} else { 
					$B2port[25]=true;
				}
			} else { 
				// close Mail
				if($current_fw["allowMail"]) { 
					// Allowed, close port
					$B2port[25]=false;
				} else { 
					// already closed, do nothing.
				}
			}

			if($data["allowIMAP"]=$this->input->post("allowIMAP")) {
				// allow Mail
				if($current_fw["allowIMAP"]) { 
					// already allowed do nothing.
				} else { 
					$B2port[143]=true;
				}
			} else { 
				// close IMAP
				if($current_fw["allowIMAP"]) { 
					// Allowed, close port
					$B2port[143]=false;
				} else { 
					// already closed, do nothing.
				}
			}

			if($data["allowTorrent"]=$this->input->post("allowTorrent")) {
				// allow Torrentports
				if($current_fw["allowTorrent"]) { 
					// already allowed do nothing.
				} else { 
					$B2port["10000:14000"]=true;
				}
			} else { 
				// close Torrentports
				if($current_fw["allowTorrent"]) { 
					// Allowed, close port
					$B2port["10000:14000"]=false;
				} else { 
					// already closed, do nothing.
				}
			}

			//printf("data:   Update integrated service, allow SSH: %s, WWW: %s,FTP: %s, Ping: %s<br>\n",$data["allowSSH"],$data["allowWWW"],$data["allowFTP"],$data["allowPing"]);
			$data["success"]&=fw_updateservices($B2port);

		}



		/////--- ADD/EDIT PORTFORWARD -------
		// create datastructure for update PORTFORWARD
		if($this->input->post("newport")) {
			$expand = true;
			$errmsg = array();
			$new_port["to_ip"]=$this->input->post("to_ip");
			$new_port["dport"]=$this->input->post("dport");
			$new_port["to_port"]=$this->input->post("to_port");
			$new_port["protocol"]=$this->input->post("protocol");
			$new_port["source"]=$this->input->post("source");
			$new_port["portforward"]=$this->input->post("portforward");

			$old_port["to_ip"]=$this->input->post("o_to_ip");
			$old_port["dport"]=$this->input->post("o_dport");
			$old_port["to_port"]=$this->input->post("o_to_port");
			$old_port["protocol"]=$this->input->post("o_protocol");
			$old_port["source"]=$this->input->post("o_source");
			$old_port["portforward"]=$this->input->post("o_portforward");

			$portforward = $this->input->post("portforward");			

			// detect if it is an edited port
			$edit = true;
			if($old_port["dport"]) {
				$edit = false;
				foreach ($new_port as $key => $val) {
					if(($old_port[$key] != $new_port[$key]) ) {
						$edit = true;
						break;
					}
				}

				if(!$edit) {
					$errmsg["add"] = "No change in port configuration"; 
				}
			}

			if($new_port["source"] == "all") $new_port["source"]="0";
			if($old_port["source"] == "all") $old_port["source"]="0";


			if($edit) {
				// get current network configuration
				$ifc=get_networkconfig($this->networkmanager->get_lan_interface());
				$new_port["serverip"] = $ifc[0];
				$new_port["netmask"] = $ifc[1];

				$mask = parse_ip($ifc[1]);
				$ip = parse_ip($ifc[0]);
				$port_ip = parse_ip($new_port["to_ip"]);
				if($portforward) { // only validate IP if it is a portforward
					$valid_ip = validate_ip($port_ip);
					if($valid_ip) {
						$oct_index=0;
						foreach($ip as $oct) {
							if(!( ((int)$oct & (int)$mask[$oct_index]) == ((int)$port_ip[$oct_index] & (int)$mask[$oct_index])) ) {
								$errmsg["to_ip"] = t("Invalid private IP.")."<br>".t("LAN is on")." "."$ifc[0] / $ifc[1]";
								break;
							}
							$oct_index++;
						}
					} else {
						$errmsg["to_ip"] = "Invalid private IP";

					}
				}

				if(!validate_ports($new_port["dport"])) {
					$errmsg["dport"] = "Invalid public port";
				}

				if($portforward) { // only validate private port if it is a portforward
					if(!validate_ports($new_port["to_port"])) {
						$errmsg["to_port"] = "Invalid private port";
					}
				}

				if($new_port["source"]) { // only validate source if it is set.
					$sourceip = explode("\/",$new_port["source"]);
					if(!validate_ip(parse_ip($sourceip[0]))) {
						$errmsg["source"] = "Invalid source IP";
					}
				}
				d_print_r($errmsg);
				if($errmsg) {
					//print "Error: $errmsg<br>\n";
					$data["success"] = false;
				} else {
					// Update portforwards
					if($portforward) { 
						if ($old_port["dport"]) {
							// Remove old port, otherwise it will (most likely)
							// conflict with the new entry
							if($rm_msg = rm_portforward($old_port)) {
								$errmsg["rm"] = $rm_msg[0];
							} 
						}
						if(!$errmsg) {  // only add if the remove succeded.
							if($add_msg = add_portforward($new_port)) {
								$errmsg["add"] = $add_msg[0];
							} 
						}
						// Update Bubba|2 port
					} else { 
						if ($old_port["dport"]) {
							// Remove old port, otherwise it will (most likely)
							// conflict with the new entry
							if($rm_msg = close_port($old_port)) {
								$errmsg["rm"] = $rm_msg[0];
							} 
						}
						if(!$errmsg) {  // only add if the remove succeded.
							if($add_msg = open_port($new_port)) {
								$errmsg["add"] = $add_msg[0];
							} 
						}

					}
				}
			}
		}


		/////--- REMOVE PORTFORWARD -------
		// create portlist to remove from forwards.
		// Remove portforward
		if($removerule=$this->input->post("removerule")) {
			$expand = true;
			if($removerule["source"] == "all")
				$removerule["source"] = "0";

			if(!$removerule["to_port"]) { // this is a userdefined "Bubba|2 port"
				$rm_msg = close_port($removerule);
			} else {
				$rm_msg = rm_portforward($removerule);
			} 			  
			if($rm_msg)
				$errmsg["rm"] = $rm_msg[0];
		}		

		// read back settings to make sure they have taken.
		$data = get_fwsettings();

		if(!isset($portforward)) // default is portforward
			$portforward = true;
		if($portforward) {
			$data["disabled"] = "";
			$data["portforward"] = true;
		} else {
			$data["disabled"] = "disabled=\"disabled\"";
			$data["portforward"] = false;
		}      

		if($errmsg) {
			//print "Error: $errmsg<br>\n";
			$data["success"] = false;
			$data["err_portforward"] = $errmsg;
			if(isset($new_port)) {
				$data["new_port"] = $new_port;
			}
		} else {
			$data["success"] = true;
		}
		if(isset($expand)) $data["expand"] = $expand;
		if($strip){
			$this->load->view(THEME.'/network/network_fw_view.php',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/network/network_fw_view.php',$data,true));
		}
	}

	function wan($strip=""){
		$ifc=$this->networkmanager->get_networkconfig($this->networkmanager->get_wan_interface());

		if ($this->session->userdata("network_profile") == "router") {
			$data["disable_gw"] = 0;
		} else {
			if( $this->session->userdata("network_profile") != "server" ) {
				$data['disable_network'] = true;
			}
			$data["disable_gw"] = 1;
		}			

		$data["oip"] = parse_ip( $ifc["address"] );
		$data["omask"] = parse_ip( $ifc["netmask"] );		
		$data["ogw"] = parse_ip( $ifc["gateway"] );		
		$data["odns"] = parse_ip( $ifc["dns"] );
		$data["dhcp"]=$ifc["dhcp"];	

		$data["err_ip"] = false;
		$data["err_gw"] = false;
		$data["err_mask"] = false;
		$data["err_dns"] = false;

		if($strip){
			$this->load->view(THEME.'/network/network_wan_view.php',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/network/network_wan_view.php',$data,true));
		}
	}

	function lan($strip=""){


		$lifc=$this->networkmanager->get_networkconfig($this->networkmanager->get_lan_interface());
		$data["dhcp"] = $lifc["dhcp"];
		$data["dhcpd"]=!$data['dhcp'];
		$data["jumbo"]=$this->networkmanager->get_mtu($this->networkmanager->get_lan_interface())==9000?true:false;

		if ($this->session->userdata("network_profile") == "server") {
			$data["disable_gw"] = 0;
		} else {
			if( $this->session->userdata("network_profile") != "router" ) {
				$data['disable_network'] = true;
			}
			$data["disable_gw"] = 1;
		}

		$data["dnsmasq_settings"]=get_dnsmasq_settings();
		if(!$data['dnsmasq_settings']['running']) {
			$data["dnsmasq_settings"]["dhcpd"]=0;
		}
		$data["dhcpd_leases"] = get_leases();

		if(count($lifc)>0){
			$data["olip"] = parse_ip( $lifc["address"] );
			$data["olmask"] = parse_ip( $lifc["netmask"] );
			$data["olgw"] = parse_ip( $lifc["gateway"] );
			$data["oldns"] = parse_ip( $lifc["dns"] );
			$data["success"]=true;
		}else{
			$data["success"]=false;
			$data["err_iface"]=true;
			$data["olip"]="";
			$data["olmask"]="";
			$data["olgw"]="";		
			$data["oldns"]="";
		}

		$data["update"]=0;
		if($strip){
			$this->load->view(THEME.'/network/network_lan_view.php',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/network/network_lan_view.php',$data,true));
		}
	}

	function wlan($strip="",$msg=""){
		$conf=parse_ini_file("/home/admin/.bubbacfg");
		$data['wlan_configurable'] = $this->networkmanager->exists_wlan_card() 
					&& $this->session->userdata("network_profile") != "custom"
					&& get_current_tz() != "UTC";
		
		if($msg == "update") {
			$data['update'] = 1; // indicate that the user has pressed update with green status bar.
			$data['success'] = "success";
			$data['update_msg'] = "wLAN configuration updated.";
		} elseif ($msg == "error") {
			$data['update'] = 1; // indicate that the user has pressed update with green status bar.
			$data['success'] = "fail";
			$data['update_msg'] = "Error in wLAN configuration.";
		}			
	
		$data['ssid'] = $this->networkmanager->get_current_wlan_ssid();
		$data['enabled'] = $this->networkmanager->wlan_enabled();
		$ieee80211_mode =  $this->networkmanager->get_wlan_current_mode();
		switch( $ieee80211_mode ) {
		case 'b':
		case 'g':
			$band = 1;
			break;
		case 'a':
			$band = 2;
			break;
		}
		$data['current_band'] = $band;

		$ieee80211n = $this->networkmanager->is_802_11n_activated();
		$greenfield = $this->networkmanager->wlan_greenfield_active();
		if( $greenfield && $ieee80211n ) {
			$mode = 'greenfield';
		} elseif ( $ieee80211n ) {
			$mode = 'mixed';
		} else {
			$mode = 'legacy';
		}
		$data['ieee80211n'] = $ieee80211n;
		$data['current_mode'] = $mode;

		$data['current_channel'] = $this->networkmanager->get_wlan_current_channel();

		$data['encryptions'] = $this->networkmanager->get_available_wlan_encryptions();
		$data['current_encryption'] = $this->networkmanager->get_current_wlan_encryption();
		$data['encryption_key'] = $this->networkmanager->get_wlan_encryption_key();

		$data['broadcast_ssid'] = $this->networkmanager->get_wlan_broadcast_ssid();

		$data['current_width'] = $this->networkmanager->wlan_ht40_active() ? 40 : 20;
		try {
			$data['capabilities'] = $this->networkmanager->get_wlan_capabilities();
		} catch( Exception $e ) {
			$data['capabilities'] = array();
		}

		try {
			$data['bands'] = $this->networkmanager->get_wlan_bands();
		} catch( Exception $e ) {
			$data['bands'] = array();
		}

		if($strip){
			$this->load->view(THEME.'/network/network_wlan_view.php',$data);
		}else{
			$this->_renderfull(
				$this->load->view(THEME.'/network/network_wlan_view.php',$data,true),
				'/network/network_wlan_head_view.php'
			);
		}
	}

	function wlanupdate($strip=""){

		$enabled = $this->input->post('enabled');
		$encryption = $this->input->post('encryption');
		$ssid = $this->input->post('ssid');
		$broadcast_ssid = $this->input->post('broadcast_ssid');
		$width = $this->input->post('width');
		$mode = $this->input->post('mode');
		$band = (int) $this->input->post('band');
		$channel = (int) $this->input->post('channel');
		$password =  $this->input->post("password");
		$capabilities = $this->networkmanager->get_wlan_capabilities();

		# Simple validation to prevent destruction
		if( 
			$ssid === false
			|| $mode === false 
			|| $encryption === false 
			|| $channel === false
			|| strlen($ssid) > 32 
			|| $channel <= 0
			|| ( 
				$encryption == 'wep' 
				&& ! in_array( strlen( $password ), array( 5, 13 ) ) 
			)
			|| (
				in_array( $encryption , array( 'wpa1', 'wpa2', 'wpa12' ) )
				&& (
					strlen( $password ) < 8
					|| strlen ( $password ) > 63
				)
			)
			|| ( $mode == 'greenfield' && ! $capabilities['RX_GF'] )

		)
		{
			//redirect( 'network/wlan/0/error' );
			if($strip){
				redirect("/network/wlan");
			}else{
				$this->_renderfull(
					$this->wlan(0,"error"),
					'/network/network_wlan_head_view.php'
				);
			}

		}

		$this->networkmanager->set_wlan_ssid( $this->networkmanager->get_wlan_interface(), $ssid );
		
		if( $broadcast_ssid ) {
			$this->networkmanager->enable_wlan_broadcast_ssid();
		} else {
			$this->networkmanager->disable_wlan_broadcast_ssid();
		}

		if( $band == 2 ) {
			$this->networkmanager->set_wlan_mode( $this->networkmanager->get_wlan_interface(), 'a' );
		} else {
			$this->networkmanager->set_wlan_mode( $this->networkmanager->get_wlan_interface(), 'g' );
		}

		$this->networkmanager->set_wlan_channel( $this->networkmanager->get_wlan_interface(), $channel );

		$ht_capab = array();


		if( $mode == "greenfield" ) {
			$this->networkmanager->enable_wlan_802_11n();
			$width = 40; // Greenfield mode requires 40MHz
			$ht_capab[] = "GF";
			if($capabilities['TX_STBC']) {
				$ht_capab[] = "TX-STBC";
			}
			switch($capabilities['RX_STBC']) {
			case 1:
				$ht_capab[] = "RX-STBC1";
				break;
			case 2:
				$ht_capab[] = "RX-STBC12";
				break;
			case 3:
				$ht_capab[] = "RX-STBC123";
				break;
			}
			if($capabilities['RX_LDPC']) {
				$ht_capab[] = "LDPC";
			}
		} elseif( $mode == "mixed" ) {
			$this->networkmanager->enable_wlan_802_11n();
			if($capabilities['L_SIG_TXOP']) {
				$ht_capab[] = "LSIG-TXOP-PROT";
			}
			if($capabilities['TX_STBC']) {
				$ht_capab[] = "TX-STBC";
			}
			switch($capabilities['RX_STBC']) {
			case 1:
				$ht_capab[] = "RX-STBC1";
				break;
			case 2:
				$ht_capab[] = "RX-STBC12";
				break;
			case 3:
				$ht_capab[] = "RX-STBC123";
				break;
			}
			if($capabilities['RX_LDPC']) {
				$ht_capab[] = "LDPC";
			}

		} else { // legacy
			$this->networkmanager->disable_wlan_802_11n();
			$width = 20; //override, as we don't need it
		}


		if( $width == 40 ) {
			switch( $channel ) {
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			case 36:
			case 44:
			case 52:
			case 60:
				$ht_capab[] = "HT40+";
				break;
			case 8:
			case 9:
			case 10:
			case 11:
			case 12:
			case 13:
			case 14:
			case 40:
			case 48:
			case 56:
			case 64:
			default:
				$ht_capab[] = "HT40-";
				break;
			}
		}

		$this->networkmanager->set_wlan_ht_capab( $ht_capab );

		# TODO wep defaultkey
		$this->networkmanager->set_wlan_encryption(
			$this->networkmanager->get_wlan_interface(), 
			$encryption, 
			array( $password ), 
			0 
		);

		$restart = $enabled && service_running("hostapd");

		if( $enabled ) {
			$this->networkmanager->enable_wlan();
		} else {
			$this->networkmanager->disable_wlan();
		}

		// Restart hostapd to make sure we are in a consistent mode
		if($restart){
			invoke_rc_d( "hostapd", "restart" );
		} 

		if($strip){
			redirect("/network/wlan");
		}else{
			$this->wlan(0,"update");
		}


	}


	function fw($strip="") {
		$data = get_fwsettings();
		$wan_ifc = $this->networkmanager->get_networkconfig($this->networkmanager->get_wan_interface());
		if($wan_ifc["address"] == "0.0.0.0") {		
			$data['disable_fw'] = true;
		}
		$data["disabled"] = "";
		$data["portforward"] = true;
		if($strip){
			$this->load->view(THEME.'/network/network_fw_view.php',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/network/network_fw_view.php',$data,true));
		}	
	}

	function profile($strip=""){

		if(!$this->session->userdata("network_profile")) {
			// this will happen on "old" systems that has no profile
			$this->session->set_userdata("network_profile", "custom");      
		}

		if( ($this->session->userdata("network_profile")=="router") ||
			($this->session->userdata("network_profile")=="server") || 
			($this->session->userdata("network_profile")=="auto") )  {

				$data[$this->session->userdata("network_profile")] = 'checked="checked"';

				$data['custom'] = false;
			} else {
				$data['custom'] = true;
			}

		$data['profile'] = $this->session->userdata("network_profile");
		$data['update'] = 0;
		if($strip){
			$this->load->view(THEME.'/network/network_profile_view.php',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/network/network_profile_view.php',$data,true));
		}
	}

	function update_profile($strip=""){

		$profile = $this->input->post('profile');
		$old_profile = $this->session->userdata("network_profile");

		if(!$profile || !$old_profile) {
			redirect('/network/profile');
		}

		$data['profile'] = $profile;
		$data['update'] = 1; // indicate that the user has pressed update with green status bar.
		$data['success'] = "success";
		$data['update_msg'] = "Network profile set to $profile";
		$data['custom'] = false;

		if( $old_profile != $profile) {
			// Profile updated
			update_bubbacfg($this->session->userdata('user'),'network_profile',$profile);
			$this->session->set_userdata("network_profile", $profile);
			$this->networkmanager->apply_profile($profile,$old_profile);
		}
		$data[$this->session->userdata("network_profile")] = 'checked="checked"';

		if($strip){
			$this->load->view($this->load->view(THEME.'/network/network_profile_view',$data));
		}else{
			$this->_renderfull($this->load->view(THEME.'/network/network_profile_view',$data,true));
		}
	}

	function index($strip=""){
		$this->profile();
	}

	function confirm_profile($strip="") {
		$wiz_data = $this->input->post('wiz_data');
		if(isset($wiz_data['confirm'])) {
			$this->networkmanager->apply_profile($this->session->userdata("profile"),$this->session->userdata("status"));
			// setup complete
		}
		exit_wizard();
		redirect("/stat");
	}

	function wizard($strip="") {

		$data['wiz_data'] = $this->input->post('wiz_data');
		if(isset($data['wiz_data']['back'])) {
			redirect("/users/wizard");
		}
		if(isB3()) {
			$data['wiz_data']['easyfind']['domain'] = B3_EASYFINDDOMAIN;
		} else {
			$data['wiz_data']['easyfind']['domain'] = DEFAULT_EASYFINDDOMAIN;
		}

		if(isset($data['wiz_data']['cancel'])) {
			exit_wizard();
		}
		if(!$this->session->userdata("run_wizard")) {
			redirect("/stat");
		} else {
			if(isset($data['wiz_data']['postingpage'])) {
				// if(isset($data['wiz_data']['confirmed'])) {
				
				// --- POSTPROCESSING NETWORK CONFIRMED ----
								
				// try to set easyfind config.
				if(isset($data['wiz_data']['en_easyfind'])) {
					if($this->networkmanager->easyfind_validate($data['wiz_data']['easyfind_name'])) {
						$server_response = $this->networkmanager->easyfind_setname($data['wiz_data']['easyfind_name'].".".$data['wiz_data']['easyfind']['domain']);
						if($server_response['error']) {
							$msg = $this->networkmanager->decode_easyfindmsg($server_response);
							$data['wiz_data']['err_easyfind'] = $msg;
							$data['wiz_data']['easyfind']['name'] = $data['wiz_data']['easyfind_name']; 
						}
					} else {
						if(!$data['wiz_data']['easyfind_name']) {
							$data['wiz_data']['err_easyfind_empty'] = 1;
						}
						$data['wiz_data']['err_easyfind'] = t("Invalid characters in name %s",$data['wiz_data']['easyfind_name']);
						$data['wiz_data']['easyfind']['name'] = $data['wiz_data']['easyfind_name']; 
					}
				} else {
					$server_response = $this->networkmanager->easyfind_setname("");
					if($server_response['error']) {
						$msg = $this->networkmanager->decode_easyfindmsg($server_response);
						$data['wiz_data']['err_easyfind'] = $msg;
						$data['wiz_data']['easyfind']['name'] = $data['wiz_data']['easyfind_name']; 
					}
				}
				if(!(isset($data['wiz_data']['err_easyfind']) && $data['wiz_data']['err_easyfind'])) {
					// setup complete
					$data['confirmed'] = true;
				}
				
				if($strip){
					$this->load->view($this->load->view(THEME.'/network/network_wizard_view',$data));
				}else{
					$this->_renderfull($this->load->view(THEME.'/network/network_wizard_view',$data,true));
				}
				if(isset($data['wiz_data']['err_easyfind']) && !$data['wiz_data']['err_easyfind']) {
					exit_wizard();
				}
			} else {
				// --- PREPROCESSING NETWORK  ----

				$data['wiz_data']['easyfind'] = $this->networkmanager->get_easyfind();
				if(preg_match("/(.*)\.([\d\w]+\.\w+)$/",$data['wiz_data']['easyfind']['name'],$host)) {
					$data['wiz_data']['easyfind']['name'] = $host[1];
				}
				if(isB3()) {
					$data['wiz_data']['easyfind']['domain'] = B3_EASYFINDDOMAIN;
				} else {
					$data['wiz_data']['easyfind']['domain'] = DEFAULT_EASYFINDDOMAIN;
				}
				
				if($strip){
					$this->load->view($this->load->view(THEME.'/network/network_wizard_view',$data));
				}else{
					$this->_renderfull($this->load->view(THEME.'/network/network_wizard_view',$data,true));
				}
			}
		}
	}
}
