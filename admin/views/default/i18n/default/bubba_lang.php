<?php
// $lang['']="";
$lang['Login']="Login";
$lang['Home']="Home";
$lang['Users']="Users";
$lang['Services']="Services";
$lang['Mail']="Mail";
$lang['Network']="Network";
$lang['Printing']="Printing";
$lang['Settings']="Settings";
$lang['Filemanager']="File manager";
$lang['Album']="Photo album";
$lang['Stat']="Home";
$lang['Mail']="Mail";
$lang['Downloads']="Downloads";
$lang['Disk']="Disk";
$lang['Userinfo']="User info";
$lang['Shutdown']="Confirm Shutdown";

/* Main navigation categories  */
$lang['title_']=$lang['Home'];
$lang['title_home']=$lang['Home'];
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

/* Sub navigation categories  */
$lang['title_filemanager-browse']="Browse";
$lang['title_filemanager-backup']="Backup";
$lang['title_filemanager-restore']="Restore";
$lang['title_mail-retrieve']="Retreive Mail";
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
$lang['title_settings-traffic']="Traffic";
$lang['title_settings-date']="Date and time";
$lang['title_settings-sysbackup']="Config backup";
$lang['title_settings-update']="Firmware upgrade";
$lang['title_settings-logs']="Logs";



/* Generic button labels and texts */

$lang['button_label_continue']='Continue';
$lang['button_label_delete']='Delete';
$lang['button_label_cancel']='Cancel';
$lang['button-label-cancel']='Cancel'; // TODO FIXME
$lang['generic_dialog_text_please_wait'] = "Please wait...";
$lang['generic_dialog_text_warning'] = "Warning";

/* Login texts  */
$lang["topnav-authorized"] = "Logged in as '%s'";
$lang["topnav-not-authorized"] = "Not logged in";
$lang["login-dialog-header"] = "Login";
$lang["login-dialog-username"] = "Username";
$lang["login-dialog-password"] = "Password";
$lang["login-dialog-cancel"] = "Cancel";
$lang["login-dialog-continue"] = "Log in";
$lang['login-error-grantaccess'] = "Access not granted for user '%s'.";
$lang['login-error-wanaccess'] = "Admin user not allowed to login on wan interface.";
$lang['login-error-wanaccess-quickstart'] = "Please read quickstart guide for advice.";
$lang['login-error-pwd'] = "Invalid user/password combination.";

/* Menu bar texts */

$lang['menubar_pim'] = "Webmail";
$lang['menubar_music'] = "Music";
$lang['menubar_photos'] = "Photos";
$lang['menubar_usersettings'] = "User settings";
$lang['menubar_filemanager'] = "File manager";
$lang['menubar_backup'] = "File backup";
$lang['menubar_settings'] = "System settings";


// backup field translations
$lang['current_job'] = "Job name";
$lang['target_protocol'] = "Target";

// disk
$lang['disk_action_title_extend_lvm'] = 'Extending user storage space';
$lang['disk_action_title_create_raid'] = 'Converting system to RAID';
$lang['disk_action_title_restore_raid'] = 'Recovering RAID';
$lang['disk_action_title_format'] = 'Formating disk';
$lang['in_sync'] = 'In sync';
$lang['faulty'] = 'Disk error';
$lang['active'] = 'Active';
$lang['clean'] = 'Clean';

$lang['disk_format_title'] = "Format disk";
$lang['disk_format_error_mounts_exists_message'] = "There seems to be disks mounted, please unmount these and try again";
$lang['disk_format_message'] = "Please specify label for your new partition";
$lang['disk_format_format_button_label'] = "Format disk";
$lang['disk_format_label_label'] = "Label";
$lang['disk_format_warning_1'] = "Formating disk will destroy all data on disk";
$lang['disk_format_warning_2'] = "Continue with formatting the disk?";
$lang['disk_format_format_progress_title'] = "Formating disk";
$lang['disk_format'] = "";

$lang['disk_lvm_extend_dialog_warning_message'] = "<p>This will erase all the data on the external device. Continue?</p> <p>Note: Removal of the new disk from the system will require a full reinstall.</p>";
$lang['disk_lvm_extend_dialog_warning_title'] = "Extend default data partition";
$lang['disk_lvm_extend_dialog_warning_button_label'] = "Extend partition";
$lang['disk_lvm_extend_dialog_title'] = "Extending disk";

