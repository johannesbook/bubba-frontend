<style>



</style>

	<script type="text/javascript">
$(document).ready( function() {

	$('input.format').click(function(e) {
		var disk = $(this).attr( 'rel' );
		var disk_model = $(this).attr( 'name' );
		var dialog_element = $.dialog("", "<?=_("Format disk")?>", {});
		$.post(	'<?=site_url("ajax_disk/disk_got_mounts")?>', { disk: disk }, function(data) {

			if( data.disk_got_mounts ) {
				// The disk is mounted
				dialog_element.html($("<p/>",{html:"<?=_("There seem to be disks mounted, please unmount these and try again")?>."}) );
				dialog_element.dialog('option','buttons', {"<?=_("Cancel")?>": function() {dialog_element.dialog('close');}});
			} else {
				dialog_element.html($('<p/>',{html:"<?=_("Please specify label for your new partition")?>."}) );

				// the input for label
				input_label = $('<label />',{'for': 'label', html: '<?=_("Label")?>'});
				input = $('<input />',{id: 'label_input', name: 'label', type: 'text', value: disk_model});
				dialog_element.append($('<div/>').append(input_label).append(input));

				dialog_element.dialog(
					'option','buttons', {
						"<?=_("Format disk")?>": function() {
							// Callback when choosing to create RAID

							// The warning that now we are going to destroy any data on external disk
							dialog_element.html($("<h2/>",{'class':"ui-warning-highlight",html:"<?=_("Warning")?>."}) );
							dialog_element
								.append($('<p/>',{html:"<?=_("Formatting disk will destroy all data on disk")?>"}))
								.append($('<p/>',{html:"<?=_("Continue formatting the disk?")?>"}));

							// Updating the buttons in the dialog
							dialog_element.dialog(
								'option','buttons', {
									"<?=_("Format disk")?>": function() {
										// Callback when confirming creation of RAID
										dialog_element.dialog('option', 'title', '<?=_("Formatting disk")?>');
										dialog_element.dialog('option', 'buttons', {}); // remove buttons
										dialog_element.dialog('option', 'beforeclose', function(){return false;}); // prevent closing of dialog
										dialog_element.html($("<p/>",{html:'<?=_("Please wait...")?>'}));

										// calling the actual RAID creation, point of no return
										$.post('<?=site_url("ajax_disk/format_disk")?>',{ disk: disk, label: input.val() },
											function(data) {
												location.assign("/admin/disk/progress");
											}, 'json' );
									},
										"<?=_("Cancel")?>": function() {dialog_element.dialog('close');}
								});
						},
							"<?=_("Cancel")?>": function() {dialog_element.dialog('close');}
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
						$(e.target).val("<?=_("Connect")?>");
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
						$(e.target).val("<?=_("Disconnect")?>");
					}
				}, 'json' );
		} 
	});
});
</script>
