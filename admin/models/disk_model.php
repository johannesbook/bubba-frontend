<?php

class Disk_model extends Model {
	private $manager = "/usr/sbin/diskmanager";
	function __construct() {
		parent::Model();
		$this->load->helper('bubba_socket');		
	}
	private function _system( /* $command, $args... */ ) {
		$args = func_get_args();
		$command = array_shift( $args );
		$shell_cmd = "$command " . implode( ' ', array_map( create_function( '$i', 'return escapeshellarg( $i );' ),  $args ) );
		exec( $shell_cmd , $output, $retval );
		if( $retval == 0 ) {
			return json_decode( implode( "\n", $output ), true );
		} else {
			return null;
		}
	}
	private function _raw_system( /* $command, $args... */ ) {
		$args = func_get_args();
		$command = array_shift( $args );
		$shell_cmd = "$command " . implode( ' ', array_map( create_function( '$i', 'return escapeshellarg( $i );' ),  $args ) );
		exec( $shell_cmd , $output, $retval );
		if( $retval == 0 ) {
			return implode( "\n", $output );
		} else {
			return null;
		}
	}

	// snagged from http://se.php.net/manual/en/function.array-multisort.php#89918
	// _array_sort(string $field, [options, ], string $field2, [options, ], .... , $array)
	function array_sort(&$array /*, ...*/) {
		$args  = func_get_args();
		$array = array_shift($args);
		if (! is_array($array)) return false;
		// Here we'll sift out the values from the columns we want to sort on, and put them in numbered 'subar' ("sub-array") arrays.
		//   (So when sorting by two fields with two modifiers (sort options) each, this will create $subar0 and $subar3)
		foreach($array as $key => $row) // loop through source array
			foreach($args as $akey => $val) // loop through args (fields and modifiers)
				if(is_string($val))             // if the arg's a field, add its value from the source array to a sub-array
					${"subar$akey"}[$key] = $row[$val];
		// $multisort_args contains the arguments that would (/will) go into array_multisort(): sub-arrays, modifiers and the source array
		$multisort_args = array();
		foreach($args as $key => $val) {
			$arg = (is_string($val) ? ${"subar$key"} : $val);
			$dummy[] = &$arg;
			$multisort_args[] = &$arg;
			unset($arg);
		}
		$multisort_args[] = &$array;   // finally add the source array, by reference
		call_user_func_array("array_multisort", $multisort_args);
		return $array;
	}

	function list_external_disks($prohibit_removable = false, $prohibit_raid = false, $prohibit_usb = false, $list_partitions = false) {
		$disks = $this->list_disks();
		$ret = array();
		foreach( $disks as $disk ) {
			if( $disk['dev'] == '/dev/sda' ) {
				continue;
			}
			if( $prohibit_removable && $this->is_removable( $disk ) ) {
				continue;
			}
			if( $prohibit_usb && $this->is_usb( $disk ) ) {
				continue;
			}
			if( $prohibit_raid && isset($disk['partitions']) ) {
				foreach( $disk['partitions'] as $partition ) {
					if(
						isset( $partition['usage'] ) 
						&& $partition["usage"] == "array" 
						&& isset( $partition["md"] ) 
						&& $partition["md"] != "" 
					) {
						continue 2;
					}
				}
			}
			if($list_partitions ) {
				if( isset( $disk['partitions'] ) ) {
					foreach( $disk['partitions'] as $part ) {
						$ret[$disk['dev']][] = $part['dev'];
					}
				} else {
					// the old and glory factory default unpartitioned USB memory stick
					$ret[$disk['dev']][] = $disk['dev'];
				}
			} else {
				$ret[] = $disk['dev'];
			}
		}
		//print_r($ret);
		return $ret;
	}

	function list_disks() {
		$disks = $this->_system( $this->manager, 'disk', 'list' );
		return $disks;
	}
	function internal_is_raid() {
		$devices = $this->list_devices();
		foreach( $devices as $device ) {
			if( $device['dev'] == '/dev/sda2' ) {
				if( isset($device['usage']) && $device['usage'] == 'array' ) {
					return true;
				}
				continue;
			}
		}
		return false;
	}
	function internal_got_mounts() {
		return !is_null($this->_raw_system("grep", "-q", "/home/storage", "/proc/mounts"));
	}

