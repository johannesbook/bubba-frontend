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

    $("#mail_editfac_delete").click(
        function() {
            $.confirm(
                $.sprintf(_("Delete account for user <strong>%s</strong> on server <strong>%s</strong>?"),
                $("#mail_account_info [name='luser']").val(),
                $("#mail_account_info input[name='server']").val()
                ),
            pgettext("confirmation button","Delete mail account"),
            buttons
        );
        return false;
    });
});
