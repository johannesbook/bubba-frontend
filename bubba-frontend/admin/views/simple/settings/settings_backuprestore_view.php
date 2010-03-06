<fieldset><legend><i><?=t('Backup and restore')?></i></legend>
<table border="0" cellpadding="0">
<tr>
   <td>
		<form action="<?=FORMPREFIX?>/settings/restore" method="post">
      	<input type="submit" name="restore" value="<?=t('Restore')?>"/>
      </form>
   </td>
   <td>
		<form action="<?=FORMPREFIX?>/settings/backup" method="post">
      	<input type="submit" name="backup" value="<?=t('Backup')?>"/>
      </form>
   </td>
</tr>
</table>
</fieldset>
