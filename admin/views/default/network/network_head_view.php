<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.form.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.validate.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/network.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/tor.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript">

function disable_leasefields() {
	for(i=0;i<4;i++) {
		if( $("[name='mask["+i+"]']").val() == "255") {
			$("[name='dnsmasq[range_start]["+i+"]']").attr("readonly","readonly");
			$("[name='dnsmasq[range_end]["+i+"]']").attr("readonly","readonly");
		} else {
			$("[name='dnsmasq[range_start]["+i+"]']").removeAttr("readonly");
			$("[name='dnsmasq[range_end]["+i+"]']").removeAttr("readonly");
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
						"<?=_("Network configuration")?>", {

						<?=_("Continue")?>: function() {
								$(this).dialog('close');
								cursor_wait();
								$("#OTHCFG").submit(); 
							},<?=_("Cancel")?>: function() {
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
		$('#content_wrapper input').attr("disabled","true");
		$('#content_wrapper button').attr("disabled","true");
		$('#content_wrapper button').addClass("ui-state-disabled");
	<?endif?>
	
	// wan + lan
	$("#body_lan tr td:nth-child(2),#body_wan tr td:nth-child(2)").addClass("col2");	
		
	$(".fn-network-button_submit").click( function (e) {
		$(".fn-network-button_submit").addClass("ui-state-disabled");
		$(this).parents("form").submit();
		e.preventDefault();
	});

	// lan scripts
	$("[name='dnsmasq[range_start][0]']").val($("[name='ip[0]']").val());
	$("[name='dnsmasq[range_start][1]']").val($("[name='ip[1]']").val());
	$("[name='dnsmasq[range_start][2]']").val($("[name='ip[2]']").val());
	$("[name='dnsmasq[range_end][0]']").val($("[name='ip[0]']").val());
	$("[name='dnsmasq[range_end][1]']").val($("[name='ip[1]']").val());
	$("[name='dnsmasq[range_end][2]']").val($("[name='ip[2]']").val());
	<?if(isset($dhcpd) && !$dhcpd):?>
		$("#cb_dns").attr("disabled","disabled");
		$("#dhcpd").attr("disabled","disabled");
	<?endif?> 

	$("#dhcpd").change(function() {
		update_leasefields();
	});
	$("#cb_dns").change(function() {
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
