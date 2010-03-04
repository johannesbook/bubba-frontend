<?php

class Filemanager extends Controller{

	var $sortarray=false;
	var $lspath=false;

	function _sort_entries($ta, $tb){
		$a=strtolower($this->sortarray[$ta][3]);
		$b=strtolower($this->sortarray[$tb][3]);
	
		if($a == $b){
			return 0;
		}
		return ($a < $b) ? -1 : 1; 
	}



	function Filemanager(){

		parent::Controller();

		require_once(APPPATH."/legacy/defines.php");
		require_once(ADMINFUNCS);

		$this->Auth_model->EnforceAuth();

		load_lang("bubba",THEME.'/i18n/'.LANGUAGE);
	}

	function _renderfull($content, $head=true){
		if(!is_null($head)) {
			if( $head === true ) {
				$mdata["head"] = $this->load->view(THEME.'/filemanager/filemanager_head_view','',true);
			} else {
				$mdata['head'] = $head;
			}
		}
		$mdata["dialog_menu"] = $this->load->view(THEME.'/menu_view','',true);
		$mdata["navbar"]=$this->load->view(THEME.'/nav_view','',true);
		$mdata["subnav"]=$this->load->view(THEME.'/filemanager/filemanager_submenu_view','',true);;
		$mdata["content"]=$content;
		$this->load->view(THEME.'/main_view',$mdata);
	}	


	function backup($strip=""){
		$data["backupjobs"] = get_backupjobs($this->session->userdata("user"));
		$data["backup"] = get_backupstatus();
		//only send jobfile, all settings are retreived using ajax.
		if($strip){
			$this->load->view(THEME.'/filemanager/filemanager_backup_view',$data);		
		}else{
			$this->_renderfull($this->load->view(THEME.'/filemanager/filemanager_backup_view',$data,true));
		}
	}

	function restore($strip=""){
		$data["backupjobs"] = get_backupjobs($this->session->userdata("user"));
		$data["loc_fileinfo"] = $this->session->userdata("user")."/.backup/";
		
		if(file_exists(RESTORE_LOCKFILE)) {
			$data["restore"]["lock"] = true;
			$data["restore"]["user"] = "";
			$data["restore"]["jobname"] = "";

			$fh_lockfile = fopen(RESTORE_LOCKFILE,"r");
			$line = fgets($fh_lockfile);
			fclose($fh_lockfile);

			$line = rtrim($line);
			$rdata = explode(" ",$line);
			if(isset($rdata[0])) {
				$data["restore"]["user"] = $rdata[0];
			}
			if(isset($rdata[1])) {
				$data["restore"]["jobname"] = $rdata[1];
			}
		} else {
		}

		if($strip){
			$this->load->view(THEME.'/filemanager/filemanager_restore_view',$data);		
		}else{
			$this->_renderfull($this->load->view(THEME.'/filemanager/filemanager_restore_view',$data,true));
		}
	}
	
