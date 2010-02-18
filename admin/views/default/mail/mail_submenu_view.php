<ul>
<? if(USER=="admin") { ?>	
	<li class="<?=$this->uri->segment(2) == 'viewfetchmail' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/mail/viewfetchmail"><?=t('Retrieve mail')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'server_settings' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/mail/server_settings"><?=t('Server settings')?></a></li>
<? } ?>
</ul>
