<?php
// $lang['']="";

$lang['weekday-1'] = "Monday";
$lang['weekday-2'] = "Tuesday";
$lang['weekday-3'] = "Wednesday";
$lang['weekday-4'] = "Thursday";
$lang['weekday-5'] = "Friday";
$lang['weekday-6'] = "Saturday";
$lang['weekday-7'] = "Sunday";

$lang["name"] = NAME;

$lang['Login']="Login";
$lang['Home']="Home";
$lang['Users']="Users";
$lang['Services']="Services";
$lang['Mail']="Email";
$lang['Network']="Network";
$lang['Printing']="Printing";
$lang['Settings']="Settings";
$lang['Filemanager']="File manager";
$lang['Backup']="Backup";
$lang['Album']="Photo album";
$lang['Stat']="Home";
$lang['Downloads']="Downloads";
$lang['Disk']="Disk";
$lang['Userinfo']="User info";
$lang['Shutdown']="Confirm Shutdown";

/* Main navigation categories  */
$lang['title_']=$lang['Home'];
$lang['title_home']="Status";
$lang['title_login']=$lang['Login'];
$lang['title_users']=$lang['Users'];
$lang['title_services']=$lang['Services'];
$lang['title_mail']=$lang['Mail'];
$lang['title_network']=$lang['Network'];
$lang['title_printing']=$lang['Printing'];
$lang['title_settings']=$lang['Settings'];
$lang['title_filemanager']=$lang['Filemanager'];
$lang['title_backup']=$lang['Backup'];
$lang['title_album']=$lang['Album'];
$lang['title_stat']=$lang['Stat'];
$lang['title_usermail']=$lang['Mail'];
$lang['title_downloads']=$lang['Downloads'];
$lang['title_disk']=$lang['Disk'];
$lang['title_userinfo']=$lang['Userinfo'];
$lang['title_shutdown']=$lang['Shutdown'];

/* Topnav */

$lang['topnav-settings'] = "Administration";
$lang['topnav-help'] = "Help";
$lang['topnav-home'] = "Home";
$lang['topnav-logout'] = "Logout";


/* 'Elevated' sub navigation */
$lang['title_usersettings-info'] = "User information";
$lang['title_usersettings-mail'] = "Email";
$lang['title_albums'] = "Album manager";
$lang['title_album-users'] = "Album viewers";


/* Sub navigation categories  */
$lang['title_filemanager-browse']="Browse";
$lang['title_filemanager-backup']="Backup";
$lang['title_filemanager-restore']="Restore";
$lang['title_mail-retrieve']="Retreive email";
$lang['title_mail-server_settings']="Server settings";
$lang['title_network-profile']="Profile";
$lang['title_network-lan']="LAN";
$lang['title_network-wan']="WAN";
$lang['title_network-wlan']="Wireless";
$lang['title_network-firewall']="Firewall";
$lang['title_disk-info']="Disk information";
$lang['title_disk-lvm']="LVM";
$lang['title_disk-raid']="RAID";
$lang['title_settings-wizard']="Setup wizard";
$lang['title_settings-identity']="Identity";
$lang['title_settings-traffic']="Torrent throttle";
$lang['title_settings-date']="Time and language";
$lang['title_settings-sysbackup']="Backup settings";
$lang['title_settings-update']="Software update";
$lang['title_settings-logs']="Logs";
$lang['title_photo-albums']="Photo albums";



/* Generic button labels and texts */

$lang['button_label_continue']='Continue';
$lang['button_label_delete']='Delete';
$lang['button_label_cancel']='Cancel';
$lang['button-label-cancel']='Cancel'; // TODO FIXME
$lang['generic_dialog_text_please_wait'] = "Please wait...";
$lang['generic_dialog_text_warning'] = "Warning";
$lang['generic-permission-denied'] = "Permission denied";

/* Login texts  */
$lang["topnav-authorized"] = "Logged in as '%s'";
$lang["topnav-not-authorized"] = "Not logged in";
$lang["login-dialog-header"] = "Login required";
$lang["login-dialog-username"] = "Username";
$lang["login-dialog-password"] = "Password";
$lang["login-dialog-cancel"] = "Cancel";
$lang['login-error-grantaccess'] = "Access not granted for user '%s'.";
$lang['login-error-wanaccess'] = "Admin user not allowed to login on WAN interface.";
$lang['login-error-wanaccess-quickstart'] = "Please read the users manual for advice.";
$lang['login-error-noaccess'] = "User isn't allowed to login to web admin.";
$lang['login-error-pwd'] = "Invalid user/password combination.";

/* Menu bar texts */

$lang['menubar-link-pim'] = "Webmail";
$lang['menubar-link-music'] = "Music";
$lang['menubar-link-album'] = "Photos";
$lang['menubar-link-usersettings'] = "User&nbsp;settings";
$lang['menubar-link-filemanager'] = "File&nbsp;manager";
$lang['menubar-link-backup'] = "File&nbsp;backup";
$lang['menubar-link-systemsettings'] = "System&nbsp;settings";
$lang['menubar-link-downloads'] = "Downloads";


// backup field translations
$lang['current_job'] = "Job name";
$lang['target_protocol'] = "Target";

// disk
$lang['disk_action_title_extend_lvm'] = 'Extending user storage space';
$lang['disk_action_title_create_raid'] = 'Converting system to RAID';
$lang['disk_action_title_restore_raid'] = 'Recovering RAID';
$lang['disk_action_title_format'] = 'Formatting disk';
$lang['in_sync'] = 'In sync';
$lang['faulty'] = 'Disk error';
$lang['active'] = 'Active';
$lang['clean'] = 'Clean';

