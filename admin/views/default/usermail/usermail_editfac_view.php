<fieldset id="fetchmail"><legend><i><?=t('Edit account')?></i></legend>
<form action="<?=FORMPREFIX?>/usermail/updatefac" method="post">
<input type="hidden" name="old_server" value="<?=$server?>"/>
<input type="hidden" name="old_protocol" value="<?=$protocol?>"/>
<input type="hidden" name="old_ruser" value="<?=$ruser?>"/>
<input type="hidden" name="luser" value="<?=$luser?>"/>
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
   <td><input type="password" name="password" value="<?=$rpassword?>"/></td>
</tr>
<tr>
   <td><?=t('Use SSL')?></td>
   <td><input type="checkbox" class="checkbox_radio" name="usessl" <?=$ssl=="ssl"?"checked":""?>/></td>
</tr>
<tr>
   <td><?=t('Leave messages on server')?></td>
   <td><input type="checkbox" class="checkbox_radio" name="keep" <?=$keep=="keep"?"checked":""?>/></td>
</tr>
<tr><td></td><td><input type="submit" name="edit_account" value="<?=t('Update')?>"/></td></tr>
</table>
</form>
<br/>
<form method="post" action="<?=FORMPREFIX?>/usermail/deletefac">
<input type="submit" name="delete_account" value="<?=t('Delete account')?>"/>
<input type="hidden" name="server" value="<?=$server?>"/>
<input type="hidden" name="ruser" value="<?=$ruser?>"/>
<input type="hidden" name="luser" value="<?=$luser?>"/>
<input type="hidden" name="protocol" value="<?=$protocol?>"/>
</form>
</fieldset>
