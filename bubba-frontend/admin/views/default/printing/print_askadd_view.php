<form action="<?=FORMPREFIX?>/printing/doadd" method="post">
<fieldset><legend><i><?=t('Add printer')?></i></legend>
<input type="hidden" name="url" value="<?=$url?>"/>
<input type="hidden" name="info" value="<?=$info?>"/>
<table border="0" cellspacing="0" cellpadding="1">
<tr><td><?=t('Name')?>:</td><td><input type="text" name="name" value="<?= $name?>"/></td></tr>
<tr><td><?=t('Description')?>:</td><td><?=$info?></td></tr>
<tr><td><?=t('Location')?>:</td><td><input type="text" name="loc" value="<?=$loc?>"/></td></tr>
<tr><td><input type="submit" value='<?=t('Add')?>' name='doadd'/></td></tr>
</table>
</fieldset>
</form>
