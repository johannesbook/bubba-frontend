<?php
class NetworkManager extends Model {
	private $htcap;
	private $ifcfg;
	private $lanif;
	private $wanif;
	private $wlanif;

	public function __construct() {
		parent::Model();
		$this->load->helper('bubba_socket');
		$this->load->helper('ini');
		$this->ifcfg = array();
	}

	public function __destruct() {
		//BubbaSocket::dump();
	}

	public function is_wanaccess() {
		$wanip = get_interface_info($this->get_wan_interface());
		if(count($wanip)>0 && $_SERVER["SERVER_ADDR"] == $wanip[0]) {
			return true;
		} else {
			return false;
		}
	}

	public function decode_easyfindmsg($server_response) {

		define("DBCONNECT", 0x0);
		define("UPDATE", 0x1);
		define("SETNAME", 0x2);
		define("CHECKNAME", 0x4);
		define("DISABLE", 0x8);
		define("VALIDATE", 0x10);
		define("CHANGENAME", 0x11);
		define("GETRECORD", 0x12);

		switch ($server_response['opcode']) {
			case DBCONNECT:
				$msg = _("Failed to connect to database.");
				break;
			case UPDATE:
				$msg = _("Unable to update IP on server.");
				break;

			case SETNAME:
				$msg = _("Unable to set name on server.");
				break;

			case CHECKNAME:
				$msg = _("Name not available.");
				break;

			case DISABLE:
				$msg = _("Unable to disable 'easyfind' service.");
				break;

			case VALIDATE:
				$msg = _("Name is not valid.");
				break;

			case CHANGENAME:
				$msg = _("Unable to change name on server.");
				break;

			case GETRECORD:
				$msg = _("Unable to get record data from server.");
				break;
		}
		if(isset($server_response['msg']) && $server_response['msg']) {
			$msg .= "<br>"._("Server responded: ") . $server_response['msg'];
		}

		return $msg;
	}

	public function easyfind_validate( $name ) {
		if(!$name) return 0;
		return preg_match( '#^[A-Za-z0-9-]+$#', $name );
	}

	public function easyfind_setname( $name ) {
		return set_easyfind($name);
	}

	public function get_easyfind() {
		return get_easyfind();
	}

	function set_auto($restart_lan = true, $restart_wan = true) {
		$this->setdynamic($this->get_wan_interface());
		$this->setdynamic($this->get_lan_interface());
		// make sure to disable dns
		$dnsmasq = get_dnsmasq_settings();
		unset($dnsmasq['running']);
		$dnsmasq["dhcpd"] = true; // make sure the fallback will activate dhcpd.
		$dnsmasq["range_start"] = array("192.168.10.50"); // FIXME
		$dnsmasq["range_end"] = array("192.168.10.100"); // FIXME
		configure_dnsmasq($dnsmasq);
		if($restart_lan) $this->ifrestart($this->get_lan_interface());
		if($restart_wan) $this->ifrestart($this->get_wan_interface());

		if($restart_lan) {
			$this->_restart_services($this->get_lan_interface());
		} else {
			$this->_restart_services();
		}

	}

	function set_router($restart_lan = true, $restart_wan = true) {
		$this->setdynamic($this->get_wan_interface());
		// XXX TODO FIXME should not be statically here

		$this->setstatic($this->get_lan_interface(),array(
			"address" => array("192.168.10.1"), // FIXME
			"netmask" => array("255.255.255.0"), // FIXME
		));

		// make sure to enable dns
		$dnsmasq = get_dnsmasq_settings();
		$dnsmasq['running'] = true;
		$dnsmasq["dhcpd"] = true;
		$dnsmasq["range_start"] = array("192.168.10.50"); // FIXME
		$dnsmasq["range_end"] = array("192.168.10.100"); // FIXME
		configure_dnsmasq($dnsmasq);

		if($restart_lan) $this->ifrestart($this->get_lan_interface());
		if($restart_wan) $this->ifrestart($this->get_wan_interface());

		if($restart_lan) {
			$this->_restart_services($this->get_lan_interface());
		} else {
			$this->_restart_services();
		}
	}

	function set_server($restart_lan = true, $restart_wan = true) {
		$this->setdynamic($this->get_wan_interface());
		$this->setdynamic($this->get_lan_interface());
		// make sure to disable dns
		$dnsmasq = get_dnsmasq_settings();

		unset($dnsmasq['running']);
		$dnsmasq["dhcpd"] = false; // make sure the fallback does not activate dhcpd.
		configure_dnsmasq($dnsmasq);

		if($restart_lan) $this->ifrestart($this->get_lan_interface());
		if($restart_wan) $this->ifrestart($this->get_wan_interface());

		if($restart_lan) {
			$this->_restart_services($this->get_lan_interface());
		} else {
			$this->_restart_services();
		}

	}

