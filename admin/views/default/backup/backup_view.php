<?$this->load->helper("ordinal")?>
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
<?foreach(array('data', 'email', 'music', 'photo', 'video', 'storage', 'custom' ) as $key):?>
        <tr>
        <td>
            <input 
                type="radio" 
                id="fn-backup-selection-<?=$key?>" 
                name="selection" 
                class="ui-input-text fn-backup-selection"
                value="<?=$key?>" 
            />
            <label for="fn-backup-selection-<?=$key?>"><?=t("backup-selection-$key")?></label>
        </td>
        </tr>
<?endforeach?>
        </table>
    </div>

    <div id="fn-backup-create-form-step-3" class="step">
        <h3><?=t('backup-create-dialog-step3-title')?></h3>
        <table>
        <tr>
        <td>
        <label for="fn-backup-protocol"><?=t("backup-label-target-protocol")?></label>
        <select
            id="fn-backup-protocol"
            name="protocol"
            title="<?=t("backup-title-protocol")?>"
        >
            <option value="ftp">FTP</option>
            <option value="ssh">SSH</option>
            <option value="file">Local (USB/eSATA)</option>
        </select>
        </td>
        </tr>

        <tr>
        <td>
            <label for="fn-backup-target-server-hostname"><?=t('backup-label-target-server-hostname')?>:</label>
            <input 
                type="text" 
                id="fn-backup-target-server-hostname" 
                name="remote-hostname" 
                class="ui-input-text fn-primary-field"
                value="" 
            />
        </td>
        </tr>

        <tr>
        <td>
            <label for="fn-backup-target-server-username"><?=t('backup-label-target-server-username')?>:</label>
            <input 
                type="text" 
                id="fn-backup-target-server-username" 
                name="username" 
                class="ui-input-text"
                value="" 
            />
        </td>
        </tr>

        <tr>
        <td>
            <label for="fn-backup-target-server-password"><?=t('backup-label-target-server-password')?>:</label>
            <input 
                type="password" 
                id="fn-backup-target-server-password" 
                name="password" 
                class="ui-input-text"
                value="" 
            />
        </td>
        </tr>

        <tr>
        <td>
            <label for="fn-backup-target-server-path"><?=t('backup-label-target-server-path')?>:</label>
            <input 
                type="test" 
                id="fn-backup-target-server-path" 
                name="path" 
                class="ui-input-text"
                value="" 
            />
        </td>
        </tr>

        </table>
    </div>

    <div id="fn-backup-create-form-step-4" class="step">
        <h3><?=t('backup-create-dialog-step4-title')?></h3>
        <table>
        <tr>
        <td>
            <input 
                type="radio" 
                id="fn-backup-schedule-disabled"
                checked="checked"
                name="schedule-type" 
                value="disabled" 
            />
            <label for="fn-backup-schedule-disabled"><?=t("backup-label-schedule-disabled")?></label>
        </td>
        </tr>

        <tr>
        <td>
            <input 
                type="radio" 
                id="fn-backup-schedule-monthly"
                name="schedule-type" 
                value="monthly" 
            />
            <label for="fn-backup-schedule-monthday"><?=t("backup-label-schedule-monthly-day")?></label>
        <select
            id="fn-backup-schedule-monthday"
            name="monthday"
            class="ui-inline"
            title="<?=t("backup-title-schedule-monthly-day")?>"
        >
<?foreach(range(1,28) as $day):?>
            <option value="<?=$day?>"><?=to_ordinal($day)?></option>
<?endforeach?>
        </select>
            <label for="fn-backup-schedule-monthhour"><?=t("backup-label-schedule-monthly-hour")?></label>
        <select
            id="fn-backup-schedule-monthhour"
            name="monthhour"
            class="ui-inline"
            title="<?=t("backup-title-schedule-monthly-hour")?>"
        >
<?foreach(range(1,24) as $hour):?>
            <option value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
<?endforeach?>
        </select>

        </td>
        </tr>

        <tr>
        <td>
            <input 
                type="radio" 
                id="fn-backup-schedule-weekly"
                name="schedule-type" 
                value="weekly" 
            />
            <label for="fn-backup-schedule-weekday"><?=t("backup-label-schedule-weekly-day")?></label>
        <select
            id="fn-backup-schedule-weekday"
            name="weekday"
            class="ui-inline"
            title="<?=t("backup-title-schedule-weekly-day")?>"
        >
<?foreach(range(1,7) as $day):?>
            <option value="<?=t("weekday-$day")?>"><?=t("weekday-$day")?></option>
<?endforeach?>
        </select>
            <label for="fn-backup-schedule-weekhour"><?=t("backup-label-schedule-weekly-hour")?></label>
        <select
            id="fn-backup-schedule-weekhour"
            name="weekhour"
            class="ui-inline"
            title="<?=t("backup-title-schedule-weekly-hour")?>"
        >
<?foreach(range(1,24) as $hour):?>
            <option value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
<?endforeach?>
        </select>

        </td>
        </tr>

        <tr>
        <td>
            <input 
                type="radio" 
                id="fn-backup-schedule-daily"
                name="schedule-type" 
                value="daily" 
            />
            <label for="fn-backup-schedule-dayhour"><?=t("backup-label-schedule-daily-hour")?></label>
        <select
            id="fn-backup-schedule-dayhour"
            name="dayhour"
            class="ui-inline"
            title="<?=t("backup-title-schedule-daily-hour")?>"
        >
<?foreach(range(1,24) as $hour):?>
            <option value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
<?endforeach?>
        </select>

        </td>
        </tr>


        <tr>
        <td>
            <input 
                type="radio" 
                id="fn-backup-schedule-hourly"
                name="schedule-type" 
                value="hourly" 
            />
            <label><?=t("backup-label-schedule-hourly")?></label>

        </td>
        </tr>
        </table>
        <hr/>
        <table>
        <tr>
        <td>
        <label for="fn-backup-schedule-timeline"><?=t("backup-label-schedule-timeline")?></label>
        <select
            id="fn-backup-schedule-timeline"
            name="timeline"
            class="ui-inline"
            title="<?=t("backup-title-schedule-timeline")?>"
        >
            <option value="1D"><?=t("a day")?></option>
            <option value="1W"><?=t("a week")?></option>
            <option value="1M"><?=t("a month")?></option>
            <option value="6M"><?=t("half a year")?></option>
            <option value="1Y"><?=t("a year")?></option>
            <option value="10Y"><?=t("a decade")?></option>
        </select>
        <span class="ui-text-comment">(<?=t("backup-note-schedule-timeline")?>)</span>
        </td>
        </tr>
        </table>
    </div>

    <div id="fn-backup-create-form-step-5" class="step submit_step">
        <h3><?=t('backup-create-dialog-step5-title')?></h3>
        <table>
        <tr>
        <td>
            <input
                type="checkbox"
                id="fn-backup-security-enable"
                name="security"
                value="yes"
            />
            <label for="fn-backup-security-enable"><?=t("backup-label-security-enable")?></label>
        </td>
        </tr>
        <tr>
        <td>
            <label for="fn-backup-security-password"><?=t('backup-label-security-password')?>:</label>
            <input
                type="password"
                id="fn-backup-security-password"
                name="password"
                class="ui-input-text"
                value=""
            />
        </td>
        </tr>
        <tr>
        <td>
            <label for="fn-backup-security-password2"><?=t('backup-label-security-password2')?>:</label>
            <input
                type="password"
                id="fn-backup-security-password2"
                name="password2"
                class="ui-input-text"
                value=""
            />
        </td>
        </tr>

        </table>
    </div>

    </div>
    </form>
    </div>
</div>
