<fieldset><legend><i><?=t('Create new folder')?></i></legend>
<div style="height: 150px; overflow: auto; ">
<table>   
<? if($success){ ?>
<tr><td><?=t('Created folder')?>: <?=$dpath?></td><td><b><?=t('OK')?></b></td></tr>
<? }else{ ?>
<? 	if($err_path){?>
<tr><td><b><?=t('Error')?>:</b><?=t('Path invalid')?></td></tr>      
<? 	} ?>
<? 	if($err_opfail){?>
<tr><td><?=t('Created folder')?>: <?=$dpath?></td><td><b><?=t('Failed')?></b></td></tr>
<? 	} ?>
<? } ?>
</table>
<form method="post" action="<?=FORMPREFIX?>/filemanager">
<input type="hidden" name="path" value="<?=$path?>"/>
<input type="submit" value="<?=t('Back')?>"/>
</form>
</div>
</fieldset>
