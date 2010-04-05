<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/network.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript">


function disable_leasefields() {
	for(i=0;i<4;i++) {
		if( $("[name='mask["+i+"]']").val() == "255") {
			$("[name='dnsmasq[range_start]["+i+"]']").attr("disabled","disabled");
			$("[name='dnsmasq[range_end]["+i+"]']").attr("disabled","disabled");
		} else {
			$("[name='dnsmasq[range_start]["+i+"]']").removeAttr("disabled");
			$("[name='dnsmasq[range_end]["+i+"]']").removeAttr("disabled");
		}
	}
}

$(document).ready(function(){

	// network profile
	$("#OTHCFG input:radio").click(function(){$("#networkprofile_update").removeAttr("disabled")});
	$("#networkprofile_update").click(function() {
		$.post("<?=site_url("ajax_network/validate_profile_change")?>",{ profile: $("input[name='profile']:checked").val() }, function(data){
			if( data.error ) {
				$.alert(data.html);
				cursor_ready();
			} else if( data.change ) {
				if( data.show_alert ) {
					$.confirm( 
						data.alert_msg, 
						"<?=t("Network configuration")?>", {

						<?=t('button_label_continue')?>: function() {
								$(this).dialog('close');
								cursor_wait();
								$("#OTHCFG").submit(); 
							},<?=t('button_label_cancel')?>: function() {
								$(this).dialog('close');
							}
						}
					);

				} else {
					$("#OTHCFG").submit();
				}
			} else {
				cursor_ready();
				if($("#post_value").length) {
					$("#post_value").val(1);
					$("#OTHCFG").submit();
				}
			}
		}, 'json');
		return false;
	});	

	// firewall scripts
	<?if(isset($expand) && $expand):?>
	$("#network-firewall-advanced").removeClass("ui-helper-hidden");
	<?endif?>

	<?if( (isset($disable_network) && $disable_network) || (isset($disable_fw) && $disable_fw) ):?>
		// lan + wan + firewall
		$('input').attr("disabled","true");
		$('button').attr("disabled","true");
		$('button').addClass("ui-state-disabled");
	<?endif?>
	
	// wan + lan
	$("#body_lan tr td:nth-child(2),#body_wan tr td:nth-child(2)").addClass("col2");	
		
	$(".fn-network-button_submit").click( function () {
		$(".fn-network-button_submit").addClass("ui-state-disabled");
		$(this).parents("form").submit();
	});

	// lan scripts
	<?if(isset($dhcpd) && !$dhcpd):?>
		$("#cb_dns").attr("disabled","disabled");
		$("#dhcpd").attr("disabled","disabled");
	<?endif?> 

	$("#dhcpd").click(function() {
		update_leasefields();
	});
	$("#cb_dns").click(function() {
		if($("#cb_dns").attr('checked')) {
			$("#dhcpd").attr('checked','true');
			$("#dhcpd").removeAttr('disabled');
			update_leasefields();
		} else {
			$("#dhcpd").removeAttr('checked');
			$("#dhcpd").attr('disabled','disabled');
			update_leasefields();
		}
	});
	
	$(".ip").change( function() {

		$("[name='dnsmasq[range_start][0]']").val($("[name='ip[0]']").val());
		$("[name='dnsmasq[range_start][1]']").val($("[name='ip[1]']").val());
		$("[name='dnsmasq[range_start][2]']").val($("[name='ip[2]']").val());
		$("[name='dnsmasq[range_end][0]']").val($("[name='ip[0]']").val());
		$("[name='dnsmasq[range_end][1]']").val($("[name='ip[1]']").val());
		$("[name='dnsmasq[range_end][2]']").val($("[name='ip[2]']").val());
		disable_leasefields();
	});

	disable_leasefields();
	
});

</script>
