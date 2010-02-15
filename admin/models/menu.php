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
					'id' => 'browse',
					'uri' => 'filemanager/',
					'default' => true,
				),
				array(
					'id' => 'backup',
					'uri' => 'filemanager/backup',
					'allow' => array( 'admin' ),
				),
				array(
					'id' => 'restore',
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
			'id' => 'usermail',
			'uri' => 'usermail',
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
			'allow' => array( 'admin' ),
			'children' => array(
				array(
					'id' => 'retrieve',
					'uri' => 'mail/retrieve',
					'default' => true,
				),
				array(
					'id' => 'send',
					'uri' => 'mail/send',
					'allow' => array( 'admin' ),
				),
				array( 
					'id' => 'recieve',
					'uri' => 'mail/recieve',
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
					'id' => 'profile',
					'uri' => 'network/profile',
					'default' => true,
				),
				array(
					'id' => 'wan',
					'uri' => 'network/wan',
				),
				array(
					'id' => 'lan',
					'uri' => 'network/lan',
				),
				array(
					'id' => 'wlan',
					'uri' => 'network/wlan',
				),
				array(
					'id' => 'identity',
					'uri' => 'network/other',
				),
				array(
					'id' => 'firewall',
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
					'id' => 'info',
					'uri' => 'disk/',
					'default' => true,
				),
				array(
					'id' => 'lvm',
					'uri' => 'disk/lvm',
				),
				array( 
					'id' => 'raid',
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
					'id' => 'wizard',
					'uri' => 'settings/startwizard',
					'default' => true,
				),
				array(
					'id' => 'traffic',
					'uri' => 'settings/trafficsettings',
				),
				array( 
					'id' => 'date',
					'uri' => 'settings/datetime',
				),
				array(
					'id' => 'sysbackup',
					'uri' => 'settings/backuprestore',
				),
				array(
					'id' => 'update',
					'uri' => 'settings/software',
				),
				array( 
					'id' => 'logs',
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
		foreach( $menus as $menu ) {
			if( isset( $menu['deny'] ) && in_array($user, $menu['deny']) ) {
				continue;
			}
			if( isset( $menu['allow'] ) && !in_array($user, $menu['allow']) ) {
				continue;
			}
			$current = array();


			if( strpos( $current_level, $menu['uri'] ) === 0 ) {
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
