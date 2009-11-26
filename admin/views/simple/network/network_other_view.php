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

<form id="OTHCFG" action="<?=FORMPREFIX?>/network/othupdate" method="post">
<fieldset><legend>Other</legend>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td></td>
		<td><?=t('Hostname')?>:</td>
		<td><input type="text" name="hostname" size="10" value="<?=php_uname('n')?>"/></td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Workgroup')?>:</td>
		<td><input type="text" name="workgroup" size="10" value="<?=$workgroup?>"/><br>&nbsp;</td>
	</tr>


	<tr>
		<td></td>
		<td><?=t('Use \'Easyfind\' to locate your Bubba')?>:</td>
		<td><input onclick="easyfind_onclick()" id="easy_enabled" type="checkbox" name="easyfind" <?=$easyfind[0]?>/></td>
		<?if($easyfind[1]) echo "<td>(" . t('external ip is') . " $easyfind[1])\n<input type=\"hidden\" name='extip' value=\"$easyfind[1]\"/></td>";?>
		
		
	</tr>
	<tr>
		<td></td>
		<td><?=t('Easyfind name')?>:</td>
		<td><input id="easyname" <?if(!$easyfind[0]) echo "DISABLED "?>type="input" name="easyfind_name" value="<?=$easyfind[2]?>"/><br></td>
		<?if($err_easyfind) echo "<td>(" . t('Name') . " \"$easyfind[3]\" is illegal or not avaiable.</td>";?>
		
	</tr>

	<tr>
		<td></td>
		<td><input type="submit" value='<?=t('Update')?>' name='update'/></td>	
		<td></td>
	</tr>
</table>
</fieldset>
</form>

