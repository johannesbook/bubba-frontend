<fieldset><legend><i><?=t('Restore settings')?></i></legend>
<? if($success){?>
<?=t('Restore completed succesfully')?>.<br/>
<? }else{ ?>
<? if($err_nomedia){?>
<?=t('Restore medium not found')?><br/>
<?=t('Please insert a USB memory stick')?><br/>
<form action="<?=FORMPREFIX?>/settings/backuprestore" method="post">
   <input type="submit" name="backup" value="<?=t('Retry')?>"/>
</form>
<? } ?>
<? if($err_opfailed){?>
<?=t('Restore failed')?>.<br/>
<form action="<?=FORMPREFIX?>/settings/backuprestore" method="post">
   <input type="submit" name="backup" value="<?=t('Back')?>"/>
</form>
<? } ?>
<? } ?>
</fieldset>
