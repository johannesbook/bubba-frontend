
<div class="ui-state-default ui-widget-header ui-div-header"><?=t("Current version")?></div>
<div class="ui-div-header"><?=$version?></div>

<div class="ui-indent-margin">
    <div class="ui-expandable ui-div-small-header"><?=t("Detailed information")?></div>
    <div class="ui-helper-hidden">

        <table id="package_versions" class="ui-table-outline">
            <thead>
                <tr>
                    <th><?=t("Package name")?></th>
                    <th><?=t("Package version")?></th>
                </tr>
            </thead>
            <tbody id="package_versions_body" />
                <tr>
                    <td colspan="2"><?=t("Retreiving package information")?>...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<form id="update" method="post">

    <table class="ui-table-outline">
       <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=$action=='install'?t("settings_software_install_package",$package):t('settings_software_update_software')?></td></tr>
    </table>

    <div id="updater" style="width: 100%">
    <?if($action == 'install'):?>
        <input type="submit" value="<?=t('settings_software_install_package', $package)?>"/>
        <input type="hidden" name="apt_package" id="apt_package" value="<?=$package?>"/>
        <input type="hidden" name="apt_type" id="apt_type" value="install"/>
    <?else :?>
        <input type="submit" value="<?=t('settings_software_update_system')?>"/>
        <input type="hidden" name="apt_type" id="apt_type" value="upgrade"/>
    <?endif?>
    </div>
    <div id="progress"></div>
    <table id="results" class="notifications"></table>
    <pre id="tmp"></pre>
</form>