	function apply_profile($profile,$old_profile) {
		switch ($old_profile) {
		case "router":
			switch ($profile) {
			case "server":
				$this->set_server();
				break;
			case "auto":
				$this->set_auto();
				break;
			default:
				throw new Exception("$profile isn't valid and cant be handled");
				break;
			}
			break;
		case "server":
			switch ($profile) {
			case "router":
				$this->set_router();
				break;
			case "auto":
				$this->set_auto();
				break;
			default:
				throw new Exception("$profile isn't valid and cant be handled");
				break;
			}
			break;
		case "auto":
			switch ($profile) {
			case "router":
				$this->set_router();
				break;
			case "server":
				$this->set_server(false,false);
				break;
			default:
				throw new Exception("$profile isn't valid and cant be handled");
				break;
			}
			break;
		default:
			// from "custom" or anything
			switch ($profile) {
			case "router":
			case "server":
				// we do nothing
				break;
			case "auto":
				$this->set_auto();
				break;
			default:
				// if here, something has gone wrong, really wrong.
				throw new Exception("$old_profile and $profile isn't valid and cant be handled");
				break;
			}
			break;
		}
	}

	private function _getifcfg( $interface,$dirty = false ) {
		if( !isset( $this->ifcfg[$interface]) || $dirty ) {
			$data = query_network_manager( array("cmd" => "getifcfg","ifname" => $interface) );
			$this->ifcfg[$interface] = $data;
		}
		return $this->ifcfg[$interface];
	}

	private function _dirty_cache( $interface ) {
		unset($this->ifcfg[$interface]);
		unset($this->htcap[$interface]);
	}

	private function _getfirstnameserver(){
		$data = query_network_manager( array("cmd" => "getnameservers") );
		if($data["status"] && count($data["resolv"]["servers"])>0){
			return $data["resolv"]["servers"][0];
		}else{
			return Null;
		}
	}

	private function _getdefaultroute(){
		$data = query_network_manager( array("cmd" => "getdefaultroute") );
		if($data["status"]){
			return $data["gateway"];
		}else{
			return Null;
		}
	}

	private function _getpromisc($interface){
		$data = query_network_manager( array("cmd" => "getpromisc", "ifname" => $interface ) );
		if($data["status"]){
			return $data["promisc"];
		}else{
			return Null;
		}
	}


	private function _setpromisc($interface, $promisc){
		$data = query_network_manager( array(
			"cmd" => "setpromisc",
			"ifname" => $interface,
			"promisc"=>$promisc ) );

		if($data["status"]){
			return $data["status"];
		}else{
			return false;
		}
	}

	public function get_networkconfig($interface, $dirty = false){
		$ret=array(
			"gateway"=>"0.0.0.0",
			"dns"=>"0.0.0.0",
			"address"=>"0.0.0.0",
			"netmask"=>"0.0.0.0",
			"dhcp"=>false);

		$iface=$this->_getifcfg($interface,$dirty);

		if(isset($iface["config"]["ethernet"]["current"]["address"]) && $iface["config"]["ethernet"]["current"]["address"]!=""){
			$ret["address"]=$iface["config"]["ethernet"]["current"]["address"];
			$ret["netmask"]=$iface["config"]["ethernet"]["current"]["netmask"];
		}elseif ($iface["config"]["ethernet"]["addressing"]=="static"){
			$ret["address"]=$iface["config"]["ethernet"]["config"]["address"][0];
			$ret["netmask"]=$iface["config"]["ethernet"]["config"]["netmask"][0];
		}
		$ns=$this->_getfirstnameserver();
		if($ns!=Null){
			$ret["dns"]=$ns;
		}
		$gw=$this->_getdefaultroute();
		if($gw!=Null){
			$ret["gateway"]=$gw;
		}
		$ret["dhcp"]=($iface["config"]["ethernet"]["addressing"]=="dhcp")?1:0;

		return $ret;
	}

	public function get_mtu($interface){
		$data = query_network_manager( array("cmd"=>"getmtu", "ifname"=>$interface));

		if($data["status"]){
			return $data["mtu"];
		}else{
			return Null;
		}
	}

