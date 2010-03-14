<table id="fn-printing-list" class="ui-table ui-table-list">
<thead>
<tr>
	<th colspan="5" class="ui-state-default ui-widget-header"><?=t('printing-title')?></th>
</tr>
<tr class="ui-header">
   <th><?=t('printing-label-share')?></th>
   <th><?=t('printing-label-info')?></th>
   <th><?=t('printing-label-location')?></th>
   <th><?=t('printing-label-state')?></th>
   <th>&nbsp;</th>
</tr>
</thead>
<tbody>
</tbody>
</table>

<button id="fn-printing-list-add"><?=t("printing-add-button-label")?></button>

<div id="fn-printing-dialogs" class="ui-helper-hidden">
<div id="fn-printing-list-edit">
<form>
<input type="hidden" name="name"/>
<input type="hidden" name="printer"/>
<h2 class="fn-dialog-header ui-dialog-header"></h2>
	<table>
	<tr>
	   <td><label for="printer"><?=t('printing-list-edit-printer-label')?></label></td>
	   <td><select name="input_printer"/></td>
	</tr>
	<tr>
	   <td><label for="name"><?=t('printing-list-edit-name-label')?></label></td>
	   <td><input type="text" name="input_name"/></td>
	</tr>
	<tr>
	   <td><label for="location"><?=t('printing-list-edit-location-label')?></label></td>
	   <td><input type="text" name="location"/></td>
	</tr>
	<tr>
	   <td><label for="info"><?=t('printing-list-edit-info-label')?></label></td>
	   <td><input type="text" name="info"/></td>
	</tr>
	</table>
</form>
</div>
</div>