$lang['disk_format_title'] = "Format disk";
$lang['disk_format_error_mounts_exists_message'] = "There seem to be disks mounted, please unmount these and try again";
$lang['disk_format_message'] = "Please specify label for your new partition";
$lang['disk_format_format_button_label'] = "Format disk";
$lang['disk_format_label_label'] = "Label";
$lang['disk_format_warning_1'] = "Formatting disk will destroy all data on disk";
$lang['disk_format_warning_2'] = "Continue formatting the disk?";
$lang['disk_format_format_progress_title'] = "Formatting disk";
$lang['disk_format'] = "";

$lang['disk_lvm_extend_dialog_warning_message'] = "<p>This will erase all the data on the new, external device. Click 'Create LVM' to continue.</p> <p>Note: Removal of the new disk from the system will require a full system reinstallation.</p>";
$lang['disk_lvm_extend_dialog_warning_title'] = "Extend Logical Volume";
$lang['disk_lvm_extend_dialog_warning_button_label'] = "Create LVM";
$lang['disk_lvm_extend_dialog_title'] = "Extending disk";

/* RAID */
$lang['disk-examine-disks'] = "Examining existing disks";
$lang['disk_raid_setup_title'] = "Setup RAID array";
$lang['disk_raid_create_label'] = "Create RAID array";
$lang['disk_raid_create_message'] = "Set up the internal disk and one external disk into a RAID mirror solution (RAID 1)";
$lang['disk_raid_recover_label'] = "Recover RAID array";
$lang['disk_raid_recover_message'] = "Recover internal disk or add a new external disk to existing RAID array";
$lang['disk_raid_status_title'] = "RAID Status";
$lang['disk_raid_degraded_recover_status_message'] = "Recovering RAID array '%s'";
$lang['disk_raid_degraded_recover_status_message_eta_hours'] = "Current recover progress is %d%% and is estimated to finish in %d hours %d minutes";
$lang['disk_raid_degraded_recover_status_message_eta_minutes'] = "Current recover progress is %d%% and is estimated to finish in %d minutes";
$lang['disk_raid_degraded_message'] = "RAID array degraded";
$lang['disk_raid_degraded_missing_disk_message'] = "Disk missing in RAID array '%s'";
$lang['disk_raid_external_failure_title'] = "Error: External disk has malfunctioned";
$lang['disk_raid_external_failure_message_1'] = "The external RAID disk (<strong>%s</strong>) in the RAID array has malfunctioned";
$lang['disk_raid_external_failure_message_2'] = "Please replace the disk (also press \"Remove\" below to acknowledge the removal of the disk)";
$lang['disk_raid_external_failure_message_3'] = "When the disk has been replaced, press \"Recover RAID array\" to add the new disk to the array";
$lang['disk_raid_normal_op_message'] = "Normal operation";
$lang['disk_raid_not_activated_message'] = "RAID not activated";
$lang['disk_raid_detailed_info_title'] = "Detailed information";
$lang['disk_raid_list_of_arrays_title'] = "List of RAID arrays";
$lang['disk_raid_table_list_of_arrays_array_name_title'] = "Array name";
$lang['disk_raid_table_list_of_arrays_level_title'] = "Level";
$lang['disk_raid_table_list_of_arrays_state_title'] = "State";
$lang['disk_raid_table_list_of_arrays_label_title'] = "Label";
$lang['disk_raid_table_list_of_arrays_size_title'] = "Size";
$lang['disk_raid_list_of_disks_title'] = "List of RAID disks";
$lang['disk_raid_table_list_of_disks_disk_title'] = "Disk";
$lang['disk_raid_table_list_of_disks_parent_title'] = "Parent";
$lang['disk_raid_table_list_of_disks_state_title'] = "State";
$lang['disk_raid_table_list_of_disks_size_title'] = "Size";
$lang['disk_raid_disk_faulty_remove_button_label'] = "Remove";

# Create
$lang['disk_raid_create_progress_title'] = "Recovering RAID array";
$lang['disk_raid_create_title'] = "Create RAID array";
$lang['disk_raid_create_error_mounts_exists_message'] = "There seem to be disks mounted, please unmount these and try again";
$lang['disk_raid_create_select_disk_message'] = "Select which external disk to include in the array. An external disk with the same size is recommended";
$lang['disk_raid_create_warning_1'] = "Creating the RAID array will <strong>destroy all content</strong> on your internal disk (/home&nbsp;-&nbsp;including&nbsp;'storage') and erase the selected external disk";
$lang['disk_raid_create_warning_2'] = "Please make sure that you have backup of all files";
$lang['disk_raid_create_warning_3'] = "Continue to create RAID?";
$lang['disk_raid_create_error_no_disks_found_message'] = "No usable disk found";
$lang['disk_raid_create_button_label'] = "Create RAID";
$lang['disk_raid_nodisk_label_cancel'] = "Close";
# Recover
$lang['disk_raid_recover_title'] = "Recover RAID array";
$lang['disk_raid_recover_broken_external_progress_title'] = "Recovering external disk in RAID array";
$lang['disk_raid_recover_broken_external_message'] = "Select external disk to add to RAID array";
$lang['disk_raid_recover_broken_external_warning_1'] = "Recovering the RAID array will <strong>destroy all content</strong> on the selected extenal disk";
$lang['disk_raid_recover_broken_external_warning_2'] = "Continue to recover RAID?";
$lang['disk_raid_recover_broken_external_button_label'] = "Add disk to RAID array";
$lang['disk_raid_recover_broken_external_no_disks_message'] = "There are no usable external disks attached, please add an external e-SATA disk and try again";
$lang['disk_raid_recover_broken_internal_progress_title'] = "Recovering internal disk in RAID array";
$lang['disk_raid_recover_broken_internal_mount_exists_message'] = "There seem to be disks mounted, please unmount these and try again";
$lang['disk_raid_recover_broken_internal_message'] = "Select which external disk to recover RAID data from";
$lang['disk_raid_recover_broken_internal_button_label'] = "Recover internal disk";
$lang['disk_raid_recover_broken_internal_warning_1'] = "Recovering the RAID array will <strong>destroy all content</strong> on your internal disk (/home&nbsp;-&nbsp;including&nbsp;'storage')";
$lang['disk_raid_recover_broken_internal_warning_2'] = "Continue to recover RAID?";
$lang['disk_raid_recover_broken_internal_button_label'] = "Recover internal disk";
$lang['disk_raid_recover_broken_internal_no_raid_message'] = "No disks with RAID data found";

