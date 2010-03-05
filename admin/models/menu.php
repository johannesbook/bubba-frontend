<?php
class Menu extends Model {
	private $bubba_menu = array(
		array( 
			'id' => 'home',
			'default' => true,
			'uri' => 'stat',
		),
		array( 
			'id' => 'filemanager',
			'uri' => 'filemanager',
			'children' => array(
				array(
					'id' => 'filemanager-browse',
					'uri' => 'filemanager/',
					'default' => true,
				),
				array(
					'id' => 'filemanager-backup',
					'uri' => 'filemanager/backup',
					'allow' => array( 'admin' ),
				),
				array(
					'id' => 'filemanager-restore',
					'uri' => 'filemanager/restore',
					'allow' => array( 'admin' ),
				),
			),
		),
		array( 
			'id' => 'userinfo',
			'uri' => 'userinfo',
			'deny' => array( 'admin' ),
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
			'children' => array(
				array(
					'id' => 'mail-retrieve',
					'uri' => 'mail/index',
					'default' => true,
				),
				array(
					'id' => 'mail-server_settings',
					'uri' => 'mail/server_settings',
					'allow' => array( 'admin' ),
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
				),
				array( 
					'id' => 'settings-date',
					'uri' => 'settings/datetime',
				),
				array(
					'id' => 'settings-sysbackup',
					'uri' => 'settings/backuprestore',
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
					'id' => 'users',
					'uri' => 'album/users',
				),
			),			
		),
		array( 
			'id' => 'downloads',
			'uri' => 'downloads',
			'deny' => array( 'admin' ),
		)
	);

	public function __construct() {
		parent::Model();
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

			if( strpos( $current_level , $menu['uri'] ) === 0 && strlen($menu['uri']) > strlen($last_matched) ) {
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
}
