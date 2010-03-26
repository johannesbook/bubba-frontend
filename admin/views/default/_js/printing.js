
$(document).ready(function(){

		var dialog_options = { 
			"autoOpen": false,
			"width": 400,
			"open": function(event,ui) {
				$(".fn-primary-field", this).focus();
			}
		};
		var source_edit_dialog = $("#fn-printing-list-edit");
		var add_dialog, edit_dialog;
		var edit_validator, add_validator;

		// This function redraw the user table
		var update_user_table = function(dialog, accounts) {
			var table = $("#fn-printing-list tbody");
			table.empty();
			var row = $("<tr/>");
			$.each( accounts, function(key) {
					var data = this;
					/*
					var state = data.state;
					if( state == 'Stopped' ) {
						state = $.message( 'printing-state-stopped' );
					} else if( state == 'Idle' ) {
						state = $.message( 'printing-state-idle' );
					}*/
					row.clone().appendTo(table)
					.append($('<td/>',{text: data.name}))
					.append($('<td/>',{text: data.info}))
					.append($('<td/>',{text: data.location}))
					/*.append($('<td/>',{text: state }))*/
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

		// This callback is fired each time click on "edit" is performed
		var open_edit_dialog_callback = function(data) {
			$("h2.fn-dialog-header", this).html($.message("printing-list-edit-dialog-header", data.server));
			$('form', this).trigger('reset');
			edit_validator.resetForm();
			$('input[name=name],input[name=input_name]', this).val(data.name);
			$('input[name=input_name]', this).hide();
			$('#printing-name', this).text(data.name);
			$('input[name=info]', this).val(data.info);
			$('input[name=location]', this).val(data.location);
			$('input[name=printer]', this).val(data.url);
			this.data('online', data.state != 'Stopped');
			this.dialog("open");
		};


		// the callback when confirming adding
		var add_dialog_button_callback = function(){
			if( ! add_validator.form() ) {
				console.log("invalid");
				return false;
			}
			$('input[name=name]',this).val($('input[name=input_name]',this).val());
			$('input[name=printer]',this).val($('select[name=input_printer]',this).val());
			$.post( config.prefix + "/printing/add_printer/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, $.message("printing-list-add-success-message") );
						$.post(
							config.prefix + "/printing/index/json",
							{},
							function(data) {
								add_dialog.dialog('close');
								update_user_table( edit_dialog, data.installed_printers );
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
			$('input[name=name]',this).val($('input[name=input_name]',this).val());

			$.post( config.prefix + "/printing/edit_printer/json", $('form', this).serialize(), function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, $.message("printing-list-edit-success-message") );
						$.post( 
							config.prefix + "/printing/index/json", 
							{},
							function(data) {
								update_user_table( edit_dialog, data.installed_printers );
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
				'name': $('input[name=name]', this).val()
			};
			$.confirm(
				$.message("printing-list-edit-dialog-delete-message"),
				$.message("printing-list-edit-dialog-delete-header"),
				[
					{
						'label': $.message("printing-list-edit-dialog-delete-button-label"),
						'callback': function(){
							delete_dialog_button_confirm_callback.apply(this, [post_data])
						},
						options: { id: 'fn-printing-edit-dialog-delete-confirm-button' }
					}
				]
			);
		};

		// callback fired when confirming delete
		var delete_dialog_button_confirm_callback = function(post_data){
			var confirm_dialog = $(this);
			$.post( config.prefix + "/printing/delete_printer/json", post_data, function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, $.message("printing-list-delete-success-message") );
						$.post( 
							config.prefix + "/printing/index/json", 
							{},
							function(data) {
								update_user_table( edit_dialog, data.installed_printers );
								confirm_dialog.dialog('close');
							}, 
							'json' 
						);
					}
				}, 'json' 
			);

		};

		// The callback when choosing to initiate deletion
		var open_startstop_dialog_callback = function(){
			edit_dialog.dialog('close');
			var post_data = {
				'name': $('input[name=name]', this).val()
			};
			if( $(this).data('online') ) {
				var header = $.message("printing-list-edit-dialog-stop-message");
				var message = $.message("printing-list-edit-dialog-stop-header");
				var label = $.message("printing-list-edit-dialog-stop-button-label");
				post_data['active'] = false;
			} else {
				var header = $.message("printing-list-edit-dialog-start-message");
				var message = $.message("printing-list-edit-dialog-start-header");
				var label = $.message("printing-list-edit-dialog-start-button-label");
				post_data['active'] = true;
			}
			$.confirm(
				message,
				header,
				[
					{
						'label': label,
						'callback': function(){
							startstop_dialog_button_confirm_callback.apply(this, [post_data])
						},
						options: { id: 'fn-printing-edit-dialog-startstop-confirm-button' }
					}
				]
			);
		};

		// callback fired when confirming delete
		var startstop_dialog_button_confirm_callback = function(post_data){
			var confirm_dialog = $(this);
			$.post( config.prefix + "/printing/startstop_printer/json", post_data, function(data){
					if( data.error ) {
						update_status( false, data.html );
					} else {
						update_status( true, $.message("printing-list-startstop-success-message") );
						$.post( 
							config.prefix + "/printing/index/json", 
							{},
							function(data) {
								update_user_table( edit_dialog, data.installed_printers );
								confirm_dialog.dialog('close');
							}, 
							'json' 
						);
					}
				}, 'json' 
			);

		};

		if( attached_printers.length ) {
			var add_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
			add_source_edit_dialog.find('input[name=input_name]').addClass('fn-primary-field');
			add_source_edit_dialog_printers = add_source_edit_dialog.find('select[name=input_printer]');
			$.each( attached_printers, function() {
					add_source_edit_dialog_printers.append($('<option/>', { value: this.url, html: this.description}));
				});
			add_dialog  = $.dialog(
				add_source_edit_dialog,
				'',
				[
					{
						'label': $.message("printing-list-add-dialog-button-label"),
						'callback': add_dialog_button_callback,
						options: { id: 'fn-printing-add-dialog-button' }
					}	
				],
				dialog_options	
			);		
		} else {
			add_dialog = $.alert( 
				$.message("printing-list-add-dialog-no-printer-message"), 
				$.message("printing-list-add-dialog-no-printer-header"), 
				$.message("button-label-close"), 
				null, 
				$.extend({ close: function(){}},dialog_options)
			);
		}

		var edit_source_edit_dialog = source_edit_dialog.clone().removeAttr('id');
		edit_source_edit_dialog.find('select[name=input_printer]').closest('tr').remove();		
		edit_source_edit_dialog.find('input[name=input_name]').attr('disabled','disabled');
		edit_source_edit_dialog.find('input[name=info]').addClass('fn-primary-field');

		edit_dialog_buttons = [
			{
				'label': $.message("printing-list-edit-dialog-button-label"),
				'callback': edit_dialog_button_update_callback,
				options: { id: 'fn-printing-edit-dialog-button' }
			}
		];

		if( allowed_to_delete ) {
			edit_dialog_buttons.push(
				{
					'label': $.message("printing-list-edit-dialog-delete-button-label"),
					'callback': open_delete_dialog_callback,
					options: { id: 'fn-printing-edit-dialog-delete-button' }
				}		
			);
		}

		if( allowed_to_startstop ) {
			edit_dialog_buttons.push(
				{
					'label': $.message("printing-list-edit-dialog-startstop-button-label"),
					'callback': open_startstop_dialog_callback,
					options: { id: 'fn-printing-edit-dialog-startstop-button' }
				}		
			);
		}		
		edit_dialog  = $.dialog( 
			edit_source_edit_dialog,
			'',
			edit_dialog_buttons,
			dialog_options	
		);
		$.validator.addMethod('valid_printername', function(value, element, params) {
				return /^[a-z,A-Z,\_]+$/.test(value);
			} 
		, jQuery.format("not a valid printer name"));

		edit_validator = $('form',edit_source_edit_dialog).validate({
				rules:{
				}
			}
		);

		add_validator = $('form',add_source_edit_dialog).validate({
				rules:{
					'input_printer': {
						'required': true
					},
					'input_name': {
						'required': true,
						'valid_printername': true,
						'remote': {
							url: config.prefix + "/printing/check_printername/json",
							type: "post"
						}

					}
				},
				messages: {
					'input_name': {
						'remote': jQuery.format("printer name is already in use")
					}
				}
			}
		);
		$("h2.fn-dialog-header", add_dialog).html($.message("printing-list-add-dialog-header"));

		update_user_table( edit_dialog, installed_printers );

		$("#fn-printing-list-add").click($.proxy(function() {
					$('form', this).trigger('reset');
					add_validator.resetForm();
					this.dialog("open");
				},
				add_dialog
			)
		);
	}
);

