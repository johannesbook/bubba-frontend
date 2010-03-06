<fieldset><legend><i><?=t('Backup settings')?></i></legend>
<? if($success)?>
<?=t('Backup completed succesfully')?>.<br/>
<? }else{ ?>
<? if($err_nomedia){?>
<?=t('Backup medium not found')?><br/>
Please insert a USB memory stick<br/>
<form action="<?=FORMPREFIX?>/settings" method="post">
   <input type="submit" name="backup" value="Retry"/>
</form>
<? } ?>
<? if($err_opfailed){?>
<?=t('Backup failed')?>.<br/>
<? } ?>
<? } ?>
</fieldset>