	private function _restart_services($interface = null) {
	  if(service_running("proftpd")){
			stop_service("proftpd");
			start_service("proftpd");
		}
		if($interface == $this->get_lan_interface()) {
	    if(query_service("samba")){
				restart_samba();
	    }
	    if(query_service("avahi-daemon")){
	        stop_service("avahi-daemon");
	        start_service("avahi-daemon");
	    }
	    if(query_service("mt-daapd")){
	        stop_service("mt-daapd");
					sleep(1);
	        start_service("mt-daapd");
	    }
	    if(query_service("minidlna")){
		    stop_service("minidlna");
		    start_service("minidlna");
	    }
	}
}

	public function ifrestart($interface){
		$data = query_network_manager( array(
			"cmd"=>"ifrestart",
			"ifname"=>$interface));
		if( query_service("hostapd") && service_running("hostapd") && ( $interface == $this->get_lan_interface() ) ) {
			invoke_rc_d("hostapd","restart");  // check return value?
		}
		return $data["status"];
	}

	public function getns(){
		$data = query_network_manager( array("cmd"=>"getnameservers"));

		if($data["status"]){
			return $data["resolv"];
		}else{
			return Null;
		}
	}

	public function setns($config){
		$data = query_network_manager( array(
			"cmd"=>"setnameservers",
			"resolv"=>$config));
		return $data["status"];
	}

	public function setdynamic($interface, $config=null){
		$cmd= array(
			"cmd"=>"setdynamiccfg",
			"ifname"=>$interface,
			"config"=>$config);
		$data = query_network_manager($cmd);
		return $data["status"];
	}

	public function setstatic($interface, $config){
		$data = query_network_manager( array(
			"cmd"=>"setstaticcfg",
			"ifname"=>$interface,
			"config"=>$config));

		return $data["status"];
	}

	public function exists_wlan_card() {
		$cfg = array(
			'cmd'		=> 'haswlan',
		);
		$data = query_network_manager( $cfg );
		return $data['status'] && $data['wlan'];
	}

	public function wlan_enabled() {
		return service_running('hostapd');
	}

	public function set_lanif( $if ) {

		_system( FIREWALL, 'set_lanif', $if );
		_system( BACKEND, 'set_interface', $if );

        $this->igd_set_interface($if);

		// TODO: Refactor into separate function
		$dnsmasqcfg=get_dnsmasq_settings();
		$dnsmasqcfg["interface"]=$if;
		configure_dnsmasq($dnsmasqcfg);

		$cfg = array(
			'cmd'		=> 'setlanif',
			'lanif'		=> $if
		);
		$data = query_network_manager( $cfg );


		return $data['status'];
	}

	private function _setapif($iface){
		$cfg = array(
			'cmd'		=> 'setapif',
			'ifname'	=> $iface,
		);
		$data = query_network_manager( $cfg );
		return $data['status'];
	}

	public function enable_wlan() {
		// Dont enable if up and running
		if( query_service( 'hostapd' ) && service_running( 'hostapd' )){
			return;
		}

		// Make sure we use "right" wlan-if
		$this->_setapif($this->get_wlan_interface());

		$this->set_lanif('br0');
		if( !query_service( 'hostapd' ) ) {
			add_service( 'hostapd' );
		}
		if( !service_running( 'hostapd' ) ) {
			start_service( 'hostapd' );
		}

		# TODO: This is a cludge because of problems in lower levels
		$this->_setpromisc("eth1",True);
	}

	public function disable_wlan() {
		$this->set_lanif('eth1');
		if( service_running( 'hostapd' ) ) {
			stop_service( 'hostapd' );
		}
		if( query_service( 'hostapd' ) ) {
			remove_service( 'hostapd' );
		}
		# TODO: This is a cludge because of problems in lower levels
		$this->_setpromisc("eth1",False);
	}

	public function get_wlan_broadcast_ssid() {
		$data = $this->_getifcfg( $this->get_wlan_interface() );
		if( isset( $data['config']['wlan']['config']['ssidbroadcast'] ) ) {
			return $data['config']['wlan']['config']['ssidbroadcast'];
		}
		return true;
	}

	public function get_current_wlan_ssid() {
		$data = $this->_getifcfg( $this->get_wlan_interface() );
		if( isset( $data['config']['wlan']['config']['ssid'] ) ) {
			return $data['config']['wlan']['config']['ssid'];
		}
		return 'bubba';
	}

	public function enable_wlan_broadcast_ssid() {
		$cfg = array(
			'cmd'		=> 'enableapssidbroadcast',
			'ifname'	=> $this->get_wlan_interface(),
			'enable'	=> true
		);
		$data = query_network_manager( $cfg );
		return $data['status'];
	}

