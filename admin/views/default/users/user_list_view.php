<fieldset><legend><i><?=t('Users')?></i></legend>
<table cellpadding="1" cellspacing="0" border="1">
<tr>
	<th><i><?=t('Login name')?></i></th>
	<th><i><?=t('Real name')?></i></th>
	<th><i><?=t('Shell login')?></i></th>
	<th>&nbsp;</th>
</tr>
<? foreach($userinfo as $username => $info){?>
<tr>
	<td>
		<?=$username?>
	</td>
	<td>
		<?=$info["realname"]?$info["realname"]:"&nbsp;"?>
	</td>
	<td>
<? if($username!="admin"){ ?>
		<?=$info["shell"]?t("Yes"):t("No")?>
<? } ?>
	</td>
	<form action="<?=FORMPREFIX?>/users/edit" method="post">
		<td>
			<input type="hidden" value="<?=$username?>" name="uname"/>
			<input type="submit" name="edit" value="<?=t('Edit user')?>"/>
		</td>
	</form>
</tr>
<? } ?>
</table>
</fieldset>
<p/>
<hr style="width:75%;"/>
<fieldset><legend><i><?=t('Add new user')?></i></legend>
<?=t('Please enter a new username and user details')?>
<form action="<?=FORMPREFIX?>/users/add" method="post">
<table border="0" cellpadding="0">
<tr>
	<td><?=t('Username')?>:</td>
	<td><input type="text" name="uname" value="<?=$uname?>" size="30"/></td>
</tr>
<tr>
	<td><?=t('Real name')?>:</td>
	<td><input type="text" name="realname" value="<?=$realname?>" size="30"/></td>
</tr>
<tr>
	<td><?=t('Allow ssh login')?>:</td>
	<td>
		<input type="radio" class="checkbox_radio" name="shell" value="/bin/bash" <?=$shellyes?'checked="checked"':''?>/> <?=t('Yes')?> 
		<input type="radio" class="checkbox_radio" name="shell" value="/sbin/nologin" <?=$shellno?'checked="checked"':''?> /> <?=t('No')?>
	</td>
</tr>
<tr>
	<td><?=t('Enter user password')?>:</td>
	<td><input type="password" name="pass1" size="30"/></td>
</tr>
<tr>
	<td><?=t('Verify password')?>:</td>
	<td><input type="password" name="pass2" size="30"/></td>
</tr>
<tr>
	<td></td>
	<td>
		<input class="submitbutton" type="submit" name="adduser" value="<?=t('Add user')?>"/>
	</td>
</tr>
</table>
</form>
</fieldset>
