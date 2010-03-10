<?
	function select($list,$id,$prefix) {
		print "<div id=\"$id\">\n";
		foreach($list as $key => $line) {
			print "<div class=\"files\" id=\"".$prefix."_".$key."\">$line</div>\n";
		}
		print "</div>\n";
	}

	function printjobs($list) {
		print "<div id=\"current_rjobs\">\n";
		foreach($list as $key => $line) {
			print "<div class=\"files\" id=\"$line\">$line</div>\n";
		}
		print "</div>\n";
	}

?>
<script  type="text/javascript">
/*<![CDATA[*/

var timer = 0;

function progressIndicate() {
	
	$('#lock_progress').text($('#lock_progress').text()+  ".");
	timer = setTimeout( progressIndicate, 5000 );

}

function progressReport() {
	$.ajax({
		type: 'POST',
		url: "/admin/ajax_settings/ajax_backup_restorestatus",
		data: { action: 'progress' },
		timeout: 5000,
		dataType: 'json', 
		success: function( data ) {
			$('#lock_error').empty();
			$('#lock_header').html("<?=t("Restoring file(s) from backupjob: ")?>" + data.jobname + "<?=t(" for user: ")?>" + data.user);
			switch( data.done ) {
			case 1:
				$('#lock_header').text("<?=t("Done.")?>");
				$('#lock_progress').text(data.status);
				$("#backup_restore").removeAttr("disabled");
				select_job($("#current_rjobs").children("[class$='selected']"));
				$("#backup_restore").attr("disabled",false);
				cursor_ready();
				break;
			
			case 0:
				$('#lock_progress').text(data.status);
				window.setTimeout( progressReport, 1000 );
				break;

			case -1:
				$('#lock_error').html(data.status);
				$("#backup_restore").attr("disabled",false);
				cursor_ready();
				break;
			default:
				//alert("Should not be here");
				cursor_ready();
				break;
			}
			
		},
		error: function( xhr, textStatus, errorThrown ) {
			errHandler = function( secs ) {
				if( secs <= 0 ) {
					$('#lock_error').html('Retrying querying...');
					window.setTimeout( progressReport, 500 );
				}
				else {
					$('#lock_error').html('Error, couldn\'t connect to server. Will retry communication in ' + secs + ' seconds...');
					window.setTimeout( function() { errHandler( secs - 1 ) }, 1000 );
				}
			}
			errHandler( -1 );
		}
	});
}


	function highlight($obj) {

			$obj.siblings().val("");
			$obj.siblings().removeClass("selected");
			
			$obj.val("selected");
			$obj.removeClass("subselected");
			$obj.addClass("selected");
		
	}

	function running_job() {
		if($("#lock_progress").text() != "") {
			return 1;
		} else {
			return 0;
		}
	}


	function select_file($obj) {
		
		var $filename;
		$obj.siblings().removeClass("subselected");
		$filename = $obj.text().substr($obj.text().indexOf('/'));
		//console.log("Filnamn: " + $filename + "\n");

		$("#current_files").children("div:contains(" + $filename + "/" + ")").addClass("subselected");
		
		highlight($obj);
	}

	function select_date($date) {
		highlight($date);
		// load status here:
		if($date.hasClass("highlight")) {
			$('body').addClass('cursor_wait');
			$.post("<?=site_url("ajax_settings/ajax_backup_getstatus")?>",{ 'file' : $date.attr('id') },
			function(data){
				if(!data.error) {
					$("#current_status").html(data.info);
				} else {
					console.log("Backend returned an unknown error.");
				}

				cursor_ready();

			},"json");

			
			
			
			
		} else {
			$("#current_status").html("<?=t("Backup complete")?>");
		}


		$('body').addClass('cursor_wait');
		$("#current_files").empty();

		$.post("<?=site_url("ajax_settings/ajax_backup_listfiles")?>",{ 'user': "<?=$this->session->userdata("user")?>", 'jobname': $date.attr('name'),'date' : $date.attr('id') },
			function(data){
				if($date.attr('name') != get_selected_job()) {
					return 0;
				}
				if(!data.error) {
					for($id in data.files) {
						$newdiv = $("<div />\n");
						$newdiv.attr('id',"file_" + $id)
						$newdiv.addClass("files");
						$newdiv.html(data.files[$id]);
						$("#current_files").append($newdiv);
												
					}
					
				} else {
				}

				cursor_ready();

			},"json");
	
				
	}
	
	function get_selected_job() {
		
		return $("#current_rjobs").children(".selected").text();
		
	}
	
	function select_job($job) {
	
		cursor_wait();
		if($("#lock_error").text()) {
			// remove any error data from status
			$("#lock_header").text("");
			$("#lock_progress").text("");
			$("#lock_error").text("");
		}
	
		highlight($job);
		$("#current_dates").html("&nbsp;");
		$("#current_status").html("&nbsp;");
		$("#current_files").html("&nbsp;");
	
		$('body').addClass('cursor_wait');
		$.post("<?=site_url("ajax_settings/ajax_backup_listdates")?>",{ 'user': "<?=$this->session->userdata("user")?>", 'jobname': $job.text() },
		function(data){
			if($job.text() != get_selected_job()) {
				return 0;
			}
			if(!data.error) {
				$("#current_dates").html("");
				for($id in data.dates) {
	
					$newdiv = $("<div />\n");
					$newdiv.attr('id',$id);
					$newdiv.attr('name',$job.html());
					$newdiv.html(data.dates[$id]["date"] + " " + data.dates[$id]["time"]);
					$newdiv.addClass("files");
					if(data.dates[$id]["status"]) {
						$newdiv.addClass(data.dates[$id]["status"]);
					}
					$("#current_dates").append($newdiv);
				}
				if(!running_job()) {
					$("#backup_restore").attr("disabled",false);
				}
	
				// select first date
				select_date($("#current_dates").children('div:first'));
				cursor_ready();
			} else {
				// no local data found
				if($("#current_rjobs").children().length > 0) {
					// Get the jobsettings
					$.post("<?=site_url("ajax_settings/ajax_backup_settings")?>",{ 'user': "<?=$this->session->userdata("user")?>", 'jobname': $job.text() },
					function(data) {
						if(!data.error) {
							// Is the backup job correctly defined?
							if(data.settings['target_protocol']) {
								$("#current_dates").append($("<div />").text("<?=t("No local data found")?>").attr('id',0));
								$("#current_status").append($("<div />").addClass("c_link").text("<?=t("Click to retreive backup information from backup target")?>").attr('id',"get_info"));
								$("#get_info").click(function() {
									restore('');
								});
							} else {
								$("#current_status").append($("<div />").html("<?=t("Backup target settings undefined.")?>"));
							}
						} else {
							$("#current_status").append($("<div />").text("<?=t("Error reading jobsettings.")?>"));
						}
						cursor_ready();
					},"json");
				} else {
					cursor_ready();
				}
			}
	
		},"json");
	
	}


 	function updatebackup(){
 		
 		var $txt = "";
		var $mypost = $("#backupsettings").serialize();
		
		cursor_wait();
		$.post("<?=site_url("ajax_settings/ajax_backup_update")?>", $mypost,
				function(data){
					if(data.error == "") {
						update_status("success","<?=t("Update successful")?>");
						setup_clicks();
					} else {
						update_status("fail","<?=t("Update error")?>");
					}
					cursor_ready();
				}
		,"json");

 		return false;
 	}

	function do_restore($mypost) {
		$.post("<?=site_url("ajax_settings/ajax_backup_restore")?>", {"jobname" : $mypost["jobname"], "time" : $mypost["time"], "file" : $mypost["file"], "force" : $mypost["force"] },
				function(data){
					if(data.error == "") {
						$("#lock_header").html("<?=t("Retreiving file information ...")?>");
						$("#lock_progress").empty();
						window.setTimeout( progressReport, 5000 );
					} else {
						update_status("fail","<?=t("Update error")?>");
					}
				}
		,"json");
	}
		
	function restore(o) {

		//alert("Length: " + $("#current_files").children(hasClass("selected")));
		
		$("#lock_header").empty();
		$("#lock_progress").empty();
		$("#lock_error").empty();
		
		var $jobname = $("#current_rjobs").children("[class$='selected']").html();
		var $mypost = new Array();
		var $reload;
		if(!o) {
			$mypost["file"] = "<?=$loc_fileinfo?>" + $jobname;
			$mypost["time"] = "0";
			$reload = true;
			$("#get_info").click(function() { return false });
			$("#get_info").removeClass("c_link");
			$("#get_info").empty();
			//alert("Get info for job " + $jobname + "\n" + $mypost["file"]);
			
		} else {
			$myfile = $("#current_files").children("[class$='selected']:first").text();
			$mypost["file"] = $myfile;
			$mypost["time"] = $("#current_dates").children("[class$='selected']").text();
		}
		if($mypost["file"].length) {

			$mypost["jobname"] = $jobname;
			$mypost["force"] = 0;
			if($("#cb_force").attr('checked')) {
				$mypost["force"] = "overwrite";
			} else if ($("#cb_rdir").attr('checked')) {
				if(!$("#restore_dir").val()) {
					$.alert("<?=t("The 'Restore to directory' field can not be empty.")?>","","<?=t("Restore target dirctory missing")?>");
					return false;
				}
				$mypost["force"] = $("#restore_dir").val();
			}

			cursor_wait();
			if(!o) {
				update_status("success","<?=t("Retreiving information started")?>");
				$("#lock_header").text("<?=t("Retreiving information")?>");
				timer = setTimeout( progressIndicate, 0 );
				$.post("<?=site_url("ajax_settings/ajax_backup_current_filelist")?>", {"jobname" : $mypost["jobname"]},
						function(data){
							if(!data.error) {
								$("#lock_progress").text("<?=t("Restoring backup history")?>");
								$mypost["force"] = "overwrite";
								if(timer) {
									clearTimeout(timer);
								}
								do_restore($mypost);
							} else {
								$("#current_dates").empty();
								$("#current_dates").append(
									$("<div />").html("&nbsp;")
								);
								$("#current_status").empty();
								$("#current_status").append(
									$("<div />").text(data.status)
								);
								update_status("fail","<?=t("Error retreiving data from target")?>");
								if(timer) {
									clearTimeout(timer);
								}
								$("#lock_error").text(data.status);
								$("#lock_progress").empty();
								cursor_ready();
							}
						}
				,"json");
			} else {
				update_status("success","<?=t("Restore started")?>");
				do_restore($mypost);
			}
			return false;
		} else {
			$.alert("<?=t("Please select files to restore from the list of included files.")?><br><?=t("Selecting a directory will also select all files within the directory.")?>","","<?=t("No files selected")?>");
			$("#backup_restore").removeAttr("disabled");
		}
	}
	 
	$(document).ready(function(){

		$("#current_rjobs .files").click(function(e) {
			if(get_selected_job() != $(this).text()) {
				hide_status();
			}
			if(!$(e.target).hasClass('selected')) {
				select_job($(this));
			}
		});

		// make clicks work on the new entries
		$("#current_dates .files").live("click",function() {
			if($(this).val() != "selected") {
				select_date($(this));
			}
		});

		// make clicks work on the new entries
		$("#current_files .files").live("click",function() {
			if($(this).val() != "selected") {
				select_file($(this));
			}
		});

		$("#backup_restore").click(function(){
			$(this).attr("disabled",true);
			restore($(this));
		});

		// load first job
		if($("#current_rjobs .files:first")) {
			//alert("select: " + $("#current_rjobs .files:first").html());
			select_job($("#current_rjobs .files:first"));
		}		

		$("#cb_force").click(function() {
			$("#restore_dir").attr("disabled","disabled");
		});

		$("#cb_restore").click(function() {
			$("#restore_dir").attr("disabled","disabled");
		});
		
		$("#cb_rdir").click(function() {
			if($(this).attr("checked")) {
				$("#restore_dir").removeAttr("disabled");
			} else {
				$("#restore_dir").attr("disabled","disabled");
			}
		});
		
		$("#restore_dir").keyup(function() {
			$("#targetdir").text("/" + $("#restore_dir").val());
		});
<?
	if(isset($restore["lock"])) {
		print "window.setTimeout( progressReport, 0 );\n";
		print "$('#backup_restore').attr('disabled','disabled');";
	}
?>

	});

		
		

