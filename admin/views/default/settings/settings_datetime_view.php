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

<form id="SETCLOCK" action="<?=FORMPREFIX?>/settings/setdate" method="post">
	<fieldset><legend><?=t("Timezone")?></legend>
		<table id="datetime">
			<tr><td><?=t('Current timezone is')?>:</td><td><?=$t_zone?></td></tr>
			<tr><td>Select timezone:</td><td>
				<select name="user_tz">
				<option value=""> --- <?=t('Change timezone')?> --- </option>
				<?
				foreach($t_zoneinfo as $region => $a_name) {
					print "\n";
					foreach($a_name as $name) {
						print "\t\t<option value=\"$region/$name\">$region - $name</option>\n";
					}
				}
				?>
				</select>
				<?=isset($err['timezone'])?"<tr><td></td><td><div class=\"highlight\">".t($err['timezone'])."</div></td></tr>\n":""?>
			</td></tr>		
		</table>
	</fieldset>
	<fieldset><legend><?=t("Date and time")?></legend>
		<table id="datetime">
			<tr>
				<td><?=t('Set time automatically')?></td><td><input id="ntp" type="checkbox" class="checkbox_radio" name="use_ntp" <?=isset($use_ntp)?"CHECKED":""?> /></td>
			</tr>
			<tr>
				<td>Date:</td><td><input type="text" class="timedate" name="date" value="<?=$date?>" <?=isset($use_ntp)?"DISABLED":""?> /> (<?=t('YYYYMMDD')?>)</td>
			</tr>
			<tr>
				<td>Time:</td><td><input type="text" class="timedate" name="time" value="<?=$time?>" <?=isset($use_ntp)?"DISABLED":""?> /> (<?=t('HHmm')?>)</td>
			</tr>
			<?=isset($err['timedate'])?"<tr><td></td><td><div class=\"highlight\">".t($err['timedate'])."</div></td></tr>\n":""?>
			<tr><td colspan="2"><input class='submitbutton' type='submit' name='set_time' value='<?=t('Update')?>'/></td></tr>
		</table>
	</fieldset>
	</form>
