<table id="fn-mail-retrieve" class="ui-table-outline">
<thead>
<tr>
	<th colspan="7" class="ui-state-default ui-widget-header"><?=_("Retrieve email")?></th>
</tr>
<tr class="ui-filemanager-state-header">
   <th><?=_("Host")?></th>
   <th><?=_("Protocol")?></th>
   <th><?=_("Username")?></th>
   <th><?=_('Local user')?></th>
   <th><?=_("Encrypted")?></th>
   <th><?=_('Leave copy')?></th>
   <th>&nbsp;</th>
</tr>
</thead>
<tbody>
</tbody>
<tfoot>
<tr><td colspan="7">
<button class="submit" id="fn-retrieve-add"><?=_("Add new email account")?></button>
</td></tr>
</tfoot>
</table>


<div id="fn-mail-dialogs" class="ui-helper-hidden">
<div id="fn-mail-retrieve-edit">
<form>
<input type="hidden" name="old_server"/>
<input type="hidden" name="old_protocol"/>
<input type="hidden" name="old_ruser"/>
<input type="hidden" name="old_luser"/>
<?if(!$edit_allusers):?>
<input type="hidden" name="luser" value="<?=$this->session->userdata("user")?>"/>
<?endif?>
<h2 class="fn-dialog-header"></h2>
	<table>
	<tr>
	   <td><label for="server"><?=_("Host")?></label></td>
	   <td><input class="fn-primary-field" type="text" name="server"/></td>
	</tr>
	<tr>
	   <td><label for="protocol"><?=_("Protocol")?></label></td>
	   <td>
		  <select name="protocol">
			 <option value="POP3" selected="selected">POP3</option>
			 <option value="POP2">POP2</option>
			 <option value="IMAP">IMAP</option>
			 <option value="ETRN">ETRN</option>
			 <option value="ODMR">ODMR</option>
			 <option value="AUTO">AUTO</option>
		  </select>
	   </td>
	</tr>
	<tr>
	   <td><label for="ruser"><?=_("Remote user")?></label></td>
	   <td><input type="text" name="ruser"/></td>
	</tr>
	<tr>
	   <td><label for="password"><?=_("Password")?></label></td>
	   <td><input type="password" name="password"/></td>
	</tr>
<?if($edit_allusers):?>
	<tr>
	   <td><label for="luser"><?=_("Local user")?></label></td>
	   <td>
		  <select name="luser" size="1">

		  <?foreach($userlist as $user):?>
		  <option value="<?=$user?>"><?=$user?></option>
		  <?endforeach?>

		  </select>
	   </td>
	</tr>
<?endif?>
	<tr>
	   <td><label for="usessl"><?=_("Use encryption")?></label></td>
	   <td><input type="checkbox" class="checkbox_radio" name="usessl"/></td>
	</tr>
	<tr>
	   <td><label for="keep"><?=_("Leave email copy on server")?></label></td>
	   <td><input type="checkbox" class="checkbox_radio" name="keep"/></td>
	</tr>

	</table>
</form>
</div>
</div>
