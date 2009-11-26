<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.confirm.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js"></script>

<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css" />
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
/*	$('td.partition').click( function() {
	$.post(
			'<?=site_url("ajax_disk/partition_get_info")?>',
			{ partition: $(this).attr( 'rel' ) },
			function(data) {
				form = $('<form />');
				infotable = $('<table />');
				form.append( infotable );
				switch( data.data.usage ) {
				case 'pv':
					if( data.vgdata ) {
						current_lv =  data.vgdata.name + "-" + data.vgdata.lvs[0].name;
						infotable.append(
							$('<tr />')
							.append(
								$('<th />').text('<?=t("Name")?>: ')
							)
							.append(
								$('<td />').text( current_lv )
							)
						);
						pvs =  data.vgdata.pvs;
						pvs_names = [];
						for(i=0;i<pvs.length;++i) {
							pvs_names.push( pvs[i].dev );
						}

						infotable.append(
							$('<tr />')
							.append(
								$('<th />').text('<?=t("Physical devices")?>: ')
							)
							.append(
								$('<td />').text( pvs_names.join(', ') )
							)
						);
					}
					break;
				default:
					infotable.append(
						$('<tr />')
						.append(
							$('<th />').text('<?=t("Label")?>: ')
						)
						.append(
							$('<td />').text( data.data.label )
						)
					);
					infotable.append(
						$('<tr />')
						.append(
							$('<th />').text('<?=t("UUID")?>: ')
						)
						.append(
							$('<td />').text( data.data.uuid )
						)
					);

				}

				form.append(
					$('<div class="buttons" />')
					.append(
						$("<div class='no simplemodal-close'>Close</div>")
					)
				);


				$.modal( form );
			}, 'json' 
			)
	});
 */
	$('input.format').click(function(e) {
		disk = $(this).attr( 'rel' );
		disk_model = $(this).attr( 'name' );
		form = $('<form />');
		form.append( $('<div />').addClass("header").text("<?=t("Format disk")?>"));
		$.post(	'<?=site_url("ajax_disk/disk_got_mounts")?>', { disk: disk }, function(data) {
			if( data.disk_got_mounts ) {
				form.append( $('<div />').addClass("text").text("<?=t("There seems to be disks mounted, please unmount these and try again.")?>" ) );
				text_box = $('<div />').addClass("text");
				form.append( text_box );
				text_box.append(
					$('<div class="buttons" />')
					.append(
						$("<input type='button' class='no simplemodal-close' value='<?=t("Close")?>' />")
					)
				);
			} else {
				text_box = $('<div />').addClass("text").addClass("div_align_middle");
				input_label = $('<label />').attr({'for': 'label'}).text('<?=t("Disk label")?>:');
				//text_box.text("<?=t("Label")?>:");
				input = $('<input />').attr({'id': 'label_input','name': 'label', 'type': 'text', 'value': 'Bubba Disk'});
				text_box.append( input_label );
				text_box.append( input );
				form.append( text_box );

				form.append(
					$('<div class="buttons" />')
					.append(
						$("<input type='button' class='no simplemodal-close' value='<?=t("Cancel")?>' />")
					)
					.append(
						$("<input type='button' id='do_create' class='yes disabled' value='<?=t("Format")?>' />").click(
							function(e) {
								label = input.val();
								$.modal.close();
								$.confirm(
									"<strong><span class='highlight'><?=t("Warning")?>!</span></strong><br><?=t("Formating disk will destroy all data on disk")?> " + disk + "<?=t(". Continue?")?>",
									function() {
										prog = $('<div />');
										prog.append($("<div class='header'><?=t("Formating disk")?></div>"));
										prog.append($("<div class='text'><?=t("Starting format process, please wait...")?></div>"));
										$.modal(prog);
										$.post('<?=site_url("ajax_disk/format_disk")?>',{ disk: disk, label: label }, function( data ) {		
											location.assign("/admin/disk/progress");
										}, 'json');

									}, '<?=t("Format disk")?>','<?=t("Cancel")?>','<?=t("Format disk")?>');		
							}
						)
					)
				);
			}
		}, 'json');
		$.modal( form );

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
