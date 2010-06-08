<?php

class Auth_model extends Model{

	private $policies = array(
		"printing" 		=> array(
			"list" 		=> array(
				"allow" => array("admin")
			),
			"startstop" => array(
				"allow" => array("admin")
			),
			"add"  		=> array(
				"allow" => array("admin")
			),
			"delete"    => array( 
				"allow" => array("admin")
			)
		),
		"userdata" 		=> array(
			"list" 		=> array(
				"allow" => array("admin")
			),
			"add"  		=> array(
				"allow" => array("admin")
			),
			"delete"    => array( 
				"allow" => array("admin")
			),
			"edit_allusers" => array(
				"allow" => array("admin")
			),			
			"shell_access"     => array(
				"deny"  => array("admin")
			),
			"set:shell_access"     => array(
				"allow"  => array("admin")
			),
			"disable_remote"     => array(
				"allow"  => array("admin")
			),
			"set:disable_remote"     => array(
				"allow"  => array("admin")
			),
		),
		"album" => array(
			"list" 		=> array(
				"deny" => array("admin")
			),
			"set:disable_remote"     => array(
				"allow"  => array("admin")
			),
		),
		"web_admin" => array(
			"access" => array(
				"groups_allow" => array("bubba", "admin")
			),
			"administer" => array(
				"groups_allow" => array("admin")
			)
		),
		"album" => array(
			"access" 	=> array(
				"groups_deny" => array("admin"),
				"groups_allow" => array("bubba", "album")
			)
		),
		"menu"				=> array(
			"show_level1" => array(
				"allow" => array("admin")
			)
		),
		"mail"				=> array(
			"edit_allusers" => array(
				"allow" => array("admin")
			),
			"fetch" => array(
				"deny" => array("admin")
			)
		),
		"config"				=> array(
			"show_sideboard" => array(
			)
		)
	);
	private $groups = array();
	private $realname = "";

	private $_dom;
	private $_xml_file = "/etc/bubba_auth.xml";
	private $_lock_file = "/var/lock/bubba_auth.lock";

	function Auth_model(){
		parent::Model();
		$this->_dom = new DOMDocument();
		$this->_dom->formatOutput = true;
		$this->_dom->preserveWhiteSpace = false;
		$this->_dom->encoding ='utf-8';		
	}

	function Auth($username, $password){
		$auth = false;
		$this->groups = array();
		require_once(APPPATH."/legacy/user_auth.php");
		if( validate_user($username,$password) ) {
			$userinfo = get_userinfo();
			$this->realname = $userinfo[$username]['realname'];
			$this->groups['bubba'] = true;
			if( $username == "admin" ) {
				$this->groups['admin'] = true;
			}
			$auth = true;
		}
		$this->_read_auth();
		$xpath = new DOMXPath( $this->_dom);
		$result = $xpath->query("/auth/user[@username='$username']");
		if( $result->length > 0 ) {
			$node = $result->item(0);
			if( $node->getAttribute('password') == sha1( trim($password) ) ) {
				$auth = true;
				$this->realname = $node->getAttribute('realname');
				foreach(  $xpath->query('group', $node) as $group ) {
					$this->groups[$group->nodeValue] = true;
				}
			}
		}
		if( $auth ) {
			$this->session->set_userdata('valid', true);
			$this->session->set_userdata('groups', $this->groups);
			$this->session->set_userdata('realname', $this->realname);
			$this->session->set_userdata('user', $username);			
		}
		return count($this->groups) > 0;
	} 


	private function _read_auth() {
		if( file_exists( $this->_xml_file ) ) {
			$this->_dom->load( $this->_xml_file );
		} else {
			throw new Exception("auth file not exists");
		}
	}

	private function _write_auth() {
		if( !isset( $this->_dom ) ) {
			throw new Exception("no xml is in memory");
		}
		$this->_dom->save($this->_xml_file); 		
	}

	public function add_user( $username, $realname, $password, $group ) {
		if( $this->user_exists( $username ) ) {
			return false;
		}
		$lock = fopen( $this->_lock_file, 'w+' );
		flock( $lock, LOCK_EX );
		$this->_read_auth();
		$xpath = new DOMXPath( $this->_dom);
		$auth = $xpath->query("/auth")->item(0);
		$newuser = $auth->appendChild($this->_dom->createElement('user'));
		$newuser->setAttribute('username', $username);
		$newuser->setAttribute('realname', $realname);
		$newuser->setAttribute('password', sha1($password));
		$group = $newuser->appendChild($this->_dom->createElement('group', $group));
		$this->_write_auth();
		flock( $lock, LOCK_UN );
		fclose($lock);
	}