	public function disable_wlan_broadcast_ssid() {
		$cfg = array(
			'cmd'		=> 'enableapssidbroadcast',
			'ifname'	=> $this->get_wlan_interface(),
			'enable'	=> false
		);
		$data = query_network_manager( $cfg );
		return $data['status'];
	}

	public function set_wlan_ssid( $interface, $ssid  ) {
		$cfg = array(
			'cmd'		=> 'setapssid',
			'ifname'	=> $interface,
			'ssid'		=> $ssid
		);
		$data = query_network_manager( $cfg );
		return $data['status'];
	}

	public function is_802_11n_activated() {

		$data = $this->_getifcfg( $this->get_wlan_interface() );
		if( isset( $data['config']['wlan']['config']['80211n'] ) ) {
			return $data['config']['wlan']['config']['80211n'] != 0;
		}
		return false;
	}

	public function enable_wlan_802_11n() {
		$cfg = array(
			'cmd'		=> 'enable80211n',
			'ifname'	=> $this->get_wlan_interface(),
			'enable'	=> true
		);
		$data = query_network_manager( $cfg );
		return $data['status'];

	}

	public function disable_wlan_802_11n() {
		$cfg = array(
			'cmd'		=> 'enable80211n',
			'ifname'	=> $this->get_wlan_interface(),
			'enable'	=> false
		);
		$data = query_network_manager( $cfg );
		return $data['status'];

	}
	public function get_wlan_current_mode() {

		$data = $this->_getifcfg( $this->get_wlan_interface() );
		if( isset( $data['config']['wlan']['config']['mode'] ) ) {
			return $data['config']['wlan']['config']['mode'];
		}
		return 'g';
	}

	public function set_wlan_mode( $interface, $mode  ) {
		$cfg = array(
			'cmd'			=> 'setapmode',
			'ifname'		=> $interface,
			'mode'		=> $mode
		);
		$data = query_network_manager( $cfg );
		return $data['status'];

	}

	private function _get_ht_capab( $interface ) {
		if( isset( $this->htcap[$interface] ) && is_array( $this->htcap[$interface] ) ) {
			return $this->htcap[$interface];
		}

		$data = $this->_getifcfg( $interface );
		$out = array();
		if( isset( $data['config']['wlan']['config']['ht_capab'] ) ) {
			$in = $data['config']['wlan']['config']['ht_capab'];
			foreach( $in as $i ) {
				$out[$i] = true;
			}
		}
		$this->htcap[$interface] = $out;
		return $out;
	}

	public function set_wlan_ht_capab( $capab ) {
		$cmd = array(
			"cmd" => "setaphtcapab",
			"capab" => $capab,
			"ifname" => $this->get_wlan_interface()
		);
		$idata = query_network_manager( $cmd );
		$this->_dirty_cache( $this->get_wlan_interface() );
		return $idata["status"];
	}


	public function enable_wlan_ht_capab( $capab ) {
		if( ! is_array( $capab ) ) $capab = array( $capab );
		$data = $this->_get_ht_capab($this->get_wlan_interface());
		foreach( $capab as $c ) {
			if( !isset($data[$c]) ) {
				$data[$c] = true;
			}
		}
		return $this->set_wlan_ht_capab( array_keys($data) );
	}

	public function disable_wlan_ht_capab( $capab ) {
		if( ! is_array( $capab ) ) $capab = array( $capab );
		$data = $this->_get_ht_capab($this->get_wlan_interface());
		foreach( $capab as $c ) {
			if( isset($data[$c]) ) {
				unset($data[$c]);
			}
		}
		return $this->set_wlan_ht_capab( array_keys($data) );
	}

	public function wlan_ht40_active() {
		$data = $this->_get_ht_capab($this->get_wlan_interface());
		if( $data ) {
			return isset($data["HT40+"]) || isset($data["HT40-"]);
		}
		return false;
	}
	public function wlan_greenfield_active() {
		$data = $this->_get_ht_capab($this->get_wlan_interface());
		if( $data ) {
			return isset($data["GF"]);
		}
		return false;
	}


	public function get_available_wlan_encryptions() {
		// TODO implement
		return array(
			'none',
			'wpa2',
			'wpa12',
			'wpa1',
			'wep',
		);
	}

	public function get_current_wlan_encryption() {
		$data = $this->_getifcfg( $this->get_wlan_interface() );
		if( isset( $data['config']['wlan']['config']['auth']['mode'] ) ) {
			switch( $data['config']['wlan']['config']['auth']['mode'] ) {
			case 'wpa':
				return $data['config']['wlan']['config']['auth']['wpa']['mode'];
				break;
			default:
				return  $data['config']['wlan']['config']['auth']['mode'];
			}
		}

		return 'none';
	}

