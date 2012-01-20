$.validator.addMethod('valid_username', function(value, element, params) {
    return value.length === 0 || (/^[^\-][a-z0-9 _\-]+$/.test(value) && value != 'web' && value != 'storage' && value != 'root');
},
jQuery.format("not a valid username"));
$.validator.addMethod('valid_password', function(value, element, params) {
    return (/^\w*$/).test(value);
},
jQuery.format("not a valid password"));
$('#fn-wizard-easyfind-name').live('keyup',function(){
    $('#fn-current-easyfind-name').text($(this).val());
}).live('focus', function(){
    if($(this).val() == _("your-easyfind-name")) {
        $(this).val("");
    }
});


function do_run_wizard(){
    butts = [
        {
            'text': _("Next"),
            options: {
                'class': 'ui-next-button ui-element-width-50'
            }
        },
        {
            'text': _("Back"),
            options: {
                'class': 'ui-prev-button ui-element-width-50'
            }
        }
    ];


    wizard_element = $('<div/>');
    wizard_dialog = $.dialog(wizard_element, "", butts, {
        'width': 600,
        'height': 400,
        'resizable': false,
        'position': 'center',
        'close': function(event, ui) {
            $.post(config.prefix + "/wizard/mark_dirty");
        }
    });
    wizard_dialog.dialog('open');
    buttonpane = wizard_dialog.dialog('widget').children('.ui-dialog-buttonpane');
    buttonpane.find('.ui-prev-button').hide();

    wizard_element.load(config.prefix + "/wizard/get_languages", function(){

        buttonpane.find('.ui-next-button').one('click', function(){

            selected_language=$('#fn-wizard-language option:selected').val();
            wizard_element.load(config.prefix + "/wizard/get_wizard", {language: selected_language}, function(){

                // FIXME should be global option, taken from main
                var iCheckbox_options = {
                    switch_container_src: config.prefix+'/views/'+config.theme+'/_img/bubba_switch_container.png',
                    class_container: 'ui-icon-bubba-switch-container',
                    class_switch: 'ui-icon-bubba-switch',
                    switch_speed: 50,
                    switch_swing: -65,
                    checkbox_hide: true,
                    switch_height: 21,
                    switch_width: 127
                };

                wizard_element.find('.slide').iCheckbox( iCheckbox_options );
                wizard_element.find('#fn-wizard-enable-easyfind').change(function(){
                    if($(this).is(':checked')) {
                        $("#fn-wizard-easyfind-name").removeAttr('disabled');
                    } else {
                        $("#fn-wizard-easyfind-name").attr('disabled', 'disabled');
                    }
                });

                wizard_dialog.bind('dialogclose', function(event, ui) {
                    wizard_dialog.remove();
                });

                wizard_element.children("form").formwizard({
                    historyEnabled: !true,
                    validationEnabled: true,
                    formPluginEnabled: true,
                    back: buttonpane.find('.ui-prev-button'),
                    next: buttonpane.find('.ui-next-button'),
                    textSubmit: "Complete",
                    afterNext: function(wizardData) {
                        if( wizardData.currentStep == "fn-wizard-step-5" ) {
                            wizard_element.find('#fn-wizard-enable-easyfind').change();
                        }
                    }
                },
                {
                    rules: {
                        'admin_password1': {
                            'minlength': 2,
                            'valid_password': true
                        },

                        'admin_password2': {
                            'equalTo': wizard_element.find('form input[name=admin_password1]')
                        },
                        'username': {
                            'maxlength': 32,
                            'minlength': 2,
                            'valid_username': true,
                            'remote': {
                                url: config.prefix + "/wizard/username_is_available",
                                type: "post"
                            },
                            'required': function() {
                                return $('#fn-wizard-user-password1').val().length > 0;
                            }
                        },

                        'password1': {
                            'minlength': 2,
                            'valid_password': true,
                            'required': function() {
                                return $('#fn-wizard-user-username').val().length > 0;
                            }

                        },

                        'password2': {
                            'equalTo': wizard_element.find('form input[name=password1]')
                        },

                        'easyfind_name': {
                            'remote': {
                                url: config.prefix + "/wizard/validate_easyfind",
                                type: "post"
                            }
                        }

                    }

                },
                {
                    'url': config.prefix + "/wizard/update",
                    'type': 'post',
                    'dataType': 'json',
                    'reset': false,
                    'success': function( data ) {
                        $.throbber.hide();
                        wizard_dialog.dialog('close');
                        if(data.error) {
                            $.alert(
                                _("Following errors where encountered when trying to apply the changes: ") + data.messages.join(", "),
                                _("Error applying changes"),
                                null,
                                function() {
                                    window.location.reload(true);
                                });
                        } else {
                            $.alert(_("Setup complete. Enjoy!"),null,null,function(){
                                window.location.reload(true);
                            });
                        }
                    },
                    'beforeSubmit': function(arr, $form, options) {
                        arr.push({'name':'language', 'value': selected_language});
                        $.throbber.show();
                        return true;
                    }
                }
            );

        });

    });

});

}
