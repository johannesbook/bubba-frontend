<fieldset><legend><i><?=t('Date and time')?></i></legend>
<form id="SETCLOCK" action="<?=FORMPREFIX?>/settings/setdate" method="post">
<table border="0" cellpadding="0" >
   <tr>
   	<td></td>
      <td><i><?=t('Update date and time')?></i></td>
   </tr>
   <tr>
   	<td></td>
      <td>
      <input type='text' name='date' value='<?=date("Ymd")?>'/> (YYYYMMDD)<br/>
      <input type='text' name='time' value='<?=date("Hi")?>'/> (HHmm)<br/>
		</td>
	</tr>
	<tr>	      
		<td colspan="2">
			<input type='submit' value='<?=t('Update')?>' name='set_time'/>
		</td>
	</tr>
</table>
</form>
</fieldset>
