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
		<table>
		<tr>
		<td>
		<form action="<?=FORMPREFIX?>/printing/edit" method="post">
		<input type="hidden" value='<?=$name?>' name='name'/>
		<input type="submit" value='<?=t('Edit')?>' name='edit'/>
		</form>
		</td>
		<td>
		<form action="<?=FORMPREFIX?>/printing/state" method="post">
		<input type="hidden" value='<?=$name?>' name='name'/>
		<?if($cfg["State"]!="Idle"){?>
		<input type="hidden" value="start" name="state"/>
		<input type="submit" <?= $printstatus?"disabled=\"true\"":""?> value='<?=t('Start')?>'/>
		<?}else{?>
		<input type="hidden" value="stop" name="state"/>
		<input type="submit" <?= $printstatus?"disabled=\"true\"":""?> value='<?=t('Stop')?>'/>
		<?}?>
		</form>
		</td>
		</tr>
		</table>
	</td>
</tr>            
<?	}
}
?>
<tr>
	<td colspan="4">
	<form action="<?=FORMPREFIX?>/printing/add" method="post"><fieldset class="bform" style="padding: 0px;">
		<input type="submit" <?= $printstatus?"disabled=\"true\"":""?>value='<?=t('Add new')?>' name='add'/>
	</fieldset></form>
	</td>
</tr>   
</table>
</fieldset>
