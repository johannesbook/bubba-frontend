<form 
	id="wLANCFG" 
	action="<?=FORMPREFIX?>/network/wlanupdate" 
	method="post"
>
<table class="networksettings ui-table-outline">
<tr><td colspan="3" class="ui-state-default ui-widget-header"><?=t('wlan_title')?></td></tr>
<tr>
	
	<td class="col2"><label for="enabled"><?=t("wlan_title_enable")?></label></td>
	<td>
		<input 
			type="checkbox" 
			class="slide"
			name="enabled" 
			id="enabled" 
				disabled="disabled"
			title="<?=t("wlan_title_enable_popup")?>"
			<?if($enabled):?>checked="checked"<?endif?>
		/>
	</td>
</tr>

<tr>
	
	<td class="col2"><label for="ssid"><?=t("wlan_title_ssid")?></label></td>
	<td>
		<input 
			disabled="disabled" 
			type="text" 
			name="ssid" 
			id="ssid" 
				disabled="disabled"
			title="<?=t("wlan_title_ssid_popup")?>"
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
		<?=t("wlan_title_password")?>
	</label>
	</td>
	<td>
	<input disabled="disabled" 
		type="text" 
		class="password"
		name="password" 
		id="password" 
				disabled="disabled"
		title="<?=t("wlan_title_password_popup")?>"
		value="<?=htmlentities($encryption_key)?>"
	/>
	</td>
</tr>
</table>

<div class="ui-indent-margin">
	<div class="ui-expandable ui-state-default ui-widget-header ui-div-header"><?=t('wlan_title_advanced')?></div>
	
	<div class="ui-helper-hidden">
		
		<table class="networksettings ui-table-outline">
		
		<?if($allow_change):?>
		<tr>
			
			<td class="col2"><label for="band"><?=t("wlan_title_band")?></label></td>
			<td>
			<input 
				type="radio" 
				class="checkbox_radio"
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
				class="checkbox_radio"
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
			
			<td class="col2"><label for="mode"><?=t("wlan_title_mode")?></label></td>
			<td>
			<select
				disabled="disabled"
				id="mode"
				name="mode"
				title="<?=t("wlan_title_mode_popup")?>"
			>
				<option 
					id="mode_legacy" 
					value="legacy" 
					<?if($current_mode == "legacy"):?>selected="selected"<?endif?>
				>
					<?=t("wlan_title_legacy_mode_$current_band")?>
				</option>
				<option 
					id="mode_mixed" 
					value="mixed" 
					<?if($current_mode == "mixed"):?>selected="selected"<?endif?>
				>
					<?=t("wlan_title_mixed_mode_$current_band")?>
				</option>
				<option 
					id="mode_greenfield" 
					value="greenfield" 
					<?if($current_mode == "greenfield"):?>selected="selected"<?endif?>
				>
					<?=t("wlan_title_greenfield_mode")?>
				</option>
			</select>
			</td>
		</tr>
		
		<tr>
			
			<td class="col2"><label for="width"><?=t("wlan_title_width")?></label></td>
			<td>
			<select
				disabled="disabled"
				id="width"
				name="width"
				title="<?=t("wlan_title_width_popup")?>"
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
		
		<?else:?>
		
		<input type="hidden" name="band" id="band" value="1" />
		<input type="hidden" name="mode" id="mode" value="legacy" />
		<input type="hidden" name="width" id="width" value="20" />
		
		<?endif?>
		
		<tr>
			
			<td class="col2"><label for="encryption"><?=t("wlan_title_encryption")?></label></td>
			<td><select disabled="disabled" id="encryption" name="encryption" title="<?=t("wlan_title_encryption_popup")?>">
		<?foreach($encryptions as $encryption):?>
			<option value="<?=$encryption?>" <?if($encryption == $current_encryption):?>selected="selected"<?endif?>><?=t("wlan_title_encryption_$encryption")?></option>
		<?endforeach?>
			</select>
			</td>
		</tr>
		
		<tr>
			
			<td class="col2"><label for="channel"><?=t("wlan_title_channel")?></label></td>
		    <td>
			<select disabled="disabled" id="channel" name="channel" title="<?=t("wlan_title_channel_popup")?>">
		    </select>
			</td>
		</tr>
		
		<tr>
			
			<td class="col2"><label for="broadcast_ssid"><?=t("wlan_title_broadcast")?></label></td>
		    <td>
		    <input
		        id="broadcast_ssid"
		        name="broadcast_ssid"
		        title="<?=t("wlan_title_broadcast_popup")?>"
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
	value='<?=t('Update')?>'
	name='update'
/>

</form>

