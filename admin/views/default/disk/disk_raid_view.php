<div id="raid">
	<div class="ui-state-default ui-widghet-header ui-div-header"><?=t('disk_raid_setup_title')?></div>
	<div>
			<input type="button" class="button" id="create_md_internal_external_mirror" value="<?=t("disk_raid_create_label")?>" <?=$disable_create?> />
			<p>
				<?=t("disk_raid_create_message")?>.
			</p>
			<input type="button" class="button" id="recover_md" value="<?=t("disk_raid_recover_label")?>" />
			<p>
				<?=t("disk_raid_recover_message")?>.
			</p>    		    
	</div>


<div class="ui-state-default ui-widghet-header ui-div-header"><?=t('disk_raid_status_title')?></div>
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
	<div class="raid_status <?=$stat['type']?>" >
	<?if($stat['type'] == 'degraded'):?>
		<?if($stat['sync'] == 'recover'):?>
			<div >
			    <p><strong><?=t("disk_raid_degraded_recover_status_message",$stat['dev'])?>.</strong></p>
            </div>
			<div >
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
			<p>
			    <strong><?=t("disk_raid_degraded_message")?></strong>
            </p>
			<div >
				<p>
				    <?=t("disk_raid_degraded_missing_disk_message",$stat['dev'])?>.
				</p>
			</div>
		<?endif?>
	<?elseif($stat['type'] == 'faulty'):?>
		<div>
		    <p><strong><?=t("disk_raid_external_failure_title")?></strong></p>
        </div>
		<div >
		    <p>
			    <?=t("disk_raid_external_failure_message_1", $stat['device'])?>.
			</p>
    	    <p>
			    <?=t("disk_raid_external_failure_message_2")?>.
			</p>
		    <p>
    			<?=t("disk_raid_external_failure_message_3")?>.
			</p>
		</div>
	<?endif?>
	</div>
	<?endforeach?>
<? } else {
		if(sizeof($raids)) {
			print "<p>";
			print t("disk_raid_normal_op_message");
			print "</p>";
		} else {
			print "<p>";
			print t("disk_raid_not_activated_message");
			print "</p>";
		}
 	 } ?>

<div class="ui-expandable ui-state-default ui-widghet-header ui-div-header">
    <?=t('disk_raid_detailed_info_title')?>
</div>
	<div class="ui-helper-hidden ui-inset">
	
		<h3><?=t('disk_raid_list_of_arrays_title')?></h3>
		<table class="disks">
		<tr class="ui-header">
			<th><?=t('disk_raid_table_list_of_arrays_array_name_title')?></th>
			<th><?=t('disk_raid_table_list_of_arrays_level_title')?></th>
			<th><?=t('disk_raid_table_list_of_arrays_state_title')?></th>
			<? /*<th><?=t('disk_raid_table_list_of_arrays_label_title')?></th> */?>
			<th><?=t('disk_raid_table_list_of_arrays_size_title')?></th>
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
		
		<h3><?=t('disk_raid_list_of_disks_title')?></h3>
		<table class="disks">
		<tr class="ui-header">
			<th><?=t('disk_raid_table_list_of_disks_disk_title')?></th>
			<th><?=t('disk_raid_table_list_of_disks_parent_title')?></th>
			<th><?=t('disk_raid_table_list_of_disks_state_title')?></th>
			<th><?=t('disk_raid_table_list_of_disks_size_title')?></th>
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
</div>	