// Network

$lang['network-settings-locked-1'] = "These settings are locked";
$lang['network-settings-locked-2'] = NAME." is using automatic network settings";
$lang['network-settings-locked-3'] = "To unlock, select Router or Server profile under the ";

$lang['network-firewall-openport'] = "Open ".NAME." port";

$lang['wlan_title'] = 'Wireless';
$lang['wlan_title_ssid'] = 'Network name (SSID)';
$lang['wlan_title_ssid_popup'] = 'The network name (also called SSID) is broadcast by '.NAME.' and will show up on clients when browsing wireless networks.';
$lang['wlan_title_enable'] = 'Wireless access point';
$lang['wlan_title_enable_popup'] = 'Check this checkbox to enable wireless functionallity for your '.NAME.'';

$lang['wlan_title_advanced'] = 'Advanced wireless settings';

$lang['wlan_title_band'] = 'Band';
$lang['wlan_title_band_1'] = '2.4GHz band used by 802.11g';
$lang['wlan_title_band_2'] = '5GHz band used by 802.11a';

$lang['wlan_title_mode'] = 'Mode';
$lang['wlan_title_mode_popup'] = 'The operation mode for selected band';
$lang['wlan_title_legacy_mode_2'] = 'Legacy mode (802.11a)';
$lang['wlan_title_legacy_mode_1'] = 'Legacy mode (802.11g)';
$lang['wlan_title_mixed_mode_2'] = 'Mixed mode (802.11n + 802.11a)';
$lang['wlan_title_mixed_mode_1'] = 'Mixed mode (802.11n + 802.11g)';
$lang['wlan_title_greenfield_mode'] = 'N only mode (802.11n only)';

$lang['wlan_title_encryption'] = 'Encryption';
$lang['wlan_title_encryption_popup'] = 'The encryption to use';
$lang['wlan_title_encryption_wpa2'] = 'WPA2';
$lang['wlan_title_encryption_wpa12'] = 'WPA1 or WPA2';
$lang['wlan_title_encryption_wpa1'] = 'WPA1';
$lang['wlan_title_encryption_wep'] = 'WEP';
$lang['wlan_title_encryption_none'] = 'None';

$lang['wlan_title_width'] = 'Channel width';
$lang['wlan_title_width_popup'] = 'The targeted width of the channel in MHz';
$lang['wlan_title_width_20MHz'] = '20MHz';
$lang['wlan_title_width_40MHz'] = '40MHz';

$lang['wlan_title_password'] = 'Password';
$lang['wlan_title_password_popup'] = 'The password that will be required to connect to '.NAME.' wirelessly';

$lang['wlan_title_channel'] = 'Channel';
$lang['wlan_title_channel_popup'] = 'The main channel to use';

$lang['wlan_title_broadcast'] = 'Broadcast SSID';
$lang['wlan_title_broadcast_popup'] = 'Turning this off hides the network - users have to manually type the SSID on clients';

$lang['fw_title_advanced'] = 'Advanced firewall settings';


# Printing
$lang['printing_add_error_invalid_characters'] = "Invalid characters in share name, only <strong>A-Z</strong>,<strong>a-z</strong> and <strong>_</strong> is allowed";
$lang['printing_add_error_no_name'] = "No name was provided";
$lang['printing_add_error_no_printer_name'] = "No printer name was provided";
$lang['printing_add_error_no_printer_path'] = "No printer path was provided";
$lang['printing_add_operation_fail'] = "Adding printer failed";
$lang['printing_add_success'] = "Printer <strong>%s</strong> was added successfully";
$lang['printing_delete_success'] = "Printer <strong>%s</strong> was deleted successfully";

# Services
$lang['service_update_success'] = "Services updated";

# Settings
$lang['settings-start-wizard'] = "To configure basic functionality of ".NAME.", press the button to start the setup wizard.";

$lang['settings_traffic_success'] = "Traffic limit updated";
$lang['settings_traffic_error_service_unavailable'] = "Traffic service is unavailable";
$lang['settings_traffic_error_set_dl_throttle'] = "Failed to set download throttle";
$lang['settings_traffic_error_set_ul_throttle'] = "Failed to set upload throttle";

$lang['settings_backup_error_no_path'] = "Failed to set up mount point for backup";
$lang['settings_backup_error_failed'] = "The system was unable to create a backup";
$lang['settings_backup_success'] = "System settings backup was sucessfully created";

$lang['settings_restore_error_no_path'] = "Failed to set up mount point for restore";
$lang['settings_restore_error_failed'] = "The system was unable to restore the system from an backup";
$lang['settings_restore_success'] = "System settings was sucessfully restored";

$lang['settings_datetime_success'] = "Timezone, date and/or time was successfully updated";
$lang['settings_datetime_error_set_timezone'] = "Failed to set timezone <strong>%s</strong>";
$lang['settings_datetime_error_set_date_time'] = "Failed to set date <strong>%s</strong> and time <strong>%s</strong>";
$lang['settings-default-lang'] = "System language";
$lang['settings-default-lang-header'] = "Default system language";
$lang['settings_defaultlang_success'] = "Default system language updated";

$lang['settings_software_install_package'] = "Install %s";
$lang['settings_software_update_software'] = "Software update";
$lang['settings_software_update_system'] = "Update system";
$lang['settings_software_include_hotfixes'] = "Include hotfixes and system specific updates";
$lang['help_hotfix']="?page=sw_upgrade.html#hotfix";


