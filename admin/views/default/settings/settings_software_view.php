<form id="update" method="post">

	<table class="ui-table-outline">
	   <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=$action=='install'?sprintf(_("Install %s"), $package):_("Software update")?></td></tr>
	</table>

	<div id="updater" style="width: 100%">
	<?if($action == 'install'):?>
		<ul>
			<input type="submit" value="<?=sprintf(_("Install %s"), $package)?>"/>
		</ul>
		<input type="hidden" name="apt_package" id="apt_package" value="<?=$package?>"/>
		<input type="hidden" name="apt_type" id="apt_type" value="install"/>
	<?else :?>
			<input type="submit" value="<?=_("Update system")?>"/>
			<div class="hotfix">
			<table class="ui-table-outline">
				<tr>
					<td><?=_("Include hotfixes and system specific updates")?></td>
					<td><input type="checkbox" class="slide" name="hotfix_enabled" id="hotfix_enabled" <?if($hotfix_enabled):?>checked="checked" <?endif?>/></td>
				</tr>
			</table>
			</div>
		<input type="hidden" name="apt_type" id="apt_type" value="upgrade"/>
	<?endif?>
	</div>
	<div id="progress"></div>
	<table id="results" class="notifications"></table>
	<pre id="tmp"></pre>
</fieldset>
</form>

<fieldset id="current_package_versions">
	<legend><?=_("Current package versions")?></legend>
	<table id="package_versions" class="ui-table-outline">
		<thead>
			<tr>
				<th><?=_("Package name")?></th>
				<th><?=_("Package version")?></th>
			</tr>
		</thead>
		<tbody id="package_versions_body" />
			<tr>
				<td colspan="2"><?=_("Retreiving package information")?>...</td>
			</tr>
	</table>
