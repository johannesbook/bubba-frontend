<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/network.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.confirm.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.alert.js?v='<?=$this->session->userdata('version')?>'"></script>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css?v='<?=$this->session->userdata('version')?>'" />

<script type="text/javascript">

$(document).ready(function(){

	<?if(isset($disable_network) && $disable_network) { ?>
			$('input').attr("disabled","true");
	<? } ?>
			
	if(<?=isset($update)?"$update":"'0'"?>) {
		update_status("<?=isset($success)?$success:"fail"?>","<?=isset($update_msg)?t($update_msg):""?>");
	}
	
    $("#OTHCFG input:radio").click(function(){$("#networkprofile_update").removeAttr("disabled")});
	$("#networkprofile_update").click(function() {
        cursor_wait();
        $.post("<?=site_url("ajax_network/validate_profile_change")?>",{ profile: $("input[name='profile']:checked").val() }, function(data){
            if( data.error ) {
                $.alert(data.html);
                cursor_ready();
            } else if( data.change ) {
                if( data.show_alert ) {
                    $.confirm( data.alert_msg, function() {
                        cursor_wait();
                        $("#OTHCFG").submit();
                    },"<?=("Continue")?>","<?=t("Cancel")?>","<?=t("Network configuration")?>", true, function(dialog) {
                        cursor_ready();
                        this.close();
                    });
                } else {
                    $("#OTHCFG").submit();
                }
            } else {
                cursor_ready();
            }
        }, 'json');
        return false;
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
