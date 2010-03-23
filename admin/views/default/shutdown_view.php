<?if (isset($shutdown) && $shutdown) :?>
	<p><?=t('Shutting down Bubba|2')?>.<br/>
	<?=t('Please do not remove power until all leds are turned off')?>.
	<p/>
	<p><?=t('To restart Bubba|2, press the power button')?>.</p>
<?elseif (isset($reboot) && $reboot):?>
	<?=t('Restarting Bubba|2')?>.<br/>
	<?=t('When the LED has stopped flashing, Bubba|2 is ready to be used again')?>.
<?else:?>
	<?=t("This page should not be reached")?>
<?endif?>
	
