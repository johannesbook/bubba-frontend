<?php

class Disk extends Controller{

	function Disk(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->RequireUser('admin');
		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content, $head = '/disk/disk_head_view', $data = ''){
		$mdata["head"] = $this->load->view(THEME.$head,$data,true);
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$data,true);
		$mdata["subnav"]= $this->load->view(THEME.'/disk/disk_submenu_view',$data,true);
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function _find_path($prefix){
		$i=0;
		while(check_mountpath("$prefix/disk_$i")){
			$i++;
		}
		return "$prefix/disk_$i";
	}

	function mount(){
	
		if(!file_exists("/home/storage/extern")){
			md("/home/storage/extern",0777,"nobody");
		}
		$path=$this->_find_path("/home/storage/extern");
		if(!file_exists($path)){
			md($path,0777,"nobody");
		}
		user_mount($this->input->post("device"),$path,"");
		$this->index();
	}

	function umount(){
		user_umount($this->input->post("device"));
		$this->index();
	}


	function progress() {
		$this->load->model('disk_model');
		$data['is_running'] = $this->disk_model->diskdaemon_is_running();
		if( $data['is_running'] ) {
			$type = $this->disk_model->diskdaemon_type_of_action();
			$data['type'] = $type;
			$data['progress'] = $this->disk_model->query_progress();
			$data['title'] = t( "disk_action_title_".$type );
			$this->_renderfull($this->load->view(THEME.'/disk/disk_progress_view.php',$data,true), '/disk/disk_progress_head_view', $data);
		} else {
			redirect("disk");
		}

	}

	function raid() {
		$this->load->model('disk_model');
		if( $this->disk_model->diskdaemon_is_working() ) {
			redirect("disk/progress");
		}
		$mds=$this->disk_model->list_mds();
		$disks = array();
		$raids = array();
		$status = array();

		foreach($mds as $md) {
			$cur = array(
				'device' => $md['dev'],
				'level' => $md['level'],
				'state' => $md['state'],
				'label' => $md['label'],
				'size' => $md['size'] * 512 # TODO fix diskmanager
			);
			if( $md['degraded'] ) {
				$h=$m=$s=0;
				if( $md['sync_completed'] != 'none' ) {
					preg_match( '#\s*(\d+)\s*/\s*(\d+)#', $md['sync_completed'], $matches );
					if( count( $matches ) > 2 ) {
						list(,$done,$max) = $matches;
						$speed = $md['sync_speed'];
						if( $speed > 0 ) {
							$left = $max - $done;
							$eta = $left / $speed;
							$s = $eta % 60;
							$m = $eta / 60 % 60;
							$h = floor($eta / 60 / 60);
						}
						$progress=$done == 0 ? 100 : $done / $max * 100;
					} else {
						$progress='N/A';
					}
				} else {
					$progress='none';
				}


				$status[] = array(
					'type' => 'degraded',
					'dev' => $md['dev'],
					'sync' => $md['sync'],
					'progress' => $progress,
					'eta' => array($h,$m,$s),
				);

			}
			$raids[] = $cur;
			foreach( $md['disks'] as $disk ) {
				$disks[] = array(
					'parent' => $md['dev'],
					'device' => $disk['dev'],
					'state' => $disk['state'],
					'size' => $disk['size'] * 1000 # TODO fix diskmanager
				);

				if( $disk['state'] == 'faulty' ) {
					$status[] = array(
						'type' => 'faulty',
						'array' => $md['dev'],
						'device' => $disk['dev']
					);


				}
			}
		}
		$data['raids'] = $raids;
		if(sizeof($raids)) {
			$data['disable_create'] = "disabled";
		} else {
			$data['disable_create'] = "";
		}
		$data['disks'] = $disks;
		$data['status'] = $status;
		$this->_renderfull($this->load->view(THEME.'/disk/disk_raid_view.php',$data,true), '/disk/disk_raid_head_view');

	}
	function lvm() {
		$this->load->model('disk_model');
		if( $this->disk_model->diskdaemon_is_working() ) {
			redirect("disk/progress");
		}
		$vgs=$this->disk_model->list_vgs();
		$indevices=$this->disk_model->list_devices();
		$lvs = array();
		$devices = array();
		foreach( $indevices as $dev ) {
			switch( $dev['dev'] ) {
			case '/dev/sda1':
			case '/dev/sda2':
			case '/dev/sda3':
				continue 2;
			}

			switch( $dev['usage'] ) {
			case 'pv':
			case 'array':
			case 'swap':
				continue 2;
			}

			if( $this->disk_model->is_mounted( $dev['dev'] ) ) {
				continue;
			}

			preg_match( '#(/dev/\w+?)\d*$#', $dev['dev'], $matches );
			$devices[$matches[1]] = true;
		}
		$disks = array_keys( $devices );

		foreach($vgs as $vg) {
			if(array_key_exists( 'lvs', $vg ) )
				foreach( $vg['lvs'] as $lv) {
					$lvs[] = "$vg[name]-$lv[name]";
				}
		}
		$data['lvs'] = $lvs;
		$data['disks'] = $disks;
		$this->_renderfull($this->load->view(THEME.'/disk/disk_lvm_view.php',$data,true), '/disk/disk_lvm_head_view');

	}

