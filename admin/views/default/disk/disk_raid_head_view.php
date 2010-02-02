<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.confirm.js?v='<?=$this->session->userdata('version')?>'"></script>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css?v='<?=$this->session->userdata('version')?>'" />
<style>

span.expansion:hover {
	cursor : pointer;
}	

.raid_text {
	font-size : 1.2em;
}

div#raid_text {
	font-size : 1.2em;
}
div#raid_text input {
	font-size : 1.1em;
	margin-top : 8px;
	margin-right : 15px;
	width : 130px;
}
select {
	width : 100px;
}

table.disks td {
	width: 80px;
	vertical-align : middle;
}

</style>

	<script  type="text/javascript">
$(document).ready( function() {

		$("div#adv_status").css("display","none");

		$(".expansion").click(function() {
			var $thisid = $(this).attr('id');
			$(".expansion").each(function() {
				if($(this).attr('id') == $thisid) {
					if($(this).closest('fieldset').children('div').css('display') == "none") {
						// change '+' sign to '-'
						$(this).children('span').html("-");
					} else {
						// change '-' sign to '+'
						$(this).children('span').html("+");
					}
					$(this).closest('fieldset').children('div').slideToggle(500);
					
				} else {
					// change '-' sign to '+'
					$(this).children('span').html("+");
					$(this).closest('fieldset').children('div').slideUp(500);
				}
				
			});
		});

	$('.remove_raid_disk').click(function(e) {
		$.post(	'<?=site_url("ajax_disk/remove_raid_disk")?>', { disk: $(e.target).attr('rel') }, function(data) {
			if( data.error ) {
				update_status( "fail", data.html );
			} else {
				location.reload();
			}
		});
	});
	$('#recover_md').click(function() {
		form = $('<form />');
		form.append( $('<div />').addClass("header").text("<?=t("Recover RAID array")?>"));
		$.post(	'<?=site_url("ajax_disk/get_raid_disks")?>', {}, function(data) {
			if( data.internal ) {
				if( data.clean_disks.length > 0 ) {
					select = $('<select id="external" />');
					text_box = $('<div />').addClass('text')
					 .html("<?=t("Select external disk to add to array")?><br><br>")
					 .append(select);
					form.append( text_box );

					for(i=0;i<data.clean_disks.length;++i) {
						option = $("<option />");
						option.attr( 'value', data.clean_disks[i] );
						option.text( data.clean_disks[i] );
						select.append( option );
						$("#do_create").removeClass("disabled");
					}

					//form.append( select );
					form.append(
						$('<div class="buttons" />')
						.append(
							$("<input type='button' class='no simplemodal-close' value='<?=t("Cancel")?>' />")
						)
						.append(
							$("<input type='button' id='do_create' class='yes' value='<?=t("Recover array")?>' />").click(function(e) {
								if( $(this).hasClass( 'disabled' ) ) {
									return;
								}
								external_dev = $(this).parent().parent().find("#external option:selected").attr('value');
								$.modal.close();
								$.confirm("<?="<strong><span class='highlight'>" . t("Warning") . "!</span></strong><br>" . t("Recovering the RAID array will destroy any data on the selected extenal disk. Continue?")?>", function() {
									prog = $('<div />');
									prog.append($("<div class='header'><?=t("Recovering RAID array")?></div>"));
									prog.append($("<div class='text'><?=t("Starting recover process, please wait.")?></div>"));
									$.modal(prog);
									$.post('<?=site_url("ajax_disk/recover_raid_broken_external")?>',{ external: external_dev },
										function(data) {
											location.assign("/admin/disk/progress");
										}, 'json' );
								},'<?=t("Recover array")?>','<?=t("Cancel")?>','<?=t("Recover RAID Array")?>');
							})
							)
						);
				} else {
					form.append( $('<div />').addClass("text").text("<?=t("There are no usable external disks attached, please add an external e-SATA disk and try again.")?>" ) );
					text_box = $('<div />').addClass('text');
					form.append( text_box );
					text_box.append(
						$('<div class="buttons" />')
						.append(
							$("<input type='button' class='no simplemodal-close' value='<?=t("Close")?>' />")
						)
					);
				}

			} else if(data.disks.length > 0) {
				if( data.internal_got_mounts ) {
					form.append( $('<div />').addClass("text").text("<?=t("There are disks mounted, please unmount these and try again.")?>" ) );
					text_box = $('<div />').addClass('text');
					form.append( text_box );
					text_box.append(
						$('<div class="buttons" />')
						.append(
							$("<input type='button' class='no simplemodal-close' value='<?=t("Close")?>' />")
						)
					);
				} else {
					form.append( $('<div />').addClass("text").text("<?=t("Select which external disk to recover RAID data from.")?>" ) );
					text_box = $('<div />').addClass('text');
					select = $('<select id="external" />');
					text_box.append( select );
					form.append( text_box );

					text_box.append(
						$('<div class="buttons" />')
						.append(
							$("<input type='button' class='no simplemodal-close' value='<?=t("Cancel")?>' />")
						)
						.append(
							$("<input type='button' id='do_create' class='yes disabled' value='<?=t("Recover internal disk")?>'/>").click(function(e) {
								if( $(this).hasClass( 'disabled' ) ) {
									return;
								}
								external_dev = $(this).parent().parent().find("#external option:selected").attr('value');
								$.modal.close();
								$.confirm("<?=t("Recovering the RAID array will destroy all user data on your internal disk. Continue?")?>", function() {
									prog = $('<div />');
									prog.append($("<div class='header'><?=t("Recovering RAID array")?></div>"));
									prog.append($("<div class='text'><?=t("Starting RAID process, please wait...")?></div>"));
									$.modal(prog);
									$.post('<?=site_url("ajax_disk/recover_raid_broken_internal")?>',{ external: external_dev },
										function(data) {
											location.assign("/admin/disk/progress");
										}, 'json' );
								},'<?=t("Recover array")?>','<?=t("Cancel")?>','<?=t("Recover RAID Array")?>');
							})
							)
						);
					for(i=0;i<data.disks.length;++i) {
						option = $("<option />");
						option.attr( 'value', data.disks[i] );
						option.text( data.disks[i] );
						select.append( option );
						$("#do_create").removeClass("disabled");
					};
				};
			} else {
				form.append(
					$('<div />').addClass('text').append("<?=t("No disks with RAID data found.")?>")
				);
				form.append(
					$('<div class="buttons" />')
					.append(
						$("<input type='button' class='no simplemodal-close' value='<?=t("Close")?>' />")
					)
				);
			}

			$.modal.close();
			$.modal( form );
		}, 'json' );

		$.modal( form );
	});

	$('#create_md_internal_external_mirror').click(function() {
		form = $('<form />');
		form.append( $('<div />').addClass("header").text("<?=t("Create RAID array")?>"));

		$.post(	'<?=site_url("ajax_disk/get_external_disks")?>', { removable: false, raid: false, usb: false }, function(data) {
			if( data.internal_got_mounts ) {
				form.append( $('<div />').addClass("text").text("<?=t("There seems to be disks mounted, please unmount these and try again.")?>" ) );
				text_box = $('<div />').addClass("text");
				form.append( text_box );
				text_box.append(
					$('<div class="buttons" />')
					.append(
						$("<input type='button' class='no simplemodal-close' value='<?=t("Cancel")?>' />")
					)
				);
			} else {
				if(data.disks.length) {
					form.append( $('<div />').addClass("text").text("<?=t("Select which external disk to include in the array. For best usage an external disk with the same size is recommended.")?>" ) );
					text_box = $('<div />').addClass("text");
					select = $('<select id="external" />');
					text_box.append( select );
					form.append( text_box );

					text_box.append(
						$('<div class="buttons" />')
						.append(
							$("<input type='button' class='no simplemodal-close' value='<?=t("Cancel")?>' />")
						)
						.append(
							$("<input type='button' id='do_create' class='yes disabled' value='<?=t("Create")?>' />").click(function(e) {
								if( $(this).hasClass( 'disabled' ) ) {
									return;
								}
								external_dev = $(this).parent().parent().find("#external option:selected").val();
								$.modal.close();
								$.confirm("<strong><span class='highlight'><?=t("Warning")?>!</span></strong><br><?=t("Creating the RAID array will <strong>destroy all content</strong> on your internal disk (/home&nbsp;-&nbsp;including&nbsp;'storage') and erase the selected external disk. <br><br>Please make certain that you have a backup of all files. <br>Continue to create RAID?")?>", function() {
									prog = $('<div />');
									prog.append($("<div class='header'><?=t("Creating RAID array")?></div>"));
									prog.append($("<div class='text'><?=t("Please wait...")?></div>"));
									$.modal(prog);

									$.post('<?=site_url("ajax_disk/create_raid_internal_lvm_external")?>',{ level: 1, external: external_dev },
										function(data) {
											location.assign("/admin/disk/progress");
										}, 'json' );
								},'<?=t("Create RAID")?>','<?=t("Cancel")?>','<?=t("Create RAID Array")?>');
							})
							)
						);
					for(i=0;i<data.disks.length;++i) {
						option = $("<option />");
						option.attr( 'value', data.disks[i] );
						option.text( data.disks[i] );
						select.append( option );
						$("#do_create").removeClass("disabled");
					}
				} else {
					form.append( $('<div />').addClass("text").text("<?=t("No usable disk found.")?>" ));
					text_box = $('<div />').addClass("text");
					form.append( text_box );

					text_box.append(
						$('<div class="buttons" />')
						.append(
							$("<input type='button' class='no simplemodal-close' value='<?=t("Close")?>' />")
						)
					)
				}
			}

			$.modal.close();
			$.modal( form );
		}, 'json' );
		$.modal( form );


	});
});

</script>
