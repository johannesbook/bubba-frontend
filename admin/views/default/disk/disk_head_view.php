<style>



</style>

	<script type="text/javascript">
$(document).ready( function() {

	$('input.format').click(function(e) {
		disk = $(this).attr( 'rel' );
		disk_model = $(this).attr( 'name' );
		dialog_element = $.dialog("", "<?=t("disk_format_title")?>", {});
		$.post(	'<?=site_url("ajax_disk/disk_got_mounts")?>', { disk: disk }, function(data) {

			if( data.disk_got_mounts ) {
				// The disk is mounted
				dialog_element.html($("<p/>",{html:"<?=t("disk_format_error_mounts_exists_message")?>."}) );
				dialog_element.dialog('option','buttons', {"<?=t('button_label_cancel')?>": function() {dialog_element.dialog('close');}});
			} else {
				dialog_element.html($('<p/>',{html:"<?=t("disk_format_message")?>."}) );

				// the input for label
				input_label = $('<label />',{for: 'label', html: '<?=t("disk_format_label_label")?>'});
				input = $('<input />',{id: 'label_input', name: 'label', type: 'text', value: disk_model});
				dialog_element.append($('<div/>').append(input_label).append(input));

				dialog_element.dialog(
					'option','buttons', {
						"<?=t('disk_format_format_button_label')?>": function() {
							// Callback when choosing to create RAID

							// The warning that now we are going to destroy any data on external disk
							dialog_element.html($("<h2/>",{class:"ui-warning-highlight",html:"<?=t("generic_dialog_text_warning")?>."}) );
							dialog_element
								.append($('<p/>',{html:"<?=t("disk_format_warning_1")?>"}))
								.append($('<p/>',{html:"<?=t("disk_format_warning_2")?>"}));

							// Updating the buttons in the dialog
							dialog_element.dialog(
								'option','buttons', {
									"<?=t('disk_format_format_button_label')?>": function() {
										// Callback when confirming creation of RAID
										dialog_element.dialog('option', 'title', '<?=t("disk_format_format_progress_title")?>');
										dialog_element.dialog('option', 'buttons', {}); // remove buttons
										dialog_element.dialog('option', 'beforeclose', function(){return false;}); // prevent closing of dialog
										dialog_element.html($("<p/>",{html:'<?=t("generic_dialog_text_please_wait")?>'}));

										// calling the actual RAID creation, point of no return
										$.post('<?=site_url("ajax_disk/format_disk")?>',{ disk: disk, label: input.val() },
											function(data) {
												location.assign("/admin/disk/progress");
											}, 'json' );
									},
										"<?=t('button_label_cancel')?>": function() {dialog_element.dialog('close');}
								});
						},
							"<?=t('button_label_cancel')?>": function() {dialog_element.dialog('close');}
					}
				);


			}
		}, 'json');
	});

	$('input.mount').click(function(e) {
		if($(this).hasClass('mounted')) {
			$.post('<?=site_url("ajax_disk/umount_partition")?>', { partition: $(this).attr( 'rel' ) },
				function(data) {
					if(data.error) {
						$(e.target).parent().prev().html( data.html );
						$(e.target).parent().prev().addClass("highlight");
					} else {
						$(e.target).parent().prev().removeClass("highlight");
						$(e.target).parent().prev().text("");
						$(e.target).removeClass('mounted');
						$(e.target).addClass('unmounted');
						$(e.target).val("<?=t("Connect")?>");
					}
				}, 'json' );
		} else {
			$.post('<?=site_url("ajax_disk/mount_partition")?>', { partition: $(this).attr( 'rel' ) },
				function(data) {
					if(data.error) {
						$(e.target).parent().prev().html( data.html );
						$(e.target).parent().prev().addClass("highlight");
					} else {
						$(e.target).parent().prev().removeClass("highlight");
						$(e.target).parent().prev().html($('<a />').attr('href',"<?=site_url("filemanager/cd")?>" + data.mount_path).text(data.mount_path));
						$(e.target).removeClass('unmounted');
						$(e.target).addClass('mounted');
						$(e.target).val("<?=t("Disconnect")?>");
					}
				}, 'json' );
		} 
	});
});
</script>
