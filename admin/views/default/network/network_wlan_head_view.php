<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.validate.js?v='<?=$this->session->userdata('version')?>'"></script>

<script  type="text/javascript">

wlan_configurable=<?=$wlan_configurable?"true":"false"?>;
bands=<?=json_encode($bands)?>;
current_mode=<?=json_encode($current_mode)?>;
current_band=<?=json_encode($current_band)?>;
current_channel=<?=json_encode($current_channel)?>;
labels = {
	legacy_2: <?=json_encode(t("wlan_title_legacy_mode_2"))?>,
	legacy_1: <?=json_encode(t("wlan_title_legacy_mode_1"))?>,
	mixed_2: <?=json_encode(t("wlan_title_mixed_mode_2"))?>,
	mixed_1: <?=json_encode(t("wlan_title_mixed_mode_1"))?>

};

</script>

<script  type="text/javascript">
$(document).ready( function() {

	$("input[type='submit']").click(function() {
		cursor_wait();
	});
	
	if(<?=isset($update)?"$update":"'0'"?>) {
		update_status("<?=isset($success)?$success:"fail"?>","<?=isset($update_msg)?t($update_msg):""?>");
	}

  if( wlan_configurable ) {
      $("#wLANCFG :disabled").removeAttr("disabled");
  }

	// hide advanced settings
	$("#wlan_adv_mark").html("+");
	$("#wlan_adv").css("display","none");
	

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

    $("select#channel").change(function() {
        current_channel = $(this).val();
    });

	$("input[name='band']").change(function() {
        band = $(this).val();
        $("option#mode_legacy").empty().html(labels["legacy_" + band])
        $("option#mode_mixed").empty().html(labels["mixed_" + band])
		current_selected_channel = current_channel;
		sel=$("select#channel");
		sel.empty();

        for( i = 0; i < bands[band].length; ++i ) {
            cur = bands[band][i];
            if( cur["disabled"] == "true" || cur["radar_detection"] == "true" ) {
                continue;
            }
            opt = $("<option/>");
            opt.val(cur["channel"]);
            opt.html("<?=t("Channel")?> " + cur["channel"] + " (" + cur["freq"] + " MHz)");
            if( cur["channel"] == current_channel ) {
                opt.attr("selected", "selected");
            }
            sel.append(opt);
        }
	});
	$("input#band"+current_band+"").change();

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
	$('select#mode').change(function() {
		switch( $(this).val() ) {
		case "legacy":
			$("select#width").val("20");
			$("select#width").attr("disabled", "disabled");
			break;
		case "mixed":
			$("select#width").removeAttr("disabled");
			break;
		case "greenfield":
			$("select#width").val("40");
			$("select#width").attr("disabled", "disabled");
			break;
		}
	});
	
	$('select#encryption').trigger('change');
	$('select#mode').trigger('change');
});
</script>

<style>
label.error {
  background:url("/admin/views/default/_img/x15.png") no-repeat 0px 0px;
  padding-left: 16px;
  padding-bottom: 2px;
  color: #ea5200;
}

input[type='submit'] {
	margin-left : 76px;
	margin-top : 15px;
}

input[type='text'] {
	width : 150px;
	padding : 2px;
}

select {
	width : 155px;
}
select#mode {
	width : 225px;
}

</style>
