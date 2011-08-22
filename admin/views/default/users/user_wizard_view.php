
	<h1 class="wizard-header">
		<?=_("Step 3/4: Create users")?>
	</h1>
<div id="ui-wizard-adduser">
	<form id="fn-wizard-add">
		<table>
		<thead>
			<tr class="ui-wizard-label-header">
				<th colspan="2"><h2><?=_("New user")?></h2></th>
				<th><h2><?=_("Existing users")?></h2></th>
			</tr>
		</thead>
		<tbody>
			<tr class="ui-header">
			   <td><label for="username"><?=_("User name")?></label></td>
			   <td><input type="text" name="username"/></td>
			   <td rowspan="6" class="ui-wizard-existing-users">
					<div id="ui-wizard-userlist" class="ui-infobox">
					<table>
					<thead>
					<tr><th><?=_("Username")?></th><th><?=_("Real name")?></th></tr>
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
			<tr class="ui-header">
			   <td><label for="realname"><?=_("Real name")?></label></td>
			   <td><input type="text" name="realname"/></td>
			</tr>
			<tr class="ui-header">
			   <td><label for="password1"><?=_("New password")?></label></td>
			   <td><input type="password" name="password1"/></td>
			</tr>
			<tr class="ui-header">
			   <td><label for="password2"><?=_("Confirm password")?></label></td>
			   <td><input type="password" name="password2"/></td>
			</tr>
<? /*
			<tr class="ui-header">
			   <td><label for="shell"><?=_("Shell login")?></label></td>
			   <td><input type="checkbox" name="shell"/></td>
			</tr>
*/ ?>
			<tr class="ui-header">
				<td></td>
				<td>
					<input id="users_wizard_add" class='submitbutton' type='submit' name='wiz_data[adduser]' value='<?=_('Add user')?>'/>
				</td>
			</tr>
		</tbody>
		</table>
	</form>

<form id="fn-wizard" action="<?=FORMPREFIX?>/users/wizard" method="post">
	<div class="ui-wizard-controls">
		<input class='ui-wizard-prev' type='submit' name='wiz_data[back]' value='<?=_("Back")?>'/>
		<input class='ui-wizard-exit' type='submit' name='wiz_data[cancel]' value='<?=_('Exit setup')?>'/>
		<input class='ui-wizard-next' type='submit' name="wiz_data[postingpage]" value='<?=_("Next")?>'/>
	</div>
	</form>
</div>
