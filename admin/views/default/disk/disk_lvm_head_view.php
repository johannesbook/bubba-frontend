<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>
<script  type="text/javascript">
$(document).ready( function() {
	$("#extend").click(function() {
		var lv = $("select#logical_volume").val();
		var disk = $("select#disk").val();
		if( ! disk || ! lv ) {
			return;
		}
		$.confirm( 
			"<?=_("<p>This will erase all the data on the new, external device. Click 'Create LVM' to continue.</p> <p>Note: Removal of the new disk from the system will require a full system reinstallation.</p>")?>",
			"<?=_("Extend Logical Volume")?>", {

				"<?=_("Create LVM")?>": function() {
					$(this).dialog('option', 'title', '<?=_("Extending disk")?>');
					$(this).dialog('option', 'buttons', {}); // remove buttons
					$(this).dialog('option', 'beforeclose', function(){return false;}); // prevent closing of dialog
					$(this).html('<?=_("Please wait...")?>');
					$.post('<?=site_url("ajax_disk/add_to_lvm")?>',{ disk: disk, group: lv },
						function(data) {
							location.assign("/admin/disk/progress");
						}, 'json' );					
				}
			}
		);
	});
});
</script>
