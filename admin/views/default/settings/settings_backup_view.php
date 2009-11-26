<fieldset><legend><i><?=t('Backup settings')?></i></legend>
<? if($success){?>
<?=t('Backup completed succesfully')?>.<br/>
<? }else{ ?>
<? if($err_nomedia){?>
<?=t('Backup medium not found')?><br/>
<?=t('Please insert a USB memory stick')?><br/>
<form action="<?=FORMPREFIX?>/settings/backuprestore" method="post">
   <input type="submit" name="backup" value="Retry"/>
</form>
<? } ?>
<? if($err_opfailed){?>
<?=t('Backup failed')?>.<br/>
<form action="<?=FORMPREFIX?>/settings/backuprestore" method="post">
   <input type="submit" name="backup" value="<?=t('Back')?>"/>
</form>
<? } ?>
<? } ?>
</fieldset>
