<?php
class Menu extends Model {

	private $bubba_systembar = array(
		array(
			'id' => 'systemsettings',
			'uri' => '/stat',
			'auth' => true,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon',
			'lock-icon' => array("default-icon-settings","default-icon-settings-lock"),
			'allow' => array( 'admin' ),
		),
	);

	private $bubba_menubar = array(
		array(
			'id' => 'filemanager',
			'uri' => '/filemanager',
			'auth' => true,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon',
			'lock-icon' => array("default-icon-filemanager","default-icon-filemanager-lock"),
		),
		array(
			'id' => 'music',
			'uri' => '/music',
			'auth' => true,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon',
			'lock-icon' => array("default-icon-music","default-icon-music-lock"),
			'target' => "_blank",
		),
		array(
			'id' => 'album',
			'uri' => '/album',
			'auth' => false,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon',
			'lock-icon' => array("default-icon-album","default-icon-album-lock"),
			'abs_uri' => true,
			'target' => "window_album",
		),
		array(
			'id' => 'downloads',
			'uri' => '/downloads',
			'auth' => true,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon',
			'lock-icon' => array("default-icon-downloads","default-icon-downloads-lock"),
			'deny' => array( 'admin' ),
		),
		array(
			'id' => 'pim',
			'uri' => '/pim',
			'auth' => false,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon',
			'lock-icon' => array("default-icon-mail","default-icon-mail-lock"),
			'abs_uri' => true,
			'target' => "window_pim",
		),
		array(
			'id' => 'usersettings',
			'uri' => '/users',
			'auth' => true,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon',
			'lock-icon' => array("default-icon-user","default-icon-user-lock"),
		),
		/*array(
			'id' => 'home',
			'uri' => '/login',
			'auth' => false,
			'class' => 'ui-login-menubar-a',
			'icon' => 'default-icon default-icon-home',
			'hide' => array('login',''),
		),*/
	);


