<fieldset><legend><i><?=t('Edit user information')?></i></legend>
<? if($success){?>
<?= t('User information updated') ?><br/>
<? }else{ ?>
<?= t('Error updating user') ?><br/>
<? if($err_opfailed){ ?>
<?= t('Operation failed')?><br/>
<? } ?>
<? if($err_usrinvalid){ ?>
<?= t('Invalid user')?><br/>
<? } ?>
<? } ?>
<form action="<?=FORMPREFIX?>/userinfo" method="post">
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>