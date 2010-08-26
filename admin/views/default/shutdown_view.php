<?if (isset($shutdown) && $shutdown) :?>
	<p><?=t('shutdown-shutdown-label')?>.<br/>
	<?=t('Please do not remove power until all leds are turned off')?>.
	<p/>
	<p><?=t('shutdown-restart-label')?>.</p>
<?elseif (isset($reboot) && $reboot):?>
	<?=t('shutdown-restarting')?>.<br/>
	<?=t('shutdown-LED-stopflash')?>.
<?else:?>
	<?=t("This page should not be reached")?>
<?endif?>
	
