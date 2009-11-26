<fieldset><legend><i><?=t('Installed printers')?></i><?=$printstatus?"&nbsp;&nbsp;(<b>".t('Printing disabled')."</b>)":""?></legend>
<table border="1" cellspacing="0" cellpadding="1">
<tr><th><?=t('Share')?></th><th><?=t('Description')?></th><th><?=t('State')?></th><th><?=t('Action')?></th></tr>
<?
	if( count($iprinters)==0){
?>
<tr><td colspan=2><?=t('No printers installed')?></td></tr>
<?   
	}else{
		foreach($iprinters as $name=>$cfg){
?>
<tr>
	<td><b><?= $name?></b></td>
	<td><?=$cfg["Info"]?></td>
	<td><?=$cfg["State"]?></td>
	<td>
		<form class="printer_edit" action="<?=FORMPREFIX?>/printing/edit" method="post">
			<input type="hidden" value='<?=$name?>' name='name'/>
			<input type="submit" value='<?=t('Edit')?>' name='edit' class="printer_button"/>
		</form>
		<form class="printer_edit" action="<?=FORMPREFIX?>/printing/state" method="post">
			<input type="hidden" value='<?=$name?>' name='name'/>
			<?if($cfg["State"]!="Idle"){?>
			<input type="hidden" value="start" name="state"/>
			<input type="submit" <?= $printstatus?"disabled=\"true\"":""?> value='<?=t('Start')?>'  class="printer_button"/>
			<?}else{?>
			<input type="hidden" value="stop" name="state"/>
			<input type="submit" <?= $printstatus?"disabled=\"true\"":""?> value='<?=t('Stop')?>' class="printer_button"/>
			<?}?>
		</form>
	</td>
</tr>            
<?	}
}
?>
</table>
	<form action="<?=FORMPREFIX?>/printing/add" method="post" class="printer_edit">
		<input type="submit" <?= $printstatus?"disabled=\"true\"":""?>value='<?=t('Add new')?>' name='add' class="printer_button"/>
	</form>
</fieldset>
