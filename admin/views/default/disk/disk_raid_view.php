<div id="raid">
	<div class="ui-state-default ui-widget-header ui-div-header"><?=_("Setup RAID array")?></div>
	<div class="disk-raid-content">
			<p>
				<?=_("Set up the internal disk and one external disk into a RAID mirror solution (RAID 1)")?>.
			</p>
			<p>
				<input type="button" class="button" id="create_md_internal_external_mirror" value="<?=_("Create RAID array")?>" <?=$disable_create?> />
			</p>
			<p>
				<?=_("Recover internal disk or add a new external disk to existing RAID array")?>.
			</p>
			<p>
				<input type="button" class="button" id="recover_md" value="<?=_("Recover RAID array")?>" />
				</p>
	</div>


<div class="ui-state-default ui-widget-header ui-div-header"><?=_("RAID Status")?></div>
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
			    <p><strong><?=sprintf(_("Recovering RAID array '%s'"), $stat['dev'])?>.</strong></p>
            </div>
			<div >
				<? if ($stat['eta'][0]) { ?>
					<?=sprintf(_("Current recover progress is %d%% and is estimated to finish in %d hours %d minutes"), round($stat['progress'],0),
					$stat['eta'][0],
					$stat['eta'][1])?>.
				<? } else { ?>
					<?=sprintf(_("Current recover progress is %d%% and is estimated to finish in %d minutes"), round($stat['progress'],0),
					$stat['eta'][1])?>.
				<? } ?>
			</div>
		<?elseif (!$faulty):?>
			<p>
			    <strong><?=_("RAID array degraded")?></strong>
            </p>
			<div >
				<p>
				    <?=sprintf(_("Disk missing in RAID array '%s'"), $stat['dev'])?>.
				</p>
			</div>
		<?endif?>
	<?elseif($stat['type'] == 'faulty'):?>
		<div>
		    <p><strong><?=_("Error: External disk has malfunctioned")?></strong></p>
        </div>
		<div >
		    <p>
			    <?=sprintf(_("The external RAID disk (<strong>%s</strong>) in the RAID array has malfunctioned"), $stat['device'])?>.
			</p>
    	    <p>
			    <?=_("Please replace the disk (also press \"Remove" below to acknowledge the removal of the disk)")?>.
			</p>
		    <p>
			<?=_("When the disk has been replaced, press \"Recover RAID array" to add the new disk to the array")?>.
			</p>
		</div>
	<?endif?>
	</div>
	<?endforeach?>
<? } else {
		if(sizeof($raids)) {
			print "<p>";
			print _("Normal operation");
			print "</p>";
		} else {
			print "<p>";
			print _("RAID not activated");
			print "</p>";
		}
 	 } ?>

<div class="ui-expandable ui-state-default ui-widget-header ui-div-header">
    <?=_("Detailed information")?>
</div>
	<div class="ui-helper-hidden ui-inset">
	
		<h3><?=_("List of RAID arrays")?></h3>
		<table class="disks">
		<tr class="ui-header">
			<th><?=_("Array name")?></th>
			<th><?=_("Level")?></th>
			<th><?=_("State")?></th>
			<? /*<th><?=_("Label")?></th> */?>
			<th><?=_("Size")?></th>
			<th></th>
		</tr>
		<?foreach($raids as $raid):?>
		<tr>
			<td><?=$raid['device']?></td>
			<td><?=$raid['level']?></td>
			<td><?=_($raid['state'])?></td>
			<?/*<td><?=$raid['label']?></td>*/?>
			<td><?=sizetohuman($raid['size'],1000)?></td>
			<td></td>
		</tr>
		<?endforeach?>
		</table>
		
		<h3><?=_("List of RAID disks")?></h3>
		<table class="disks">
		<tr class="ui-header">
			<th><?=_("Disk")?></th>
			<th><?=_("Parent")?></th>
			<th><?=_("State")?></th>
			<th><?=_("Size")?></th>
			<th></th>
		</tr>
		<?foreach($disks as $disk):?>
		<tr>
			<td><?=$disk['device']?></td>
			<td><?=$disk['parent']?></td>
			<td><?=_($disk['state'])?></td>
			<td><?=sizetohuman($disk['size'],1000)?></td>
			<td>
		<?if($disk['state'] == 'faulty'):?>
		<input type="button" class="remove_raid_disk" value="<?=_("Remove")?>" rel="<?=$disk['device']?>" />
		<?endif?>
			</td>
		</tr>
		<?endforeach?>
		</table>		
	</div>
</div>	
