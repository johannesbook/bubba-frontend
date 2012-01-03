// The various functions below define what functionality the
// user should be able to configure when setting up a Tor
// bridge, non-exit relay or exit relay.

// Display a confirmation box when the user hits the update
// button at the bottom of the page

$(function(){
    $("#fn-settings-form").submit(function(){
        $.throbber.show();
    });
    jQuery.validator.addMethod("notInArray", function(value, element, arr) {
        return this.optional(element) || jQuery.inArray(parseInt(value),arr) == -1;
    });
    jQuery.validator.addMethod("alphanum", function(value, element, arr) {
        return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
    },jQuery.format("Please enter only alphanumeric characters [A-Za-z0-9]"));

    var $torvalidator = $("#TorCFG").validate({
        'ignoreTitle': true,
        'rules': {
            'nickname': {
                'required': true,
                'rangelength': [1,19],
                'alphanum': true
            },
            'contact': {
                'required': true
            },
            'relay_port': {
                'required': true,
                'digits': true,
                'notInArray': [443,80,22],
                'range': [0,65535]
            },
            'dir_port': {
                'required': true,
                'digits': true,
                'notInArray': [443,80,22],
                'range': [0,65535]
            }

        },
        'messages': {
            'nickname': {
                'required': pgettext('validation message', 'You need to specify a nickname')
            },
            'contact': {
                'required': pgettext('validation message', 'You need to specify contact information')
            },
            'relay_port': {
                'required': pgettext('validation message', 'Relay port is required'),
                'digits': pgettext('validation message', 'Only digits are allowed'),
                'notInArray': pgettext('validation message', 'Port {0} is not valid for usage'),
                'range': pgettext('validation message', 'Port is out of range')
            },
            'dir_port': {
                'required': pgettext('validation message', 'Directory port is required'),
                'digits': pgettext('validation message', 'Only digits are allowed'),
                'notInArray': pgettext('validation message', 'Port {0} is not valid for usage'),
                'range': pgettext('validation message', 'Port {0} is out of range')
            }

        }
    });
    $("#TorCFG").ajaxForm({
        'dataType': 'json',
        'beforeSerialize': function($form, options) {
            if(!$torvalidator.form()) {
                return false;
            }
            $.throbber.show();
        },
		'success':   function (data) {
			$.throbber.hide();
			if($("#enabled").is(':checked')) {
				$.alert(_('It might take up to 20 minutes for Tor to self-test if the configuration is fully functional, please inspect the log file (Settings→Logs→tor) for verification"'), null, null, function(){
					location.reload(true);
				});
			} else {
				location.reload(true);
			}
		}
    });

    // Display average and max bandwidth rates. If "Custom" is
    // selected, allow the user to configure custom bandwidth rates
    $("#defined_bandwidth").change(function() {
        switch($("#defined_bandwidth").val()) {
        case '256':
            rate = "32 KBytes";
            burst = "64 KBytes";
            break;
        case '512':
            rate = "64 KBytes";
            burst = "128 KBytes";
            break;
        case '768':
            rate = "92 KBytes";
            burst = "192 KBytes";
            break;
        case 't1':
            rate = "192 KBytes";
            burst = "384 KBytes";
            break;
        case 'highbw':
        case 'custom':
            rate = "5120 KBytes";
            burst = "10240 KBytes";
            break;
        default:
            rate = burst = "0 bps";
        }
        $("#bandwidth_rate").attr("value", rate);
        $("#bandwidth_burst").attr("value", burst);

        if($("#defined_bandwidth").val() == "custom") {
            // Enable the fields so that the user can change
            // the values
            $("#bandwidth_rate").removeAttr("disabled");
            $("#bandwidth_burst").removeAttr("disabled");
        } else {
            $("#bandwidth_rate").attr("disabled", "disabled");
            $("#bandwidth_burst").attr("disabled", "disabled");
        }
    });


    $("#tor_type").change(function() {

        // Define set of exit policies
        var policies = ["http", "https", "mail", "im", "irc", "misc"];

        // Configure Tor as a bridge
        if($("#tor_type").val() == "bridge") {
            // Enable the bridge address line
            $("#bridge_address").closest('tr').show();

            // Disable the dirport field
            $("#dir_port").attr("disabled", "disabled");
            $("#dir_port").removeAttr("value");

            // Enable the bridge distribution checkbox
            $("#private_bridge").removeAttr("disabled");
            $("#private_bridge").attr("checked","checked");
        } else {
            // Disable the bridge address line
            $("#bridge_address").closest('tr').hide();

            // Enable the dirport field
            $("#dir_port").removeAttr("disabled");

            // Disable the bridge distribution checkbox
            $("#private_bridge").attr("disabled","disabled");
            $("#private_bridge").removeAttr("checked");
        }

        // Configure Tor as an exit relay
        if($("#tor_type").val() == "exit") {
            // Enable the exit policy boxes
            $(".fn_exit_policies").removeAttr("disabled");
        } else {
            // Disable the exit policy boxes
            $(".fn_exit_policies").attr("disabled","disabled");
        }
    });
	$("#tor_type").change();
});


$("#enabled").live('change', function(e){
    if($(this).is(':checked')) {
        $.alert(
			_("<p>Enabling Tor means that your B3 will be a part of the Tor anonymizing network. This will allow users all over the world to use your B3 to protect their privacy and reach a free and open Internet. To read more about Tor, please visit https://www.torproject.org/.</p>\
<p>Also note that enabling this service does not make your traffic anonymous.</p>\
<p>Before enabling Tor, it is recommended that you read the Terms of Service from your Internet Service Provider. <strong>Don't enable this service if you are hesitant</strong>.</p>"),
            _('Please note')
        );
    }
});