	function delete($strip=""){

		if( $strip == 'json' ) {
			$errors = array();
			$files = $this->input->post('files');
			$user=$this->session->userdata("user");
			if(!is_array($files)) {
				$files = array($files);
			}

			foreach($files as $file){
				if(rm($file,$user)){ // true is false
					$errors[] = $file;
				}
			}		
			$data["success"]=empty($errors);

			if( !empty($errors) ) {
				$data['error'] = true;
				$data['html'] = t("filemanager-delete-fail-message",implode(', ',$errors));
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			
		} else {
			echo "error";
		}
	}
	function rename($strip=""){

		if( $strip == 'json' ) {
			$error = false;
			$path = $this->input->post('path');
			$root = $this->input->post('root');
			$newname = $this->input->post('name');
			if( ! file_exists( $path ) ) {
				$error = t("filemanager-rename-file-not-exists-error");
			}
			if(!$error){
				$user=$this->session->userdata("user");
				$newpath = "$root/$newname";
				if(mv($path,$newpath,$user)) { // true == false
					$error = t("filemanager-rename-error $newpath - $path - $user");
				}
			}
			$data["success"]=!$error;

			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
			
		} else {
			echo "error";
		}
	}	
	function album($strip=""){
		$file_id = $this->input->post('file_id') ? 
				$this->input->post('file_id') : array();
		$file_name = $this->input->post('file_name') ? 
				$this->input->post('file_name') : array();
		
		$cnt=count($file_id);
		if($cnt>0){
			for($i=0; $i<$cnt; $i++){
				$data["files"][b_dec($file_name[$file_id[$i]])]=$file_name[$file_id[$i]];
			}
		}else{
			$data["files"]=array();
		}
		$data["path"]=$this->input->post("path");

		if($strip){
			$this->load->view(THEME.'/filemanager/filemanager_album_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/filemanager/filemanager_album_view',$data,true),false);
		}
	}
	function doalbum($strip=""){
		$this->load->model('album_model');
		if($this->input->post("cancel")){
			$this->index();
			return;
		}

		$file_list = $this->input->post('file_list') ? $this->input->post('file_list') : array();
		$user=$this->session->userdata("user");
		
		$data["path"]=$this->input->post("path");
		$data['files'] = $this->album_model->batch_add( $file_list );

		if($strip){
			$this->load->view(THEME.'/filemanager/filemanager_doalbum_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/filemanager/filemanager_doalbum_view',$data,true),false);
		}
	}
	function perm($strip="", $mode = 'get' ){

		if( $strip == 'json' ) {
			if( $mode == 'get' ) {
				$files=$this->input->post("files");
				$file_mode = 0000;
				foreach( $files as $file ) {
					$ss = @stat( $file );
					if( $ss ) {
						$file_mode |= $ss['mode'] & 000777;
					}
				}
				if( $file_mode == 0 ) {
					$file_mode = 0775;
				}
				$data = array(
					'permissions' => $file_mode
				);
				header("Content-type: application/json");
				echo json_encode( $data );

				
			} else {
				$errors = array();

				$files=$this->input->post("files");
				$user=$this->session->userdata("user");

				if( ! $error ) {
					$mask = 0000;

					if($this->input->post("permission-owner-read")) {
						$mask |= 00400;
					}
					if($this->input->post("permission-owner-write")) {
						$mask |= 00200;
					}
					if($this->input->post("permission-owner-execute")) {
						$mask |= 00100;
					}

					if($this->input->post("permission-group-read")) {
						$mask |= 00040;
					}
					if($this->input->post("permission-group-write")) {
						$mask |= 00020;
					}
					if($this->input->post("permission-group-execute")) {
						$mask |= 00010;
					}

					if($this->input->post("permission-other-read")) {
						$mask |= 00004;
					}
					if($this->input->post("permission-other-write")) {
						$mask |= 00002;
					}
					if($this->input->post("permission-other-execute")) {
						$mask |= 00001;
					}

					foreach( $files as $file ) {
						if( changemod($file,$mask,$user) ) { // true == false
							$errors[] = $file;
						}
					}
				}
				$data["success"]=empty($errors);

				if( !empty($errors) ) {
					$data['error'] = true;
					$data['html'] = t("filemanager-perm-fail-message",implode(', ',$errors));
				}
				header("Content-type: application/json");
				echo json_encode( $data );
			}
		}
	}


	function mkdir($strip=""){

		if( $strip == 'json' ) {
			$error = false;
			$directory=trim($this->input->post("name"));
			$root=trim($this->input->post("root"));
			$user=$this->session->userdata("user");

			if( ! $directory ) {
				$error = t("filemanager_mkdir_error_nodir");
			}

			$realpath = "$root/$directory";
			if( !$error && file_exists( $realpath ) ) {
				$error = t("filemanager_mkdir_error_file_exists");
			}

			if( ! $error ) {
				$mask = 0000;

				if($this->input->post("permission-owner-read")) {
					$mask |= 00500;
				}
				if($this->input->post("permission-owner-write")) {
					$mask |= 00300;
				}

				if($this->input->post("permission-group-read")) {
					$mask |= 00050;
				}
				if($this->input->post("permission-group-write")) {
					$mask |= 00030;
				}

				if($this->input->post("permission-other-read")) {
					$mask |= 00005;
				}
				if($this->input->post("permission-other-write")) {
					$mask |= 00003;
				}

				if( !md($root."/".$directory,$mask,$user) ) {
					$error = t("filemanager_mkdir_error_create");
				}

			}
			$data["success"]=!$error;

			if( $error ) {
				$data['error'] = true;
				$data['html'] = $error;
			}
			header("Content-type: application/json");
			echo json_encode( $data );
		}
	}
	
	function move($strip=""){
		
		if($path= $this->input->post('mv_cancel')){
			$this->index();
			return;
		}		

		if($path= $this->input->post('mv_confirm')){
			$this->domove();
			return;
		}
		
		$data["mv_path"]=false;
		$data["bpath"]=false;
		$data["pathlink"]=false;
		$data["dirs"]=false;
		$data["path"]= $path= $this->input->post('path');
		
		// Do we have files from a change dir
		$mv_items=$this->input->post('mv_item') ? $this->input->post('mv_item'):array();
		
		if(count($mv_items)==0){ 
			// No this is first invocation build mv_items
			$file_id = $this->input->post('file_id') ? 
					$this->input->post('file_id') : array();
			$file_name = $this->input->post('file_name') ? 
					$this->input->post('file_name') : array();
			$cnt=count($file_id);         
			for($i=0; $i<$cnt; $i++){
				$mv_items[] = $file_name[$file_id[$i]];
			}
		}

		$data["mv_items"]=$mv_items;

		$mv_path=($this->input->post("mv_path")?
				b_dec($this->input->post("mv_path")):b_dec($path));
		if($this->input->post("adddir")){
			$mv_path.="/".b_dec($this->input->post("add_item"));
		}
		$data["mv_path"]=$mv_path;
		
		$parts=explode("/",$mv_path);
		$bpath="";
		$pathlink="";
		foreach($parts as $part){
			if($part=="") continue;
			$bpath.="/$part";
			$pathlink.="/<a href=\"javascript:doChange('".b_enc($bpath)."')\">$part</a>";
		}
		$data["pathlink"]=$pathlink;
		$data["bpath"]=$bpath;	

		$user=$this->session->userdata("user");

		$out = ls($user,"$mv_path");
		$dirs=array();
		if($out!="\0\0"){
			foreach($out as $line){
				if($line[0]=="D"){
					$dirs[]=explode("\t",$line);
				}
			}
		}

		$this->sortarray=$dirs;
		uksort($dirs,array($this,"_sort_entries"));
		$data["dirs"]=$dirs;
    
		if($strip){
			$this->load->view(THEME.'/filemanager/filemanager_move_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/filemanager/filemanager_move_view',$data,true),false);
		}
	}	
	
	function domove($strip=""){
		$mv_items=$this->input->post("mv_item");
		$mv_path=b_dec($this->input->post("mv_path"));
		$path=$this->input->post("path");
		
		$data["mv_path"]=$mv_path;
		$data["path"]=$path;
		$data["items"]=array();		
		
		$user=$this->session->userdata("user");
		foreach($mv_items as $eitem){
			$item=b_dec($eitem);
			$data["items"][$item]=!mv($item,$mv_path,$user);
		}

		if($strip){
			$this->load->view(THEME.'/filemanager/filemanager_domove_view',$data);
		}else{
			$this->_renderfull($this->load->view(THEME.'/filemanager/filemanager_domove_view',$data,true),false);
		}
	}

	function _alter(&$item, $key){
		$item=b_dec($item);
	}

	function downloadzip(){
		$file_id = $this->input->post('file_id') ? $this->input->post('file_id') : array();
		$file_name = $this->input->post('file_name') ? $this->input->post('file_name') : array();
		$cnt=count($file_id);
		
		if($cnt==0){
			// Uggly hack to allow index to be loaded
			unset($_POST["action"]);
			$this->index();
			return;
		}		
		
		$user=$this->session->userdata("user");		
		
		$dl_item=array();
		for($i=0; $i<$cnt; $i++){
			$dl_item[]=$file_name[$file_id[$i]];
		}		
		array_walk($dl_item,array($this,'_alter'));

		if($this->input->post('dl_name')){
			$dl_name= $this->input->post('dl_name');
		}else{
			if($cnt==1){
				$dl_name=basename(b_dec($file_name[$file_id[0]]));
			}else{
				$dl_name="download.zip";
			}
		}

		if(strcasecmp(substr($dl_name,-4),".zip")){
			$dl_name.=".zip";
		}	
		
		$prefix=$this->input->post('path')?$this->input->post('path'):"/"; 		
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Pragma: public");
		header("Content-Disposition: attachment; filename=\"$dl_name\"");
		header("Content-type: application/x-zip");
		set_time_limit(3600);
		zip_files($dl_item,b_dec($prefix),$user);
	}
	
	function download(){
			
		if(!$this->input->post("path")){
			$get_file="/".join("/",array_slice($this->uri->segment_array(),2));
		}else{
			$get_file=$this->input->post("path");
		}
		$get_file=b_dec($get_file);
		$user=$this->session->userdata("user");
		$mime_type=get_mime($get_file);
		
		$filename=basename($get_file);
		$filesize = get_filesize($get_file,$user);
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Pragma: public");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Length: $filesize");
		
		if($mime_type) {
			header("Content-type: $mime_type");
		}
		
		set_time_limit(1800);
		cat_file($get_file,$user);
		
	}	
	
	function cd($strip=""){
		if(!$this->input->post("path")){
			$this->lspath="/".join("/",array_slice($this->uri->segment_array(),2));
		}
		$this->index();
	}	
	
	function index($strip=""){
		if( $strip == 'json' ) {

			$path=$this->input->post('path');
			$user=$this->session->userdata("user");

			$pos=strpos($path,"/home");

			if(($pos===false) || ($pos!=0)){
				$path="/home/$user";
			}
			$out = ls($user,"$path");
			$data['aaData'] = array();

			if($out=="\0\0") {
				// error
				$data["err_perm"]=true;
			}else{
				$typemap = array(
					'F' => 'file',
					'D' => 'dir',
					'L' => 'link',
				);
				foreach($out as $line) {
					if($line[0]=="P"){
						// Permission Hack to avoid more calls than needed to backend
						$perms=explode("\t",$line);
						$data["meta"]["writable"]=$perms[1]=="1";
					}else {
						list( $type, $size, $date, $name ) = explode("\t",$line);
						$data['aaData'][] = array(
							$typemap[$type],
							$name,
							$date,
							$size,
						);
					}
				}
			}
			$data['root'] = $path;

			header("Content-type: application/json");
			echo json_encode( $data );
			return;
		}

		// Multiplex requests :(
		if($this->input->post("action")){
			if($this->input->post("action")=="download"){
				$this->downloadzip();
				return;
			}else if($this->input->post("action")=="move"){
				$this->move();	
				return;
			}else if($this->input->post("action")=="permissions"){
				$this->chmod();
				return;
			}else if($this->input->post("action")=="delete"){
				$this->delete();	
				return;
			}else if( $this->input->post('action') == 'album') {
				$this->album();	
				return;
			}
		}

		if($this->input->post("mkdir")){
			$this->mkdir();
			return;
		}

		if($this->lspath){
			$path=$this->lspath;
		}else{		
			$path=$this->input->post('path');
		}
		$path=b_dec($path);
		$user=$this->session->userdata("user");

		$pos=strpos($path,"/home");
		
		if(($pos===false) || ($pos!=0)){
			$path="/home/$user";
		}
		$pos = strpos( $path, "/home/storage/pictures" );
		$in_pic_dir = false;
		if( $pos === 0 ) {
			$in_pic_dir = true;
		}

		$parts=explode("/",$path);
		$bpath="";
		$pathlink="";
		foreach($parts as $part){
			if($part=="") continue;
			$bpath.="/$part";
			$pathlink.="/<a href=\"".FORMPREFIX."/filemanager/cd/$bpath\">$part</a>";
		}

		$data["pathlink"]=$pathlink;
		$data["path"]=$path;
		$data["success"]=false;
		$data["err_perm"]=false;
		$data["files"]=array();
		$data["dirs"]=array();
		$data["user"]=$user;
		$data["ftd_running"]=query_service("filetransferdaemon");
		$data["pictures"] = $in_pic_dir && $user!="admin";

		$out = ls($user,"$path");

		if($out=="\0\0") {
			// error
			$data["err_perm"]=true;
		}else{
			foreach($out as $line) {
				if($line[0]=='D'){
					//Dir
					$data["dirs"][]=explode("\t",$line);
				}else if($line[0]=="P"){
					// Permission Hack to avoid more calls than needed to backend
					$perms=explode("\t",$line);
					$data["writable"]=$perms[1]=="1";
				}else if($line[0]!='L'){
					// Everything else but links
					$data["files"][]=explode("\t",$line);
				}else{
					// Links, we dont support that for security reasons
				}
			}
			$this->sortarray=$data["dirs"];
			uksort($data["dirs"],array($this,"_sort_entries"));

			$this->sortarray=$data["files"];
			uksort($data["files"],array($this,"_sort_entries"));
			
			$data["success"]=true;
		
		}

		if($strip){
			$this->load->view(THEME.'/filemanager/filemanager_index_view',$data);
		}else{
			$this->_renderfull(
				$this->load->view(THEME.'/filemanager/filemanager_index_view',$data,true),
				$this->load->view(THEME.'/filemanager/filemanager_index_head_view',$data,true)
			);
		}
	}

}

?>
