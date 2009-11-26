<?if (isset($success)) if(!$success) echo "Update failure<br>\n";?>

<form id="FWCFG" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
<fieldset><legend><?=t('Integrated Bubba services')?></legend>
<table border="0" cellpadding="1" cellspacing="1">
	<tr><td width="20"></td><td><?=t('Allow SSH from WAN')?>:</td><td><input type="checkbox" name="allowSSH" <?if($allowSSH) echo "CHECKED"?>/></td></tr>
	<tr><td width="20"></td><td><?=t('Allow WWW from WAN')?>:</td><td><input type="checkbox" name="allowWWW" <?if($allowWWW) echo "CHECKED"?>/></td></tr>
	<tr><td width="20"></td><td><?=t('Allow FTP from WAN')?>:</td><td><input type="checkbox" name="allowFTP" <?if($allowFTP) echo "CHECKED"?>/></td></tr>
	<tr><td width="20"></td><td><?=t('Allow Ping from WAN')?>:</td><td><input type="checkbox" name="allowPing" <?if($allowPing) echo "CHECKED"?>/></td></tr>
	<tr><td><p></p></tr>

	<tr><td width="20"></td><td><input type="submit" value='<?=t('Update')?>' name='update'/></td><td></td></tr>
</table>
</fieldset>
</form>

<form id="PORTCFG" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
<fieldset><legend><?=t('Add port forward')?></legend>
<table border="0" cellpadding="1" cellspacing="1">
<? //	<tr><td width="20"></td><td><?=t('Enabled')?><? //:</td><td><input type="checkbox" name="enabled"/></td></tr> ?>
	<tr><td width="20"></td><td><?=t('Public port')?>:</td><td><input type="text" name="dport" size="10"/></td><td>(range accepted)</td></tr>
	<tr><td width="20"></td><td><?=t('Private port')?>:</td><td><input type="text" name="to_port" size="10"/></td><td>(startport if range entered)</td></tr>
	<tr><td width="20"></td><td><?=t('Private ip')?>:</td><td><input type="text" name="to_ip" size="10"/></td></tr>
	<tr><td width="20"></td><td><?=t('Protocol')?>:</td><td><SELECT name="protocol"><OPTION value="tcp">TCP</OPTION><OPTION value="udp">UDP</OPTION><OPTION value="all">ALL</OPTION></SELECT></td></tr>	
	<tr><td width="20"></td><td><input type="submit" value='<?=t('Update')?>' name='newport'/></td></tr>
	
</table>
</fieldset>
</form>


<form id="RMPORT" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
<fieldset><legend><?=t('Existing port forwards')?></legend>
<table border="0" cellpadding="1" cellspacing="1">
	<tr>
	  <td width="20"></td>
	  <td><?=t('Remove')?></td>
    <td><?=t('Public port')?></td>
    <td><?=t('Private port')?></td>
    <td><?=t('Private ip')?></td>
	</tr>
	
  <?
  $i=1;
  foreach($fwports as $value) { ?>
	<tr>
		<td width="20"><input type="hidden" name="rowid[<?=$i?>]" value="0"/></td>
		<td><input type="checkbox" name="cb_remove[<?=$i?>]"/></td>
		<? /*<td><input type="checkbox" DISABLED name="cb_enable" <?if($value["enabled"]) echo "CHECKED";?>/></td>*/ ?>
		<td><input type="input" DISABLED name="dport" value="<?=$value["dport"]?>"/></td>
		<td><input type="input" DISABLED name="to_port" value="<?=$value["to_port"]?>"/></td>
		<td><input type="input" DISABLED name="to_ip" value="<?=$value["to_ip"]?>"/></td>
		<input type="hidden" name="port" value="<?=$value["to_port"]?>"/>
	</tr>
<?
$i++;
}
?>
<tr><td><p></p></tr>
<tr><td width="20"></td><td><input type="submit" value='<?=t('Update')?>' name='removeport'/></td></tr>
</table>
</fieldset>

</form>

