
	<h1 class="wizard-header">
		<?=t('Step 2/3: Create users')?>
	</h1>
<div id="ui-wizard-adduser">
<table>
<tr>
<td>
	<form id="fn-wizard-add">
	<table>
	<thead>
	<tr>
		<th colspan="2" class="ui-state-default ui-widget-header"><?=t("Add users")?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	   <td><label for="username"><?=t('users-list-edit-username-label')?></label></td>
	   <td><input type="text" name="username"/></td>
	</tr>
	<tr>
	   <td><label for="realname"><?=t('users-list-edit-realname-label')?></label></td>
	   <td><input type="text" name="realname"/></td>
	</tr>
	<tr>
	   <td><label for="password1"><?=t('users-list-edit-password1-label')?></label></td>
	   <td><input type="password" name="password1"/></td>
	</tr>
	<tr>
	   <td><label for="password2"><?=t('users-list-edit-password2-label')?></label></td>
	   <td><input type="password" name="password2"/></td>
	</tr>
	<tr>
	   <td><label for="shell"><?=t('users-list-edit-shell-label')?></label></td>
	   <td><input type="checkbox" name="shell"/></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input id="users_wizard_add" class='submitbutton' type='submit' name='wiz_data[adduser]' value='<?=t('Add user')?>'/>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2">
		</td>
	</tr>
	</tbody>
	</table>
	</form>
	<form id="fn-wizard" action="<?=FORMPREFIX?>/users/wizard" method="post">
	<div class="ui-wizard-controls">
		<input class='ui-wizard-prev' type='submit' name='wiz_data[back]' value='<?=t('Back')?>'/>
		<input class='ui-wizard-exit' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/>
		<input class='ui-wizard-next' type='submit' name="wiz_data[postingpage]" value='<?=t('Next')?>'/>
	</div>
	</form>
</td>
<td>

	<div id="ui-wizard-userlist" class="ui-infobox">
	<table>
	<thead>
	<tr><th colspan="2" class="ui-header"><?=t("Existing users")?></th></tr>	
	<tr><th><?=t("Username")?></th><th><?=t("Real name")?></th></tr>	
	</thead>
	<tbody id="wizard_ulist">
	<?foreach($wiz_data['ulist'] as $user => $udata):?>
	<tr>
		<td><?=$udata['username']?></td>
		<td><?=$udata['realname']?></td>
	</tr>
	<?endforeach?>
	</tbody>
	</table>
	</div>
</td>
</tr>
</table>
</div>
