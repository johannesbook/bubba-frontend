
$(document).ready(function(){

		if( ! is_priviledged_user ) {
			var source_edit_dialog = $("#fn-users-list-edit");
			var edit_validator;
			source_edit_dialog.appendTo(source_edit_dialog.parent().parent());
			source_edit_dialog.find('input[name=input_username]').closest('td').empty().append($("<span/>", {'id': 'input_username'}));
			source_edit_dialog.find('input[name=realname]').addClass('fn-primary-field');
			source_edit_dialog.find('input[name=sideboard], input[name=remote], input[name=shell]').closest('tr').remove();


			var account = user_accounts[0];
			$('input[name=username]',source_edit_dialog).val(account.username);
			$('#input_username',source_edit_dialog).html(account.username);
			$('input[name=realname]',source_edit_dialog).val(account.realname);
			$('#option_'+account.user_config.language,source_edit_dialog).attr("selected","selected");
			var update_button = $('<button/>', {'class': 'submit',html: $.message("users-edit-single-button-label")}).appendTo(source_edit_dialog);
			update_button.click(function(){	
					if( ! edit_validator.form() ) {
						return false;
					}
					$.throbber.show();
					$.post( config.prefix + "/users/edit_user_account/json", $('form', source_edit_dialog).serialize()+'&flashdata=on', function(data){
							$.throbber.hide();
							if( data.error ) {
								update_status( false, data.html );
							} else {
								window.location.reload();
							}
						}, 'json' 
					);
				});
			$.validator.addMethod('valid_password', function(value, element, params) {
					return /^\w*$/.test(value);
				} 
				,jQuery.format("not a valid password"));

			edit_validator = $('form',source_edit_dialog).validate({
					rules:{
						'realname': {
							'required': true
						},
						'password1': {
							'valid_password': true
						},
						'password2': {
							'equalTo': $('form input[name=password1]',source_edit_dialog)
						}

					}
				}
			);			
			return;
		}

		var dialog_options = { 
			"autoOpen": false,
			"width": 400,
			"open": function(event,ui) {
				$(".fn-primary-field", this).focus();
			}
		};
		var source_edit_dialog = $("#fn-users-list-edit");
		var add_dialog, edit_dialog;
		var edit_validator, add_validator;

		// This function redraw the user table
		var update_user_table = function(dialog, accounts) {
			var table = $("#fn-users-list tbody");
			table.empty();
			var row = $("<tr/>");
			$.each( accounts, function(key) {
					var data = this;
					row.clone().appendTo(table)
					.append($('<td/>',{text: data.username}))
					.append($('<td/>',{text: data.realname}))
					.append($('<td/>',{text: $.message( data.shell ? 'text-yes' : 'text-no' )}))
					.append(
						$('<td/>',
							{
								html: $('<button/>',
									{ 
										html: $.message('button-label-edit'),
										click: function(){open_edit_dialog_callback.apply(dialog, [data])},
										'class': "submit"
									}
								)
							}
						)
					);

				}
			);			
		}

		// This callback is fired each time click on "edit" is performed
		var open_edit_dialog_callback = function(data) {
			$("h2.fn-dialog-header", this).html($.message("users-list-edit-dialog-header", data.server));
			$('form', this).trigger('reset');
			edit_validator.resetForm();
			$('input[name=username],input[name=input_username]', this).val(data.username);
			$('input[name=input_username]', this).hide();
			$('#fn-user-username-text', this).text(data.username);
			$('input[name=realname]', this).val(data.realname);
			$('input[name=password1]', this).val("");
			$('input[name=password2]', this).val("");

			if( data['shell_access'] ) {
				$('input[name=shell]', this).attr( 'checked', data.shell || false).closest('tr').show();
			} else {
				$('input[name=shell]', this).attr( 'checked', false).closest('tr').hide();
			}

			if( data['disable_remote'] ) {
				$('input[name=remote]', this).attr( 'checked', data.remote || false).closest('tr').show();
			} else {
				$('input[name=remote]', this).attr( 'checked', true).closest('tr').hide();
			}												

			if( data.username == 'admin' ) { // TODO MOVE THIS AWAY FROM HERE!!!
				$('input[name=sideboard]', this).attr( 'checked', default_sideboard || false).closest('tr').show();
			} else {
				$('input[name=sideboard]', this).attr( 'checked', false).closest('tr').hide();
			}
			if(data.user_config && data.user_config.language) {
				$('#option_'+data.user_config.language,this).attr("selected","selected");
			} else {
				// If this is not set, then prior to language support -> en.
				$('#option_en',this).attr("selected","selected");
			}

			if( data.username == 'admin' ) { // TODO MOVE THIS AWAY FROM HERE!!!
				$('#fn-users-edit-dialog-delete-button').hide();
			} else {
				$('#fn-users-edit-dialog-delete-button').show();
			}			
			this.dialog("open");
		};


		// the callback when confirming adding
		var add_dialog_button_callback = function(){
			if( ! add_validator.form() ) {
				return false;
			}
			$('input[name=username]',this).val($('input[name=input_username]',this).val());
					$.throbber.show();
			$.post( config.prefix + "/users/add_user_account/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						$.throbber.hide();
						update_status( false, data.html );
					} else {
						update_status( true, $.message("users-list-add-success-message") );
						$.post(
							config.prefix + "/users/index/json",
							{},
							function(data) {
								$.throbber.hide();
								add_dialog.dialog('close');
								update_user_table( edit_dialog, data.accounts );
							},
							'json'
						);
					}
				}, 'json' 
			);
		};

		// the callback when confirming update
		var edit_dialog_button_update_callback = function(){	
			if( ! edit_validator.form() ) {
				return false;
			}
			$('input[name=username]',this).val($('input[name=input_username]',this).val());
			default_sideboard = $('input[name=sideboard]', this).attr( 'checked' );

			$.throbber.show();
			$.post( config.prefix + "/users/edit_user_account/json", $('form', this).serialize(), function(data){
					if(data.redraw) {
						window.location.reload();
					} else {
						if( data.error ) {
							$.throbber.hide();
							update_status( false, data.html );
						} else {
							update_status( true, $.message("users-list-edit-success-message") );
							$.post( 
								config.prefix + "/users/index/json", 
								{},
								function(data) {
									$.throbber.hide();
									update_user_table( edit_dialog, data.accounts );
									edit_dialog.dialog('close');
								}, 
								'json' 
							);
						}
					}
				}, 'json' 
			);
		};

		// The callback when choosing to initiate deletion
		var open_delete_dialog_callback = function(){
			edit_dialog.dialog('close');
			var post_data = {
				'username': $('input[name=username]', this).val()
			};
			var body = $('<div/>');
			body.append($('<div/>',{text: $.message("users-list-edit-dialog-delete-message")}));
			var userdata_delete = $('<input/>', { 'type': 'checkbox', 'name': 'userdata'});
			body.append( userdata_delete );
			body.append($('<label/>',{ 'for': 'userdata', text: $.message("users-list-edit-dialog-delete-userdata-label")}));
			$.confirm(
				body,
				$.message("users-list-edit-dialog-delete-header"),
				[
					{
						'label': $.message("users-list-edit-dialog-delete-button-label"),
						'callback': function(){
							if(userdata_delete.is(':checked')) {
								post_data.userdata = 'on';
							}
							delete_dialog_button_confirm_callback.apply(this, [post_data])
						},
						options: { id: 'fn-users-edit-dialog-delete-confirm-button' }
					}
				]
			);
		};

		// callback fired when confirming delete
		var delete_dialog_button_confirm_callback = function(post_data){
			var confirm_dialog = $(this);
			$.throbber.show();
			$.post( config.prefix + "/users/delete_user_account/json", post_data, function(data){
					if( data.error ) {
					$.throbber.hide();
						update_status( false, data.html );
					} else {
						update_status( true, $.message("users-list-delete-success-message") );
						$.post( 
							config.prefix + "/users/index/json", 
							{},
							function(data) {
								$.throbber.hide();
								update_user_table( edit_dialog, data.accounts );
								confirm_dialog.dialog('close');
							}, 
							'json' 
						);
					}
				}, 'json' 
			);

		};

		var add_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		add_source_edit_dialog.find('input[name=sideboard], input[name=remote]').closest('tr').remove();
		add_source_edit_dialog.find('input[name=input_username]').addClass('fn-primary-field');
		add_dialog  = $.dialog(
			add_source_edit_dialog,
			'',
			[
				{
					'label': $.message("users-list-add-dialog-button-label"),
					'callback': add_dialog_button_callback,
					options: { id: 'fn-users-add-dialog-button' }
				}	
			],
			dialog_options	
		);		

		var edit_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		edit_source_edit_dialog.find('input[name=input_username]').attr('disabled','disabled');
		edit_source_edit_dialog.find('input[name=realname]').addClass('fn-primary-field');

		edit_dialog_buttons = [
			{
				'label': $.message("users-list-edit-dialog-button-label"),
				'callback': edit_dialog_button_update_callback,
				options: { id: 'fn-users-edit-dialog-button' }
			}
		];

		if( allowed_to_delete ) {
			edit_dialog_buttons.push(
				{
					'label': $.message("users-list-edit-dialog-delete-button-label"),
					'callback': open_delete_dialog_callback,
					options: { id: 'fn-users-edit-dialog-delete-button' }
				}		
			);
		}

		edit_dialog  = $.dialog( 
			edit_source_edit_dialog,
			'',
			edit_dialog_buttons,
			dialog_options	
		);
		$.validator.addMethod('valid_username', function(value, element, params) {
				return /^[^-][a-z0-9 _-]+$/.test(value) && value != 'web' && value != 'storage';
			} 
			, jQuery.format("not a valid username"));
		$.validator.addMethod('valid_password', function(value, element, params) {
				return /^\w*$/.test(value);
			} 
			,jQuery.format("not a valid password"));

		edit_validator = $('form',edit_source_edit_dialog).validate({
				rules:{
					'realname': {
						'required': true
					},
					'password1': {
						'valid_password': true
					},
					'password2': {
						'equalTo': $('form input[name=password1]',edit_source_edit_dialog)
					}

				}
			}
		);

		add_validator = $('form',add_source_edit_dialog).validate({
				rules:{
					'input_username': {
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
						'minlength': 2,
						'valid_password': true
					},
					'password2': {
						'equalTo': $('form input[name=password1]',add_source_edit_dialog)
					}

				},
				messages: {
					'input_username': {
						'remote': jQuery.format("username {0} is already in use")
					}
				}
			}
		);
		$("h2.fn-dialog-header", add_dialog).html($.message("users-list-add-dialog-header"));

		update_user_table( edit_dialog, user_accounts );

		$("#fn-users-list-add").click($.proxy(function() {
					$('form', this).trigger('reset');
					add_validator.resetForm();
					this.dialog("open");
				},
				add_dialog
			)
		);
	}
);

