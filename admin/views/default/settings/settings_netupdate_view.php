<fieldset><legend><i><?=t('Network settings')?></i></legend>
<? if($success){?>
<?=t('Settings updated successfully')?>.<br/>
<? }else{ ?>
<?=t('Updating settings falied')?>.<br/>
<hr/>
<? if($err_hostinvalid){ ?>
<?=t('Invalid hostname')?>. <?=t('Only A-Z,a-z,0-9 and \"-\" allowed')?><br/>	
<? } ?>
<? if($err_ip){ ?>
<?=t('Invalid IP address')?>.<br/>	
<? } ?>
<? if($err_gw){ ?>
<?=t('Invalid gateway address')?>.<br/>	
<? } ?>
<? if($err_dns){ ?>
<?=t('Invalid DNS address')?>.<br/>	
<? } ?>
<? if($err_netmask){ ?>
<?=t('Invalid netmask')?>.<br/>	
<? } ?>
<? } ?>
<form method="post" action="<?=FORMPREFIX?>/settings">
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>
