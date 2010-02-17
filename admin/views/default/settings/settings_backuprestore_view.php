<fieldset><legend><i><?=t('Backup and restore settings')?></i></legend>

<table border="0" cellpadding="0">
<tr>
	<td><?=t('Source')?>/<?=t('Destination')?></td>
	<td colspan="2">
		<select name="destination" id="unitselector">
<?if(!empty($disks)):?>
<?foreach($disks as $disk):?>
			<option value="<?=$disk?>"><?=$disk?></option>
<?endforeach?>
<?else :?>
			<option><?=t('No backup medium found')?></option>
<?endif?>
		</select>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<form action="<?=FORMPREFIX?>/settings/restore" method="post" id="restoreform">
			<input class="unitclass" type="hidden" name="unit"/>
			<input type="submit" name="restore" value="<?=t('Restore')?>" <?if(empty($disks)):?>disabled="disabled"<?endif?>/>
		</form>
	</td>
	<td>
		<form action="<?=FORMPREFIX?>/settings/backup" method="post" id="backupform">
			<input class="unitclass" type="hidden" name="unit"/>
			<input type="submit" name="backup" value="<?=t('Backup')?>" <?if(empty($disks)):?>disabled="disabled"<?endif?>/>
		</form>
	</td>
</tr>
</table>
</fieldset>

