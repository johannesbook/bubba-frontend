$(function(){
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

    var update_backup_jobs_table = function(dialogs, jobs) {
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
            dialogs = [];
            update_backup_jobs_table( dialogs, data);
        },
        "json"
    );
});
