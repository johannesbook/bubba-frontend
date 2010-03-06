
<fieldset><legend><i><?=t('Downloads')?></i></legend>
<div style="height: 350px; overflow: auto; " id="downloadcontent">
<table cellpadding="0" cellspacing="0" border="0">
<?	foreach($dls as $dl){
		if($dl["size"]==0){
			$dld=0;
		}else{
			$dld=($dl["downloaded"]/$dl["size"])*100;
		}
		if(!($dl["policy"]&&DLP_HIDDEN)){
?>
<tr>
	<td colspan="2" width="80%"><b><?=substr($dl["name"], 0, 50)?></b></td>
	<td width="10%" rowspan="2" style="text-align: center;"><b><?printf("%d%%",$dld)?></b></td>
	<td width="10%" rowspan="2" style="text-align: center; vertical-align: middle; ">
		<form action="<?=FORMPREFIX?>/downloads/remove" method="post">
		<fieldset>
			<input type="hidden" name="url" value="<?=$dl["url"]?>"/>
			<input type="hidden" name="uuid" value="<?=$dl["uuid"]?>"/>
			<input type="submit" name="do" value="<?=t('Cancel')?>"/>
		</fieldset>
		</form>
	</td>
</tr>
<tr>
	<td><? print $dl["info"]?></td>
	<td align="right">Size: <?=sizetohuman($dl["size"])?></td>
</tr>
<? 	}
	}?>
</table>
</div>
</fieldset>

<fieldset><legend><?=t('Add new download')?></legend>
<form action="<?=FORMPREFIX?>/downloads/add" method="post" id="add_download">
<table>
<tr>
   <td style="width: 10%; text-align: left; "><?=t('Location')?></td>
   <td style="width: 90%; text-align: center; "><input type="text" name="url" size="40"/></td>
</tr>
<tr>
<td>
	<input type="hidden" name="uuid" value="<?=$uuid?>" />
	<input type="submit" name="add_download" value="<?=t('Add')?>" />
</td>
</tr>
</table>
</form>
</fieldset>
