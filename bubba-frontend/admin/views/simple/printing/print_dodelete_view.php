<fieldset><legend><i><?=t('Delete printer')?></i></legend>
<? if($success){ ?>
<? printf(t('Printer \'%s\' has been deleted'),$name);?>.<br/>
<? }else{ ?>
<? printf(t('Delete printer \'%s\' failed'),$name);?>.<br/>
<? } ?>
<form method="post" action="<?=FORMPREFIX?>/printing">
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>
