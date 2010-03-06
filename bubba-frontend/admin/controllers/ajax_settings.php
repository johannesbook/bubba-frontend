<?php
class Ajax_Settings extends Controller {

  var $json_data=Array(
    'error' => 1,
    'html' => 'Ajax Error: Invalid Request'
    );

  function __construct() {
    parent::Controller();
	require_once(APPPATH."/legacy/defines.php");
	require_once(ADMINFUNCS);

	$this->Auth_model->EnforceAuth();
	load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	
	$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
    $this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
  }
  
  function ajax_backup_settings() {
		$user = json_decode($this->input->post("user"));
		$jobname = json_decode($this->input->post("jobname"));
		//print "Ajax returns user: $user Jobname: $jobname";
		//$user = json_decode($this->input->post("user"));
		//$jobname = json_decode($this->input->post("jobname"));
		$this->json_data['files'] = get_backupfiles($user,$jobname);
		$this->json_data['settings'] = get_backupsettings($user,$jobname);
		$this->json_data['schedule'] = get_backupschedule($user,$jobname);
    $this->json_data['html'] = "";
	  $this->json_data['error'] = 0;
	}

	function ajax_backup_addfile() {
		unset($this->json_data['html']);
		unset($this->json_data['error']);

		$user = json_decode($this->input->post("user"));
		$jobname = json_decode($this->input->post("jobname"));
		$file = $this->input->post("file");
		echo backup_addfile($user,$jobname,$file);   // return value is json encoded.
/*
		if($msg = backup_addfile($user,$jobname,$file)) {
		  $this->json_data['error'] = true;
		  $this->json_data['errmsg'] = $msg;
		}
*/
	}	

	function ajax_backup_rmfile() {
		unset($this->json_data['html']);
		unset($this->json_data['error']);

		$user = json_decode($this->input->post("user"));
		$jobname = json_decode($this->input->post("jobname"));
		$file = $this->input->post("file");
		echo backup_rmfile($user,$jobname,$file);   // return value is json encoded.
/*
		if($msg = backup_rmfile($user,$jobname,$file)) {
		  $this->json_data['error'] = true;
		  $this->json_data['errmsg'] = $msg;
		}
*/
	}	
	
	function ajax_backup_update() {
		
	  $this->json_data['html'] = "";
	  $this->json_data['error'] = backup_updatesettings($this->session->userdata("user"),$_POST);
		
	}
	function ajax_backup_current_filelist() {

		// retruns json encoded data from perl backend.
		$user = json_decode($this->session->userdata("user"));
		$jobname = json_decode($this->input->post("jobname"));
		unset($this->json_data); // do not output using "_output" function.
		return backup_current_filelist($user,$jobname);
		
	}
	function ajax_backup_restore() {
		
	  $this->json_data['html'] = "";

		$user = json_decode($this->session->userdata("user"));
		$jobname = json_decode($this->input->post("jobname"));
		$time = json_decode($this->input->post("time"));
		$force = json_decode($this->input->post("force"));
		$file = json_decode($this->input->post("file"));
		$file = substr($file,strpos($file,"/")); // find "/"
		if(!$force) {
			$force = 0;
		}		
		$this->json_data['error'] = backup_restorefile($user,$jobname,$force,$time,$file);
		
	}

	function ajax_backup_createjob() {

		$user = json_decode($this->input->post("user"));
		$jobname = json_decode($this->input->post("jobname"));

	  $this->json_data['html'] = "";
	  $jobs = create_backupjob($user,$jobname);
	  $this->json_data['error'] = $jobs["error"];
	  $this->json_data['status'] = $jobs["status"];
		
	}

	function ajax_backup_deletejob() {

		$user = json_decode($this->input->post("user"));
		$jobname = json_decode($this->input->post("jobname"));

	  $this->json_data['html'] = "";
	  $this->json_data['error'] = delete_backupjob($user,$jobname);
		
	}

	function ajax_backup_listdates() {
		$user = json_decode($this->input->post("user"));
		$jobname = $this->input->post("jobname");
	  $this->json_data['html'] = "";
	  
	  $dates = backup_listdates($user,$jobname);
	  if($dates) {
		  $this->json_data['dates'] = $dates;
		  $this->json_data['error'] = 0;
		  
		} else {
		  $this->json_data['dates'] = "";
		  $this->json_data['error'] = 1;
		}
	}		

