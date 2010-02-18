<script type="text/javascript">
$(document).ready(function(){
	$('#useauth').change(function(){
		$('#useunsecure').attr( 'disabled', ! $(this).is(':checked') );
	});

	$("#mail_del_account").click(function() {
		alert("<?=t("Delete account for user")?> "
		 + $("#mail_account_info [name='luser']").val()
		 + " <?=t("on server")?> "
		 + $("#mail_account_info input[name='server']").val()
		 + " (modal popup)");
		 return false;
	});
});
</script>
