<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js"></script>
<script type="text/javascript">
<!--

$(document).ready(function(){

	if( (<?="'".$this->session->userdata("network_profile")."'"?> != 'custom') ) {
		$('input').attr("disabled","true");
	}
	
	if( (<?="'".$this->session->userdata("network_profile")."'"?> == 'custom') ) {
		if(<?=$disabled?"0":"1"?>) {
			$(".gw").removeAttr("disabled");
			$(".dns").removeAttr("disabled");
		}
	}
});

function disable_fields() {


	$(".ip").attr("disabled","true");
	$(".mask").attr("disabled","true");
	$(".gw").attr("disabled","true");
	$(".dns").attr("disabled","true");
}

function enable_fields() {

	
	$(".ip").removeAttr("disabled");
	$(".mask").removeAttr("disabled");
	$(".gw").removeAttr("disabled");
	$(".dns").removeAttr("disabled");
}

function static_onclick() {
	 var dns=document.getElementById("cb_dns");
	 var dhcpd=document.getElementById("dhcpd");
	 var net_dhcp=document.getElementById("net_dhcp");
	 var net_static=document.getElementById("net_static");
	 
	 dns.disabled=false;
	 dhcpd.disabled=false;
	 enable_fields();
	 dhcpd_onclick();
	 		 
}

function dhcp_onclick() {
	 var dns=document.getElementById("cb_dns");
	 var dhcpd=document.getElementById("dhcpd");
	 var net_dhcp=document.getElementById("net_dhcp");
	 var net_static=document.getElementById("net_static");
   var frm=document.getElementById("LANCFG");
   var tgs=frm.getElementsByTagName("input");
	 
	 dns.disabled=true;
	 dhcpd.disabled=true;
	 disable_fields();

    for(i=0;i<tgs.length;i++){
       switch(tgs[i].name){
          case "dnsmasq[range_start][0]":
          case "dnsmasq[range_start][1]":
          case "dnsmasq[range_start][2]":
          case "dnsmasq[range_start][3]":
          case "dnsmasq[range_end][0]":
          case "dnsmasq[range_end][1]":
          case "dnsmasq[range_end][2]":
          case "dnsmasq[range_end][3]":
               tgs[i].disabled=true;
          default:
          	break;
          }
    }

}

function dhcpd_onclick() {
	 var dhcpd=document.getElementById("dhcpd");
   var frm=document.getElementById("LANCFG");
   var tgs=frm.getElementsByTagName("input");
	 
	if (dhcpd.checked==true) {
		// enable ip-fields
    for(i=0;i<tgs.length;i++){
       switch(tgs[i].name){
          case "dnsmasq[range_start][0]":
          case "dnsmasq[range_start][1]":
          case "dnsmasq[range_start][2]":
          case "dnsmasq[range_start][3]":
          case "dnsmasq[range_end][0]":
          case "dnsmasq[range_end][1]":
          case "dnsmasq[range_end][2]":
          case "dnsmasq[range_end][3]":
               tgs[i].disabled=false;
          default:
          	break;
          }
    }
		
	} else {
		// disable ip-fields
    for(i=0;i<tgs.length;i++){
       switch(tgs[i].name){
          case "dnsmasq[range_start][0]":
          case "dnsmasq[range_start][1]":
          case "dnsmasq[range_start][2]":
          case "dnsmasq[range_start][3]":
          case "dnsmasq[range_end][0]":
          case "dnsmasq[range_end][1]":
          case "dnsmasq[range_end][2]":
          case "dnsmasq[range_end][3]":
               tgs[i].disabled=true;
          default:
          	break;
          }
    }
	}
}

function dns_onclick() {
	 var dns=document.getElementById("cb_dns");
	 var dhcpd=document.getElementById("dhcpd");
	 
	if (dns.checked==true) {
		dhcpd.checked=true;
		dhcpd.disabled=false;
		dhcpd_onclick();
	} else {
		dhcpd.checked=false;
		dhcpd.disabled=true;
		dhcpd_onclick();
	}
}



// -->
</script>
<fieldset><legend><i><?=t('LAN')?></i></legend>
<form id="LANCFG" action="<?=FORMPREFIX?>/network/lanupdate" method="post">
<table border="0" cellpadding="0" cellspacing="0">

	<? if($this->session->userdata("network_profile") != "custom") { ?>
		<tr>
			<td valign="top"></td>
			<td valign="top" colspan="3" class="highlight">
			<?=t("To unlock this view, select 'Custom profile' under the 'Profile' tab")?>
			</td>
		</tr>
	<? } ?>
	<tr>
		<td valign="top">
		<input id="net_dhcp" type="radio" class="checkbox_radio" name='netcfg' value='dhcp' onclick="dhcp_onclick()" <?=$dhcp?"checked=\"checked\"":""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Obtain IP-address automatically')?> (DHCP)<br/>&nbsp;
		</td>
	</tr>
	<tr>
		<td valign="top" colspan="5"><br/>
		</td>
	</tr>
	
	<tr>
		<td valign="top">
			<input id="net_static" type="radio" class="checkbox_radio" name='netcfg' value='static' onclick="static_onclick()" <?=$dhcp?"":"checked=\"checked\""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Use static IP address settings')?>:<p/>
		</td>
	</tr>

	<tr>
		<td></td>
		<td><?=t('IP')?>:&nbsp;&nbsp;</td>
		<td><input <?=$disabled?> value='<?=$olip[0]?>' class='ip' name='ip[0]' type='text' size='3' maxlength='3'/>.<input  <?=$disabled?> value='<?=$olip[1]?>' class='ip' name='ip[1]' type='text' size='3' maxlength='3'/>.<input <?=$disabled?> value='<?=$olip[2]?>' class='ip' name='ip[2]' type='text' size='3' maxlength='3'/>.<input <?=$disabled?> value='<?=$olip[3]?>' class='ip' name='ip[3]' type='text' size='3' maxlength='3'/></td>
