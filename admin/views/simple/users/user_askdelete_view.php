<form action="<?=FORMPREFIX?>/users/dodelete" method="post">
<fieldset><legend><?=t('Delete user')?></legend>
<table>
<tr>
	<td colspan="2"><?=t('User')?> '<?= $uname ?>' <?=t('will be deleted. Do you wish to proceed')?>?</td>
</tr>
<tr>
	<td colspan="2"><input type="checkbox" name="userdata" value="delete" checked="checked" /><?=t('Delete user data')?></td>
</tr>
<tr>
	<td><input type="submit" value='<?=t('Yes')?>' name="proceed"/> <input type="submit" value='<?=t('No')?>'/></td>
	<td></td>
</tr>
</table>
</fieldset>
<input type="hidden" name='uname' value="<?= $uname ?>"/>
</form>