<fieldset><legend><i><?=t('Add to album')?></i></legend>
<div style="height: 150px; overflow: auto; ">
<table>
<? if(count($files)==0){ ?>
<tr><td><?=t('No items was added')?></td></tr>
<? }else{ ?>
	<? foreach($files as $name=>$result){ ?>
<tr>
	<td><?=$name?></td>
	<td><b><?=$result?t('Added'):t('Ignored')?></b></td>
</tr>
	<? } ?>
<? } ?>
</table>
</div>
<form method="post" action="<?=FORMPREFIX?>/filemanager">
<input type="hidden" name="path" value="<?=$path?>"/>
<input type="submit" value="<?=t('Back')?>"/>
</form>
<a href="/admin/index.php/album/albums"><?=t("Photo album")?></a>

</fieldset>
