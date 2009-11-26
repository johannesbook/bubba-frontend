<div id="login">
<form method="post" action="login">
<fieldset>
<legend><?=t('Login')?></legend>
<table>
<tr>
	<td><?= t('Username')?></td>
	<td><input class="login" type="text" name="username" size="20" <?=isset($authfail)?'value="'.$username.'"':''?>/></td>
</tr>
<tr>
	<td><?= t('Password')?></td>
	<td><input class="login" type="password" name="password" size="20"/></td>
</tr>
<? if(isset($authfail) && !isset($authill)){?>
<tr><td colspan="2"><strong><?=t('Invalid user/password combination.')?></strong></td></tr>
<?}elseif(isset($authill)){?>
<tr><td colspan="2"><strong><?=t('Admin user not allowed to login on wan interface.')?></strong><br/><?=t('Please read quickstart guide for advice.')?></td></tr>
<?}?>
<tr><td colspan="2"><input type="submit" value="<?=t('Login')?>"/></td></tr>
</table>
</fieldset>
</form>
</div>
