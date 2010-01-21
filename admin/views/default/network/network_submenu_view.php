<ul>
<?$current=$this->uri->segment(2)?>
<?if(USER=="admin"):?>	
	<li class="<?if($current == 'profile'):?>active<?endif?>">
		<a href="<?=FORMPREFIX?>/network/profile"><?=t('Profile')?></a>
	</li>
	<li class="<?if($current == 'wan'):?>active<?endif?>">
		<a href="<?=FORMPREFIX?>/network/wan"><?=t('WAN')?></a>
	</li>
	<li class="<?if($current == 'lan'):?>active<?endif?>">
		<a href="<?=FORMPREFIX?>/network/lan"><?=t('LAN')?></a>
	</li>
	<li class="<?if($current == 'wlan'):?>active<?endif?>">
		<a href="<?=FORMPREFIX?>/network/wlan"><?=t('wlan_title')?></a>
	</li>
	<li class="<?if($current == 'other'):?>active<?endif?>">
		<a href="<?=FORMPREFIX?>/network/other"><?=t('Identity')?></a>
	</li>
	<li class="<?if($current == 'fw'):?>active<?endif?> last">
		<a href="<?=FORMPREFIX?>/network/fw"><?=t('Firewall')?></a>
	</li>
<?endif?>
</ul>
