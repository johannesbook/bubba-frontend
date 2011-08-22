
<div class="ui-state-default ui-widget-header ui-div-header"><?=_("Current version")?></div>
<div class="ui-div-header"><?=$version?></div>

<div class="ui-indent-margin">
    <div class="ui-expandable ui-div-small-header"><?=_("Detailed information")?></div>
    <div class="ui-helper-hidden">

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
            </tbody>
        </table>
    </div>
</div>

<form id="update" method="post">

    <table class="ui-table-outline">
       <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=$action=='install'?sprintf(_("Install package %s"),$package):_('Update system')?></td></tr>
    </table>

    <div id="updater" style="width: 100%">
    <?if($action == 'install'):?>
        <input type="submit" value="<?=sprintf(_('Install %s'), $package)?>"/>
        <input type="hidden" name="apt_package" id="apt_package" value="<?=$package?>"/>
        <input type="hidden" name="apt_type" id="apt_type" value="install"/>
    <?else :?>
        <input type="submit" value="<?=_('Update system')?>"/>
        <input type="hidden" name="apt_type" id="apt_type" value="upgrade"/>
    <?endif?>
    </div>
    <div id="progress"></div>
    <table id="results" class="notifications"></table>
    <pre id="tmp"></pre>
</form>

