<form action="<?=FORMPREFIX?>/mail/send" method="post" id="send_mail">
<fieldset><legend><?=t('Sending Email')?><?if($smtpstatus):?> <b>(<?=t('Disabled')?>)</b><?endif?>:</legend>
<table>
	<tr>
		<td style="width: 50%;"><label><?=t('Server')?></label></td>
		<td><input type="text" name="smarthost" value="<?=$smarthost?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><hr/></td>
	</tr>
	<tr>
		<td><?=t('Use authentication')?></td>
		<td><input type="checkbox" class="checkbox_radio" name="useauth" id="useauth" value="yes" <?if($smtp_auth):?>checked="checked"<?endif?> /></td>
	</tr>
	<tr>
	  <td><?=t('Use plain text authentication')?><br>
	  <span class="comment"><?=t("(Not recommended, passwords will be sent unencrypted.)")?></span>
	  </td>
	  <td><input type="checkbox" class="checkbox_radio" name="useunsecure" id="useunsecure" value="yes" <?if(!$smtp_auth):?>disabled="disabled"<?endif?> <?if($smtp_plain_auth):?>checked="checked"<?endif?> /></td>
	</tr>
	<tr>
		<td style="width: 50%;"><label><?=t('User')?></label></td>
		<td><input type="text" name="smtpuser" value="<?=$smtp_user?>"/></td>
	</tr>
	<tr>
		<td style="width: 50%;"><label><?=t('Password')?></label></td>
		<td><input type="password" name="smtppasswd" value=""/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="action_send" value="<?=t('Update')?>"/></td>
	</tr>
</table>
</fieldset>
</form>
