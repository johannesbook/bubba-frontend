<?php
// $lang['']="";
$lang['Login']="Login";
$lang['Home']="Home";
$lang['Users']="Users";
$lang['Services']="Services";
$lang['Mail']="Email";
$lang['Network']="Network";
$lang['Printing']="Printing";
$lang['Settings']="Settings";
$lang['Filemanager']="File manager";
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
$lang['title_settings-date']="Date and time";
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

$lang['disk_lvm_extend_dialog_warning_message'] = "<p>This will erase all the data on the new, external device. Continue?</p> <p>Note: Removal of the new disk from the system will require a full reinstall.</p>";
$lang['disk_lvm_extend_dialog_warning_title'] = "Extend default data partition";
$lang['disk_lvm_extend_dialog_warning_button_label'] = "Extend partition";
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
$lang['wlan_title'] = 'Wireless';
$lang['wlan_title_ssid'] = 'Network name (SSID)';
$lang['wlan_title_ssid_popup'] = 'The network name (also called SSID) is broadcast by Bubba and will show up on clients when browsing wireless networks.';
$lang['wlan_title_enable'] = 'Wireless access point';
$lang['wlan_title_enable_popup'] = 'Check this checkbox to enable wireless functionallity for your Bubba';

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
$lang['wlan_title_password_popup'] = 'The password that will be required to connect to Bubba wirelessly';

$lang['wlan_title_channel'] = 'Channel';
$lang['wlan_title_channel_popup'] = 'The main channel to use';

$lang['wlan_title_broadcast'] = 'Broadcast SSID';
$lang['wlan_title_broadcast_popup'] = 'Turning this of hides the network - users have to manually type the SSID on clients';

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

$lang['users-title'] = 'Users';
$lang['user-users-title'] = 'User information';
$lang['users-label-username'] = 'User name';
$lang['users-label-realname'] = 'Real name';
$lang['users-label-shell-login'] = 'Allow shell login';
$lang['users-add-button-label'] = 'Add new user';
$lang['users-edit-account-error'] = 'Failed to edit account for %s (%3$s) shell: %2$s';

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
$lan['mail_server_userpwdmissing'] = "Missing mail server password";

//  ----------- Filemanager --------

$lang["filemanager-label-name"] = "Name";
$lang["filemanager-title-permissions"] = "Permissions";
$lang["filemanager-label-permission-owner"] = "Owner";
$lang["filemanager-label-permission-owner-read"] = "read";
$lang["filemanager-label-permission-owner-write"] = "write";
$lang["filemanager-label-permission-owner-execute"] = "execute";
$lang["filemanager-label-permission-group"] = "Bubba users";
$lang["filemanager-label-permission-group-read"] = "read";
$lang["filemanager-label-permission-group-write"] = "write";
$lang["filemanager-label-permission-group-execute"] = "execute";
$lang["filemanager-label-permission-other"] = "Not logged in";
$lang["filemanager-label-permission-other-read"] = "read";
$lang["filemanager-label-permission-other-write"] = "write";
$lang["filemanager-label-permission-other-execute"] = "execute";

$lang["filemanager-mkdir-dialog-button-label"] = "Create directory";
$lang["filemanager-mkdir-dialog-title"] = "Create a new directory";
$lang["filemanager-delete-dialog-button-label"] = "Delete";
$lang["filemanager-delete-dialog-title"] = "Delete files and directories";
$lang["filemanager-delete-fail-message"] = "Failed to delete following files/directories: %s";
$lang["filemanager-delete-dialog-message"] = "Delete selected files and/or directories?";
$lang["filemanager-rename-dialog-title"] = "Rename";
$lang["filemanager-permission-dialog-title"] = "Change permissions";
$lang["filemanager-perm-dialog-button-label"] = "Change permissions";

$lang['filemanager_mkdir_error_nodir'] = "Error creating directory, no name supplied";
$lang['filemanager_mkdir_error_file_exists'] = "Error creating directory, name already exists";
$lang['filemanager_mkdir_error_create'] = "Failed to create directory";
$lang['filemanager-rename-error'] = "Error renaming file '%s'";
$lang["filemanager-copy-fail-message"] = "Failed to copy the following files and directories: %s";
$lang["filemanager-move-fail-message"] = "Failed to move the following files and directories: %s";
$lang["filemanager-album-dialog-message"] = "Add selected images/directories to photo album?";

$lang["help_box_header"] = "Bubba Help";

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

//  ---------- Album  -----
$lang['album-users-edit-username-label'] = 'Viewer name';
$lang['album-users-edit-password1-label'] = 'New password';
$lang['album-users-edit-password2-label'] = 'Confirm password';
