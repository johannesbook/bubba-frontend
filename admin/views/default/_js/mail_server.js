function delete_account() {
	$(this).dialog('close');
	$("#mail-editfac-hidden-delete").val("true");
	$("#fn-mail-retreive-update").submit();
};

$(document).ready(function() {
	$('#useauth').change(function() {
		$('#useunsecure').attr('disabled', ! $(this).is(':checked'));
	});

	var buttons = {};
	buttons[_("Delete account")] = delete_account; // continue button
	buttons[_("Cancel")] = function() { // cancel button
		$(this).dialog('close');
	};

	$("#mail_editfac_delete").click(function() {
		$.confirm(
		_("Delete account for user '") + $("#mail_account_info [name='luser']").val() + _("' on server '") + $("#mail_account_info input[name='server']").val() + "'?", _("Delete mail account"), buttons);
		return false;
	});
});
