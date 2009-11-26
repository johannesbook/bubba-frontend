<form action="<?=FORMPREFIX?>/printing/dodelete" method="post">
<fieldset><legend><i><?=t('Delete printer')?></i></legend>
<input type="hidden" name="name" value="<?=$name?>" />
<table>
<tr><td colspan=2><?=t('Printer')?> <b>'<?=$name?>'</b> <?=t('will be deleted')?>. <?=t('Do you wish to proceed')?>?</td></tr>
<tr></tr>
<tr>
<td><input type="submit" value='<?=t('Cancel')?>' name="cancel"/> <input type="submit" value='<?=t('Delete')?>' name="delete"/></td>
<td></td>
</tr>
</table>
</fieldset>
</form>
