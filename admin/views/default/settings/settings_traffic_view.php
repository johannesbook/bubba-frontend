<form action="<?=FORMPREFIX?>/settings/settraffic" method="post">
<table id="traffic"  class="ui-table-outline" >
<thead>
    <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=t('Traffic')?></td></tr>
</thead>
<tbody>
	<tr class="ui-filemanager-state-header"><td><?=t('BitTorrent')?></td><td><span class="ui-text-comment">(<?=t('Use -1 for unlimited traffic')?>)</span></td></tr>
	<tr>
		<td><?=t('Max upload speed')?></td>
		<td><input <?if(!$ftd_enabled):?>disabled="disabled"<?endif?> name="torrent_upload" size="5" type="text" value="<?=$btul_throttle?>"/> kByte/s</td>
	</tr>
	<tr>
		<td><?=t('Max download speed')?></td>
		<td><input <?if(!$ftd_enabled):?>disabled="disabled"<?endif?> name="torrent_download" size="5" type="text" value="<?=$btdl_throttle?>"/> kByte/s</td>
	</tr>
</tbody>
<tfoot>
<tr>
<td colspan="4">
<input type='submit' <?=$ftd_enabled?"":"disabled=\"yes\""?> value='<?=t('Update')?>' name='set_btspeed'/>
</td>
</tr>
</tfoot>
	  
</table>
</form>