	public function set_wlan_encryption( $interface, $encryption, array $keys, $defaultkey = null ) {
		switch( $encryption ) {
		case 'wpa1':
		case 'wpa12':
		case 'wpa2':
			$cfg = array(
				'cmd'		=> 'setapauthwpa',
				'ifname'	=>  $interface,
				'config'	=> array(
					'mode'			=> $encryption,
					'keys'			=> $keys
				)
			);
			break;
		case 'wep':
			if( is_null($defaultkey) ) {
				throw new Exception( "default key is required for WEP" );
			}
			$cfg = array(
				'cmd'		=> 'setapauthwep',
				'ifname'	=>  $interface,
				'config'	=> array(
					'defaultkey'	=> $defaultkey,
					'keys'			=> array_map( create_function( '$a', 'return "\"$a\"";' ), $keys ),
				)
			);
			break;
		case 'none':
			$cfg = array(
				'cmd'		=> 'setapauthnone',
				'ifname'	=>  $interface,
			);
			break;

		default:
			throw new Exception( "wrong encryption choosen" );
		}

		$data = query_network_manager( $cfg );
		return $data['status'];
	}

	public function get_wlan_encryption_key() {
		$ret = array();
		$data = $this->_getifcfg( $this->get_wlan_interface() );
		if( isset( $data['config']['wlan']['config']['auth']['mode'] ) ) {
			$auth = $data['config']['wlan']['config']['auth'];
			switch( $auth['mode'] ) {
			case 'wpa':
				if( is_array( $auth['wpa']['keys'] ) && count($auth['wpa']['keys']) > 0 ) {
					return $auth['wpa']['keys'][0];
				}
				break;
			case 'wep':
				if( is_array( $auth['wep']['keys'] ) && isset($auth['wep']['defaultkey'] ) ) {
					$key = $auth['wep']['keys'][$auth['wep']['defaultkey']];
					$key = preg_replace('#"?(.*?)"?$#', '\\1', $key );
					return $key;
				}
				break;

			}
		}
		// TODO implement
		return "";
	}

	private function _bit( $int ) {
		return 0x1 << $int;
	}

	public function get_wlan_capabilities( $phy = 'phy0' ) {
		$cfg = array(
			'cmd'			=> 'getphycap',
			'phy'	    	=> $phy,
		);
		$data = query_network_manager( $cfg );
		if( $data['status'] ) {
			$cap = $data['cap'];
			$result = array();
			$result['RX_LDPC'] = (bool)($cap & $this->_bit(0));

			$result['HT40'] =  (bool)($cap & $this->_bit(1));

			$result['SMPC'] = ($cap >> 2) & 0x3; // bit 2 and 3

			$result['RX_GF'] =  (bool)($cap & $this->_bit(4));

			$result['HT20_CGI'] =  (bool)($cap & $this->_bit(5));
			$result['HT40_CGI'] =  (bool)($cap & $this->_bit(6));

			$result['TX_STBC'] =  (bool)($cap & $this->_bit(7));

			$result['RX_STBC'] = ($cap >> 8) & 0x3; // bit 8 and 9

			$result['HT_DELAYED_BA'] =  (bool)($cap & $this->_bit(10));

			$result['AMSDU_LENGTH'] =  $cap & $this->_bit(11) ? 3839 : 7935;

			$result['DSSS_CCK_HT40'] =  (bool)($cap & $this->_bit(12));

			// bit 13 reserved

			$result['INTOLERANT_40MHZ'] =  (bool)($cap & $this->_bit(14));

			$result['L_SIG_TXOP'] =  (bool)($cap & $this->_bit(15));

			return $result;
		} else {
			throw new Exception($data["error"]);
		}

	}
	public function get_wlan_bands( $phy = 'phy0' ) {
		$cfg = array(
			'cmd'			=> 'getphybands',
			'phy'	    	=> $phy,
		);
		$data = query_network_manager( $cfg );
		if( $data['status'] ) {
			return $data['bands'];
		} else {
			throw new Exception($data["error"]);
		}
	}

	public function get_wlan_current_channel() {
		$data = $this->_getifcfg( $this->get_wlan_interface() );
		if( isset( $data['config']['wlan']['config']['channel'] ) ) {
			return $data['config']['wlan']['config']['channel'];
		}

		return 6;
	}

	public function set_wlan_channel( $interface, $channel  ) {
		$cfg = array(
			'cmd'			=> 'setapchannel',
			'ifname'		=> $interface,
			'channel'		=> $channel
		);
		$data = query_network_manager( $cfg );
		return $data['status'];

	}