	private $bubba_menu = array(
		array( 
			'id' => 'home',
			'default' => true,
			'uri' => 'stat',
			'allow' => array( 'admin' ),
		),
		array( 
			'id' => 'filemanager',
			'uri' => 'filemanager',
			'allow' => array( 'admin' ),
			'children' => array(
				array(
					'id' => 'filemanager-browse',
					'uri' => 'filemanager/',
					'default' => true,
				),
				array(
					'id' => 'filemanager-backup',
					'uri' => 'filemanager/backup',
				),
				array(
					'id' => 'filemanager-restore',
					'uri' => 'filemanager/restore',
				),
			),
		),

		array( 
			'id' => 'users',
			'uri' => 'users',
			'allow' => array( 'admin' ),
		),
		array( 
			'id' => 'services',
			'uri' => 'services',
			'allow' => array( 'admin' ),
		),
		array( 
			'id' => 'mail',
			'uri' => 'mail',
			'allow' => array( 'admin' ),
			'children' => array(
				array(
					'id' => 'mail-retrieve',
					'uri' => 'mail/index',
					'default' => true,
				),
				array(
					'id' => 'mail-server_settings',
					'uri' => 'mail/server_settings',
					'alias' => array( 'mail/server_update','mail/mc_update' )
				),
			),
		),
		array( 
			'id' => 'network',
			'uri' => 'network',
			'allow' => array( 'admin' ),
			'children' => array(
				array( 
					'id' => 'network-profile',
					'uri' => 'network/profile',
					'default' => true,
				),
				array(
					'id' => 'network-wan',
					'uri' => 'network/wan',
				),
				array(
					'id' => 'network-lan',
					'uri' => 'network/lan',
				),
				array(
					'id' => 'network-wlan',
					'uri' => 'network/wlan',
				),
				array(
					'id' => 'network-firewall',
					'uri' => 'network/fw',
				),
			),
		),
		array(
			'id' => 'disk',
			'uri' => 'disk',
			'allow' => array( 'admin' ),
			'children' => array(
				array( 
					'id' => 'disk-info',
					'uri' => 'disk/',
					'default' => true,
				),
				array(
					'id' => 'disk-lvm',
					'uri' => 'disk/lvm',
				),
				array( 
					'id' => 'disk-raid',
					'uri' => 'disk/raid',
				),
			),			
		),
		array(
			'id' => 'printing',
			'uri' => 'printing',
			'allow' => array( 'admin' ),
		),
		array(
			'id' => 'settings',
			'uri' => 'settings',
			'allow' => array( 'admin' ),
			'children' => array(
				array( 
					'id' => 'settings-wizard',
					'uri' => 'settings/startwizard',
					'default' => true,
				),
				array(
					'id' => 'settings-identity',
					'uri' => 'settings/identity',
				),

				array(
					'id' => 'settings-traffic',
					'uri' => 'settings/trafficsettings',
					'alias' => array( 'settings/settraffic' ),
				),
				array( 
					'id' => 'settings-date',
					'uri' => 'settings/datetime',
					'alias' => array( 'settings/setdate' ),
				),
				array(
					'id' => 'settings-sysbackup',
					'uri' => 'settings/backuprestore',
					'alias' => array('settings/backup','settings/restore'),
				),
				array(
					'id' => 'settings-update',
					'uri' => 'settings/software',
				),
				array( 
					'id' => 'settings-logs',
					'uri' => 'settings/logs',
				),
			),					
		),
		array( 
			'id' => 'usersettings',
			'uri' => 'users',
			'deny' => array( 'admin' ),
			'children' => array(
				array( 
					'id' => 'usersettings-info',
					'uri' => 'users',
					'default' => true,
				),
				array( 
					'id' => 'usersettings-mail',
					'uri' => 'mail',
				),
			),			
		),
		array( 
			'id' => 'usersettings',
			'uri' => 'mail',
			'deny' => array( 'admin' ),
			'children' => array(
				array( 
					'id' => 'usersettings-info',
					'uri' => 'users',
				),
				array( 
					'id' => 'usersettings-mail',
					'uri' => 'mail',
					'default' => true,
				),
			),			
		),
		array( 
			'id' => 'album',
			'uri' => 'album',
			'deny' => array( 'admin' ),
			'children' => array(
				array( 
					'id' => 'albums',
					'uri' => 'album/albums',
					'default' => true,
				),
				array( 
					'id' => 'album-users',
					'uri' => 'album/users',
				),
				array( 
					'id' => 'photo-albums',
					'uri' => '../album',
					'abs_uri' => true,
					'target' => "window_album",
				),
			),			
		),
		array( 
			'id' => 'downloads',
			'uri' => 'downloads',
			'allow' => array( ),
		)
	);

	public function __construct() {
		parent::Model();
		require_once(APPPATH."/legacy/defines.php");

	}

	private function _retrieve( $menus, $user, $current_level ) {
		$result = array();
		$selected = null;
		$selected_children = null;
		$default = null;
		$default_children = null;
		$current_level = ltrim($current_level,"/");
		$last_matched = "";
		foreach( $menus as $menu ) {
			if( isset( $menu['deny'] ) && in_array($user, $menu['deny']) ) {
				continue;
			}
			if( isset( $menu['allow'] ) && !in_array($user, $menu['allow']) ) {
				continue;
			}
			$current = array();

			$aliases = array( $menu['uri'] );
			if( isset( $menu['alias'] ) ) {
				$aliases = array_merge( $aliases, $menu['alias'] );
			}
			$matched = false;
			foreach( $aliases as $alias ) {
				if( strpos( $current_level , $alias ) === 0 && strlen($alias) > strlen($last_matched) ) {
					$matched = true;
					break;
				}
			}

			if( $matched ) {
				$last_matched = $menu['uri'];
				if( !is_null($selected) ) {
					$selected['selected'] = false;
				}
				$selected = &$current;
				if( isset($menu['children']) && is_array($menu['children']) ) {

					$selected_children = $menu['children'];
				}
				$current['selected'] = true;
			}

			if ( isset($menu['default']) && $menu['default'] ) {
				$default = &$current;
				if( isset($menu['children']) && is_array($menu['children']) ) {
					$default_children = $menu['children'];
				}
			}

			$current['uri'] = $menu['uri'];
			$current['id'] = $menu['id'];
			$result[] = &$current;
			unset( $current );
		}

		if( is_null( $selected ) && !is_null( $default ) ) {
			$selected = &$default;
			$selected['selected'] = true;
			$selected_children = $default_children;
		}

		unset( $default );
		unset( $default_children );

		if( 
			!is_null( $selected ) 
			&& isset($selected_children) 
			&& is_array($selected_children) 
		) {
			$selected['children'] = &$this->_retrieve( $selected_children, $user, $current_level );
		}
		unset( $selected );
		unset( $selected_children );

		return $result;
		
	}

