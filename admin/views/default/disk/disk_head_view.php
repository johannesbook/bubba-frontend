<style>

table.typetable > tbody > tr > td {
	vertical-align : middle;
	padding : 0.5em 0.5em;
}

table.typetable > tbody > tr > th {
	padding : 0.5em 0.5em;
}

table.disks {
	width: 100%;
	margin : 0px;
}

table.disks > tbody > tr > td {
	vertical-align : middle;
	padding : 0em 0.2em;
}

table.disks > tbody > tr > th {
	padding : 0.5em 0.2em;
}

table.disks > tbody > tr > td.partitions {
	padding: 2px;
	width: 350px;
	height: 100%;
}
th.col1 {
	width : 100px;
}
th.path {
	width : 250px;
}

div.mount {
	float: right !important;
}
table.partitions {
	font-size: 1em;
	width: 100%;
	padding: 0px;
	margin: 0px;
	/*	float: right;*/
}
table.partitions > tbody > tr > td {
	padding: 0px;
}

.partition {
	padding: 0;
	vertical-align: middle;
	/*	background: olive; */
	text-align: center;
	/*	cursor: pointer;*/
	/*	color: #122297; */
	color: #000;
	font-size: 0.8em;
	font-weight: bold;
	font-family: sans-serif;
	text-decoration: none;
	height : 25px;
}
td.colorcode {
	text-align : center;
}
div.colorcode {
	width : 15px;
	height : 15px;
}

/*
 * perl -MGraphics::ColorObject -e 'foreach(0..21) { printf "td.partition-%d { background-color: #%s }\n", $_, Graphics::ColorObject->new_HSL([67+$_*73, .6, .6 ])->as_RGBhex() }'
 */
.partition-0 { background-color: #C8D65C }
.partition-1 { background-color: #5CD685 }
.partition-2 { background-color: #5C93D6 }
.partition-3 { background-color: #BA5CD6 }
.partition-4 { background-color: #D65C5E }
.partition-5 { background-color: #BED65C }
.partition-6 { background-color: #5CD68F }
.partition-7 { background-color: #5C89D6 }
.partition-8 { background-color: #A9D65C }
.partition-9 { background-color: #5CD6A3 }
.partition-10 { background-color: #5C74D6 }
.partition-11 { background-color: #D65CD4 }
.partition-12 { background-color: #D6785C }
.partition-13 { background-color: #9FD65C }
.partition-14 { background-color: #5CD6AD }
.partition-15 { background-color: #C45CD6 }
.partition-16 { background-color: #D6645C }
.partition-17 { background-color: #B4D65C }
.partition-18 { background-color: #5CD699 }
.partition-19 { background-color: #5C7ED6 }
.partition-20 { background-color: #CE5CD6 }
.partition-21 { background-color: #D66E5C }

.partition-e { background-color: #E62323 }
.partition-system { background-color: #5C5C5C }

div.text input {
	vertical-align : middle;
}
div.text label {
	margin-right : 15px;
}

input.mount {
	width : 75px;
	margin : 0;
}

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
