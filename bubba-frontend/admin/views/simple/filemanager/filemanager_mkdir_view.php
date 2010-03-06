<fieldset><legend><i><?=t('Create new folder in')?>: <?=b_dec($path)?></i></legend>
<form method="post" action="<?=FORMPREFIX?>/filemanager/domkdir">
<table>
<tr><td><?=t('Name')?></td><td colspan="3"><input type="text" name="directory" size="40"/></td></tr>
<tr><td colspan="4"><hr/></td></tr>
<tr><td><b><?=t('Permissions')?></b></td><td><b><?=t('Read')?></b></td><td><b><?=t('Write')?></b></td><td></td></tr>
<tr>
		<td><?=t('Owner')?></td>
		<td><input type="checkbox" name="ow_read" checked="checked" disabled="disabled"/></td>
		<td><input type="checkbox" name="ow_write" checked="checked" disabled="disabled"/></td>
		<td width="50%"></td>
</tr>
<tr>
	<td><?=t('Users')?></td>
	<td><input type="checkbox" name="u_read" checked="checked"/></td>
	<td><input type="checkbox" name="u_write" checked="checked"/></td>
	<td width="50%"></td>
</tr>
<tr>
	<td><?=t('Other')?></td>
	<td><input type="checkbox" name="o_read"/></td>
	<td><input type="checkbox" name="o_write"/></td>
	<td width="50%"></td>
</tr>
<tr>
	<td><input type="submit" name="md_cancel" value="<?=t('Cancel')?>"/></td>
	<td><input type="submit" name="md_confirm" value="<?=t('Create')?>"/></td>
	<td colspan="2"></td>
</tr>
</table>
<input type="hidden" name="path" value="<?=$path?>"/>
</form>   
</fieldset>
