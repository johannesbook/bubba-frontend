<ul>
<? if(USER=="admin") { ?>	
	<li class="<?=$this->uri->segment(2) == 'wizard' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/settings/startwizard"><?=t('Setup wizard')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'trafficsettings' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/settings/trafficsettings"><?=t('Traffic')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'identity' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/settings/identity"><?=t('Identity')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'datetime' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/settings/datetime"><?=t('Date and time')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'backup' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/settings/backuprestore"><?=t('Backup and restore')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'software' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/settings/software"><?=t('Update')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'logs' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/settings/logs"><?=t('Logs')?></a></li>
<? } ?>
</ul>