	public function get_wlan_interface(){
		if( !is_null( $this->wlanif ) ) {
			return $this->wlanif;
		}
		$cfg = array(
			'cmd'	=>	'getwlanif',
		);
		$data = query_network_manager( $cfg );
		if($data["status"]){
			$this->wlanif = $data["wlanif"];
		} else {
			return "";
		}
		return $this->wlanif;
	}

	public function get_lan_interface() {
		if( !is_null( $this->lanif ) ) {
			return $this->lanif;

		}
		$cfg = array(
			'cmd'			=> 'getlanif',
		);
		$data = query_network_manager( $cfg );
		return $this->lanif = $data['lanif'];
	}

	public function get_wan_interface() {
		if( !is_null( $this->wanif ) ) {
			return $this->wanif;

		}
		$cfg = array(
			'cmd'			=> 'getwanif',
		);
		$data = query_network_manager( $cfg );
		return $this->wanif = $data['wanif'];
    }

    private $_igd_conf = "/etc/bubba-igd.conf";

    private function _igd_ini_get($key) {
        $data = file_get_contents($this->_igd_conf);
        preg_match("#^$key\\s*=\\s*(.*?)\s*\$#m", $data, $m);
        return $m[1];
    }

    private function _igd_ini_exists($key) {
        $data = file_get_contents($this->_igd_conf);
        return preg_match("#^$key#m", $data);
    }

    private function _igd_ini_update($key, $value) {
        $data = file_get_contents($this->_igd_conf);
        if( $value ) {
            if( preg_match("#^$key#m", $data) ) {
                $data = preg_replace("#^$key.*\$#m", "$key=$value", $data );
            } else {
                $data .= "$key=$value\n";
            }
        } else {
            $data = preg_replace("#^$key.*\n#m", "", $data );
        }
        file_put_contents( $this->_igd_conf, $data );
    }

    function igd_set_interface( $if ) {
        $oldif = $this->_igd_ini_get("interface");
        if( $oldif != $if ) {
            $this->_igd_ini_update("interface", $if);
            invoke_rc_d("bubba-igd", "restart");
        }
    }

    function igd_easyfind_is_enabled() {
        return $this->_igd_ini_exists("enable-easyfind");
    }

    function igd_port_forward_is_enabled() {
        return $this->_igd_ini_exists("enable-port-forward");
    }

    function enable_igd_easyfind( $enabled = true ) {
        if( $enabled ) {
            if( !$this->_igd_ini_exists("enable-easyfind") ) {
                $this->_igd_ini_update("enable-easyfind", "yes");
                invoke_rc_d("bubba-igd", "restart");
            }
        } else {
            if( $this->_igd_ini_exists("enable-easyfind") ) {
                $this->_igd_ini_update("enable-easyfind", false);
                invoke_rc_d("bubba-igd", "restart");
            }
        }
    }

    function enable_igd_port_forward( $enabled = true ) {
        if( $enabled ) {
            if( !$this->_igd_ini_exists("enable-port-forward") ) {
                $this->_igd_ini_update("enable-port-forward", "yes");
                invoke_rc_d("bubba-igd", "restart");
            }
        } else {
            if( $this->_igd_ini_exists("enable-port-forward") ) {
                $this->_igd_ini_update("enable-port-forward", false);
                invoke_rc_d("bubba-igd", "restart");
            }
        }
    }

	function access_interface() {
		$wanif = $this->get_wan_interface();
		$if = "unknown interface";
		$wanip = get_interface_info($wanif);
		if(count($wanip)>0 && $_SERVER["SERVER_ADDR"] == $wanip[0]) {
			$if = $wanif;
		} else {
			$lanif = $this->get_lan_interface();
			$lanip = get_interface_info($lanif);
			if(count($lanip)>0 && $_SERVER["SERVER_ADDR"] == $lanip[0]) {
				$if = $lanif;
			}
		}
		return $if;
	}

	# Include various functions to check if Tor is running, stop and
	# start the service etc

	# Check if Tor is running
	public function tor_enabled() {

		# The default B3 way of checking if a service is running
		# is to use the rc.d status option. However, this option
		# was not included in the Tor Debian package until version
		# 0.2.2.9-alpha.
		#
		# So, if the standard service_running()
		# returns false, we'll do another check with a more
		# hack-ish method to confirm whether Tor is actually
		# running or not.
		if(service_running('tor')) {
			return $enabled = true;
		} else {
			$cmd = 'ps aux | grep "/usr/sbin/tor" | grep -v "grep"';
			exec($cmd, $output);
			if($output) {
				return $enabled = true;
			}
		}
	}

