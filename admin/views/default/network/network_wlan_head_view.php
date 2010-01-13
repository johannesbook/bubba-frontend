<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.validate.js"></script>

<script  type="text/javascript">

wlan_configurable=<?=$wlan_configurable?"true":"false"?>;
bands=<?=json_encode($bands)?>;
rules=<?=json_encode($frequency_rules)?>;
current_mode=<?=json_encode($current_mode)?>;
current_channel=<?=json_encode($current_channel)?>;

</script>

<script  type="text/javascript">
$(document).ready( function() {
    if( wlan_configurable ) {
        $("#wLANCFG :disabled").removeAttr("disabled");
    }

	$.validator.addMethod('wep', function(value, element, params) {
		return value.length == 5 || value.length == 13 || value.length == 16;
	});
	validator = $('#wLANCFG').validate({
		rules: {
			'ssid' : {
				required: true,
				maxlength: 32
			}
		},
		messages: {
			'ssid': {
				required: "Please enter an SSID (Service Set Identifier)",
				maxlength: jQuery.format("SSID has a maximum length of 32 characters")
			}
		}
	});

	$('select#mode').change(function() {
		mode=$(this).val();
		current_selected_channel=$("select#channel :selected").val() || current_channel;
		has_set_current_selected_channel = false;
		sel=$("select#channel");
		sel.empty();
		band=rules["band"][mode];

		for( j = 0; j < band.length; ++j ) {
			for( i = 0; i < bands[band[j]].length; ++i ) {
				cur = bands[band[j]][i];
				if( cur["disabled"] == "true" || cur["radar_detection"] == "true" ) {
					continue;
				}
				opt = $("<option/>");
				opt.val(cur["channel"]);
				opt.html("<?=t("Channel")?> " + cur["channel"] + " (" + cur["freq"] + " MHz)");
				if( cur["channel"] == current_selected_channel ) {
					if( ! has_set_current_selected_channel ) {
						has_set_current_selected_channel = true;
						opt.attr("selected", "selected");
					}
				}
				if( !has_set_current_selected_channel && cur["channel"] == current_channel ) {
					opt.attr("selected", "selected");
				}
				sel.append(opt);
			}
		}
	});
	$('select#mode').change();

	$('select#encryption').change(function() {
		$('#password').rules("remove");
		if($(this).val() == 'none') {
			$('#password').attr('disabled', 'disabled');
		} else {
			$('#password').removeAttr('disabled');
			if($(this).val() == 'wep') {
				$('#password').rules("add", {
					required: true,
					wep: true,
					messages: {
						required: "Please enter an WEP key",
						wep: jQuery.format("WEP key need to be between 5, 13, or 16 characters of length")
					}

				});
			} else {
				$('#password').rules("add", {
					required: true,
					rangelength: [8, 63],
					messages: {
						required: "Please enter an WPA key",
						rangelength: jQuery.format("WPA key need to be between {0} and {1} characters of length")
					}
				});
			}
		}
	});
	$('select#encryption').trigger('change');
});
</script>

<style>
label.error {
  background:url("/admin/views/default/_img/x15.png") no-repeat 0px 0px;
  padding-left: 16px;
  padding-bottom: 2px;
  color: #ea5200;
}

</style>
