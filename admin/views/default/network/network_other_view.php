<script type="text/javascript">
<!--
function easyfind_onclick() {
	var easy_enabled=document.getElementById("easy_enabled");
	var easyname=document.getElementById("easyname");

	if(easy_enabled.checked==true) {
		easyname.disabled = false;
	} else {
		easyname.disabled = true;
	}      		 
}
// -->
</script>

	<fieldset><legend><?=t("Windows share options")?></legend>
	<form id="OTHCFG" action="<?=FORMPREFIX?>/network/othupdate" method="post">
	<table class="networksettings">
		<tr>
			<td></td>
			<td><?=t('Hostname')?>:</td>
			<td><input type="text" name="hostname" size="10" value="<?=$hostname?>"/></td>
			<? if($err_hostname){?>
			<td><?=t('Invalid hostname. Only A-Z,a-z,0-9 and - allowed')?>.</td>
			<? } ?>
			<? if($err_changehostname){?>
			<td><?=t('Change hostname failed')?></td>
			<? } ?>
		</tr>
		<tr>
			<td></td>
			<td><?=t('Workgroup')?>:</td>
			<td><input type="text" name="workgroup" size="10" value="<?=$workgroup?>"/></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value='<?=t('Update')?>' name='samba_update'/></td>	
			<td></td>
		</tr>
	</table>
	</form>
	</fieldset>
	<fieldset><legend><?=t("Easyfind options")?></legend>
	<form id="OTHCFG" action="<?=FORMPREFIX?>/network/othupdate" method="post">
	<table class="networksettings">
		<tr>
			<td></td>
			<td><?=t('Use \'Easyfind\' to locate your Bubba')?>:</td>
			<td><input onclick="easyfind_onclick()" id="easy_enabled" type="checkbox" class="checkbox_radio" name="easyfind" <?=$easyfind[0]?>/>
				<?if($easyfind[1]):?>
					( <?=t('external ip is') . " " . $easyfind[1]?> )
					<input type="hidden" name='extip' value="<?=$easyfind[1]?>"/>
				<?endif?>
			</td>


		</tr>
		<tr>
			<td></td>
			<td><?=t('Easyfind name')?>:</td>
			<td><input id="easyname" <?if(!$easyfind[0]) echo "DISABLED "?>type="input" name="easyfind_name" value="<?=$easyfind[2]?>"/><br></td>
			<?if($err_easyfind) echo "<td>$err_easyfind</td>";?>

		</tr>

		<tr>
			<td></td>
			<td><input type="submit" value='<?=t('Update')?>' name='easyfind_update'/></td>	
			<td></td>
		</tr>
	</table>
	</form>
</fieldset>

