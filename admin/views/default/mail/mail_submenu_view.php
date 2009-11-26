<ul>
<? if(USER=="admin") { ?>	
	<li class="<?=$this->uri->segment(2) == 'viewfetchmail' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/mail/viewfetchmail"><?=t('Retrieve mail')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'viewmailsend' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/mail/viewmailsend"><?=t('Send mail')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'viewreceivemail' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/mail/viewreceivemail"><?=t('Receive mail')?></a></li>
<? } ?>
</ul>
