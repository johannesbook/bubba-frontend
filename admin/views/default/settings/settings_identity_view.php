
	<form action="<?=FORMPREFIX?>/settings/identity" method="post">
	<table class="networksettings ui-table-two-col ui-table-outline">
		<thead>
		<tr><td colspan="2" class="ui-state-default ui-widget-header"><?=_("System identity")?></td></tr>
		</thead>
		<tbody>
		<tr>
			
			<td><?=_("Hostname")?>:</td>
			<td>
				<input
					type="text"
					name="hostname"
					value="<?=$hostname?>"
				/>
			</td>
		</tr>
		<tr>
			
			<td><?=_("Workgroup")?>:</td>
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
					value='<?=_("Update hostname and workgroup")?>'
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
	    <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=_("Easyfind options")?></td></tr>
		</thead>
		<tbody>
		<tr>
			
			<td><?=_("'Easyfind' location service")?>:</td>
			<td>
				<input
					id="easyfind_enabled"
					type="checkbox"
					class="slide"
					name="easyfind_enabled"
					<?if(isset($easyfind['name']) && $easyfind['name'] ):?>checked="checked"<?endif?>

				/>
			</td>


		</tr>
		<tr>
			
			<td><?=_('Easyfind name')?>:</td>
			<?
			if(isB3()) {
				$e_domain = B3_EASYFINDDOMAIN;
			} else {
				$e_domain = DEFAULT_EASYFINDDOMAIN;
			}
			if(isset($easyfind['name']) && $easyfind['name']) {
				$e_name = $easyfind['name'];
			} else {
				$e_name = _("your-easyfind-name");
			}
			?>
			<td>
				<input
					id="easyfind_name"
					type="text"
					name="easyfind_name"
					value="<?=$e_name?>"
					<?if(! (isset($easyfind['name']) && $easyfind['name']) ):?>disabled="disabled"<?endif?>

				/>
				<br>(http://<span id="fn-settings-easyfind-url"><?=$e_name?></span>.<?=$e_domain?>)</br>
			</td>
		</tr>

		</tbody>
		<tfoot>
		<tr>
		<td colspan="2">
			<input
					type="submit"
					value='<?=_("Update Easyfind")?>'
					name='easyfind_update'
			/>
		</td>
		</tr>
		</tfoot>
		
	</table>
	</form>

