$(document).ready(function(){
		var options = { 
			"autoOpen": false,
			"width": 400,
			"open": function(event,ui) {
				$(".fn-primary-field", this).focus();
			}
		};
		var source_edit_dialog = $("#fn-mail-retrieve-edit");
		var add_dialog, edit_dialog;
		var edit_validator, add_validator;

		var open_edit_dialog_callback = function(data) {
			$("h2.fn-dialog-header", this).html($.sprintf(_("Edit email account information for host <em>%s</em>"), data.server));
			$("form",this).trigger("reset");
			edit_validator.resetForm();
			$('input[name=server]', this).val(data.server);
			$('input[name=old_server]', this).val(data.server);
			$('select[name=protocol] option[value='+data.protocol+']', this).attr('selected', 'selected');
			$('input[name=old_protocol]', this).val(data.protocol);
			$('input[name=ruser]', this).val(data.ruser);
			$('input[name=old_ruser]', this).val(data.ruser);
			$('input[name=password]', this).val(data.password);
			if( is_priviledged_user ) {
				$('select[name=luser] option[value='+data.luser+']', this).attr('selected', 'selected');
			}
			$('input[name=old_luser]', this).val(data.luser);
			$('input[name=usessl]', this).attr( 'checked', data.ssl != "");
			$('input[name=keep]', this).attr( 'checked', data.keep != "");
			this.dialog("open");
		}

		var add_dialog_button_callback = function(){
			if( ! add_validator.form() ) {
				return false;
			}
			$.throbber.show();
			$.post( config.prefix + "/mail/add_fetchmail_account/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						update_status( false, data.html );
						$.throbber.hide();
					} else {
						update_status( true, _("Successfully added new email account") );
						$.post(
							config.prefix + "/mail/viewfetchmail/json",
							{},
							function(data) {
								$.throbber.hide();
								add_dialog.dialog('close');
								update_mail_table( edit_dialog, data.accounts );
							},
							'json'
						);
					}
				}, 'json' 
			);
		}

		var edit_dialog_button_update_callback = function(){	
			if( ! edit_validator.form() ) {
				return false;
			}
			$.throbber.show();
			$.post( config.prefix + "/mail/edit_fetchmail_account/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						$.throbber.hide();
						update_status( false, data.html );
					} else {
						update_status( true, _("Email account updated") );
						$.post( 
							config.prefix + "/mail/viewfetchmail/json", 
							{},
							function(data) {
								$.throbber.hide();
								update_mail_table( edit_dialog, data.accounts );
								edit_dialog.dialog('close');
							}, 
							'json' 
						);
					}
				}, 'json' 
			);
		};

		var edit_dialog_delete_dialog_callback = function(post_data){
			var confirm_dialog = $(this);
			$.throbber.show();
			$.post( config.prefix + "/mail/delete_fetchmail_account/json", post_data, function(data){
					if( data.error ) {
						$.throbber.hide();
						update_status( false, data.html );
					} else {
						update_status( true, _("Successfully deleted email account") );
						$.post( 
							config.prefix + "/mail/viewfetchmail/json", 
							{},
							function(data) {
								$.throbber.hide();
								update_mail_table( edit_dialog, data.accounts );
								confirm_dialog.dialog('close');
							}, 
							'json' 
						);
					}
				}, 'json' 
			);

		};

		var edit_dialog_button_delete_callback = function(){
			edit_dialog.dialog('close');
			var post_data = {
				'server': $('input[name=old_server]', this).val(),
				'protocol': $('input[name=old_protocol]', this).val(),
				'ruser': $('input[name=old_ruser]', this).val(),
				'luser': $('input[name=old_luser]', this).val()
			};
			$.confirm(
				"",
				_("Delete email account?"),
				[
					{
						'text': _("Delete"),
						'click': function(){edit_dialog_delete_dialog_callback.apply(this,[post_data])},
						id: 'fn-mail-edit-dialog-delete-confirm-button'
					}
				]
			);
		};

		var update_mail_table = function(dialog, accounts) {
			var table = $("#fn-mail-retrieve tbody");
			table.empty();
			var row = $("<tr/>");
			$.each( accounts, function() {
					var data = this;
					row.clone().appendTo(table)
					.append($('<td/>',{text: data.server}))
					.append($('<td/>',{text: data.protocol}))
					.append($('<td/>',{text: data.ruser}))
					.append($('<td/>',{text: data.luser}))
					.append($('<td/>',{text: data.ssl != "" ? _("Yes") : _("No") }))
					.append($('<td/>',{text: data.keep != "" ? _("Yes") : _("No") }))
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
		var add_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		add_dialog  = $.dialog( 
			add_source_edit_dialog,
			'',
			[
				{
					'text': _("Add email account"),
					'click': add_dialog_button_callback,
					id: 'fn-mail-add-dialog-button'
				}	
			],
			options	
		);		
		var edit_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		edit_dialog  = $.dialog( 
			edit_source_edit_dialog,
			'',
			[
				{
					'text': _("Update"),
					'click': edit_dialog_button_update_callback,
					id: 'fn-mail-edit-dialog-button'
				},
				{
					'text': _("Delete"),
					'click': edit_dialog_button_delete_callback,
					id: 'fn-mail-edit-dialog-delete-button'
				}		
			],
			options	
		);
		add_validator = $('form',add_source_edit_dialog).validate({
				rules:{
					'server': {
						'required': true
					},
					'protocol': {
						'required': true
					},
					'ruser': {
						'required': true
					},
					'password': {
						'required': true
					},
					'luser': {
						'required': is_priviledged_user
					}
				}
			}
		);
		edit_validator = $('form',edit_source_edit_dialog).validate({
				rules:{
					'server': {
						'required': true
					},
					'protocol': {
						'required': true
					},
					'ruser': {
						'required': true
					},
					'password': {
						'required': true
					},
					'luser': {
						'required': is_priviledged_user
					}
				}
			}
		);
		$("h2.fn-dialog-header", add_dialog).html(_("Add new email account"));

		update_mail_table( edit_dialog, mail_accounts );

		$("#fn-retrieve-add").click($.proxy(function() {
					$("form",this).trigger("reset");
					add_validator.resetForm();
					this.dialog("open");
				},
				add_dialog
			)
		);
	}
);

