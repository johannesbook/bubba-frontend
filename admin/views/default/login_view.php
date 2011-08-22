<h1>&nbsp;</h1>
<div id="login_menubar">

<?foreach($main_menu as $menuitem) {
	print "\t$menuitem\n";
}?>
</div>

<div id="login_more_info">
    <span><?=_("For more information")?>:</span>
    <a href="/manual/index.php?lang=<?=LANGUAGE?>" target="_blank"><?=_("Manual")?></a>|
    <a href="http://forum.excito.net" target="_blank">Forum</a>|
    <a href="http://www.excito.com/bubba/support/" target="_blank"><?=_("Support")?> &amp; <?=_("Contact")?></a>
    <a href="http://www.excito.com" alt="Excito homepage" target="_blank"><img id="" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/bubba_heart.png"/></a>
</div>

<div id="div-login-dialog">
<form method="post" class="ui-form-login-dialog" id="fn-login-dialog-form">
	<h2 class="ui-text-center"><?=_("Login required")?></h2>
	<table>
		<tr>
			<td>
				<label for="username"><?=_("Username")?>:</label><br>
				<div id="login-dialog-required-user"><?isset($required_user)?$required_user:""?></div>
				<input
					type="text" 
					name="username"
					class="ui-input-text"
					<?=isset($authfail)?'value="'.$username.'"':''?>
				/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="password"><?=_("Password")?>:</label><br>
				<input
					type="password" 
					name="password"
					class="ui-input-text"
				/>
			</td>
		</tr>
	</table>
	<div id="fn-login-error">
		<div id="fn-login-error-pwd" class="ui-state-error-text ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?=_("Invalid user/password combination.")?>
		</div>
		<div id="fn-login-error-wanaccess" class="ui-state-error-text ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?=_("Admin user not allowed to login on WAN interface.")?><br/><?=_("Please read the users manual for advice.")?>
		</div>
		<div id="fn-login-error-noaccess" class="ui-state-error-text ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?=_("User isn't allowed to login to web admin.")?>
		</div>		
		<?if(isset($redirect_user) && $redirect_user):?>
			<div id="fn-login-error-redirect" class="ui-state-error-text ui-login-dialog-error ui-text-center">
				<?=sprintf(_("Access not granted for user '%s'."), $redirect_user)?>
			</div>
		<?endif?>
		<div id="fn-login-error-grantaccess" class="ui-state-error-text ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?if(isset($valid_user) && $valid_user):?>
				<?=sprintf(_("Access not granted for user '%s'."), $valid_user)?>
			<?endif?>
		</div>
	</div>
</form>
</div>
