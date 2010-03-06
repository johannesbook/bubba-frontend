<div id="settingsnav">
	<div id="settingsmenu">
<? if(USER=="admin") { ?>	
	<a href="<?=FORMPREFIX?>/settings/trafficsettings"><?=t('Traffic')?></a>
	<a href="<?=FORMPREFIX?>/settings/datetime"><?=t('Date and time')?></a>
	<a href="<?=FORMPREFIX?>/settings/backuprestore"><?=t('Backup restore')?></a>
	<a href="<?=FORMPREFIX?>/settings/software"><?=t('Update')?></a>
<? } ?>
	</div>
</div>
<hr/>
