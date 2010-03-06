<fieldset><legend><i><?=t('Add new user')?></i></legend>
<?
if($success){
?>
<?=t('User')?> '<?=$uname?>' <?=t('added succesfully')?><br/>
<form action="<?=FORMPREFIX?>/users" method="post">
	<input type="submit" value="<?=t('Back')?>"/>
</form> 
<?}else{?>
<?=t('Add user')?> <?=$uname?> <?=t('failed')?><br/>
<? if($usr_caseerr){?><?=t('No uppercase letters allowed in username')?><br/><?}?>
<? if($usr_existerr){?><?=t('User already exists or is an administrational account')?><br/><?}?>
<? if($usr_nonameerr){?><?=t('No username entered')?><br/><?}?>
<? if($usr_spacerr){?><?=t('No whitespace allowed in usernames')?><br/><?}?>
<? if($pwd_charerr){?><?=t('Illegal characters in password')?><br/>&nbsp;<?=t('Only A-Z,a-z,0-9 and _ allowed')?><br/><?}?>
<? if($usr_charerr){?><?=t('Illegal characters in username')?><br/>&nbsp;<?=t('Only a-z,0-9,\" \",- and _ allowed')?><br/><?}?>
<? if($usr_longerr){?><?=t('Username to long. Max 32 characters.')?><br/><?}?>
<? if($pwd_mismatcherr){?><?=t('Passwords do not match or password empty')?><br/><?}?>
<form action="<?=FORMPREFIX?>/users" method="post">
	<input type="hidden" name="uname" value="<?=$uname?>"/>
	<input type="hidden" name="realname" value="<?=$realname?>"/>
	<input type="hidden" name="shell" value="<?=$shell?>"/>
	<input type="submit" value="<?=t('Back')?>"/>
</form>
<?}?>
</fieldset>