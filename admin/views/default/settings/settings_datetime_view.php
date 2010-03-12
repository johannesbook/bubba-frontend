<form id="SETCLOCK" action="<?=FORMPREFIX?>/settings/setdate" method="post">
	
		<table>
		    <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=t('Date and time')?></td></tr>
			<tr>
				<td><?=t('Current timezone is')?>:</td>
				<td><?=$t_zone?></td>
			</tr>
			<tr>
				<td>Select timezone:</td>
				<td>
				<select name="user_tz">
				<option selected="selected" disabled="disabled" value=""> --- <?=t('Change timezone')?> --- </option>
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
				<td><?=t('Set time automatically')?></td>
				<td>
					<input
						id="ntp" 
						type="checkbox"
						class="checkbox_radio"
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
					(<?=t('YYYYMMDD')?>)
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
					(<?=t('HHmm')?>)
				</td>
			</tr>
			
		</table>
        <input class='submitbutton' type='submit' name='set_time' value='<?=t('Update')?>'/>
</form>
