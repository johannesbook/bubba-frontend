<fieldset><legend><?=t('Sending Email')?></legend>
<?if($success){?>
<?=t('Sending email configuration updated')?><br/>
<?}else{?>
<?=t('Update sending configuration failed')?><br/>
<hr/>
<?if($userpwdmissing){?>
<?=t('User or password missing')?><br/>
<?}?>
<?if($servermissing){?>
<?=t('Server missing')?><br/>
<?}?>
<?}?>
</fieldset>
