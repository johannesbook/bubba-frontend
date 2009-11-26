<fieldset><legend><i><?=t('Update printer')?></i></legend>
<? if(!$success){ ?>
<?=t('Update printer failed')?>.<br/>
<? if(err_noname){ ?>
<?=t('No name provided')?>.<br/>
<? } ?>
<? if(err_noinfo){ ?>
<?=t('No printer name provided')?>.<br/>
<? } ?>
<? if(err_nopath){ ?>
<?=t('No printer path provided')?>.<br/>
<? } ?>
<? if(err_updatefail){ ?>
<?=t('Update operation failed')?>.<br/>
<? } ?>
<form action="<?=FORMPREFIX?>/printing/edit" method="post">
<input type="hidden" name="url" value="<?=$url?>"/>
<input type="hidden" name="info" value="<?=$name?>"/>
<input type="hidden" name="loc" value="<?=$loc?>"/>
<input type="hidden" name="name" value="<?=$info?>"/>
<input type="submit" value='<?=t('Back')?>' name='edit'/>
</form>
<? }else{ ?>
<? printf(t('Printer \'%s\' updated successfully'),$name); ?>.<br/>
<form action="<?=FORMPREFIX?>/printing" method="post">
<input type="submit" value='<?=t('Back')?>' name='edit'/>
</form>
<? }?>
</fieldset>
