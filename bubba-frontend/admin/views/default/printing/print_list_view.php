<table>
<tr></tr>
<tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('Installed printers')?><?if(!$printing_enabled):?>&nbsp;&nbsp;<?=t('Installed printers')?><?endif?></td></tr>
<tr>
	<th><?=t('Share')?></th>
	<th><?=t('Description')?></th>
	<th><?=t('State')?></th>
	<th><?=t('Action')?></th>
</tr>
<?if( count($installed_printers)==0):?>
<tr>
	<td colspan="4"><?=t('No printers installed')?></td>
</tr>
<?else:?>   
<?foreach($installed_printers as $printer_name=>$printer_configuration):?>
<tr>
	<td><b><?=$printer_name?></b></td>
	<td><?=$printer_configuration["Info"]?></td>
	<td><?=$printer_configuration["State"]?></td>
	<td>
		<form class="printer_edit" action="<?=FORMPREFIX?>/printing/edit" method="post">
			<input type="hidden" value="<?=$printer_name?>" name="name"/>
			<input type="submit" value="<?=t("Edit")?>" name="edit" class="printer_button"/>
		</form>
		<form class="printer_edit" action="<?=FORMPREFIX?>/printing/state" method="post">
			<input type="hidden" value="<?=$printer_name?>" name="name"/>
	<?if($printer_configuration["State"]!="Idle"):?>
			<input type="hidden" value="start" name="state"/>
			<input type="submit" <?if(!$printing_enabled):?>disabled="disabled"<?endif?> value="<?=t("Start")?>"  class="printer_button"/>
	<?else:?>
			<input type="hidden" value="stop" name="state"/>
			<input type="submit"  <?if(!$printing_enabled):?>disabled="disabled"<?endif?> value="<?=t("Stop")?>" class="printer_button"/>
	<?endif?>
		</form>
	</td>
</tr>            
<?endforeach?>
<?endif?>
</table>

	<form action="<?=FORMPREFIX?>/printing/add" method="post" class="printer_edit">
		<input type="submit" <?if(!$printing_enabled):?>disabled="disabled"<?endif?>  value="<?=t("Add new")?>" name="add" class="printer_button"/>
	</form>
