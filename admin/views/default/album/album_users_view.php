<table id="fn-album-users" class="ui-table ui-table-list ui-table-outline" title="User list">
<thead>
	<tr>
		<th colspan="2" class="ui-state-default ui-widget-header"><?=_("Existing viewers")?></th>
	</tr>
</thead>
<tbody>
</tbody>
<tfoot>
<tr><td colspan="2">
<input type="button" id="fn-album-users-add" value="<?=_("Add viewer")?>" />
</td></tr>
</tfoot>
</table>

<div id="fn-album-dialogs" class="ui-helper-hidden">
<div id="fn-album-users-edit">
<form>
<input type="hidden" name="uid"/>
<h2 class="fn-dialog-header ui-dialog-header"></h2>
	<table>
	<tr>
	   <td><label for="input_username"><?=_("Viewer name")?></label></td>
	   <td><input type="text" name="username"/></td>
	</tr>
	<tr>
	   <td><label for="password1"><?=_("New password")?></label></td>
	   <td><input type="password" name="password1"/></td>
	</tr>
	<tr>
	   <td><label for="password2"><?=_("Confirm password")?></label></td>
	   <td><input type="password" name="password2"/></td>
	</tr>
	</table>
</form>
</div>

</div>