	function list_raid_external_devices() {
		$raids = array();
		$devices = $this->_system( $this->manager, 'list_devices' );
		foreach( $devices as $device ) {
			if( $device['dev'] == '/dev/sda2' ) {
				continue;
			}
			if( preg_match('#(/dev/\w+)(\d+)#', $device['dev'], $matches ) ) {
				$disk = $matches[1];
				$partition = $matches[2];
				if( isset($device['usage']) && $device['usage'] == 'array' ) {
					$raids[] = $device['dev'];
				}
			}
		}
		return $raids;
	}
	function list_devices() {
		$disks = $this->_system( $this->manager, 'list_devices' );
		return $disks;
	}
	function list_vgs() {
		$disks = $this->_system( $this->manager, 'lv', 'list' );

		return $disks;
	}
	function list_mds() {
		$disks = $this->_system( $this->manager, 'md', 'list' );
		return $disks;
	}
	function list_fstab() {
		$fstab = $this->_system( $this->manager, 'fstab', 'list' );
		return $fstab['entries'];
	}
	function partition_info( $partition ) {
		$partitions = $this->_system( $this->manager, 'list_devices' );
		foreach( $partitions as $part ) {
			if( $part['dev'] == "/dev/$partition" ) {
				return $part;
			}
		}
		return null;
	}
	private function _get_by_map( $arr, $key, $value ) {
		foreach( $arr as $entry ) {
			if( is_array( $entry ) && $entry[$key] == $value ) {
				return $entry;
			}
		}
		return null;
	}

	function disk_got_mounts( $disk_dev ) {
		$disks = $this->list_disks();
		$disk = $this->_get_by_map( $disks, 'dev', $disk_dev );
		if( is_null($disks) ) {
			return null;
		}
		if( isset( $disk['partitions'] ) ) {
			foreach( $disk['partitions'] as $partition ) {
				if( $this->is_mounted( $partition['dev'] ) ) {
					return true;
				}
			}
		}

		return false;
	}

	function is_mounted( $device ) {
		$fstab = $this->_system( $this->manager, 'fstab', 'is_mounted', $device );
		return $fstab['mounted'];
	}

	function mount_partition( $partition ) {
		$matches = array();
		if( ! preg_match( '#TYPE="(.*?)"#', `blkid $partition -s TYPE`, $matches ) ) {
			throw new Exception( sprintf( t("Failed to aquire suitable type of the filesystem on partition %s"), $partition ) );
		}
		$type = $matches[1];

		$root = "/home/storage/extern";
		$fstab = $this->list_fstab();
		$mounts = array();
		$uuids = array();
		foreach( $fstab as $entry ) {
			$mounts[] = $entry['mount'];
			if(isset($entry['uuid'])) {
				$uuids[$entry['uuid']] = $entry;
			}
		}


		$partitions = $this->list_devices();
		foreach( $partitions as $part ) {
			if( $part['dev'] == $partition ) {
				$devinfo = $part;
				break;
			}
		}
		if( ! isset($devinfo) ) {
			throw new Exception( "Failed to get deviceinfo" );
		}
		$mountpath = "";
		if(!isset($devinfo['uuid']) || $devinfo['uuid'] == '' || $type == 'ntfs' ) {
			# Erm... we don't have any uuid, skip fstab then, just mount the device (probably an unpartitioned
			# but formated USB stick)
			# Or we have an borked disk containing borked ntfs
			$label = $devinfo['label'];
			if( $label == "" ) {
				$label = $devinfo['model'];
			}
			if( $label == "" ) {
				$label = "disk";
			}
			
			$label = str_replace( ' ', '_', $label );

			for( $index = 1; 0xff ; ++$index ) {
				$result = $this->_system( $this->manager, 'fstab', 'is_mounted', "$root/$label-$index" );
				if( ! $result['mounted'] ) {
					$mountpath = "$root/$label-$index";
					break;
				}
			}

			if( ! $mountpath ) {
				throw new Exception( sprintf( t("Failed to find suitable mount path for partition %s"), $partition ) );
			}

			$mountpath = str_replace( ' ', '_', $mountpath );

			if( ! file_exists( $mountpath ) ) {
				mkdir( $mountpath, 0777, true );
			}
			$grp = posix_getgrnam( 'users' );
			$usr = posix_getpwnam( 'admin' );
			$gid = $grp['gid'];
			$uid = $usr['uid'];

			switch( $type ) {
			case 'ntfs':
				$options = "defaults,ro,umask=0002,uid=$uid,gid=$gid";
				break;
			case 'vfat':
				$options = "defaults,umask=0002,uid=$uid,gid=$gid";
				break;
			default:
				$options = 'defaults';
				break;
			}


			if(is_null($this->_raw_system('mount', $partition, $mountpath, '-o', $options ))) {
				throw new Exception( sprintf( t("Failed to mount %s on %s"), $partition, $mountpath ) );
			}

		} else {
			if(! isset( $uuids[$devinfo['uuid']] ) ) {

				$label = $devinfo['label'];
				if( $label == "" ) {
					$label = $devinfo['model'];
				}
				if( $label == "" ) {
					$label = "disk";
				}

				$label = str_replace( ' ', '_', $label );

				for( $index = 1; 0xff ; ++$index ) {
					$result = $this->_system( $this->manager, 'fstab', 'is_mounted', "$root/$label-$index" );
					if( ! $result['mounted'] ) {
						$mountpath = "$root/$label-$index";
						break;
					}
				}

				if( ! $mountpath ) {
					throw new Exception( sprintf( t("Failed to find suitable mount path for partition %s"), $partition ) );
				}

				$mountpath = str_replace( ' ', '_', $mountpath );

				if( ! file_exists( $mountpath ) ) {
					mkdir( $mountpath, 0777, true );
				}
				$grp = posix_getgrnam( 'users' );
				$usr = posix_getpwnam( 'admin' );
				$gid = $grp['gid'];
				$uid = $usr['uid'];


				switch( $type ) {
				case 'ntfs':
					$options = "defaults,ro,umask=0002,uid=$uid,gid=$gid";
					break;
				case 'vfat':
					$options = "defaults,umask=0002,uid=$uid,gid=$gid";
					break;
				default:
					$options = 'defaults';
					break;
				}

				$ret = $this->_system( $this->manager, 'fstab', 'add_by_uuid', $partition, $mountpath, $options );

				if( ! $ret['status'] ) {
					throw new Exception( sprintf(t("Failed to create fstab entry for %s with %s"), $partition, $mountpath) );
				}
			} else {
				$cur = $uuids[$devinfo['uuid']];
				if( ! isset($cur['mount']) || !$cur['mount'] ) {
					throw new Exception( sprintf(t("Found entry for device %s in fstab, but contained no path to mount at"), $partition) );
				}
				$mountpath = $cur['mount'];
				$mountpath = str_replace( ' ', '_', $mountpath );
				if( ! file_exists( $mountpath ) ) {
					mkdir( $mountpath, 0777, true );
				}
			}

			$ret = $this->_system( $this->manager, 'fstab', 'mount', $partition );

			if( ! $ret['status'] ) {
				throw new Exception( sprintf( t("Failed to mount %s"), $partition ) );
			}

		}

		@chown( $mountpath, 'admin' );
		@chgrp( $mountpath, 'users' );
		@chmod( $mountpath, 0775 );

		return $mountpath;
	}

