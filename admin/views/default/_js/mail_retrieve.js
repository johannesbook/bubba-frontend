$(document).ready(function(){

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
										click: $.proxy(function() {
												$("h2.fn-dialog-header", dialog).html($.message("mail-retrieve-edit-dialog-header", data.server));
												this.trigger("reset");
												$('input[name=server]', this).val(data.server);
												$('input[name=old_server]', this).val(data.server);
												$('input[name=protocol]', this).val(data.protocol);
												$('input[name=old_protocol]', this).val(data.protocol);
												$('input[name=ruser]', this).val(data.ruser);
												$('input[name=old_ruser]', this).val(data.ruser);
												$('input[name=password]', this).val(data.password);
												$('input[name=luser]', this).val(data.luser);
												$('input[name=old_luser]', this).val(data.luser);
												$('input[name=usessl]', this).val(data.usessl != "");
												$('input[name=keep]', this).val(data.keep != "");
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
		var source_edit_dialog = $("#fn-mail-retrieve-edit");
		var add_dialog, edit_dialog;
		add_dialog  = $.dialog( 
			source_edit_dialog.clone().removeAttr('id'),
			'',
			[
				{
					'label': $.message("mail-retrieve-add-dialog-button-label"),
					'callback': function(){
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
					},
					options: { id: 'fn-mail-add-dialog-button' }
				}	
			],
			options	
		);		
		edit_dialog  = $.dialog( 
			source_edit_dialog.clone().removeAttr('id'),
			'',
			[
				{
					'label': $.message("mail-retrieve-edit-dialog-button-label"),
					'callback': function(){	
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
					},
					options: { id: 'fn-mail-edit-dialog-button' }
				},
				{
					'label': $.message("mail-retrieve-edit-dialog-delete-button-label"),
					'callback': function(){
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
									'callback': function(){
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

									},
									options: { id: 'fn-mail-edit-dialog-delete-confirm-button' }
								}
							]
						);
					},
					options: { id: 'fn-mail-edit-dialog-delete-button' }
				}		
			],
			options	
		);
		$("h2.fn-dialog-header", add_dialog).html($.message("mail-retrieve-add-dialog-header"));

		update_mail_table( edit_dialog, mail_accounts );

		$("#fn-retrieve-add").click($.proxy(function() {
					this.trigger("reset");
					this.dialog("open");
				},
				add_dialog
			)
		);
	}
);

