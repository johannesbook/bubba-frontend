<fieldset id="fetchmail"><legend><?=t('Retrieve mail from individual accounts')?> <?=$fstatus?"":"(<b>".t('Disabled')."</b>)"?></legend>
<table cellpadding="0" cellspacing="0" border="1">
<tr>
   <th><?=t('Host')?></th>
   <th><?=t('Protocol')?></th>
   <th><?=t('Username')?></th>
   <th><?=t('Local user')?></th>
   <th><?=t('SSL')?></th>
   <th><?=t('Leave email on server')?></th>
   <th>&nbsp;</th>
</tr>
<? if(count($accounts)>0){
	foreach($accounts as $account){?>
<tr>
	<td><?=$account['server']?></td>
	<td><?=$account['proto']?></td>
	<td><?=$account['ruser']?></td>
	<td><?=$account['luser']?></td>
	<td><?=$account['ssl']==""?t("No"):t("Yes")?></td>
	<td><?=$account['keep']==""?t("No"):t("Yes")?></td>
	<td>
		<form action="<?=FORMPREFIX?>/mail/editfac" method="post">
				<input type="hidden" name="server" value="<?=$account['server']?>" />
				<input type="hidden" name="proto" value="<?=$account['proto']?>" />
				<input type="hidden" name="ruser" value="<?=$account['ruser']?>" />
				<input type="hidden" name="luser" value="<?=$account['luser']?>" />
				<input type="hidden" name="ssl" value="<?=$account['ssl']?>" />
				<input type="hidden" name="password" value="<?=$account['rpassword']?>" />
				<input type="hidden" name="keep" value="<?=$account['keep']?>" />
				<input type="submit" name="edit" value="<?=t('Edit')?>"/>
   </form>
	</td>
</tr>
<?	}
}else{?>
<tr><td colspan="6"><?=t('No accounts added')?></td></tr>
<?}?>
</table>
<hr/>
<fieldset><legend><i><?=t('Add account')?></i></legend>
<form action="<?=FORMPREFIX?>/mail/addfac" method="post">
<table>
<tr>
   <td><?=t('Host')?></td>
   <td>
      <input type="text" name="server"/>
   </td>
</tr>
<tr>
   <td><?=t('Protocol')?></td>
   <td>
      <select name="protocol" size="1">
         <option>AUTO</option>
         <option>POP2</option>
         <option>POP3</option>
         <option>IMAP</option>
         <option>ETRN</option>
         <option>ODMR</option>
      </select>
   </td>
</tr>
<tr>
   <td><?=t('Remote user')?></td>
   <td><input type="text" name="ruser"/></td>
</tr>
<tr>
   <td><?=t('Password')?></td>
   <td><input type="password" name="password"/></td>
</tr>
<tr>
   <td><?=t('Local user')?></td>
   <td>
      <select name="luser" size="1">
      <?foreach($userlist as $user){?>
      <option><?=$user?></option>
      <?}?>
      </select>
   </td>
</tr>
<tr>
   <td><?=t('Use SSL')?></td>
   <td><input type="checkbox" class="checkbox_radio" name="usessl"/></td>
</tr>
<tr>
   <td><?=t('Leave email on server')?></td>
   <td><input type="checkbox" class="checkbox_radio" name="keep" /></td>
</tr>
<tr><td></td><td><input type="submit" name="add_account" value="<?=t('Add account')?>"/></td></tr>
</table>
</form>
</fieldset>
</fieldset>
