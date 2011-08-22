<?php
class Album_model extends Model {
	private $DB;
	private $mime_types = array(
		'image/png' => false,
		'image/x-png' => false,
		'image/gif' => false,
		'image/jpeg' => true,
	);
	function __construct() {
		parent::Model();
		$this->DB = $this->load->database('album', true);
		$this->load->helper('bubba_socket');

	}

	function _batch_add_socket( $process ) {
		syslog( LOG_INFO, 'here' );
		$sock = new BubbaAlbumSocket();
		$ret = "";
		foreach( $process as $id => $file ) {
			$sock->say( json_encode( array( 'action' => 'add', 'id' => $id, 'file' => $file ) ) );
			$ret = $sock->getline();
		}
		$sock->close();
		return $ret;
	}
	function batch_add( $files ) {
		$origdir = getcwd();
		$added = $this->_batch_add( $files );
		chdir($origdir);
		return $added;
	}

	function _batch_add( $files, $parent = null ) {
		$added = array();
		$to_process = array();
		foreach( $files as $file ) {
			if( $file == '.' || $file == '..' ) {
				continue;
			}
			$file = rawurldecode( $file );
			if( is_dir( $file )) {
				$subalbum = basename( $file );
				$this->DB->insert( 'album', array( 'name' => $subalbum, 'parent' => $parent, 'public' => false ) );
				$subalbum_id = $this->DB->insert_id();
				chdir( $file );
				$added = array_merge( $added, $this->_batch_add( scandir( "." ), $subalbum_id ) );
				chdir ( '..' );
			} else {
				if( filesize( $file ) == 0 || exif_imagetype( $file ) != IMAGETYPE_JPEG ) {
					$added[realpath($file)] = false;
					continue;
				}
				$added[realpath($file)] = true;
				list( $width, $height ) = getimagesize( $file );
				$this->DB->insert( 
					'image', 
					array( 
						'album' => $parent,  
						'name' => $file,
						'path' => realpath($file), 
						'width' => $width, 
						'height' => $height
					)
				);
				$image_id = $this->DB->insert_id();
				$to_process[$image_id] = realpath($file);
			}
		}
		$this->_batch_add_socket( $to_process );
		return $added;
	}

	function albums( $album ) {
		if( $album == 0 ) { $album = null; }
		$query = $this->DB->select('id, name')->from('album')->where( array( 'parent' =>  $album ) );
		$result = $query->get();
		return $result->result_array();

	}

	function images( $album ) {
		if( $album == 0 ) { $album = null; }
		$query = $this->DB->select('id, name')->from('image')->where( array( 'album' =>  $album ) );
		$result = $query->get();
		return $result->result_array();

	}

	function album_data( $album ) {
		$query = $this->DB->select('id, name, caption')->from('album')->where( array( 'id' =>  $album ) );
		$result = $query->get();
		return $result->row_array();
	}

