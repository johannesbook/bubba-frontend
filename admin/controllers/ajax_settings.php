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

	$this->Auth_model->EnforceAuth('web_admin');
	
	$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
    $this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
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
