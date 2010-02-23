
<fieldset><legend><?=t("settings_identity_title")?></legend>
	<form action="<?=FORMPREFIX?>/settings/identity" method="post">
	<table class="networksettings">
		<tr>
			<td></td>
			<td><?=t('settings_identity_hostname_label')?>:</td>
			<td>
				<input
					type="text"
					name="hostname"
					size="10"
					value="<?=$hostname?>"
				/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><?=t('settings_identity_workgroup_label')?>:</td>
			<td>
				<input
					type="text"
					name="workgroup"
					size="10"
					value="<?=$workgroup?>"
				/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input
					type="submit"
					value='<?=t('settings_identity_update_hostname_workgroup_label')?>'
					name='samba_update'
				/>
			</td>	
			<td></td>
		</tr>
	</table>
	</form>
	</fieldset>
	<fieldset><legend><?=t("settings_identity_easyfind_title")?></legend>
	<form action="<?=FORMPREFIX?>/settings/identity" method="post">
	<table class="networksettings">
		<tr>
			<td></td>
			<td><?=t('settings_identity_easyfind_message')?>:</td>
			<td>
				<input
					id="easyfind_enabled"
					type="checkbox"
					class="checkbox_radio"
					name="easyfind_enabled"
					<?if($easyfind_enabled):?>checked="checked"<?endif?>

				/>
			</td>


		</tr>
		<tr>
			<td></td>
			<td><?=t('Easyfind name')?>:</td>
			<td>
				<input
					id="easyfind_name"
					type="input"
					name="easyfind_name"
					value="<?=$easyfind?>"
					<?if(!$easyfind_enabled):?>disabled="disabled"<?endif?>

				/>
		</tr>

		<tr>
			<td></td>
			<td>
				<input
					type="submit"
					value='<?=t('settings_identity_update_easyfind_label')?>'
					name='easyfind_update'
				/>
			</td>	
			<td></td>
		</tr>
	</table>
	</form>
</fieldset>

