<script type="text/javascript">

function delete_account() { 
	$(this).dialog('close');
	$("#mail-editfac-hidden-delete").val("true");
	$("#fn-mail-retreive-update").submit();
};

$(document).ready(function(){
	$('#useauth').change(function(){
		$('#useunsecure').attr( 'disabled', ! $(this).is(':checked') );
	});

	var buttons = {};
	buttons[$.message("mail-dialog-button-delete")] =  delete_account; // continue button
	buttons[$.message("button-label-cancel")] =  function() { // cancel button
						$(this).dialog('close');
					};


	$("#mail_editfac_delete").click(function() {
		$.confirm( 
				$.message("mail-dialog-delete-foruser")
				 + $("#mail_account_info [name='luser']").val()
				 + $.message("mail-dialog-delete-onserver")
				 + $("#mail_account_info input[name='server']").val() + "'?",
				$.message("mail-dialog-delete-title"),
				buttons
		);
		return false;
	});
});
</script>
