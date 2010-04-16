<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>


	<script  type="text/javascript">
$(document).ready( function() {


	$('.remove_raid_disk').click(function(e) {
		$.post(	'<?=site_url("ajax_disk/remove_raid_disk")?>', { disk: $(e.target).attr('rel') }, function(data) {
			if( data.error ) {
				update_status( false, data.html );
			} else {
				location.reload();
			}
		});
	});
	$('#recover_md').click(function() {
		var dialog_element = $.dialog("", "<?=t("disk_raid_recover_title")?>", {});
		dialog_element.text("<?=t("disk-examine-disks")?>.");
		$.post(	'<?=site_url("ajax_disk/get_raid_disks")?>', {}, function(data) {
			dialog_element.empty();
			if( data.internal ) {
				if( data.clean_disks.length > 0 ) {
					// we got disks that can be used in RAID array
					dialog_element.html($('<p/>',{html:"<?=t("disk_raid_recover_broken_external_message")?>."}) );

					// Creating the dropdown of all available external disks
					var select = $('<select/>', {id: 'external'});
					for(i=0;i<data.clean_disks.length;++i) {
						select.append(
							$("<option />", { 
								value: data.clean_disks[i], 
								html: data.clean_disks[i] 
							})
						);
					}
					dialog_element.append( select );					

					// Updating the buttons in the dialog
					dialog_element.dialog(
						'option','buttons', {
							"<?=t('disk_raid_recover_broken_external_button_label')?>": function() {
								// Callback when choosing to create RAID
								var external_device = select.val();

								// The warning that now we are going to destroy any data on external disk
								dialog_element.html($("<h2/>",{'class':"ui-warning-highlight",html:"<?=t("generic_dialog_text_warning")?>."}) );
								dialog_element
									.append($('<p/>',{html:"<?=t("disk_raid_recover_broken_external_warning_1")?>"}))
									.append($('<p/>',{html:"<?=t("disk_raid_recover_broken_external_warning_2")?>"}));

								// Updating the buttons in the dialog
								dialog_element.dialog(
									'option','buttons', {
										"<?=t('disk_raid_recover_broken_external_button_label')?>": function() {
											// Callback when confirming creation of RAID
											dialog_element.dialog('option', 'title', '<?=t("disk_raid_recover_broken_external_progress_title")?>');
											dialog_element.dialog('option', 'buttons', {}); // remove buttons
											dialog_element.dialog('option', 'beforeclose', function(){return false;}); // prevent closing of dialog
											dialog_element.html($("<p/>",{html:'<?=t("generic_dialog_text_please_wait")?>'}));

											// calling the actual RAID recovery, point of no return
											$.post('<?=site_url("ajax_disk/recover_raid_broken_external")?>',{ external: external_device },
												function(data) {
													location.assign("/admin/disk/progress");
												}, 'json' );
										}
									});
							}
						}
					);
				} else {
					// We have no disks to use as RAID array
					dialog_element.html($("<p/>",{html:"<?=t("disk_raid_recover_broken_external_no_disks_message")?>."}) );
					dialog_element.dialog('option','buttons', {"<?=t('disk_raid_nodisk_label_cancel')?>": function() {dialog_element.dialog('close');}});
				}

			} else if(data.disks.length > 0) {
				if( data.internal_got_mounts ) {
					// There exists mounts under /home 
					dialog_element.html($("<p/>",{html:"<?=t("disk_raid_recover_broken_internal_mount_exists_message")?>."}) );
					dialog_element.dialog('option','buttons', {"<?=t('disk_raid_nodisk_label_cancel')?>": function() {dialog_element.dialog('close');}});
				} else {
					// we got disks that can be used in RAID array
					dialog_element.html($('<p/>',{html:"<?=t("disk_raid_recover_broken_internal_message")?>."}) );

					// Creating the dropdown of all available external disks
					var select = $('<select/>', {id: 'external'});
					for(i=0;i<data.disks.length;++i) {
						select.append(
							$("<option />", { 
								value: data.disks[i], 
								html: data.disks[i] 
							})
						);
					}
					dialog_element.append( select );		


					// Updating the buttons in the dialog
					dialog_element.dialog(
						'option','buttons', {
							"<?=t('disk_raid_recover_broken_internal_button_label')?>": function() {
								// Callback when choosing to create RAID
								var external_device = select.val();

								// The warning that now we are going to destroy any data on external disk
								dialog_element.html($("<h2/>",{'class':"ui-warning-highlight",html:"<?=t("generic_dialog_text_warning")?>."}) );
								dialog_element
									.append($('<p/>',{html:"<?=t("disk_raid_recover_broken_internal_warning_1")?>"}))
									.append($('<p/>',{html:"<?=t("disk_raid_recover_broken_internal_warning_2")?>"}));

								// Updating the buttons in the dialog
								dialog_element.dialog(
									'option','buttons', {
										"<?=t('disk_raid_recover_broken_internal_button_label')?>": function() {
											// Callback when confirming creation of RAID
											dialog_element.dialog('option', 'title', '<?=t("disk_raid_recover_broken_internal_progress_title")?>');
											dialog_element.dialog('option', 'buttons', {}); // remove buttons
											dialog_element.dialog('option', 'beforeclose', function(){return false;}); // prevent closing of dialog
											dialog_element.html($("<p/>",{html:'<?=t("generic_dialog_text_please_wait")?>'}));

											// calling the actual RAID recovery, point of no return
											$.post('<?=site_url("ajax_disk/recover_raid_broken_internal")?>',{ external: external_device },
												function(data) {
													location.assign("/admin/disk/progress");
												}, 'json' );
										}
									});
							}
						}
					);
				};
			} else {
				// We have no disks to use as RAID array
				dialog_element.html($("<p/>",{html:"<?=t("disk_raid_recover_broken_internal_no_raid_message")?>."}) );
				dialog_element.dialog('option','buttons', {"<?=t('disk_raid_nodisk_label_cancel')?>": function() {dialog_element.dialog('close');}});
			}
		}, 'json' );
	});

	$('#create_md_internal_external_mirror').click(function() {
		var dialog_element = $.dialog("", "<?=t("disk_raid_create_title")?>", {});
		dialog_element.text("<?=t("disk-examine-disks")?>.");

		$.post(	'<?=site_url("ajax_disk/get_external_disks")?>', { removable: !false, raid: false, usb: false }, function(data) {
			dialog_element.empty();
			if( data.internal_got_mounts ) {
				// There exists mounts under /home 
				dialog_element.html($("<p/>",{html:"<?=t("disk_raid_create_error_mounts_exists_message")?>."}) );
				dialog_element.dialog('option','buttons', {"<?=t('button_label_cancel')?>": function() {dialog_element.dialog('close');}});
			} else {
				if(data.disks.length) {
					// we got disks that can be used in RAID array
					dialog_element.html($('<p/>',{html:"<?=t("disk_raid_create_select_disk_message")?>."}) );

					// Creating the dropdown of all available external disks
					var select = $('<select/>', {id: 'external'});
					for(i=0;i<data.disks.length;++i) {
						select.append(
							$("<option />", { 
								value: data.disks[i], 
								html: data.disks[i] 
							})
						);
					}
					dialog_element.append( select );

					// Updating the buttons in the dialog
					dialog_element.dialog(
						'option','buttons', {
							"<?=t('disk_raid_create_button_label')?>": function() {
								// Callback when choosing to create RAID
								external_device = select.val();

								// The warning that now we are going to destroy any data on external disk
								dialog_element.html($("<h2/>",{'class':"ui-warning-highlight",html:"<?=t("generic_dialog_text_warning")?>."}) );
								dialog_element
									.append($('<p/>',{html:"<?=t("disk_raid_create_warning_1")?>"}))
									.append($('<p/>',{html:"<?=t("disk_raid_create_warning_2")?>"}))
									.append($('<p/>',{html:"<?=t("disk_raid_create_warning_3")?>"}));

								// Updating the buttons in the dialog
								dialog_element.dialog(
									'option','buttons', {
										"<?=t('disk_raid_create_button_label')?>": function() {
											// Callback when confirming creation of RAID
											dialog_element.dialog('option', 'title', '<?=t("disk_raid_create_progress_title")?>');
											dialog_element.dialog('option', 'buttons', {}); // remove buttons
											dialog_element.dialog('option', 'beforeclose', function(){return false;}); // prevent closing of dialog
											dialog_element.html($("<p/>",{html:'<?=t("generic_dialog_text_please_wait")?>'}));

											// calling the actual RAID creation, point of no return
											$.post('<?=site_url("ajax_disk/create_raid_internal_lvm_external")?>',{ level: 1, external: external_device },
												function(data) {
													location.assign("/admin/disk/progress");
												}, 'json' );
										}
									});
							}
						}
					);

				} else {
					// We have no disks to use as RAID array
					dialog_element.html($("<p/>",{html:"<?=t("disk_raid_create_error_no_disks_found_message")?>."}) );
					dialog_element.dialog('option','buttons', {"<?=t('disk_raid_nodisk_label_cancel')?>": function() {dialog_element.dialog('close');}});
				}
			}

		}, 'json' )

	});		

});

</script>
