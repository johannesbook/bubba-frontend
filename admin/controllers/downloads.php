<?php

class Downloads extends Controller{

	var $sorted=false;
	var $dl=false;
	
	function Downloads(){
		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);
		require_once(IPCFUNCS);

		$this->Auth_model->EnforceAuth('web_admin');
		$this->Auth_model->DenyUser('admin');

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}		

	function _renderfull($content){
		$navdata["menu"] = $this->menu->retrieve($this->session->userdata('user'),$this->uri->uri_string());
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view',$navdata,true);
		$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view',$this->menu->get_dialog_menu(),true);
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	

	function _sort_status($a,$b){
		$ssort=array(5=>6,0=>5,1=>4,2=>3,6=>2,4=>1,3=>0);
		
		$ta=$ssort[$this->sorted[$a]["status"]];
		$tb=$ssort[$this->sorted[$b]["status"]];

		if($ta==$tb){
			return 0;
		}
		
		return $ta < $tb?1:-1;

	}

	function _sort_progress($a,$b){
		$a_dl=$this->sorted[$a]["downloaded"];
		$a_sz=$this->sorted[$a]["size"];
		$b_dl=$this->sorted[$b]["downloaded"];
		$b_sz=$this->sorted[$b]["size"];
		
		if($a_sz==0 && $b_sz>0){
			return -1;
		}

		if($b_sz==0 && $a_sz>0){
			return 1;		
		}

		if($a_sz==0 && $b_sz==0){
			return 0;
		}

		$a_pr=$a_dl/$a_sz;
		$b_pr=$b_dl/$b_sz;
		if($a_pr==$b_pr){
			return 0;
		}
		
		return $a_pr<$b_pr?1:-1;

	}

	function _sortdls($a,$b){
		
		// Sort by status first
		$ret=$this->_sort_status($a,$b);		
		if($ret!=0){
			return $ret;
		}

		// Sort by dlprogress		
		return $this->_sort_progress($a,$b);
	}

	function remove($strip=""){
		if(!$this->dl){
			$this->dl=new Downloader;
		}
		
		$url=$this->input->post('url');
		$uuid=$this->input->post('uuid');
		
		$res=$this->dl->cancel_download(USER,$url,$uuid);

		if($strip=="json"){
			$data["result"]=$res;
			$data["url"]=$url;
			$data["uuid"]=$uuid;
			header("Content-type: application/json");
			print json_encode($data);
		}else{
			$this->index();
		}
	}

	function add($strip=""){
		if(!$this->dl){
			$this->dl=new Downloader;
		}
	
		$url=$this->input->post('url');
		$uuid=$this->input->post('uuid');
		
		$res=false;
		if(trim($url)!=""){
			$res=$this->dl->add_download(USER,$url,$uuid);
		}
		if($strip=="json"){
			$data["result"]=$res;
			$data["url"]=$url;
			$data["uuid"]=$uuid;
			header("Content-type: application/json");
			print json_encode($data);
		}else{
			$this->index();
		}
	}

	function getbyUUID($uuid=""){
		$res["result"]=false;
		
		if($uuid==""){
			$uuid=$this->input->post('uuid');
		}
		
		if(query_service("filetransferdaemon") && $uuid){
			if(!$this->dl){
				$this->dl=new Downloader;
			}
			$res["download"]=$this->dl->querybyUUID($this->session->userdata("user"),$uuid);
			$res["result"]=$res["download"]!=NULL;
		}
		header("Content-type: application/json");
		print json_encode($res);
	}

	function dolist($strip=""){
		$data["dls"]=array();

		if(query_service("filetransferdaemon")){
			if(!$this->dl){
				$this->dl=new Downloader;
			}
			$dls=$this->dl->list_unordered_downloads($this->session->userdata("user"));
			if($dls!=NULL){
				$this->sorted=$dls;
				uksort($dls,array($this,"_sortdls"));
				$data["dls"]=$dls;
			}
		}
		if($strip=="json"){
			header("Content-type: application/json");
			print json_encode($data);
		}else{
			$this->load->view(THEME.'/downloads/downloads_list_view',$data);
		}
	}

	function index(){
		$data["uuid"]=uniqid("ftd");

		$this->_renderfull($this->load->view(THEME.'/downloads/downloads_index_view',$data,true));
	}	

}
?>