/*]]>*/
</script>

<div class="ui-state-default ui-widghet-header ui-div-header"><?=t('Restore user data')?></div>

<div id="restore">	
	<div id="backup_header" class="ui-filemanager-state-hover">
		<div class="jobs"><?=t("Existing jobs")?></div>
		<div class="date"><?=t("Backup date")?></div>
		<div class="status"><?=t("Backup status")?></div>
		<div class="backupfiles"><?=t("Included files")?></div>
	</div>

	<div id="backup_content">
		<div class="jobs">
		<?
		if(count($backupjobs)) {
			printjobs($backupjobs);					
		} else {
			print t('No jobs found') .".\n";
		}
		?>
		</div>
		<div class="date">
			<div id="current_dates">&nbsp;</div>
		</div>
		<div class="status">
			<div id="current_status">&nbsp;</div>
		</div>
		<div class="backupfiles">
			<div id="current_files">&nbsp;</div>
		<div class="force_settings">
			<input type="radio" name="force" class="checkbox_radio cb_force" id="cb_restore" checked="true"/><?=t("Restore missing files")?><br>
			<input type="radio" name="force" class="checkbox_radio cb_force" id="cb_force"/><?=t("Overwrite files")?><br>
			<input type="radio" name="force" class="checkbox_radio cb_force" id="cb_rdir" /><?=t("Restore to directory")?><input disabled="disabled" type="text" id="restore_dir" class="cb_force"/>(/home/<?=$this->session->userdata("user")?><span id="targetdir"></span>)
			
		</div>
		<input type="submit" id="backup_restore" value="<?=t("Restore selection")?>" disabled="true"/>
		</div>
	</div>
</div>	
</fieldset>


<fieldset><legend><?=t("Current operations")?></legend>
		<div id="lock_header" ><?
			if(isset($restore["lock"])) {
				echo t("Restoring file(s) from backupjob: ");
				echo $restore["jobname"];
				echo t(" for user: ");
				echo $restore["user"];
			} else {
				echo t("No current restore operations");
			}
			?>
		</div>
		<div id="lock_progress"></div>
		<div id="lock_error" class="highlight"></div>
</fieldset>
