<fieldset><legend><i><?=t('Change permissions')?></i></legend>
<div style="height: 150px; overflow: auto; ">
<table>
<? if(count($file_list)>0){ ?>
<? foreach($file_list as $name=>$status){ ?>
<tr><td><?=t('Change permission on')?> <?=$name?></td><td><b><?=$status?t('OK'):t('Failed')?></b></td></tr>
<? } ?>
<? }else{ ?>
<tr><td><b><?=t('No items to change')?></b></td></tr>
<? } ?>
</table>
<form method="post" action="<?=FORMPREFIX?>/filemanager">
<input type="hidden" name="path" value="<?=$path?>"/>
<input type="submit" value="<?=t('Back')?>"/>
</form>
</div>
</fieldset>	
