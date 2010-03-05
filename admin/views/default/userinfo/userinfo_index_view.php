<form action="<?=FORMPREFIX?>/userinfo/update" method="post">
<table cellpadding="3" border="0">
<tr><td colspan="2" class="ui-state-default ui-widghet-header"><?=t('Edit user information')?></td></tr>
<tr>
	<td style="width: 120px;"><?=t('Username')?></td>
	<td><?=$uname?></td>
</tr>
<tr>
	<td><?=t('Real name')?></td>
	<td><input type="text" name="realname" size="25" value="<?=$realname?>"/></td>
</tr>
</table>
    <input class="submitbutton" type="submit" name="submit" value='<?=t('Submit changes')?>'/>
	<input type="hidden" name="uname" value="<?=$uname?>"/>
 	<input type="hidden" name="shell" value=""/>
</form>

<form action="<?=FORMPREFIX?>/userinfo/chpwd" method="post">
    <input type="submit" value="<?=t('Change password')?>" name="chpwd"/>
	<input type="hidden" value="<?=$uname?>" name="uname"/>
</form>
	 