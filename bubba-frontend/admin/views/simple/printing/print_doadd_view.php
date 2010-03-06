<fieldset><legend><i><?=t('Add printer')?></i></legend>
<? if(!$success){?>
<? printf(t('Adding printer \'%s\' failed'),$name); ?>
<hr/>
<? if($err_illegalchar){?>
<?= t('Invalid characters in share name')?><br/>
<?= t('Only A-Z,a-z,0-9 and _ allowed')?><br/>
<? } ?>
<? if($err_noname){?>
<?=t('No name provided')?><br/>
<? } ?>
<? if($err_noprintname){?>
<?=t('No printer name provided')?><br/>
<? } ?>
<? if($err_nopath){?>
<?=t('No printer path provided')?><br/>
<? } ?>
<? if($err_opfailed){?>
<?=t('Operation failed')?>
<? } ?>
<form action="<?=FORMPREFIX?>/printing/askadd" method="post">
<input type="hidden" name="url" value="<?=$url?>"/>
<input type="hidden" name="info" value="<?=$name?>"/>
<input type="hidden" name="loc" value="<?=$loc?>"/>
<input type="hidden" name="name" value="<?=$info?>"/>
<input type="submit" value='Back' name='printeradd'/>
</form>
<? }else{ ?>
<? printf(t('Printer \'%s\' added successfully'),$name); ?>.<br/>
<form action="<?=FORMPREFIX?>/printing" method="post">
<input type="submit" value="<?=t('Back')?>"/>
</form>
<? } ?>
</fieldset>
