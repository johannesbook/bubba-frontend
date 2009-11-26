<fieldset><legend><i><?=t('Edit account')?></i></legend>
<?if($success){?>
<?=t('Account updated succesfully')?><br/>
<?}else{?>
<?=t('Update of account failed')?><br/>
<hr/>
<?if($err_usrinvalid){?>
<?=t('User not allowed to update account')?><br/>
<?}?>
<?}?>
<form method="post" action="<?=FORMPREFIX?>/usermail">
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>