	function ajax_backup_listfiles() {

		$user = json_decode($this->input->post("user"));
		$jobname = $this->input->post("jobname");
		$date = $this->input->post("date");

	  $this->json_data['html'] = "";
		$files = backup_printfilelist($user,$jobname,$date);
		if($files) {
			$this->json_data['files'] = $files;
		  $this->json_data['error'] = 0;
	} else {
			$this->json_data['files'] = "";
		  $this->json_data['error'] = 1;
		}
	}
	
	function ajax_backup_restorestatus() {
		
		$lockinfo = get_restorestatus();
	  $this->json_data['html'] = "";
	  if($lockinfo) {
		  $this->json_data['error'] = 0;
	  	foreach($lockinfo as $key => $value) {
	  		$this->json_data[$key] = $value;
	 	  }
		} else {
		  $this->json_data['error'] = "1";
		  $this->json_data['done'] = -1;
	 	  $this->json_data['status'] = t("Unknown error");
		} 	  
		
	}

	function ajax_backup_runjob() {

		$user = json_decode($this->input->post("user"));
		$jobname = $this->input->post("jobname");

		run_backupjob($user,$jobname);
		
	  $this->json_data['error'] = 0;
	  $this->json_data['html'] = "";

	}
		
	
	function ajax_backup_getstatus() {
		$file = json_decode($this->input->post("file"));
	  $this->json_data['error'] = 0;
	  $this->json_data['html'] = "";
		$this->json_data["info"] = backup_readerror($file);
	}

	function ajax_backup_filelist() {
		$root = $this->input->post( 'dir' );
		$data['root'] = $root;
		$data['dirs'] = array();
		foreach( scandir( $root ) as $file ) {
			if( $file == '.' ||  $file == '..' || $file =='lost+found' ) {
				continue;
			}
			$real = "$root/$file";
			$pattern = "/".$this->session->userdata("user")."\/\.backup/"; // do not show /home/user/.backup
			if(preg_match($pattern,$real) ) {
				continue;
			}
			if( is_dir( $real ) ) {
				$data['dirs'][] = $file;
			}
		}
		$this->json_data['html'] = $this->load->view(THEME.'/ajax/ajax_backup_filelist_view', $data, true);
		$this->json_data['error'] = 0;		
	}

	function ajax_list_disks() {
		
		$this->load->model("Disk_model");
	  $this->json_data['error'] = 0;
	  $this->json_data['html'] = "";
	  
	  $disks = $this->Disk_model->list_disks();
	  
	  $usable_disks = array();
	  foreach($disks as $disk) {
	  	if(!preg_match("/\/dev\/sda/",$disk["dev"])) {
	  		if(isset($disk["partitions"]) && is_array($disk["partitions"])) {
	  			foreach($disk["partitions"] as $partition) {
	  				if( !strcmp($partition["usage"],"mounted") || !strcmp($partition["usage"],"unused") && $partition["uuid"]) {
	  					if($partition["label"]) {
	  						$diskdata["label"] = $partition["label"];
	  					} else {
	  						if(preg_match("/dev\/\w+(\d+)/",$disk["dev"],$partition_number)) {
	  							$diskdata["label"] = $disk["model"] . ":".$partition_number[1];
	  						} else {
	  							$diskdata["label"] = $disk["model"] . ":1";
	  						}
	  					}
	  					$diskdata["uuid"] = $partition["uuid"];
				  		$usable_disks[$disk["model"]][]=$diskdata;
				  		//print_r($usable_disks);
	  				} else {
	  				
	  				}
	  			}
	  		//array_push($usable_disks, $disk);
	  		} else {
					if( !strcmp($disk["usage"],"mounted") || !strcmp($disk["usage"],"unused") && $disk["uuid"]) {
						if($disk["label"]) {
							$diskdata["label"] = $disk["label"];
						} else {
							if(preg_match("/dev\/\w+(\d+)/",$disk["dev"],$partition_number)) {
								$diskdata["label"] = $disk["model"] . ":".$partition_number[1];
							} else {
								$diskdata["label"] = $disk["model"] . ":1";
							}
						}
						$diskdata["uuid"] = $disk["uuid"];
			  		$usable_disks[$disk["model"]][]=$diskdata;
			  		//print_r($usable_disks);
					}
				}
	  	}
	  }
	  
		$this->json_data["disks"] = $usable_disks;
		$this->json_data["nbrdisks"] = sizeof($usable_disks);
	}
	 
  function _output($output) {
  	if(isset($this->json_data) && sizeof($this->json_data)) {
    	echo json_encode($this->json_data);
    }
  }
  
}

?>
