<? if(!$tor_configurable): ?>
	<div class="ui-network-information-panel">
		<?=_("These settings are locked.")?><br />
		<?=_("No valid timezone set.")?>
	</div>
<? endif ?>

<!-- Below is the section where the user can enable or disable Tor -->

<form id="TorCFG" action="<?=FORMPREFIX?>/ajax_network/tor_update" method="post">

<table class="networksettings ui-table-outline ui-table-form">
<tr><td colspan="3" class="ui-state-default ui-widget-header"><?=_('Allow your B3 to contribute to the Tor network')?></td></tr>

<tr>
	<td class="col2"><label for="enabled"><?=_("Enable Tor")?></label></td>
	<td>
		<input
			type="checkbox"
			class="slide"
			name="enabled"
			id="enabled"
			title="<?=_("Switch to enable or disable the Tor bridge or Relay in B3")?>"
			<?if($enabled):?>checked="checked"<?endif?>
            <?if(!$tor_configurable):?>disabled="disabled"<?endif?>
		/>
	</td>
</tr>

<tr>
	<td class="col2"><label for="nickname"><?=_("Nickname")?></label></td>
	<td>
		<input
			type="text"
			name="nickname"
			id="nickname"
			title="<?=_("Set a unique nickname for your Tor bridge or relay")?>"
			value="<?=$nickname?>"
		/>
	</td>
</tr>
<tr>
	<td class="col2"><label for="contact"><?=_("Contact information")?></label></td>
	<td>
		<input
			type="text"
			name="contact"
			id="contact"
			title="<?=_("Enter contact information in case the developers need to contact you about problems")?>"
			value="<?=$contact?>"
		/>
	</td>
</tr>
</table>

<!-- Below is the configuration section -->

<div class="ui-expandable ui-state-default ui-widget-header ui-div-header"><?=_('Advanced Tor settings')?></div>
<div class="ui-helper-hidden">
<table class="ui-table-outline">

<tr>
	<td class="col2"><label for="choose"><?=_("Run Tor as")?></label></td>
	<td>
		<select name="tor_type" id="tor_type">
<?foreach(array('bridge', 'non_exit', 'exit') as $t ):?>
			<option value="<?=$t?>" <?if($t == $type):?>selected="selected"<?endif?>>
<?if($t == "bridge"):?>
				<?=_("Bridge")?>
<?elseif($t == "non_exit"):?>
				<?=_("Non-exit node")?>
<?else:?>
				<?=_("Exit node")?>
<?endif?>
			</option>
<?endforeach?>
		</select>
	</td>
</tr>

<!-- If Tor is a bridge, show the bridge IP:Port in the field below -->

<tr>
    <td class="col2">
        <label><?=_("Bridge address")?></label>
        <div class="ui-text-comment"><?=_("Let others access your bridge by giving them this line")?></div>
    </td>
    <td><div class="ro-text-field"><tt><?=$bridge_address?></tt></div></td>
</tr>

<tr>
	<td class="col2"><label for="relay_port"><?=_("Relay port")?></label></td>
	<td>
		<input
			type="text"
			name="relay_port"
			id="relay_port"
			title="<?=_("What port to advertise for incoming Tor connections")?>"
			value="<?=$relay_port?>"
		/>
	</td>
</tr>
<tr>
	<td class="col2"><label for="dir_port"><?=_("Directory port")?></label>
    </td>
	<td>
		<input
			type="text"
			name="dir_port"
			id="dir_port"
			title="<?=_("What port to use when mirroring directory information")?>"
            value="<?=$dir_port?>"
            <?if($type=='bridge'):?>disabled="disabled"<?endif?>
		/>
	</td>
</tr>

<tr>
	<td class="col2"><label for="public_bridge"><?=_("Automatically distribute my bridge address")?></label></td>
	<td>
		<input
			type="checkbox"
			class="slide"
			name="public_bridge"
			id="public_bridge"
			value="public"
            <?if($public_bridge):?>checked="checked"<?endif?>
		/>
	</td>
</tr>

