<?php

class Stat extends Controller{

	function stat(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth();
		$this->Auth_model->RequireUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content){
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		if($this->session->userdata("run_wizard")) {
			$mdata["dialog_menu"] = "";
			$mdata["content"]="";
			$mdata["wizard"]=$content;
		} else {
			$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
			$mdata["content"]=$content;
			$mdata["wizard"]="";
		}
		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function _getvolume($path){
		$res=array();
		$res["size"]=disk_total_space($path);
		$res["free"]=disk_free_space($path);
		return $res;
	}	

	function _getdisk($dev){
		$res=array();
		$res["temp"]=get_hdtemp($dev);
		return $res;
	}

	function info(){

		$sdata["version"] = get_package_version("bubba-frontend");
		$sdata['uptime']=uptime();
		$sdata['partitions']["home"]=$this->_getvolume("/home/");
		$sdata['partitions']["system"]=$this->_getvolume("/");
		$sdata['disks']["sda"]=$this->_getdisk("/dev/sda");

		header("Content-type: application/json");
		print json_encode($sdata);
	}

	function index($strip=""){

		$this->load->model( 'notify' );

		if($strip=="json"){
			$this->info();
			return;
		}

		if( file_exists( BUBBA_VERSION ) ) {
			$sdata["version"] = file_get_contents( BUBBA_VERSION );
		} else {
			$sdata["version"] = 'N/A';
		}
		$sdata['uptime']=uptime();

		$freespace=intval(disk_free_space("/home/")/(1048576));
		$totalspace=intval(disk_total_space("/home/")/(1048576));


		$sdata['freespace']=number_format($freespace,0,' ',' ');
		$sdata['totalspace']=number_format($totalspace,0,' ',' ');
		$sdata['percentused']=intval(100*(($totalspace-$freespace)/$totalspace));
		$sdata['notifications'] = $this->notify->list_all();

		if($strip){
			$this->load->view(THEME.'/stat_view',$sdata);
		} else {
			$sdata['wiz_data'] = array();
			if( $this->session->userdata("run_wizard") ) {
				redirect('/settings/wizard');
			} else {
				$this->_renderfull($this->load->view(THEME.'/stat_view',$sdata,true));
			}
		}
	}

}

?>
