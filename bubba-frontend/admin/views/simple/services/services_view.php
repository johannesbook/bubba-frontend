<fieldset><legend><i><?=t('Services')?></i></legend>
<form action="<?=FORMPREFIX?>/services" method="post">
<table border="1" cellspacing="0" cellpadding="1">
   <tr>
	  <th><?=t('Service')?></th>
      <th><?=t('Enabled')?></th>
   </tr>
   <tr><td colspan="2"><b><?=t('File sharing')?></b></td></tr>
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FTP</td>
      <td align="center"><input name="ftp_enabled" type="checkbox" value="1" <?= $ftp_status?"":"checked=\"checked\""?>/></td>
   </tr>
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Anonymous FTP access')?></td>
      <td align="center"><input name="anon_ftp" type="checkbox" value="1" <?= $anon_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr><td colspan="2"><b><?=t('Streaming')?></b></td></tr>
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('UPNP streaming')?></td>
      <td align="center"><input name="upnp_enabled" type="checkbox" value="1" <?= $upnp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('DAAP streaming')?></td>
      <td align="center"><input name="daap_enabled" type="checkbox" value="1" <?= $daap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
	<tr><td colspan="2"><b><?=t('Mail')?></b></td></tr>
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Send and recieve')?></td>
      <td align="center"><input name="smtp_enabled" type="checkbox" value="1" <?= $smtp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imap (<?=t('Required for webmail access')?>)</td>
      <td align="center"><input name="imap_enabled" type="checkbox" value="1" <?= $imap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Mail retrieval')?></td>
      <td align="center"><input name="fetchmail_enabled" type="checkbox" value="1" <?= $fetchmail_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
	<tr><td colspan="2"><b><?=t('Other')?></b></td></tr>
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Printing')?></td>
      <td align="center"><input name="print_enabled" type="checkbox" value="1" <?= $print_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Up and downloads')?></td>
      <td align="center"><input name="download_enabled" type="checkbox" value="1" <?= $download_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
		<td colspan="2"><input type="submit" name="update" value="<?=t('Update')?>"/></td>
	</tr>
</table>
</form>
</fieldset>
