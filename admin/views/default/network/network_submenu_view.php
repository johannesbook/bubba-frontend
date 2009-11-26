<ul>
<? if(USER=="admin") { ?>	
	<li class="<?=$this->uri->segment(2) == 'profile' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/network/profile"><?=t('Profile')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'wan' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/network/wan"><?=t('WAN')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'lan' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/network/lan"><?=t('LAN')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'wlan' ? 'active': '';?>">
<?if($exists_wlan_card):?>
<a href="<?=FORMPREFIX?>/network/wlan"><?=t('wLAN')?></a>
<?else:?>
<span class="disabled"><?=t('wLAN')?></span>
<?endif?>
</li>
	<li class="<?=$this->uri->segment(2) == 'other' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/network/other"><?=t('Identity')?></a></li>
	<li class="<?=$this->uri->segment(2) == 'fw' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/network/fw"><?=t('Firewall')?></a></li>
<? } ?>
</ul>
