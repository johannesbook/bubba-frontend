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
//
$lang['title_']=$lang['Home'];
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
//
//texts to locate help pages.
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

$lang['disk_action_title_idle'] = "Recovering RAID array";

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
?>
