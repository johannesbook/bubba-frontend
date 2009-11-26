<fieldset><legend><i><?=t('Edit user information')?></i></legend>
<? if($result){?>
<?= t('User information updated') ?>
<? }else{ ?>
<?= t('Error updating user') ?>
<? } ?>
<form action="<?=FORMPREFIX?>/users" method="post">
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>