<?if (isset($shutdown) && $shutdown) :?>
	<p><?=sprintf(_("Shutting down %s"), NAME)?>.<br/>
	<?=_('Please do not remove power until all leds are turned off')?>.
	<p/>
	<p><?=sprintf(_("To restart %s, press the power button"), NAME)?>.</p>
<?elseif (isset($reboot) && $reboot):?>
	<?=sprintf(_("Restarting %s"), NAME)?>.<br/>
	<?=sprintf(_("When the LED light is solid blue, %s is ready to be used again"), NAME)?>.
<?else:?>
	<?=_("This page should not be reached")?>
<?endif?>
	
