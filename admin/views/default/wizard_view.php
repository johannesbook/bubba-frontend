
	<table id="wizard">
		<tr><td class="wiz_head" colspan="2"><?=t('wizard-title')?></td></tr>
	</table>
	
	<form action="<?=FORMPREFIX?>/stat/wizard" method="post">
		
	<input type="hidden" name="wiz_data[running]" value="1" />
	<fieldset id="wizard"><legend><?=t("name")?></legend>
	<table id="wizard">
		<tr><td colspan="2"><?=t('wizard-msg1')?></td></tr>
		<tr><td colspan="2"><?=t('wizard-msg2')?></td></tr>

		
	</table>
	<input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/><span class="wiz_spacer">&nbsp;</span><input class='submitbutton' type='submit' name="wiz_data[postingpage]" value='<?=t('Next')?>'/>		
	</form>
