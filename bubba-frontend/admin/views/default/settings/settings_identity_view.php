
	<form action="<?=FORMPREFIX?>/settings/identity" method="post">
	<table class="networksettings">
	    <tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('settings_identity_title')?></td></tr>
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
		
	</table>
	<input
					type="submit"
					value='<?=t('settings_identity_update_hostname_workgroup_label')?>'
					name='samba_update'
				/>
	</form>

	
	<form action="<?=FORMPREFIX?>/settings/identity" method="post">
	<table class="networksettings">
	    <tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('settings_identity_easyfind_title')?></td></tr>
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

		
	</table>
	<input
					type="submit"
					value='<?=t('settings_identity_update_easyfind_label')?>'
					name='easyfind_update'
				/>
	</form>