$lang['settings_identity_error_change_hostname'] = "Failed to change hostname";
$lang['settings_identity_error_invalid_hostname'] = "Hostname <strong>%s</strong> is invalid, only character <strong>A-Za-z0-9-</strong> is valid";
$lang['settings_identity_easyfind_error_fail_set_name'] = "Failed to set Easyfind name <strong>%s</strong>, this name is probably used. Please try another name";
$lang['settings_identity_easyfind_error_invalid_name'] = "Easyfind name <strong>%s</strong> is invalid, only character <strong>A-Za-z0-9-</strong> is valid";
$lang['settings_identity_easyfind_error_fail_enable'] = "Failed to enable Easyfind";
$lang['settings_identity_easyfind_error_fail_disable'] = "Failed to disable Easyfind";
$lang['settings_identity_title'] = "System identity";
$lang['settings_identity_hostname_label'] = "Hostname";
$lang['settings_identity_workgroup_label'] = "Workgroup";
$lang['settings_identity_update_hostname_workgroup_label'] = "Update hostname and workgroup";
$lang['settings_identity_easyfind_title'] = "Easyfind options";
$lang['settings_identity_easyfind_message'] = "'Easyfind' location service";
$lang['settings_identity_update_easyfind_label'] = "Update Easyfind";

//  ---------- Users  -----
$lang['users-list-edit-realname-label'] = 'Real name';
$lang['users-list-edit-username-label'] = 'User name';
$lang['users-list-edit-shell-label'] = 'Shell login';
$lang['users-list-edit-remote-label'] = 'Allow remote access to system settings';
$lang['users-list-edit-password1-label'] = 'New password';
$lang['users-list-edit-password2-label'] = 'Confirm password';
$lang['users-list-edit-sideboard-label'] = 'Display sideboard for non-logged in users';
$lang['users-list-edit-language'] = 'User language';
$lang['users-list-edit-defaultlang'] = $lang['settings-default-lang-header'];
$lang['users-title'] = 'Users';
$lang['user-users-title'] = 'User information';
$lang['users-label-username'] = 'User name';
$lang['users-label-realname'] = 'Real name';
$lang['users-label-shell-login'] = 'Allow shell login';
$lang['users-add-button-label'] = 'Add new user';
$lang['users-edit-account-error'] = 'Failed to edit account for %s (%3$s) shell: %2$s';
$lang['users-system-default-lang'] = 'System default';

$lang['illegal'] = 'Illegal characters in password';
$lang["mismatch"]='Passwords do not match';
$lang["sambafail"]='Failed to update password';
$lang["passwdfail"]=$lang["sambafail"];
$lang["user_update_error_auth_fail"] = "Authorization failure";
$lang["user_update_error"] = "Error updating user information";
$lang["user_update_ok"] = "User information updated";

$lang["usr_caseerr"] = "No uppercase letters allowed in username";
$lang["usr_existerr"] = "User already exists or is an administrational account";
$lang["usr_nonameerr"] = "No username entered";
$lang["usr_spacerr"] = "White space not allowed in username";
$lang["pwd_charerr"] = "Illegal characters in password";
$lang["usr_charerr"] = "Illegal characters in username";
$lang["usr_longerr"] = "Username to long. Max 32 characters";
$lang["usr_createerr"] = "Error creating user";
$lang["usr_addok"] = "User added";
$lang["pwd_mismatcherr"] = "Passwords do not match or password empty";

//  ---------- Admin Mail-----
$lang["usrinvalid"] = "Not authorized to add accounts for selected user.";
$lang["infoincomp"] = "Account information incomplete. Account not added.";
$lang["mail_addok"] = "Account added.";
$lang["mail_err_usrinvalid"] = "User not allowed to update account";
$lang["mail_editok"] = "Account updated.";
$lang["mail_delete_account_ok"] ="Account deleted";
$lang["mail-server-domaincontroller"] ="Email domain";
$lang['mail_server_userpwdmissing'] = "Missing mail server password";

//  ----------- Filemanager --------

$lang["filemanager-label-name"] = "Name";
$lang["filemanager-title-permissions"] = "Permissions";
$lang["filemanager-label-permission-owner"] = "Owner";
$lang["filemanager-label-permission-owner-read"] = "read";
$lang["filemanager-label-permission-owner-write"] = "write";
$lang["filemanager-label-permission-owner-execute"] = "execute";
$lang["filemanager-label-permission-group"] = NAME." users";
$lang["filemanager-label-permission-group-read"] = "read";
$lang["filemanager-label-permission-group-write"] = "write";
$lang["filemanager-label-permission-group-execute"] = "execute";
$lang["filemanager-label-permission-other"] = "Not logged in";
$lang["filemanager-label-permission-other-read"] = "read";
$lang["filemanager-label-permission-other-write"] = "write";
$lang["filemanager-label-permission-other-execute"] = "execute";

$lang["filemanager-mkdir-dialog-button-label"] = "Create folder";
$lang["filemanager-mkdir-dialog-title"] = "Create a new folder";
$lang["filemanager-delete-dialog-button-label"] = "Delete";
$lang["filemanager-delete-dialog-title"] = "Delete files and folders";
$lang["filemanager-delete-fail-message"] = "Failed to delete following files/folders: %s";
$lang["filemanager-delete-dialog-message"] = "Delete selected files and/or folders?";
$lang["filemanager-rename-dialog-title"] = "Rename";
$lang["filemanager-permission-dialog-title"] = "Change permissions";
$lang["filemanager-perm-dialog-button-label"] = "Change permissions";

