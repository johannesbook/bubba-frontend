<div id="navigator">
	<div id="navmenu">
<? if(USER=="admin") { ?>	
	<a href="<?=FORMPREFIX?>/users"><?=t('Users')?></a>
	<a href="<?=FORMPREFIX?>/services"><?=t('Services')?></a>
	<a href="<?=FORMPREFIX?>/mail"><?=t('Mail')?></a>
	<a href="<?=FORMPREFIX?>/network"><?=t('Network')?></a>
	<a href="<?=FORMPREFIX?>/printing"><?=t('Printing')?></a>
	<a href="<?=FORMPREFIX?>/settings"><?=t('Settings')?></a>
<? }else{ ?>
	<a href="<?=FORMPREFIX?>/usermail"><?=t('Mail')?></a>
	<a href="<?=FORMPREFIX?>/downloads"><?=t('Downloads')?></a>
	<a href="<?=FORMPREFIX?>/userinfo"><?=t('User info')?></a>
<? } ?>
	<a href="<?=FORMPREFIX?>/filemanager"><?=t('Filemanager')?></a>
	<a href="<?=FORMPREFIX?>/logout"><?=t('Log out')?></a>
	<a href="<?=FORMPREFIX?>/stat"><?=t('Home')?></a>
	</div>
</div>
<hr/>