	function album_get_users() {
		$query = $this->DB->select('id, username')->from('users');
		$result = $query->get();
		return $result->result_array();
	}
	function album_user_exists($username) {
		$query = $this->DB->query('SELECT id FROM users WHERE username = ?',array($username));
		return $query->num_rows() > 0;
	}
	function image_data( $image ) {
		$query = $this->DB->select('id, name, caption, path')->from('image')->where( array( 'id' =>  $image ) );
		$result = $query->get();
		return $result->row_array();
	}
	function album_is_public( $album ) {
		$parent = $album;
		$self_public = false;
		do {
			$query = $this->DB->select('parent, public')->from('album')->where( array( 'id' =>  $parent ) );
			$result = $query->get()->row();
			if( $result->public == 0 ) {
				return array( 'child' =>  $album != $parent, 'public' =>  false, 'selfpublic' => $self_public );
			} 

			if( $result->public == 1 && $parent == $album ) {
				$self_public = true;
			}
			$parent = $result->parent;
		} while ( !is_null($parent) );
		return array( 'child' =>  null, 'public' =>  true, 'selfpublic' => $self_public );
	}
	function album_set_public( $id, $public ) {
		$this->DB->update('album', array( 'public' => $public ), array( 'id' => $id ) );
		return $this->DB->last_query();
		#return $this->DB->affected_rows();
	}
	function album_remove_user( $uid ) {
		$this->DB->delete('users', array( 'id' => $uid ) );
		return $this->DB->last_query();
		#return $this->DB->affected_rows();
	}
	function album_modify_user( $uid, $username, $password ) {
		$this->load->helper('security');
		$query = $this->DB->select('id')->from('users')->where( array( 'username' => $username ) )->get();
		if( $query->num_rows() > 0 ) {
			if( $uid != $query->row()->id ) {
				throw new Exception(_("Username allready exists"));
			}
		}
		if( $password == '' ) {
			$this->DB->update('users', array('username' => $username ), array( 'id' => $uid ) );
		} else {
			$this->DB->update('users', array('username' => $username, 'password' => dohash( $password, 'md5' ) ), array( 'id' => $uid ) );
		}
		return $this->DB->last_query();
		#return $this->DB->affected_rows();
	}
	function album_add_user( $username, $password ) {
		$this->load->helper('security');
		$this->DB->insert('users', array('username' => $username, 'password' => dohash( $password, 'md5' ) ) );
		return $this->DB->insert_id();
		#return $this->DB->affected_rows();
	}
	function album_access_list( $album ) {
		// This one is rather ugly, though I don't have time :(
		$query = $this->DB->query("
			SELECT 
				users.id AS userid,
				users.username AS username,
				false AS has_access
			FROM users 
			WHERE users.id NOT IN (
				SELECT user 
				FROM access 
				WHERE access.album = ?
			) 
			UNION
			SELECT 
				users.id AS userid, 
				users.username AS username, 
				true AS has_access
			FROM users WHERE users.id IN (
				SELECT user 
				FROM access 
				WHERE access.album = ?
			)
			ORDER BY username
			", array($album,$album));
		return $query->result_array();
	}
	function modify_album_access( $album, $uids ) {
		
		$retval["error"] = "";
		$retval["html"] = "";
		// remove all user access from the album
		$this->DB->delete( 'access', array( 'album'=> $album) );
		foreach ($uids as $uid) {
			if(! @$this->DB->insert( 'access', array( 'album'=> $album, 'user' => $uid ) )) {
				$reval["error"] .= "Error adding userid $uid";
			}
		}
		$retval["html"] .= $this->DB->last_query();
		return $retval;
	}
	function move_album( $id, $target ) {
		$this->DB->update('album', array( 'parent' => $target ), array( 'id' => $id ) );
		return $this->DB->last_query();
		#return $this->DB->affected_rows();
	}
	function album_create_album() {
		$this->DB->insert('album', array( 'name' => 'New Album', 'caption' => '', 'public' => false ) );
		return $this->DB->insert_id();
		#return $this->DB->affected_rows();
	}
	function move_image( $id, $target ) {
		$this->DB->update('image', array( 'album' => $target ), array( 'id' => $id ) );
		return $this->DB->last_query();
	}
	function album_delete_image( $id ) {
		$this->DB->delete('image', array( 'id' => $id ) );
		return $this->DB->last_query();
		#return $this->DB->affected_rows();
	}
	function album_delete_album( $id ) {
		$this->DB->delete('album', array( 'id' => $id ) );
		return $this->DB->last_query();
		#return $this->DB->affected_rows();
	}
	function update_image_metadata( $id, $name, $caption ) {
		$this->DB->update('image', array( 'name' => $name, 'caption' => $caption ), array( 'id' => $id ) );
		return $this->DB->last_query();
	}
	function update_album_metadata( $id, $name, $caption ) {
		$this->DB->update('album', array( 'name' => $name, 'caption' => $caption ), array( 'id' => $id ) );
		return $this->DB->last_query();
	}
	function get_thumbnail( $image ) {
		$this->load->helper('album');

		$this->DB->select('image.path AS path');
		$this->DB->from(array('image'));
		$this->DB->where('image.id', $image);

		$query = $this->DB->get();
		if( $query->num_rows() > 0 ) {
			$path = $query->row()->path;
			$id = $image;

			$thumb_path = get_thumb_path( $id );
			if( ! file_exists( $thumb_path ) ) {
				create_thumb( get_image_path( $path ), $thumb_path );
			}
			return $thumb_path;
		} else {
		}
	}

}
