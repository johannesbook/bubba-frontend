$(function(){
    var dialogs = {};

    var dialog_options = {
        'create': {
            'width': 600,
            'height': 500,
            'minWidth': 600,
            'minHeight': 400,
            'resizable': true,
            'position': ['center',100]
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
            showBackOnFirstStep: true
        },
        {
            'rules': {
                'name': {
                    'required': true
                },
                'selection': {
                    'required': true
                },
                'protocol': {
                    'required': true
                }
            }
        },
        {
            'url': config.prefix + "/create/json",
            'type': 'post',
            'dataType': 'json',
            'beforeSubmit': function(arr, $form, options) {
                return true;
            },
            'reset': true,
            'success': function( data ) {
                $.throbber.hide();
                dialogs['create'].dialog('close');
            }
        }
    );

    $("#fn-backup-job-add").click(function(){
        $("#fn-backup-create").formwizard('reset');
        dialogs["create"].dialog("open");
        dialogs['create'].dialog('widget').find('.ui-dialog-buttonpane .ui-prev-button').button('disable');
    });
});
