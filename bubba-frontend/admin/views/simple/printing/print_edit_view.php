<fieldset><legend><i><?=t('Edit printer')?></i></legend>
<table>
	<tr>
		<td><?=t('Name')?>:</td>
		<td><?=$name?></td>
	</tr>
	<tr>
		<td><?=t('Description')?>:</td>
		<td><?=$info?></td>
	</tr>
	<form action="<?=FORMPREFIX?>/printing/update" method="post">
	<tr>
		<td><?=t('Location')?>:</td>
		<td>
			<input type="text" name="loc" value="<?=$loc?>"/>
		</td>
	</tr>
		<input type="hidden" name="url" value="<?=$url?>"/>
		<input type="hidden" name="name" value="<?=$name?>"/>
		<input type="hidden" name="info" value="<?=$info?>"/>
	<tr>
		<td><input type="submit" name="cancel" value="<?=t('Cancel')?>"/></td>
		<td><input type="submit" name="update" value="<?=t('Update')?>"/></td>
	</tr>
	</form>
	<form method="post" action="<?=FORMPREFIX?>/printing/delete">
	<input type="hidden" name="name" value="<?=$name?>"/>
	<tr>
   	<td colspan="2"><input type="submit" name="delete" value="<?=t('Delete')?>"/></td>
   </tr>
   </form>
</table>
</fieldset>
