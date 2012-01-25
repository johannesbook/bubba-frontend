
<form action="<?=FORMPREFIX?>/services" method="post" id="fn-settings-form">
<table class="ui-table-outline">   
   <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=_('File sharing')?></td></tr>
   <tr>
      <td><label for="">FTP</label></td>
      <td ><input name="ftp_enabled" type="checkbox" class="slide" value="1" <?= $ftp_status?"checked=\"checked\"":""?>/></td>
   </tr>
   <tr>
      <td class="ui-indent1"><label for=""><?=_('Anonymous FTP access')?></td>
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
   <tr><td colspan="2" class="ui-state-default ui-widget-header"><?=_("Streaming")?></td></tr>
   <tr>
      <td><label for=""><?=_('DLNA streaming')?></label></td>
      <td ><input name="upnp_enabled" type="checkbox" class="slide" value="1" <?= $upnp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
      <td><label for=""><?=_('DAAP streaming')?></label></td>
      <td ><input name="daap_enabled" type="checkbox" class="slide" value="1" <?= $daap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>
   <tr>
	  <td><label for=""><?=_('Squeezebox Server (Logitech)')?></label></td>
	  <td >
		<input name="logitechmediaserver_enabled" type="checkbox" class="slide" value="1" <?= $logitechmediaserver_status?"checked=\"checked\"":"" ?>/>
	</td>
   </tr>	 
</table>

<table class="ui-table-outline">      
	<tr><td colspan="2" class="ui-state-default ui-widget-header"><?=_("Email")?></td></tr>
   <tr>
      <td><label for=""><?=_('Send and receive')?></label></td>
      <td ><input name="smtp_enabled" type="checkbox" class="slide" value="1" <?= $smtp_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><label for="">IMAP (<?=_('Required for webmail access')?>)</label></td>
      <td ><input name="imap_enabled" type="checkbox" class="slide"value="1" <?= $imap_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><label for=""><?=_('Email retrieval')?></label></td>
      <td ><input name="fetchmail_enabled" type="checkbox" class="slide" value="1" <?= $fetchmail_status?"checked=\"checked\"":"" ?>/></td>
   </tr>		  
</table>

<table class="ui-table-outline">      
	<tr><td colspan="2" class="ui-state-default ui-widget-header" style="margin-top:1em;"><?=_("Other")?></td></tr>
   <tr>
      <td><label for=""><?=_("Printing")?></label></td>
      <td ><input name="print_enabled" type="checkbox" class="slide"value="1" <?= $print_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
   <tr>
      <td><label for=""><?=_('Up and downloads')?></label></td>
      <td ><input name="download_enabled" type="checkbox" class="slide"value="1" <?= $download_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	  
   <tr>
      <td><label for=""><?=_('Remote access through other router')?></label></td>
      <td ><input name="igd_enabled" type="checkbox" class="slide"value="1" <?= $igd_status?"checked=\"checked\"":"" ?>/></td>
   </tr>	
	<tfoot>
	<tr><td>
	<button class="submit" id="fn-settings-update"><?=_("Update")?></button>
	<input type="hidden" name="update" id="fn-settings-input-update" value=""/>
	</td></tr>
	</tfoot>
</table>
</form>
</fieldset>