	public function del_user( $username, $realname, $password, $group ) {
		$lock = fopen( $this->_lock_file, 'w+' );
		flock( $lock, LOCK_EX );
		$this->_read_auth();
		$xpath = new DOMXPath( $this->_dom);
		$result = $xpath->query("/auth/user[@username='$username']");
		if( $result->length > 0 ) {
			$node = $result->item(0);
			$node->parentNode->removeChild($node);
		}
		$this->_write_auth();

		flock( $lock, LOCK_UN );
		fclose($lock);
	}
	public function set_user_password( $username, $password ) {
		$lock = fopen( $this->_lock_file, 'w+' );
		flock( $lock, LOCK_EX );
		$this->_read_auth();
		$xpath = new DOMXPath( $this->_dom);
		$result = $xpath->query("/auth/user[@username='$username']");
		if( $result->length > 0 ) {
			$node = $result->item(0);
			$node->setAttribute('password', sha1( trim( $password ) ) );
		}
		$this->_write_auth();

		flock( $lock, LOCK_UN );
		fclose($lock);
	}
	public function set_user_realname( $username, $realname ) {
		$lock = fopen( $this->_lock_file, 'w+' );
		flock( $lock, LOCK_EX );
		$this->_read_auth();
		$xpath = new DOMXPath( $this->_dom);
		$result = $xpath->query("/auth/user[@username='$username']");
		if( $result->length > 0 ) {
			$node = $result->item(0);
			$node->setAttribute('realname', trim($realname) );
		}
		$this->_write_auth();

		flock( $lock, LOCK_UN );
		fclose($lock);
	}

	public function get_user_list( $group ) {
		$list = array();
		if( $group == 'bubba' ) {
			require_once(APPPATH."/legacy/user_auth.php");
			$rawlist = get_userinfo();
			foreach( $rawlist as $user ) {
				$list[] = array( 
					'username' => $user['uname'], 
					'realname' => $user['realname'] 
				);
			}
		} else {
			$lock = fopen( $this->_lock_file, 'w+'  );
			flock( $lock, LOCK_SH );
			$this->_read_auth();
			flock( $lock, LOCK_UN );
			fclose($lock);
			$xpath = new DOMXPath( $this->_dom );
			$users = $xpath->query("/auth/user[group = '$group']");
			foreach( $users as $user ) {
				$list[] = array( 
					'username' => $user->getAttribute('username'), 
					'realname' => $user->getAttribute('realname'), 
				);
			}
		}
		return $list;
	}

	public function user_exists( $username ) {
		require_once(APPPATH."/legacy/user_auth.php");
		$rawlist = get_userinfo();
		foreach( $rawlist as $user ) {
			if( $user['uname'] == $username ) {
				return true;
			}
		}
		$lock = fopen( $this->_lock_file, 'w+'  );
		flock( $lock, LOCK_SH );
		$this->_read_auth();
		flock( $lock, LOCK_UN );
		fclose($lock);
		$xpath = new DOMXPath( $this->_dom );
		return $xpath->query("/auth/user[@username = '$username']")->length > 0;

	}

	function Login($username, $password){
		if($this->Auth($username,$password)){

			return true;
		}else{
			/* Do nothing on a failed login */
			/*
			$this->session->set_userdata('valid', false);
			$this->session->unset_userdata('user');
			*/
			return false;
		}
	}

	function Logout(){
		$this->session->destroy();
	}	
	
	function CheckAuth( $policy = null ){
		if ($this->session->userdata('valid') ) {
			if( $policy ) {
				if( isset( $this->policies[$policy]['access'] ) ) {
					$e =  $this->policy( $policy, 'access' );
					return $e;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
	}	

	function RequireUser($user){
		
		if( $this->session->userdata('user') == $user ){
			return;
		}
		$this->session->set_flashdata('caller', $this->uri->uri_string());
		$this->session->set_flashdata('required_user', $user);
		redirect('login');
		exit();	
	}
	function DenyUser($user){
		
		if( $this->session->userdata('user') != $user ){
			return;
		}
		$this->session->set_flashdata('caller', $this->uri->uri_string());
		redirect('login');
		exit();	
	}
	
	function EnforceAuth( $policy = null ){
		if($this->CheckAuth( $policy )){
			return;
		}
		$this->session->set_flashdata('caller', $this->uri->uri_string());
		redirect('login');
		exit();
	}

	public function enforce_policy( $policy, $method, $primary_user, $user=null, $groups=null ) {
		if( $this->policy( $policy, $method, $user, $groups ) ) {
			return;
		}
		$this->session->set_flashdata('caller', $this->uri->uri_string());
		$this->session->set_flashdata('required_user', $primary_user);
		redirect('login');
		exit();	
		
	}
	
	function policy($policy, $method, $user=null, $groups=null) {
		if( ! $user ) {
			$user = $this->session->userdata("user");
		}
		if( ! $groups ) {
			$groups = $this->session->userdata("groups");
		}
		$allowed = false;
		$denied = false;
		if(isset($this->policies[$policy][$method]["deny"])) {
			if(in_array($user,$this->policies[$policy][$method]["deny"])) {
				$denied = true;
			}
		}
		if(isset($this->policies[$policy][$method]["groups_deny"])) {
			foreach( array_keys($groups) as $group ) {
				if(in_array($group,$this->policies[$policy][$method]["groups_deny"])) {
					$denied = true;
				}
			}
		}
		if(isset($this->policies[$policy][$method]["allow"])) {
			if(in_array($user,$this->policies[$policy][$method]["allow"])) {
				$allowed = true;
			}
		}
		if(isset($this->policies[$policy][$method]["groups_allow"])) {
			foreach( array_keys($groups) as $group ) {
				if(in_array($group,$this->policies[$policy][$method]["groups_allow"])) {
					$allowed = true;
				}
			}
		}				
		if(!isset($this->policies[$policy][$method])) {
			// if asked but no policy set, return false
			$allowed = false;
		}
		return $allowed && !$denied;
	}
	
}
