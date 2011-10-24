function print_versions() {

    $.post("/admin/ajax_settings/get_versions", {}, function(data) {

        $("#package_versions_body").empty();
        jQuery.each(data, function(package_name, package_version) {

            var tr = $("<tr />").addClass("package_row");
            tr.append(
            $("<td>").addClass("packagename").text(package_name));
            tr.append(
            $("<td>").addClass("packageversion").text(package_version));
            $("#package_versions_body").append(tr);
        })
    },
    "json");

}

$(document).ready(function() {

    print_versions();

$("#update").submit(function() {
    action = $('#apt_type').val();
    package = $('#apt_package').val();
    data = {
        action: action
    };
    if (action == 'install') {
        data.package = package;
    }
    meter = new $.progress(100, 0);
    meter.update(0, action == 'install' ? $.sprintf(_("Preparing to install %s"), package) : _("Preparing to update system"));
    $("#updater").remove();
    $("#progress").append(meter.root());
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/admin/ajax_settings/update",
        data: data,
        timeout: 20000,
        success: function(data) {
            waiting = false;
            tim = setInterval(
            function() {
                if (waiting) return;
                waiting = true;
                $.ajax({
                    type: 'POST',
                    url: "/admin/ajax_settings/update",
                    data: {
                        action: 'progress'
                    },
                    timeout: 5000,
                    dataType: 'json',
                    success: function(data) {
                        if (!data) {
                            waiting = false;
                            return;
                        }
                        meter.update(data.progress, data.statusMessage);
                        meter.poke();
                        if (data.done) {
                            meter.update(data.progress, "");
                            meter.is_done();
                            clearInterval(tim);

                            if (!data.logs['ERROR']) {
                                $('#results').append(
                                $('<tr/>').addClass('notification notification-DONE').append(
                                $('<td/>').addClass('notification-type').html($('<img/>', {
                                    src: config.prefix + "/views/" + config.theme + '/_img/upgrade_complete.png'
                                }))).append(
                                $('<td/>').addClass('notification-content').append(
                                $('<div/>').addClass('notification-desc').html(data.statusMessage))));
                                print_versions();
                            }

                            order = ['DONE', 'ERROR', 'WARN', 'NOTE', 'DEBUG'];

                            typemap = {
                                'DONE': pgettext('status marker','Completed'),
                                'ERROR': pgettext('status marker','Error!'),
                                'WARN': pgettext('status marker','Warning'),
                                'NOTE': pgettext('status marker', 'Note'),
                                'DEBUG': pgettext('status marker','Debug)'
                            };
                            iconmap = {
                                'DONE': config.prefix + "/views/" + config.theme + "/_img/upgrade_complete.png",
                                'ERROR': config.prefix + "/views/" + config.theme + "/_img/upgrade_error.png",
                                'WARN': config.prefix + "/views/" + config.theme + "/_img/upgrade_warning.png",
                                'NOTE': config.prefix + "/views/" + config.theme + "/_img/upgrade_note.png",
                                'DEBUG': config.prefix + "/views/" + config.theme + "/_img/upgrade_note.png"
                            };

                            if (data.logs) {
                                for (var i = 0; i < order.length; ++i) {
                                    cur = data.logs[order[i]];
                                    if (!cur) {
                                        continue;
                                    }
                                    for (var j = 0; j < cur.length; ++j) {
                                        td = $('<td/>');
                                        img = $('<img/>').attr({
                                            src: iconmap[order[i]],
                                            alt: typemap[order[i]]
                                        });
                                        $('#results').append(
                                        $('<tr/>').addClass('notification notification-' + order[i]).append(
                                        $('<td/>').addClass('notification-type').append(img)).append(
                                        td.addClass('notification-content').append(
                                        $('<div/>').addClass('notification-desc').html(cur[j].Desc))));
                                        if (cur[j].Data) {
                                            pre = $('<span/>').addClass('').text(cur[j].Data).hide();
                                            img = $('<img/>').attr({
                                                src: config.prefix + "/views/" + config.theme + "/_img/plus16.png",
                                                alt: "toggle"
                                            });
                                            outer = $('<div/>').addClass('notification-data-outer');
                                            inner = $('<div/>');
                                            inner.addClass('notification-data').append($('<div/>').append(pre));
                                            td.children(".notification-desc").prepend(img);
                                            outer.append(inner);
                                            (function(img, pre) {
                                                img.click(function() {
                                                    if (pre.is(':hidden')) {
                                                        img.attr('src', config.prefix + "/views/" + config.theme + "/_img/minus16.png");
                                                    } else {
                                                        img.attr('src', config.prefix + "/views/" + config.theme + "/_img/plus16.png");
                                                    }
                                                    pre.slideToggle();
                                                })
                                            })(img, pre);
                                            td.append(outer);
                                        }
                                    }
                                }
                            }
                        }
                        waiting = false;
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        errHandler = function(secs) {
                            if (secs <= 0) {
                                meter.status(_('Retrying querying...'));
                                waiting = false;
                            } else {
                                meter.notice(_('Was unable to connect to server; This is probably due to temporary shutdown of the webserver during upgrade. Please be patient. Will retry communication in ' + secs + ' seconds...'));
                                window.setTimeout(function() {
                                    errHandler(secs - 1)
                                },
                                1000);
                            }
                        }
                        errHandler(5);
                    }
                });
            },
            500);
        },
        error: function(xhr, textStatus, errorThrown) {
            meter.error($.sprintf(_('Error: %s'), textStatus));
            meter.is_done();
        }
    });
    return false;
});
});
