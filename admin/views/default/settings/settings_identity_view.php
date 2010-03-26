
	<form action="<?=FORMPREFIX?>/settings/identity" method="post">
	<table class="networksettings ui-table-two-col ui-table-outline">
		<thead>
		<tr><td colspan="2" class="ui-state-default ui-widget-header"><?=t('settings_identity_title')?></td></tr>
		</thead>
		<tbody>
		<tr>
			
			<td><?=t('settings_identity_hostname_label')?>:</td>
			<td>
				<input
					type="text"
					name="hostname"
					value="<?=$hostname?>"
				/>
			</td>
		</tr>
		<tr>
			
			<td><?=t('settings_identity_workgroup_label')?>:</td>
			<td>
				<input
					type="text"
					name="workgroup"
					value="<?=$workgroup?>"
				/>
			</td>
		</tr>
		</tbody>
		<tfoot>
		<tr>
		<td colspan="2">
			<input
					type="submit"
					value='<?=t('settings_identity_update_hostname_workgroup_label')?>'
					name='samba_update'
			/>
		</td>
		</tr>
		</tfoot>
	</table>
	</form>

	
	<form action="<?=FORMPREFIX?>/settings/identity" method="post">
	<table class="networksettings ui-table-two-col ui-table-outline" id="settings_easyfind">
		<thead>
	    <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=t('settings_identity_easyfind_title')?></td></tr>
		</thead>
		<tbody>
		<tr>
			
			<td><?=t('settings_identity_easyfind_message')?>:</td>
			<td>
				<input
					id="easyfind_enabled"
					type="checkbox"
					class="slide"
					name="easyfind_enabled"
					<?if($easyfind_enabled):?>checked="checked"<?endif?>

				/>
			</td>


		</tr>
		<tr>
			
			<td><?=t('Easyfind name')?>:</td>
			<td>
				<input
					id="easyfind_name"
					type="text"
					name="easyfind_name"
					value="<?=$easyfind?>"
					<?if(!$easyfind_enabled):?>disabled="disabled"<?endif?>

				/>
		</tr>

		</tbody>
		<tfoot>
		<tr>
		<td colspan="2">
			<input
					type="submit"
					value='<?=t('settings_identity_update_easyfind_label')?>'
					name='easyfind_update'
			/>
		</td>
		</tr>
		</tfoot>
		
	</table>
	</form>

