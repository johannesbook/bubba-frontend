<fieldset><legend><?=t('Change password for user')?> '<?=$uname?>'</legend>
<div id="dochpwd">
<? if($success){?>
<?=t('Password for user').' '.$uname.' '.t('changed sucessfully')?><br/>
<form action="<?=FORMPREFIX?>/users" method="post">
<input type="submit" name="back" value="<?=t('Back')?>"/>
</form>
<? }else{ ?>
<? if($mismatch){?>
<?=t('Passwords do not match')?><br/>
<? } ?>
<? if($illegal){?>
<?=t('Illegal characters in password')?><br/>
<?=t('Only A-Z,a-z,0-9 and _ allowed')?><br/>
<? } ?>
<? if($sambafail){?>
<?=t('"Failed to change samba password')?><br/>
<? } ?>
<? if($passwdfail){?>
<?=t('Failed to change unix password')?><br/>
<? } ?>
<form action="<?=FORMPREFIX?>/users/edit" method="post">
<input type="hidden" name="uname" value="<?=$uname?>"/>
<input type="submit" name="edit" value="<?=t('Back')?>"/>
</form>
<?}?>
</div>
</fieldset>