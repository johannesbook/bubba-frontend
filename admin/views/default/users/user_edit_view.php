<fieldset><legend><i><?=t('Edit user information')?></i></legend>
<form action="<?=FORMPREFIX?>/users/update" method="post">
<table cellpadding="3" border="0">
<tr>
	<td style="width: 120px;"><?=t('Username')?></td>
	<td><?=$uname?></td>
</tr>
<tr>
	<td><?=t('Real name')?></td>
	<td><input type="text" name="realname" size="25" value="<?=$realname?>"/></td>
</tr>
<? if($uname!="admin"){?>
<tr valign="top">
	 <td><?=t('Allow SSH login')?>:</td>
	 <td>
	 	<input type="radio" class="checkbox_radio" name="shell" value='true' <?= $shell?"checked":""?> /> <?=t('Yes')?><br/>
	 	<input type="radio" class="checkbox_radio" name="shell" value='false' <?= $shell?"":"checked"?>/> <?=t('No')?>
	 </td>
</tr>
<? } else { // admin "view"?>
<tr valign="top">
	 <td><?=t('Allow remote access to config interface')?>:</td>
	 <td>
	 	<input type="radio" class="checkbox_radio" name="remote" value='true' <?= $this->session->userdata("AllowRemote")?"checked":""?> /> <?=t('Yes')?><br/>
	 	<input type="radio" class="checkbox_radio" name="remote" value='false' <?= $this->session->userdata("AllowRemote")?"":"checked"?>/> <?=t('No')?>
	 </td>
</tr>

<? } ?>
<tr>
	<td></td>
	<td>
		<input class="submitbutton" type="submit" name="submit" value='<?=t('Submit changes')?>'/>
		<input type="hidden" name="uname" value="<?=$uname?>"/>
	</td>
</tr>
</table>
</form>
<table>
<p/>
<hr style="width:75%;"/>
<tr>
	<td <?= $uname=="admin"?'colspan="2"':""?>>
	<form action="<?=FORMPREFIX?>/users/chpwd" method="post">
		<input type="submit" value="<?=t('Change password')?>" name="chpwd"/>
		<input type="hidden" value="<?=$uname?>" name="uname"/>
	</form>
	</td>
<? if($uname!="admin"){?>	
	<td>
	<form action="<?=FORMPREFIX?>/users/askdelete" method="post">
		<input type="submit" value="<?=t('Delete user')?>" name="delete"/>
		<input type="hidden" value="<?=$uname?>" name="uname"/>
	</form>
	</td>
<? } ?>
</tr>
</fieldset>
	 
