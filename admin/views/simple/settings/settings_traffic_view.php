<fieldset><legend><?=t('Traffic')?></legend>
<form action="<?=FORMPREFIX?>/settings/settraffic" method="post">
<table border="0" cellpadding="0" >
	<tr><td colspan="2"><b><?=t('Bittorrent')?></b></td></tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Max upload speed')?></td>
		<td align="left"><input <?=$ftd_enabled?"":"disabled=\"yes\""?> name="torrent_upload" size="5" type="text" value="<?=$btul_throttle?>"/> KB/S</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Max download speed')?></td>
		<td align="left"><input <?=$ftd_enabled?"":"disabled=\"yes\""?> name="torrent_download" size="5" type="text" value="<?=$btdl_throttle?>"/> KB/S</td>
	</tr>
	<tr><td></td><td><small><?=t('Use -1 for unlimited traffic')?></small></td></tr>
	<tr>	      
		<td colspan="2">
			<input type='submit' <?=$ftd_enabled?"":"disabled=\"yes\""?> value='<?=t('Update')?>' name='set_btspeed'/>
		</td>
	</tr>   
</table>
</form>
</fieldset>
