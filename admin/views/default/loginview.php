<h1>This is the heart in you digital lifd.</h1>
<div id="login_menubar">
	<ul>
		<li class="default-icon default-icon-mail">
		    <a href="/pim"><?=t("menubar_pim")?></a>
        </li>
		<li class="default-icon default-icon-music">
			<a href="/music"><?=t("menubar_music")?></a>
		</li>
		<li class="default-icon default-icon-album">
			<a href="/album"><?=t("menubar_photos")?></a>
		</li>
		<li class="default-icon default-icon-settings">
			<a class="fn-login-auth-required <?=$ui_login_user_lock?>" href="<?=FORMPREFIX?>/userinfo/">
				<?=t("menubar_usersettings")?>
			</a>
		</li >
		<li class="default-icon default-icon-filemanager">
			<a class="fn-login-auth-required <?=$ui_login_user_lock?>" href="<?=FORMPREFIX?>/filemanager/">
				<?=t("menubar_filemanager")?>
			</a>
		</li>
		<li class="default-icon default-icon-music">
			<a class="fn-login-auth-required fn-login-require-admin <?=$ui_login_admin_lock?>" href="<?=FORMPREFIX?>/filemanger/backup">
				<?=t("menubar_backup")?>
			</a>
		</li>
	</ul>
</div>

<div id="login_settings">
	<ul>
		<li class="default-icon default-icon-logout"><a class="fn-login-auth-required fn-login-require-admin <?=$ui_login_admin_lock?>" href="<?=FORMPREFIX?>/stat"><?=t("menubar_settings")?></a></li>
	</ul>
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
			<td><label for="username"><?= t('login-dialog-username')?></label></td>
			<td>
				<input
					id="username"
					type="text" 
					name="username"
					class="ui-input-text"
					<?=isset($authfail)?'value="'.$username.'"':''?>
				/>
			</td>
		</tr>
		<tr>
			<td><label for="password"><?= t('login-dialog-password')?></label></td>
			<td>
				<input
					id="password"
					type="password" 
					name="password"
					class="ui-input-text"
				/>
			</td>
		</tr>
	</table>
	<div id="fn-login-error">
		<div id="fn-login-error-pwd" class="ui-state-error ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?=t('login-error-pwd')?>
		</div>
		<div id="fn-login-error-wanaccess" class="ui-state-error ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?=t('login-error-wanaccess')?><br/><?=t('login-error-wanaccess-quickstart')?>
		</div>
		<?if(isset($redirect_user) && $redirect_user):?>
			<div id="fn-login-error-redirect" class="ui-stete-error ui-login-dialog-error ui-text-center">
				<?=t('login-error-grantaccess',$redirect_user)?>
			</div>
		<?endif?>
		<div id="fn-login-error-grantaccess" class="ui-state-error ui-helper-hidden ui-login-dialog-error ui-text-center">
			<?if(isset($valid_user) && $valid_user):?>
				<?=t('login-error-grantaccess',$valid_user)?>
			<?endif?>
		</div>
	</div>
</form>
</div>
