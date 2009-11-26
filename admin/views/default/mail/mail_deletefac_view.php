<fieldset><legend><i><?=t('Delete account')?></i></legend>
<?if($success){?>
<?printf(t("Fetch mail for '%s' on server '%s' will be removed"),$ruser,$server);?>.<br/><br/>
<?=t('Do you want to proceed')?>?<br/><br/>
<fieldset>
<table>
<tr>
<td>
<form action="<?=FORMPREFIX?>/mail" method="post">
<input type="submit" value='<?=t('Cancel')?>'/>
</form>
</td>
<td>
<form action="<?=FORMPREFIX?>/mail/dodeletefac" method="post">
<input type=hidden name='server' value="<?=$server?>"/>
<input type=hidden name='protocol' value="<?=$protocol?>"/>
<input type=hidden name='ruser' value="<?=$ruser?>"/>
<input type=hidden name='luser' value="<?=$luser?>"/>
<input type="submit" value='<?=t('Delete')?>' name='proceed_delete'/>
</form>
</td>
</tr>
</table>
</fieldset>
<?}else{?>
<?}?>
</fieldset>
