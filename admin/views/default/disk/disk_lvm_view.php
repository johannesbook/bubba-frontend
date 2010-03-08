    <div class="ui-state-default ui-widghet-header ui-div-header"><?=t('Extend logical volume')?></div>
	<div id="lvm">
		<?=t("Extend")?>
		<select  <?= sizeof( $lvs ) == 0 ? 'disabled="disabled"' : '' ?> id="logical_volume" class="volume">
			<?foreach( $lvs as $lv ):?>
				<option value="<?=$lv?>"><?
					switch($lv) {
						case "bubba-storage":
							print t("Home partition");
							break;
						default:
							print $lv;
							break;
					}
					?></option>
			<?endforeach?>
		</select> 
		<?=t("with")?>
		<select  <?=sizeof( $disks ) == 0 ? 'disabled="disabled"' : '' ?>  id="disk" class="disk">
			<?foreach( $disks as $disk ):?>
				<option value="<?=$disk?>"><?=$disk?></option>
			<?endforeach?>
		</select>
		<p><input <?=(sizeof( $disks ) == 0 or sizeof( $lvs ) == 0) ? 'disabled="disabled"' : '' ?> type="button" class="button" id="extend" value="<?=t("Extend")?>" /></p>
	</div>