<? if($updated && $err_ip){ ?>
		<td>* <?=t("Invalid IP")?></td>
<? } ?>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Netmask')?>:&nbsp;&nbsp;</td>	
		<td><input <?=$disabled?> value='<?=$olmask[0]?>' class='mask' name='mask[0]' type='text' size='3' maxlength='3'/>.<input <?=$disabled?> value='<?=$olmask[1]?>' class='mask' name='mask[1]' type='text' size='3' maxlength='3'/>.<input <?=$disabled?> value='<?=$olmask[2]?>' class='mask' name='mask[2]' type='text' size='3' maxlength='3'/>.<input <?=$disabled?> value='<?=$olmask[3]?>' class='mask' name='mask[3]' type='text' size='3' maxlength='3'/></td>
<? if($updated && $err_netmask){ ?>
		<td>* <?=t("Invalid netmask")?></td>
<? } ?>
	</tr>


	<tr>
		<td></td>
		<td><?=t('Default gateway')?>:&nbsp;&nbsp;</td>	
		<td><input disabled="disabled" value='<?=$olgw[0]?>' class='gw' name='gw[0]' type='text' size='3' maxlength='3'/>.<input disabled="disabled" value='<?=$olgw[1]?>' class='gw' name='gw[1]' type='text' size='3' maxlength='3'/>.<input disabled="disabled" value='<?=$olgw[2]?>' class='gw' name='gw[2]' type='text' size='3' maxlength='3'/>.<input disabled="disabled" value='<?=$olgw[3]?>' class='gw' name='gw[3]' type='text' size='3' maxlength='3'/></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Primary DNS')?>:&nbsp;&nbsp;</td>	
		<td><input disabled="disabled" value='<?=$oldns[0]?>' class='dns' name='dns[0]' type='text' size='3' maxlength='3'/>.<input disabled="disabled" value='<?=$oldns[1]?>' class='dns' name='dns[1]' type='text' size='3' maxlength='3'/>.<input disabled="disabled" value='<?=$oldns[2]?>' class='dns' name='dns[2]' type='text' size='3' maxlength='3'/>.<input disabled="disabled" value='<?=$oldns[3]?>' class='dns' name='dns[3]' type='text' size='3' maxlength='3'/><br>&nbsp;</td>
	</tr>


	<tr>
		<td></td>
		<td valign="top" colspan="2">
		<input type="checkbox" class="checkbox_radio" id="cb_dns" <?=$disabled?> name='dnsmasq[running]' value='dns' onclick="dns_onclick()" <?=isset($dnsmasq_settings["running"]) && $dnsmasq_settings["running"]?"checked=\"checked\"":""?>/>
			<?=t('Enable DNS service')?>
		</td>
<? if($updated && $err_dnsmasq["dns"]){ ?>
		<td>* <?=t("Error starting/stopping DNS service")?></td>
<? } ?>
	</tr>

	<tr>
		<td></td>
		<td valign="top" colspan="2">
		<input type="checkbox" class="checkbox_radio" id="dhcpd" <?=$disabled?> name='dnsmasq[dhcpd]' value='dhcpd'" onclick="dhcpd_onclick()" <?=$dnsmasq_settings["dhcpd"]?"checked=\"checked\"":""?>/>
			<?=t('Enable DHCP server')?>
		</td>
<? if($updated && $err_dnsmasq["dhcpd"]){ ?>
		<td>* <?=t("Error starting/stopping DHCP server")?></td>
<? } ?>
	</tr>

	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Lease range')?>:&nbsp;&nbsp;</td>
		<td><input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_start"][0]?>' name='dnsmasq[range_start][0]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_start"][1]?>' name='dnsmasq[range_start][1]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_start"][2]?>' name='dnsmasq[range_start][2]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_start"][3]?>' name='dnsmasq[range_start][3]' type='text' size='3' maxlength='3'/>&nbsp;-&nbsp;
		<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][0]?>' name='dnsmasq[range_end][0]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][1]?>' name='dnsmasq[range_end][1]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][2]?>' name='dnsmasq[range_end][2]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][3]?>' name='dnsmasq[range_end][3]' type='text' size='3' maxlength='3'/>
<? if($updated && $err_dnsmasq["dhcpdrange"]){ ?>
	<?="* ".t("Invalid IP range entered")?>
<? } ?>
		</td>
	</tr>

	<tr>
		<td valign="top" colspan="3"><br/></td>
	</tr>


	<tr>
		<td><input type="checkbox" <?=$jumbo?"checked=\"checked\"":""?> class="checkbox_radio" name="jumbo" value="1"/></td>
		<td colspan="2"><?=t('Enable jumbo frames. Please read manual before enabling.')?></td>
		<td></td>
	</tr>

	<tr>
		<td valign="top" colspan="3"><br/></td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit" value='<?=t('Update')?>' name='update'/></td>	
		<td></td>
	</tr>

</table>
</form>
</fieldset>

<fieldset><legend><i><?=t('DHCP leases')?></i></legend>
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<td><?=t("Hostname")?></td><td><?=t("IP-address")?></td><td><?=t("MAC-address")?></td><td><?=t("Lease expires")?></td>
	</tr>
	<?
	foreach ($dhcpd_leases as $mac => $lease) { ?>
		<tr>
			<td><?=$lease["hostname"]?></td><td><?=$lease["ip"]?></td><td><?=$mac?></td><td><?=date("M jS, H:i",$lease["exp_time"])?></td>
		</tr>
	<? } ?>
	
</table>
</fieldset>


