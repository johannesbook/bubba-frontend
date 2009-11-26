<? if(USER=="admin") { ?>	
<ul>
	<li class="<?=USER=="admin" ? "" : "last "?><?=$this->uri->segment(2) == 'cd' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/filemanager/cd"><?=t('Browse')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'backup' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/filemanager/backup"><?=t('Backup')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'restore' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/filemanager/restore"><?=t('Restore')?></a></li>
</ul>
<? } ?>
