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
								id="fn-backup-create-selection-<?=$key?>"
								name="selection"
								class="fn-backup-selection"
								value="<?=$key?>"
								/>
								<label for="fn-backup-create-selection-<?=$key?>"><?=t("backup-selection-$key")?></label>
								<?if($key == 'custom'):?>
								<button
									id="fn-backup-create-selection-custom-browse"
									disabled="disabled"
									>
									<?=t("backup-selection-custom-browse")?>
								</button>
								<span id="fn-backup-create-selection-custom-selection" class="ui-text-comment"></span>
								<?endif?>
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
								<label for="fn-backup-create-protocol"><?=t("backup-label-target-protocol")?></label>
								<select
									id="fn-backup-create-protocol"
									name="protocol"
									title="<?=t("backup-title-protocol")?>"
									>
									<option value="ftp" selected="selected"><?=t("FTP")?></option>
									<option value="ssh"><?=t("SSH")?></option>
									<option value="file"><?=t("Local (USB/eSATA)")?></option>
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-create-target-device"><?=t('backup-label-target-device')?>:</label>
								<select
									id="fn-backup-create-target-device"
									class="fn-backup-target-device"
									name="target-device"
									title="<?=t("backup-title-target-device")?>"
									>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-create-target-server-hostname"><?=t('backup-label-target-server-hostname')?>:</label>
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
								<label for="fn-backup-create-target-server-username"><?=t('backup-label-target-server-username')?>:</label>
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
								<label for="fn-backup-create-target-server-password"><?=t('backup-label-target-server-password')?>:</label>
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
								<label for="fn-backup-create-target-path"><?=t('backup-label-target-path')?>:</label>
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
					<h3><?=t('backup-create-dialog-step4-title')?></h3>
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
								<label for="fn-backup-create-schedule-disabled"><?=t("backup-label-schedule-disabled")?></label>
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
								<label for="fn-backup-create-schedule-monthday"><?=t("backup-label-schedule-monthly-day")?></label>
								<select
									id="fn-backup-create-schedule-monthday"
									name="schedule-monthday"
									class="ui-inline"
									title="<?=t("backup-title-schedule-monthly-day")?>"
									>
									<?foreach(range(1,30) as $day):?>
                                    <option <?if($day===1):?>selected="selected"<?endif?> value="<?=$day?>"><?=to_ordinal($day)?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-create-schedule-monthhour"><?=t("backup-label-schedule-monthly-hour")?></label>
								<select
									id="fn-backup-create-schedule-monthhour"
									name="schedule-monthhour"
									class="ui-inline"
									title="<?=t("backup-title-schedule-monthly-hour")?>"
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
								<label for="fn-backup-create-schedule-weekday"><?=t("backup-label-schedule-weekly-day")?></label>
								<select
									id="fn-backup-create-schedule-weekday"
									name="schedule-weekday"
									class="ui-inline"
									title="<?=t("backup-title-schedule-weekly-day")?>"
									>
									<?foreach(range(1,7) as $day):?>
									<option <?if($day===1):?>selected="selected"<?endif?> value="<?=t("weekday-$day")?>"><?=t("weekday-$day")?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-create-schedule-weekhour"><?=t("backup-label-schedule-weekly-hour")?></label>
								<select
									id="fn-backup-create-schedule-weekhour"
									name="schedule-weekhour"
									class="ui-inline"
									title="<?=t("backup-title-schedule-weekly-hour")?>"
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
								<label for="fn-backup-create-schedule-dayhour"><?=t("backup-label-schedule-daily-hour")?></label>
								<select
									id="fn-backup-create-schedule-dayhour"
									name="schedule-dayhour"
									class="ui-inline"
									title="<?=t("backup-title-schedule-daily-hour")?>"
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
								<label><?=t("backup-label-schedule-hourly")?></label>

							</td>
						</tr>
					</table>
					<hr/>
					<table>
						<tr>
							<td>
								<label for="fn-backup-create-schedule-timeline"><?=t("backup-label-schedule-timeline")?></label>
								<select
									id="fn-backup-create-schedule-timeline"
									class="fn-backup-schedule-timeline"
									name="schedule-timeline"
									class="ui-inline"
									title="<?=t("backup-title-schedule-timeline")?>"
									>
									<option value="1D"><?=t("a day")?></option>
									<option value="1W"><?=t("a week")?></option>
									<option value="1M"><?=t("a month")?></option>
									<option value="6M"><?=t("half a year")?></option>
									<option value="1Y" selected="selected"><?=t("a year")?></option>
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
								id="fn-backup-create-security-enable"
								name="security"
								value="yes"
								/>
								<label for="fn-backup-create-security-enable"><?=t("backup-label-security-enable")?></label>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-create-security-password"><?=t('backup-label-security-password')?>:</label>
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
								<label for="fn-backup-create-security-password2"><?=t('backup-label-security-password2')?>:</label>
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
			<?=t('backup-edit-dialog-title')?>
		</h2>

		<form id="fn-backup-edit">
			<input type="hidden" value="" name="name" id="fn-backup-edit-name" />
			<div class="ui-form-wrapper">

				<div id="fn-backup-edit-form-step-2" class="step">
					<h3><?=t('backup-edit-dialog-step2-title')?></h3>
					<table>
						<?foreach(array('data', 'email', 'music', 'photo', 'video', 'storage', 'custom' ) as $key):?>
						<tr>
							<td>
								<input
								type="radio"
								id="fn-backup-edit-selection-<?=$key?>"
								name="selection"
								class="fn-backup-selection"
								value="<?=$key?>"
								/>
								<label for="fn-backup-edit-selection-<?=$key?>"><?=t("backup-selection-$key")?></label>
								<?if($key == 'custom'):?>
								<button
									id="fn-backup-edit-selection-custom-browse"
									disabled="disabled"
									>
									<?=t("backup-selection-custom-browse")?>
								</button>
								<span id="fn-backup-edit-selection-custom-selection" class="ui-text-comment"></span>
								<?endif?>
							</td>
						</tr>
						<?endforeach?>
					</table>
				</div>

				<div id="fn-backup-edit-form-step-3" class="step">
					<h3><?=t('backup-edit-dialog-step3-title')?></h3>
					<table>
						<tr>
							<td>
								<label for="fn-backup-edit-protocol"><?=t("backup-label-target-protocol")?></label>
								<select
									id="fn-backup-edit-protocol"
									name="protocol"
									title="<?=t("backup-title-protocol")?>"
									>
									<option value="ftp" selected="selected">FTP</option>
									<option value="ssh">SSH</option>
									<option value="file">Local (USB/eSATA)</option>
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label for="fn-backup-edit-target-device"><?=t('backup-label-target-device')?>:</label>
								<select
									id="fn-backup-edit-target-device"
									class="fn-backup-target-device"
									name="target-device"
									title="<?=t("backup-title-target-device")?>"
									>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-edit-target-server-hostname"><?=t('backup-label-target-server-hostname')?>:</label>
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
								<label for="fn-backup-edit-target-server-username"><?=t('backup-label-target-server-username')?>:</label>
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
								<label for="fn-backup-edit-target-server-password"><?=t('backup-label-target-server-password')?>:</label>
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
								<label for="fn-backup-edit-target-path"><?=t('backup-label-target-path')?>:</label>
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
					<h3><?=t('backup-edit-dialog-step4-title')?></h3>
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
								<label for="fn-backup-edit-schedule-disabled"><?=t("backup-label-schedule-disabled")?></label>
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
								<label for="fn-backup-edit-schedule-monthday"><?=t("backup-label-schedule-monthly-day")?></label>
								<select
									id="fn-backup-edit-schedule-monthday"
									name="schedule-monthday"
									class="ui-inline"
									title="<?=t("backup-title-schedule-monthly-day")?>"
									>
									<?foreach(range(1,30) as $day):?>
									<option <?if($day===1):?>selected="selected"<?endif?> value="<?=$day?>"><?=to_ordinal($day)?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-edit-schedule-monthhour"><?=t("backup-label-schedule-monthly-hour")?></label>
								<select
									id="fn-backup-edit-schedule-monthhour"
									name="schedule-monthhour"
									class="ui-inline"
									title="<?=t("backup-title-schedule-monthly-hour")?>"
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
								<label for="fn-backup-edit-schedule-weekday"><?=t("backup-label-schedule-weekly-day")?></label>
								<select
									id="fn-backup-edit-schedule-weekday"
									name="schedule-weekday"
									class="ui-inline"
									title="<?=t("backup-title-schedule-weekly-day")?>"
									>
									<?foreach(range(1,7) as $day):?>
									<option <?if($day===1):?>selected="selected"<?endif?> value="<?=t("weekday-$day")?>"><?=t("weekday-$day")?></option>
									<?endforeach?>
								</select>
								<label for="fn-backup-edit-schedule-weekhour"><?=t("backup-label-schedule-weekly-hour")?></label>
								<select
									id="fn-backup-edit-schedule-weekhour"
									name="schedule-weekhour"
									class="ui-inline"
									title="<?=t("backup-title-schedule-weekly-hour")?>"
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
								<label for="fn-backup-edit-schedule-dayhour"><?=t("backup-label-schedule-daily-hour")?></label>
								<select
									id="fn-backup-edit-schedule-dayhour"
									name="schedule-dayhour"
									class="ui-inline"
									title="<?=t("backup-title-schedule-daily-hour")?>"
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
								<label><?=t("backup-label-schedule-hourly")?></label>

							</td>
						</tr>
					</table>
					<hr/>
					<table>
						<tr>
							<td>
								<label for="fn-backup-edit-schedule-timeline"><?=t("backup-label-schedule-timeline")?></label>
								<select
									id="fn-backup-edit-schedule-timeline"
									class="fn-backup-schedule-timeline"
									name="schedule-timeline"
									class="ui-inline"
									title="<?=t("backup-title-schedule-timeline")?>"
									>
									<option value="1D"><?=t("a day")?></option>
									<option value="1W"><?=t("a week")?></option>
									<option value="1M" selected="selected"><?=t("a month")?></option>
									<option value="6M"><?=t("half a year")?></option>
									<option value="1Y"><?=t("a year")?></option>
									<option value="10Y"><?=t("a decade")?></option>
								</select>
								<span class="ui-text-comment">(<?=t("backup-note-schedule-timeline")?>)</span>
							</td>
						</tr>
					</table>
				</div>

				<div id="fn-backup-edit-form-step-5" class="step submit_step">
					<h3><?=t('backup-edit-dialog-step5-title')?></h3>
					<table>
						<tr>
							<td>
								<input
								type="checkbox"
								id="fn-backup-edit-security-enable"
								name="security"
								value="yes"
								/>
								<label for="fn-backup-edit-security-enable"><?=t("backup-label-security-enable")?></label>
							</td>
						</tr>
						<tr>
							<td>
								<label for="fn-backup-edit-security-password"><?=t('backup-label-security-password')?>:</label>
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
								<label for="fn-backup-edit-security-password2"><?=t('backup-label-security-password2')?>:</label>
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
			<?=t('backup-edit-dialog-title')?>
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
										<th><?=t("Name")?></th>
										<th><?=t("Date")?></th>
										<th></th>
									</tr>

									<tr class="ui-header">
										<td colspan="4" class="ui-filemanager-fake-updir"></td>
									</tr>

									<tr>
										<td colspan="4" class=
											"ui-helper-hidden ui-filemanager-permission-denied">
											<?=t("Permission denied")?>
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
						<label for="fn-backup-restore-action-overwrite"><?=t("backup-label-restore-overwrite")?></label>
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
                        <label for="fn-backup-restore-action-newdir"><?=t("backup-label-restore-newdir")?>: </label>
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
				<th><?=t("Name")?></th>
				<th><?=t("Date")?></th>
				<th><?=t("Size")?></th>
				<th></th>
			</tr>

			<tr class="ui-header">
				<td colspan="5" class="ui-filemanager-fake-updir"></td>
			</tr>

			<tr>
				<td colspan="5" class=
					"ui-helper-hidden ui-filemanager-permission-denied">
					<?=t("Permission denied")?>
				</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
