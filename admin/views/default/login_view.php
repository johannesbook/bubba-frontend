<h1><?=t("The heart in your digital life")?>.</h1>
<div id="login_menubar">

<?foreach($main_menu as $menuitem) {
	print "\t$menuitem\n";
}?>
</div>

<div id="login_settings">
<?foreach($system_menu as $menuitem) {
	print "\t$menuitem\n";
}?>
</div>

<div id="login_more_info">
    <span>For more information:</span>
    <a href="" target="_blank">Bubba forum</a>/
    <a href="" target="_blank">Support</a>/
    <a href="" target="_blank">Contact</a>
    <img id="" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/bubba_heart.png" alt="Bubba, The heart in your digital life" title="Bubba, The heart in your digital life" />
</div>

<div id="div-login-dialog">
<form method="post" action="login" class="ui-form-login-dialog" id="fn-login-dialog-form">
	<h2 class="ui-text-center"><?=t('login-dialog-header')?></h2>
	<table>
		<tr>
			<td>
				<label for="username"><?=t("Username")?>:</label>
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
				<label for="password"><?=t("Password")?>:</label>
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
			<?=t('login-error-pwd')?>
		</div>
		<div id="fn-login-error-wanaccess" class="ui-state-error-text ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?=t('login-error-wanaccess')?><br/><?=t('login-error-wanaccess-quickstart')?>
		</div>
		<?if(isset($redirect_user) && $redirect_user):?>
			<div id="fn-login-error-redirect" class="ui-state-error-text ui-login-dialog-error ui-text-center">
				<?=t('login-error-grantaccess',$redirect_user)?>
			</div>
		<?endif?>
		<div id="fn-login-error-grantaccess" class="ui-state-error-text ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?if(isset($valid_user) && $valid_user):?>
				<?=t('login-error-grantaccess',$valid_user)?>
			<?endif?>
		</div>
	</div>
</form>
</div>
