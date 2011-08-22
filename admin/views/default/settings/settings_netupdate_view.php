<fieldset><legend><i><?=_('Network settings')?></i></legend>
<? if($success){?>
<?=_('Settings updated successfully')?>.<br/>
<? }else{ ?>
<?=_('Updating settings falied')?>.<br/>
<hr/>
<? if($err_hostinvalid){ ?>
<?=_('Invalid hostname')?>. <?=_('Only A-Z,a-z,0-9 and \"-\" allowed')?><br/>
<? } ?>
<? if($err_ip){ ?>
<?=_('Invalid IP address')?>.<br/>
<? } ?>
<? if($err_gw){ ?>
<?=_('Invalid gateway address')?>.<br/>
<? } ?>
<? if($err_dns){ ?>
<?=_('Invalid DNS address')?>.<br/>
<? } ?>
<? if($err_netmask){ ?>
<?=_('Invalid netmask')?>.<br/>
<? } ?>
<? } ?>
<form method="post" action="<?=FORMPREFIX?>/settings">
<input type="submit" value="<?=_("Back")?>"/>
</form>
</fieldset>
