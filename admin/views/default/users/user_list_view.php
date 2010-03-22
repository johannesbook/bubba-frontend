<?if($show_allusers):?>
<table id="fn-users-list">
<thead>
<tr>
	<th colspan="4" class="ui-state-default ui-widget-header"><?=t('users-title')?></th>
</tr>
<tr class="ui-header">
   <th><?=t('users-label-username')?></th>
   <th><?=t('users-label-realname')?></th>
   <th><?=t('users-label-shell-login')?></th>
   <th>&nbsp;</th>
</tr>
</thead>
<tbody>
</tbody>
<tfoot>
<?if($show_adduser):?>
<tr><td colspan="4">
<button id="fn-users-list-add"><?=t("users-add-button-label")?></button>
</td></tr>
<?endif?>
</tfoot>
</table>

<?endif?>

<div id="fn-users-dialogs" class="ui-helper-hidden">
<div id="fn-users-list-edit">
<form>
<input type="hidden" name="username"/>
<h2 class="fn-dialog-header ui-dialog-header"></h2>
	<table>
	<tr>
	   <td><label for="username"><?=t('users-list-edit-username-label')?></label></td>
	   <td><input type="text" name="input_username"><span id="fn-user-username-text"></span></td>
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
	   <td><label for="sideboard"><?=t('users-list-edit-sideboard-label')?></label></td>
	   <td><input type="checkbox" name="sideboard"/></td>
	</tr>
	<tr>
	   <td><label for="remote"><?=t('users-list-edit-remote-label')?></label></td>
	   <td><input type="checkbox" name="remote"/></td>
	</tr>
	<tr>
	   <td><label for="shell"><?=t('users-list-edit-shell-label')?></label></td>
	   <td><input type="checkbox" name="shell"/></td>
	</tr>
	</table>
</form>
</div>
</div>
