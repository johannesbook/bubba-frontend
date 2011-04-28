<table id="fn-backup-jobs" class="ui-table-outline">
<thead>
<tr>
        <th colspan="5" class="ui-state-default ui-widget-header"><?=t('backup-jobs-title')?></th>
</tr>
<tr class="ui-filemanager-state-header">
   <th><?=t('Name')?></th>
   <th><?=t('Target')?></th>
   <th><?=t('Schedule')?></th>
   <th><?=t('Status')?></th>
   <th>&nbsp;</th>
</tr>
</thead>
<tbody>
</tbody>
<tfoot>
<tr><td colspan="5">
<button class="submit" id="fn-backup-job-add"><?=t("backup-job-add-button-label")?></button>
</td></tr>
</tfoot>
</table>

<table id="fn-backup-job-runs" class="ui-table-outline">
<thead>
<tr>
        <th colspan="4" class="ui-state-default ui-widget-header"><?=t('backup-job-runs-title')?></th>
</tr>
<tr class="ui-filemanager-state-header">
   <th><?=t('Date')?></th>
   <th>&nbsp;</th>
</tr>
</thead>
<tbody>
</tbody>
</table>

<div id="fn-templates" class="ui-helper-hidden">
	<div id="fn-backup-create-dialog">
    <h2 class="ui-text-center">
		<?=t('backup-create-dialog-title')?>
	</h2>

	<form id="fn-backup-create">
    <div class="ui-form-wrapper">

    <div id="fn-backup-create-form-step-1" class="step">
        <h3><?=t('backup-create-dialog-step1-title')?></h3>
        <table>
        <tr>
        <td>
            <label for="fn-backup-create-name"><?=t('backup-label-name')?>:</label>
            <input 
                type="text" 
                id="fn-backup-create-name" 
                name="name" 
                class="ui-input-text fn-primary-field"
                value="" 
            />
        </td>
        </tr>
        </table>
    </div>

    <div id="fn-backup-create-form-step-2" class="step">
        <h3><?=t('backup-create-dialog-step2-title')?></h3>
        <table>
        <tr>
        <td>
        </td>
        </tr>
        </table>
    </div>

    <div id="fn-backup-create-form-step-3" class="step">
        <h3><?=t('backup-create-dialog-step3-title')?></h3>
        <table>
        <tr>
        <td>
        </td>
        </tr>
        </table>
    </div>

    <div id="fn-backup-create-form-step-4" class="step">
        <h3><?=t('backup-create-dialog-step4-title')?></h3>
        <table>
        <tr>
        <td>
        </td>
        </tr>
        </table>
    </div>

    <div id="fn-backup-create-form-step-5" class="step submit_step">
        <h3><?=t('backup-create-dialog-step5-title')?></h3>
        <table>
        <tr>
        <td>
        </td>
        </tr>
        </table>
    </div>

    </div>
    </form>
    </div>
</div>
