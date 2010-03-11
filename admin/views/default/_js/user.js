$(document).ready(function(){
		if( ! is_priviledged_user ) {
			var source_edit_dialog = $("#fn-users-list-edit");
			source_edit_dialog.appendTo(source_edit_dialog.parent().parent());
			source_edit_dialog.find('input[name=input_username]').attr('disabled','disabled');
			source_edit_dialog.find('input[name=realname]').addClass('fn-primary-field');
			source_edit_dialog.find('input[name=sideboard], input[name=remote], input[name=shell]').closest('tr').remove();

			var account = user_accounts[0];
			$('input[name=username]',source_edit_dialog).val(account.username);
			$('input[name=realname]',source_edit_dialog).val(account.realname);
			var update_button = $('<button/>', {html: $.message("users-edit-single-button-label")}).appendTo(source_edit_dialog);
			update_button.click(function(){	
					$.post( config.prefix + "/users/edit_user_account/json", $('form', source_edit_dialog).serialize(), function(data){
							if( data.error ) {
								update_status( false, data.html );
							} else {
								window.location.reload();
							}
						}, 'json' 
					);
				});
			return;
		}
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
										click: $.proxy(function() {
												$("h2.fn-dialog-header", dialog).html($.message("users-list-edit-dialog-header", data.server));
												$("form",this).trigger("reset");
												$('input[name=username],input[name=input_username]', this).val(data.username);
												$('input[name=realname]', this).val(data.realname);
												$('input[name=password1]', this).val("");
												$('input[name=password2]', this).val(""); disabled="disabled"

												if( data['allow:enable_shell'] ) {
													$('input[name=shell]', this).val(data.shell || false).closest('tr').show();
												} else {
													$('input[name=shell]', this).val(false).closest('tr').hide();
												}
												$('input[name=realname]', this).attr('disabled', !data['allow:enable_rename']);

												if( data['allow:disable_remote'] ) {
													$('input[name=remote]', this).val(data.remote || false).closest('tr').show();
												} else {
													$('input[name=remote]', this).val(true).closest('tr').hide();
												}												

												if( data.username == 'admin' ) { // TODO MOVE THIS AWAY FROM HERE!!!
													$('input[name=sideboard]', this).val(data.sideboard || false).closest('tr').show();
												} else {
													$('input[name=sideboard]', this).val(false).closest('tr').hide();
												}
												this.dialog("open");
											},
											dialog
										)
									}
								)
							}
						)
					);

				}
			);			
		}
		var options = { 
			"autoOpen": false,
			"width": 400,
			"open": function(event,ui) {
				$(".fn-primary-field", this).focus();
			}
		};
		var source_edit_dialog = $("#fn-users-list-edit");
		var add_dialog, edit_dialog;
		var add_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		add_source_edit_dialog.find('input[name=sideboard], input[name=remote]').closest('tr').remove();
		add_source_edit_dialog.find('input[name=input_username]').addClass('fn-primary-field');
		add_dialog  = $.dialog(
			add_source_edit_dialog,
			'',
			[
				{
					'label': $.message("users-list-add-dialog-button-label"),
					'callback': function(){
						$('input[name=username]',this).val($('input[name=input_username]',this).val());
						$.post( config.prefix + "/users/add_user_account/json", $('form', this).serialize(), function(data){
								if( data.error ) {
									update_status( false, data.html );
								} else {
									update_status( true, $.message("users-list-add-success-message") );
									$.post(
										config.prefix + "/users/index/json",
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
					},
					options: { id: 'fn-users-add-dialog-button' }
				}	
			],
			options	
		);		
		var edit_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		edit_source_edit_dialog.find('input[name=input_username]').attr('disabled','disabled');
		edit_source_edit_dialog.find('input[name=realname]').addClass('fn-primary-field');

		edit_dialog_buttons = [
			{
				'label': $.message("users-list-edit-dialog-button-label"),
				'callback': function(){	
					$('input[name=username]',this).val($('input[name=input_username]',this).val());

					$.post( config.prefix + "/users/edit_user_account/json", $('form', this).serialize(), function(data){
							if( data.error ) {
								update_status( false, data.html );
							} else {
								update_status( true, $.message("users-list-edit-success-message") );
								$.post( 
									config.prefix + "/users/index/json", 
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
				},
				options: { id: 'fn-users-edit-dialog-button' }
			}
		];
		if( allowed_to_delete ) {
			edit_dialog_buttons.push(
				{
					'label': $.message("users-list-edit-dialog-delete-button-label"),
					'callback': function(){
						edit_dialog.dialog('close');
						var post_data = {
							'username': $('input[name=username]', this).val(),
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
										var confirm_dialog = $(this);
										post_data.userdata = userdata_delete.is(':checked');
										$.post( config.prefix + "/users/delete_user_account/json", post_data, function(data){
												if( data.error ) {
													update_status( false, data.html );
												} else {
													update_status( true, $.message("users-list-delete-success-message") );
													$.post( 
														config.prefix + "/users/index/json", 
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

									},
									options: { id: 'fn-users-edit-dialog-delete-confirm-button' }
								}
							]
						);
					},
					options: { id: 'fn-users-edit-dialog-delete-button' }
				}		
			);
		}
		edit_dialog  = $.dialog( 
			edit_source_edit_dialog,
			'',
			edit_dialog_buttons,
			options	
		);
		$("h2.fn-dialog-header", add_dialog).html($.message("users-list-add-dialog-header"));

		update_user_table( edit_dialog, user_accounts );

		$("#fn-users-list-add").click($.proxy(function() {
					$("form",this).trigger("reset");
					this.dialog("open");
				},
				add_dialog
			)
		);
	}
);

