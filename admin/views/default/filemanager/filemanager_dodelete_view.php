<fieldset><legend><i><?=t('Delete')?></i></legend>
<div style="height: 150px; overflow: auto; ">
<table>
<? if(count($files)==0){ ?>
<tr><td><?=t('No files to be deleted')?></td></tr>
<? }else{ ?>
	<? foreach($files as $name=>$result){ ?>
<tr>
	<td><?=$name?></td>
	<td><b><?=$result?t('Failed'):t('Deleted')?></b></td>
</tr>
	<? } ?>
<? } ?>
</table>
</div>
<form method="post" action="<?=FORMPREFIX?>/filemanager">
<input type="hidden" name="path" value="<?=$path?>"/>
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>
