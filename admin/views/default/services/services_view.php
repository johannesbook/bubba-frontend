
<form action="<?=FORMPREFIX?>/services" method="post" id="fn-settings-form">
<table class="ui-table-outline">   
   <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=t('File sharing')?></td></tr>
   <tr>
      <td><label for="">FTP</label></td>
      <td ><input name="ftp_enabled" type="checkbox" class="slide" value="1" <?= $ftp_status?"":"checked=\"checked\""?>/></td>
   </tr>
   <tr>
      <td class="ui-indent1"><label for=""><?=t('Anonymous FTP access')?></td>
      <td ><input name="anon_ftp" type="checkbox" class="slide" value="1" <?= $anon_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
   	<td><label for="">AFP</label></td>
	<td ><input name="afp_enabled" type="checkbox" class="slide" value="1" <?= $afp_status?"checked=\"checked\"":""?>/></td>
   </tr>  
   <tr>
   	<td><label for="">Windows file share</label></td>
	<td ><input name="samba_enabled" type="checkbox" class="slide" value="1" <?= $samba_status?"checked=\"checked\"":""?>/></td>
   </tr>
</table>

<table class="ui-table-outline">      
   <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=t('Streaming')?></td></tr>
   <tr>
      <td><label for=""><?=t('UPNP streaming')?></label></td>
      <td ><input name="upnp_enabled" type="checkbox" class="slide" value="1" <?= $upnp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
      <td><label for=""><?=t('DAAP streaming')?></label></td>
      <td ><input name="daap_enabled" type="checkbox" class="slide" value="1" <?= $daap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
	  <td><label for=""><?=t('Squeezebox Server')?></label>
		<?if(!$squeezecenter_installed):?>
<div>
		<?=t("Squeezebox server isn't installed, please click")?> <a href="<?=FORMPREFIX?>/settings/software/install/<?=$squeezecenter_packagename?>"><?=t('here')?></a> <?=t('to install squeezecenter')?>.
</div>
		<?endif?>
</td>
	  <td >
		<input name="squeezecenter_enabled" type="checkbox" class="slide" value="1" <?= $squeezecenter_status?"checked=\"checked\"":"" ?> <?=$squeezecenter_installed?'':'disabled="disabled"'?>/>
	</td>
   </tr>	 
</table>

<table class="ui-table-outline">      
	<tr><td colspan="2" class="ui-state-default ui-widget-header"><?=t('Email')?></td></tr>
   <tr>
      <td><label for=""><?=t('Send and recieve')?></label></td>
      <td ><input name="smtp_enabled" type="checkbox" class="slide" value="1" <?= $smtp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><label for="">Imap (<?=t('Required for webmail access')?>)</label></td>
      <td ><input name="imap_enabled" type="checkbox" class="slide"value="1" <?= $imap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><label for=""><?=t('Email retrieval')?></label></td>
      <td ><input name="fetchmail_enabled" type="checkbox" class="slide" value="1" <?= $fetchmail_status?"checked=\"checked\"":"" ?>/></td>
   </tr>		  
</table>

<table class="ui-table-outline">      
	<tr><td colspan="2" class="ui-state-default ui-widget-header" style="margin-top:1em;"><?=t('Other')?></td></tr>
   <tr>
      <td><label for=""><?=t('Printing')?></label></td>
      <td ><input name="print_enabled" type="checkbox" class="slide"value="1" <?= $print_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><label for=""><?=t('Up and downloads')?></label></td>
      <td ><input name="download_enabled" type="checkbox" class="slide"value="1" <?= $download_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	  
	<tfoot>
	<tr><td>
	<button class="submit" id="fn-settings-update"><?=t('Update')?></button>
	<input type="hidden" name="update" id="fn-settings-input-update" value=""/>
	</td></tr>
	</tfoot>
</table>
</form>
</fieldset>
