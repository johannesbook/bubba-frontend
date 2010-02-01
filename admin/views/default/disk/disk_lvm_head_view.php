<style type="text/css">

div#lvm {
	font-size : 1.2em;
}

div#lvm input {
	width : 100px;
	margin-left : 3.2em;
}
div#lvm select {
	margin : 0.3em;
	font-size : 1.2em;
}
div#lvm select.volume {
	width : 150px;
}
div#lvm select.disk {
	width : 90px;
}

</style>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.confirm.js?v='<?=$this->session->userdata('version')?>'"></script>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.confirm.css?v='<?=$this->session->userdata('version')?>'" />
<script  type="text/javascript">
$(document).ready( function() {
	$("#extend").click(function() {
		lv = $("#logical_volume option:selected").attr('value');
		disk = $("#disk option:selected").attr('value');
		$.confirm("<?=t("This will erase all the data on the external device.")?> "+"<?=t("Continue?")?>" +"<br>" + "<?=t("Note: Removal of the new disk from the system will require a full reinstall.")?>",
			function(e) {
				prog = $('<div />');
				prog.append($("<div class='header'><?=t("Extending disk")?></div>"));
				prog.append($("<div class='text'><?=t("Please wait...")?></div>"));
				$.modal(prog);

				$.post('<?=site_url("ajax_disk/add_to_lvm")?>',{ disk: disk, group: lv },
					function(data) {
						location.assign("/admin/disk/progress");
					}, 'json' );
			},"<?=t("Extend partition")?>","<?=t("Cancel")?>","<?=t("Extend defalut data partition")?>");
	});
});
</script>
