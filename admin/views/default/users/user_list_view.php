<table>
<tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('Users')?></td></tr>
<tr>
	<th><i><?=t('username')?></i></th>
	<th><i><?=t('realname')?></i></th>
	<th><i><?=t('shell_login')?></i></th>
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
	<div id="div_users_userlist">
	<form action="<?=FORMPREFIX?>/users/edit" method="post">
		<td>
			<input
				type="submit"
				name="edit"
				value="<?=t('Edit user')?>"
			/>
			<input
				type="hidden"
				name="uname"
				value="<?=$username?>"
			/>
		</td>
	</form>
</div>
</tr>
<? } ?>
</table>

	<form action="<?=FORMPREFIX?>/users/add" method="post">
		<table border="0" cellpadding="0">
		<tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('Add new user')?></td></tr>
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
		</table>
		<input class="submitbutton" type="submit" name="adduser" value="<?=t('Add user')?>"/>
	</form>