/* RAID */
$lang['disk_raid_setup_title'] = "Setup RAID array";
$lang['disk_raid_create_label'] = "Create RAID array";
$lang['disk_raid_create_message'] = "Set up internal disk and one external disk into a RAID mirror solution (RAID 1)";
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
$lang['disk_raid_create_error_mounts_exists_message'] = "There seems to be disks mounted, please unmount these and try again";
$lang['disk_raid_create_select_disk_message'] = "Select which external disk to include in the array. For best usage an external disk with the same size is recommended";
$lang['disk_raid_create_warning_1'] = "Creating the RAID array will <strong>destroy all content</strong> on your internal disk (/home&nbsp;-&nbsp;including&nbsp;'storage') and erase the selected external disk";
$lang['disk_raid_create_warning_2'] = "Please make certain that you have a backup of all files";
$lang['disk_raid_create_warning_3'] = "Continue to create RAID?";
$lang['disk_raid_create_error_no_disks_found_message'] = "No usable disk found";
$lang['disk_raid_create_button_label'] = "Create RAID";

# Recover
$lang['disk_raid_recover_title'] = "Recover RAID array";
$lang['disk_raid_recover_broken_external_progress_title'] = "Recovering external disk in RAID array";
$lang['disk_raid_recover_broken_external_message'] = "Select external disk to add to RAID array";
$lang['disk_raid_recover_broken_external_warning_1'] = "Recovering the RAID array will <strong>destroy all content</strong> on the selected extenal disk";
$lang['disk_raid_recover_broken_external_warning_2'] = "Continue to recover RAID?";
$lang['disk_raid_recover_broken_external_button_label'] = "Add disk to RAID array";
$lang['disk_raid_recover_broken_external_no_disks_message'] = "There are no usable external disks attached, please add an external e-SATA disk and try again";
$lang['disk_raid_recover_broken_internal_progress_title'] = "Recovering internal disk in RAID array";
$lang['disk_raid_recover_broken_internal_mount_exists_message'] = "There seems to be disks mounted, please unmount these and try again";
$lang['disk_raid_recover_broken_internal_message'] = "Select which external disk to recover RAID data from";
$lang['disk_raid_recover_broken_internal_button_label'] = "Recover internal disk";
$lang['disk_raid_recover_broken_internal_warning_1'] = "Recovering the RAID array will <strong>destroy all content</strong> on your internal disk (/home&nbsp;-&nbsp;including&nbsp;'storage')";
$lang['disk_raid_recover_broken_internal_warning_2'] = "Continue to recover RAID?";
$lang['disk_raid_recover_broken_internal_button_label'] = "Recover internal disk";
$lang['disk_raid_recover_broken_internal_no_raid_message'] = "No disks with RAID data found";

// Network
$lang['wlan_title'] = 'Wireless';
$lang['wlan_title_ssid'] = 'Network name (SSID)';
$lang['wlan_title_ssid_popup'] = 'The network name is used to connect to the Bubba|TWO via a wireless network, often called SSID';
$lang['wlan_title_enable'] = 'Enable wireless';
$lang['wlan_title_enable_popup'] = 'Check this checkbox to enable wireless functionallity for your Bubba|TWO';

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
$lang['wlan_title_password_popup'] = 'The WEP or WPA password that should be required to connect to the AP';

$lang['wlan_title_channel'] = 'Channel';
$lang['wlan_title_channel_popup'] = 'The main channel to use';

$lang['wlan_title_broadcast'] = 'Broadcast SSID';
$lang['wlan_title_broadcast_popup'] = 'Whenever to broadcast the SSID';

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
$lang['settings_backup_error_failed'] = "The system was unable to create an backup";
$lang['settings_backup_success'] = "System backup was sucessfully created";

$lang['settings_restore_error_no_path'] = "Failed to set up mount point for restore";
$lang['settings_restore_error_failed'] = "The system was unable to restore the system from an backup";
$lang['settings_restore_success'] = "System was sucessfully restored";

$lang['settings_datetime_success'] = "Timezone, date and/or time was successfully updated";
$lang['settings_datetime_error_set_timezone'] = "Failed to set timezone <strong>%s</strong>";
$lang['settings_datetime_error_set_date_time'] = "Failed to set date <strong>%s</strong> and time <strong>%s</strong>";

