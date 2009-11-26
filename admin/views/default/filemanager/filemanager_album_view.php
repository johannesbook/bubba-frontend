<fieldset><legend><i><?=t('Add to album')?></i></legend>
<form method="post" action="<?=FORMPREFIX?>/filemanager/doalbum">
<input type="hidden" name="path" value="<?=$path?>"/>
<? if(count($files)==0){ ?>
<table>
<tr><td><?=t('No files checked')?></td></tr>
<tr><td><input type="submit" name="cancel" value="<?=t('Cancel')?>"/></td></tr>
</table>
<? }else{ ?>
<fieldset><legend><?=t('Items')?></legend>
<div style="height: 150px; overflow: auto; ">
<table>   
	<? foreach($files as $name=>$fpath){ ?>
	<tr>
		<td>
			<input type="hidden" name="file_list[]" value="<?=$fpath?>"/>      
			<?=$name?>
		</td>
	</tr>
	<?    } ?> 
</table>
</div>
</fieldset>
<hr/>
<?=t('Do you wish to add following items to the photo album')?>?<br/>
<input type="submit" name="cancel" value="<?=t('Cancel')?>"/>      
<input type="submit" name="confirm" value="<?=t('Add')?>"/>
</form>
</fieldset>
<? } ?>
