<?php

class Ajax_session extends Controller {
	public  $json_data = array();
	public function __construct() {
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);

		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	public function _output($output) {
		echo json_encode($this->json_data);
	}

	public function get_language() {
		$this->json_data['language'] = LANGUAGE;
	}
	
	public function get_userinfo() {
		$this->load->model('auth_model');
		$this->json_data['logged_in'] = $this->Auth_model->CheckAuth();
		$this->json_data['username'] = $this->session->userdata('user');
		$this->json_data['realname'] = $this->session->userdata('realname');
		$this->json_data['groups'] = $this->session->userdata('groups');
		$this->json_data['language'] = LANGUAGE;
		
		if( !is_array($this->json_data['groups']) ) {
			$this->json_data['groups'] = array();
		}
	}

	public function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->load->model('auth_model');
		$success = $this->Auth_model->Login($username, $password);
		$this->json_data['success'] = $success;
	}
	public function logout() {
		$this->load->model('auth_model');
		$this->Auth_model->Logout();
		$this->json_data['success'] = true; // cant fail
	}
	public function modify_user() {
		$this->load->model('auth_model');
		if( ! $this->Auth_model->CheckAuth() ) {
			$this->json_data['success'] = false;
			return;
		}

		$groups = $this->session->userdata('groups');
		if( !is_array($groups) || !isset($groups['bubba']) || !$groups['bubba'] ) {
			$this->json_data['success'] = false;
			return;
		}

		$username = $this->input->post('username');
		$realname = $this->input->post('realname');
		$password = $this->input->post('password');
		if( $password ) {
			$this->Auth_model->set_user_password( $username, $password );
		}
		$this->Auth_model->set_user_realname( $username, $realname );
		
		$this->json_data['success'] = true;
	}
	public function add_user() {
		$this->load->model('auth_model');
		if( ! $this->Auth_model->CheckAuth() ) {
			$this->json_data['success'] = false;
			return;
		}

		$groups = $this->session->userdata('groups');
		if( !is_array($groups) || !isset($groups['bubba']) || !$groups['bubba'] ) {
			$this->json_data['success'] = false;
			return;
		}

		$username = $this->input->post('username');
		$realname = $this->input->post('realname');
		$password = $this->input->post('password');
		$group = $this->input->post('group');
		if( !$password || !$username || !$group ) {
			$this->json_data['success'] = false;
			return;
		}
		$this->Auth_model->add_user( $username, $realname, $password, $group );
		
		$this->json_data['success'] = true;
	}
	public function del_user() {
		$this->load->model('auth_model');
		if( ! $this->Auth_model->CheckAuth() ) {
			$this->json_data['success'] = false;
			return;
		}

		$groups = $this->session->userdata('groups');
		if( !is_array($groups) || !isset($groups['bubba']) || !$groups['bubba'] ) {
			$this->json_data['success'] = false;
			return;
		}

		$username = $this->input->post('username');
		if( !$username ) {
			$this->json_data['success'] = false;
			return;
		}
		$this->Auth_model->del_user( $username );
		
		$this->json_data['success'] = true;
	}

	public function list_users() {
		$this->load->model('auth_model');
		if( ! $this->Auth_model->CheckAuth() ) {
			$this->json_data['success'] = false;
			return;
		}

		$groups = $this->session->userdata('groups');
		if( !is_array($groups) || !isset($groups['bubba']) || !$groups['bubba'] ) {
			$this->json_data['success'] = false;
			return;
		}

		$group = $this->input->post('group');

		$this->json_data['users'] = $this->Auth_model->get_user_list( $group );
		
		$this->json_data['success'] = true;
	}

	public function user_exists() {
		$this->load->model('auth_model');
		if( ! $this->Auth_model->CheckAuth() ) {
			$this->json_data['success'] = false;
			return;
		}

		$groups = $this->session->userdata('groups');
		if( !is_array($groups) || !isset($groups['bubba']) || !$groups['bubba'] ) {
			$this->json_data['success'] = false;
			return;
		}

		$username = $this->input->post('username');

		$this->json_data['success'] = $this->Auth_model->user_exists( $username );
	}
	public function policy() {
		$this->load->model('auth_model');
		if( ! $this->Auth_model->CheckAuth() ) {
			$this->json_data['success'] = false;
			return;
		}

		$groups = $this->session->userdata('groups');
		if( !is_array($groups) || !isset($groups['bubba']) || !$groups['bubba'] ) {
			$this->json_data['success'] = false;
			return;
		}

		$policy = $this->input->post('policy');
		$method = $this->input->post('method');

		$this->json_data['success'] = true;
		$this->json_data['valid'] = $this->Auth_model->policy( $policy, $method );
	}	
}
