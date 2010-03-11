<form action="<?=FORMPREFIX?>/settings/settraffic" method="post">
<table  >
    <tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('Traffic')?></td></tr>
	<tr><th colspan="2" class="ui-filemanager-state-header"><?=t('Bittorrent')?></th></tr>
	<tr>
		<td><?=t('Max upload speed')?></td>
		<td><input <?if(!$ftd_enabled):?>disabled="disabled"<?endif?> name="torrent_upload" size="5" type="text" value="<?=$btul_throttle?>"/> KiB/s</td>
	</tr>
	<tr>
		<td><?=t('Max download speed')?></td>
		<td><input <?if(!$ftd_enabled):?>disabled="disabled"<?endif?> name="torrent_download" size="5" type="text" value="<?=$btdl_throttle?>"/> KiB/s</td>
	</tr>
	<tr>
		<td></td>
		<td><small><?=t('Use -1 for unlimited traffic')?></small></td>
	</tr>
	  
</table>
<input type='submit' <?=$ftd_enabled?"":"disabled=\"yes\""?> value='<?=t('Update')?>' name='set_btspeed'/>
</form>