	public function retrieve( $user, $level ) {
		$children = $this->_retrieve( $this->bubba_menu, $user, $level );
		return $children;
	}
	
	private function _retreive_dialogmenu($user,$menu) {

		$menubar = array();
		foreach ($menu as $menu_item => $menu_value) {
			if(isset($menu_value['hide']) && in_array($this->uri->segment(1),$menu_value['hide']) ) {
				continue;
			}
			if(isset($menu_value['show']) && !in_array($this->uri->segment(1),$menu_value['show']) ) {
				continue;
			}

			$menubar[$menu_value['id']]['class'] = $menu_value['class'] . " " . $menu_value['icon'];
			$menubar[$menu_value['id']]['name'] = "";
			
			if($menu_value['auth']) $menubar[$menu_value['id']]['class'] .= " fn-require-auth";

			if(isset($menu_value['abs_uri'])) {
				$menubar[$menu_value['id']]['uri'] = $menu_value['uri'];
			} else {
				$menubar[$menu_value['id']]['uri'] = FORMPREFIX.$menu_value['uri'];
			}

			if(isset($menu_value['target'])) {
				$menubar[$menu_value['id']]['target'] = "target='$menu_value[target]'";
			} else {
				$menubar[$menu_value['id']]['target'] = "";
			}


			$item_locked = " fn-login-state-nolock";
			$lock_icon = $menu_value['lock-icon'][0];
			if($menu_value["auth"] && !$this->session->userdata("valid")) {
				$item_locked = " fn-state-login-lock";
				$lock_icon = $menu_value['lock-icon'][1];
			}
			if(isset($menu_value['deny']) && in_array($user,$menu_value['deny']) ) {
				$item_locked = " fn-state-login-lock";
				$lock_icon = $menu_value['lock-icon'][1];
			}
			if(isset($menu_value['allow']) && (sizeof($menu_value['allow']) == 1) ) {
				$menubar[$menu_value['id']]['name'] = $menu_value['allow'][0];
				if(!in_array($user,$menu_value['allow'])) {
					$item_locked = " fn-state-login-lock";
					$lock_icon = $menu_value['lock-icon'][1];
				}
			}
			$menubar[$menu_value['id']]['class'] .= $item_locked;
			$menubar[$menu_value['id']]['class'] .= " " . $lock_icon;
		}
		
		$mymenu = array();
		foreach($menubar as $id => $tags) {
			/*<a class="ui-login-menubar-a default-icon default-icon-settings fn-login-auth-required <?=$ui_login_user_lock?>" href="<?=FORMPREFIX?>/userinfo/"><span><?=t("menubar_usersettings")?></span></a>*/
			$mymenu[] = "<a ".$tags["target"]." class='fn-menubar-link-$id fn-login-dialog-a ".$tags['class']."' href='".$tags['uri']."' name='".$tags['name']."'><div>".t("menubar-link-".$id)."</div></a>";
		}
		return $mymenu;
	}
	
	public function get_dialog_menu() {

		$mainmenu = $this->bubba_menubar;
		$systemmenu = $this->bubba_systembar;
		$user = $this->session->userdata("user");
		$ret["main_menu"] = $this->_retreive_dialogmenu($user,$mainmenu);
		//$ret["system_menu"] = $this->_retreive_dialogmenu($user,$systemmenu);
		return $ret;
	}

	public function get_system_menu() {

		$systemmenu = $this->bubba_systembar;
		$user = $this->session->userdata("user");
		$ret["system_menu"] = $this->_retreive_dialogmenu($user,$systemmenu);
		return $ret;
	}
	
	
}