	function umount_partition( $partition ) {
		$list = $this->list_devices();
		foreach( $list as $entry ) {
			if( $entry['dev'] == $partition ) {
				$mountpath = $entry['mountpath'];
				break;
			}
		}


		if( ! $mountpath ) {
			throw new Exception(t("mount path not found for partition $partition"));
		}

		$mountpath = str_replace( ' ', '_', $mountpath );

		$ret = $this->_system( $this->manager, 'fstab', 'umount', $mountpath );

		if( ! $ret['status'] ) { 
			throw new Exception( sprintf( t("Failed to unmount %s"), $mountpath ) );
		}

		$in_fstab = count(array_filter( $this->list_fstab(), create_function('$a','return ($a["device"] == "'.quotemeta($partition).'");') )) > 0;

		if( $in_fstab ) {
			$ret = $this->_system( $this->manager, 'fstab', 'remove', $mountpath );

			if( ! $ret['status'] ) { 
				throw new Exception( sprintf(t("Failed to remove fstab entry for %s with %s"), $partition, $mountpath) );
			}
		}
		return;
	}

	function is_usb( $disk ){

		return ($disk['bus']=="usb");

	}

	function is_removable( $disk ) {

		preg_match('#(sd.)#', $disk['dev'], $matches);

		$sysdev = "/sys/block/$matches[1]";
		if( ! file_exists( $sysdev ) ) {
			throw "device not found in system";
		}

		return file_get_contents( "$sysdev/removable" ) == 1;	
	}

	function add_to_lvm( $disk, $group ) {

		list( $vg, $lv ) = explode( '-', $group );
		$sock = new BubbaDiskSocket();
		$sock->say(
			json_encode( 
				array( 
					'action' => 'add_to_lvm',
					'disk' => $disk,
					'vg' => $vg,
					'lv' => $lv
				) 
			)
		);
		$ret = $sock->getline();
		$sock->close();
		return json_decode( $ret );
	}

