<fieldset><legend><i><?=t('Backup and restore settings')?></i></legend>
<script  type="text/javascript">
<?
	$disable=count($disks)==0?"disabled=\"disabled\"":"";
?>
	function updateform(val){
		$(".unitclass").val($("#unitselector").val());
	}
</script>

<table border="0" cellpadding="0">
<tr>
	<td colspan="2"><?=t('Source')?>/<?=t('Destination')?></td>
	<td>
		<select name="destination" id="unitselector">
<? if(count($disks)>0){
		foreach($disks as $disk){ ?>
			<option value="<?=$disk?>"><?=$disk?></option>
<?		} 
	}else{?>
			<option><?=t('No backup medium found')?></option>
<?	} ?>
		</select>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<form action="<?=FORMPREFIX?>/settings/restore" onsubmit="updateform();" method="post" id="restoreform">
			<input class="unitclass" type="hidden" name="unit"/>
			<input type="submit" name="restore" value="<?=t('Restore')?>" <?=$disable?>/>
		</form>
	</td>
	<td>
		<form action="<?=FORMPREFIX?>/settings/backup" onsubmit="updateform();" method="post" id="backupform">
			<input class="unitclass" type="hidden" name="unit"/>
			<input type="submit" name="backup" value="<?=t('Backup')?>" <?=$disable?>/>
		</form>
	</td>
</tr>
</table>
</fieldset>

