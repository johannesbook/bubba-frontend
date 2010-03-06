<fieldset><legend><i><?=t('Delete account')?></i></legend>
<?if($success){?>
<? printf(t("Account '%s' on server '%s' has been deleted"),$ruser,$server);?><br/>
<form method="post" action="<?=FORMPREFIX?>/usermail">
<input type="submit" value="<?=t('Back')?>"/>
</form>
<?}else{?>
<?=t('You are not allowed to delete this account')?>.
<?}?>
</fieldset>