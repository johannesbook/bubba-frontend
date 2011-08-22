
$(document).ready(function(){

		var dialog_options = { 
			"autoOpen": false,
			"width": 400,
			"open": function(event,ui) {
				$(".fn-primary-field", this).focus();
			}
		};
		var source_edit_dialog = $("#fn-album-users-edit");
		var add_dialog, edit_dialog;
		var edit_validator, add_validator;

		// This function redraw the user table
		var update_user_table = function(dialog, accounts) {
			var table = $("#fn-album-users tbody");
			table.empty();
			var row = $("<tr/>");
			$.each( accounts, function(key) {
					var data = this;
					row.clone().appendTo(table)
					.append($('<td/>',{text: data.username}))
					.append(
						$('<td/>',
							{
								html: $('<button/>',
									{ 
										'class' : "submit",
										html: _("Edit"),
										click: function(){open_edit_dialog_callback.apply(dialog, [data])}
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
			$("h2.fn-dialog-header", this).html($.sprintf(_("Edit album viewer"), data.server));
			$('form', this).trigger('reset');
			edit_validator.resetForm();
			$('input[name=username]', this).val(data.username);
			$('input[name=uid]', this).val(data.id);
			$('input[name=password1]', this).val("");
			$('input[name=password2]', this).val("");

			this.dialog("open");
		};


		// the callback when confirming adding
		var add_dialog_button_callback = function(){
			if( ! add_validator.form() ) {
				return false;
			}
			$.post( config.prefix + "/album/add_user_account/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, _("Viewer added") );
						$.post(
							config.prefix + "/album/users/json",
							{},
							function(data) {
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

			$.post( config.prefix + "/album/edit_user_account/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, _("Viewer updated") );
						$.post( 
							config.prefix + "/album/users/json", 
							{},
							function(data) {
								update_user_table( edit_dialog, data.accounts );
								edit_dialog.dialog('close');
							}, 
							'json' 
						);
					}
				}, 'json' 
			);
		};

		// The callback when choosing to initiate deletion
		var open_delete_dialog_callback = function(){
			edit_dialog.dialog('close');
			var post_data = {
				'uid': $('input[name=uid]', this).val()
			};
			$.confirm(
				_("Delete this photo album viewer?"),
				_("Delete photo album viewer"),
				[
					{
						'label': _("Delete viewer"),
						'callback': function(){
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
			$.post( config.prefix + "/album/delete_user_account/json", post_data, function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, _("Viewer deleted") );
						$.post( 
							config.prefix + "/album/users/json", 
							{},
							function(data) {
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
		add_source_edit_dialog.find('input[name=username]').addClass('fn-primary-field');
		add_dialog  = $.dialog(
			add_source_edit_dialog,
			'',
			[
				{
					'label': _("Add new viewer"),
					'callback': add_dialog_button_callback,
					options: { id: 'fn-users-add-dialog-button' }
				}	
			],
			dialog_options	
		);		

		var edit_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		edit_source_edit_dialog.find('input[name=password1]').addClass('fn-primary-field');

		edit_dialog_buttons = [
			{
				'label': _("Update viewer"),
				'callback': edit_dialog_button_update_callback,
				options: { id: 'fn-users-edit-dialog-button' }
			}
		];

		if( allowed_to_delete ) {
			edit_dialog_buttons.push(
				{
					'label': _("Delete viewer"),
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
					'username': {
						'required': true,
						'maxlength': 32,
						'minlength': 2,
						'remote': {
							url: config.prefix + "/album/check_username/json",
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
					'username': {
						'remote': jQuery.format("username is already in use")
					}
				}
			}
		);
		$("h2.fn-dialog-header", add_dialog).html(_("Add new viewer to the photo album"));

		update_user_table( edit_dialog, user_accounts );

		$("#fn-album-users-add").click($.proxy(function() {
					$('form', this).trigger('reset');
					add_validator.resetForm();
					this.dialog("open");
				},
				add_dialog
			)
		);
	}
);