$lang['settings_software_install_package'] = "Install %s";
$lang['settings_software_update_software'] = "Update software";
$lang['settings_software_update_system'] = "Update system";
$lang['settings_software_include_hotfixes'] = "Include hotfixes and system specific updates";

$lang['settings_identity_error_change_hostname'] = "Failed to change hostname";
$lang['settings_identity_error_invalid_hostname'] = "Hostname <strong>%s</strong> is invalid, only character <strong>A-Za-z0-9-</strong> is valid";
$lang['settings_identity_easyfind_error_fail_set_name'] = "Failed to set easyfind name <strong>%s</strong>, probably this name is taken allready. Please try an other one";
$lang['settings_identity_easyfind_error_invalid_name'] = "Easyfind name <strong>%s</strong> is invalid, only character <strong>A-Za-z0-9-</strong> is valid";
$lang['settings_identity_easyfind_error_fail_enable'] = "Failed to enable easyfind";
$lang['settings_identity_easyfind_error_fail_disable'] = "Failed to disable easyfind";
$lang['settings_identity_title'] = "Windows share options"; # XXX Erm? WTF???
$lang['settings_identity_hostname_label'] = "Hostname";
$lang['settings_identity_workgroup_label'] = "Workgroup";
$lang['settings_identity_update_hostname_workgroup_label'] = "Update hostname and workgroup";
$lang['settings_identity_easyfind_title'] = "Easyfind options";
$lang['settings_identity_easyfind_message'] = "Use 'Easyfind' to locate your Bubba";
$lang['settings_identity_update_easyfind_label'] = "Update easyfind";

//  ---------- Users  -----
$lang['realname'] = 'Real name';
$lang['username'] = 'User name';
$lang['shell_login'] = 'Shell login';
$lang['allow_ssh'] = 'Allow SSH login';
$lang['allow_remote'] = 'Allow remote access to config interface';
$lang['users_pwd1'] = 'New password';
$lang['users_pwd2'] = 'Verify password';
$lang['illegal'] = 'Illegal characters in password';
$lang["mismatch"]='Password do not match';
$lang["sambafail"]='Failed to update password';
$lang["passwdfail"]=$lang["sambafail"];

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

//  ----------- Filemanager --------

$lang["filemanager-label-name"] = "Name";
$lang["filemanager-title-permissions"] = "Permissions";
$lang["filemanager-label-permission-owner"] = "Owner";
$lang["filemanager-label-permission-owner-read"] = "read";
$lang["filemanager-label-permission-owner-write"] = "write";
$lang["filemanager-label-permission-owner-execute"] = "execute";
$lang["filemanager-label-permission-group"] = "Group";
$lang["filemanager-label-permission-group-read"] = "read";
$lang["filemanager-label-permission-group-write"] = "write";
$lang["filemanager-label-permission-group-execute"] = "execute";
$lang["filemanager-label-permission-other"] = "Other";
$lang["filemanager-label-permission-other-read"] = "read";
$lang["filemanager-label-permission-other-write"] = "write";
$lang["filemanager-label-permission-other-execute"] = "execute";

$lang["filemanager-mkdir-dialog-button-label"] = "Create directory";
$lang["filemanager-mkdir-dialog-title"] = "Create an new directory";

$lang["filemanager-delete-dialog-button-label"] = "Delete";
$lang["filemanager-delete-dialog-title"] = "Delete files and directories";
$lang["filemanager-delete-fail-message"] = "Failed to delete following files and directories: %s";
$lang["filemanager-delete-dialog-message"] = "Are you certain that you want to delete selected files and directories?";
/*  ------------------- Texts to locate help pages.  -------------------*/
//General pages
$lang['help_stat']="";
$lang['help_login']="?page=quickstart.html";
$lang['help_filemanager']="?page=fileserver.html#WEB_BASED";


