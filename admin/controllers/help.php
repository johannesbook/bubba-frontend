<?php

class Help extends Controller{

    /* A couple of pages contains the same content and/or the same help text */
    private $index_map = array(
        'user_index' => 'user_login',
        'index' => 'login',
        'filemanager_cd' => 'filemanager',
        'mail_index' => 'mail',
        'network_profile' => 'network',
        'update_profile' => 'network',
        'settings_startwizard' => 'settings',
        'settings_backup' => 'settings_backuprestore',
        'settings_restore' => 'settings_backuprestore',
        'user_users_edit' => 'user_users',
    );

    function help(){
        parent::Controller();
        require_once(APPPATH."/legacy/defines.php");
    }

    function load($strip="",$uri="") {
        if(isset($this->index_map[$uri])) {
            $uri = $this->index_map[$uri];
        }


        $path = "views/".THEME.'/help/'.LANGUAGE.'/'.$uri.".html";

        /* The help text might not be translated, resort to English */
        if(!file_exists($path)) {
            $path = "views/".THEME.'/help/en/'.$uri.".html";
        }

        if(file_exists($path)) {
            if($strip == "html") {
                $data = $this->load->file($path, true);
                $data = str_replace(
                    array(
                        '{PLATFORM}',
                        '{EASYFIND}',
                        '{DEFAULT_HOST}',
                    ),
                    array(
                        NAME,
                        EASYFIND,
                        DEFAULT_HOST,
                    ),
                    $data
                );
                echo($data);
            }
        } else {
            printf(_("Error: No help text was found for entry %s"), $uri);
        }
    }

    function index () {
    }
}
