<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.js?v='<?=$this->session->userdata('version')?>'"></script>

<script type="text/javascript">
<!--

$(document).ready(function(){

	$("#ntp").click(function() {
		if($(this).attr('checked')) {
			$(".timedate").attr("disabled","true");
		} else {
			$(".timedate").removeAttr("disabled");
		}	
	})

});

// -->
</script>

<?
if($this->session->userdata("run_wizard")) { // wizard is running
?>
		<table id="wizard">
			<tr><td class="wiz_head" colspan="2"><?=t('Step 1/3: Date and time')?></td></tr>
		</table>	
	
		<form action="<?=FORMPREFIX?>/settings/wizard"" method="post">
		<fieldset id="wizard">
			<table id="wizard">
			    <tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('Timezone')?></td></tr>
				<tr><td><?=t('Current timezone is')?>:</td><td><?=$wiz_data['t_zone']?></td></tr>
				<tr><td>Select timezone:</td><td>
					<select name="wiz_data[user_tz]">
					<option value=""> --- <?=t('Change timezone')?> --- </option>
					<?
					foreach($wiz_data['t_zoneinfo'] as $region => $a_name) {
						if($region != "other" && $region != "Etc" && $region != "US") {
							print "\n";
							foreach($a_name as $name) {
								print "\t\t<option value=\"$region/$name\">$region - $name</option>\n";
							}
						}
					}
					?>
					</select>
					<?=isset($err['timezone'])?"<tr><td></td><td><div class=\"highlight\">".t($err['timezone'])."</div></td></tr>\n":""?>
				</td></tr>		
			</table>
		</fieldset>
		<fieldset id="wizard"><legend><?=t("Date and time")?></legend>
			<table id="wizard">
				<tr><td><?=t('Set time automatically')?></td><td><input id="ntp" type="checkbox" class="checkbox_radio" name="wiz_data[use_ntp]" <?=isset($wiz_data['use_ntp'])?"CHECKED":""?> /></td></tr>
				<tr><td>Date:</td><td><input type="text" class="timedate" name="wiz_data[date]" value="<?=$wiz_data['date']?>" <?=isset($wiz_data['use_ntp'])?"DISABLED":""?> /> (<?=t('YYYYMMDD')?>)</td></tr>
				<tr><td>Time:</td><td><input type="text" class="timedate" name="wiz_data[time]" value="<?=$wiz_data['time']?>" <?=isset($wiz_data['use_ntp'])?"DISABLED":""?> /> (<?=t('HHmm')?>)</td></tr>
				<?=isset($err['timedate'])?"<tr><td></td><td><div class=\"highlight\">".t($err['timedate'])."</div></td></tr>\n":""?>
				<tr><td colspan="2"><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/><span class="wiz_spacer">&nbsp;</span><input class='submitbutton' type='submit' name="wiz_data[postingpage]" value='<?=t('Next')?>'/></td></tr>
			</table>
		</fieldset>
		</form>
<?
 } else { // show start wizard page
?>
		<form action="<?=FORMPREFIX?>/settings/wizard"" method="post">
		<fieldset id="wizard">
			<table>
			    <tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('Setup wizard')?></td></tr>
				<tr><td>
					<?=t('To configure basic functionality of Bubba|Two, press the button to start the setup wizard.')?>					
				</td></tr>
			</table>
			<input type="submit" class="submitbutton" name='wiz_data[start]' value="<?=t('Start wizard')?>"/>
		</fieldset>
		</form>
<? } ?>
