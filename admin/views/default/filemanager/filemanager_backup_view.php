<?
	function select($list,$id,$prefix) {
		print "<div id=\"$id\">\n";
		foreach($list as $key => $line) {
			print "<div class=\"files\" id=\"".$prefix."_".$key."\">$line</div>\n";
		}
		print "</div>\n";
	}

	function printjobs($list) {
		print "<div id=\"current_jobs\">\n";
		foreach($list as $key => $line) {
			print "<div class=\"files\" id=\"$line\">$line</div>\n";
		}
		print "</div>\n";
	}

?>


	<table id="backup">
	    
	    <tr><td colspan="8" class="ui-state-default ui-widghet-header ui-div-header"><?=t('File sharing')?></td></tr>
		<tr>
			<th><?=t('Existing jobs')?></th>
			<th><?=t('Included directories')?></th>
			<th><?=t('Job settings')?></th>
		</tr>
		<tr>
			<td rowspan="3" class="backupjobs">
				<?
				if(count($backupjobs)) {
					printjobs($backupjobs);					
				} else {
					print "<div id=\"current_jobs\">\n";
					print t('No jobs found') .".\n";
					print "</div>";
	 			} ?>
				<input type="text" id="create_job" /><input type="submit" id="btn_createjob" class="incexc" value="<?=t('Create job')?>" />
				<div id="create_error" class="error"></div>
			</td>
			<td>
				<div id="current_incfiles">
				</div>
				<input type="button" id="remove_inc" value="<?=t("Remove dir")?>" />
				<input <?if(!count($backupjobs)):?>disabled="disabled"<?endif?> type="submit" id="include" name="btn_include" class="incexc" value="<?=t('Browse')?>" />
				<div id="inc_error" class="error"></div>
			</td>
			<td  rowspan="3" class="backupsettings">
				<form id="backupsettings">
				<div id="settings">

					<fieldset class="fld_settings"><legend><?=t('Name')?></legend>
						<table id="backupname" class="tbl_settings">
							<tr>

								<td class="size1"><?=t('Job name')?></td>
								<td class="size1">
										<input type="text" name="jobname" value="" />
										<input type="hidden" value="0" id="current_job" name="current_job"/>
								</td>
								<td class="size_rest" id="status"></td>
							</tr>
						</table> <!-- end backupname -->
					</fieldset>
						
					<fieldset class="fld_settings"><legend><span id="s_target" class="expansion"><span id="tar_mark">-</span>&nbsp;&nbsp;<?=t('Target settings')?></span></legend>
						<div  id="target">
						<table class="tbl_settings">
							<tr>
								<td class="size1"><?=t('Target')?></td>
								<td class="size1"><select name="target_protocol" id="target_protocol">
										<option value="file">USB/E-SATA <?=t("disk")?></option>
										<option value="scp"><?=t("Remote")?> (SSH)</option>
										<option value="FTP"><?=t("Remote")?> (FTP)</option>
									</select>			
								</td>
								<td class="size1"></td>
								<td class="size_rest"></td>
							</tr>
							<tr>
								<td class="size1"><span id="disk_label" class="underline"><?=t('Disk')?></span> / <span id="host_label"><?=t('Host')?></span></td>
								<td class="size1"><span id="target_host"><input type="text" name="target_host" value="" /></span><span id="target_disk" class="hidden"></span></td>
								<td class="size1"><?=t('Destination directory')?></td>
								<td class="size_rest"><input type="text" name="target_path" id="target_path" value="" /></td>
							</tr>
							<tr>
								<td class="size1"><?=t('Remote user')?></td>
								<td class="size1"><input type="text" name="target_user" id="target_user" value="" disabled="disabled"/></td>
								<td class="size1"><?=t('Remote password')?></td>
								<td class="size_rest"><input type="password" name="target_FTPpasswd" id="target_FTPpasswd" value="" disabled="disabled"/></td>
							</tr>
						</table> <!-- end target section -->
						</div>
					</fieldset>


					<fieldset class="fld_settings"><legend><span id="s_schedule" class="expansion"><span id="sch_mark">-</span>&nbsp;&nbsp;<?=t('Backup schedule')?></span></legend>
						<div  id="schedule">
						<table class="tbl_settings">
							<tr>
								<td class="size1"><?=t('Run every month')?></td>
								<td class="tight"><input type="radio" class="checkbox_radio" name="monthweek" value="month" /></td>
								<td class="size1"><?=t('On the')?>:</td>
								<td class="size_rest">
									<select name="dayofmonth">
									 <? for($i=1;$i<32;$i++) {
									 		print "<option value=\"$i\">$i";
									 		switch ($i) {
								 				case 1;
								 					print t("st");
								 					break;
								 				case 2;
								 					print t("nd");
								 					break;
								 				case 3;
								 					print t("rd");
								 					break;
								 				default;
								 					print t("th");
								 					break;
									 			}
									 			print "</option>\n";
									 } ?>
								</select>
								</td>
							</tr>
							<tr>
								<td class="size1"><?=t('Run every week')?></td>
								<td class="tight"><input type="radio" class="checkbox_radio" name="monthweek" value="week" /></td>
								<td class="size_rest" colspan="2">	
									<input type="checkbox" value="mon" name="mon" class="checkbox_radio weekday" /> <?=t('Mo')?>
									<input type="checkbox" value="tue" name="tue" class="checkbox_radio weekday" /> <?=t('Tu')?>
									<input type="checkbox" value="wed" name="wed" class="checkbox_radio weekday" /> <?=t('We')?>
									<input type="checkbox" value="thu" name="thu" class="checkbox_radio weekday" /> <?=t('Th')?>
									<input type="checkbox" value="fri" name="fri" class="checkbox_radio weekday" /> <?=t('Fr')?>
									<input type="checkbox" value="sat" name="sat" class="checkbox_radio weekday" /> <?=t('Sa')?>
									<input type="checkbox" value="sun" name="sun" class="checkbox_radio weekday" /> <?=t('Su')?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td class="size1"><?=t('Time of day')?></td>
								<td class="size_rest">
									<select name="timeofday">
									 <? for($i=0;$i<24;$i++) { ?>
									 		<option value="<?=$i?>">
									 			<?printf("%02d:00",$i);?>
									 		</option>
									 <? } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="size1"><?=t('Run hourly')?></td>
								<td class="tight"><input type="radio" class="checkbox_radio" name="monthweek" value="hourly" /></td>
								<td class="size1"><?=t('Run every')?>:</td>
								<td class="size_rest">
									<select name="hourly">
										<option value="1"><?=t('Every hour')?></option>
										<option value="2"><?=t('Every other hour')?></option>
										<option value="6"><?=t('Every 6 hours')?></option>
										<option value="12"><?=t('Every 12 hours')?></option>
								</select>
								</td>
							</tr>

							<tr>
								<td class="size1"><?=t('Disabled')?></td>
								<td class="tight"><input type="radio" class="checkbox_radio" name="monthweek" value="disabled" /></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="size1"><?=t('Number of fullbackups to keep')?></td>
								<td class="size1"><select name="nbr_fullbackups">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="5">5</option>
										<option value="10">10</option>
									</select>			
								</td>
								<td class="size1"><?=t('Time until full backup is invalid')?></td>
								<td class="size_rest"><select name="full_expiretime">
										<option value="1D">1 <?=t('day')?></option>
										<option value="1W">1 <?=t('week')?></option>
										<option value="1M">1 <?=t('month')?></option>
										<option value="0"><?=t('Never expires')?></option>
									</select>			
								</td>
							</tr>
						</table>
						</div>
					</fieldset> <!-- end schedule -->

					<fieldset class="fld_settings"><legend><span id="s_security" class="expansion"><span id="sec_mark">-</span>&nbsp;&nbsp;<?=t('Data security')?></span></legend>
						
						<div  id="security">
						<table class="tbl_settings">
							<tr>
								<td class="size1"><?=t('Encrypt data')?></td>
								<td class="size1"><input type="checkbox" class="checkbox_radio" id="encrypt" name="encrypt" <?=isset($backupsettings[0]["GPG_key"])?"checked=\"checked\"":""?> /></td>
								<td class="size1"><?=t('Encryption key')?></td>
								<td class="size_rest"><input disabled="disabled" type="password" id="GPG_key" name="GPG_key" value="<?=isset($backupsettings[0]["GPG_key"])?$backupsettings[0]["GPG_key"]:""?>" /></td>
							</tr>
							<tr>
								<td class="size1" />
								<td class="size1" />
								<td class="size1"><?=t('Verify key')?></td>
								<td class="size_rest"><input disabled="disabled" type="password" id="GPG_key2" name="GPG_key2" value="<?=isset($backupsettings[0]["GPG_key"])?$backupsettings[0]["GPG_key"]:""?>" /></td>
							</tr>
						</table> <!-- end security -->
						</div>
					</fieldset>
					<div>
					<table id="buttons" class="tbl_settings">
						<tr>
							<td>
								<input onclick="updatebackup()" type="button" name="update" value="<?=t('Save settings')?>" />&nbsp;&nbsp;<input onclick="runnow('')" type="button" name="run_now" value="<?=t('Run now')?>" disabled="true"/>&nbsp;&nbsp;<input onclick="delete_job()" type="button" name="deletejob" value="<?=t('Delete job')?>" disabled="true"/>
								<input type="hidden" name="includedfiles" />
								<input type="hidden" name="excludedfiles" />
	
							</td>
						</tr>
					</table>  <!-- end buttons -->
					</div>
			</div> <!-- end settings -->
			</form>		
				
			</td>
		</tr>

		<tr>
			<th><?=t('Excluded directories')?></th>
		</tr>
		<tr>
			<td>
				<div id="current_excfiles">
				</div>
				<input type="button" id="remove_exc" value="<?=t("Remove dir")?>" />
				<input type="submit" id="exclude" name="btn_exclude" class="incexc" value="<?=t('Browse')?>" />
				<div id="exc_error" class="error"></div>
			</td>
			
		</tr>
		
	</table>
</fieldset>

<fieldset><legend><?=t("Current operations")?></legend>
		<div id="lock_header" ><?
			if(isset($backup["user"])) {
				?>
				<input type="hidden" id="job_running" value="<?=$backup["jobname"]?>">
				<?
				echo t("Currently running backup of file(s) from backupjob: ");
				echo $backup["jobname"];
				echo t(" for user: ");
				echo $backup["user"];
			} else {
				echo t("No backup jobs currently running");
			}
			?>
		</div>
		<div id="lock_progress"></div>
		<div id="lock_error" class="highlight"></div>
</fieldset>

