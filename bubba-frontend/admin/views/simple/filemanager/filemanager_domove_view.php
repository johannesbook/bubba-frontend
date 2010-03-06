<fieldset><legend><i><?=t('Move items to')?>: <?=$mv_path?></i></legend>
<div style="height: 150px; overflow: auto; ">
<table>   
<? foreach($items as $item=>$result){?>
<tr><td><?=t('Move')?> <?=$item?> <b><?=$result?t('Ok'):t('Failed')?></b></td></tr>
<? } ?>
</table>
<hr/>
<form method="post" action="<?=FORMPREFIX?>/filemanager">
<input type="hidden" name="path" value="<?=$path?>"/>
<input type="submit" value="<?=t('Back')?>"/>
</form>
</div>
</fieldset>