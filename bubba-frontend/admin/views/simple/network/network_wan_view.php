<fieldset><legend><i><?=t('WAN')?></i></legend>
<form id="WANCFG" action="<?=FORMPREFIX?>/network/wanupdate" method="post">
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
		<input type="radio" name='netcfg' value='dhcp' <?=$dhcp?"checked=\"checked\"":""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Obtain IP-address automatically')?> (DHCP)<br/>&nbsp;
		</td>
	</tr>
	<tr>
		<td valign="top">
			<input type="radio" name='netcfg' value='static' <?=$dhcp?"":"checked=\"checked\""?>/>
		</td>
		<td valign="top" colspan="2">
			<?=t('Use static IP address settings')?>:<p/>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('IP')?>:</td>
		<td><input value='<?=$oip[0]?>' name='IP[0]' type='text' size='3' maxlength='3'/>.<input value='<?=$oip[1]?>' name='IP[1]' type='text' size='3' maxlength='3'/>.<input value='<?=$oip[2]?>' name='IP[2]' type='text' size='3' maxlength='3'/>.<input value='<?=$oip[3]?>' name='IP[3]' type='text' size='3' maxlength='3'/></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Netmask')?>:</td>	
		<td><input value='<?=$omask[0]?>' name='mask[0]' type='text' size='3' maxlength='3'/>.<input value='<?=$omask[1]?>' name='mask[1]' type='text' size='3' maxlength='3'/>.<input value='<?=$omask[2]?>' name='mask[2]' type='text' size='3' maxlength='3'/>.<input value='<?=$omask[3]?>' name='mask[3]' type='text' size='3' maxlength='3'/></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Default gateway')?>:</td>	
		<td><input value='<?=$ogw[0]?>' name='gw[0]' type='text' size='3' maxlength='3'/>.<input value='<?=$ogw[1]?>' name='gw[1]' type='text' size='3' maxlength='3'/>.<input value='<?=$ogw[2]?>' name='gw[2]' type='text' size='3' maxlength='3'/>.<input value='<?=$ogw[3]?>' name='gw[3]' type='text' size='3' maxlength='3'/></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Primary DNS')?>:</td>	
		<td><input value='<?=$odns[0]?>' name='dns[0]' type='text' size='3' maxlength='3'/>.<input value='<?=$odns[1]?>' name='dns[1]' type='text' size='3' maxlength='3'/>.<input value='<?=$odns[2]?>' name='dns[2]' type='text' size='3' maxlength='3'/>.<input value='<?=$odns[3]?>' name='dns[3]' type='text' size='3' maxlength='3'/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="hidden" name='refresh' value='3'/><input type="submit" value='<?=t('Update')?>' name='update'/></td>	
		<td></td>
	</tr>
</table>
</form>
</fieldset>

