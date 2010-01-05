
function update_leasefields() {
	if($("#dhcpd").attr("checked")) {
		$("input[type='text'].dnsmasq").removeAttr("disabled");
	} else {
		$("input[type='text'].dnsmasq").attr("disabled","true");
	}
}
	
function dhcp_onclick() {
	$("input[type='text'].ip").attr("disabled","true");
	$(".dnsmasq").attr("disabled","true");
}

function static_onclick(disable_gw) {
	$("input[type='text'].ip").removeAttr("disabled");
	if(disable_gw) {
		$("input[name^='gw']").attr("disabled","true");
		$("input[name^='dns']").attr("disabled","true");
	}

	$("#cb_dns").removeAttr("disabled");
	if($("#cb_dns").attr("checked")) {
		$("#dhcpd").removeAttr("disabled");
		update_leasefields();
	}
}
