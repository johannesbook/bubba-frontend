
	<div class="ui-state-default ui-widghet-header ui-div-header"><?=t('disk_raid_setup_title')?></div>
	<div id="raid_text">
		<div><input type="button" class="button" id="create_md_internal_external_mirror" value="<?=t("disk_raid_create_label")?>" <?=$disable_create?> />
		<?=t("disk_raid_create_message")?>.</div>
		<div><input type="button" class="button" id="recover_md" value="<?=t("disk_raid_recover_label")?>" />
		<?=t("disk_raid_recover_message")?>.</div>
	</div>
</fieldset>

<fieldset><legend><i><?=t('disk_raid_status_title')?></i></legend>
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
			<div class="raid_text"><strong><?=t("disk_raid_degraded_recover_status_message",$stat['dev'])?>.</strong></div><br>
			<div class="raid_text">
				<? if ($stat['eta'][0]) { ?>
					<?=t("disk_raid_degraded_recover_status_message_eta_hours",
					round($stat['progress'],0),
					$stat['eta'][0],
					$stat['eta'][1])?>.
				<? } else { ?>
					<?=t("disk_raid_degraded_recover_status_message_eta_minutes",
					round($stat['progress'],0),
					$stat['eta'][1])?>.
				<? } ?>
			</div>
		<?elseif (!$faulty):?>
			<div class="highlight raid_text"><strong><?=t("disk_raid_degraded_message")?></strong></div>
			<div class="raid_text">
				<br>
				<?=t("disk_raid_degraded_missing_disk_message",$stat['dev'])?>.
			</div>
		<?endif?>
	<?elseif($stat['type'] == 'faulty'):?>
		<div class="highlight raid_text"><strong><?=t("disk_raid_external_failure_title")?></strong></div><br>
		<div class="raid_text">
			<?=t("disk_raid_external_failure_message_1", $stat['device'])?>.
			<br><br>
			<?=t("disk_raid_external_failure_message_2")?>.
			<br>
			<?=t("disk_raid_external_failure_message_3")?>.
		</div>
	<?endif?>
	</div>
	<?endforeach?>
<? } else {
		if(sizeof($raids)) {
			print "<div class='raid_text'>";
			print t("disk_raid_normal_op_message");
			print "</div>";
		} else {
			print "<div class='raid_text'>";
			print t("disk_raid_not_activated_message");
			print "</div>";
		}
 	 } ?>

<div id="raid_status" class="expansion ui-state-default ui-widghet-header ui-div-header"><span id="status_mark">+</span>&nbsp;&nbsp;<?=t('disk_raid_detailed_info_title')?></div>
	<div id="adv_status">
	
		<?=t('disk_raid_list_of_arrays_title')?>
		<table class="disks">
		<tr>
			<th><i><?=t('disk_raid_table_list_of_arrays_array_name_title')?></i></th>
			<th><i><?=t('disk_raid_table_list_of_arrays_level_title')?></i></th>
			<th><i><?=t('disk_raid_table_list_of_arrays_state_title')?></i></th>
			<? /*<th><i><?=t('disk_raid_table_list_of_arrays_label_title')?></i></th> */?>
			<th><i><?=t('disk_raid_table_list_of_arrays_size_title')?></i></th>
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
		<fieldset><legend><i><?=t('disk_raid_list_of_disks_title')?></i></legend>
		<table class="disks">
		<tr>
			<th><i><?=t('disk_raid_table_list_of_disks_disk_title')?></i></th>
			<th><i><?=t('disk_raid_table_list_of_disks_parent_title')?></i></th>
			<th><i><?=t('disk_raid_table_list_of_disks_state_title')?></i></th>
			<th><i><?=t('disk_raid_table_list_of_disks_size_title')?></i></th>
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
		<input type="button" class="remove_raid_disk" value="<?=t("disk_raid_disk_faulty_remove_button_label")?>" rel="<?=$disk['device']?>" />
		<?endif?>
			</td>
		</tr>
		<?endforeach?>
		</table>		
	</div>
