<form action="<?=FORMPREFIX?>/settings/settraffic" method="post">
<fieldset><legend><?=t('Traffic')?></legend>

<table class="admin-table" >
	<tr><th colspan="2"><?=t('Bittorrent')?></th></tr>
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
	<tr>	      
		<td colspan="2">
			<input type='submit' <?=$ftd_enabled?"":"disabled=\"yes\""?> value='<?=t('Update')?>' name='set_btspeed'/>
		</td>
	</tr>   
</table>
</fieldset>
</form>
