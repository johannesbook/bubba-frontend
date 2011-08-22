<form id="SETCLOCK" action="<?=FORMPREFIX?>/settings/setdate" method="post">
	
	<table class="ui-table-outline">
		<thead>
		    <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=_('Date and time')?></td></tr>
		</thead>
		<tbody>
			<tr>
				<td><?=_('Current timezone is')?>:</td>
				<td><?=$t_zone?></td>
			</tr>
			<tr>
				<td>Select timezone:</td>
				<td>
				<select name="user_tz">
				<option selected="selected" disabled="disabled" value=""> --- <?=_('Change timezone')?> --- </option>
<?foreach($t_zoneinfo as $region => $a_name):?>
				<optgroup label="<?=$region?>">
	<?foreach($a_name as $name):?>
					<option value="<?=$region?>/<?=$name?>"><?=$region?> - <?=$name?></option>
	<?endforeach?>

				</optgroup>
<?endforeach?>

				</select>
				</td>
			</tr>		
			<tr>
				<td><?=_('Auto adjust date and time')?></td>
				<td>
					<input
						id="ntp" 
						type="checkbox"
						class="slide"
						name="use_ntp"
						<?if(isset($use_ntp)):?>checked="checked"<?endif?>

					/>
				</td>
			</tr>
			<tr>
				<td>Date:</td>
				<td><input 
						type="text" 
						class="timedate" 
						name="date" 
						value="<?=$date?>" 
						<?if(isset($use_ntp)):?>disabled="disabled"<?endif?>

					/> 
					(<?=_("YYYYMMDD")?>)
				</td>
			</tr>
			<tr>
				<td>Time:</td>
				<td><input
						type="text"
						class="timedate" 
						name="time" 
						value="<?=$time?>" 
						<?if(isset($use_ntp)):?>disabled="disabled"<?endif?>

					/> 
					(<?=_("HHmm")?>)
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">
					<input class='submitbutton' type='submit' name='set_time' value='<?=_("Update")?>'/>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
<form id="DEFAULT_LANG" action="<?=FORMPREFIX?>/settings/set_lang" method="post">

	<table class="ui-table-outline">
		<thead>
		    <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=_("Default system language")?></td></tr>
		</thead>
		<tbody>
			<tr>
				<td><?=_("System language")?></td>
				<td>
				<select name="lang">
	   	  		<?foreach($available_languages as $lang) {
	   	  			if($lang['status'] != 'official') {
	   	  				$user_languages[] = $lang;
	   	  				continue;
	   	  			}
			 		print "<option id='option_".$lang["short_name"]."' value='".$lang["short_name"]."'";
			 		print (isset($lang['default']) && $lang['default'])?" selected='SELECTED'":"";
			 		print ">";
			 		print $lang["long_name"];
			 		print "</option>\n";
	   	  			
	   	  		}
	   	  		if(sizeof($user_languages)) {
					print "<optgroup label='"._("User contributed languages")."'>";
	   	  			
		   	  		foreach($user_languages as $lang) {
		   	  			if($lang['status'] != 'user') continue;
				 		print "<option id='option_".$lang["short_name"]."' value='".$lang["short_name"]."'";
				 		print (isset($lang['default']) && $lang['default'])?" selected='SELECTED'":"";
				 		print ">";
				 		print $lang["long_name"];
				 		print "</option>\n";
		   	  			
		   	  		}
	   	  			print "</optgroup>";
	   	  		}?>
				</select>
				</td>
			</tr>

			<tfoot>
			<tr>
				<td colspan="2">
					<input class='submitbutton' type='submit' name='set_time' value='<?=_("Update")?>'/>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
