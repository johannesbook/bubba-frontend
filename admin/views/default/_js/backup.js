$(function(){
    var dialogs = {};

	var filemanager = $('#fn-filemanager');
    var filemanager_dialog;

    var dialog_options = {
        'create': {
            'width': 600,
//            'height': 500,
            'minWidth': 600,
            'minHeight': 300,
            'resizable': true,
            'position': ['center','center']
        }
    };

    var dialog_buttons = {
        'create': [
            {
                'label': $.message("next"),
                options: {
                    'class': 'ui-next-button ui-element-width-50'
                }
            },
            {
                'label': $.message("back"),
                options: {
                    'class': 'ui-prev-button ui-element-width-50'
                }
            }
        ]
    };

    var dialog_onclose = {
    };

    var dialog_pre_open_callbacks = {
    };

    var dialog_callbacks = {
        'create': function() {
        }
    }

    var update_available_devices = function() {
        $.throbber.show();
        var $select = $('#fn-backup-target-device');
        $select.empty();
        $.post(
            config.prefix + "/ajax_backup/get_available_devices",
            {},
            function(data) {
                $.each(data['disks'], function(label, partitions) {
                    var $group = $('<optgroup/>', {'label': label}).appendTo($select);
                    $.each(partitions, function() {
                        var partition = this;
                        $('<option/>', {'value': partition['uuid'], 'html': partition['label']}).appendTo($group);
                    });

                });
                $.throbber.hide();
            },
            "json"
        );

    }

    var update_backup_job_information = function(runs) {
        var table = $("#fn-backup-job-runs tbody");
        table.empty();
        var row = $("<tr/>");
        $.each(runs, function() {
            var data = $.extend({failed: false, running: false},this);
            row.clone().
            appendTo(table).
            append($('<td/>',{text: data.date})).
            append($('<td/>').append( $('<button/>', {
                'class' : "submit",
                html: $.message('backup-job-restore-button-label'),
                click: function(){}
            }).
            attr('disabled', data.failed ? 'disabled' : '').
            toggleClass('disabled', data.failed)))
        });
    }

    var update_backup_jobs_table = function(jobs) {
        var table = $("#fn-backup-jobs tbody");
        table.empty();
        var row = $("<tr/>");
        $.each( jobs, function() {
            var data = $.extend({failed: false, running: false},this);
            var cur = row.clone();
            cur.appendTo(table).
            append($('<td/>',{text: data.name})).
            append($('<td/>',{text: data.target})).
            append($('<td/>',{text: data.schedule})).
            append($('<td/>',{text: data.status}).toggleClass("ui-backup-job-failed", data.failed)).
            append($('<td/>').append($("<span/>", {'class': 'ui-inline'}).append(
                $('<button/>', {
                    'class' : "submit",
                    html: $.message('backup-job-remove-button-label'),
                    click: function(){}
                }),
                $('<button/>', {
                    'class' : "submit",
                    html: $.message('button-label-edit'),
                    click: function(){}
                }),
                $('<button/>', {
                    'class' : "submit",
                    html: $.message('backup-job-run-now-button-label'),
                    click: function(){}
                }))
                )
                ).
            click(function(){
                $.post(
                    config.prefix + "/ajax_backup/get_backup_job_information",
                    {name: data.name},
                    function(data) {
                        update_backup_job_information(data);
                    },
                    "json"
                );

            });
            cur.find("button").attr('disabled', data.running ? 'disabled' : '').
            toggleClass('disabled', data.running)

        }
    );
    }
    $.post( config.prefix + "/ajax_backup/get_backup_jobs", {},
        function(data) {
            update_backup_jobs_table(data);
        },
        "json"
    );
    $.each(['create'], function(index, value) {

        if (typeof dialog_options[value] == "undefined") {
            dialog_options[value] = {};
        }

        var options = $.extend({},
            dialog_options[value], {
                "autoOpen": false,
                "open": function(event, ui) {
                    var current = $("#fn-backup-" + value + "");
                    current.trigger("reset");
                    if (typeof dialog_pre_open_callbacks[value] != "undefined") {
                        dialog_pre_open_callbacks[value].apply(this, arguments);
                    }
                    $(".fn-primary-field", current).focus();
                }
            }
        );
        if (dialog_buttons[value]) {
            var buttons = dialog_buttons[value];
        } else {
            var buttons = [{
                'label': $.message("backup-" + value + "-dialog-button-label"),
                'callback': function() {
                    dialog_callbacks[value].apply(dialogs[value], arguments)
                },
                options: {
                    id: 'fn-' + value + '-dialog-button',
                    'class': 'ui-element-width-100'
                }
            }];
        }
        if( dialog_onclose[value] ) {
            options['close'] = dialog_onclose[value];
        }
        dialogs[value] = $.dialog(
            $("#fn-backup-" + value + "-dialog"), "", buttons, options
        );

        $("#fn-backup-" + value + "-dialog").submit(function() {
            $(this).closest('.ui-dialog').find('.ui-dialog-buttonpane').children('button.ui-button').button("disable");
            dialog_callbacks[value].apply(dialogs[value]);

            return false;
        });
    });


    var buttonpane = dialogs['create'].dialog('widget').children('.ui-dialog-buttonpane');

    $("#fn-backup-create").formwizard(
        {
            resetForm: true,
            historyEnabled: !true,
            focusFirstInput: true,
            validationEnabled: true,
            formPluginEnabled: true,
            back: buttonpane.find('.ui-prev-button'),
            next: buttonpane.find('.ui-next-button'),
            textSubmit: $.message("backup-create-button-finish"),
            showBackOnFirstStep: true,
			afterNext: function(wizardData) {
				switch( wizardData.currentStep ) {
				case "fn-backup-create-form-step-2":
					$("#fn-backup-selection-custom-browse").button('disable')
					break;
				case "fn-backup-create-form-step-3":
					$('#fn-backup-protocol').change();
					break;
				case "fn-backup-create-form-step-4":
					$('.fn-backup-schedule').change();
					break;
				case "fn-backup-create-form-step-5":
					$("#fn-backup-security-enable").change();
					break;
				}
			},
            afterBack: function(wizardData) {
				switch( wizardData.currentStep ) {
				case "fn-backup-create-form-step-4":
					$('.fn-backup-schedule').change();
					break;
				}
            }
        },
        {
      /*      'rules': {
                'name': {
                    'required': true
                },
                'selection': {
                    'required': true
                },
                'protocol': {
                    'required': true
                }
            }*/
        },
        {
            'url': config.prefix + "/ajax_backup/create",
            'type': 'post',
            'dataType': 'json',
            'beforeSubmit': function(arr, $form, options) {
                $.each(
                    $('#fn-backup-selection-custom-selection').data('selection'),
                    function() {
                        arr.push({'name': 'dirs[]', 'value': this});
                    }
                );
                console.log(arr);
//               $.throbber.show();

                return true;
            },
            'reset': true,
            'success': function( data ) {
                $.throbber.hide();
                dialogs['create'].dialog('close');
            }
        }
    );

    // Custom browse for selection button
    $("#fn-backup-selection-custom-browse").button({'disabled': true});

    $('.fn-backup-selection').change(function(){
        if( $(this).is('#fn-backup-selection-custom') ) {
            $("#fn-backup-selection-custom-browse").button('enable');
        } else {
            $("#fn-backup-selection-custom-browse").button('disable')
        }
    });
    $("#fn-backup-selection-custom-browse").click(function(){
        filemanager.filemanager('reload',function(){
            filemanager_dialog.dialog('open');
        });
    });

    $("#fn-backup-job-add").click(function(){
        $("#fn-backup-create").formwizard('reset');
        dialogs["create"].dialog("open");
        dialogs['create'].dialog('widget').find('.ui-dialog-buttonpane .ui-prev-button').button('disable');
    });

	$('.fn-backup-schedule').change(function(){
		var self = $('.fn-backup-schedule:checked');
        var $timeline = $('#fn-backup-schedule-timeline');
        var val = $('#fn-backup-schedule-timeline option:selected').val();
        $timeline.find('option').removeAttr('disabled');
        switch(self.attr('id')) {
        case 'fn-backup-schedule-hourly':
        case 'fn-backup-schedule-daily':
            break;
        case 'fn-backup-schedule-weekly':
            $timeline.find('option[value=1D]').attr('disabled', 'disabled');
            if( val == '1D' ) {
                $timeline.val('1W');
            }
            break;
        case 'fn-backup-schedule-monthly':
            $timeline.find('option[value=1D]').attr('disabled', 'disabled');
            $timeline.find('option[value=1W]').attr('disabled', 'disabled');
            if( val == '1D' || val == '1W' ) {
                $timeline.val('1M');
            }
            break;
        case 'fn-backup-schedule-disabled':
            $timeline.find('option').attr('disabled', 'disabled');
            break;
        }

        if( self.is('#fn-backup-schedule-monthly') ) {
			$('#fn-backup-schedule-monthday, #fn-backup-schedule-monthhour').removeAttr('disabled');
		} else {
			$('#fn-backup-schedule-monthday, #fn-backup-schedule-monthhour').attr('disabled', 'disabled');
		}

        if( self.is('#fn-backup-schedule-weekly') ) {
			$('#fn-backup-schedule-weekday, #fn-backup-schedule-weekhour').removeAttr('disabled');
		} else {
			$('#fn-backup-schedule-weekday, #fn-backup-schedule-weekhour').attr('disabled', 'disabled');
		}

        if( self.is('#fn-backup-schedule-daily') ) {
			$('#fn-backup-schedule-dayhour').removeAttr('disabled');
		} else {
			$('#fn-backup-schedule-dayhour').attr('disabled', 'disabled');
		}

    });
	$('#fn-backup-security-enable').change(function(){
		if($(this).is(':checked')) {
			$('#fn-backup-security-password, #fn-backup-security-password2').removeAttr('disabled');
		} else {
			$('#fn-backup-security-password, #fn-backup-security-password2').attr('disabled', 'disabled');
		}
	});
    $('#fn-backup-protocol').change(function(){
        switch( $(this).val() ) {
        case 'ftp':
        case 'ssh':
            $('#fn-backup-target-server-hostname').removeAttr('disabled').closest('tr').show()
            $('#fn-backup-target-server-username').removeAttr('disabled').closest('tr').show()
            $('#fn-backup-target-server-password').removeAttr('disabled').closest('tr').show()
            $('#fn-backup-target-device').attr('disabled', 'disabled').closest('tr').hide()
            break;
        case 'file':
            $('#fn-backup-target-server-hostname').attr('disabled', 'disabled').closest('tr').hide()
            $('#fn-backup-target-server-username').attr('disabled', 'disabled').closest('tr').hide()
            $('#fn-backup-target-server-password').attr('disabled', 'disabled').closest('tr').hide()
            $('#fn-backup-target-device').removeAttr('disabled').closest('tr').show()
            update_available_devices();
            break;
        }
	});
    filemanager_dialog = $.dialog(
        filemanager,
        "Directory selector",
        [
            {
                'label': $.message("Select choosen directory"),
				'callback': function() {
					filemanager_dialog.dialog('close');
				},
                options: {
                    'class': 'ui-element-width-100'
                }
            }
        ],
        {
            'width': 600,
            'Height': 400,
            'resizable': false,
            'position': ['center','center'],
            modal: false,
            autoOpen: false,
            open: function() {
				dialogs["create"].dialog('widget').hide();
				return true;
            },
            close: function() {
                var selected = filemanager.filemanager('getSelected');
                $('#fn-backup-selection-custom-selection').text(selected.join(', ')).data('selection', selected);
				dialogs["create"].dialog('widget').show();
				return true;
            }
        }
    );

    filemanager.filemanager({
        root: '/',
        animate: false,
        dirPostOpenCallback: function(){},
        ajaxSource: config.prefix + "/ajax_backup/dirs"
    });

});
