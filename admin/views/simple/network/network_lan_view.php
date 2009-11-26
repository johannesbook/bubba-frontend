	<script type="text/javascript">
	<!--
	
	function disable_fields() {
	   var frm=document.getElementById("LANCFG");
      var tgs=frm.getElementsByTagName("input");

      for(i=0;i<tgs.length;i++){
         switch(tgs[i].name){
            case "ip[0]":
            case "ip[1]":
            case "ip[2]":
            case "ip[3]":
            case "mask[0]":
            case "mask[1]":
            case "mask[2]":
            case "mask[3]":
	               tgs[i].disabled=true;
            default:
            	break;
            }
      }
	}
	
	function enable_fields() {
	   var frm=document.getElementById("LANCFG");
      var tgs=frm.getElementsByTagName("input");

      for(i=0;i<tgs.length;i++){
         switch(tgs[i].name){
            case "ip[0]":
            case "ip[1]":
            case "ip[2]":
            case "ip[3]":
            case "mask[0]":
            case "mask[1]":
            case "mask[2]":
            case "mask[3]":
	               tgs[i].disabled=false;
            default:
            	break;
            }
      }
	}

	function static_onclick() {
		 var dns=document.getElementById("dns");
		 var dhcpd=document.getElementById("dhcpd");
		 var net_dhcp=document.getElementById("net_dhcp");
		 var net_static=document.getElementById("net_static");
		 
		 dns.disabled=false;
		 dhs.checked=true;
		 dhcpd.disabled=false;
		 dhcpd.checked=true;
		 enable_fields();
		 
  }

	function dhcp_onclick() {
		 var dns=document.getElementById("dns");
		 var dhcpd=document.getElementById("dhcpd");
		 var net_dhcp=document.getElementById("net_dhcp");
		 var net_static=document.getElementById("net_static");
		 
		 dns.disabled=true;
		 dns.checked=false;
		 dhcpd.disabled=true;
		 dhcpd.checked=false;
		 disable_fields();
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
		 var dns=document.getElementById("dns");
		 var dhcpd=document.getElementById("dhcpd");
		 
		if (dns.checked==true) {
			dhcpd.checked=true;
			dhcpd.disabled=false;
			dhcpd_onclick();
		} else {
			dhcpd.checked=false;
			dhcpd.disabled=true;
		}
	}

	
	
	// -->
	</script>
<fieldset><legend><i><?=t('LAN')?></i></legend>
<form id="LANCFG" action="<?=FORMPREFIX?>/network/lanupdate" method="post">
<table border="0" cellpadding="0" cellspacing="0">


	<tr>
		<td valign="top">
		<input id="net_dhcp" type="radio" name='netcfg' value='dhcp' onclick="dhcp_onclick()" <?=$dhcp?"checked=\"checked\"":""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Obtain IP-address automatically')?> (DHCP)<br/>&nbsp;
		</td>
	</tr>
	<tr>
		<td valign="top">
			<input id="net_static" type="radio" name='netcfg' value='static' onclick="static_onclick();" <?=$dhcp?"":"checked=\"checked\""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Use static IP address settings')?>:<p/>
		</td>
	</tr>

	<tr>
		<td></td>
		<td><?=t('IP')?>:&nbsp;&nbsp;</td>
		<td><input $disabled value='<?=$olip[0]?>' name='ip[0]' type='text' size='3' maxlength='3'/>.<input  $disabled value='<?=$olip[1]?>' name='ip[1]' type='text' size='3' maxlength='3'/>.<input $disabled value='<?=$olip[2]?>' name='ip[2]' type='text' size='3' maxlength='3'/>.<input $disabled value='<?=$olip[3]?>' name='ip[3]' type='text' size='3' maxlength='3'/></td>
<? if($updated && $err_ip){ ?>
		<td>* <?=t("Invalid IP")?></td>
<? } ?>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Netmask')?>:&nbsp;&nbsp;</td>	
		<td><input $disabled value='<?=$olmask[0]?>' name='mask[0]' type='text' size='3' maxlength='3'/>.<input $disabled value='<?=$olmask[1]?>' name='mask[1]' type='text' size='3' maxlength='3'/>.<input $disabled value='<?=$olmask[2]?>' name='mask[2]' type='text' size='3' maxlength='3'/>.<input $disabled value='<?=$olmask[3]?>' name='mask[3]' type='text' size='3' maxlength='3'/></td>
<? if($updated && $err_netmask){ ?>
		<td>* <?=t("Invalid netmask")?></td>
<? } ?>
	</tr>


	<tr>
		<td></td>
		<td><?=t('Default gateway')?>:*&nbsp;&nbsp;</td>	
		<td><input DISABLED value='<?=$olgw[0]?>' name='gw[0]' type='text' size='3' maxlength='3'/>.<input DISABLED value='<?=$olgw[1]?>' name='gw[1]' type='text' size='3' maxlength='3'/>.<input DISABLED value='<?=$olgw[2]?>' name='gw[2]' type='text' size='3' maxlength='3'/>.<input DISABLED value='<?=$olgw[3]?>' name='gw[3]' type='text' size='3' maxlength='3'/></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Primary DNS')?>:*&nbsp;&nbsp;</td>	
		<td><input DISABLED value='<?=$oldns[0]?>' name='dns[0]' type='text' size='3' maxlength='3'/>.<input DISABLED value='<?=$oldns[1]?>' name='dns[1]' type='text' size='3' maxlength='3'/>.<input DISABLED value='<?=$oldns[2]?>' name='dns[2]' type='text' size='3' maxlength='3'/>.<input DISABLED value='<?=$oldns[3]?>' name='dns[3]' type='text' size='3' maxlength='3'/></td>
	</tr>


	<tr>
		<td valign="top"><br>
		</td>
	</tr>

	<tr>
		<td></td>
		<td valign="top" colspan="2">
		<input type="checkbox" id="dns" name='dnsmasq[running]' value='dns' onclick="dns_onclick()" <?=$dnsmasq_settings["running"]?"checked=\"checked\"":""?>/>
			<?=t('Enable DNS service')?>
		</td>
<? if($updated && $err_dnsmasq["dns"]){ ?>
		<td>* <?=t("Error starting/stopping DNS service")?></td>
<? } ?>
	</tr>

	<tr>
		<td></td>
		<td valign="top" colspan="2">
		<input type="checkbox" id="dhcpd" name='dnsmasq[dhcpd]' value='dhcpd'" onclick="dhcpd_onclick()" <?=$dnsmasq_settings["dhcpd"]?"checked=\"checked\"":""?>/>
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
		<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][0]?>' name='dnsmasq[range_end][0]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][1]?>' name='dnsmasq[range_end][1]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][2]?>' name='dnsmasq[range_end][2]' type='text' size='3' maxlength='3'/>.<input <?=$dnsmasq_settings["dhcpd"]?"":"DISABLED"?> value='<?=$dnsmasq_settings["range_end"][3]?>' name='dnsmasq[range_end][3]' type='text' size='3' maxlength='3'/></td>
<? if($updated && $err_dnsmasq["dhcpdrange"]){ ?>
		<td>* <?=t("Invalid IP range entered")?></td>
<? } ?>
	</tr>

	<tr>
		<td valign="top"><br>
		</td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit" value='<?=t('Update')?>' name='update'/></td>	
		<td></td>
	</tr>

	<tr>
		<td></td>
		<td></td>	
		<td>* <?=t("DNS and gateway information is shown for information <br>only and changed in the WAN settings.")?></td>
	</tr>

</table>
</form>
</fieldset>

<fieldset><legend><i><?=t('DHCP leases')?></i>
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


