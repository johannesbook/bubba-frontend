<?php

class Album extends Controller {
	function __construct() {
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth();
		$this->Auth_model->DenyUser('admin');
		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}
	private function _renderfull($content, $head = ''){
		if( ! $head ) {
			$mdata["head"] = $this->load->view(THEME.'/users/user_head_view','',true);
		} else {
			$mdata['head'] = $head;
		}
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}


	function index() {
		redirect( 'album/albums' );
	}

	function albums() {
		$db = $this->load->database('album', true);
		$data['free_images'] = $db->select('id, name')->from('image')->where( array( 'album' => null ) )->get()->result_array();
		$data['albums'] = $db->select('id, name, parent')->from('album')->get()->result_array();
		$data['images'] = array();

		$imgs = $db->select('id, name, album,width,height')->from('image')->get()->result_array();
		foreach( $imgs as $img ) {
			$data['images'][$img['album']][] = $img ;
		}
		$this->_renderfull(
			$this->load->view(THEME.'/album/album_album_view',$data,true),
			$this->load->view(THEME.'/album/album_head_view',$data,true)
		);
	}

	function users($strip="") {
		$data = array();
		$this->load->model('album_model');
		$data['accounts'] = $this->album_model->album_get_users();
		if($strip == "json" ){
			header("Content-type: application/json");
			echo json_encode( $data );
		}else{
			$data["allow_delete"] = $this->Auth_model->policy("album","delete");	
			$data["allow_add"] = $this->Auth_model->policy("album","add");	
			$data["allow_list"] = $this->Auth_model->policy("album","list");	

			$this->_renderfull(
				$this->load->view(THEME.'/album/album_users_view',$data,true),
				$this->load->view(THEME.'/album/album_users_head_view',$data,true)
			);
		}
	}

	public function check_username($strip="") {
		if( $strip == 'json' ) {
			$this->load->model('album_model');
			$username=strtolower(trim($this->input->post('username')));


			header("Content-type: application/json");
			echo json_encode( !$this->album_model->album_user_exists( $username ) );

		}
	}	
	public function add_user_account($strip=""){
		if( $strip == 'json' ) {
			$this->load->model('album_model');

			$error = false;

			$username=strtolower(trim($this->input->post('username')));
			$password1=trim($this->input->post('password1'));
			$password2=trim($this->input->post('password2'));

			if (
				$password1 == ""
				|| $password1 != $password2
				|| $this->album_model->album_user_exists( $username )
			) {
				$error = t('album-users-add-account-validation-error');
			} else {
				$res = $this->album_model->album_add_user( $username, $password1 );
			}

			$data['success'] = !$error;
			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			return;
		}
	}

	public function edit_user_account($strip=""){
		if( $strip == 'json' ) {
			$this->load->model('album_model');

			$error = false;

			$username=strtolower(trim($this->input->post('username')));
			$password1=trim($this->input->post('password1'));
			$password2=trim($this->input->post('password2'));
			$uid=trim($this->input->post('uid'));

			if (
				$password1 != $password2
			) {
				$error = t('album-users-add-account-validation-error');
			} else {
				try {
					$res = $this->album_model->album_modify_user( $uid, $username, $password1 );
				} catch( Exception $e ) {
					$error = $e->getMessage();
				}
			}

			$data['success'] = !$error;
			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			return;
		}
	}

	public function delete_user_account($strip=""){
		if( $strip == 'json' ) {
			$this->load->model('album_model');

			$error = false;

			$uid=trim($this->input->post('uid'));
			try {
				$res = $this->album_model->album_remove_user( $uid );
			} catch( Exception $e ) {
				$error = $e->getMessage();
			}

			$data['success'] = !$error;
			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			return;
		}
	}
	
}
