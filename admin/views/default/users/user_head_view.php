<script type="text/javascript">
$(document).ready(function(){

	$("#users_wizard_add").click(function() {
		$.post(
			config.prefix+"/users/add_user_account/json/",
			$("#fn-wizard-add").serialize(),
			function(data) {
				if(data.error) {
					update_status(0,data.html);
				} else {
					if(data.success) {
						var row = $("<tr/>");
						row.append($('<td/>',{ text:$("#wizard-adduser-username").val() }));	
						row.append($('<td/>',{ text:$("#wizard-adduser-realname").val() }));
						row.appendTo($("#wizard_ulist"));
						$("#fn-wizard-add")[0].reset();
					} else {
						update_status(0,"An unknown error has occured, please press the Bubba icon to return to main page.");
					}
				}
			},
			"json");
		return false;
	});

});
</script>
