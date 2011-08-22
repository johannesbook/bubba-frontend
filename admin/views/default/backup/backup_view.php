<?$this->load->helper("ordinal")?>
<table id="fn-backup-jobs" class="ui-table-outline">
	<thead>
		<tr>
			<th colspan="5" class="ui-state-default ui-widget-header"><?=_("Backup jobs")?></th>
		</tr>
		<tr class="ui-filemanager-state-header">
			<th><?=_("Name")?></th>
			<th><?=_("Target")?></th>
			<th><?=_('Schedule')?></th>
			<th><?=_("Status")?></th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
	<tfoot>
		<tr><td colspan="5">
				<button class="submit" id="fn-backup-job-add"><?=_("Add new backup job")?></button>
		</td></tr>
	</tfoot>
</table>

<table id="fn-backup-job-runs" class="ui-table-outline">
	<thead>
		<tr>
			<th colspan="4" class="ui-state-default ui-widget-header"><?=_("Timeline")?></th>
		</tr>
		<tr class="ui-filemanager-state-header">
			<th><?=_('Date')?></th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<div id="fn-templates" class="ui-helper-hidden">
	<div id="fn-backup-create-dialog">
		<h2 class="ui-text-center">
			<?=_("Add new backup job")?>
		</h2>

		<form id="fn-backup-create">
			<div class="ui-form-wrapper">

				<div id="fn-backup-create-form-step-1" class="step">
					<h3><?=_("Choose a name for this job (step 1 of 5)")?></h3>
					<table>
						<tr>
							<td>
								<label for="fn-backup-create-name"><?=_("Job name")?>:</label>
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
					<h3><?=_("Select what you want to backup (step 2 of 5)")?></h3>
					<table>
<?foreach(array('data', 'email', 'music', 'photo', 'video', 'storage', 'custom' ) as $key):?>
<?switch($key) {
case 'data':
	$label=_('All user\'s data (/home/&lt;all users&gt;)');
	break;
case 'email':
	$label=_('All user\'s email (/home/&lt;all users&gt;/Mail)');
	break;
case 'music':
	$label=_('All music (/home/storage/music)');
	break;
case 'photo':
	$label=_('All photos (/home/storage/photos)');
	break;
case 'video':
	$label=_('All videos (/home/storage/video)');
	break;
case 'storage':
	$label=_('Storage (/home/storage)');
	break;
case 'custom':
	$label=_('Custom selection');
	break;
default:
	$label='';
	break;
}?>
						<tr>
							<td>
								<input
								type="radio"
								id="fn-backup-create-selection-<?=$key?>"
								name="selection"
								class="fn-backup-selection"
								value="<?=$key?>"
								/>
								<label for="fn-backup-create-selection-<?=$key?>"><?=$label?></label>
<?if($key == 'custom'):?>
								<button
									id="fn-backup-create-selection-custom-browse"
									disabled="disabled"
									>
									<?=_("Browse")?>
								</button>
								<span id="fn-backup-create-selection-custom-selection" class="ui-text-comment"></span>
<?endif?>
							</td>
						</tr>
