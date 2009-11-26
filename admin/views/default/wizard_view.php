
	<table id="wizard">
		<tr><td class="wiz_head" colspan="2"><?=t('Welcome to Bubba|Two')?></td></tr>
	</table>
	
	<form action="<?=FORMPREFIX?>/stat/wizard" method="post">
		
	<input type="hidden" name="wiz_data[running]" value="1" />
	<fieldset id="wizard"><legend><?=t("Bubba|Two")?></legend>
	<table id="wizard">
		<tr><td colspan="2"><?=t('Please take a moment to set up basic functionality for Bubba|Two.')?></td></tr>
		<tr><td colspan="2"><?=t('All entered values can easily be changed later using the administration interface.')?></td></tr>

		<tr><td colspan="2"><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/><span class="wiz_spacer">&nbsp;</span><input class='submitbutton' type='submit' name="wiz_data[postingpage]" value='<?=t('Next')?>'/></td></tr>
	</table>
	</fieldset>
		
	</form>