<div id="a"></div>
<fieldset><legend><i><?=t('Setup RAID array')?></i></legend>
	
	<div id="raid_text">
		<input type="button" class="button" id="create_md_internal_external_mirror" value="<?=t("Create RAID array")?>" <?=$disable_create?> />
		<?=t("Set up internal disk and one external disk into a RAID mirror solution (RAID 1)")?><br>
		<input type="button" class="button" id="recover_md" value="<?=t("Recover RAID array")?>" />
		<?=t("Recover internal disk or add a new external disk to existing RAID array.")?>
	</div>
</fieldset>

<fieldset><legend><i><?=t('RAID Status')?></i></legend>
<?if(sizeof($status)) { ?>
	<?
	$faulty = false;
	foreach($status as $stat) {
		if ($stat['type'] == 'faulty') {
			$faulty = true;
		}
	}
	?>
	<?foreach($status as $stat):?>
	<div class="raid_status <?=$stat['type']?>">
	<?if($stat['type'] == 'degraded'):?>
		<?if($stat['sync'] == 'recover'):?>
			<div class="raid_text"><strong><?=t("Recovering RAID array '%s'.",$stat['dev'])?></strong></div><br>
			<div class="raid_text">
				<? if ($stat['eta'][0]) { ?>
					<?=t("Current recover progress is %d%% and is estimated to finish in %d hours %d minutes.",
					round($stat['progress'],0),
					$stat['eta'][0],
					$stat['eta'][1])?>
				<? } else { ?>
					<?=t("Current recover progress is %d%% and is estimated to finish in %d minutes.",
					round($stat['progress'],0),
					$stat['eta'][1])?>
				<? } ?>
			</div>
		<?elseif (!$faulty):?>
			<div class="highlight raid_text"><strong><?=t("RAID array degraded")?></strong></div>
			<div class="raid_text">
				<br>
				<?=t("Disk missing in RAID array '%s'.",$stat['dev'])?>
			</div>
		<?endif?>
	<?elseif($stat['type'] == 'faulty'):?>
		<div class="highlight raid_text"><strong><?=t("Error: External disk has malfunctioned")?></strong></div><br>
		<div class="raid_text">
			<?=t("The external RAID disk (<strong>%s</strong>) in the RAID array has malfunctioned.", $stat['device'])?>
			<br><br>
			<?=t("Please replace the disk (also press \"Remove\" below to acknowledge the removal of the disk).")?>
			<br>
			<?=t("When the disk has been replaced, press \"Recover RAID array\" to add the new disk to the array.")?>
		</div>
	<?endif?>
	</div>
	<?endforeach?>
<? } else {
		if(sizeof($raids)) {
			print "<div class='raid_text'>";
			print t("Normal operation.");
			print "</div>";
		} else {
			print "<div class='raid_text'>";
			print t("RAID not activated.");
			print "</div>";
		}
 	 } ?>
</fieldset>

<fieldset class="adv_status"><legend><span id="raid_status" class="expansion"><span id="status_mark">+</span>&nbsp;&nbsp;<?=t('Detailed information')?></span></legend>
	<div id="adv_status">
	
		<fieldset><legend><i><?=t('List of RAID arrays')?></i></legend>
		<table class="disks">
		<tr>
			<th><i><?=t('Array name')?></i></th>
			<th><i><?=t('Level')?></i></th>
			<th><i><?=t('State')?></i></th>
			<? /*<th><i><?=t('Label')?></i></th> */?>
			<th><i><?=t('Size')?></i></th>
			<th></th>
		</tr>
		<?foreach($raids as $raid):?>
		<tr>
			<td><?=$raid['device']?></td>
			<td><?=$raid['level']?></td>
			<td><?=t($raid['state'])?></td>
			<?/*<td><?=$raid['label']?></td>*/?>
			<td><?=sizetohuman($raid['size'],1000)?></td>
			<td></td>
		</tr>
		<?endforeach?>
		</table>
		
		</fieldset>
		<fieldset><legend><i><?=t('List of RAID disks')?></i></legend>
		<table class="disks">
		<tr>
			<th><i><?=t('Disk')?></i></th>
			<th><i><?=t('Parent')?></i></th>
			<th><i><?=t('State')?></i></th>
			<th><i><?=t('Size')?></i></th>
			<th></th>
		</tr>
		<?foreach($disks as $disk):?>
		<tr>
			<td><?=$disk['device']?></td>
			<td><?=$disk['parent']?></td>
			<td><?=t($disk['state'])?></td>
			<td><?=sizetohuman($disk['size'],1000)?></td>
			<td>
		<?if($disk['state'] == 'faulty'):?>
		<input type="button" class="remove_raid_disk" value="<?=t("Remove")?>" rel="<?=$disk['device']?>" />
		<?endif?>
			</td>
		</tr>
		<?endforeach?>
		</table>
		</fieldset>
	</div>
</fieldset>
