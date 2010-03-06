<div id="mailnav">
	<div id="mailmenu">
<? if(USER=="admin") { ?>	
	<a href="<?=FORMPREFIX?>/mail/viewfetchmail"><?=t('Retrieve mail')?></a>
	<a href="<?=FORMPREFIX?>/mail/viewmailsend"><?=t('Send mail')?></a>
	<a href="<?=FORMPREFIX?>/mail/viewreceivemail"><?=t('Receive mail')?></a>
<? } ?>
	</div>
</div>
<hr/>
