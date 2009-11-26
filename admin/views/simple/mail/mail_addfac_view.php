<fieldset><legend><i><?=t('Add account')?></i></legend>
<? if($success){?>
<? printf(t('Account for \'%s\' at \'%s\' added'),$ruser,$server)?>.
<form action="<?=FORMPREFIX?>/mail" method="post">
<input type="submit" name="back" value="<?=t('Back')?>"/>
</form>
<? }else{ ?>
<? if($usrinvalid){ printf(t('You are not allowed to add account for \'%s\''),$ruser);?>.<?}?>
<? if($infoincomp){?><?=t('Account information incomplete. Account not added')?>.<?}?>
<form action="<?=FORMPREFIX?>/mail" method="post">
<input type="hidden" name="ruser" value="<?=$ruser?>"/>
<input type="hidden" name="server" value="<?=$server?>"/>
<input type="hidden" name="protocol" value="<?=$protocol?>"/>
<input type="hidden" name="luser" value="<?=$luser?>"/>
<input type="hidden" name="usessl" value="<?=$usessl?>"/>

<input type="submit" name="back" value="<?=t('Back')?>"/>
</form>
<?}?>
</fieldset>