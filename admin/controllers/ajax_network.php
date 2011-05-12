<?php
class Ajax_network extends Controller {

	var $json_data=Array(
		'error' => true,
		'html' => 'Ajax Error: Invalid Request'
	);
	function __construct() {
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth('web_admin');

		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
		$this->load->helper('network');
		$this->load->model('networkmanager');        
	}

	function _output($output) {
		echo json_encode($this->json_data);
    }

    function validate_profile_change() {
        $new_profile = $this->input->post("profile");
        $old_profile = $this->session->userdata("network_profile");
        $this->json_data['error'] = false;
        unset($this->json_data['html']);
        if( $old_profile == $new_profile ) {
            // we will not do anything
            $this->json_data['change'] = false;
            return;
        }
        $this->json_data['change'] = true;
        $this->json_data['show_alert'] = true;
		$this->json_data['alert_msg'] = "";

		$server_restart_msg = sprintf(_("This will set network configuration to server mode and restart the network on %s."), NAME)."<br/>"._("Changing network parameters may require a restart of your computer.")."<br/><br/>".sprintf(_("Please see the manual on how to connect your computer to %s."), NAME);
		$router_restart_msg = sprintf(_("This will set network configuration to router mode and restart the network on %s."), NAME)."<br/>"._("Changing network parameters may require a restart of your computer.")."<br/><br/>".sprintf(_("Please see the manual on how to connect your computer to %s."), NAME);
		$auto_restart_msg = sprintf(_("This will restore default network configuration aswell as restarting the network on %s."), NAME)."<br/>"._("Changing network parameters may require a restart of your computer.")."<br/><br/>".sprintf(_("Please see the manual on how to connect your computer to %s."), NAME);

        switch ($old_profile) {
        case "router":
            switch ($new_profile) {
            case "server":
                $this->json_data['alert_msg'] = $server_restart_msg;
                break;
            case "auto":
                $this->json_data['alert_msg'] = $auto_restart_msg;
                break;
            default:
                $this->json_data['error'] = 1;
                $this->json_data['html'] = "Unknown profile $new_profile";
                break;
            }
            break;
        case "server":
            switch ($new_profile) {
            case "router":
                $this->json_data['alert_msg'] = $router_restart_msg;

                break;
            case "auto":
                $this->json_data['alert_msg'] = $auto_restart_msg;
                break;
            default:
                $this->json_data['error'] = 1;
                $this->json_data['html'] = "Unknown profile $new_profile";
                break;
            }
            break;
        case "auto":
            switch ($new_profile) {
            case "router":
                $this->json_data['alert_msg'] = $router_restart_msg;
                break;
            case "server":
                $this->json_data['show_alert'] = false;
                break;
            default:
                $this->json_data['error'] = 1;
                $this->json_data['html'] = "Unknown profile $new_profile";
                break;
            }
            break;
        default:
            // say "custom"...
            $this->json_data['alert_msg'] = _("Apply profile: '$new_profile'?");
            break;
        }      
    }

    public function tor_update() {
        $enabled = $this->input->post('enabled');
        $relay_port = $this->input->post('relay_port');

        if($enabled) {
            $this->networkmanager->enable_tor();
        } else {
            $this->networkmanager->disable_tor();
        }

        $relay_port = $this->input->post('relay_port');
        $dir_port = $this->input->post('dir_port');

        $this->networkmanager->tor_trigger_ports($relay_port, $dir_port, $enabled);
        $this->networkmanager->tor_setconfig($_POST);

        $this->json_data['error'] = false;
    }
}
