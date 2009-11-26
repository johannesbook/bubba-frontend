<form action="<?=FORMPREFIX?>/users/dochpwd" method="post">
<fieldset><legend><?=t('Change password for user')?> '<?=$uname?>'</legend>
<table>
	<tr>
		<td><?=t('New password')?></td>
		<td><input type="password" width="25" name='pass1'/></td>
	</tr>
	<tr>
		<td><?=t('Verify password')?></td>
		<td><input type="password" width="25" name='pass2'/></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="hidden" name='uname' value='<?=$uname?>'/>
			<input type="submit" name="change" value='<?=t('Submit changes')?>'/>
		</td>
	</tr>
</table>
</fieldset>
</form>