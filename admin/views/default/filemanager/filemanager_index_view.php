<div id="fn-filemanager-information-panel" class="ui-helper-hidden ui-filemanager-information-panel"></div>
<div id="fn-filemanager-action-panel" class="ui-helper-hidden ui-action-panel"></div>

<table id="filetable">
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Date</th>
			<th>Size</th>
			<th></th>
		</tr>
		<tr class="ui-header">
			<td colspan="5" class="ui-filemanager-fake-updir"></td>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>

<div id="fn-dialogs" class="ui-helper-hidden">

<div id="fn-filemanager-perm-dialog">
<h2 class="ui-text-center"><?=t('filemanager-permission-dialog-title')?></h2>
<form id="fn-filemanager-perm">
<table>
    <tr>
        <th><?=t('filemanager-label-permission-owner')?></th>
        <td class="fn-buttonset" colspan="2">        
        <input type="checkbox" id="fn-filemanager-perm-permission-owner-read" name="permission-owner-read"/>
        <label for="fn-filemanager-perm-permission-owner-read"><?=t("filemanager-label-permission-owner-read")?></label>
        <input type="checkbox" id="fn-filemanager-perm-permission-owner-write" name="permission-owner-write"/>
        <label for="fn-filemanager-perm-permission-owner-write"><?=t("filemanager-label-permission-owner-write")?></label>
        <input type="checkbox" id="fn-filemanager-perm-permission-owner-execute" name="permission-owner-execute"/>
        <label for="fn-filemanager-perm-permission-owner-execute"><?=t("filemanager-label-permission-owner-execute")?></label>
        </td>
    </tr>
    <tr>
        <th><?=t('filemanager-label-permission-group')?></th>
        <td class="fn-buttonset">
        <input type="checkbox" id="fn-filemanager-perm-permission-group-read" name="permission-group-read"/>
        <label for="fn-filemanager-perm-permission-group-read"><?=t("filemanager-label-permission-group-read")?></label>
        <input type="checkbox" id="fn-filemanager-perm-permission-group-write" name="permission-group-write"/>
        <label for="fn-filemanager-perm-permission-group-write"><?=t("filemanager-label-permission-group-write")?></label>
        <input type="checkbox" id="fn-filemanager-perm-permission-group-execute" name="permission-group-execute"/>
        <label for="fn-filemanager-perm-permission-group-execute"><?=t("filemanager-label-permission-group-execute")?></label>
        </td>
    </tr>
    <tr>
        <th><?=t('filemanager-label-permission-other')?></th>
        <td class="fn-buttonset">
        <input type="checkbox" id="fn-filemanager-perm-permission-other-read" name="permission-other-read"/>
        <label for="fn-filemanager-perm-permission-other-read"><?=t("filemanager-label-permission-other-read")?></label>
        <input type="checkbox" id="fn-filemanager-perm-permission-other-write" name="permission-other-write"/>
        <label for="fn-filemanager-perm-permission-other-write"><?=t("filemanager-label-permission-other-write")?></label>
        <input type="checkbox" id="fn-filemanager-perm-permission-other-execute" name="permission-other-execute"/>
        <label for="fn-filemanager-perm-permission-other-execute"><?=t("filemanager-label-permission-other-execute")?></label>
        </td>
    </tr>
</table>
</form>
</div>

<div id="fn-filemanager-mkdir-dialog">
<h2 class="ui-text-center"><?=t('filemanager-mkdir-dialog-title')?></h2>
<form id="fn-filemanager-mkdir">
<table>
<tr>
<td colspan="2">
<label for="name"><?=t('filemanager-label-name')?>:</label>
<input type="text" id="fn-filemanager-mkdir-name" name="name" class="ui-input-text fn-primary-field"/></td>
</tr>
<tr>
<th colspan="2"><?=t('filemanager-title-permissions')?></th>
</tr>
<tr>
<th><?=t('filemanager-label-permission-owner')?></th>
<td class="fn-buttonset">
<input type="checkbox" id="fn-filemanager-mkdir-permission-owner-read" name="permission-owner-read" checked="checked"/>
<label for="fn-filemanager-mkdir-permission-owner-read"><?=t("filemanager-label-permission-owner-read")?></label>
<input type="checkbox" id="fn-filemanager-mkdir-permission-owner-write" name="permission-owner-write" checked="checked"/>
<label for="fn-filemanager-mkdir-permission-owner-write"><?=t("filemanager-label-permission-owner-write")?></label>

</td>
</tr>
<tr>
<th><?=t('filemanager-label-permission-group')?></th>
<td class="fn-buttonset">
<input type="checkbox" id="fn-filemanager-mkdir-permission-group-read" name="permission-group-read" checked="checked"/>
<label for="fn-filemanager-mkdir-permission-group-read"><?=t("filemanager-label-permission-group-read")?></label>

<input type="checkbox" id="fn-filemanager-mkdir-permission-group-write" name="permission-group-write" checked="checked"/>
<label for="fn-filemanager-mkdir-permission-group-write"><?=t("filemanager-label-permission-group-write")?></label>
</td>
</tr>
<tr>
<th><?=t('filemanager-label-permission-other')?></th>
<td class="fn-buttonset">
<input type="checkbox" id="fn-filemanager-mkdir-permission-other-read" name="permission-other-read"/>
<label for="fn-filemanager-mkdir-permission-other-read"><?=t("filemanager-label-permission-other-read")?></label>
<input type="checkbox" id="fn-filemanager-mkdir-permission-other-write" name="permission-other-write"/>
<label for="fn-filemanager-mkdir-permission-other-write"><?=t("filemanager-label-permission-other-write")?></label>
</td>
</tr>
</table>
</form>
</div>

<div id="fn-filemanager-rename-dialog">
    <h2 class="ui-text-center"><?=t('filemanager-rename-dialog-title')?></h2>
    <form id="fn-filemanager-rename">
    <table>
        <tr>
            <td>
                <label for="name"><?=t('filemanager-label-name')?>:</label>
                <input type="text" id="fn-filemanager-rename-name" name="name" class="ui-input-text fn-primary-field"/>
            </td>
        </tr>
    </table>
    </form>
</div>

<div id="fn-filemanager-delete-dialog">
    <h2><?=t('filemanager-delete-dialog-message')?></h2>
</div>
<div id="fn-filemanager-album-dialog">
    <h2><?=t('filemanager-album-dialog-message')?></h2>
</div>
</div>