$lang['filemanager_mkdir_error_nodir'] = "Error creating folder, no name supplied";
$lang['filemanager_mkdir_error_file_exists'] = "Error creating folder, name already exists";
$lang['filemanager_mkdir_error_create'] = "Failed to create folder";
$lang['filemanager-rename-error'] = "Error renaming file '%s'";
$lang["filemanager-copy-fail-message"] = "Failed to copy the following files and folders: %s";
$lang["filemanager-move-fail-message"] = "Failed to move the following files and folders: %s";
$lang["filemanager-perm-fail-message"] = "Failed to change permission for following files and folders: %s";
$lang["filemanager-album-dialog-message"] = "Add selected images/folders to photo album?";

$lang["help_box_header"] = NAME." Help";

//  ----------- Mail --------

$lang["mail-retrieve-edit-host-label"] = "Host";
$lang["mail-retrieve-edit-protocol-label"] = "Protocol";
$lang["mail-retrieve-edit-ruser-label"] = "Remote user";
$lang["mail-retrieve-edit-password-label"] = "Password";
$lang["mail-retrieve-edit-luser-label"] = "Local user";
$lang["mail-retrieve-edit-usessl-label"] = "Use encryption";
$lang["mail-retrieve-edit-keep-label"] = "Leave email copy on server";
$lang["mail-retrieve-add-button-label"] = "Add new email account";
$lang["mail-validation-error"] = "Validation of input failed";
$lang["mail-auth-error"] = "Authorization failed";
$lang["mail-retrieve-title"] = "Retrieve email";
$lang["mail-server-title"] = "Email server";
$lang["SSL"] = "Encrypted";

// ------------ Backup ----------

$lang["backup-jobs-title"] = "List of backup job specifications for this machine";
$lang["backup-job-runs-title"] = "List of executed runs for selected job specification above";
$lang["backup-job-add-button-label"] = "Add new backup job";
$lang["backup-create-dialog-title"] = "Add new backup job";
$lang["backup-create-dialog-step1-title"] = "Choose a name for this job (step 1 of 5)";
$lang["backup-create-dialog-step2-title"] = "Select what you want to backup (step 2 of 5)";
$lang["backup-create-dialog-step3-title"] = "Choose backup destination (step 3 of 5)";
$lang["backup-create-dialog-step4-title"] = "Select backup schedule (step 4 of 5)";
$lang["backup-create-dialog-step5-title"] = "Advanced settings (step 5 of 5)";
$lang["backup-label-name"] = "Job name";

$lang["backup-selection-data"] = "All user's data (/home/<all users>)";
$lang["backup-selection-email"] = "All user's email (/home/<all users>/Mail)";
$lang["backup-selection-music"] = "All music (/home/storage/music)";
$lang["backup-selection-photo"] = "All photos (/home/storage/photos)";
$lang["backup-selection-video"] = "All videos (/home/storage/video)";
$lang["backup-selection-storage"] = "Storage (/home/storage)";
$lang["backup-selection-custom"] = "Custom selection";

$lang["backup-label-target-protocol"] = "Protocol";
$lang["backup-label-target-server-hostname"] = "Target server";
$lang["backup-label-target-server-username"] = "Target server username";
$lang["backup-label-target-server-password"] = "Target server password";
$lang["backup-label-target-server-path"] = "Target server directory";

$lang["backup-title-schedule-monthly-day"] = "Day of the month";
$lang["backup-title-schedule-monthly-hour"] = "Hour of the day";
$lang["backup-title-schedule-weekly-day"] = "Day of the week";
$lang["backup-title-schedule-weekly-hour"] = "Hour of the day";
$lang["backup-title-schedule-daily-hour"] = "Hour of the day";
$lang["backup-title-schedule-timeline"] = "Age of timeline";

$lang["backup-label-schedule-monthly-day"] = "Monthly on the";
$lang["backup-label-schedule-monthly-hour"] = "at";
$lang["backup-label-schedule-weekly-day"] = "Weekly each";
$lang["backup-label-schedule-weekly-hour"] = "at";
$lang["backup-label-schedule-daily-hour"] = "Daily at";
$lang["backup-label-schedule-hourly"] = "Hourly";
$lang["backup-label-schedule-disabled"] = "Disabled (manually run by pressing \"Run now\")";
$lang["backup-label-schedule-timeline"] = "Keep timeline length of";
$lang["backup-note-schedule-timeline"] = "The longer timeline the more space will be required on target";


//  ----------- Printing --------

$lang["printing-add-button-label"] = "Add new printer";
$lang["printing-title"] = "Printers";
$lang["printing-label-share"] = "Name";
$lang["printing-label-info"] = "Description";
$lang["printing-label-location"] = "Physical Location";
$lang["printing-label-state"] = "State";
$lang["printing-list-edit-printer-label"] = "Printer";
$lang["printing-list-edit-name-label"] = "Name";
$lang["printing-list-edit-location-label"] = "Physical Location";
$lang["printing-list-edit-info-label"] = "Description";

//  ----------- Stat --------

$lang["stat-shutdown-label"] = "Shutdown";
$lang["stat-reboot-label"] = "Restart";

// ----------- Shutdown view --------
$lang["shutdown-shutdown-label"] = "Shutting down ".NAME;
$lang["shutdown-restart-label"] = "To restart ".NAME.", press the power button";
$lang["shutdown-restarting"] = "Restarting ".NAME;
$lang["shutdown-LED-stopflash"] = "When the LED light is solid blue, ".NAME." is ready to be used again";

//  ---------- Album  -----
$lang['album-users-edit-username-label'] = 'Viewer name';
$lang['album-users-edit-password1-label'] = 'New password';
$lang['album-users-edit-password2-label'] = 'Confirm password';

// ------------------ Wizard -------------
$lang["wizard-title-lang"]="Step 1/4: Select default language";
$lang["wizard-title-datetime"]="Step 2/4: Set time and date";
$lang["wizard-title-users"]="Step 3/4: Create users";
$lang["wizard-title-network"]="Step 4/4: Network setup";

