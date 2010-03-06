<?php
class Ajax_disk extends Controller {

	var $json_data=Array(
		'error' => 1,
		'html' => 'Ajax Error: Invalid Request'
	);

	function __construct() {
		parent::Controller();
		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth();
		$this->Auth_model->RequireUser('admin');
		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);

		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}

	function partition_get_info() {
		$this->load->model('disk_model');
		$partition = json_decode($this->input->post("partition"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["data"] = $this->disk_model->partition_info($partition);
		switch($this->json_data["data"]['usage']) {
		case 'pv':
			$vgs = $this->disk_model->list_vgs();
			foreach( $vgs as $vg ) {
				if($vg['name'] == $this->json_data["data"]['vgroup']) {
					$this->json_data["vgdata"] = $vg;
					break;
				}
			}
			break;
		case 'unused':
			$this->json_data['vgs'] = $this->disk_model->list_vgs();
			break;
		}
	}

	function mount_partition() {
		$this->load->model('disk_model');
		$partition = json_decode($this->input->post("partition"));
		try{
			$mount_path = $this->disk_model->mount_partition($partition);
			$this->json_data['error'] = 0;
			$this->json_data['html'] = "";
			$this->json_data["mount_path"] = $mount_path;
		} catch( Exception $e ) {
			$this->json_data['error'] = 1;
			$this->json_data['html'] = $e->getMessage();
		}
	}
	function umount_partition() {
		$this->load->model('disk_model');
		$partition = json_decode($this->input->post("partition"));
		try{
			$this->disk_model->umount_partition($partition);
			$this->json_data['error'] = 0;
			$this->json_data['html'] = "";
		} catch( Exception $e ) {
			$this->json_data['error'] = 1;
			$this->json_data['html'] = $e->getMessage();
		}
	}

	function get_external_disks() {
		$this->load->model('disk_model');
		$prohibit_removable = ! json_decode($this->input->post("removable"));
		$prohibit_raid = ! json_decode($this->input->post("raid"));
		$prohibit_usb = ! json_decode($this->input->post("usb"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["disks"] = $this->disk_model->list_external_disks($prohibit_removable, $prohibit_raid, $prohibit_usb);
		$this->json_data["internal_got_mounts"] = $this->disk_model->internal_got_mounts();
	}

	function get_raid_disks() {
		$this->load->model('disk_model');
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["disks"] = $this->disk_model->list_raid_external_devices();
		$this->json_data["clean_disks"] = $this->disk_model->list_external_disks(true, true, true);
		$this->json_data["internal"] = $this->disk_model->internal_is_raid();
		$this->json_data["internal_got_mounts"] = $this->disk_model->internal_got_mounts();
	}

	function add_to_lvm() {
		$this->load->model('disk_model');
		$disk = json_decode($this->input->post("disk"));
		$group = json_decode($this->input->post("group"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["ret"] = $this->disk_model->add_to_lvm($disk, $group);
	}
	function query_progress() {
		$this->load->model('disk_model');
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["ret"] = $this->disk_model->query_progress();

	}

	function create_raid_internal_lvm_external() {
		$this->load->model('disk_model');
		$external = json_decode($this->input->post("external"));
		$level = json_decode($this->input->post("level"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["ret"] = $this->disk_model->create_raid_internal_lvm_external( $external, $level);
	}
	function recover_raid_broken_external() {
		$this->load->model('disk_model');
		$disk = json_decode($this->input->post("external"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["ret"] = $this->disk_model->recover_raid_broken_external( $disk );
	}
	function recover_raid_broken_internal() {
		$this->load->model('disk_model');
		$disk = json_decode($this->input->post("external"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["ret"] = $this->disk_model->recover_raid_broken_internal( $disk );
	}

	function disk_got_mounts() {
		$this->load->model('disk_model');
		$disk = json_decode($this->input->post("disk"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["disk_got_mounts"] = $this->disk_model->disk_got_mounts( $disk );
	}

	function format_disk() {
		$this->load->model('disk_model');
		$disk = json_decode($this->input->post("disk"));
		$label = json_decode($this->input->post("label"));
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["ret"] = $this->disk_model->format_disk( $disk, $label );
	}

	function abort_format() {
		$this->load->model('disk_model');
		$this->json_data['error'] = 0;
		$this->json_data['html'] = "";
		$this->json_data["ret"] = $this->disk_model->abort_format();
	}

	function remove_raid_disk() {
		$this->load->model('disk_model');
		$our_disk = json_decode($this->input->post("disk"));
		$mds = $this->disk_model->list_mds();
		$our_md = null;
		foreach( $mds as $md ) {
			foreach( $md['disks'] as $disk ) {
				if( $disk['dev'] == $our_disk ) {
					$our_md = $md['dev'];
					continue 2;
				}	
			}
		}
		if( $our_md == null ) {
			$this->json_data['html'] = t("Failed to aquire an RAID array containing the disk %s", $our_disk);
		} else {
			$this->json_data['error'] = 0;
			$this->json_data['html'] = "";
			$this->json_data["ret"] = $this->disk_model->remove_raid_disk( $our_md, $our_disk );
		}
	}


	function _output($output) {
		echo json_encode($this->json_data);
	}

}
