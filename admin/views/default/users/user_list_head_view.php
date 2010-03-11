<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/user.js" type="text/javascript"></script>
<script type="text/javascript">
user_accounts=<?=json_encode($accounts)?>;
is_priviledged_user=<?=json_encode($show_allusers)?>;
allowed_to_delete=<?=json_encode($allow_delete)?>;
</script>
