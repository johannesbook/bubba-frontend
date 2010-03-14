<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/printing.js" type="text/javascript"></script>
<script type="text/javascript">
installed_printers=<?=json_encode($installed_printers)?>;
attached_printers=<?=json_encode($attached_printers)?>;
allowed_to_delete=<?=json_encode($allow_delete)?>;
allowed_to_startstop=<?=json_encode($allow_startstop)?>;
</script>
