<? if(!$wlan_configurable): ?>
	<div class="ui-network-information-panel">
		<?=_("These settings are locked")?>&nbsp;.&nbsp;<br />
		<?=_("Either no wireless network card is available or no valid timezone is set")?>
	</div>
<? endif ?>
<form 
	id="wLANCFG" 
	action="<?=FORMPREFIX?>/network/wlanupdate" 
	method="post"
>
<table class="networksettings ui-table-outline">
<tr><td colspan="3" class="ui-state-default ui-widget-header"><?=_("Wireless")?></td></tr>
<tr>
	
	<td class="col2"><label for="enabled"><?=_("Wireless access point")?></label></td>
	<td>
		<input 
			type="checkbox" 
			class="slide"
			name="enabled" 
			id="enabled" 
				disabled="disabled"
			title="<?=sprintf(_("Check this checkbox to enable wireless functionallity for your %s"), NAME)?>"
			<?if($enabled):?>checked="checked"<?endif?>
		/>
	</td>
</tr>

<tr>
	
	<td class="col2"><label for="ssid"><?=_("Network name (SSID)")?></label></td>
	<td>
		<input 
			disabled="disabled" 
			type="text" 
			name="ssid" 
			id="ssid" 
				disabled="disabled"
			title="<?=sprintf(_("The network name (also called SSID) is broadcast by %s and will show up on clients when browsing wireless networks."), NAME)?>"
			value="<?=$ssid?>"
		/>
	</td>
</tr>

<tr>
	
	<td class="col2">
	<label 
		for="password" 
		class="passwordlabel" 
		id="passwordlabel"
	>
		<?=_("Password")?>
	</label>
	</td>
	<td>
	<input disabled="disabled" 
		type="text" 
		class="password"
		name="password" 
		id="password" 
				disabled="disabled"
		title="<?=sprintf(_("The password that will be required to connect to %s wirelessly"), NAME)?>"
		value="<?=htmlentities($encryption_key)?>"
	/>
	</td>
</tr>
</table>

<div class="ui-indent-margin">
	<div class="ui-expandable ui-state-default ui-widget-header ui-div-header"><?=_("Advanced wireless settings")?></div>
	
	<div class="ui-helper-hidden">
		
		<table class="networksettings ui-table-outline">
		
		<tr>
			
			<td class="col2"><label for="band"><?=_("Band")?></label></td>
			<td>
			<input 
				type="radio" 
				class="checkbox_radio"
				name="band" 
				id="band1" 
				disabled="disabled"
				value="1"
				title="<?=_("2.4GHz band used by 802.11g")?>"
		        <?if($current_band == 1):?>checked="checked"<?endif?>
			/>
			<label for="band1" title="<?=_("2.4GHz band used by 802.11g")?>"
		>2.4GHz</label>
			<input 
				type="radio" 
				class="checkbox_radio"
				name="band" 
				id="band2" 
				disabled="disabled"
				value="2"
				title="<?=_("5GHz band used by 802.11a")?>"
		        <?if($current_band == 2):?>checked="checked"<?endif?>
			/>
			<label for="band2" title="<?=_("5GHz band used by 802.11a")?>">5GHz</label>
			</td>
		</tr>
		
		<tr>
			
			<td class="col2"><label for="mode"><?=_("Mode")?></label></td>
			<td>
			<select
				disabled="disabled"
				id="mode"
				name="mode"
				title="<?=_("The operation mode for selected band")?>"
			>
				<option 
					id="mode_legacy" 
					value="legacy" 
					<?if($current_mode == "legacy"):?>selected="selected"<?endif?>
				>
					<?=sprintf(_("Legacy mode (%s)"), $current_band==1?"802.11g":"802.11a")?>
				</option>
				<option 
					id="mode_mixed" 
					value="mixed" 
					<?if($current_mode == "mixed"):?>selected="selected"<?endif?>
				>
					<?=sprintf(_("Mixed mode (802.11n + %s)"), $current_band==1?"802.11g":"802.11a")?>
				</option>
<?/* // Remove from list as it's not supported but current hardware and current driver at all
				<option 
					id="mode_greenfield" 
					value="greenfield" 
					<?if($current_mode == "greenfield"):?>selected="selected"<?endif?>
				>
					<?=_("N only mode (802.11n only)")?>
                </option>
 */?>
			</select>
			</td>
		</tr>
		
		<tr>
			
			<td class="col2"><label for="width"><?=_("Channel width")?></label></td>
			<td>
			<select
				disabled="disabled"
				id="width"
				name="width"
				title="<?=_("The targeted width of the channel in MHz")?>"
			>
				<option id="width_20MHz" value="20" <?if($current_width == "20"):?>selected="selected"<?endif?>>
					<?=_("20MHz")?>
				</option>
				<option id="width_40MHz" value="40" <?if($current_width == "40"):?>selected="selected"<?endif?>>
					<?=_("40MHz")?>
				</option>
			</select>
			</td>
		</tr>

		<tr>
			
			<td class="col2"><label for="encryption"><?=_("Encryption")?></label></td>
			<td><select disabled="disabled" id="encryption" name="encryption" title="<?=_("The encryption to use")?>">
		<?foreach($encryptions as $encryption):?>
        <option value="<?=$encryption?>" <?if($encryption == $current_encryption):?>selected="selected"<?endif?>><?
        switch($encryption) {
        case 'wep':
            echo _('WEP');
            break;
        case 'wpa1':
            echo _('WPA1');
            break;
         case 'wpa2':
            echo _('WPA2');
            break;
        case 'wpa12':
            echo _('WPA1 or WPA2');
            break;
        default:
            echo _('None');
            break;
        }?></option>

		<?endforeach?>
			</select>
			</td>
		</tr>
		
		<tr>
			
			<td class="col2"><label for="channel"><?=_("Channel")?></label></td>
		    <td>
			<select disabled="disabled" id="channel" name="channel" title="<?=_("The main channel to use")?>">
		    </select>
			</td>
		</tr>
		
		<tr>
			
			<td class="col2"><label for="broadcast_ssid"><?=_("Broadcast SSID")?></label></td>
		    <td>
		    <input
		        id="broadcast_ssid"
		        name="broadcast_ssid"
		        title="<?=_("Turning this off hides the network - users have to manually type the SSID on clients")?>"
		        type="checkbox"
				disabled="disabled"
		        class="slide"
		        <?if($broadcast_ssid):?>checked="checked"<?endif?>
		    />
			</td>
		</tr>
		
		</table>
	</div>
</div>

<input
	disabled="disabled"
	type="submit"
	value='<?=_("Update")?>'
	name='update'
/>

</form>

