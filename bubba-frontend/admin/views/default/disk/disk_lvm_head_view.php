<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>
<script  type="text/javascript">
$(document).ready( function() {
	$("#extend").click(function() {
		lv = $("#logical_volume option:selected").attr('value');
		disk = $("#disk option:selected").attr('value');
		$.confirm( 
			"<?=t("disk_lvm_extend_dialog_warning_message")?>", 
			"<?=t("disk_lvm_extend_dialog_warning_title")?>", {

				"<?=t('disk_lvm_extend_dialog_warning_button_label')?>": function() {
					$(this).dialog('option', 'title', '<?=t("disk_lvm_extend_dialog_title")?>');
					$(this).dialog('option', 'buttons', {}); // remove buttons
					$(this).dialog('option', 'beforeclose', function(){return false;}); // prevent closing of dialog
					$(this).html('<?=t("generic_dialog_text_please_wait")?>');
					$.post('<?=site_url("ajax_disk/add_to_lvm")?>',{ disk: disk, group: lv },
						function(data) {
							location.assign("/admin/disk/progress");
						}, 'json' );					
				},"<?=t('button_label_cancel')?>": function() {
					$(this).dialog('close');
				}
			}
		);
	});
});
</script>