	function index(){
		$this->load->model('disk_model');

		if( $this->disk_model->diskdaemon_is_working() ) {
			redirect("disk/progress");
		}

		$disks=$this->disk_model->array_sort( 'dev', $this->disk_model->list_disks() );
		$indevices=$this->disk_model->array_sort( 'dev', $this->disk_model->list_devices() );
		$vgs=$this->disk_model->list_vgs();
		$mds=$this->disk_model->list_mds();
		$fstab=$this->disk_model->list_fstab();

		$cid = 0;
		$cid_devives = array();
		$devices = array();
		$legend = array();

		foreach( $indevices as $dev ) {
			switch( $dev['dev'] ) {
			case '/dev/sda1':
			case '/dev/sda3':
				continue 2;
			}

			switch( $dev['usage'] ) {
			case 'pv':
			case 'array':
			case 'swap':
				continue 2;
			}

			$c_cid = ++$cid;
			$legend[] = array(
				'cid' => $c_cid,
				'name' => $dev['dev'],
				'size' => $dev['size'] * 512  # TODO fix diskmanager
			);
			$cid_devices[$dev['dev']] = $c_cid;
			$devices[$dev['dev']] = array(
				"mounted" => $this->disk_model->is_mounted( $dev['dev'] ),
				"mountpath" => array_key_exists( 'mountpath', $dev ) ? $dev['mountpath'] : '',
				"label" => array_key_exists( 'label', $dev ) ? $dev['label'] : '',
			);
		}

		$cid = 7;


		foreach($vgs as $vg) {
			if(array_key_exists( 'lvs', $vg ) )
				foreach( $vg['lvs'] as $lv) {
					$c_cid = ++$cid;
					$legend[] = array(
						'cid' => $c_cid,
						'name' => "$vg[name]-$lv[name]",
						'size' => $lv['size']
					);
					if( "$vg[name]-$lv[name]" != "bubba-storage" ) {
						$devices["$vg[name]-$lv[name]"] = array(
							"mounted" =>
							$this->disk_model->is_mounted( "/dev/$vg[name]/$lv[name]" ) or
							$this->disk_model->is_mounted( "/dev/mapper/$vg[name]-$lv[name]" )
							,
							"mountpath" => $lv['mountpath'],
						);
					}

					foreach( $lv['devices'] as $device ) {
						preg_match( '#/dev/sd\w\d+#', $device, $matches );
						$cid_devices[$matches[0]] = $c_cid;
					}
				}
		}
		
		$cid = 14;

		foreach($mds as $md) {
			$c_cid = ++$cid;
			$legend[] = array(
				'cid' => $c_cid,
				'name' => $md['dev'],
				'size' => $md['size'] * 512 # TODO fix diskmanager
			);
			foreach( $md['disks'] as $disk ) {
				$cid_devices[$disk['dev']] = $c_cid;
			}
		}

		foreach( $disks as &$disk ) {
			$disk['formatable'] = true;
			if( array_key_exists( 'partitions', $disk ) ) {
				$disk['partitions'] = $this->disk_model->array_sort( 'dev', $disk['partitions'] );
				foreach( $disk['partitions'] as &$partition ) {
					switch( $partition['dev'] ) {
					case '/dev/sda1':
					case '/dev/sda3':
						$disk['formatable'] = false;
						$partition['system'] = true;
						break;
					default:
						$partition['cid'] =  isset($cid_devices[$partition['dev']]) ? $cid_devices[$partition['dev']] : "e";
					}
					switch( $partition['usage'] ) {
					case 'pv':
					case 'array':
					case 'swap':
						if(isset($cid_devices[$partition['dev']])) {
							# broken RAID should be formattable
							$disk['formatable'] = false;
						}
					}
					if( isset($devices[$partition['dev']]) && $devices[$partition['dev']]['mounted']) {
						$disk['formatable'] = false;
					}
				}
			} else {
						$disk['cid'] =  isset($cid_devices[$disk['dev']]) ? $cid_devices[$disk['dev']] : "e";
			}

			# Assume sda is SATA and all other scsi are eSATA.
			switch( $disk['bus'] ) {
			case 'scsi':
				if( $disk['dev'] == '/dev/sda' ) {
					$type = 'SATA';
				} else {
					$type = 'eSATA';
				}
				break;
			case 'usb':
				$type = 'USB';
				break;
			default:
				$type = 'N/A';
				break;
			}
			$disk['type'] = $type;
		}

		unset( $partition );
		unset( $disk );
		foreach( $disks as &$disk ) {
			if( array_key_exists( 'partitions', $disk ) ) {
				$parts = $disk['partitions'];
				$this->disk_model->array_sort( 'dev', &$parts );
			}
		}
		$data['disks'] = $disks;
		$data['devices'] = $devices;
		$data['fstab'] = $fstab;
		$data['cid'] = $cid;
		$data['legends'] = $legend;

		$this->_renderfull($this->load->view(THEME.'/disk/disk_view.php',$data,true));
	}


}

?>