<?endforeach?>
					</table>
				</div>

				<div id="fn-backup-create-form-step-3" class="step">
					<h3><?=_("Choose backup destination (step 3 of 5)")?></h3>
					<table>
						<tr>
							<td>
								<label for="fn-backup-create-protocol"><?=_("Protocol")?></label>
								<select
									id="fn-backup-create-protocol"
									name="protocol"
									title="<?=_("backup-title-protocol")?>"
									>
									<option value="ftp" selected="selected"><?=_("FTP")?></option>
									<option value="ssh"><?=_("SSH")?></option>
									<option value="file"><?=_("Local (USB/eSATA)")?></option>
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-create-target-device"><?=_("Target device")?>:</label>
								<select
									id="fn-backup-create-target-device"
									class="fn-backup-target-device"
									name="target-device"
									title="<?=_("Device to use as target for the backup")?>"
									>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-create-target-server-hostname"><?=_("Target server")?>:</label>
								<input
								type="text"
								id="fn-backup-create-target-server-hostname"
								name="target-hostname"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-create-target-server-username"><?=_("Target server username")?>:</label>
								<input
								type="text"
								id="fn-backup-create-target-server-username"
								name="target-username"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-create-target-server-password"><?=_("Target server password")?>:</label>
								<input
								type="password"
								id="fn-backup-create-target-server-password"
								name="target-password"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-create-target-path"><?=_("Target directory")?>:</label>
								<input
								type="text"
								id="fn-backup-create-target-path"
								name="target-path"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

					</table>
				</div>

				<div id="fn-backup-create-form-step-4" class="step">
					<h3><?=_("Select backup schedule (step 4 of 5)")?></h3>
					<table>
						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-create-schedule-disabled"
								checked="checked"
								name="schedule-type"
								value="disabled"
								/>
								<label for="fn-backup-create-schedule-disabled"><?=_("Disabled (manually run by pressing \"Run now\")")?></label>
							</td>
						</tr>

						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-create-schedule-monthly"
								name="schedule-type"
								value="monthly"
								/>
								<label for="fn-backup-create-schedule-monthday"><?=_("Monthly on the")?></label>
								<select
									id="fn-backup-create-schedule-monthday"
									name="schedule-monthday"
									class="ui-inline"
									title="<?=_("Day of the month")?>"
									>
									<?foreach(range(1,30) as $day):?>
                                    <option <?if($day===1):?>selected="selected"<?endif?> value="<?=$day?>"><?=to_ordinal($day)?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-create-schedule-monthhour"><?=_("at")?></label>
								<select
									id="fn-backup-create-schedule-monthhour"
									name="schedule-monthhour"
									class="ui-inline"
									title="<?=_("Hour of the day")?>"
									>
									<?foreach(range(1,24) as $hour):?>
									<option  <?if($hour===1):?>selected="selected"<?endif?> value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
									<?endforeach?>
								</select>

							</td>
						</tr>

						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-create-schedule-weekly"
								name="schedule-type"
								value="weekly"
								/>
								<label for="fn-backup-create-schedule-weekday"><?=_("Weekly each")?></label>
								<select
									id="fn-backup-create-schedule-weekday"
									name="schedule-weekday"
									class="ui-inline"
									title="<?=_("Day of the week")?>"
									>
									<?foreach(range(1,7) as $day):?>
									<option <?if($day===1):?>selected="selected"<?endif?> value="<?=_("weekday-$day")?>"><?=get_weekday($day)?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-create-schedule-weekhour"><?=_("at")?></label>
								<select
									id="fn-backup-create-schedule-weekhour"
									name="schedule-weekhour"
									class="ui-inline"
									title="<?=_("Hour of the day")?>"
									>
									<?foreach(range(1,24) as $hour):?>
									<option <?if($hour===1):?>selected="selected"<?endif?> value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
									<?endforeach?>
								</select>

							</td>
						</tr>

						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-create-schedule-daily"
								name="schedule-type"
								value="daily"
								/>
								<label for="fn-backup-create-schedule-dayhour"><?=_("Daily at")?></label>
								<select
									id="fn-backup-create-schedule-dayhour"
									name="schedule-dayhour"
									class="ui-inline"
									title="<?=_("Hour of the day")?>"
									>
									<?foreach(range(1,24) as $hour):?>
									<option <?if($hour===1):?>selected="selected"<?endif?> value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
									<?endforeach?>
								</select>

							</td>
						</tr>


						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-create-schedule-hourly"
								name="schedule-type"
								value="hourly"
								/>
								<label><?=_("Hourly")?></label>

							</td>
						</tr>
					</table>
					<hr/>
					<table>
						<tr>
							<td>
								<label for="fn-backup-create-schedule-timeline"><?=_("Keep timeline length of")?></label>
								<select
									id="fn-backup-create-schedule-timeline"
									class="fn-backup-schedule-timeline"
									name="schedule-timeline"
									class="ui-inline"
									title="<?=_("Age of timeline")?>"
									>
									<option value="1D"><?=_("a day")?></option>
									<option value="1W"><?=_("a week")?></option>
									<option value="1M"><?=_("a month")?></option>
									<option value="6M"><?=_("half a year")?></option>
									<option value="1Y" selected="selected"><?=_("a year")?></option>
									<option value="10Y"><?=_("a decade")?></option>
								</select>
								<span class="ui-text-comment">(<?=_("The longer timeline the more space will be required on target")?>)</span>
							</td>
						</tr>
					</table>
				</div>

				<div id="fn-backup-create-form-step-5" class="step submit_step">
					<h3><?=_("Security (step 5 of 5)")?></h3>
					<table>
						<tr>
							<td>
								<input
								type="checkbox"
								id="fn-backup-create-security-enable"
								name="security"
								value="yes"
								/>
								<label for="fn-backup-create-security-enable"><?=_("Encrypt the backup on target for increased security")?></label>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-create-security-password"><?=_("Password")?>:</label>
								<input
								type="password"
								id="fn-backup-create-security-password"
								name="security-password"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-create-security-password2"><?=_("Repeat password")?>:</label>
								<input
								type="password"
								id="fn-backup-create-security-password2"
								name="security-password2"
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

	<div id="fn-backup-edit-dialog">
		<h2 class="ui-text-center">
			<?=_("Edit backup job")?>
		</h2>

		<form id="fn-backup-edit">
			<input type="hidden" value="" name="name" id="fn-backup-edit-name" />
			<div class="ui-form-wrapper">

				<div id="fn-backup-edit-form-step-2" class="step">
					<h3><?=_("Files to backup (step 1 of 4)")?></h3>
					<table>
						<?foreach(array('data', 'email', 'music', 'photo', 'video', 'storage', 'custom' ) as $key):?>
