<div id="fn-filemanager-information-panel" class="ui-helper-hidden ui-filemanager-information-panel"></div>
<div id="fn-filemanager-action-panel" class="ui-helper-hidden ui-action-panel"></div>

<table id="filetable" class="ui-table-outline">
	<thead>
		<tr class="ui-state-default ui-widget-header">
			<th></th>
			<th><?=_("Name")?></th>
			<th><?=_("Date")?></th>
			<th><?=_("Size")?></th>
			<th></th>
		</tr>
		<tr class="ui-header">
			<td colspan="5" class="ui-filemanager-fake-updir"></td>
		</tr>
		<tr>
		<td colspan="5" class="ui-helper-hidden ui-filemanager-permission-denied"><?=_("Permission denied")?></td>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>

<div id="fn-dialogs" class="ui-helper-hidden">

<div id="fn-filemanager-perm-dialog">
<h2 class="ui-text-center"><?=_("Change permissions")?></h2>
<form id="fn-filemanager-perm">
<table>
	<tr>
        <th><?=_("Owner")?></th>
        <td>
        	<select name="permission-owner" id="fn-filemanager-perm-permission-owner">
			<option value="rw"><?=_('Read and write')?></option>
			<option value="r"><?=_('Read only')?></option>
        	</select>
        </td>
	</tr>		
    <tr>
        <th><?=sprintf(_("%s users"), NAME)?></th>
        <td>
        	<select name="permission-group" id="fn-filemanager-perm-permission-group">
			<option value="rw"><?=_('Read and write')?></option>
			<option value="r"><?=_('Read only')?></option>
			<option value="n"><?=_('No access')?></option>
        	</select>
        </td>
    </tr>
    <tr>
        <th><?=_("Not logged in")?></th>
        <td>
        	<select name="permission-other" id="fn-filemanager-perm-permission-other">
			<option value="rw"><?=_('Read and write')?></option>
			<option value="r"><?=_('Read only')?></option>
			<option value="n"><?=_('No access')?></option>
        	</select>
        </td>
    </tr>
</table>
</form>
</div>

<div id="fn-filemanager-mkdir-dialog">
<h2 class="ui-text-center"><?=_("Create a new folder")?></h2>
<form id="fn-filemanager-mkdir">
<table>
<tr>
<td colspan="2">
<label for="name"><?=_("Name")?>:</label>
<input type="text" id="fn-filemanager-mkdir-name" name="name" class="ui-input-text fn-primary-field"/></td>
</tr>
</table>
</form>
</div>

<div id="fn-filemanager-rename-dialog">
    <h2 class="ui-text-center"><?=_("Rename")?></h2>
    <form id="fn-filemanager-rename">
    <table>
        <tr>
            <td>
                <label for="name"><?=_("Name")?>:</label>
                <input type="text" id="fn-filemanager-rename-name" name="name" class="ui-input-text fn-primary-field"/>
            </td>
        </tr>
    </table>
    </form>
</div>

<div id="fn-filemanager-delete-dialog">
    <h2><?=_("Delete selected files and/or folders?")?></h2>
</div>
<div id="fn-filemanager-album-dialog">
    <h2><?=_("Add selected images/folders to photo album?")?></h2>
</div>
</div>
