<fieldset><legend><i><?=t('Date and time')?></i></legend>
<? if($success){ ?>
<?=t('Time and date successfully updated')?>.<br/>
<? }else{ ?>
<?=t('Unable to update time and date. Please check syntax of entered data')?>.<br/>
<? } ?>
<form method="post" action="<?=FORMPREFIX?>/settings">
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>