<tr>
	<td class="col2"><label for="defined_bandwidth"><?=_("Bandwidth limits")?></label></td>
	<td>
		<select name="defined_bandwidth" id="defined_bandwidth">
        <option value="256" <?if($bwtype=='256'):?>selected="selected"<?endif?>><?=pgettext("bwlimit","Cable/DSL 256 Kbps")?></option>
			<option value="512" <?if($bwtype=='512'):?>selected="selected"<?endif?>><?=pgettext("bwlimit","Cable/DSL 512 Kbps")?></option>
			<option value="768" <?if($bwtype=='768'):?>selected="selected"<?endif?>><?=pgettext("bwlimit","Cable/DSL 768 Kbps")?></option>
			<option value="t1" <?if($bwtype=='t1'):?>selected="selected"<?endif?>><?=pgettext("bwlimit","T1/Cable/DSL 1.5 Mbps")?></option>
			<option value="highbw" <?if($bwtype=='highbw'):?>selected="selected"<?endif?>><?=pgettext("bwlimit","&gt; 1.5 Mbps")?></option>
			<option value="custom" <?if($bwtype=='custom'):?>selected="selected"<?endif?>><?=pgettext("bwlimit","Custom")?></option>
		</select>
	</td>
</tr>

<tr>
	<td class="col2"><label for="bandwidth_limits"><?=_("Custom bandwidth limits")?></label>
	<div class="ui-text-comment"><?=_("If you wish to configure custom bandwidth limits, choose \"Custom\" from the dropdown above")?></div> </td>
	<td class="ui-cell-table">
    <table class="inline">
    <tr>
    <td class="col2">
		<input
			type="text"
			name="bandwidth_rate"
			id="bandwidth_rate"
			title="<?=_("For Internet connections with fast download speed but slow upload speed, please select your upload speed here")?>"
			value="<?=$bandwidth_rate?>"
            <?if($bwtype!='custom'):?>disabled="disabled"<?endif?>
		/> (<?=_("Bandwidth rate")?>)
    </td>
    <td class="col2">
		<input
			type="text"
			name="bandwidth_burst"
			id="bandwidth_burst"
			title="<?=_("For Internet connections with fast download speed but slow upload speed, please select your upload speed here")?>"
			value="<?=$bandwidth_burst?>"
            <?if($bwtype!='custom'):?>disabled="disabled"<?endif?>
		/> (<?=_("Bandwidth burst")?>)
    </td>
    </tr>
    </table>
	</td>
</tr>

<tr>
	<td colspan="1"><label for="exit_policies"><?=_("Exit policies")?></label></td>
	<td class="ui-cell-table">
    <table class="inline">
<?foreach(array_chunk($exit_policies, 2, true) as $row):?>
        <tr>
<?foreach($row as $cell => $active):?>
        <td class="col2">
        <input
            type="checkbox"
            class="fn_exit_policies slide"
            name="exit_policy[]"
            id="exit_policy_<?=$cell?>"
            value="<?=$cell?>"
            <?if($active):?>checked="checked"<?endif?>
            <?if($type!='exit'):?>disabled="disabled"<?endif?>
        />
		<label for="exit_policy_<?=$cell?>">
<?if($cell=="http"):?>
			<?=pgettext("label", "Websites")?>
<?elseif($cell=="https"):?>
			<?=pgettext("label", "Secure websites (SSL)'")?>
<?elseif($cell=="mail"):?>
			<?=pgettext("label", "Retrieve Mail (POP, IMAP)'")?>
<?elseif($cell=="im"):?>
			<?=pgettext("label", "Instant Messaging (IM)")?>
<?elseif($cell=="irc"):?>
			<?=pgettext("label", "Internet Relay Chat (IRC)")?>
<?else:?>
			<?=pgettext("label", "Misc Other Services")?>
<?endif?>
		</label>
        </td>
<?endforeach?>
        </tr>
<?endforeach?>
    </table>
    </td>
</tr>

</table>
</div>

<button class="submit" id="fn-settings-update"><?=_('Update')?></button>
<input type="hidden" name="update" id="fn-settings-input-update" value=""/>

</form>
