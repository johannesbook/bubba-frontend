<form action="<?=FORMPREFIX?>/mail/recieve" method="post" id="rec_email">
<fieldset><legend><?=t('Handle mail for domain')?> <?=$smtpstatus?'':'(<b>'.t('Disabled').'</b>)'?></legend>
<table>
   <tr>
      <td style="width: 50%;"><label><?=t('Domain')?></label></td>
      <td><input type="text" name="domain" value="<? echo $domain ?>"/></td>
   </tr>
   <tr>
   		<td></td>
   		<td><input type="submit" name="action_receive" value="<?=t('Update')?>"/></td>
   </tr>
</table>
</fieldset>
</form>
