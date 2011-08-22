
$(document).ready( function() {
    if(is_running) {
        meter = new $.progress();
        meter.update(initial_progress.progress, initial_progress.status);
        dialog = $.dialog(
            meter.root(),
            title,
            [],
            {
                closeOnEscape: false,
                modal: true,
                draggable: false,
                resizable: false,
                beforeclose: function() {
                    return false;
                },
                close: function() {
                    location.assign("/admin/disk");
                }
            }
        );

        waiting = false;
        is_aborted = false;
        tim = setInterval(
            function() {
                if( waiting || is_aborted ) return;
                waiting = true;
                $.post(config.prefix + '/ajax_disk/query_progress', {},
                    function(data) {
                        if( data.ret.done || is_aborted ) {
                            if( ! is_aborted ) {
                                meter.update(data.ret.progress,data.ret.status);
                            }
                            meter.is_done();
                            clearInterval( tim );
                            dialog.dialog('option', 'beforeclose', function(){return true});
                            dialog.dialog('option', 'buttons', [
                                {
                                    'label': _("Close"),
                                    'callback': function(){$(this).dialog('close')}
                                }
                            ]);
                        } else {
                            meter.update( data.ret.progress, data.ret.status);
                            meter.poke();
                        }
                        waiting = false;
                    }
                , 'json' );
            }, 2000);
    } else {
        location.assign("/admin/disk");
    }
});
