<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js?v='<?=$this->session->userdata('version')?>'"></script>

<fieldset><legend><i><?=t('WAN')?></i></legend>
<form id="WANCFG" action="<?=FORMPREFIX?>/network/wanupdate" method="post">
<table class="networksettings">

	<? if($this->session->userdata("network_profile") == "auto" || $this->session->userdata("network_profile") == "custom") { ?>
		<tr>
			<td valign="top"></td>
			<td valign="top" colspan="3" >
				<?=t("These settings are locked")." (".t("Bubba is using automatic network settings").")"?>.<br />
				<?=t("To unlock, select Router or Server profile under the ")?><a href="<?=FORMPREFIX?>/network/profile"><?=t("Profile")?></a> tab
			</td>
		</tr>
	<? } ?>

	<tr>
		<td valign="top">
		<input type="radio" class="checkbox_radio" name='netcfg' value='dhcp' onclick="dhcp_onclick()" <?=$dhcp?"checked=\"checked\"":""?>/>
		</td>
		<td valign="top" colspan="3">
			<?=t('Obtain IP-address automatically')?> (DHCP)<br/>&nbsp;
		</td>
	</tr>
	<tr>
		<td valign="top">
			<input type="radio" class="checkbox_radio" name='netcfg' value='static' onclick="static_onclick(<?=$disable_gw?>)" <?=$dhcp?"":"checked=\"checked\""?>/>
		</td>
		<td valign="top" colspan="3">
			<?=t('Use static IP address settings')?>:<p/>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('IP')?>:</td>
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[0]?>' class='ip' name='IP[0]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[1]?>' class='ip' name='IP[1]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[2]?>' class='ip' name='IP[2]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$oip[3]?>' class='ip' name='IP[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_ip?"* " . t("Invalid IP"):""?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Netmask')?>:</td>	
		<td><input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[0]?>' class='ip' name='mask[0]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[1]?>' class='ip' name='mask[1]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[2]?>' class='ip' name='mask[2]' type='text' size='3' maxlength='3'/>.<input <?=$dhcp?"disabled=\"disabled\"":""?> value='<?=$omask[3]?>' class='ip' name='mask[3]' type='text' size='3' maxlength='3'/></td><td><?=$err_mask?"* " . t("Invalid netmask"):""?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Default gateway')?>:</td>	
		<td>
			<input
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
				value='<?=$ogw[0]?>'
				class='ip'
				name='gw[0]'
				type='text' 
				size='3' 
				maxlength='3'
				/>.<input
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
				value='<?=$ogw[1]?>' 
				class='ip' 
				name='gw[1]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>.<input 
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
				value='<?=$ogw[2]?>' 
				class='ip' 
				name='gw[2]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>.<input 
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
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
	<tr>
		<td></td>
		<td><?=t('Primary DNS')?>:</td>	
		<td>
			<input 
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
				value='<?=$odns[0]?>' 
				class='ip' 
				name='dns[0]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>.<input 
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
				value='<?=$odns[1]?>' 
				class='ip' 
				name='dns[1]' 
				type='text' 
				size='3' 
				maxlength='3'
			/>.<input
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
				value='<?=$odns[2]?>' 
				class='ip' 
				name='dns[2]' 
				type='text' 
				size='3'
				maxlength='3'
			/>.<input 
        <?if($disable_gw):?>disabled="disabled"<?endif?> 
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
		<td></td>
		<td><input type="hidden" class='ip' name='refresh' value='3'/><input type="submit" value='<?=t('Update')?>' class='ip' name='update'/></td>	
		<td></td>
		<td></td>
	</tr>
</table>
</form>
</fieldset>

