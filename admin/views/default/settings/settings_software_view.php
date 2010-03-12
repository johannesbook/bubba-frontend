<form id="update" method="post">

	<table>
	   <tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=$action=='install'?t("settings_software_install_package",$package):t('settings_software_update_software')?></td></tr>
	</table>

	<div id="updater" style="width: 100%">
	<?if($action == 'install'):?>
		<ul>
			<input type="submit" value="<?=t('settings_software_install_package', $package)?>"/>
		</ul>
		<input type="hidden" name="apt_package" id="apt_package" value="<?=$package?>"/>
		<input type="hidden" name="apt_type" id="apt_type" value="install"/>
	<?else :?>
			<input type="submit" value="<?=t('settings_software_update_system')?>"/>
			<div class="hotfix">
			<input type="checkbox" class="checkbox_radio" name="hotfix_enabled" id="hotfix_enabled" <?if($hotfix_enabled):?>checked="checked" <?endif?>/>
				<span><?=t("settings_software_include_hotfixes")?></span><span class="help"><a href="/manual/<?=t("help_hotfix")?>" target="_blank">(<?=t('Explain')?>)</a></span>
			</div>
		<input type="hidden" name="apt_type" id="apt_type" value="upgrade"/>
	<?endif?>
	</div>
	<div id="progress"></div>
	<table id="results" class="notifications"></table>
	<pre id="tmp"></pre>
</fieldset>
</form>

<fieldset>
	<legend><?=t("Current package versions")?></legend>
	<table id="package_versions">
		<thead>
			<tr>
				<td><?=t("Package name")?></td>
				<td><?=t("Package version")?></td>
			</tr>
		</thead>
		<tbody id="package_versions_body" />
			<tr>
				<td colspan="2"><?=t("Retreiving package information")?>...</td>
			</tr>
	</table>
