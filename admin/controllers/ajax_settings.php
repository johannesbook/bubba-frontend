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

  function get_versions() {
      $versions = get_package_version(array("bubba","bubba3-kernel","bubba-frontend","bubba-backend","bubba-album","filetransferdaemon","logitechmediaserver"));
      $this->session->set_userdata("version",$versions['bubba']);
      $this->json_data = $versions;
    }

  function update(){
      $this->load->helper('bubba_socket');
      try {
          switch( $this->input->post( 'action' ) ) {
          case 'upgrade':
              apt_upgrade_packages();
              $output = apt_query_progress();
              $this->json_data = json_decode($output);
              break;
          case 'install':
              apt_install_package( $this->input->post( 'package' ) );
              $output = apt_query_progress();
              $this->json_data = json_decode($output);
              break;
          case 'progress':
              $output = apt_query_progress();
              $this->json_data = json_decode($output);
              break;
          }
      } catch( BubbaSocketException $e ) {
          if( $e->getCode() == BubbaSocketException::NO_SOCKET ) {
              $this->json_data = array(
                  'statusMessage' => 'Fatal error',
                  'progress' => '100',
                  'done' => true,
                  'logs' => array(
                      'ERROR' => array(
                          array(
                              'Code' => 'ERROR',
                              'Desc' => 'Cannot connect to the updater daemon; Please contact support'
                          )
                      )
                  )
              );
          }
      }

  }
  function _output($output) {
  	if(isset($this->json_data) && sizeof($this->json_data)) {
    	echo json_encode($this->json_data);
    }
  }
  
}

?>
