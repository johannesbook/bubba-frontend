<form id="WANCFG" action="<?=FORMPREFIX?>/network/wanupdate" method="post">
<table id="table-network-wan">
    <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=t('WAN')?></td></tr>
	<? if($this->session->userdata("network_profile") == "auto" || $this->session->userdata("network_profile") == "custom") { ?>
		<tr>
			<td ></td>
			<td  colspan="3" >
				<?=t("These settings are locked")." (".t("Bubba is using automatic network settings").")"?>&nbsp;.&nbsp;<br />
				<?=t("To unlock, select Router or Server profile under the ")?><a href="<?=FORMPREFIX?>/network/profile"><?=t("Profile")?></a> tab
			</td>
		</tr>
	<? } ?>

	<tr>
		<td >
		<input type="radio" class="checkbox_radio" name='netcfg' value='dhcp' onclick="dhcp_onclick()" <?=$dhcp?"checked=\"checked\"":""?>/>
		</td>
		<td colspan="3">
			<label for=""><label for=""><?=t('Obtain IP-address automatically')?> (DHCP)</label>
		</td>
	</tr>
	<tr>
		<td>
			<input type="radio" class="checkbox_radio" name='netcfg' value='static' onclick="static_onclick(<?=$disable_gw?>)" <?=$dhcp?"":"checked=\"checked\""?>/>
		</td>
		<td  colspan="3">
			<label for=""><label for=""><?=t('Use static IP address settings')?>:</label>
		</td>
	</tr>
	<tr id="tr-network-ip">
		<td></td>
		<td><label for=""><?=t('IP')?></label>:</td>
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[0]?>' class='ip' name='IP[0]' type='text' size='3' maxlength='3'/>&nbsp;.&nbsp;<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[1]?>' class='ip' name='IP[1]' type='text' size='3' maxlength='3'/>&nbsp;.&nbsp;<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[2]?>' class='ip' name='IP[2]' type='text' size='3' maxlength='3'/>&nbsp;.&nbsp;<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[3]?>' class='ip' name='IP[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_ip?"* " . t("Invalid IP"):""?></td>
	</tr>
	<tr id="tr-network-netmask">
		<td></td>
		<td><label for=""><?=t('Netmask')?></label>:</td>	
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[0]?>' class='ip' name='mask[0]' type='text' size='3' maxlength='3'/>&nbsp;.&nbsp;<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[1]?>' class='ip' name='mask[1]' type='text' size='3' maxlength='3'/>&nbsp;.&nbsp;<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[2]?>' class='ip' name='mask[2]' type='text' size='3' maxlength='3'/>&nbsp;.&nbsp;<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[3]?>' class='ip' name='mask[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_mask?"* " . t("Invalid netmask"):""?></td>
	</tr>
	<tr id="tr-network-gateway">
		<td></td>
		<td><label for=""><?=t('Default gateway')?></label>:</td>	
		<td>
			<input
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$ogw[0]?>'
				class='ip'
				name='gw[0]'
				type='text' 
				size='3' 
				maxlength='3'
				/>&nbsp;.&nbsp;<input
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$ogw[1]?>' 
				class='ip' 
				name='gw[1]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>&nbsp;.&nbsp;<input 
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$ogw[2]?>' 
				class='ip' 
				name='gw[2]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>&nbsp;.&nbsp;<input 
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$ogw[3]?>' 
				class='ip' 
				name='gw[3]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>
		</td>
		<td><?=$err_gw?"* " . t("Invalid gateway"):""?></td>
	</tr>
	<tr id="tr-network-dns">
		<td></td>
		<td><label for=""><?=t('Primary DNS')?></label>:</td>	
		<td>
			<input 
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$odns[0]?>' 
				class='ip' 
				name='dns[0]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>&nbsp;.&nbsp;<input 
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$odns[1]?>' 
				class='ip' 
				name='dns[1]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>&nbsp;.&nbsp;<input
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$odns[2]?>' 
				class='ip' 
				name='dns[2]' 
				type='text' 
				size='3'
				maxlength='3'
			/>&nbsp;.&nbsp;<input 
        <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
				value='<?=$odns[3]?>' 
				class='ip' 
				name='dns[3]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>
		</td>
		<td><?=$err_dns?"* " . t("Invalid DNS setting"):""?></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="hidden" class='ip' name='refresh' value='3'/><input type="submit" value='<?=t('Update')?>' class='ip' name='update'/>
		</td>
	</tr>
	
</table>
</form>
