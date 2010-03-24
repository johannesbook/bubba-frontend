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
			$("h2.fn-dialog-header", this).html($.message("mail-retrieve-edit-dialog-header", data.server));
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
			$.post( config.prefix + "/mail/add_fetchmail_account/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, $.message("mail-retrieve-add-success-message") );
						$.post(
							config.prefix + "/mail/viewfetchmail/json",
							{},
							function(data) {
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
			$.post( config.prefix + "/mail/edit_fetchmail_account/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, $.message("mail-retrieve-edit-success-message") );
						$.post( 
							config.prefix + "/mail/viewfetchmail/json", 
							{},
							function(data) {
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
			$.post( config.prefix + "/mail/delete_fetchmail_account/json", post_data, function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, $.message("mail-retrieve-delete-success-message") );
						$.post( 
							config.prefix + "/mail/viewfetchmail/json", 
							{},
							function(data) {
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
				$.message("mail-retrieve-edit-dialog-delete-message"),
				$.message("mail-retrieve-edit-dialog-delete-header"),
				[
					{
						'label': $.message("mail-retrieve-edit-dialog-delete-button-label"),
						'callback': function(){edit_dialog_delete_dialog_callback.apply(this,[post_data])},
						options: { id: 'fn-mail-edit-dialog-delete-confirm-button' }
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
					.append($('<td/>',{text: data.ssl != "" ? $.message('text-yes') : $.message('text-no') }))
					.append($('<td/>',{text: data.keep != "" ? $.message('text-yes') : $.message('text-no') }))
					.append(
						$('<td/>',
							{
								html: $('<button/>',
									{ 
										html: $.message('button-label-edit'),
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
					'label': $.message("mail-retrieve-add-dialog-button-label"),
					'callback': add_dialog_button_callback,
					options: { id: 'fn-mail-add-dialog-button' }
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
					'label': $.message("mail-retrieve-edit-dialog-button-label"),
					'callback': edit_dialog_button_update_callback,
					options: { id: 'fn-mail-edit-dialog-button' }
				},
				{
					'label': $.message("mail-retrieve-edit-dialog-delete-button-label"),
					'callback': edit_dialog_button_delete_callback,
					options: { id: 'fn-mail-edit-dialog-delete-button' }
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
		$("h2.fn-dialog-header", add_dialog).html($.message("mail-retrieve-add-dialog-header"));

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

