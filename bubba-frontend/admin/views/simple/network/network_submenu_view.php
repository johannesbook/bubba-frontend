<div id="networknav">
	<div id="networkmenu">
<? if(USER=="admin") { ?>	
	<a href="<?=FORMPREFIX?>/network/wan"><?=t('WAN')?></a>
	<a href="<?=FORMPREFIX?>/network/lan"><?=t('LAN')?></a>
	<a href="<?=FORMPREFIX?>/network/other"><?=t('Other')?></a>
	<a href="<?=FORMPREFIX?>/network/fw"><?=t('Firewall')?></a>
<? } ?>
	</div>
</div>
<hr/>