// Administrator pages
$lang['help_users']="?page=administrator.html#USERS";
$lang['help_services']="?page=administrator.html#SERVICES";
$lang['help_mail']="?page=administrator.html#MAIL";
$lang['help_network']="?page=administrator.html#NETWORK";
$lang['help_wan']="?page=administrator.html#NETWORK_WAN";
$lang['help_lan']="?page=administrator.html#NETWORK_LAN";
$lang['help_other']="?page=administrator.html#NETWORK_identity";
$lang['help_fw']="?page=administrator.html#NETWORK_Firewall";
$lang['help_disk']="?page=administrator.html#DISK";
$lang['help_lvm']="?page=administrator.html#DISK_LVM";
$lang['help_raid']="?page=administrator.html#DISK_RAID";
$lang['help_printing']="?page=administrator.html#PRINTING";
$lang['help_settings']="?page=administrator.html#SETTINGS";
$lang['help_backup']="?page=backup.html";
$lang['help_restore']="?page=backup.html#RESTORE";
$lang['help_trafficsettings']="?page=administrator.html#traffic";
$lang['help_datetime']="?page=administrator.html#dateandtime";
$lang['help_backuprestore']="?page=administrator.html#backuprestore";
$lang['help_software']="?page=sw_upgrade.html";
$lang['help_hotfix']="?page=sw_upgrade.html#hotfix";
$lang['help_logs']="?page=administrator.html#logs";


// User pages
$lang['help_usermail']="?page=users.html#MAIL";
$lang['help_downloads']="?page=users.html#DOWNLOADS";
$lang['help_userinfo']="?page=users.html#USERINFO";
$lang['help_album']="?page=users.html#PHOTOALBUM";


// Help box - Admin
$lang['help_box_stat']="helpme";

$lang['help_box_filemanager']=$lang['help_box_filemanager_cd']="
The Browse page shows files stored on Bubba|Two. Here you are able to reach your files on Bubba|Two if you are away from home.
";

	$lang['help_box_filemanager_backup']="
	<ol>
    <li>Fill in a <strong>job name </strong>for the backup in the text box to the left on the screen and click &quot;Create job&quot;. The new backup job gets automatically highlighted in the &quot;Excising jobs&quot; column.</li>
    <li>Add the <strong>files you want to include</strong> in the backup job by clicking the &quot;Browse&quot; button under the &quot;Included directories&quot; menu. Subdirectories will automatically be included.<br />
    </li>
    <li>If there are files in subdirectories that you want to <strong>exclude</strong>, click the &quot;Browse&quot; button under the &quot;Excluded directories&quot; menu and select the non wanted directories.<br />
    </li>
    <li><strong>Select target </strong>for the backup job by clicking on the drop down menu to the right of &quot;Target&quot;. If the destination directory will be created if it does not exist already.<br />
    </li>
  </ol>
  <ul>
    <li>If choosing local USB / eSATA disk you have to select the disk by pressing the &quot;Disk&quot; drop down list. Fill in the &quot;Destination directory&quot; (i.e. &quot;my_ backup_folder\important\&quot;) or leave it blank for saving backup in the root directory.</li>
    <li>If choosing remote SSH / FTP you have to fill in &quot;Host&quot; (i.e. an IP-address), &quot;Destination directory&quot; (i.e. &quot;my_ backup_folder/important/&quot;) or leave it blank for saving backup in the remote root directory, &quot;Remote user&quot; and &quot;Remote password&quot;.</li>
   </li>
  </ul>
  <ol start='5'>
    <li>Click &quot;<strong>Backup schedule</strong>&quot; to set the time and intensity to run the backup job. Also select how many full backups that should be saved.</li>
    <li>To increase security you have the option to<strong> encrypt the backup job</strong>. Click &quot;Data security&quot;, click &quot;Encrypt data&quot; and select an encryption key.</li>
    <li>Click &quot;Update job&quot; to save the settings.</li>
    <li>To run the job immediately, click &quot;Run now&quot;.</li>
  </ol>
  ";
  
	$lang['help_box_filemanager_restore']=" 
	<ol>
    <li>Select the backup job under &quot;Existing jobs&quot; you need to restore. </li>
    <li>Select the &quot;Backup date&quot; to restore from.</li>
    <li>Select the files or folders (with automatically included files) you need to restore. The files that will be restored will be highlighted in blue.</li>
    <li>Choose in what way you want to restore the files: 'Restore missing files', 'Overwrite files' or 'Restore to directory'.</li>
    <li>Click 'Restore selection'</li>
  </ol>
  ";

$lang['help_box_users']="
<h3>Add user</h3>
  <p><strong>Users</strong> - Here you find all the registered users on your Bubba|Two. Click on 'Edit user' to change user information.</p>
  <p><strong>Add new user</strong> - To add a new user; fill in the information and click 'Add user'.</p>
