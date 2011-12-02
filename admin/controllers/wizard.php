<?php
class wizard extends Controller {

    function __construct() {
        parent::Controller();
        require_once(APPPATH."/legacy/defines.php");
        require_once(ADMINFUNCS);

        $this->Auth_model->EnforceAuth('web_admin');
        $this->Auth_model->enforce_policy('web_admin','administer', 'admin');
    }

    public function get_languages() {

        $languages = $this->gettext->get_languages();
        $official_languages= array();
        $user_languages = array();


        foreach( $languages as $language ) {
            if($language['status'] == 'official') {
                $official_languages[] = $language;
            }
            if($language['status'] == 'user') {
                $user_languages[] = $language;
            }

        }
        $data['official_languages'] = $official_languages;
        $data['user_languages'] = $user_languages;
        $this->load->view(THEME.'/wizard_lang_view', $data);
    }

    public function get_wizard() {
        $this->load->model('system');
        $this->load->model('networkmanager');

        $language = $this->input->post('language');
        $languages = $this->gettext->get_languages();
        if(isset($languages[$language])) {
            $locale = $languages[$language]['locale'];
        } else {
            $locale = "en_US";
        }
        setlocale(LC_MESSAGES, $locale);

        # Timezones

        $data['timezones'] = $this->system->list_timezones();
        $data['current_timezone'] = $this->system->get_timezone();

        $current_easyfind = $this->networkmanager->get_easyfind();
        $data['enabled_easyfind'] = isset($current_easyfind['name']) && $current_easyfind['name'];
        $data['easyfind_name'] = str_replace( ".".EASYFIND, "", isset($current_easyfind['name']) && $current_easyfind['name'] ? $current_easyfind['name'] : "");

        $data['easyfind_display_name'] = $data['easyfind_name'] ? $data['easyfind_name'] : _("your-easyfind-name");
        $this->load->view(THEME.'/wizard_view', $data);
    }

    public function update() {
        $this->load->model("auth_model");
        $this->load->model("system");
        $this->load->model("networkmanager");
        $language = trim($this->input->post('language'));
        $admin_password1 = trim($this->input->post('admin_password1'));
        $admin_password2 = trim($this->input->post('admin_password2'));
        $easyfind_name = $this->input->post('easyfind_name');
        $enable_easyfind = $this->input->post('enable_easyfind');
        $password1 = trim($this->input->post('password1'));
        $password2 = trim($this->input->post('password2'));
        $realname = trim($this->input->post('realname'));
        $timezone = $this->input->post('timezone');
        $username = trim($this->input->post('username'));


        $this->mark_dirty();

        $errors = array();

        try {
            if($language) {
                $languages = $this->gettext->get_languages();
                if(isset($languages[$language])) {
                    $locale = $languages[$language]['locale'];
                    update_bubbacfg("admin","default_lang",$language);
                    update_bubbacfg("admin","default_locale",$locale);
                    $conf = parse_ini_file(ADMINCONFIG);
                    if(! (isset($conf['language']) && $conf['language'])) {
                        $this->session->set_userdata('language',$language);
                        $this->session->set_userdata('locale',$locale);
                    }
                } else {
                    throw new Exception("Unavailable language");
                }
            }
        } catch( Exception $e ) {
            $errors[] = $e->getMessage();
        }

        try {
            if($timezone !== $this->system->get_timezone()) {
                $this->system->set_timezone($timezone);
            }
        } catch( Exception $e ) {
            $errors[] = $e->getMessage();
        }

        try {
            if( $admin_password1 && $admin_password1 == $admin_password2 ) {
                _system(BACKEND, "set_unix_password", 'admin', $admin_password1);
            }
        } catch( Exception $e ) {
            $errors[] = $e->getMessage();
        }

        try {
            if( $username && $password1 && $password1 == $password2 ) {
                $shell = '/usr/sbin/nologin';
                $group = 'users'; // Static group for em all

                if (
                    $this->auth_model->user_exists($username)
                    || $username == "root"
                    || $username == "storage"
                    || $username == "web"
                    || $username == ""
                    || strpos($username, ' ') !== false
                    || !preg_match('/^[a-z0-9 _-]+$/',$username)
                    || strlen($username) > 32
                    || $username[0] == '-'
                    || $password1 == ""
                    || $password1 != $password2
                ) {
                    throw new Exception(_('User name validation failed'));
                } else {
                    _system(BACKEND, "add_user", $realname, $group, $shell, $password1, $username);
                }
            }
        } catch( Exception $e ) {
            $errors[] = $e->getMessage();
        }

        try {
            // Grabbed from settings.php mostly
            if( $enable_easyfind ) {
                $current_easyfind = $this->networkmanager->get_easyfind();
                if(isset($easyfind_name) && ( $easyfind_name  != $current_easyfind['name'])) {
                    $valid = $this->networkmanager->easyfind_validate($easyfind_name);
                    if($valid) {
                        $server_response = $this->networkmanager->easyfind_setname($easyfind_name.".".EASYFIND);
                        $this->networkmanager->enable_igd_easyfind(true);
                        if($server_response['error']) {
                            $msg = $this->networkmanager->decode_easyfindmsg($server_response);
                            throw new Exception(sprintf(_("Easyfind failed with following error: %s"), $msg));
                        }
                    } else {
                        throw new Exception(_("Name is not valid"));
                    }

                }
            } else {
                $server_response = $this->networkmanager->easyfind_setname("");
                $this->networkmanager->enable_igd_easyfind(false);
                if($server_response['error']) {
                    $msg = $this->networkmanager->decode_easyfindmsg($server_response);
                    throw new Exception(sprintf(_("Easyfind failed with following error: %s"), $msg));
                }
            }
        } catch( Exception $e ) {
            $errors[] = $e->getMessage();
        }

        if(!empty($errors)) {
            $this->output->set_output(json_encode(array('error' => true, 'messages' => $errors)));
        } else {
            $this->output->set_output(json_encode(array('error' => false,)));
        }
    }

    public function validate_easyfind() {
        $this->load->model('networkmanager');

        $name = $this->input->post("easyfind_name");
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
        $this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

        if(!$this->networkmanager->easyfind_validate($name)) {
            $this->output->set_output("false");
            return;
        }
        $wanif = $this->networkmanager->get_wan_interface();
        $mac = $this->networkmanager->get_mac($wanif);
        try {
            $available = $this->networkmanager->easyfind_available($name, $mac);
        } catch( Exception $e ) {
            $available = false;
        }
        $this->output->set_output(json_encode($available === true));
    }

    public function username_is_available() {
        $this->load->model("auth_model");
        $username=strtolower(trim($this->input->post('username')));


        header("Content-type: application/json");
        $this->output->set_output(json_encode( !$this->auth_model->user_exists($username) ));

    }

    public function mark_dirty() {
        unset($_SESSION['run_wizard']);
        update_bubbacfg($_SESSION['user'],'run_wizard',"no");
    }
}
