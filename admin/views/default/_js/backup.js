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
            'position': ['center',200]
        },
        'edit': {
            'width': 600,
            //            'height': 500,
            'minWidth': 600,
            'minHeight': 300,
            'resizable': true,
            'position': ['center',200]
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
        ],
        'edit': [
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
        },
        'edit': function() {
        }
    }

    var update_available_devices = function() {
        $.throbber.show();
        var $select = $('.fn-backup-target-device');
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

    var update_backup_job_information = function(job, runs) {
        var table = $("#fn-backup-job-runs tbody");
        table.empty();
        var row = $("<tr/>");
        $.each(runs, function() {
            var data = $.extend({failed: false, running: false},this);
            var $row = row.clone();
            $row.appendTo(table);
            $row.append($('<td/>',{text: data.date}));
            $row.append($('<td/>').append( $('<button/>', {
                'class' : "submit fn-job-restore",
                html: $.message('backup-job-restore-button-label')
            }).
            attr('disabled', data.failed ? 'disabled' : '').
            toggleClass('disabled', data.failed)));
            $row.data('job',job);
            $row.data('date', data.date);
        });
    }

    var update_backup_jobs_table = function() {
        $.post( config.prefix + "/ajax_backup/get_backup_jobs", {},
            function(jobs) {
                var table = $("#fn-backup-jobs tbody");
                table.empty();
                var row = $("<tr/>", { 'class': 'fn-backup-job-entry'});
                $.each( jobs, function() {
                    var data = $.extend({failed: false, running: false},this);
                    var cur = row.clone();
                    cur.data('job', data.name);
                    cur.appendTo(table);
                    cur.append($('<td/>',{text: data.name}));
                    cur.append($('<td/>',{text: data.target}));
                    cur.append($('<td/>',{text: data.schedule}));
                    cur.append($('<td/>',{text: data.status}).toggleClass("ui-backup-job-failed", data.failed));

                    cur.append($('<td/>').append($("<div/>", {'class': 'ui-inline'}).append(
                        $('<button/>', {
                            'class' : "submit fn-job-remove",
                            html: $.message('backup-job-remove-button-label')
                        }),
                        $('<button/>', {
                            'class' : "submit fn-job-edit",
                            html: $.message('button-label-edit')
                        }),
                        $('<button/>', {
                            'class' : "submit fn-job-run",
                            html: $.message('backup-job-run-now-button-label')
                        }))
                        )
                        );

                    cur.find("button").attr('disabled', data.running ? 'disabled' : '').
                    toggleClass('disabled', data.running)

                }
            );
            },
            "json"
        );
    };

    update_backup_jobs_table();

    $.each(['create', 'edit'], function(index, value) {

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


    var create_buttonpane = dialogs['create'].dialog('widget').children('.ui-dialog-buttonpane');
    var edit_buttonpane = dialogs['edit'].dialog('widget').children('.ui-dialog-buttonpane');

    $("#fn-backup-create").formwizard(
        {
            resetForm: true,
            historyEnabled: !true,
            focusFirstInput: true,
            validationEnabled: true,
            formPluginEnabled: true,
            back: create_buttonpane.find('.ui-prev-button'),
            next: create_buttonpane.find('.ui-next-button'),
            textSubmit: $.message("backup-create-button-finish"),
            showBackOnFirstStep: true,
            afterNext: function(wizardData) {
                switch( wizardData.currentStep ) {
                case "fn-backup-create-form-step-2":
                    $("#fn-backup-create-selection-custom-browse").button('disable')
                    break;
                case "fn-backup-create-form-step-3":
                    $('#fn-backup-create-protocol').change();
                    break;
                case "fn-backup-create-form-step-4":
                    $('.fn-backup-schedule').change();
                    break;
                case "fn-backup-create-form-step-5":
                    $("#fn-backup-create-security-enable").change();
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
            'rules': {
                'name': {
                    'required': true,
                    'remote': {
                        'type': 'POST',
                        'url': config.prefix + "/ajax_backup/validate"
                    }
                },
                'target-device': {
                    'required': function(element) {
                        return $('#fn-backup-create-protocol option:selected').val() == 'file';
                    }
                },
                'target-hostname': {
                    'required': function(element) {
                        return $('#fn-backup-create-protocol option:selected').val() != 'file';
                    }
                },
                'target-username': {
                    'required': function(element) {
                        return $('#fn-backup-create-protocol option:selected').val() != 'file';
                    }
                },
                'target-password': {
                    'required': function(element) {
                        return $('#fn-backup-create-protocol option:selected').val() != 'file';
                    }
                },
                'selection': {
                    'required': true
                },
                'protocol': {
                    'required': true
                },
                'schedule-type': {
                    'required': true
                },
                'security-password': {
                    'required': function(element) {
                        return $('#fn-backup-create-security-enable').is(':checked');
                    }
                },
                'security-password2': {
                    'equalTo': '#fn-backup-create-security-password'
                }

            },
            'messages': {
                'name': {
                    'remote': jQuery.format("{0} is already in use")
                }
            }
        },
        {
            'url': config.prefix + "/ajax_backup/create",
            'type': 'post',
            'dataType': 'json',
            'beforeSubmit': function(arr, $form, options) {
                var $custom = $('#fn-backup-create-selection-custom-selection');
                $.each(
                    $custom.data('selection'),
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
                update_backup_jobs_table();
            }
        }
    );

    $("#fn-backup-edit").formwizard(
        {
            resetForm: !true,
            historyEnabled: !true,
            focusFirstInput: true,
            validationEnabled: true,
            formPluginEnabled: true,
            back: edit_buttonpane.find('.ui-prev-button'),
            next: edit_buttonpane.find('.ui-next-button'),
            textSubmit: $.message("backup-edit-button-finish"),
            showBackOnFirstStep: true,
            afterNext: function(wizardData) {
                switch( wizardData.currentStep ) {
                case "fn-backup-edit-form-step-2":
                    $("#fn-backup-edit-selection-custom-browse").button('disable')
                    break;
                case "fn-backup-edit-form-step-3":
                    $('#fn-backup-edit-protocol').change();
                    break;
                case "fn-backup-edit-form-step-4":
                    $('.fn-backup-schedule').change();
                    break;
                case "fn-backup-edit-form-step-5":
                    $("#fn-backup-edit-security-enable").change();
                    break;
                }
            },
            afterBack: function(wizardData) {
                switch( wizardData.currentStep ) {
                case "fn-backup-edit-form-step-4":
                    $('.fn-backup-schedule').change();
                    break;
                }
            }
        },
        {
            'rules': {
                'target-device': {
                    'required': function(element) {
                        return $('#fn-backup-edit-protocol option:selected').val() == 'file';
                    }
                },
                'target-hostname': {
                    'required': function(element) {
                        return $('#fn-backup-edit-protocol option:selected').val() != 'file';
                    }
                },
                'target-username': {
                    'required': function(element) {
                        return $('#fn-backup-edit-protocol option:selected').val() != 'file';
                    }
                },
                'target-password': {
                    'required': function(element) {
                        return $('#fn-backup-edit-protocol option:selected').val() != 'file';
                    }
                },
                'selection': {
                    'required': true
                },
                'protocol': {
                    'required': true
                },
                'schedule-type': {
                    'required': true
                },
                'security-password': {
                    'required': function(element) {
                        return $('#fn-backup-edit-security-enable').is(':checked');
                    }
                },
                'security-password2': {
                    'equalTo': '#fn-backup-edit-security-password'
                }

            },
            'messages': {
                'name': {
                    'remote': jQuery.format("{0} is already in use")
                }
            }
        },
        {
            'url': config.prefix + "/ajax_backup/edit",
            'type': 'post',
            'dataType': 'json',
            'beforeSubmit': function(arr, $form, options) {
                var $custom = $('#fn-backup-edit-selection-custom-selection');
                $.each(
                    $custom.data('selection'),
                    function() {
                        arr.push({'name': 'dirs[]', 'value': this});
                    }
                );
                console.log(arr);
                //               $.throbber.show();

                return true;
            },
            'reset': !true,
            'success': function( data ) {
                $.throbber.hide();
                dialogs['edit'].dialog('close');
                update_backup_jobs_table();
            }
        }
    );


    $("#fn-backup-job-add").click(function(){
        $("#fn-backup-create").formwizard('reset');

        $('#fn-backup-create-selection-custom-selection').data('selection', []);
        dialogs["create"].dialog("open");
        dialogs['create'].dialog('widget').find('.ui-dialog-buttonpane .ui-prev-button').button('disable');
    });

    $(".fn-job-edit").live('click', function(e){
        $.post(config.prefix + '/ajax_backup/get_job_info', { 'name': $(this).closest('tr').data('job') },
        function(data){
            e.stopPropagation();
            data = $.extend({
                'schedule_type': 'weekly',
                'selection_type': 'custom',
                'target_protocol': 'ftp',
                'target_device': '',
                'target_host': '',
                'target_user': '',
                'target_FTPpasswd': '',
                'schedule_monthday': 1,
                'schedule_monthhour': 1,
                'schedule_weekday': 'Monday',
                'schedule_weekhour': 1,
                'schedule_dayhour': 1,
                'full_expiretime': '1M',
                'files': [],
                'GPG_key': ''

            }, data);
            // XXX retrieve parseable data?
            var name = data.jobname;

            $("#fn-backup-edit").formwizard('reset');
            dialogs["edit"].dialog("open");

            $('#fn-backup-edit-name').val(name);

            $('#fn-backup-edit-selection-'+data['selection_type']).attr('checked', 'checked');
            if(data['selection_type'] == 'custom') {
                $('#fn-backup-edit-selection-custom-browse').removeAttr('disabled');
            }
            $('#fn-backup-edit-selection-custom-selection').data('selection', data.files).html(data.files.join(', '));

            $('#fn-backup-edit-protocol option[value='+data['target_protocol']+']').attr('selected', 'selected');
            $('#fn-backup-edit-target-device').val(data['dist_uuid']);
            $('#fn-backup-edit-target-server-hostname').val(data['target_host']);
            $('#fn-backup-edit-target-server-username').val(data['target_user']);
            $('#fn-backup-edit-target-server-password').val(data['target_FTPpasswd']);
            $('#fn-backup-edit-target-path').val(data['target_path']);

            $('#fn-backup-edit-schedule-'+data['schedule_type']).attr('checked', 'checked');
            $('#fn-backup-edit-schedule-monthday').val(data['schedule_monthday']);
            $('#fn-backup-edit-schedule-monthhour').val(data['schedule_monthhour']);
            $('#fn-backup-edit-schedule-weekday').val(data['schedule_weekday']);
            $('#fn-backup-edit-schedule-weekhour').val(data['schedule_weekhour']);
            $('#fn-backup-edit-schedule-dayhour').val(data['schedule_dayhour']);
            $('#fn-backup-edit-schedule-timeline').val(data['full_expiretime']);

            $('#fn-backup-edit-security-enable').attr('checked', data['GPG_key'] != '' ? 'checked' : '');
            $('#fn-backup-edit-security-password, #fn-backup-edit-security-password2').val(data['GPG_key']);
            dialogs['edit'].dialog('widget').find('.ui-dialog-buttonpane .ui-prev-button').button('disable');
        }, 'json');

        return false;
    });

    $('.fn-job-remove').live('click', function(e) {
        e.stopPropagation();
        job = $(this).closest('tr').data('job');
        $.confirm(
            $.message("backup-job-dialog-remove-message"),
            $.message("backup-job-dialog-remove-header"),
            [
                {
                    'label': $.message("backup-job-dialog-remove-button-label"),
                    'callback': function(){
                        var confirm_dialog = $(this);
                        $.throbber.show();
                        $.post(
                            config.prefix + "/ajax_backup/remove",
                            { 'name': job },
                            function(data){
                                if( data.error ) {
                                    update_status( false, data.html );
                                } else {
                                    update_status(
                                        true,
                                        $.message("backup-job-remove-success-message")
                                    );
                                }
                                $.throbber.hide();
                                update_backup_jobs_table();
                                confirm_dialog.dialog('close');
                            }, 'json'
                        );

                    },
                    options: { id: 'fn-backup-job-dialog-remove-confirm-button' }
                }
            ]
        );
        return false;
    });

    $('.fn-job-run').live('click', function(e) {
        e.stopPropagation();
        job = $(this).closest('tr').data('job');
        $.confirm(
            $.message("backup-job-dialog-run-message"),
            $.message("backup-job-dialog-run-header"),
            [
                {
                    'label': $.message("backup-job-dialog-run-button-label"),
                    'callback': function(){
                        var confirm_dialog = $(this);
                        $.throbber.show();
                        $.post(
                            config.prefix + "/ajax_backup/run",
                            { 'name': job },
                            function(data){
                                if( data.error ) {
                                    update_status( false, data.html );
                                } else {
                                    update_status(
                                        true,
                                        $.message("backup-job-run-success-message")
                                    );
                                }
                                setTimeout(function(){
                                    $.throbber.hide();
                                    update_backup_jobs_table()
                                    confirm_dialog.dialog('close');
                                }, 2000);
                            }, 'json'
                        );

                    },
                    options: { id: 'fn-backup-job-dialog-run-confirm-button' }
                }
            ]
        );
        return false;
    });

    $('.fn-backup-restore-action').live('change', function(e) {
        e.stopPropagation();
		if( $(this).val() == 'newdir' ) {
			$('#fn-backup-restore-target').removeAttr('disabled');
		} else {
			$('#fn-backup-restore-target').attr('disabled', 'disabled');
		}

		return false;
	});

    $('.fn-job-restore').live('click', function(e) {
        e.stopPropagation();
        var job = $(this).closest('tr').data('job');
        var date = $(this).closest('tr').data('date');
		var $obj = $("#fn-backup-restore");
		$obj[0].reset();
		var $filemanager = $obj.find('.fn-restore-filemanager');
		var $validator = $obj.validate({
			'rules': {
				'target': {
					'required': '#fn-backup-restore-action-newdir:checked'
				},
				'selection': {
					'required': true
				}
			}
		});

        $.dialog(
            $obj,
            $.message("backup-dialog-restore-title"),
            [
                {
                    'label': $.message("backup-dialog-restore-label"),
					'callback': function(e) {
						if( !$validator.form() ) {
							$(e.target).closest('button').button('enable');
							return false;
						}

						var selected = $obj.find('.fn-backup-restore-selection').val();
						var action = $obj.find('.fn-backup-restore-action:checked').val();
						var target = $obj.find('.fn-backup-restore-target').val();
						$.post(config.prefix + "/ajax_backup/restore",
							{
								'name': job,
								'date': date,
								'action': action,
								'target': target,
								'selection': selected
							},
							function(data) {
								update_status(true, "done");
								$.throbber.hide();
								$obj.dialog('close');
							}, 'json');
						switch($(this).val()) {
						case 'overwrite':
							break;
						case 'newdir':
							break;
						}
						$.alert(selected.join(" : "));
                        $(this).dialog('close');
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
                'position': ['center',200],
                modal: false,
                autoOpen: true,
                open: function() {

                    $filemanager.filemanager({
                        root: '/home',
                        animate: false,
                        dirPostOpenCallback: function(){},
                        ajaxSource: config.prefix + "/ajax_backup/get_restore_data",
                        ajaxExtraData: {'name': job, 'date': date},
						multiSelect: false,
						mouseDownCallback: function() {
							$obj.find('.fn-backup-restore-selection').val($filemanager.filemanager('getSelected')[0]);
						},
                        columns: [
                            { "sWidth": "0px", "bSortable": false, "aaSorting": [ "asc" ], "sClass": "ui-filemanager-column-type" },
                            { "sWidth": "auto", "aaSorting": [ "asc", "desc" ], "sClass": "ui-filemanager-column-name" },
                            { "sWidth": "200px", "sClass": "ui-filemanager-column-date" },
                            { "sWidth": "30px", "bSortable": false, "sClass": "ui-filemanager-column-next" }
                        ]
                    });


                    return true;
                },
                close: function() {
					$filemanager.filemanager('destroy');
                    return true;
                }
            }
        );

        return false;
    });

    $('.fn-backup-job-entry').live('click', function(){
        var name = $(this).data('job');
        $.post(
            config.prefix + "/ajax_backup/get_backup_job_information",
            {'name': name},
            function(data) {
                update_backup_job_information(name, data);
            },
            "json"
        );

    });

    $.each(['create', 'edit'], function(key,value){


        $('#fn-backup-'+value+'-selection-custom-browse').click(function(){
            $.dialog(
                filemanager.clone(),
                "Directory selector",
                [
                    {
                        'label': $.message("Select choosen directory"),
                        'callback': function() {
                            $(this).dialog('close');
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
                    'position': ['center',200],
                    modal: false,
                    autoOpen: true,
                    open: function() {

                        $(this).filemanager({
                            root: '/',
                            animate: false,
                            dirPostOpenCallback: function(){},
                            ajaxSource: config.prefix + "/ajax_backup/dirs"
                        });


                        dialogs["create"].dialog('widget').hide();
                        return true;
                    },
                    close: function() {
                        var selected = $(this).filemanager('getSelected');
                        $('#fn-backup-'+value+'-selection-custom-selection').text(selected.join(', ')).data('selection', selected);
                        dialogs["create"].dialog('widget').show();
                        return true;
                    }
                }
            );
        });
        // Custom browse for selection button
        $('#fn-backup-'+value+'-selection-custom-browse').button({'disabled': true});

        $('#fn-backup-'+value+' .fn-backup-selection').change(function(){
            if( $(this).is('#fn-backup-'+value+'-selection-custom') ) {
                $('#fn-backup-'+value+'-selection-custom-browse').button('enable');
            } else {
                $('#fn-backup-'+value+'-selection-custom-browse').button('disable')
            }
        });

        $('#fn-backup-'+value+' .fn-backup-schedule').change(function(){
            var self = $('#fn-backup-'+value+' .fn-backup-schedule:checked');
            var $timeline = $('#fn-backup-'+value+'-schedule-timeline');
            var val = $('#fn-backup-'+value+'-schedule-timeline option:selected').val();
            $timeline.find('option').removeAttr('disabled');
            switch(self.attr('id')) {
            case 'fn-backup-'+value+'-schedule-hourly':
            case 'fn-backup-'+value+'-schedule-daily':
                break;
            case 'fn-backup-'+value+'-schedule-weekly':
                $timeline.find('option[value=1D]').attr('disabled', 'disabled');
                if( val == '1D' ) {
                    $timeline.val('1W');
                }
                break;
            case 'fn-backup-'+value+'-schedule-monthly':
                $timeline.find('option[value=1D]').attr('disabled', 'disabled');
                $timeline.find('option[value=1W]').attr('disabled', 'disabled');
                if( val == '1D' || val == '1W' ) {
                    $timeline.val('1M');
                }
                break;
            case 'fn-backup-'+value+'-schedule-disabled':
                $timeline.find('option').attr('disabled', 'disabled');
                break;
            }

            if( self.is('#fn-backup-'+value+'-schedule-monthly') ) {
                $('#fn-backup-'+value+'-schedule-monthday, #fn-backup-'+value+'-schedule-monthhour').removeAttr('disabled');
            } else {
                $('#fn-backup-'+value+'-schedule-monthday, #fn-backup-'+value+'-schedule-monthhour').attr('disabled', 'disabled');
            }

            if( self.is('#fn-backup-'+value+'-schedule-weekly') ) {
                $('#fn-backup-'+value+'-schedule-weekday, #fn-backup-'+value+'-schedule-weekhour').removeAttr('disabled');
            } else {
                $('#fn-backup-'+value+'-schedule-weekday, #fn-backup-'+value+'-schedule-weekhour').attr('disabled', 'disabled');
            }

            if( self.is('#fn-backup-'+value+'-schedule-daily') ) {
                $('#fn-backup-'+value+'-schedule-dayhour').removeAttr('disabled');
            } else {
                $('#fn-backup-'+value+'-schedule-dayhour').attr('disabled', 'disabled');
            }

        });

        $('#fn-backup-'+value+'-security-enable').change(function(){
            if($(this).is(':checked')) {
                $('#fn-backup-'+value+'-security-password, #fn-backup-'+value+'-security-password2').removeAttr('disabled');
            } else {
                $('#fn-backup-'+value+'-security-password, #fn-backup-'+value+'-security-password2').attr('disabled', 'disabled');
            }
        });

        $('#fn-backup-'+value+'-protocol').change(function(){
            switch( $(this).val() ) {
            case 'ftp':
            case 'ssh':
                $('#fn-backup-'+value+'-target-server-hostname').removeAttr('disabled').closest('tr').show()
                $('#fn-backup-'+value+'-target-server-username').removeAttr('disabled').closest('tr').show()
                $('#fn-backup-'+value+'-target-server-password').removeAttr('disabled').closest('tr').show()
                $('#fn-backup-'+value+'-target-device').attr('disabled', 'disabled').closest('tr').hide()
                break;
            case 'file':
                $('#fn-backup-'+value+'-target-server-hostname').attr('disabled', 'disabled').closest('tr').hide()
                $('#fn-backup-'+value+'-target-server-username').attr('disabled', 'disabled').closest('tr').hide()
                $('#fn-backup-'+value+'-target-server-password').attr('disabled', 'disabled').closest('tr').hide()
                $('#fn-backup-'+value+'-target-device').removeAttr('disabled').closest('tr').show()
                update_available_devices();
                break;
            }
        });
    });

});
