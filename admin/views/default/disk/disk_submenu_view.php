<ul>
<li class="<?=$this->uri->segment(2) == 'devices' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/disk"><?=t('Information')?></a></li>
<li class="<?=$this->uri->segment(2) == 'lvm' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/disk/lvm"><?=t('Extended disk (LVM)')?></a></li>
<li class="<?=$this->uri->segment(2) == 'raid' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/disk/raid"><?=t('RAID')?></a></li>
</ul>