	public function enable_tor() {
		# Do not enable if Tor is already running
		if(query_service('tor') && service_running('tor')) {
			return;
		}

		if(!query_service('tor')) {
			add_service('tor');
		}

		if(!service_running('tor')) {
			start_service('tor');
		}
	}

	public function disable_tor() {
		if(service_running('tor')) {
			stop_service('tor');
		}

		if(query_service('tor')) {
			remove_service('tor');
		}
	}

	# Read the contents of /etc/tor/torrc so that we can display the
	# current settings in the web interface
	function get_tor_config() {
		$conf = fopen('/etc/tor/torrc', 'r');
		$content = fread($conf, filesize('/etc/tor/torrc'));
		$c_arr = explode("\n", $content);
		$this->get_tor_config = $c_arr;
		return $this->get_tor_config;
	}

	# Get the bridge address
    public function get_tor_bridge_address() {
        if(file_exists("/var/log/tor/notices.log")){
            $log = file_get_contents("/var/log/tor/notices.log");
            $list = preg_grep("#Now checking whether ORPort#", explode("\n",$log));
            $last = end($list);
            preg_match("#(\d+\.\d+\.\d+\.\d+:\d+)#", $last, $m);
            if($m) {
                return "bridge $m[1]";
            }
        }
        return "N/A";
    }

	# Get the nickname
	public function get_tor_nickname() {
		$torrc = $this->get_tor_config();
        foreach ($torrc as $line) {
             if(preg_match("/Nickname\s+(?P<nick>.*?)\s*(?:#|$)/m", $line, $m)) {
                return $m['nick'];
            }
		}
        return $nickname = "Unnamed";
	}

	# Get the contact information
	public function get_tor_contact() {
		$torrc = $this->get_tor_config();
		foreach ($torrc as $line) {
             if(preg_match("/ContactInfo\s+(?P<info>.*?)\s*(?:#|$)/m", $line, $m)) {
                return $m['info'];
            }
		}
        return $contact = "Random Person <nobody AT example dot com>";
	}

	# Get the relay port
	public function get_tor_relay_port() {
		$torrc = $this->get_tor_config();
        foreach ($torrc as $line) {
             if(preg_match("/ORPort\s+(?P<port>\d+?)\s*(?:#|$)/m", $line, $m)) {
                return $m['port'];
            }
		}
        return $relay_port = "443";
	}

	# Get the directory port
	public function get_tor_dir_port() {
		$torrc = $this->get_tor_config();
		foreach ($torrc as $line) {
            if(preg_match("/DirPort\s+(?P<port>\d+?)\s*(?:#|$)/m", $line, $m)) {
                return $m['port'];
            }
		}
        return $dir_port = "9030";
	}

	# Is this a public bridge?
	public function get_tor_public_bridge() {
		$torrc = $this->get_tor_config();
		foreach ($torrc as $line) {
            if(preg_match("/PublishServerDescriptor\s+1/m", $line, $m)) {
                return true;
            }
		}

        return false;
	}

	# Get the bandwidth limits
	public function get_tor_bandwidth_rate() {
		$torrc = $this->get_tor_config();
		foreach ($torrc as $line) {
            if(preg_match("/RelayBandwidthRate\s+(?P<bw>.*?)(?:#|$)/m", $line, $m)) {
                return $m['bw'];
            }
		}

        return 0;
	}

	public function get_tor_bandwidth_burst() {
		$torrc = $this->get_tor_config();
		foreach ($torrc as $line) {
            if(preg_match("/RelayBandwidthBurst\s+(?P<bw>.*?)(?:#|$)/m", $line, $m)) {
                return $m['bw'];
            }
		}
        return 0;
	}

