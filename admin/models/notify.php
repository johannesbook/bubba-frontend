<?php
class Notify extends Model {

	const ERR = 1;
	const WARN = 2;
	const INFO = 3;

	public function __construct() {
		parent::Model();
	}

	public function ack( $UUID ) {
		_system( BACKEND, 'notify_ack', $UUID );
		_system( BACKEND, 'notify_flush' );
		return 0;	
	}

	private function _allowed_to_ack( $actual, $user ) {
		if( $user == 'admin' ) {
			# shortcut, admin can ack everything, even if admin not recieve actual note.
			return true;
		}
		if( ! isset($actual['Reciever']) ) {
			return false;
		}

		if( strtolower($actual['Reciever']) == strtolower($user) ) {
			return true;
		}
		return false;

	}

	public function allowed_to_ack( $UUID, $user ) {
		if( $user == 'admin' ) {
			# shortcut, admin can ack everything, even if admin not recieve actual note.
			return true;
		}
		$data = $this->_read_cache();
		if( isset($data[$UUID]) ) {
			$actual = $data[$UUID];
			return $this->_allowed_to_ack( $actual, $user );
		}
		return false;
	}

	public function stop() {
		_system( BACKEND, 'notify_stop' );
		return 0;	
	}

	public function start() {
		_system( BACKEND, 'notify_start' );
		return 0;	
	}

	public function enable( $type, $level=Notify::ERR ) {
		_system( BACKEND, 'notify_enable', $type, $level );
		return 0;	
	}

	public function disable( $type ) {
		_system( BACKEND, 'notify_disable', $type );
		return 0;	
	}

	private function _read_cache( $user = null ) {
		$cache_file = '/var/cache/bubba-notify/ui'.( is_null( $user ) ? '' : "_$user" );
		if( file_exists( $cache_file ) ) {
			$json = file_get_contents( $cache_file );
			$data = @json_decode( $json, true );
			if( is_array( $data ) ) {
				return $data;
			}
		}
		return array();

	}


	public function list_all( $user = null ) {
		$data = array_merge( $this->_read_cache(), is_null( $user ) ? array() : $this->_read_cache( $user ) );
		if( is_array( $data ) && ! empty( $data ) ) {
			if( is_null( $user ) )
				$ret = array_values($data);
			else {
				$ret = array();
				foreach( array_values($data) as $row ) {
					if( isset( $row['Reciever'] ) && strtolower($row['Reciever']) == strtolower($user) ) {
						$ret[] = $row;
					}
				}
			}
			foreach( $ret as &$row ) {
				switch( $row['Level'] ) {
				case 'ERR':
					$row['Image'] =  FORMPREFIX.'/views/'.THEME."/_img/upgrade_error.png";
					break;
				case 'WARN':
					$row['Image'] =  FORMPREFIX.'/views/'.THEME."/_img/upgrade_warning.png";
					break;
				case 'INFO':
					$row['Image'] =  FORMPREFIX.'/views/'.THEME."/_img/upgrade_note.png";
					break;
				}
				$row['AllowedToAck'] = $this->_allowed_to_ack( $row, $this->session->userdata('user') );
			}
			unset( $row );
			return $ret;
		} else {
			return null;
		}
	}

}
