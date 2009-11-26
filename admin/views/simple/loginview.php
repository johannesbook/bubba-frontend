<div id="login">
<fieldset><legend><?=t('Login')?></legend>
<form method="post" action="login">
<table>
<tr>
	<td><?= t('Username')?></td>
	<td><input type="text" name="username" size="20" <?=isset($authfail)?'value="'.$username.'"':''?>/></td>
</tr>
<tr>
	<td><?= t('Password')?></td>
	<td><input type="password" name="password" size="20"/></td>
</tr>
<? if(isset($authfail)){?>
<tr><td colspan="2"><strong><?=t('Invalid user/password combination.')?></strong></td></tr>
<?}?>
<tr><td colspan="2"><input type="submit" value="<?=t('Login')?>"/></td></tr>
</table>
</form>
</fieldset>
</div>