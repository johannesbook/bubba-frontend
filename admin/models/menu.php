<?php
class Menu extends Model {

    private $bubba_systembar, $bubba_menubar, $bubba_menu, $resolver_list;

    public function __construct() {
        parent::Model();
        require_once(APPPATH."/legacy/defines.php");

        $this->bubba_systembar = array(
            array(
                'label' => pgettext('menu',"System settings"),
                'id' => 'systemsettings',
                'uri' => '/stat',
                'auth' => true,
                'class' => 'ui-login-menubar-a',
                'icon' => 'default-icon',
                'lock-icon' => array("default-icon-settings","default-icon-settings-lock"),
                'allow' => array( 'admin' ),
            ),
        );

        $this->bubba_menubar = array(
            array(
                'label' => pgettext('menu',"File Manager"),
                'id' => 'filemanager',
                'uri' => '/filemanager',
                'auth' => true,
                'class' => 'ui-login-menubar-a',
                'icon' => 'default-icon',
                'lock-icon' => array("default-icon-filemanager","default-icon-filemanager-lock"),
            ),
            array(
                'label' => pgettext('menu',"Music"),
                'id' => 'music',
                'uri' => '/music',
                'auth' => true,
                'class' => 'ui-login-menubar-a',
                'icon' => 'default-icon',
                'lock-icon' => array("default-icon-music","default-icon-music-lock"),
                'target' => "_blank",
            ),
            array(
                'label' => pgettext('menu',"Album"),
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
                'label' => pgettext('menu',"Downloads"),
                'id' => 'downloads',
                'uri' => '/downloads',
                'auth' => true,
                'class' => 'ui-login-menubar-a',
                'icon' => 'default-icon',
                'lock-icon' => array("default-icon-downloads","default-icon-downloads-lock"),
                'deny' => array( 'admin' ),
            ),
            array(
                'label' => pgettext('menu',"Webmail"),
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
                'label' => pgettext('menu',"User settings"),
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


        $this->bubba_menu = array(
            array(
                'label' => pgettext('menu',"Home"),
                'id' => 'home',
                'default' => true,
                'uri' => 'stat',
                'allow' => array( 'admin' ),
            ),
            array(
                'label' => pgettext('menu',"File Manager"),
                'id' => 'filemanager',
                'uri' => 'filemanager'
            ),

            array(
                'label' => pgettext('menu',"Backup"),
                'id' => 'backup',
                'uri' => 'backup',
                'allow' => array('admin')
            ),

            array(
                'label' => pgettext('menu',"Users"),
                'id' => 'users',
                'uri' => 'users',
                'allow' => array( 'admin' ),
            ),
            array(
                'label' => pgettext('menu',"Services"),
                'id' => 'services',
                'uri' => 'services',
                'allow' => array( 'admin' ),
            ),
            array(
                'label' => pgettext('menu',"Mail"),
                'id' => 'mail',
                'uri' => 'mail',
                'allow' => array( 'admin' ),
                'children' => array(
                    array(
                        'label' => pgettext('menu',"Retrieve email"),
                        'id' => 'mail-retrieve',
                        'uri' => 'mail/index',
                        'default' => true,
                    ),
                    array(
                        'label' => pgettext('menu',"Server settings"),
                        'id' => 'mail-server_settings',
                        'uri' => 'mail/server_settings',
                        'alias' => array( 'mail/server_update','mail/mc_update' )
                    ),
                ),
            ),
            array(
                'label' => pgettext('menu',"Network"),
                'id' => 'network',
                'uri' => 'network',
                'allow' => array( 'admin' ),
                'children' => array(
                    array(
                        'label' => pgettext('menu',"Profile"),
                        'id' => 'network-profile',
                        'uri' => 'network/profile',
                        'default' => true,
                    ),
                    array(
                        'label' => pgettext('menu',"WAN"),
                        'id' => 'network-wan',
                        'uri' => 'network/wan',
                    ),
                    array(
                        'label' => pgettext('menu',"LAN"),
                        'id' => 'network-lan',
                        'uri' => 'network/lan',
                    ),
                    array(
                        'label' => pgettext('menu',"Wireless"),
                        'id' => 'network-wlan',
                        'uri' => 'network/wlan',
                    ),
                    array(
                        'label' => pgettext('menu',"Firewall"),
                        'id' => 'network-firewall',
                        'uri' => 'network/fw',
                    ),
					array(
                        'label' => pgettext('menu',"Tor"),
						'id' => 'network-tor',
						'uri' => 'network/tor',
					),

                ),
            ),
            array(
                'label' => pgettext('menu',"Disk"),
                'id' => 'disk',
                'uri' => 'disk',
                'allow' => array( 'admin' ),
                'children' => array(
                    array(
                        'label' => pgettext('menu',"Disk information"),
                        'id' => 'disk-info',
                        'uri' => 'disk/',
                        'default' => true,
                    ),
                    array(
                        'label' => pgettext('menu',"LVM"),
                        'id' => 'disk-lvm',
                        'uri' => 'disk/lvm',
                    ),
                    array(
                        'label' => pgettext('menu',"RAID"),
                        'id' => 'disk-raid',
                        'uri' => 'disk/raid',
                    ),
                ),
            ),
            array(
                'label' => pgettext('menu',"Settings"),
                'id' => 'settings',
                'uri' => 'settings',
                'allow' => array( 'admin' ),
                'children' => array(
                    array(
                        'label' => pgettext('menu',"Setup wizard"),
                        'id' => 'settings-wizard',
                        'uri' => 'settings/startwizard',
                        'default' => true,
                    ),
                    array(
                        'label' => pgettext('menu',"Identity"),
                        'id' => 'settings-identity',
                        'uri' => 'settings/identity',
                    ),

                    array(
                        'label' => pgettext('menu',"Torrent throttle"),
                        'id' => 'settings-traffic',
                        'uri' => 'settings/trafficsettings',
                        'alias' => array( 'settings/settraffic' ),
                    ),
                    array(
                        'label' => pgettext('menu',"Time and language"),
                        'id' => 'settings-date',
                        'uri' => 'settings/datetime',
                        'alias' => array( 'settings/setdate', 'settings/set_lang'),
                    ),
                    array(
                        'label' => pgettext('menu',"System backup"),
                        'id' => 'settings-sysbackup',
                        'uri' => 'settings/backuprestore',
                        'alias' => array('settings/backup','settings/restore'),
                    ),
                    array(
                        'label' => pgettext('menu',"Software update"),
                        'id' => 'settings-update',
                        'uri' => 'settings/software',
                    ),
                    array(
                        'label' => pgettext('menu',"Logs"),
                        'id' => 'settings-logs',
                        'uri' => 'settings/logs',
                    ),
                ),
            ),
            array(
                'label' => pgettext('menu',"User settings"),
                'id' => 'usersettings',
                'uri' => 'users',
                'deny' => array( 'admin' ),
                'children' => array(
                    array(
                        'label' => pgettext('menu',"User information"),
                        'id' => 'usersettings-info',
                        'uri' => 'users',
                        'default' => true,
                    ),
                    array(
                        'label' => pgettext('menu',"Email"),
                        'id' => 'usersettings-mail',
                        'uri' => 'mail',
                    ),
                ),
            ),
            array(
                'label' => pgettext('menu',"User settings"),
                'id' => 'usersettings',
                'uri' => 'mail',
                'deny' => array( 'admin' ),
                'children' => array(
                    array(
                        'label' => pgettext('menu',"User information"),
                        'id' => 'usersettings-info',
                        'uri' => 'users',
                    ),
                    array(
                        'label' => pgettext('menu',"Email"),
                        'id' => 'usersettings-mail',
                        'uri' => 'mail',
                        'default' => true,
                    ),
                ),
            ),
            array(
                'label' => pgettext('menu',"Album"),
                'id' => 'album',
                'uri' => 'album',
                'deny' => array( 'admin' ),
                'children' => array(
                    array(
                        'label' => pgettext('menu',"Albums"),
                        'id' => 'albums',
                        'uri' => 'album/albums',
                        'default' => true,
                    ),
                    array(
                        'label' => pgettext('menu',"Users"),
                        'id' => 'album-users',
                        'uri' => 'album/users',
                    ),
                    array(
                        'label' => pgettext('menu',"Albums"),
                        'id' => 'photo-albums',
                        'uri' => '../album',
                        'abs_uri' => true,
                        'target' => "window_album",
                    ),
                ),
            ),
            array(
                'label' => pgettext('menu',"Downloads"),
                'id' => 'downloads',
                'uri' => 'downloads',
                'allow' => array( ),
            )
        );
        $list = array();

        $mapper = function($a) use(&$list, &$mapper){
            if(is_array($a)) {
                $list[$a['uri']] = $a['label'];
                if(isset($a['children']) && is_array($a['children'])) {
                    array_walk($a['children'], $mapper);
                }
            }
        };
        array_walk($this->bubba_systembar, $mapper);
        array_walk($this->bubba_menu, $mapper);
        array_walk($this->bubba_menubar, $mapper);

        $this->resolver_list = $list;
    }

    public function resolve($id) {
		if(!$id){
			# no id means we are on first page
			return _("Home");
		}else if(isset($this->resolver_list[$id])){
            return $this->resolver_list[$id];
        } else {
            return "N/A";
        }
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
            $current['label'] = $menu['label'];
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
            $menubar[$menu_value['id']]['label'] = $menu_value['label'];

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
            if($menu_value["auth"] && !$this->Auth_model->CheckAuth("web_admin")) {
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
            /*<a class="ui-login-menubar-a default-icon default-icon-settings fn-login-auth-required <?=$ui_login_user_lock?>" href="<?=FORMPREFIX?>/userinfo/"><span><?=pgettext('menu',"menubar_usersettings")?></span></a>*/
            $mymenu[] = "<a ".$tags["target"]." class='fn-menubar-link-$id fn-login-dialog-a ".$tags['class']."' href='".$tags['uri']."' name='".$tags['name']."'><div>".$tags['label']."</div></a>";
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