<h3>Edit user</h3>
  <p><strong>Username</strong> - Changing the user name (login name) is not possible. To achieve this you  will have to delete the user via the administrator login and add a new  user with the correct name.</p>
  <p><strong>Real name</strong> - To add the user's 'Real name'; fill in the information here.</p>
  <p><strong>Allow remote access to config interface</strong> - The default setting is to block remote access (from the WAN port) for the 'admin' account. To be able to administrate your Bubba from outside (Internet) your network choose 'Yes' here.</p>
  <p><strong>Change password</strong> - The administrator can change every users password. Every user has the possibility to change their own password via their own log in. It is strongly suggested that the <strong>admin password is changed</strong> from the default password.</p>
";

$lang['help_box_services']="
<h3>Streaming</h3>
<p><strong>UPnP streaming</strong> -  Universal Plug and Play (UPnP) server. The server shares/streams media data  like audio/video/picture/files to UPnP-clients on the network. Please notice that if  you are located in a unsecure network; disable UPnP because otherwise you are able to  browse the whole file system via Mediatomb's web interface which could be a security risk. </p>
<p><strong>DAAP streaming</strong> -  Digital Audio Access Protocol (DAAP) server. Media server for the Roku SoundBridge and iTunes. </p>
<p><strong>Squeezebox Server </strong>-  is a streaming audio server supported by Logitech that streams music to The Squeezebox product line.</p>
<h3>Mail</h3>
<p><strong>Send and receive</strong> -  This is for postfix the smtp server: Sending and receiving eMails.</p>
<p><strong>Imap (Required for  webmail access)</strong> - This is for dovecot the IMAP server. This service is required  for the webmail access to be functional.</p>
<p><strong>Mail retrieval </strong>- This  is for fetchmail, a daemon that collects eMails to Bubba|Two</p>
<h3>Other</h3>
<p><strong>Printing</strong> - Bubba|Two  print server.</p>
<p><strong>Up and downloads</strong> -  possibility to up / download files on Bubba|Two, i.e. filemanager and torrents.</p>
";

$lang['help_box_mail']=$lang['help_box_mail_viewfetchmail']="
<p>If you set up Bubba|Two to fetch your eMail from other external eMail accounts you may have, they will be stored on Bubba|Two and available via IMAP or web mail, wherever you are. Logged in as administrator you must select to which user the retrieved mail should be directed, this must be done for every retrieved mail account added. Prior to this you must have added a user.</p>
<p><strong>Retrieve mail from individual accounts</strong> - Shows your current accounts for mail retrieval.</p>
<p><strong>Add account</strong> - To fetch mail from an external accout, fill in the information given to you by your mail account provider.</p>
";
	
	$lang['help_box_mail_viewmailsend']="
	<p>If your Internet Service Provider (ISP) blocks outgoing traffic on port 25 you must use an alternative SMTP server than Bubba|Two.</p>
  <p><strong>Sending eMail</strong> - Leave fields empty to let Bubba|Two handle your outgoing eMails. If your ISP blocks your outgoing traffic on port 25, fill in the information provided to you by your ISP.</p>
	";
	$lang['help_box_mail_viewreceivemail']="
	<p>If you have your own domain name it is possible to let  Bubba|Two handle your incoming and outgoing eMail.</p>
	<p><strong>Handle mail for domain</strong> - Enter your domain name here.</p>
	";

