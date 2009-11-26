<ul>
	<li class="<?=$this->uri->segment(1) == 'stat' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/stat"><span><?=t('Home')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'filemanager' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/filemanager"><span><?=t('Filemanager')?></span></a></li>
<? if(USER=="admin") { ?>
	<!-- li class="<?=$this->uri->segment(1) == 'administration' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/administration"><span><?=t('Administration')?></span></a></li -->

	<li class="<?=$this->uri->segment(1) == 'users' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/users"><span><?=t('Users')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'services' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/services"><span><?=t('Services')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'mail' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/mail"><span><?=t('Mail')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'network' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/network"><span><?=t('Network')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'disk' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/disk"><span><?=t('Disk')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'printing' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/printing"><span><?=t('Printing')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'settings' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/settings"><span><?=t('Settings')?></span></a></li>
<? }else{ ?>
	<li class="<?=$this->uri->segment(1) == 'usermail' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/usermail"><span><?=t('Mail')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'downloads' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/downloads"><span><?=t('Downloads')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'userinfo' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/userinfo"><span><?=t('User info')?></span></a></li>
	<li class="<?=$this->uri->segment(1) == 'album' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/album"><span><?=t('Album')?></span></a></li>
<? } ?>
	<li class="<?=$this->uri->segment(1) == 'logout' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/logout"><span><?=t('Log out')?></span></a></li>
</ul>

