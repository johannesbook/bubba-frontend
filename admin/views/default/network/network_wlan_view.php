<fieldset><legend><i><?=t('wLAN')?></i></legend>
<form id="wLANCFG" action="<?=FORMPREFIX?>/network/wlanupdate" method="post">
<table>
<tr>
	<td><label for="ssid"><?=t("SSID")?></label></td>
	<td><input type="text" name="ssid" id="ssid" value="<?=$ssid?>"/></td>
</tr>
<tr>
	<td>
	<label 
		for="password" 
		class="passwordlabel" 
		id="passwordlabel"
	>
		<?=t("wlan_pw_label_encryption")?>
	</label>
	</td>
	<td>
	<input 
		type="text" 
		class="password"
		name="password" 
		id="password" 
		value="<?=$encryption_key?>"
	/>
	</td>
</tr>
<tr>
	<td><label for="enabled"><?=t("Enabled")?></label></td>
	<td><input type="checkbox" name="enabled" id="enabled" <?if($enabled):?>checked="checked"<?endif?>/></td>
</tr>
</table>

<fieldset class="expandable collapsed">
<legend><i><?=t("Advanced")?></i></legend>
<div>

<table>
<tr>
	<td><label for="mode"><?=t("Type")?></label></td>
	<td><select id="mode" name="mode"  title="<?=t("The mode of wLAN to use")?>">
<?foreach($modes as $mode):?>
	<option value="<?=$mode?>" <?if($mode == $current_mode):?>selected="selected"<?endif?>><?=t("wlan_title_mode_$mode")?></option>
<?endforeach?>
	</select>
	</td>
</tr>
<tr>
	<td><label for="encryption"><?=t("Encryption")?></label></td>
	<td><select id="encryption" name="encryption" title="<?=t("The encryption to use")?>">
<?foreach($encryptions as $encryption):?>
	<option value="<?=$encryption?>" <?if($encryption == $current_encryption):?>selected="selected"<?endif?>><?=t("wlan_title_encryption_$encryption")?></option>
<?endforeach?>
	</select>
	</td>
</tr>

<tr>
	<td><label for="channel"><?=t("Channel")?></label></td>
    <td>
    <select id="channel" name="channel" title="<?=t("The channel to use")?>">
<?foreach($bands as $band => $channels):?>
    <optgroup label="Band <?=$band?>">
<?foreach($channels as $channel):?>
	    <option value="<?=$channel?>" <?if($channel == $current_channel):?>selected="selected"<?endif?>><?=t("wlan_title_channel", $channel)?></option>
<?endforeach?>
    </optgroup>
<?endforeach?>
    </select>
	</td>
</tr>

</table>

</div>
</fieldset>

<input type="submit" value='<?=t('Update')?>' name='update'/>

</form>
</fieldset>

