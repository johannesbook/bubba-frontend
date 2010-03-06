<fieldset id="fetchmail"><legend><i><?=t('Edit account')?></i></legend>
<form action="<?=FORMPREFIX?>/mail/update" method="post" id="fn-mail-retreive-update">
<input type="hidden" name="old_server" value="<?=$server?>"/>
<input type="hidden" name="old_protocol" value="<?=$protocol?>"/>
<input type="hidden" name="old_ruser" value="<?=$ruser?>"/>

<div id="mail_account_info">
	<table>
	<tr>
	   <td><?=t('Host')?></td>
	   <td>
	      <input type="text" name="server" value="<?=$server?>"/>
	   </td>
	</tr>
	<tr>
	   <td><?=t('Protocol')?></td>
	   <td>
	      
	      <select name="protocol" size="1">
	         <option <?=$protocol=="AUTO"?"selected=\"selected\"":""?>>AUTO</option>
	         <option <?=$protocol=="POP2"?"selected=\"selected\"":""?>>POP2</option>
	         <option <?=$protocol=="POP3"?"selected=\"selected\"":""?>>POP3</option>
	         <option <?=$protocol=="IMAP"?"selected=\"selected\"":""?>>IMAP</option>
	         <option <?=$protocol=="ETRN"?"selected=\"selected\"":""?>>ETRN</option>
	         <option <?=$protocol=="ODMR"?"selected=\"selected\"":""?>>ODMR</option>
	      </select>
	   </td>
	</tr>
	<tr>
	   <td><?=t('Remote user')?></td>
	   <td><input type="text" name="ruser" value="<?=$ruser?>"/></td>
	</tr>
	<tr>
	   <td><?=t('Password')?></td>
	   <td><input type="password" name="password" value="<?=$password?>" /></td>
	</tr>
	<tr>
	   <td><?=t('Local user')?></td>
	   <td>
	      <select name="luser" size="1">
	      <?foreach($userlist as $user){?>
	      <option <?= $user==$luser?"selected='selected'":"" ?> ><?=$user?></option>
	      <?}?>
	      </select>
	   </td>
	</tr>
	<tr>
	   <td><?=t('Use SSL')?></td>
	   <td><input type="checkbox" class="checkbox_radio" name="usessl" <?=$ssl=="ssl"?"checked":""?>/></td>
	</tr>
	<tr>
	   <td><?=t('Leave messages on server')?></td>
	   <td><input type="checkbox" class="checkbox_radio" name="keep" <?=$keep=="keep"?"checked":""?>/></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input
				type="submit" 
				name="edit_account" 
				value="<?=t('Update')?>"
				id="mail-editfac-update"
			/>
			<input
				id="mail_editfac_delete"
				type="submit"
				value="<?=t('Delete account')?>"
			/>
			<input type="hidden" name="delete_account" value="" id="mail-editfac-hidden-delete">

		</td>
	
	</tr>
	</table>
</div>
</form>
