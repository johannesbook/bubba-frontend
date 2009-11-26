
	<table id="wizard">
		<tr><td class="wiz_head" colspan="2"><?=t('Step 2/3: Create users')?></td></tr>
	</table>

	<form action="<?=FORMPREFIX?>/users/wizard"" method="post">
	<fieldset id="wizard"><legend><?=t("Add users")?></legend>
		<table id="wizard">
			<tr><td><?=t("Username")?>:</td><td><input autocomplete='off' class='adduser' type='text' name='uname' value='<?=isset($uname)?$uname:""?>'/><?=isset($err['uname'])?"<span class=\"highlight\">*</span>":""?></td></tr>
			<tr><td><?=t("Real name")?>:</td><td><input autocomplete='off' class='adduser' type='text' name='realname' value='<?=isset($realname)?$realname:""?>'/><?=isset($err['realname'])?"<span class=\"highlight\">*</span>":""?></td></tr>
			<tr>
				<td><?=t("Allow ssh login")?>:</td>
				<td>	<input class='checkbox_radio' type='radio' name='shell' value='/bin/bash' <?=isset($shell)?"CHECKED":""?>/> <?=t("Yes")?>
							<input class='checkbox_radio' type='radio' name='shell' value='/sbin/nologin' <?=isset($shell)?"":"CHECKED"?>/> <?=t("No")?>
				</td>
			</tr>
			<tr><td><?=t("Enter user password")?>:</td><td><input autocomplete='off' class='adduser' type='password' name='pass1' value=''/><?=isset($err['pwd'])?"<span class=\"highlight\">*</span>":""?></td></tr>
			<tr><td><?=t("Verify password")?>:</td><td><input autocomplete='off' class='adduser' type='password' name='pass2' value=''/></td></tr>
			<?
				if(isset($err)) {
					print "<tr><td></td><td class=\"highlight\">* ";
					if(isset($err['uname'])) 
						print $err['uname'];
					if(isset($err['pwd'])) 
						print $err['pwd'];
				}
			?>
			<tr><td></td><td><input class='submitbutton' type='submit' name='wiz_data[adduser]' value='<?=t('Add user')?>'/></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td colspan="2"><input class='submitbutton' type='submit' name='wiz_data[back]' value='<?=t('Back')?>'/><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/><span class="wiz_spacer">&nbsp;</span><input class='submitbutton' type='submit' name="wiz_data[postingpage]" value='<?=t('Next')?>'/></td></tr>
		</table>
	</fieldset>
	</form>

	<div class="wiz userlist">
	<table id="wizard_ulist">
	<tr><td colspan="2" class="wiz_head"><?=t("Existing users")?></td></tr>	
	<tr><td class="wiz_head"><?=t("Username")?></td><td class="wiz_head"><?=t("Real name")?></td></tr>	
	<?
	foreach($wiz_data['ulist'] as $user => $udata) {
		print "<tr><td>$user</td><td>$udata[realname]</td></tr>";
	}
	?>		
	</table>
	</div>