$lang['help_box_network']=$lang['help_box_network_profile']="
<p><strong>Automatic network settings</strong> - Bubba|2 will by default automatically identify your network structure. First Bubba|2 tires to locate a DHCP server in your LAN. If no DHCP server is found Bubba|2 will use a fixed  IP address (<a href=\"192.168.10.1\">192.168.10.1</a>) on the LAN port and start a DHCP server to provide other computers in the LAN with network information. If a DHCP server is found in the LAN, Bubba|2 will obtain IP-address automatically on the LAN port. Bubba|Two will also try to retrieve network settings on WAN port (internet). Editing  the WAN and LAN sections is <strong>not</strong> possible in this profile.</p>
<p><strong>Router / Firewall / Server mode </strong>- Bubba|2 will use a fixed  IP address (<a href=\"192.168.10.1\">192.168.10.1</a>) on the LAN port and start a DHCP server to provide other computers in the LAN with network information. Bubba|Two will also try to retrieve network settings on WAN port (internet). It is possible to manually edit the network settings in this profile.</p>
<p><strong>Server mode only</strong> - Bubba will automatically try to retrieve network settings on LAN.  The WAN port should be left unconnected. It is possible to manually edit the network settings in this profile.</p>
<p>After editing the network settings you might need to reboot your computers and other network devices in your LAN.</p>
<p><i>Update</i> saves your changes.</p>
";
	
	$lang['help_box_network_wan']="
	<p>Here you configure how your Bubba|Two will handle your Wide Area Network (WAN) port. The default setting is to Obtain an IP address.</p>
	<p><strong>Obtain IP-address  automatically (DHCP)</strong> - The Dynamic Host Configuration Protocol (DHCP) automates  the assignment of IP address, Netmask, Default gateway, and other IP  parameters. Use this option if your internet provider requires you to use DHCP. This is the default and most common option.</p>
	<p><strong>Use static IP address  settings</strong> - Static IP address, Netmask, Default gateway and Primary DNS are  manually assigned to Bubba|Two by the administrator. Use this option if your internet provider requires you to manually enter the values.</p>
  <p>Please notice that the WAN settings are not editable in the profile 'Automatic network settings', shown for information only.</p>
	<p><i>Update</i> saves your changes.</p>
	";
	
	$lang['help_box_network_lan']="
	<p>Here you configure how you reach your Bubba|Two from computers in your Local Area Network (LAN). Your Bubba|Two has an auto detect function on the LAN port. This means that when connected, Bubba|Two will search the LAN for an DHCP server. If a DHCP server  is found, Bubba|Two will configure itself to obtain an IP address on  the LAN port. If no DHCP server is found, Bubba|Two will fall back to  the static IP address <strong>192.168.10.1</strong>. </p>
	<p><strong>Obtain IP-address automatically</strong> - Use this option if you use another DHCP server than Bubba|Two in your LAN, for example a router or gateway. Bubba|Two will obtain an IP address automatically.</p>
  <p><strong>Use static IP address settings - </strong>Your Bubba|Two will be reached on this static IP address in your LAN. The default fall back IP is : <a href='http://192.168.10.1' target='_blank'>192.168.10.1</a>.</p>
  <ul>
  	<li><strong>Enable DNS service</strong> - The Domain Name System (DNS) translates domain names into IP addresses. When you type in a domain name, the DNS server translates the name into the corresponding IP address. </li>
    <li><strong>Enable DHCP server</strong> - The  DHCP server gives out IP addresses when a device, connected into Bubba|Two's LAN port, is starting up and  requests an IP address. The device must  be set as a DHCP client to &quot;Obtain  IP address automatically&quot;.</li>
    <li><strong>Lease range</strong> - The DHCP address pool  (Lease range) contains the range of the IP address that will automatically be  assigned to the clients (for example computers, media players) on the network.</li>
  </ul>
  <p><strong>Enable Jumbo frames</strong> - This option enables transmissions of larger data chunks on the LAN interface. <strong>WARNING</strong> - this requires that all equipment on the LAN works in this environment. Use with caution. That said, this feature can improve performance on file transfers between Bubba and Gigabit capable devices.</p>
	<p><strong>DHCP leases </strong>- Shows the current network devices in your LAN when having Bubba|Two as your router. If several network devices has the same hostname the last connected will be shown as a *.</p>
	<p>Please notice that the LAN settings are not editable in the profile 'Automatic network settings', shown for information only.</p>
	<p><i>Update</i> saves your changes.</p>
	";
	
	$lang['help_box_network_wlan']="
	<p>Bubba|Two can act as your access point, both in 'Router / Firewall / Server mode' or in 'Server mode'.</p>
	<h3>Wireless</h3>
  <p><strong>Enable wireless</strong> - Select this box to enable the wireless access point in Bubba|Two.</p>
  <p><strong>Network name (SSID</strong>) - This is the name that identifies a particular wireless network. The default name is your Bubba|Twos host name. The SSID can be up to 32 characters long.</p>
  <p><strong>Password</strong> - The password (aka pass phrase) is a set of characters that must be entered exactly the same in both your Bubba|Two and your network clients. Enter the password in ASCII characters. The  length must be between 8 to 63 for WPA and 5 or 13 characters for WEP.</p>
  <h3>Advanced wireless settings</h3>
  <p><strong>Encryption </strong>- Choose between WEP, WPA1 or WPA2. WEP is not recommended due to low security.</p>
  <p><strong>Channel </strong>- Select the channel on your wireless access point in Bubba|Two. In areas with several wireless networks, lower transfer speeds may be experienced. Then try a different channel. Channel availability is different for different countries due to  regulations.</p>
  <p><strong>Broadcast SSID </strong>- Uncheck this box to hide Bubba|Twos SSID. By default the SSID is  broadcasted.</p>
  <p><i>Update</i> saves your changes.</p>
	";
	
	$lang['help_box_network_fw']="
	<p>Bubba has an built in firewall to protect your internal network and Bubba|Two itself.</p>
	<h3><strong>Integrated Bubba services </h3>
  <p><strong>Allow SSH from WAN</strong> - Enables Secure Shell (SSH) to Bubba|Two from WAN.</p>
  <p><strong>Allow WWW from WAN</strong> - Enables WWW traffic to Bubba|Two from WAN.</p>
  <p><strong>Allow FTP from WAN</strong> - Enables FTP connections from WAN to Bubba|Two's port 21.</p>
  <p><strong>Allow Ping from WAN</strong> -   Enables ping from WAN. The default setting disables computers on the Internet to  get a reply back from Bubba|Two when it is being &quot;pinged&quot;. This   increases the security.</p>
	<p><strong>Allow WAN access to mailserver</strong> - Enables access from WWW to Bubba|Two's port 25. This is the default mailserver port for sending and receiving mail.</p>
	<p><strong>Allow WAN access to Mail (IMAP/IMAPS)</strong> - Enables access from WWW to Bubba|Two's ports 143 and 993. These ports are used for sending and receiving mail.</p>
  <p><strong>Open ports for torrent downloader</strong> - Enables faster torrent download. This rule opens the ports 10000-14000.</p>
  <h3>Open port / Add port forward</h3>
	<p>Choose 'Portforward' or 'Bubba|Two public port' with the radio buttons. With 'Portforward' you open a port from a network device in your internal LAN to the Internet (WAN). 'Bubba|Two public port' opens a port from Bubba|Two to the Internet (WAN)</p>
	<p><strong>Source IP</strong> - The source IP on the WAN side that the port forward will be directed to. Enter 'all' if all the port forward are not directed to a specific IP address.</p>
  <p><strong>Public port</strong> - The port number on the WAN side.You can input a single port or a range of  ports (ex. 4001:4005).</p>
  <p><strong>Private port</strong> - The port number on the LAN side. Enter a single start port if range is used in Public port (ex. 4001).</p>
  <p><strong>Private IP</strong> - The destination IP on the LAN side network that will be providing the virtual services (desired port forward).</p>
  <p><strong>Protocol</strong> - The protocol used for the virtual service: TCP or UDP.</p>
  <h3>User defined open / forwarded ports</h3>
	<p>This shows the enabled port forwards. Press the pen symbol to the right of the rule to edit the port forward. Press the red X to the right of the rule to delete the port forward.</p>
  <p><i>Update</i> saves your changes.</p>
	";

$lang['help_box_disk']="
<p>Here you find the status of internal and external disks and storage devices. When a new device is attached you must press 'Connect' to be able to use the device.</p>
<p><strong>Disk information</strong> - Shows disk name, size, disk type and a graphical overview of the partitions.</p>
<p><strong>Partition information</strong> - Description of the partitions.</p>
<p>Pressing the 'Connect' when a new device is inserted means you will have access to the files in your 'storage/extern' catalogue. When you want to unplug the external disk drive / USB memory you must click 'Disconnect' first to ensure that it is safe to unplug the device.</p>
";

	$lang['help_box_disk_lvm']="
	<p>Extend your home partition with an attached external disk. This will create a single logical volume of the internal home partition and a attached disk. In other words, you will experience one big disk instead of two smaller. The total disk size will be the external disk size added to home partition size.</p>
	
	<h3>Warning</h3>
	<p><strong>Please notice that this is an non reversible operation. After your system has been extended together with the external drive, your system will always need to be connected to the external drive - and will not function without it. To be able to use your Bubba|Two standalone again, you will need to reinstall the whole system.</strong></p>
  <p><strong>An old LVM disk will automatically be connected and included into the Bubba|Two system upon boot, even though you have not set up your Bubba|Two for an LVM extension. It is impossible to remove the extension without reinstallation. To format an old external LVM extended disk, connect the disk to a already running Bubba|Two. Then choose 'Format' in the 'Disk -&gt; Information' menu.</strong></p>
		
	<h3>Create Extended disk (LVM)</h3>
	<ol>
  	<li>Attach a  external disk, USB or eSATA. Please notice that the disk should be pre formatted, without old RAID or LVM systems.</li>
  	<li>Select the 'Home partition' and the partition from the external disk (for example /dev/sdb). </li>
  	<li>Click 'Extend partition'.</li>
  	<li>Wait for the progress bar to complete.</li>
  	<li>When finished, your system has been extended together with the external drive.</li>
  </ol>
  <h3>Remove Extended disk (LVM)</h3>
	<p>To remove Extended disk (LVM) from your system you need to reinstall the whole system.</p>
	";
	
	$lang['help_box_disk_raid']="
	<p>The RAID function in Bubba|Two combines the /home partition and one external hard disk into a single logical unit.</p>
	
	<h3>Important</h3>
	<ul>
		<li><strong>Warning!</strong> The process will destroy all user data - both on the internal and external disk.</li>
		<li>An old RAID disk will automatically be connected and included into the Bubba|Two system upon boot, even though you have not set up your Bubba|Two for a RAID extension. It is impossible to remove the extension without reinstallation. To format an old external RAID extended disk, connect the disk to a already running Bubba|Two. Then choose 'Format' in the 'Disk -&gt; Information' menu.</li>
  	<li>To get out the most of your disks, use an external disk in the same size as your internal disk in Bubba|Two.</li>
  	<li>Total capacity of the array equals the capacity of the smallest disk in the array.</li>
  	<li>It will take some time to create or restore a RAID array. For a 1TB disk it will take about 4 hours. This is handheld in the background of the Bubba|Two system and will not be indicated to the user.</li>
  	<li>To reuse your Bubba|Two standalone without the RAID setup you have to reinstall your Bubba|Two system.</li>
  </ul>
  
  <h3>Create RAID array</h3>
	<ol>
  	<li>Attach an eSATA disk. Please notice that the disk should be pre formatted, without old RAID or LVM systems.</li>
  	<li>Click 'Create RAID array'</li>
  	<li>Select which external disk to include in the array.</li>
  	<li>Warning! All data on both disks will be erased. Click 'Create RAID'.</li>
  	<li>Wait for the progress bar to complete. Be patient, it will take some time to create a RAID array if you are using large disks.</li>
  	<li>When finished, your external disk has been included in your RAID  array.</li>
  </ol>
  
  <h3>RAID status</h3>
	<p><strong>List of RAID arrays</strong> - shows the total disk space, i.e. the smallest available disk (the Bubba|Two /home partition or the external eSATA disk) in the array.</p>
  <p><strong>List of RAID disks</strong> - shows the disks attached to the RAID system.</p>

	<h3>Recover an external disk</h3>
	<p>If you have a disc failure or if you have by mistake disconnected the external disk you will need to do the following.</p>
	<ol>
  	<li>Delete the external disc from the 'List of RAID disks' by clicking 'Remove'.</li>
    <li>Disconnect the external disk from the backside of Bubba|Two.</li>
    <li>Attach a new external disk.</li>
    <li>Click &quot;Recover RAID array&quot;.</li>
    <li>Select which external disk to add to RAID array. Click 'Recover array'.</li>
    <li>Warning! All data will be erased from the external disk. Click 'Recover array'.</li>
    <li>Press 'Close' to continue working with Bubba|Two. The synchronization is in progress.</li>
  </ol>
  
  ";

$lang['help_box_printing']="helpme";

$lang['help_box_settings']=$lang['help_box_settings_startwizard']="helpme";
	$lang['help_box_settings_trafficsettings']="helpme";
	$lang['help_box_settings_identity']="helpme";
	$lang['help_box_settings_datetime']="helpme";
	$lang['help_box_settings_backuprestore']="helpme";
	$lang['help_box_settings_software']="helpme";
	$lang['help_box_settings_logs']="helpme";
	

// Help box - User
$lang['help_box_usermail']="helpme";

$lang['help_box_downloads']="helpme";

$lang['help_box_userinfo']="helpme";

$lang['help_box_album_albums']="helpme";
$lang['help_box_album_users']="helpme";