	function create_raid_internal_lvm_external( $external, $level ) {
		$sock = new BubbaDiskSocket();
		$sock->say(
			json_encode( 
				array( 
					'action' => 'create_raid_internal_lvm_external',
					'level' => $level,
					'external' => $external,
				) 
			)
		);
		$ret = $sock->getline();
		$sock->close();
		return json_decode( $ret );
	}

	function recover_raid_broken_external( $external ) {
		$sock = new BubbaDiskSocket();
		$sock->say(
			json_encode( 
				array( 
					'action' => 'restore_raid_broken_external',
					'disk' => $external,
				) 
			)
		);
		$ret = $sock->getline();
		$sock->close();
		return json_decode( $ret );
	}
	function recover_raid_broken_internal( $external ) {
		$sock = new BubbaDiskSocket();
		if( preg_match('#(/dev/\w+)(\d+)#', $external, $matches ) ) {
				$disk = $matches[1];
				$partition = $matches[2];
		} else {
			$disk = $external;
			$partition = 1;
		}
		$sock->say(
			json_encode( 
				array( 
					'action' => 'restore_raid_broken_internal',
					'disk' => $disk,
					'partition' => $partition
				) 
			)
		);
		$ret = $sock->getline();
		$sock->close();
		return json_decode( $ret );
	}

	function format_disk( $disk, $label ) {
		$sock = new BubbaDiskSocket();
		$sock->say(
			json_encode( 
				array( 
					'action' => 'format_disk',
					'disk' => $disk,
					'label' => $label,
				) 
			)
		);
		$ret = $sock->getline();
		$sock->close();
		return json_decode( $ret );
	}
	function abort_format() {
		if( ! ( $this->diskdaemon_is_running() && $this->diskdaemon_is_formating() ) ) {
			return false;
		}
		$sock = new BubbaDiskSocket();
		$sock->say(
			json_encode( 
				array( 
					'action' => 'shutdown'
				) 
			)
		);
		#$ret = $sock->getline();
		$sock->close();
		return true;
	}

	function diskdaemon_is_running() {
		if( file_exists('/tmp/bubba-disk.socket') ) {
			exec( 'fuser -s /tmp/bubba-disk.socket', $ret, $err );
			if( $err == 0 ) {
				return true;
			}
			return false;
		}
		return false;
	}
	function diskdaemon_is_working() {
		if( ! $this->diskdaemon_is_running() ) {
			return false;
		}
		$sock = new BubbaDiskSocket();
		$sock->say( json_encode( array( 'action' => 'status' ) ) );
		$ret = json_decode( $sock->getline(), true );
		$sock->close();
		if( $ret['status'] != 'idle' ) {
			return true;
		}

		return false;

	}

	function diskdaemon_type_of_action() {
		# first, to be sure
		if( ! $this->diskdaemon_is_running() ) {
			return false;
		}
		$sock = new BubbaDiskSocket();
		$sock->say( json_encode( array( 'action' => 'status' ) ) );
		$ret = json_decode( $sock->getline(), true );
		$sock->close();
		return $ret['status'];
	}

	function diskdaemon_is_formating() {
		# first, to be sure
		if( ! $this->diskdaemon_is_running() ) {
			return false;
		}
		$sock = new BubbaDiskSocket();
		$sock->say( json_encode( array( 'action' => 'status' ) ) );
		$ret = json_decode( $sock->getline(), true );
		$sock->close();
		if( $ret['status'] == 'format' ) {
			return true;
		}

		return false;
	}
	function remove_raid_disk( $md, $disk ) {
		$ret = $this->_system( $this->manager, 'md', 'remove', $md, $disk );
		if( ! $ret['status'] ) {
			# try static dev
			$disk = preg_replace('#/dev/(.*)#', '/dev/.static/dev/$1', $disk);
			$ret = $this->_system( $this->manager, 'md', 'remove', $md, $disk );
		}
		if( ! $ret['status'] ) {
			# try restarting whole array
			$this->_raw_system( 'fuser', '-k', $md );
			$this->_raw_system( 'umount', $md );
			$this->_raw_system( 'mdadm', '--stop', $md );
			$this->_raw_system( 'mdadm', '--assemble', $md );
			$this->_raw_system( 'mount', $md );
		}
		return true;
	}

	function query_progress() {
		$sock = new BubbaDiskSocket();
		$sock->say( json_encode( array( 'action' => 'progress' ) ) );
		$ret = $sock->getline();
		$sock->close();
		return json_decode( $ret, true );
	}

}