$lang['network-wizard-enjoy'] = 'Enjoy ' . NAME;
$lang['network-wizard-easyfind'] = "To locate ".NAME." from the internet, use 'Easyfind' location service";
$lang['network-firewall-allow-wan'] = "Allow external (WAN) access to ".NAME." services";

$lang['wizard-title'] = "Welcome to ".NAME;
$lang['wizard-msg1'] = "Please take a moment to set up basic functionality for ".NAME;
$lang['wizard-msg1'] = "All entered values can easily be changed later using the administration interface.";

// ------ Misc unsorted extracted automatically ----
$lang["Run every"]="Run every";
$lang["Every other hour"]="Every other hour";
$lang["Click to retreive backup information from backup target"]="Click to retreive backup information from backup target";
$lang["Port forward to internal network"]="Port forward to internal network";
$lang["FTP"]="FTP";
$lang["Password"]="Password";
$lang["Date and time"]="Date and time";
$lang["Update error"]="Update error";
$lang["Error starting/stopping DHCP server"]="Error starting/stopping DHCP server";
$lang["Overwrite files"]="Overwrite files";
$lang["Source"]="Source";
$lang["Existing viewers"]="Existing viewers";
$lang["No info"]="No info";
$lang["Remove selected image from album?"]="Remove selected image from album?";
$lang["Only A-Z,a-z,0-9 and \"-\" allowed"]="Only A-Z,a-z,0-9 and \"-\" allowed";
$lang["Home partition"]="Home partition";
$lang["Drag and drop to move images/albums"]="Drag and drop to move images/albums";
$lang["Excluded folders"]="Excluded folders";
$lang["to install squeezecenter"]="to install squeezecenter";
$lang["system_language"]="Language";
$lang["HHmm"]="HHmm";
$lang["Add viewer"]="Add viewer";
$lang["Show logs"]="Show logs";
$lang["Downloading"]="Downloading";
$lang["Time of day"]="Time of day";
$lang["Upload"]="Upload";
$lang["Respond to ping"]="Respond to ping";
$lang["Required for webmail access"]="Required for webmail access";
$lang["month"]="month";
$lang["User"]="User";
$lang["Up and downloads"]="Up and downloads";
$lang["Software update"]="Software update";
$lang["New user"]="New user";
$lang["Anonymous access not granted to parent album."]="Anonymous access not granted to parent album.";
$lang["No files selected"]="No files selected";
$lang["Finish setup"]="Finish setup";
$lang["Error listing disks."]="Error listing disks.";
$lang["No jobs found"]="No jobs found";
$lang["Tu"]="Tu";
$lang["Error retreiving data from target"]="Error retreiving data from target";
$lang["Software version"]="Software version";
$lang["Allocating disk"]="Allocating disk";
$lang["Auto adjust date and time"]="Auto adjust date and time";
$lang["Updating settings falied"]="Updating settings falied";
$lang["Streaming"]="Streaming";
$lang["Read only"]="Read only";
$lang["Email"]="Email";
$lang["Send and recieve"]="Send and recieve";
$lang["Menu"]="Menu";
$lang["None"]="None";
$lang["Invalid gateway address"]="Invalid gateway address";
$lang["Every 12 hours"]="Every 12 hours";
$lang["Select folder to include."]="Select folder to include.";
$lang["Invalid hostname"]="Invalid hostname";
$lang["Data security"]="Data security";
$lang["On the"]="On the";
$lang["Network profile"]="Network profile";
$lang["Retreiving file information ..."]="Retreiving file information ...";
$lang["No access"]="No access";
$lang["Enable jumbo frames."]="Enable jumbo frames.";
$lang["Max upload speed"]="Max upload speed";
$lang["Use -1 for unlimited traffic"]="Use -1 for unlimited traffic";
$lang["Seeding"]="Seeding";
$lang["Total Speed"]="Total Speed";
$lang["Acknowledge"]="Acknowledge";
$lang["Backupjob added."]="Backupjob added.";
$lang["Failed to upload file(s), aborting."]="Failed to upload file(s), aborting.";
$lang["The 'Restore to folder' field can not be empty."]="The 'Restore to folder' field can not be empty.";
$lang["Primary DNS"]="Primary DNS";
$lang["Netmask"]="Netmask";
$lang["Queued for checking"]="Queued for checking";
$lang["Please select profile"]="Please select profile";
$lang["Show"]="Show";
$lang["Please do not remove power until all leds are turned off"]="Please do not remove power until all leds are turned off";
$lang["LAN"]="LAN";
$lang["Included folder"]="Included folder";
$lang["System messages"]="System messages";
$lang["Preparing to"]="Preparing to";
$lang["update system"]="update system";
$lang["Album deleted"]="Album deleted";
$lang["SSH"]="SSH";
$lang["Current restore operations"]="Current restore operations";
$lang["Close"]="Close";
$lang["Invalid IP range entered"]="Invalid IP range entered";
$lang["Number of full backups to keep"]="Number of full backups to keep";
$lang["Restore"]="Restore";
$lang["Uploading to"]="Uploading to";
$lang["Size"]="Size";
$lang["Encrypt data"]="Encrypt data";
$lang["Time until full backup is invalid"]="Time until full backup is invalid";
$lang["day"]="day";
$lang["Run every month"]="Run every month";
$lang["Lease range start"]="Lease range start";
$lang["Delete"]="Delete";
$lang["Total Upload"]="Total Upload";
$lang["Profile"]="Profile";
$lang["Outgoing email server"]="Outgoing email server";
$lang["Add user"]="Add user";
$lang["Invalid DNS address"]="Invalid DNS address";
$lang["Backup status"]="Backup status";
$lang["Disk information"]="Disk information";
$lang["Create job"]="Create job";
$lang["Partition size"]="Partition size";
$lang["Download speed"]="Download speed";
$lang["Private port"]="Private port";
$lang["Start upload"]="Start upload";
$lang["File backup"]="File backup";
$lang["Uploading"]="Uploading";
$lang["File sharing"]="File sharing";
$lang["Error updating image"]="Error updating image";
$lang["Default gateway"]="Default gateway";
$lang["Remote password"]="Remote password";
$lang["Error"]="Error";
$lang["No files included"]="No files included";
$lang["Backup"]="Backup";
$lang["No system messages available"]="No system messages available";
$lang["Start setup wizard"]="Start setup wizard";
$lang["Max download speed"]="Max download speed";
$lang["Error removing image"]="Error removing image";
$lang["Destination"]="Destination";
$lang["days"]="days";
$lang["Step 3/3: Network setup"]="Step 3/3: Network setup";
$lang["Extend"]="Extend";
$lang["Package name"]="Package name";
$lang["Name"]="Name";
$lang["rd"]="rd";
$lang["Format"]="Format";
$lang["seeds"]="seeds";
$lang["Su"]="Su";
$lang["Run hourly"]="Run hourly";
$lang["Real name"]="Real name";
$lang["Remove from album"]="Remove from album";
$lang["Allow anonymous access"]="Allow anonymous access";
$lang["WAN"]="WAN";
$lang["Currently running backup of file(s) from backupjob: "]="Currently running backup of file(s) from backupjob: ";
$lang["Package version"]="Package version";
$lang["nd"]="nd";
$lang["We"]="We";
$lang["Use authentication"]="Use authentication";
$lang["Network configuration"]="Network configuration";
$lang["Permission denied"]="Permission denied";
$lang["Either no wireless network card is available or no valid timezone is set"]="Either no wireless network card is available or no valid timezone is set";
$lang["Restore to folder"]="Restore to folder";
$lang["Partitions"]="Partitions";
$lang["Connecting to tracker"]="Connecting to tracker";
$lang["Partition information"]="Partition information";
$lang["IP-address"]="IP-address";
$lang["BitTorrent"]="BitTorrent";
$lang["Upload complete"]="Upload complete";
$lang["Backup job scheduled"]="Backup job scheduled";
$lang["Add new download"]="Add new download";
$lang["Every 6 hours"]="Every 6 hours";
$lang["By Config"]="By Config";
$lang["week"]="week";
$lang["Browse"]="Browse";
$lang["Channel"]="Channel";
$lang["Never expires"]="Never expires";
$lang["Existing jobs"]="Existing jobs";
$lang["Restore target dirctory missing"]="Restore target dirctory missing";
$lang["Public port"]="Public port";
$lang["Remove dir"]="Remove dir";
$lang["Remote user"]="Remote user";
$lang["Squeezebox Server"]="Squeezebox Server";
$lang["DHCP leases"]="DHCP leases";
$lang["Restoring backup history"]="Restoring backup history";
$lang["Retreiving information started"]="Retreiving information started";
$lang["Disk size"]="Disk size";
$lang["Public port range accepted as start-port:stop-port"]="Public port range accepted as start-port:stop-port";
$lang["Email server"]="Email server";
$lang["Error reading jobsettings."]="Error reading jobsettings.";
$lang["Device"]="Device";
$lang["B3 start page"]="B3 start page";
$lang["Step 2/3: Create users"]="Step 2/3: Create users";
$lang["Cancel"]="Cancel";
$lang["Target"]="Target";
$lang["Error updating user access"]="Error updating user access";
$lang["Disk capacity"]="Disk capacity";
$lang["Jobname missing"]="Jobname missing";
$lang["st"]="st";
$lang["Restoring file(s) from backupjob: "]="Restoring file(s) from backupjob: ";
$lang["Maximum total upload is 2GByte."]="Maximum total upload is 2GByte.";
$lang["Image updated"]="Image updated";
$lang["System partitions"]="System partitions";
$lang["Existing albums"]="Existing albums";
$lang["Host"]="Host";
$lang["Invalid IP"]="Invalid IP";
$lang["Downloader"]="Downloader";
$lang["These settings are locked"]="These settings are locked";
$lang["Source IP"]="Source IP";
$lang["Retreiving package information"]="Retreiving package information";
$lang["Backup target settings undefined."]="Backup target settings undefined.";
$lang["Retreiving information"]="Retreiving information";
$lang["Easyfind"]="Easyfind";
$lang["Extend Logical Volume"]="Extend Logical Volume";
$lang["Lease range end"]="Lease range end";
$lang["User defined open / forwarded ports"]="User defined open / forwarded ports";
$lang["Location"]="Location";
$lang["Restore selection"]="Restore selection";
$lang["Save settings"]="Save settings";
$lang["No backup medium found"]="No backup medium found";
$lang["Job settings"]="Job settings";
$lang["Setup wizard"]="Setup wizard";
$lang["Next"]="Next";
$lang["Private IP"]="Private IP";
$lang["Empty name not allowed"]="Empty name not allowed";
$lang["Partition"]="Partition";
$lang["Router + Firewall + Server"]="Router + Firewall + Server";
$lang["This page should not be reached"]="This page should not be reached";
$lang["Adding images is done using the"]="Adding images is done using the";
$lang["Name not available or failed to validate request"]="Name not available or failed to validate request";
$lang["Restore missing files"]="Restore missing files";
$lang["Album name"]="Album name";
$lang["Status"]="Status";
$lang["Select folder to exclude."]="Select folder to exclude.";
$lang["Access allowed"]="Access allowed";
$lang["Disabled"]="Disabled";
$lang["Username"]="Username";
$lang["Confirm key"]="Confirm key";
$lang["Image removed from album"]="Image removed from album";
$lang["Use static IP address settings"]="Use static IP address settings";
$lang["Th"]="Th";
$lang["Viewer"]="Viewer";
$lang["Create empty album"]="Create empty album";
$lang["Handle email for domain"]="Handle email for domain";
$lang["Email retrieval"]="Email retrieval";
$lang["Run now"]="Run now";
$lang["UPNP streaming"]="UPNP streaming";
$lang["Backup complete"]="Backup complete";
$lang["Obtain IP-address automatically"]="Obtain IP-address automatically";
$lang["MAC-address"]="MAC-address";
$lang["Squeezebox server isn't installed, please click"]="Squeezebox server isn't installed, please click";
$lang["IP"]="IP";
$lang["Mo"]="Mo";
$lang["Done."]="Done.";
$lang["Exclude"]="Exclude";
$lang["Other"]="Other";
$lang["Album updated"]="Album updated";
$lang["Back"]="Back";
$lang["Easyfind name"]="Easyfind name";
$lang["Run every week"]="Run every week";
$lang["Update successful"]="Update successful";
$lang["Please enter a jobname to identify your backup job."]="Please enter a jobname to identify your backup job.";
$lang["your-easyfind-name"]="your-easyfind-name";
$lang["Disconnect"]="Disconnect";
$lang["Private port is start port if public port range entered"]="Private port is start port if public port range entered";
$lang["Abort"]="Abort";
$lang["Setup complete"]="Setup complete";
$lang["Delete album"]="Delete album";
$lang["Backup and restore settings"]="Backup and restore settings";
$lang["Delete backup job:"]="Delete backup job:";
$lang["no valid WAN port connection"]="no valid WAN port connection";
$lang["Read and write"]="Read and write";
$lang["Included files"]="Included files";
$lang["Delete job"]="Delete job";
$lang["Restore started"]="Restore started";
$lang["Change timezone"]="Change timezone";
$lang["WWW"]="WWW";
$lang["Upload to"]="Upload to";
$lang["Leave copy"]="Leave copy";
$lang["Restore user data"]="Restore user data";
$lang["Enable DNS service"]="Enable DNS service";
$lang["Partition label"]="Partition label";
$lang["with"]="with";
$lang["Traffic"]="Traffic";
$lang["here"]="here";
$lang["peers"]="peers";
$lang["Use plain text authentication"]="Use plain text authentication";
$lang["Disk error"]="Disk error";
$lang["wlan_title_band_2_4"]="wlan_title_band_2_4";
$lang["Destination folder"]="Destination folder";
$lang["YYYYMMDD"]="YYYYMMDD";
$lang["Invalid IP address"]="Invalid IP address";
$lang["Sa"]="Sa";
$lang["Backup date"]="Backup date";
$lang["Every hour"]="Every hour";
$lang["Enable DHCP server"]="Enable DHCP server";
$lang["Image name"]="Image name";
$lang["Unknown state"]="Unknown state";
$lang["Error updating album"]="Error updating album";
$lang["wlan_title_band_5_0"]="wlan_title_band_5_0";
$lang["Initializing"]="Initializing";
$lang["Current package versions"]="Current package versions";
$lang["Current timezone is"]="Current timezone is";
$lang["Settings updated successfully"]="Settings updated successfully";
$lang["Target settings"]="Target settings";
$lang["Protocol"]="Protocol";
$lang["Connect"]="Connect";
$lang["Network settings"]="Network settings";
$lang["Error starting/stopping DNS service"]="Error starting/stopping DNS service";
$lang["Excito"]="Excito";
$lang["Please select files to restore from the list of included files."]="Please select files to restore from the list of included files.";
$lang["Uptime"]="Uptime";
$lang["Invalid netmask"]="Invalid netmask";
$lang["Add entry"]="Add entry";
$lang["DAAP streaming"]="DAAP streaming";
$lang["Invalid DNS setting"]="Invalid DNS setting";
$lang["Type"]="Type";
$lang["Explain"]="Explain";
$lang["Error updating user access to public"]="Error updating user access to public";
$lang["Mount path"]="Mount path";
$lang["Available"]="Available";
$lang["th"]="th";
$lang["Automatic network settings"]="Automatic network settings";
$lang["Hostname"]="Hostname";
$lang["Add"]="Add";
$lang["Server only"]="Server only";
$lang["Selecting a folder will also select all files within the folder."]="Selecting a folder will also select all files within the folder.";
$lang["Error deleting album"]="Error deleting album";
$lang["The specified backupdisk is not attached."]="The specified backupdisk is not attached.";
$lang["Download failed"]="Download failed";
$lang["(Not recommended, passwords will be sent unencrypted.)"]="(Not recommended, passwords will be sent unencrypted.)";
$lang["Checking existing files"]="Checking existing files";
$lang["Job name"]="Job name";
$lang["No local data found"]="No local data found";
$lang["wizard-msg2"]="wizard-msg2";
$lang["disk"]="disk";
$lang["Timezone"]="Timezone";
$lang["No disks found"]="No disks found";
$lang["Lease expires"]="Lease expires";
$lang["Exit setup"]="Exit setup";
$lang["Local user"]="Local user";
$lang["Update"]="Update";
$lang["Fr"]="Fr";
$lang["(Please read manual before enabling)"]="(Please read manual before enabling)";
$lang["Invalid gateway"]="Invalid gateway";
$lang["filemanager"]="filemanager";
$lang["Existing users"]="Existing users";
$lang["Backup schedule"]="Backup schedule";
$lang[" for user: "]=" for user: ";
$lang["Remote"]="Remote";
$lang["Anonymous FTP access"]="Anonymous FTP access";
$lang["Encryption passwords do not match"]="Encryption passwords do not match";
$lang["Done downloading (But missing data)"]="Done downloading (But missing data)";
$lang["Include"]="Include";
$lang["Encryption key"]="Encryption key";
$lang["Album access rights updated"]="Album access rights updated";
$lang["Description"]="Description";
$lang["Current backup operations"]="Current backup operations";