<?switch($key) {
case 'data':
	$label=_('All user\'s data (/home/&lt;all users&gt;)');
	break;
case 'email':
	$label=_('All user\'s email (/home/&lt;all users&gt;/Mail)');
	break;
case 'music':
	$label=_('All music (/home/storage/music)');
	break;
case 'photo':
	$label=_('All photos (/home/storage/photos)');
	break;
case 'video':
	$label=_('All videos (/home/storage/video)');
	break;
case 'storage':
	$label=_('Storage (/home/storage)');
	break;
case 'custom':
	$label=_('Custom selection');
	break;
default:
	$label='';
	break;
}?>
						<tr>
							<td>
								<input
								type="radio"
								id="fn-backup-edit-selection-<?=$key?>"
								name="selection"
								class="fn-backup-selection"
								value="<?=$key?>"
								/>
								<label for="fn-backup-edit-selection-<?=$key?>"><?=$label?></label>
								<?if($key == 'custom'):?>
								<button
									id="fn-backup-edit-selection-custom-browse"
									disabled="disabled"
									>
									<?=_("Browse")?>
								</button>
								<span id="fn-backup-edit-selection-custom-selection" class="ui-text-comment"></span>
								<?endif?>
							</td>
						</tr>
						<?endforeach?>
					</table>
				</div>

				<div id="fn-backup-edit-form-step-3" class="step">
					<h3><?=_("Backup destination (step 2 of 4)")?></h3>
					<table>
						<tr>
							<td>
								<label for="fn-backup-edit-protocol"><?=_("Protocol")?></label>
								<select
									id="fn-backup-edit-protocol"
									name="protocol"
									title="<?=_("backup-title-protocol")?>"
									>
									<option value="ftp" selected="selected">FTP</option>
									<option value="ssh">SSH</option>
									<option value="file">Local (USB/eSATA)</option>
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-edit-target-device"><?=_("Target device")?>:</label>
								<select
									id="fn-backup-edit-target-device"
									class="fn-backup-target-device"
									name="target-device"
									title="<?=_("Device to use as target for the backup")?>"
									>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-edit-target-server-hostname"><?=_("Target server")?>:</label>
								<input
								type="text"
								id="fn-backup-edit-target-server-hostname"
								name="target-hostname"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-edit-target-server-username"><?=_("Target server username")?>:</label>
								<input
								type="text"
								id="fn-backup-edit-target-server-username"
								name="target-username"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-edit-target-server-password"><?=_("Target server password")?>:</label>
								<input
								type="password"
								id="fn-backup-edit-target-server-password"
								name="target-password"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-edit-target-path"><?=_("Target directory")?>:</label>
								<input
								type="text"
								id="fn-backup-edit-target-path"
								name="target-path"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>

					</table>
				</div>

				<div id="fn-backup-edit-form-step-4" class="step">
					<h3><?=_("Backup schedule (step 3 of 4)")?></h3>
					<table>
						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-edit-schedule-disabled"
								checked="checked"
								name="schedule-type"
								value="disabled"
								/>
								<label for="fn-backup-edit-schedule-disabled"><?=_("Disabled (manually run by pressing \"Run now\")")?></label>
							</td>
						</tr>

						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-edit-schedule-monthly"
								name="schedule-type"
								value="monthly"
								/>
								<label for="fn-backup-edit-schedule-monthday"><?=_("Monthly on the")?></label>
								<select
									id="fn-backup-edit-schedule-monthday"
									name="schedule-monthday"
									class="ui-inline"
									title="<?=_("Day of the month")?>"
									>
									<?foreach(range(1,30) as $day):?>
									<option <?if($day===1):?>selected="selected"<?endif?> value="<?=$day?>"><?=to_ordinal($day)?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-edit-schedule-monthhour"><?=_("at")?></label>
								<select
									id="fn-backup-edit-schedule-monthhour"
									name="schedule-monthhour"
									class="ui-inline"
									title="<?=_("Hour of the day")?>"
									>
									<?foreach(range(1,24) as $hour):?>
									<option <?if($hour===1):?>selected="selected"<?endif?> value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
									<?endforeach?>
								</select>

							</td>
						</tr>

						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-edit-schedule-weekly"
								name="schedule-type"
								value="weekly"
								/>
								<label for="fn-backup-edit-schedule-weekday"><?=_("Weekly each")?></label>
								<select
									id="fn-backup-edit-schedule-weekday"
									name="schedule-weekday"
									class="ui-inline"
									title="<?=_("Day of the week")?>"
									>
									<?foreach(range(1,7) as $day):?>
									<option <?if($day===1):?>selected="selected"<?endif?> value="<?=_("weekday-$day")?>"><?=get_weekday($day)?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-edit-schedule-weekhour"><?=_("at")?></label>
								<select
									id="fn-backup-edit-schedule-weekhour"
									name="schedule-weekhour"
									class="ui-inline"
									title="<?=_("Hour of the day")?>"
									>
									<?foreach(range(1,24) as $hour):?>
									<option <?if($hour===1):?>selected="selected"<?endif?> value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
									<?endforeach?>
								</select>

							</td>
						</tr>

						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-edit-schedule-daily"
								name="schedule-type"
								value="daily"
								/>
								<label for="fn-backup-edit-schedule-dayhour"><?=_("Daily at")?></label>
								<select
									id="fn-backup-edit-schedule-dayhour"
									name="schedule-dayhour"
									class="ui-inline"
									title="<?=_("Hour of the day")?>"
									>
									<?foreach(range(1,24) as $hour):?>
									<option <?if($hour===1):?>selected="selected"<?endif?> value="<?=$hour?>"><?=sprintf("%02d:00",$hour)?></option>
									<?endforeach?>
								</select>

							</td>
						</tr>


						<tr>
							<td>
								<input
								type="radio"
								class="fn-backup-schedule"
								id="fn-backup-edit-schedule-hourly"
								name="schedule-type"
								value="hourly"
								/>
								<label><?=_("Hourly")?></label>

							</td>
						</tr>
					</table>
					<hr/>
					<table>
						<tr>
							<td>
								<label for="fn-backup-edit-schedule-timeline"><?=_("Keep timeline length of")?></label>
								<select
									id="fn-backup-edit-schedule-timeline"
									class="fn-backup-schedule-timeline"
									name="schedule-timeline"
									class="ui-inline"
									title="<?=_("Age of timeline")?>"
									>
									<option value="1D"><?=_("a day")?></option>
									<option value="1W"><?=_("a week")?></option>
									<option value="1M" selected="selected"><?=_("a month")?></option>
									<option value="6M"><?=_("half a year")?></option>
									<option value="1Y"><?=_("a year")?></option>
									<option value="10Y"><?=_("a decade")?></option>
								</select>
								<span class="ui-text-comment">(<?=_("The longer timeline the more space will be required on target")?>)</span>
							</td>
						</tr>
					</table>
				</div>

				<div id="fn-backup-edit-form-step-5" class="step submit_step">
					<h3><?=_("Security (step 4 of 4)")?></h3>
					<table>
						<tr>
							<td>
								<input
								type="checkbox"
								id="fn-backup-edit-security-enable"
								name="security"
								value="yes"
								/>
								<label for="fn-backup-edit-security-enable"><?=_("Encrypt the backup on target for increased security")?></label>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-edit-security-password"><?=_("Password")?>:</label>
								<input
								type="password"
								id="fn-backup-edit-security-password"
								name="security-password"
								class="ui-input-text"
								value=""
								/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-edit-security-password2"><?=_("Repeat password")?>:</label>
								<input
								type="password"
								id="fn-backup-edit-security-password2"
								name="security-password2"
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

	<div id="fn-restore">
		<h2 class="ui-text-center">
			<?=_("Edit backup job")?>
		</h2>

		<form id="fn-backup-restore">
			<table>
				<tr>
					<td>
						<div class="fn-restore-filemanager-wrapper">
							<table class="ui-table-outline fn-restore-filemanager">
								<thead>
									<tr class="ui-state-default ui-widget-header">
										<th></th>
										<th><?=_("Name")?></th>
										<th><?=_("Date")?></th>
										<th></th>
									</tr>

									<tr class="ui-header">
										<td colspan="4" class="ui-filemanager-fake-updir"></td>
									</tr>

									<tr>
										<td colspan="4" class=
											"ui-helper-hidden ui-filemanager-permission-denied">
											<?=_("Permission denied")?>
										</td>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<input type="hidden" name="selection" class="fn-backup-restore-selection" />
					</td>
				</tr>

				<tr>
					<td>
						<input
						type="radio"
						class="fn-backup-restore-action"
						id="fn-backup-restore-action-overwrite"
						checked="checked"
						name="restore-action"
						value="overwrite"
						/>
						<label for="fn-backup-restore-action-overwrite"><?=_("Restore file to it’s original place")?></label>
					</td>
				</tr>

                <tr>
                    <td>
                        <input
                        type="radio"
                        class="fn-backup-restore-action"
                        id="fn-backup-restore-action-newdir"
                        name="restore-action"
                        value="newdir"
                        />
                        <label for="fn-backup-restore-action-newdir"><?=_("Restore to other place")?>: </label>
                        <tt>/home/admin/</tt>
                        <input
                        type="text"
                        id="fn-backup-restore-target"
                        name="target"
                        class="ui-inline fn-backup-restore-target"
                        disabled="disabled"
                        value=""
                        />
                    </td>
                </tr>

			</table>

		</form>
	</div>

	<table class="ui-table-outline ui-custom-select-filemanager">
		<thead>
			<tr class="ui-state-default ui-widget-header">
				<th></th>
				<th><?=_("Name")?></th>
				<th><?=_("Date")?></th>
				<th><?=_("Size")?></th>
				<th></th>
			</tr>

			<tr class="ui-header">
				<td colspan="5" class="ui-filemanager-fake-updir"></td>
			</tr>

			<tr>
				<td colspan="5" class=
					"ui-helper-hidden ui-filemanager-permission-denied">
					<?=_("Permission denied")?>
				</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
