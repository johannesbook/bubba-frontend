<script type="text/javascript">
$(document).ready(function(){
	add_validator = $('#fn-wizard-add').validate({
		rules:{
			'username': {
				'required': true,
					'maxlength': 32,
					'minlength': 2,
					'valid_username': true,
					'remote': {
						url: config.prefix + "/users/check_username/json",
							type: "post"
					}

			},
				'realname': {
					'required': true
				},
				'password1': {
					'required': true,
						'valid_password': true
				},
				'password2': {
					'equalTo': '#fn-wizard-add input[name=password1]'
				}

		},
			messages: {
				'input_username': {
					'remote': jQuery.format("username {0} is already in use")
				}
			}
		}
	);
	$("#users_wizard_add").click(function() {
			if( ! add_validator.form() ) {
				return false;
			}		
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
