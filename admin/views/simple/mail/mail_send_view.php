
<form action="<?=FORMPREFIX?>/mail/send" method="post" id="send_mail">
<fieldset><legend><?=t('Sending Email')?> <?=$smtpstatus?'':'(<b>'.t('Disabled').'</b>)'?></legend>
<table>
	<tr>
		<td style="width: 50%;"><label><?=t('Server')?></label></td>
		<td><input type="text" name="smarthost" value="<?echo $smarthost?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><hr/></td>
	</tr>
	<tr><td conspan="2"><input type="checkbox" name="useauth" value="yes"<?=$smtp_auth?'checked="checked"':''?> onchange="check();" /> <?=t('Use authentication')?></td></tr>
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
