<form action="<?=FORMPREFIX?>/mail/server_update" method="post" id="frm_mail_server_settings">
<fieldset><legend><?=t('Server settings')?><?if($smtpstatus):?> <b>(<?=t('Disabled')?>)</b><?endif?>:</legend>
<table>

	<tr>
		<td><label><?=t('Outgoing mail server')?></label></td>
		<td><input type="text" name="smarthost" value="<?=$smarthost?>"/></td>
	</tr>
	
	<tr>
		<? // indent this and the below "hidden" section" ?>
		<td><?=t('Use authentication')?></td>
		<td><input type="checkbox" class="checkbox_radio" name="useauth" id="useauth" value="yes" <?if($smtp_auth):?>checked="checked"<?endif?> /></td>
	</tr>

	<? // -----  this should be a hidden section until "use auth" is selected. --- ?>
	<tr>
	  <td><?=t('Use plain text authentication')?><br>
	  <span class="comment"><?=t("(Not recommended, passwords will be sent unencrypted.)")?></span>
	  </td>
	  <td><input type="checkbox" class="checkbox_radio" name="useunsecure" id="useunsecure" value="yes" <?if(!$smtp_auth):?>disabled="disabled"<?endif?> <?if($smtp_plain_auth):?>checked="checked"<?endif?> /></td>
	</tr>
	<tr>
		<td><label><?=t('User')?></label></td>
		<td><input type="text" name="smtpuser" value="<?=$smtp_user?>"/></td>
	</tr>
	<tr>
		<td><label><?=t('Password')?></label></td>
		<td>
				<input type="password" name="smtppasswd"/>
		</td>
	</tr>
	<? // -----  end hidden section --- ?>
   <tr>
      <td><label><?=t('Handle mail for domain')?></label></td>
      <td><input type="text" name="domain" value="<? echo $receive["domain"] ?>"/></td>
   </tr>
   <tr>
   		<td></td>
   		<td><input type="submit" name="update" value="<?=t('Update')?>"/></td>
   </tr>

</table>
</fieldset>

</form>
