<form action="<?=FORMPREFIX?>/users/update" method="post">
<table>
    <tr><td colspan="2" class="ui-state-default ui-widghet-header"><?=t('Edit user information')?></td></tr>
    <tr>
	    <td style="width: 120px;"><?=t('username')?></td>
	    <td><?=$uname?></td>
    </tr>
    <tr>
	    <td><?=t('realname')?></td>
	    <td><input type="text" name="realname" value="<?=$realname?>"/></td>
    </tr>
    <tr valign="top">
     	<td><?=t('users_pwd1')?>:</td>
	    <td>
		    <input
			    id="input_users_pwd1"
			    type="password"
			    name="pwd1"
			    autocomplete="off"
		    />
	    </td>
    </tr>
    <tr valign="top">
     	<td><?=t('users_pwd2')?>:</td>
	    <td>
		    <input
			    id="input_users_pwd2"
			    type="password"
			    name="pwd2"
			    autocomplete="off"
		    />
	    </td>
    </tr>

    <? if( isset($user_is_admin) && $user_is_admin ){?>
    <tr valign="top">
	     <td><?=t('allow_remote')?>:</td>
	     <td>
	     	<input type="radio" class="checkbox_radio" name="remote" value='true' <?= $remote?"checked":""?> /> <?=t('Yes')?><br/>
	     	<input type="radio" class="checkbox_radio" name="remote" value='false' <?= $remote?"":"checked"?>/> <?=t('No')?>
	     </td>
    </tr>
    <tr valign="top">
	     <td><?=t('show_default_sideboard')?>:</td>
	     <td>
	     	<input type="radio" class="checkbox_radio" name="default_sideboard" value='true' <?= $default_sideboard?"checked":""?> /> <?=t('Yes')?><br/>
	     	<input type="radio" class="checkbox_radio" name="default_sideboard" value='false' <?= $default_sideboard?"":"checked"?>/> <?=t('No')?>
	     </td>
    </tr>
    <? } else { // admin "view"?>
    <tr valign="top">
	     <td><?=t('allow_ssh')?>:</td>
	     <td>
	     	<input type="radio" class="checkbox_radio" name="shell" value='true' <?= $shell?"checked":""?> /> <?=t('Yes')?><br/>
	     	<input type="radio" class="checkbox_radio" name="shell" value='false' <?= $shell?"":"checked"?>/> <?=t('No')?>
	     </td>
    </tr>



    <? } ?>
</table>
<input id="btn_users_submit_change"	type="submit" name="submit" value='<?=t('Submit changes')?>'/>
<?if($show_deleteuser):?>
	<input id="btn_users_del_user" type="submit" name="delete" <?if(isset($user_is_admin) && $user_is_admin):?> disabled = "disabled" <?endif?> value="<?=t('Delete user')?>" />
<?endif?>
<input id="btn_users_cancel" type="submit" name="cancel" value="<?=t('Cancel')?>"/>
<input id="hdn_users_uname" type="hidden" name="uname" value="<?=$uname?>" />
</form>
	 
