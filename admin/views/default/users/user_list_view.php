<?if($show_allusers):?>
<table id="fn-users-list" class="ui-table-outline">
<thead>
<tr>
	<th colspan="4" class="ui-state-default ui-widget-header"><?=_("Users")?></th>
</tr>
<tr class="ui-header">
   <th><?=_("User name")?></th>
   <th><?=_("Real name")?></th>
   <th><?=_("Allow shell login")?></th>
   <th>&nbsp;</th>
</tr>
</thead>
<tbody>
</tbody>
<tfoot>
<?if($show_adduser):?>
<tr><td colspan="4">
<button class="submit" id="fn-users-list-add"><?=_("Add new user")?></button>
</td></tr>
<?endif?>
</tfoot>
</table>

<?else :?>
<table id="fn-users-list">
<thead>
<tr>
	<th colspan="4" class="ui-state-default ui-widget-header"><?=_("User information")?></th>
</tr>
</table>

<?endif?>


<div id="fn-users-dialogs" class="ui-helper-hidden">
<div id="fn-users-list-edit">
<form>
<input type="hidden" name="username"/>
<?if($show_allusers):?>
<h2 class="fn-dialog-header ui-dialog-header"></h2>
<?endif?>
	<table class="ui-table-outline">
	<tr>
	   <td><label for="username"><?=_("User name")?></label></td>
	   <td><input type="text" name="input_username"><span id="fn-user-username-text"></span></td>
	</tr>
	<tr>
	   <td><label for="realname"><?=_("Real name")?></label></td>
	   <td><input type="text" name="realname"/></td>
	</tr>
	<tr>
	   <td><label for="password1"><?=_("New password")?></label></td>
	   <td><input type="password" name="password1"/></td>
	</tr>
	<tr>
	   <td><label for="password2"><?=_("Confirm password")?></label></td>
	   <td><input type="password" name="password2"/></td>
	</tr>

	<? // only view for admin ?>
	<tr>
		<td>
			<label for="system_language">
				<?=_("User language");?>
			</label>
		</td>
		<td>
			<a id="fn-default-lang-link" href="<?=FORMPREFIX?>/settings/datetime"><?=_("Default system language")?></a>
		</td>
	</tr>


	<? // all but admin admin ?>
	<tr>
	   <td>
	   	<label for="system_language">
			<?=_("User language");?>
   	   	</label>
   	   </td>
	   <td>
	   	  <select name="lang"> 
	   	  	
	   	  	<?
   	  		foreach($available_languages as $lang) {
   				if($lang['status'] != 'official') {
   	  				$user_languages[] = $lang;
   	  				continue;
   	  			}
		 		print "<option id='option_".$lang["short_name"]."' value='".$lang["short_name"]."'>";
		 		print $lang["long_name"];
		 		print "</option>\n";
   	  			
   	  		}
     		if(sizeof($user_languages)) {
			print "<optgroup label='"._("User contributed languages")."'>";
     			
	     		foreach($user_languages as $lang) {
	     			if($lang['status'] != 'user') continue;
		 		print "<option id='option_".$lang["short_name"]."' value='".$lang["short_name"]."'>";
		 		print $lang["long_name"];
		 		print "</option>\n";
	     			
	     		}
     			print "</optgroup>";
     		}?>
		  </select>
	   
	   </td>
	</tr>
	<?
	/*
	<tr>
	   <td><label for="sideboard"><?=_("Display sideboard for non-logged in users")?></label></td>
	   <td><input type="checkbox" name="sideboard"/></td>
	</tr>
	*/
	?>
	<tr>
	   <td><label for="remote"><?=_("Allow remote access to system settings")?></label></td>
	   <td><input type="checkbox" name="remote"/></td>
	</tr>
	<tr>
	   <td><label for="shell"><?=_("Shell login")?></label></td>
	   <td><input type="checkbox" name="shell"/></td>
	</tr>
	</table>
</form>
</div>
</div>
