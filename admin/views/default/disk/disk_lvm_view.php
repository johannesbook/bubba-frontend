    <div class="ui-state-default ui-widget-header ui-div-header"><?=_('Extend Logical Volume')?></div>
	<div id="lvm">
		<div class="ui-disk-lvm-content">
			<label for="logical_volume"><?=_("Extend")?></label>
			<select  <?= sizeof( $lvs ) == 0 ? 'disabled="disabled"' : '' ?> id="logical_volume" class="volume">
				<?foreach( $lvs as $lv ):?>
					<option value="<?=$lv?>"><?
						switch($lv) {
							case "bubba-storage":
								print _("Home partition");
								break;
							default:
								print $lv;
								break;
						}
						?></option>
				<?endforeach?>
			</select> 
			<?=_("with")?>
			<select  <?=sizeof( $disks ) == 0 ? 'disabled="disabled"' : '' ?>  id="disk" class="disk">
				<?foreach( $disks as $disk ):?>
					<option value="<?=$disk?>"><?=$disk?></option>
				<?endforeach?>
			</select>
		</div>
		<input <?=(sizeof( $disks ) == 0 or sizeof( $lvs ) == 0) ? 'disabled="disabled"' : '' ?> type="button" class="button" id="extend" value="<?=_("Extend")?>" />
	</div>

