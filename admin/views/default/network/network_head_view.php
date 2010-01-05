<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/network.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.confirm.js"></script>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css" />

<script type="text/javascript">

$(document).ready(function(){

	<?if(isset($disable_network) && $disable_network) { ?>
			$('input').attr("disabled","true");
	<? } ?>
			
	if(<?=isset($update)?"$update":"'0'"?>) {
		update_status("<?=isset($success)?$success:"fail"?>","<?=isset($update_msg)?t($update_msg):""?>");
	}
	
	$("#networkprofile_update").click(function() {
		show_confirm = 0;			
		if("<?=isset($profile)?$profile:"no_profile"?>" != "auto" && $("input[name='profile']:checked").val() == "auto") {
			show_confirm = 1;			
			$.confirm("<?=t("This will restore default network configuration aswell as restarting the network on BUBBA|2.")."<br/>".t("Changing network parameters can requrie a restart of your computer.")."<br/><br/>".t("Please see the quickstart on how to connect your computer to Bubba.")?>",
				function(){
					cursor_wait();
					alert("apply");
					$("#OTHCFG").submit();
				}
				,"<?=("Continue")?>","<?=t("Cancel")?>","<?=t("Network configuration")?>");
		}
		if(show_confirm) {
			return false;
		}
		cursor_wait();
	});

	
	$("#dhcpd").click(function() {
		update_leasefields();
	});
	$("#cb_dns").click(function() {
		if($("#cb_dns").attr('checked')) {
			$("#dhcpd").attr('checked','true');
			update_leasefields();
		} else {
			$("#dhcpd").removeAttr('checked');
			update_leasefields();
		}
	});
});
	
</script>