    public function get_tor_type() {
        $rcfile = file_get_contents("/etc/tor/torrc");
        if( preg_match("#BridgeRelay 1#", $rcfile) ) {
            $type = 'bridge';
        } elseif( preg_match("#ExitPolicy accept \*#", $rcfile) ) {
            $type = 'exit';
        } else {
            $type = 'non_exit';
        }
        return $type;
    }
    public function tor_setconfig($data) {
        $cfg = array(
            "## Configuration file for Tor",
            "## Last updated " . date("r"),
            "##",
            "## Warning: This file is automatically generated by the web interface.",
            "##          Any manual changes in this file might be lost when updating from web-admin.",
            "##",
            "",
            'Log notice file /var/log/tor/notices.log',
            "Nickname $data[nickname]",
            "ContactInfo $data[contact]",
            "ORPort $data[relay_port]"
        );

        switch($data['defined_bandwidth']) {
        case '256':
            $rate = "32 KBytes";
            $burst = "64 KBytes";
            break;
        case '512':
            $rate = "64 KBytes";
            $burst = "128 KBytes";
            break;
        case '768':
            $rate = "92 KBytes";
            $burst = "192 KBytes";
            break;
        case 't1':
            $rate = "192 KBytes";
            $burst = "384 KBytes";
            break;
        case 'highbw':
            $rate = "5120 KBytes";
            $burst = "10240 KBytes";
            break;
        case 'custom':
            $rate = $data['bandwidth_rate'];
            $burst = $data['bandwidth_burst'];
            break;
        default:
            $rate = $burst = "0 bps";
        }
        $cfg[] = "RelayBandwidthRate $rate";
        $cfg[] = "RelayBandwidthBurst $burst";

        switch($data['tor_type']) {
        case 'bridge':
            if(isset($data['public_bridge'])) {
                $cfg[] = "PublishServerDescriptor 1";
            } else {
                $cfg[] = "PublishServerDescriptor 0";
            }
            $cfg[] = "SocksPort 0";
            $cfg[] = "BridgeRelay 1";
            $cfg[] = "ExitPolicy reject *:*";
            break;
        case 'non_exit':
            $cfg[] = "DirPort $data[dir_port]";
            $cfg[] = "ExitPolicy reject *:*";
            break;
        case 'exit':
            $cfg[] = "DirPort $data[dir_port]";
            $ports = array(
                'http' => array("80"),
                'https' => array("443"),
                'mail' => array("110", "143", "993", "995"),
                'im' => array("706", "1863", "5050", "5190", "5222", "5223", "8300", "8888"),
                'irc' => array("6660-6669", "6697", "7000-7001")
            );

            # Ports represented by the "IRC" checkbox

            foreach($data['exit_policy'] as $policy ) {
                if(isset($ports[$policy])) {
                    foreach( $ports[$policy] as $port ) {
                        $cfg[] = "ExitPolicy accept *:$port";
                    }
                }
            }
            if(!in_array('misc', $data['exit_policy'])) {
                $cfg[] = "ExitPolicy reject *:*";
            }
            break;
         }

        $cfg_file = '/etc/tor/torrc';
        file_put_contents($cfg_file, implode("\n",$cfg));
        invoke_rc_d("tor", "reload");
    }

    public function tor_get_exit_policies()  {
        $ports = array(
            'http' => array("80"),
            'https' => array("443"),
            'mail' => array("110", "143", "993", "995"),
            'im' => array("706", "1863", "5050", "5190", "5222", "5223", "8300", "8888"),
            'irc' => array("6660-6669", "6697", "7000-7001")
        );

        $policies =  array( 'http', 'https', 'mail', 'im', 'irc', 'misc' );


        $cfg_file = '/etc/tor/torrc';
        $open_ports = array();
        $current = array();
        $ret = array();

        $misc = true;

        foreach(explode("\n", file_get_contents($cfg_file)) as $v) {
            if( preg_match("#ExitPolicy accept \*:(?P<port>\S*)#S", $v, $m) ) {
                $open_ports[] = $m['port'];
            }
            if( preg_match("#ExitPolicy reject \*:\*#S", $v) ) {
                $misc = false;
                break;
            }
        }


        foreach( $policies as $policy ) {
            $active = false;

            if( $policy == 'misc' ) {
                $active = $misc;
            } elseif(!count(array_diff($ports[$policy], $open_ports))) {
                $active = true;
            }
            $ret[$policy] = $active;

        }

        return $ret;
    }

    public function tor_trigger_ports($relay_port, $dir_port, $enabled) {
        $cfg_file = '/etc/tor/torrc';
        $oldcfg = file_get_contents($cfg_file);

        if(preg_match("#ORPort (?P<port>\d+)#", $oldcfg, $m)) {
            _system( FIREWALL, 'closeport', $m['port'], 'tcp', 0, 'filter', 'INPUT');
        }

        if(preg_match("#DirPort (?P<port>\d+)#", $oldcfg, $m)) {
            _system( FIREWALL, 'closeport', $m['port'], 'tcp', 0, 'filter', 'INPUT');
        }

        if( $enabled ) {
            if($relay_port){
                _system( FIREWALL, 'openport', $relay_port, 'tcp', 0, 'filter', 'INPUT');
            }
            if($dir_port){
                _system( FIREWALL, 'openport', $dir_port, 'tcp', 0, 'filter', 'INPUT');
            }
        }
    }
}
