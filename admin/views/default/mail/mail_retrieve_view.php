<table id="fn-mail-retrieve">
<thead>
<tr>
	<th colspan="7" class="ui-state-default ui-widget-header"><?=t('mail-retrieve-title')?></th>
</tr>
<tr class="ui-filemanager-state-header">
   <th><?=t('Host')?></th>
   <th><?=t('Protocol')?></th>
   <th><?=t('Username')?></th>
   <th><?=t('Local user')?></th>
   <th><?=t('SSL')?></th>
   <th><?=t('Leave email on server')?></th>
   <th>&nbsp;</th>
</tr>
</thead>
<tbody>
</tbody>
<tfoot>
<tr><td colspan="7">
<button id="fn-retrieve-add"><?=t("mail-retrieve-add-button-label")?></button>
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
<h2 class="fn-dialog-header"></h2>
	<table>
	<tr>
	   <td><label for="server"><?=t('mail-retrieve-edit-host-label')?></label></td>
	   <td><input class="fn-primary-field" type="text" name="server"/></td>
	</tr>
	<tr>
	   <td><label for="protocol"><?=t('mail-retrieve-edit-protocol-label')?></label></td>
	   <td>
		  <select name="protocol">
			 <option value="AUTO">AUTO</option>
			 <option value="POP2">POP2</option>
			 <option value="POP3">POP3</option>
			 <option value="IMAP">IMAP</option>
			 <option value="ETRN">ETRN</option>
			 <option value="ODMR">ODMR</option>
		  </select>
	   </td>
	</tr>
	<tr>
	   <td><label for="ruser"><?=t('mail-retrieve-edit-ruser-label')?></label></td>
	   <td><input type="text" name="ruser"/></td>
	</tr>
	<tr>
	   <td><label for="password"><?=t('mail-retrieve-edit-password-label')?></label></td>
	   <td><input type="password" name="password"/></td>
	</tr>
	<tr>
	   <td><label for="luser"><?=t('mail-retrieve-edit-luser-label')?></label></td>
	   <td>
		  <select name="luser" size="1">

		  <?foreach($userlist as $user):?>
		  <option><?=$user?></option>
		  <?endforeach?>

		  </select>
	   </td>
	</tr>
	<tr>
	   <td><label for="usessl"><?=t('mail-retrieve-edit-usessl-label')?></label></td>
	   <td><input type="checkbox" class="checkbox_radio" name="usessl"/></td>
	</tr>
	<tr>
	   <td><label for="keep"><?=t('mail-retrieve-edit-keep-label')?></label></td>
	   <td><input type="checkbox" class="checkbox_radio" name="keep"/></td>
	</tr>

	</table>
</form>
</div>
</div>
