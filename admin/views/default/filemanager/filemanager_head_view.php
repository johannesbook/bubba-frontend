<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/backup.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css?v='<?=$this->session->userdata('version')?>'" />
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jqueryFileTree.js?v='<?=$this->session->userdata('version')?>'"></script>
<link href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jqueryFileTree.css" rel="stylesheet" type="text/css" />

<script  type="text/javascript">
	function runnow(job) {
		if(!job) {
			job = $("#current_jobs").children(".selected").text();
		}
		$("input").attr("disabled",true);
		$("select").attr("disabled",true);
		$.post("<?=site_url("ajax_settings/ajax_backup_runjob")?>", { 'user': "<?=$this->session->userdata("user")?>", 'jobname': job});
		cursor_wait();
		update_status(true,"<?=t("Backup job scheduled")?>");
		setTimeout("window.location.reload()",2000);
	}

	function updateform(val){
		$(".unitclass").val($("#unitselector").val());
	}
 
  function update_disklist($uuid_to_select,$label) {
		$.post("<?=site_url("ajax_settings/ajax_list_disks")?>","",
			function(data){
				if(!data.error) {
					$("#target_host").addClass("hidden");
					$("#target_disk").removeClass("hidden");
					$("#disk_label").addClass("underline");
					$("#host_label").removeClass("underline");
					$("#target_disk").empty();					

					$my_select = $("<select name=\"disk_uuid\" id=\"disk_uuid\"></select>").appendTo("#target_disk");
					$my_disklables = "";
					if(data.nbrdisks) {
						for($disk in data.disks) {
							$my_select.append("<optgroup label=\"" + $disk + "\">\n")	;
							for($partition in data.disks[$disk]) {
								$my_optlist = "<option value=\""+data.disks[$disk][$partition]["uuid"]+"\">"+data.disks[$disk][$partition]["label"]+"</option>\n";
								$my_select.append($my_optlist);
								$my_disklables += "<input id=\"disk_labels\" type=hidden name=\"disk_label["+data.disks[$disk][$partition]["uuid"]+"]\" value=\""+data.disks[$disk][$partition]["label"]+"\">\n";
							}
							if($("#disk_labels").html()) {
								$("#disk_labels").remove();
							}
							$my_select.append("</optgroup>\n");
						}
					} else {
						$my_select.prepend("<optgroup label=\"<?=t("No disks found")?>\"></optgroup>");
					}
											
					if($uuid_to_select) {
						if($my_select.children('option[value='+$uuid_to_select+']').length) {
							$my_select.children('option[value='+$uuid_to_select+']').attr("selected","selected");
						} else {
							$my_select.prepend("<optgroup label=\"<?=t("By Config")?>\"><option selected=\"selected\" value=\""+$uuid_to_select+"\">"+$label+"</option></optgroup>");
							$.alert("<?=t("The specified backupdisk is not attached.")?>","<?=t("Disk error")?>","");
						}
					}						
						
					$("#target").append($my_disklables);

				} else {
					$.alert("<?=t("Error listing disks.")?>","<?=t("Disk error")?>","");
					
				}
				cursor_ready
			},"json");
  	
  }

 	function updatebackup(){
 		
 		var $txt = "";
 		// verify encryption passwords
 		if($("#security input[name='GPG_key']").val() == $("#security input[name='GPG_key2']").val() ) {
			var $mypost = $("#backupsettings").serialize();
			if(!$("input[name='encrypt']").attr("checked") && $("input[name='GPG_key']").val()) {
				// there is a key in the field, store it with the settings altough the key is not currently used.
				$mypost += "&GPG_key=" + $("input[name='GPG_key']").val();
			}
			cursor_wait();
			$.post("<?=site_url("ajax_settings/ajax_backup_update")?>", $mypost,
					function(data){
						if(data.error == "") {
							update_status(true,"<?=t("Update successful")?>.");
							$("#buttons input[name='run_now']").attr("disabled",false);
							$("#buttons input[name='deletejob']").attr("disabled",false);
							$("#status").empty();
						} else {
							update_status(false,"<?=t("Update error")?>:" + data.error);
						}
						cursor_ready();
					}
			,"json");
		} else {
			$("#target").slideUp(500);
			$("#schedule").slideUp(500);
			$("#security").slideDown(500);
			update_status(false,"<?=t("Encryption passwords do not match")?>");
		}	
 		return false;
 	}


	function delete_job(job) {
		
		if(!job) {
			job = $("#current_jobs").children(".selected");
		}
		$.confirm(
			"<?=t("Delete backup job:")?> " + job.html(),
			"<?=t("Delete job")?>",
			[
				{
					'label': "<?=t("Delete")?>",
					'callback': function() {
						disable_buttons();
						var confirm_dialog = $(this);
						$.post("<?=site_url("ajax_settings/ajax_backup_deletejob")?>",{ 'user': "<?=$this->session->userdata("user")?>", 'jobname': job.html()},
							function(data){
								if(!data.error) {
									job.hide('slow');
									job.remove();
									update_status(true,"<?=t("Update successful")?>");
									updatefields($("#current_jobs .files:last"));
									$("#current_jobs .files:last").addClass("selected");
								} else {
									update_status(false,"<?=t("Update error")?>: " + data.error)
								}
								confirm_dialog.dialog('close');
							}
						,"json");
					},
					options: { id: 'fn-filemanager-backup-delete-confirm-button' }
				}
			]
		);

	}
	
	function remove_dir(e) {
		
		if($(e.target).attr("id") == "remove_exc") {
			file = $("#current_excfiles .selected");
			url = "<?=site_url("ajax_settings/ajax_backup_addfile")?>";
		} else {
			file = $("#current_incfiles .selected");
			url = "<?=site_url("ajax_settings/ajax_backup_rmfile")?>";
		}
		jobname = $("#current_job").val();
		$.post(url,{ 'user': "<?=$this->session->userdata("user")?>", 'jobname': jobname, 'file': file.text() },
			function(data){
				cursor_wait();
				if(!data.error) {
					update_status(true,"'"+data.file + "' " + data.status);
					file.hide('slow');
				} else {
					update_status(false,"<?=t("Error")?>. '" + data.file + "' " + data.status);
					}
				cursor_ready();
			}
		,"json");
		$(e.target).attr("disabled",true);
	}
		
	function disable_buttons() {
//		if( $("#current_jobs .files").size() == 0 ) {
			$("#include").attr('disabled', true);
			$("#exclude").attr('disabled', true);
			$("#buttons input[type='button']").attr('disabled', true);
//		}
		$("#remove_inc").attr('disabled', true);
		$("#remove_exc").attr('disabled', true);
	}
	
	function enable_buttons() {
		$("#include").attr('disabled', false);
		$("#exclude").attr('disabled', false);
		$("#buttons input[name='update']").attr('disabled', false);
	}
	
	function enablefields($timer) {

				// disable fields
				$("#schedule input").not("[type='radio']").attr('disabled','disabled');
				$("#schedule select").not("[name='nbr_fullbackups']").not("[name='full_expiretime']").attr('disabled','disabled');
				
				switch($timer) {
					case "week":
						$("#schedule input[value='week']").closest('tr').children('td').children('input[type=checkbox]').removeAttr("disabled");
						$("#schedule select[name='timeofday']").removeAttr("disabled");
						$("#schedule select[name='timeofday'] option[value='4']").attr("selected","selected");
						break;
					case "month":
						$("#schedule select[name='timeofday']").removeAttr("disabled");
						$("#schedule select[name='dayofmonth']").removeAttr("disabled");
						$("#schedule select[name='timeofday'] option[value='4']").attr("selected","selected");
						$("#schedule select[name='dayofmonth'] option[value='1']").attr("selected","selected");
						break;
					case "hourly":
						$("#schedule select[name='hourly']").removeAttr("disabled");
						$("#schedule select[name='hourly'] option[value='2']").attr("selected","selected");
						break;
				}

	}
	function default_settings() {
		$("#current_incfiles").html("<?=t("No files included")?>");
		$("#schedule input[value='disabled']").attr("checked",true);
		$("#target_protocol option[value='file']").attr("selected",true);
		$("#backupsettings input[type='text']").val("");
		$("#backupsettings input[type='password']").val("");
		$("#backupsettings select[name='nbr_fullbackups'] option[value='2']").attr('selected','selected');
		update_disklist();
		enablefields();
	}
	function updatefields($obj,$newjob) {

		// always disable jobname for now.
		$("#settings input[name='jobname']").attr("disabled","disabled");

		
		var $includes="";
		var $excludes="";

		if($("#current_jobs").children('div').length) {

			if($("#current_job").val() != $obj.attr('id') && !$newjob) {
				////------ Clear all data ---------
				$("#current_incfiles").empty();
				$("#current_excfiles").empty();
		
				////------   Update settings   ---------
				$("select[name='full_expiretime']").children("option[value='1W']").attr("selected","selected");	
				
				$("#settings input[type='text']").val("");
				$("#settings input[type='password']").val("");
				$("#settings input[type='checkbox']").removeAttr("checked");
				$("#settings input[type='radio']").removeAttr("checked");
				$("#current_job").val($obj.attr('id'));
				$("#settings input[name^='GPG_key']").attr("disabled",true);
				
				cursor_wait();
				$.post("<?=site_url("ajax_settings/ajax_backup_settings")?>",{ 'user': "<?=$this->session->userdata("user")?>", 'jobname': $obj.attr("id") },
				function(data){
					if($("#current_job").val() != $obj.attr('id')) {
						// the user has clicked a new job, discard this update.
						return 0;
					} else {				
						for($file in data.files['include']) {
							$includes += "<div class=\"files\" id=\"inc_" + $file + "\">" + data.files['include'][$file] + "</div>\n";
						}
						if($includes != "") {
							$("#current_incfiles").html($includes);
						} else {
							$("#current_incfiles").html("<?=t("No files included")?>");
						}					
					
						for($file in data.files['exclude']) {
							$excludes += "<div class=\"files\" id=\"exc_" + $file + "\">" + data.files['exclude'][$file] + "</div>\n";
						}
						$("#current_excfiles").html($excludes);
			
						// update all input type=text
						$("#settings input[type='text']").each(function() {
							//alert("Name: "+$(this).attr('name'));
							/*
							switch ($obj.attr('name')) {
							
								default:
									break;
							}
							*/
							$(this).val(data.settings[$(this).attr('name')]);
						});			
		
						// update all input type=password
						$("#settings input[type='password']").each(function() {
							switch ($(this).attr('name')) {
								//case "target_FTPpasswd":
								//	//alert("Password");
								//	if(data.settings['target_FTPpasswd'] != "") {
								//		$("#settings input[name='auth_type']").filter("[value='PW']").attr("checked","checked");
								//	}
								//	break;
		
								case "GPG_key":
									$("#settings input[name^='GPG_key']").val(data.settings['GPG_key']);
									break;
									
								case "encrypt":
									$("#settings input[name='encrypt']").attr("checked",true);
									$("#settings input[name^='GPG_key']").attr("disabled",false);
									break;
									
								default:
									break;
							}
							$(this).val(data.settings[$(this).attr('name')]);
						});			
		
						// update all selects
						$("#settings select").each(function() {
							$filter = "option[value='"+data.settings[$(this).attr('name')]+"']";
							$(this).children().filter($filter).attr("selected","selected");
						});
						// underline correct "disk/host"
						if($("#target_protocol").val() == "file") {
							
							//alert("Update with correct disk information");
							update_disklist(data.settings['disk_uuid'],data.settings['disk_label']);
							//alert("Disk label: " + data.settings['disk_label']);
							
							
							$("#target_host").addClass("hidden");
							$("#target_disk").removeClass("hidden");
							$("#disk_label").addClass("underline");
							$("#host_label").removeClass("underline");
							$("#target_FTPpasswd").attr("disabled","disabled");
							$("#target_user").attr("disabled","disabled");
						} else {
							$("#target_FTPpasswd").removeAttr("disabled");
							$("#target_user").removeAttr("disabled");
							$("#target_disk").addClass("hidden");
							$("#target_host").removeClass("hidden");
							$("#disk_label").removeClass("underline");
							$("#host_label").addClass("underline");
						}
		
						////------   Update schedule   ---------
						
						enablefields(data.schedule['monthweek']);
						
						// update all selects
						$("#settings select").each(function() {
							//console.log("Schedule " + $(this).attr('name') + "\n");
							if(data.schedule[$(this).attr('name')]) {
								$filter = "option[value='"+data.schedule[$(this).attr('name')]+"']";
								$(this).children().filter($filter).attr("selected","selected");
								//console.log("Schedule " + $(this).attr('name') + " " + $filter + "\n");
							}
						});
						
						if(data.schedule['days']) {
							$("#schedule input[type='checkbox']").each(function() {
								if(data.schedule['days'][$(this).val()]) {
									//console.log("Setting " + $(this).val());
									$(this).attr("checked","checked");
								}
							});
						}
						
						$("#settings input[value='"+data.schedule['monthweek']+"']").attr("checked","checked");
		
						if(data.settings['target_protocol']) {
							$("#buttons input[name='run_now']").attr("disabled",false);
							$("#status").empty();
						} else {
							$("#buttons input[name='run_now']").attr("disabled",true);
						}
						if($("#job_running").val() != $("#current_job").val()) {
							$("#buttons input[name='deletejob']").attr("disabled",false);
						}
						cursor_ready();
						enable_buttons();
					}
				},"json");
			} else {
				// new job, use default settings
				default_settings();
			}
		} else {
			default_settings();
		}
		
	}		

	$(document).ready(function(){
				
		$("#schedule input[name='monthweek']").click(function() {
			if(!$(".weekday:checked").length) {
				// set a default setting
				$("input[name='sun']").attr('checked','checked');
			}
			enablefields($(this).val());	
		});

		$("#remove_inc").click(function(e) {
			remove_dir(e);
		});

		$("#remove_exc").click(function(e) {
			remove_dir(e);
		});
		
		$("#backupsettings input[name='encrypt']").click(function() {
			if($("#backupsettings input[name='encrypt']").attr("checked")) {
				$("#backupsettings input[name='GPG_key']").attr("disabled",false);
				$("#backupsettings input[name='GPG_key2']").attr("disabled",false);
			} else {
				$("#backupsettings input[name='GPG_key']").attr("disabled",true);
				$("#backupsettings input[name='GPG_key2']").attr("disabled",true);
			}
		});
		$("#btn_createjob").click(function() {
			//alert("Create new job " + $("#create_job").val() + "?");
			if($("#create_job").val()) {
				cursor_wait();
				$("#backupsettings input[type='text']").val("");
				$("#backupsettings input[type='password']").val("");
				$("#current_job").val("");
				$("#current_jobs").children(".files").removeClass("selected");
				disable_buttons();
				default_settings();
				$.post("<?=site_url("ajax_settings/ajax_backup_createjob")?>",{ 'user': "<?=$this->session->userdata("user")?>", 'jobname': $("#create_job").val() },
	
	
					function(data){
						if(!data.error) {
							if(!$("#current_jobs").children('div').length) {
								// remove "No jobs text"
								$("#current_jobs").empty();
							}
							$("#current_jobs").append("<div class=\"files\" id=\""+$("#create_job").val()+"\">"+$("#create_job").val()+"</div>\n");
							$("#current_jobs .files").removeClass("selected");
							$("#current_jobs .files:last").addClass("selected");
							updatefields($("#current_jobs .files:last"),1);
							$("#current_job").val($("#create_job").val());
							$("#backupsettings input[name='jobname']").val($("#create_job").val());
							$("#create_job").val("");
							enable_buttons();
							update_status(true,"<?=t("Backupjob added.")?>")
						} else {
							update_status(false,"<?=t("Update error")?>: " + data.status)
						}
	
						cursor_ready();
	
					},"json");
				} else {
					$.alert("<?=t("Please enter a jobname to identify your backup job.")?>","<?=t("Jobname missing")?>","");
					//$("#create_job").css("border","1px solid red");
				}
			
			return false;
		});
		
		$("#include").click(function() {
			var my_dialog;
			to_be_included = '';
			form = $('<form />');
			form.addClass("treelayout");
			form.append( $("<div />").addClass("backup_tree_header").text("<?=t("Select directory to include.")?>" ) );
			tree = $('<div />');
			form.append( tree );
			doit = $('<input />');
			form.append(
				$('<div class="buttons" />')
				.append(
					
					$("<input />").attr("id","do_include").attr("type","button").val("<?=t("Include")?>").click(function(e) {
						if( ! tree.find('.expanded') ) {
							return false;
						}
						cursor_wait();
						$.post("<?=site_url("ajax_settings/ajax_backup_addfile")?>",
							{ 
								'user': "<?=$this->session->userdata("user")?>",
								'jobname': $("#current_job").val(),
								'file': to_be_included
							},
							function(data){
								my_dialog.dialog("close");
								if(!data.error) {
									if(!$("#current_incfiles").children("div[class*='files']").length) {
										$("#current_incfiles").empty(); // remove "No data found"
									}
									show_file = to_be_included;
									$("#current_incfiles").append("<div class=\"files\">"+show_file+"</div>\n");
									update_status(true,"'"+show_file + "' " + data.status);
								} else {
									update_status(false,"<?=t("Error")?>. '" + data.file + "' " + data.status);
								}
								cursor_ready();
							},"json"
						)
					})
				)
			);
			tree.fileTree({
				root: '/home',
				script: '<?=site_url("ajax_settings/ajax_backup_filelist")?>',
				multiFolder: false,
				dirExpandCallback: function(dir) {
					$(".selected").removeClass("selected");
					$("[rel = '"+dir+"']").addClass("selected");
					to_be_included = dir;
				},
				dirCollapseCallback: function(dir) {
					to_be_included = dir;
					$(".selected").removeClass("selected");
					$("[rel = '"+dir+"']").addClass("selected");
					return true;
				}
			});
			my_dialog = $.dialog( form , "" ,{}, {dialogClass : 'filemanager-backup-dialog-select', width : '400'});

			return false;
		
		});			
		
		$("#exclude").click(function() {

			to_be_excluded = '';
			form = $('<form />');
			form.addClass("treelayout");
			form.append( $("<div />").addClass("backup_tree_header").text("<?=t("Select directory to exclude.")?>" ) );
			tree = $('<div />');
			form.append( tree );
			doit = $('<input />');
			form.append(
				$('<div class="buttons" />')
				.append($("<input />").attr("type","button").addClass("simplemodal-close").val("<?=t("Cancel")?>"))

				.append(
					$("<input />").attr("id","do_exclude").attr("type","button").val("<?=t("Exclude")?>").click(function(e) {
						if( ! tree.find('.expanded') ) {
							return false;
						}
						cursor_wait();
						$.post("<?=site_url("ajax_settings/ajax_backup_rmfile")?>",
							{ 
								'user': "<?=$this->session->userdata("user")?>",
								'jobname': $("#current_job").val(),
								'file': to_be_excluded
							},
							function(data){
								if(!data.error) {
									if(!$("#current_excfiles").children("div[class*='files']").length) {
										$("#current_excfiles").empty(); // remove "No data found"
									}
									show_file = to_be_excluded;
									$("#current_excfiles").append("<div class=\"files\">"+show_file+"</div>\n");
									update_status(true,"'"+show_file + "' " + data.status);
								} else {
									update_status(false,"<?=t("Error")?>. '" + data.file + "' " + data.status);
								}
								cursor_ready();
							},"json"
						)
					})
				)
			);
			tree.fileTree({
				root: '/home',
				script: '<?=site_url("ajax_settings/ajax_backup_filelist")?>',
				multiFolder: false,
				dirExpandCallback: function(dir) {
					to_be_excluded = dir;
					$(".selected").removeClass("selected");
					$("[rel = '"+dir+"']").addClass("selected");
				},
				dirCollapseCallback: function(dir) {
					to_be_excluded = dir;
					$(".selected").removeClass("selected");
					$("[rel = '"+dir+"']").addClass("selected");
					return true;
				}
			});
			$.dialog( form , "" ,{}, {dialogClass : 'filemanager-backup-dialog-select', width : '400'});
			return false;
		
		});
		
		// hide advanced settings
		$("div#schedule").css("display","none");
		$("div#security").css("display","none");
		$("#sec_mark").html("+");
		$("#sch_mark").html("+");
					
		$(".files").live("click",function(e) {
			
			if(e.button == 0) { // "0" => left button, jquery/broswer bugg: http://dev.jquery.com/ticket/4197
				
				if(($("#current_jobs").children(".selected").text() != $(this).text()) && ($(this).parent().attr("id") == "current_jobs" ) ) {
					// if not the same job and a job (not included file)
					disable_buttons();
					hide_status();
					updatefields($(this));
				} else {
					$(this).closest('td').children("input[type='button']:first").attr("disabled",false);
				}				
				$(this).addClass("selected");
				$(this).siblings().removeClass("selected");
			}
		});

		$('#encrypt').change(function() {
			if($(this).is(':checked')) {
				$('#GPG_key').removeAttr('disabled');
				$('#GPG_key2').removeAttr('disabled');
			} else {
				$('#GPG_key').attr('disabled','disabled');
				$('#GPG_key2').attr('disabled','disabled');
			}
		});
		
		$("#target_protocol").change(function() {
			//alert("Selected protocol is: " + $("#target_protocol").val());
			if($("#target_protocol").val() == "file") {
				update_disklist();
				$("#target_FTPpasswd").attr("disabled","disabled");
				$("#target_user").attr("disabled","disabled");

			} else {
				$("#target_disk").addClass("hidden");
				$("#target_host").removeClass("hidden");
				$("#host_label").addClass("underline");
				$("#disk_label").removeClass("underline");
				$("#target_FTPpasswd").removeAttr("disabled");
				$("#target_user").removeAttr("disabled");
			}
		});
		
		// select the first item in the list.
		if($("#current_jobs .files").eq(0).addClass("selected").length) {
			updatefields($("#current_jobs .files").eq(0));
		} else {
			default_settings();
		}
		
		// disable buttons when no jobs are present.
		disable_buttons();

		$('input.file').click( function() {
			$('#filemanagerform').find('input').not(':checked').size()
		});
		$('#sel_action').change(function() {

			if( $('#filemanagerform').find('input').is(':checked') ) {
				$('#filemanagerform')[0].submit();
				return true;
			} else {
				$('#filemanagerform')[0].reset();
				return false;
			}
		});
		

	});
	
</script>
