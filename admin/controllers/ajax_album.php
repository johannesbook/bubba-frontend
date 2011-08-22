<?php
class Ajax_album extends Controller {

	var $json_data=Array(
		'error' => 1,
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
	}
	function get_album_list() {
		$this->load->model('album_model');
		$album = $this->input->post( 'dir' );
		$data['id'] = $album;
		$data['albums'] = $this->album_model->albums( $album );
		$data['images'] = $this->album_model->images( $album );
		$this->json_data['html'] = $this->load->view(THEME.'/ajax/ajax_album_get_album_list_view', $data, true);
		$this->json_data['error'] = 0;
	}

	function get_album_metadata() {
		$this->load->model('album_model');
		$album = $this->input->post( 'album' );
		$data = $this->album_model->album_data( $album );
		$this->json_data['html'] = '';
		$this->json_data['name'] = $data['name'];
		$this->json_data['caption'] = $data['caption'];
		$this->json_data['error'] = 0;
	}

	function get_image_metadata() {
		$this->load->model('album_model');
		$image = $this->input->post( 'image' );
		$data = $this->album_model->image_data( $image );
		$this->json_data['html'] = '';
		$this->json_data['image'] =site_url( "image/thumb/".$data['id'] );
		$this->json_data['name'] = $data['name'];
		$this->json_data['caption'] = $data['caption'];
		$this->json_data['path'] = $data['path'];


		$this->json_data['error'] = 0;
	}
	function get_album_access_list() {
		$this->load->model('album_model');
		$album = $this->input->post( 'album' );
		$data = $this->album_model->album_access_list( $album );
		$this->json_data['html'] = '';
		$this->json_data['list'] = $data;
		$this->json_data['public'] = $this->album_model->album_is_public( $album );


		$this->json_data['error'] = 0;
	}
	function get_users() {
		$this->load->model('album_model');
		$data = $this->album_model->album_get_users();
		$this->json_data['html'] = '';
		$this->json_data['users'] = $data;
		$this->json_data['error'] = 0;
	}
	function modify_user_access() {
		$this->load->model('album_model');
		$uid = $this->input->post( 'uid' );
		$album = $this->input->post( 'album' );
		$res = $this->album_model->modify_album_access( $album, $uid );

		$this->json_data['html'] = $res["html"];
		$this->json_data['error'] = $res["error"];

	}
	function set_public() {
		$this->load->model('album_model');
		$album = $this->input->post( 'album' );
		$public = $this->input->post('public');
		$res = $this->album_model->album_set_public( $album, $public );

		$this->json_data['html'] = $res;
		$this->json_data['error'] = 0;

	}
	function remove_user() {
		$this->load->model('album_model');
		$uid = $this->input->post( 'uid' );
		$res = $this->album_model->album_remove_user( $uid );

		$this->json_data['html'] = $res;
		$this->json_data['error'] = 0;

	}
	function modify_user() {
		$this->load->model('album_model');
		$uid = $this->input->post( 'uid' );
		$username = $this->input->post( 'username' );
		$password = $this->input->post( 'password' );
		try {
			$res = $this->album_model->album_modify_user( $uid, $username, $password );
			$this->json_data['html'] = $res;
			$this->json_data['error'] = 0;
		} catch( Exception $e ) {
			$this->json_data['html'] = $e->getMessage();
			$this->json_data['error'] = 1;
		}

	}
	function add_user() {
		$this->load->model('album_model');
		$username = $this->input->post( 'username' );
		$password = $this->input->post( 'password' );
		if( $this->album_model->album_user_exists( $username ) ) {
			$this->json_data['html'] = "$username allready exists";
			return;
		}
		$res = $this->album_model->album_add_user( $username, $password );

		$this->json_data['uid'] = $res;
		$this->json_data['error'] = 0;

	}
	function move() {
		$this->load->model('album_model');
		$id = $this->input->post( 'id' );
		$target = $this->input->post('target');
		$album = $this->input->post( 'album' );
		if( $album == 'true' ) {
			$res = $this->album_model->move_album( $id, $target );
		} else {
			$res = $this->album_model->move_image( $id, $target );
		}

		$this->json_data['html'] = $res;
		$this->json_data['error'] = 0;

	}

	function delete_image() {
		$this->load->model('album_model');
		$id = $this->input->post( 'id' );
		$res = $this->album_model->album_delete_image( $id );

		$this->json_data['html'] = $res;
		$this->json_data['error'] = 0;

	}

	function delete_album() {
		$this->load->model('album_model');
		$id = $this->input->post( 'id' );
		$res = $this->album_model->album_delete_album( $id );

		$this->json_data['html'] = $res;
		$this->json_data['error'] = 0;

	}
	function create_album() {
		$this->load->model('album_model');
		$this->json_data['id'] = $this->album_model->album_create_album();

		$this->json_data['html'] = '';
		$this->json_data['error'] = 0;

	}
	function update_image_metadata() {
		$this->load->model('album_model');
		$id = $this->input->post( 'id' );
		$name = $this->input->post('name');
		$caption = $this->input->post( 'caption' );
		$res = $this->album_model->update_image_metadata( $id, $name, $caption );

		$this->json_data['html'] = $res;
		$this->json_data['error'] = 0;

	}
	function update_album_metadata() {
		$this->load->model('album_model');
		$id = $this->input->post( 'id' );
		$name = $this->input->post('name');
		$caption = $this->input->post( 'caption' );
		$res = $this->album_model->update_album_metadata( $id, $name, $caption );

		$this->json_data['html'] = $res;
		$this->json_data['error'] = 0;

	}

	function _output($output) {
		echo json_encode($this->json_data);
	}
} 
