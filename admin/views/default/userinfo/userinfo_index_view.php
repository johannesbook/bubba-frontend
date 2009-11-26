<fieldset><legend><i><?=t('Edit user information')?></i></legend>
<form action="<?=FORMPREFIX?>/userinfo/update" method="post">
<table cellpadding="3" border="0">
<tr>
	<td style="width: 120px;"><?=t('Username')?></td>
	<td><?=$uname?></td>
</tr>
<tr>
	<td><?=t('Real name')?></td>
	<td><input type="text" name="realname" size="25" value="<?=$realname?>"/></td>
</tr>
<tr>
	<td></td>
	<td>
		<input class="submitbutton" type="submit" name="submit" value='<?=t('Submit changes')?>'/>
		<input type="hidden" name="uname" value="<?=$uname?>"/>
	 	<input type="hidden" name="shell" value=""/>
	</td>
</tr>
</table>
</form>
<table>
<p/>
<hr style="width:75%;"/>
<tr>
	<td>
	<form action="<?=FORMPREFIX?>/userinfo/chpwd" method="post">
		<input type="submit" value="<?=t('Change password')?>" name="chpwd"/>
		<input type="hidden" value="<?=$uname?>" name="uname"/>
	</form>
	</td>
</tr>
</fieldset>
	 