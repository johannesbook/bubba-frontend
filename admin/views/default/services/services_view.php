
<form action="<?=FORMPREFIX?>/services" method="post">
<table cellspacing="0" cellpadding="1">
   
   <tr><td colspan="2" class="ui-state-default ui-widghet-header"><?=t('File sharing')?></td></tr>
   <tr>
      <td>FTP</td>
      <td align="center"><input name="ftp_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $ftp_status?"":"checked=\"checked\""?>/></td>
   </tr>
   <tr>
      <td><?=t('Anonymous FTP access')?></td>
      <td align="center"><input name="anon_ftp" type="checkbox" class="checkbox_radio" value="1" <?= $anon_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
   	<td>AFP</td>
	<td align="center"><input name="afp_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $afp_status?"checked=\"checked\"":""?>/></td>
   </tr>
   <tr><td colspan="2" class="ui-state-default ui-widghet-header"><?=t('Streaming')?></td></tr>
   <tr>
      <td><?=t('UPNP streaming')?></td>
      <td align="center"><input name="upnp_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $upnp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
      <td><?=t('DAAP streaming')?></td>
      <td align="center"><input name="daap_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $daap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
	  <td><?=t('SqueezeCenter - Squeezebox™ and Transporter® streaming')?>
		<?if(!$squeezecenter_installed):?>
<div>
		<?=t("Squeezecenter isn't installed, please click")?> <a href="<?=FORMPREFIX?>/settings/software/install/<?=$squeezecenter_packagename?>"><?=t('here')?></a> <?=t('to install squeezecenter')?>.
</div>
		<?endif?>
</td>
	  <td align="center">
		<input name="squeezecenter_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $squeezecenter_status?"checked=\"checked\"":"" ?> <?=$squeezecenter_installed?'':'disabled="disabled"'?>/>
	</td>
   </tr>
	<tr><td colspan="2" class="ui-state-default ui-widghet-header"><?=t('Mail')?></td></tr>
   <tr>
      <td><?=t('Send and recieve')?></td>
      <td align="center"><input name="smtp_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $smtp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td>Imap (<?=t('Required for webmail access')?>)</td>
      <td align="center"><input name="imap_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $imap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><?=t('Mail retrieval')?></td>
      <td align="center"><input name="fetchmail_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $fetchmail_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
	<tr><td colspan="2" class="ui-state-default ui-widghet-header" style="margin-top:1em;"><?=t('Other')?></td></tr>
   <tr>
      <td><?=t('Printing')?></td>
      <td align="center"><input name="print_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $print_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><?=t('Up and downloads')?></td>
      <td align="center"><input name="download_enabled" type="checkbox" class="checkbox_radio" value="1" <?= $download_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
  
</table>
<input type="submit" name="update" value="<?=t('Update')?>"/>
</form>
</fieldset>
