<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js"></script>
<script type="text/javascript">
<!--

$(document).ready(function(){

	if( (<?="'".$this->session->userdata("network_profile")."'"?> != 'custom') ) {
		$('input').attr("disabled","true");
	}

});


function dhcp_onclick() {
	var frm=document.getElementById("WANCFG");
	var tgs=frm.getElementsByTagName("input");

	for(i=0;i<tgs.length;i++){
		switch(tgs[i].name){
			case "IP[0]":
			case "IP[1]":
			case "IP[2]":
			case "IP[3]":
			case "mask[0]":
			case "mask[1]":
			case "mask[2]":
			case "mask[3]":
			case "gw[0]":
			case "gw[1]":
			case "gw[2]":
			case "gw[3]":
			case "dns[0]":
			case "dns[1]":
			case "dns[2]":
			case "dns[3]":
			tgs[i].disabled=true;
		default:
			break;
		}
	}
}

function static_onclick() {
	var frm=document.getElementById("WANCFG");
	var tgs=frm.getElementsByTagName("input");
	
	for(i=0;i<tgs.length;i++){
		switch(tgs[i].name){
			case "IP[0]":
			case "IP[1]":
			case "IP[2]":
			case "IP[3]":
			case "mask[0]":
			case "mask[1]":
			case "mask[2]":
			case "mask[3]":
			case "gw[0]":
			case "gw[1]":
			case "gw[2]":
			case "gw[3]":
			case "dns[0]":
			case "dns[1]":
			case "dns[2]":
			case "dns[3]":
			tgs[i].disabled=false;
		default:
			break;
		}
	}
}
// -->
</script>

<fieldset><legend><i><?=t('WAN')?></i></legend>
<form id="WANCFG" action="<?=FORMPREFIX?>/network/wanupdate" method="post">
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
		<input type="radio" class="checkbox_radio" name='netcfg' value='dhcp' onclick="dhcp_onclick()" <?=$dhcp?"checked=\"checked\"":""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Obtain IP-address automatically')?> (DHCP)<br/>&nbsp;
		</td>
		<td></td>
	</tr>
	<tr>
		<td valign="top">
			<input type="radio" class="checkbox_radio" name='netcfg' value='static' onclick="static_onclick()" <?=$dhcp?"":"checked=\"checked\""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Use static IP address settings')?>:<p/>
		</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('IP')?>:</td>
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[0]?>' class='wan' name='IP[0]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[1]?>' class='wan' name='IP[1]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[2]?>' class='wan' name='IP[2]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[3]?>' class='wan' name='IP[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_ip?"* " . t("Invalid IP"):""?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Netmask')?>:</td>	
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[0]?>' class='wan' name='mask[0]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[1]?>' class='wan' name='mask[1]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[2]?>' class='wan' name='mask[2]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[3]?>' class='wan' name='mask[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_mask?"* " . t("Invalid netmask"):""?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Default gateway')?>:</td>	
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$ogw[0]?>' class='wan' name='gw[0]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$ogw[1]?>' class='wan' name='gw[1]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$ogw[2]?>' class='wan' name='gw[2]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$ogw[3]?>' class='wan' name='gw[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_gw?"* " . t("Invalid gateway"):""?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Primary DNS')?>:</td>	
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$odns[0]?>' class='wan' name='dns[0]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$odns[1]?>' class='wan' name='dns[1]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$odns[2]?>' class='wan' name='dns[2]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$odns[3]?>' class='wan' name='dns[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_dns?"* " . t("Invalid DNS setting"):""?></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="hidden" class='wan' name='refresh' value='3'/><input type="submit" value='<?=t('Update')?>' class='wan' name='update'/></td>	
		<td></td>
		<td></td>
	</tr>
	<?
	if($this->session->userdata("network_profile") == "server") { ?>
	<tr>
		<td></td>
		<td colspan="2"><?=t("To enable WAN settings select 'Router / Firewall' profile")?></td>	
		<td></td>
	</tr>
	<? } ?>
</table>
</form>
</fieldset>

