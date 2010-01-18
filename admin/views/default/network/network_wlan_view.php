<fieldset><legend><i><?=t('wLAN')?></i></legend>
<form id="wLANCFG" action="<?=FORMPREFIX?>/network/wlanupdate" method="post">
<table class="networksettings">
<tr>
	<td><label for="ssid"><?=t("SSID")?></label></td>
	<td><input disabled="disabled" type="text" name="ssid" id="ssid" value="<?=$ssid?>"/></td>
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
	<input disabled="disabled" 
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
	<td><input disabled="disabled" type="checkbox" name="enabled" id="enabled" <?if($enabled):?>checked="checked"<?endif?>/></td>
</tr>
</table>

<fieldset class="expandable collapsed">
<legend><i><?=t("Advanced")?></i></legend>
<div>

<table class="networksettings">
<tr>
	<td><label for="band"><?=t("Band")?></label></td>
	<td>
	<input 
		type="radio" 
		name="band" 
		id="band1" 
		disabled="disabled"
		value="1"
		title="<?=t("wlan_title_band_1")?>"
        <?if($current_band == 1):?>checked="checked"<?endif?>
	/>
	<label for="band1" title="<?=t("wlan_title_band_2_4")?>"
>2.4GHz</label>
	<input 
		type="radio" 
		name="band" 
		id="band2" 
		disabled="disabled"
		value="2"
		title="<?=t("wlan_title_band_2")?>"
        <?if($current_band == 2):?>checked="checked"<?endif?>
	/>
	<label for="band2" title="<?=t("wlan_title_band_5_0")?>">5GHz</label>
	</td>
</tr>
<tr>
	<td><label for="mode"><?=t("Mode")?></label></td>
	<td>
	<select
		disabled="disabled"
		id="mode"
		name="mode"
		title="<?=t("The operation mode for selected band")?>"
	>
		<option id="mode_legacy" value="legacy" <?if($current_mode == "legacy"):?>selected="selected"<?endif?>>
			<?=t("wlan_title_legacy_mode_$current_band")?>
		</option>
		<option id="mode_mixed" value="mixed" <?if($current_mode == "mixed"):?>selected="selected"<?endif?>>
			<?=t("wlan_title_mixed_mode_$current_band")?>
		</option>
		<option id="mode_greenfield" value="greenfield" <?if($current_mode == "greenfield"):?>selected="selected"<?endif?>>
			<?=t("wlan_title_greenfield_mode")?>
		</option>
	</select>
	</td>
</tr>
<tr>
	<td><label for="width"><?=t("Channel width")?></label></td>
	<td>
	<select
		disabled="disabled"
		id="width"
		name="width"
		title="<?=t("The targeted width of the channel in MHz")?>"
	>
		<option id="width_20MHz" value="20" <?if($current_width == "20"):?>selected="selected"<?endif?>>
			<?=t("wlan_title_width_20MHz")?>
		</option>
		<option id="width_40MHz" value="40" <?if($current_width == "40"):?>selected="selected"<?endif?>>
			<?=t("wlan_title_width_40MHz")?>
		</option>
	</select>
	</td>
</tr>
<tr>
	<td><label for="encryption"><?=t("Encryption")?></label></td>
	<td><select disabled="disabled" id="encryption" name="encryption" title="<?=t("The encryption to use")?>">
<?foreach($encryptions as $encryption):?>
	<option value="<?=$encryption?>" <?if($encryption == $current_encryption):?>selected="selected"<?endif?>><?=t("wlan_title_encryption_$encryption")?></option>
<?endforeach?>
	</select>
	</td>
</tr>

<tr>
	<td><label for="channel"><?=t("Channel")?></label></td>
    <td>
	<select disabled="disabled" id="channel" name="channel" title="<?=t("The channel to use")?>">
    </select>
	</td>
</tr>
<tr>
	<td><label for="broadcast_ssid"><?=t("Broadcast SSID")?></label></td>
    <td>
    <input
        disabled="disabled"
        id="broadcast_ssid"
        name="broadcast_ssid"
        title="<?=t("Whenever to broadcast the SSID")?>"
        type="checkbox"
        <?if($broadcast_ssid):?>checked="checked"<?endif?>
    />
	</td>
</tr>

</table>

</div>
</fieldset>

<input disabled="disabled" type="submit" value='<?=t('Update')?>' name='update'/>

</form>
</fieldset>

