<?php
// $lang['']="";

$lang["name"] = NAME;

$lang['Login']="Anmelden";
$lang['Home']="Home";
$lang['Users']="Benutzer";
$lang['Services']="Dienste";
$lang['Mail']="E-Mail";
$lang['Network']="Netzwerk";
$lang['Printing']="Drucken";
$lang['Settings']="Einstellungen";
$lang['Filemanager']="Dateimanager";
$lang['Album']="Fotoalbum";
$lang['Stat']="Home";
$lang['Downloads']="Downloads";
$lang['Disk']="Datenträger";
$lang['Userinfo']="Benutzer-Info";
$lang['Shutdown']="Herunterfahren bestätigen";

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

$lang['topnav-settings'] = "Verwaltung";
$lang['topnav-help'] = "Hilfe";
$lang['topnav-home'] = "Home";
$lang['topnav-logout'] = "Abmelden";


/* 'Elevated' sub navigation */
$lang['title_usersettings-info'] = "Benutzerinformation";
$lang['title_usersettings-mail'] = "E-Mail";
$lang['title_albums'] = "Albummanager";
$lang['title_album-users'] = "Album-Viewer";


/* Sub navigation categories  */
$lang['title_filemanager-browse']="Durchsuchen";
$lang['title_filemanager-backup']="Sicherung";
$lang['title_filemanager-restore']="Wiederherstellen";
$lang['title_mail-retrieve']="E-Mail abrufen";
$lang['title_mail-server_settings']="Server-Einstellungen";
$lang['title_network-profile']="Profil";
$lang['title_network-lan']="LAN";
$lang['title_network-wan']="WAN";
$lang['title_network-wlan']="Wireless";
$lang['title_network-firewall']="Firewall";
$lang['title_disk-info']="Datenträger-Information";
$lang['title_disk-lvm']="LVM";
$lang['title_disk-raid']="RAID";
$lang['title_settings-wizard']="Setup-Assistent";
$lang['title_settings-identity']="Identität";
$lang['title_settings-traffic']="Torrent-Einschränkung";
$lang['title_settings-date']="Datum und Sprache";
$lang['title_settings-sysbackup']="Sicherungseinstellungen";
$lang['title_settings-update']="Softwareupdate";
$lang['title_settings-logs']="Protokolle";
$lang['title_photo-albums']="Fotoalben";

/* Sidebar date and time */

$lang['Monday']='Montag';
$lang['Tuesday']='Dienstag';
$lang['Wednesday']='Mittwoch';
$lang['Thursday']='Donnerstag';
$lang['Friday']='Freitag';
$lang['Saturday']='Samstag';
$lang['Sunday']='Sonntag';

$lang['January'] = "Januar";
$lang['February']='Februar';
$lang['March']='März';
$lang['April']='April';
$lang['May']='Mai';
$lang['June']='Juni';
$lang['July']='Juli';
$lang['August']='August';
$lang['September']='September';
$lang['October']='Oktober';
$lang['November']='November';
$lang['December']='Dezember';



/* Generic button labels and texts */

$lang['button_label_continue']='Fortfahren';
$lang['button_label_delete']='Löschen';
$lang['button_label_cancel']='Abbrechen';
$lang['button-label-cancel']='Abbrechen'; // TODO FIXME
$lang['generic_dialog_text_please_wait'] = "Bitte warten...";
$lang['generic_dialog_text_warning'] = "Warnung";
$lang['generic-permission-denied'] = "Erlaubnis abgelehnt";

/* Login texts  */
$lang["topnav-authorized"] = "Angemeldet als '%s'";
$lang["topnav-not-authorized"] = "Nicht angemeldet in";
$lang["login-dialog-header"] = "Anmeldung benötigt";
$lang["login-dialog-username"] = "Benutzername";
$lang["login-dialog-password"] = "Passwort";
$lang["login-dialog-cancel"] = "Abbrechen";
$lang['login-error-grantaccess'] = "Zugang für Benutzer '%s' nicht erteilt.";
$lang['login-error-wanaccess'] = "Admin-Benutzer darf sich nicht über der WAN-Interface anmelden.";
$lang['login-error-wanaccess-quickstart'] = "Bitte die Benutzeranleitung für Hinweise lesen.";
$lang['login-error-noaccess'] = "Benutzer darf nicht in der Web-Admin anmelden.";
$lang['login-error-pwd'] = "Ungültige Benutzer/Kennwort-Kombination.";

/* Menu bar texts */

$lang['menubar-link-pim'] = "Webmail";
$lang['menubar-link-music'] = "Musik";
$lang['menubar-link-album'] = "Fotos";
$lang['menubar-link-usersettings'] = "Benutzereinstellungen";
$lang['menubar-link-filemanager'] = "Dateimanager";
$lang['menubar-link-backup'] = "Dateisicherung";
$lang['menubar-link-systemsettings'] = "Systemeinstellungen";
$lang['menubar-link-downloads'] = "Downloads";


// backup field translations
$lang['current_job'] = "Auftragsname";
$lang['target_protocol'] = "Ziel";

// disk
$lang['disk_action_title_extend_lvm'] = 'Speicherplatz des Benutzers erweitern';
$lang['disk_action_title_create_raid'] = 'System auf RAID konvertieren';
$lang['disk_action_title_restore_raid'] = 'RAID wiederherstellen';
$lang['disk_action_title_format'] = 'Festplatte formattieren';
$lang['in_sync'] = 'Synchronisiert';
$lang['faulty'] = 'Festplattenfehler';
$lang['active'] = 'Aktiv';
$lang['clean'] = 'Sauber';

$lang['disk_format_title'] = "Festplatte formattieren";
$lang['disk_format_error_mounts_exists_message'] = "Datenträger scheinen bereitgestellt zu sein. Diese bitte freigeben und erneut versuchen.";
$lang['disk_format_message'] = "Bitte spezifizieren Sie das Etikett für Ihre neue Partition.";
$lang['disk_format_format_button_label'] = "Festplatte formattieren";
$lang['disk_format_label_label'] = "Etikett";
$lang['disk_format_warning_1'] = "Das Formattieren der Festplatte wird sämtliche Daten auf dem Datenträger zerstören";
$lang['disk_format_warning_2'] = "Mit dem Formattieren der Festplatte fortfahren?";
$lang['disk_format_format_progress_title'] = "Festplatte formattieren";
$lang['disk_format'] = "";

$lang['disk_lvm_extend_dialog_warning_message'] = "<p>Hierdurch werden sämtliche Daten auf dem neuen, externen Gerät gelöscht. Klicken Sie auf 'LVM erstellen', um fortzufahren.</p> <p>Anmerkung: Das Entfernen der neuen Festplatte aus dem System wird eine komplette Neuinstallation des Systems notwendig machen.</p>";
$lang['disk_lvm_extend_dialog_warning_title'] = "Logical Volume erweitern";
$lang['disk_lvm_extend_dialog_warning_button_label'] = "LVM erstellen";
$lang['disk_lvm_extend_dialog_title'] = "Festplatte erweitern";

/* RAID */
$lang['disk-examine-disks'] = "Vorhandene Festplatten untersuchen";
$lang['disk_raid_setup_title'] = "RAID-Array einrichten";
$lang['disk_raid_create_label'] = "RAID-Array erstellen";
$lang['disk_raid_create_message'] = "Die interne Festplatte und eine externe Festplatte in eine RAID-Spiegelungslösung (RAID 1) einrichten";
$lang['disk_raid_recover_label'] = "RAID-Array wiederherstellen";
$lang['disk_raid_recover_message'] = "Interne Festplatte wiederherstellen oder eine neue externe Festplatte an eine vorhandene RAID-Array hinzufügen";
$lang['disk_raid_status_title'] = "RAID-Status";
$lang['disk_raid_degraded_recover_status_message'] = "RAID-Array '%s' wiederherstellen";
$lang['disk_raid_degraded_recover_status_message_eta_hours'] = "Der aktuelle Wiederherstellungsfortschritt ist %d%% und wird in schätzungsweise %d Stunden %d Minuten abgeschlossen sein";
$lang['disk_raid_degraded_recover_status_message_eta_minutes'] = "Der aktuelle Wiederherstellungsfortschritt ist %d%% und wird in schätzungsweise %d Minuten abgeschlossen sein";
$lang['disk_raid_degraded_message'] = "RAID-Array ist degradiert";
$lang['disk_raid_degraded_missing_disk_message'] = "Festplatte fehlt in der RAID-Array '%s'";
$lang['disk_raid_external_failure_title'] = "Fehler: Externe Festplatte hat versagt";
$lang['disk_raid_external_failure_message_1'] = "Die externe RAID-Festplatte (<strong>%s</strong>) in der RAID-Array hat versagt";
$lang['disk_raid_external_failure_message_2'] = "Die Festplatte bitte ersetzen (ebenfalls unten \"Entfernen\" drücken, um das Entfernen des Datenträgers zu bestätigen)";
$lang['disk_raid_external_failure_message_3'] = "Wenn die Festplatte ersetzt wurde, \"RAID-Array wiederherstellen\" drücken, um den neuen Datenträger zur Array hinzuzufügen";
$lang['disk_raid_normal_op_message'] = "Normaler Betrieb";
$lang['disk_raid_not_activated_message'] = "RAID nicht aktiviert";
$lang['disk_raid_detailed_info_title'] = "Detaillierte Informationen";
$lang['disk_raid_list_of_arrays_title'] = "Liste von RAID-Arrays";
$lang['disk_raid_table_list_of_arrays_array_name_title'] = "Array-Name";
$lang['disk_raid_table_list_of_arrays_level_title'] = "Ebene";
$lang['disk_raid_table_list_of_arrays_state_title'] = "Zustand";
$lang['disk_raid_table_list_of_arrays_label_title'] = "Etikett";
$lang['disk_raid_table_list_of_arrays_size_title'] = "Größe";
$lang['disk_raid_list_of_disks_title'] = "Liste von RAID-Festplatten";
$lang['disk_raid_table_list_of_disks_disk_title'] = "Festplatte";
$lang['disk_raid_table_list_of_disks_parent_title'] = "Übergeordnet";
$lang['disk_raid_table_list_of_disks_state_title'] = "Zustand";
$lang['disk_raid_table_list_of_disks_size_title'] = "Größe";
$lang['disk_raid_disk_faulty_remove_button_label'] = "Entfernen";

# Create
$lang['disk_raid_create_progress_title'] = "RAID-Array wird wiederherstellt";
$lang['disk_raid_create_title'] = "RAID-Array erstellen";
$lang['disk_raid_create_error_mounts_exists_message'] = "Datenträger scheinen bereitgestellt zu sein. Diese bitte freigeben und erneut versuchen.";
$lang['disk_raid_create_select_disk_message'] = "Wählen Sie bitte welche externe Festplatte in der Array inbegriffen werden soll. Eine externe Festplatte mit der gleichen Größe wird empfohlen";
$lang['disk_raid_create_warning_1'] = "Die Erstellung der RAID-Array wird <strong>sämtliche Daten</strong> auf Ihrer internen Festplatte <strong>zerstören</strong> (/home - einschließlich 'storage') und die ausgewählte externe Festplatte löschen";
$lang['disk_raid_create_warning_2'] = "Bitte stellen Sie sicher, dass Sie eine Sicherungskopie aller Dateien haben";
$lang['disk_raid_create_warning_3'] = "Mit der Erstellung von RAID fortfahren?";
$lang['disk_raid_create_error_no_disks_found_message'] = "Keine geeignete Festplatte gefunden";
$lang['disk_raid_create_button_label'] = "RAID erstellen";
$lang['disk_raid_nodisk_label_cancel'] = "Schließen";
# Recover
$lang['disk_raid_recover_title'] = "RAID-Array wiederherstellen";
$lang['disk_raid_recover_broken_external_progress_title'] = "Die externe Festplatte in der RAID-Array wird wiederhergestellt";
$lang['disk_raid_recover_broken_external_message'] = "Externe Festplatte auswählen, die zur RAID-Array hinzugefügt werden soll";
$lang['disk_raid_recover_broken_external_warning_1'] = "Wiederherstellung der RAID-Array wird <strong>sämtliche Daten</strong> auf der ausgewählten externen Festplatte <strong>zerstören</strong>";
$lang['disk_raid_recover_broken_external_warning_2'] = "Mit der Wiederherstellung von RAID fortfahren?";
$lang['disk_raid_recover_broken_external_button_label'] = "Festplatte zur RAID-Array hinzufügen";
$lang['disk_raid_recover_broken_external_no_disks_message'] = "Es sind keine geeigneten externen Festplatten angeschlossen. Bitte schließen Sie eine externe e-SATA Festplatte an und versuchen Sie es erneut";
$lang['disk_raid_recover_broken_internal_progress_title'] = "Die interne Festplatte in der RAID-Array wird wiederhergestellt";
$lang['disk_raid_recover_broken_internal_mount_exists_message'] = "Datenträger scheinen bereitgestellt zu sein. Diese bitte freigeben und erneut versuchen.";
$lang['disk_raid_recover_broken_internal_message'] = "Wählen Sie die externe Festplatte aus, von der die RAID-Daten wiederhergestellt werden sollen";
$lang['disk_raid_recover_broken_internal_button_label'] = "Interne Festplatte wiederherstellen";
$lang['disk_raid_recover_broken_internal_warning_1'] = "Die Wiederherstellung der RAID-Array wird <strong>sämtliche Daten</strong> auf Ihrer internen Festplatte <strong>zerstören</strong> (/home - einschließlich 'storage')";
$lang['disk_raid_recover_broken_internal_warning_2'] = "Mit der Wiederherstellung von RAID fortfahren?";
$lang['disk_raid_recover_broken_internal_button_label'] = "Interne Festplatte wiederherstellen";
$lang['disk_raid_recover_broken_internal_no_raid_message'] = "Keine Festplatten mit RAID-Daten gefunden";

// Network

$lang['network-settings-locked-1'] = "Diese Einstellungen sind gesperrt";
$lang['network-settings-locked-2'] = NAME." is using automatic network settings";
$lang['network-settings-locked-3'] = "Zum Entsperren das Router- oder Server-Profil auswählen unter ";

$lang['network-firewall-openport'] = "".NAME." Port öffnen";

$lang['wlan_title'] = 'Wireless';
$lang['wlan_title_ssid'] = 'Netzwerkname (SSID)';
$lang['wlan_title_ssid_popup'] = 'Der Netzwerkname (auch als SSID bezeichnet) wird von '.NAME.' gesendet und wird auf Clients angezeigt, wenn wireless Netzwerke durchsucht werden.';
$lang['wlan_title_enable'] = 'Wireless Zugriffspunkt';
$lang['wlan_title_enable_popup'] = 'Aktivieren Sie dieses Kontrollkästchen, um die wireless Funktion für Ihren '.NAME.' zu aktivieren';

$lang['wlan_title_advanced'] = 'Erweiterte Wireless-Einstellungen';

$lang['wlan_title_band'] = 'Band';
$lang['wlan_title_band_1'] = '2,4 GHz Band wird von 802.11g verwendet';
$lang['wlan_title_band_2'] = '5 GHz Band wird von 802.11a verwendet';

$lang['wlan_title_mode'] = 'Modus';
$lang['wlan_title_mode_popup'] = 'Der Betriebsmodus für das ausgewählte Band';
$lang['wlan_title_legacy_mode_2'] = 'Legacy-Modus (802.11a)';
$lang['wlan_title_legacy_mode_1'] = 'Legacy-Modus (802.11g)';
$lang['wlan_title_mixed_mode_2'] = 'Gemischter Modus (802.11n + 802.11a)';
$lang['wlan_title_mixed_mode_1'] = 'Gemischter Modus (802.11n + 802.11g)';
$lang['wlan_title_greenfield_mode'] = 'Ausschließlich N-Modus (ausschließlich 802.11n)';

$lang['wlan_title_encryption'] = 'Verschlüsselung';
$lang['wlan_title_encryption_popup'] = 'Die Verschlüsselung, die zu verwenden ist';
$lang['wlan_title_encryption_wpa2'] = 'WPA2';
$lang['wlan_title_encryption_wpa12'] = 'WPA1 oder WPA2';
$lang['wlan_title_encryption_wpa1'] = 'WPA1';
$lang['wlan_title_encryption_wep'] = 'WEP';
$lang['wlan_title_encryption_none'] = 'Keine';

$lang['wlan_title_width'] = 'Kanalbreite';
$lang['wlan_title_width_popup'] = 'Die gezielte Breite des Kanals in MHz';
$lang['wlan_title_width_20MHz'] = '20 MHz';
$lang['wlan_title_width_40MHz'] = '40 MHz';

$lang['wlan_title_password'] = 'Kennwort';
$lang['wlan_title_password_popup'] = 'Das Kennwort, das für die wireless Verbindung zu '.NAME.' benötigt wird';

$lang['wlan_title_channel'] = 'Kanal';
$lang['wlan_title_channel_popup'] = 'Der Hauptkanal, der zu verwenden ist';

$lang['wlan_title_broadcast'] = 'Übertragung SSID';
$lang['wlan_title_broadcast_popup'] = 'Das Ausschalten dieser Option verbirgt das Netzwerk - Benutzer müssen den SSID auf Clients manuell eingeben';

$lang['fw_title_advanced'] = 'Erweiterte Firewall-Einstellungen';


# Printing
$lang['printing_add_error_invalid_characters'] = "Ungültige Zeichen im Freigabename, nur <strong>A-Z</strong>, <strong>a-z</strong> und <strong>_</strong> sind erlaubt";
$lang['printing_add_error_no_name'] = "Es wurde kein Name eingegeben";
$lang['printing_add_error_no_printer_name'] = "Es wurde kein Druckername eingegeben";
$lang['printing_add_error_no_printer_path'] = "Es wurde kein Druckerpfad eingegeben";
$lang['printing_add_operation_fail'] = "Hinzufügen des Druckers fehlgeschlagen";
$lang['printing_add_success'] = "Drucker <strong>%s</strong> wurde erfolgreich hinzugefügt";
$lang['printing_delete_success'] = "Drucker <strong>%s</strong> wurde erfolgreich gelöscht";

# Services
$lang['service_update_success'] = "Dienste aktualisiert";

# Settings
$lang['settings-start-wizard'] = "Drücken Sie die Taste zum Start des Setup-Assistenten, um die Grundfunktion von ".NAME." zu konfigurieren.";

$lang['settings_traffic_success'] = "Datenverkehrsgrenze aktualisiert";
$lang['settings_traffic_error_service_unavailable'] = "Datenverkehrsdienst nicht verfügbar";
$lang['settings_traffic_error_set_dl_throttle'] = "Einstellung der Downloadeinschränkung fehlgeschlagen";
$lang['settings_traffic_error_set_ul_throttle'] = "Einstellung der Uploadeinschränkung fehlgeschlagen";

$lang['settings_backup_error_no_path'] = "Einstellung des Bereitstellungspunktes für die Sicherung fehlgeschlagen";
$lang['settings_backup_error_failed'] = "Das System konnte keine Sicherung erstellen";
$lang['settings_backup_success'] = "Systemeinstellungen für die Sicherung wurden erfolgreich erstellt";

$lang['settings_restore_error_no_path'] = "Einstellung des Bereitstellungspunktes für die Wiederherstellung fehlgeschlagen";
$lang['settings_restore_error_failed'] = "Das System konnte das System nicht von einer Sicherung wiederherstellen";
$lang['settings_restore_success'] = "Systemeinstellungen wurden erfolgreich wiederhergestellt";

$lang['settings_datetime_success'] = "Zeitzone, Datum und/oder Uhrzeit wurde erfolgreich aktualisiert";
$lang['settings_datetime_error_set_timezone'] = "Einstellung der Zeitzone <strong>%s</strong> fehlgeschlagen";
$lang['settings_datetime_error_set_date_time'] = "Einstellung des Datums <strong>%s</strong> und der Uhrzeit <strong>%s</strong> fehlgeschlagen";
$lang['settings-default-lang'] = "Systemsprache";
$lang['settings-default-lang-header'] = "Globale Spracheinstellung";
$lang['settings_defaultlang_success'] = "Systemsprache aktualisiert";

$lang['settings_software_install_package'] = "%s installieren";
$lang['settings_software_update_software'] = "Softwareupdate";
$lang['settings_software_update_system'] = "System aktualisieren";
$lang['settings_software_include_hotfixes'] = "Hotfixes und systemspezifische Updates einschließen";
$lang['help_hotfix']="?page=sw_upgrade.html#hotfix";


$lang['settings_identity_error_change_hostname'] = "Änderung des Hostnamens ist fehlgeschlagen";
$lang['settings_identity_error_invalid_hostname'] = "Hostname <strong>%s</strong> ist ungültig. Nur die Zeichen <strong>A-Za-z0-9-</strong> sind gültig";
$lang['settings_identity_easyfind_error_fail_set_name'] = "Einstellung des Easyfind-Namens <strong>%s</strong> fehlgeschlagen; dieser Name wird wahrscheinlich bereits verwendet. Versuchen Sie bitte einen anderen Namen";
$lang['settings_identity_easyfind_error_invalid_name'] = "Easyfind-Name <strong>%s</strong> ist ungültig. Nur die Zeichen <strong>A-Za-z0-9-</strong> sind gültig";
$lang['settings_identity_easyfind_error_fail_enable'] = "Easyfind konnte nicht aktiviert werden";
$lang['settings_identity_easyfind_error_fail_disable'] = "Easyfind konnte nicht deaktiviert werden";
$lang['settings_identity_title'] = "System-Identität";
$lang['settings_identity_hostname_label'] = "Hostname";
$lang['settings_identity_workgroup_label'] = "Arbeitsgruppe";
$lang['settings_identity_update_hostname_workgroup_label'] = "Hostname und Arbeitsgruppe aktualisieren";
$lang['settings_identity_easyfind_title'] = "Easyfind-Optionen";
$lang['settings_identity_easyfind_message'] = "'Easyfind' Suchdienst";
$lang['settings_identity_update_easyfind_label'] = "Easyfind aktualisieren";

//  ---------- Users  -----
$lang['users-list-edit-realname-label'] = 'Echter Name';
$lang['users-list-edit-username-label'] = 'Benutzername';
$lang['users-list-edit-shell-label'] = 'Shell-Anmeldung';
$lang['users-list-edit-remote-label'] = 'Remotezugriff auf Systemeinstellungen erlauben';
$lang['users-list-edit-password1-label'] = 'Neues Kennwort';
$lang['users-list-edit-password2-label'] = 'Kennwort bestätigen';
$lang['users-list-edit-sideboard-label'] = 'Sideboard für Benutzer anzeigen, die nicht angemeldet sind';

$lang['users-title'] = 'Benutzer';
$lang['user-users-title'] = 'Benutzerinformation';
$lang['users-label-username'] = 'Benutzername';
$lang['users-label-realname'] = 'Echter Name';
$lang['users-label-shell-login'] = 'Shell-Anmeldung erlauben';
$lang['users-add-button-label'] = 'Neuen Benutzer hinzufügen';
$lang['users-edit-account-error'] = 'Bearbeitung des Kontos für %s (%3$s) Shell: %2$s fehlgeschlagen';

$lang['illegal'] = 'Ungültige Zeichen im Kennwort';
$lang["mismatch"]='Kennwörter stimmen nicht überein';
$lang["sambafail"]='Aktualisierung des Kennwortes fehlgeschlagen';
$lang["passwdfail"]=$lang["sambafail"];
$lang["user_update_error_auth_fail"] = "Autorisierung fehlgeschlagen";
$lang["user_update_error"] = "Bei der Aktualisierung der Benutzerinformation ist ein Fehler aufgetreten";
$lang["user_update_ok"] = "Die Benutzerinformation wurde aktualisiert";

$lang["usr_caseerr"] = "Im Benutzernamen dürfen keine Großbuchstaben verwendet werden";
$lang["usr_existerr"] = "Benutzer ist bereits vorhanden oder ist ein Administratorkonto";
$lang["usr_nonameerr"] = "Es ist kein Benutzername eingegeben worden";
$lang["usr_spacerr"] = "Leerstellen sind im Benutzernamen nicht erlaubt";
$lang["pwd_charerr"] = "Ungültige Zeichen im Kennwort";
$lang["usr_charerr"] = "Ungültige Zeichen im Benutzernamen";
$lang["usr_longerr"] = "Benutzername ist zu lang. Höchstens 32 Zeichen";
$lang["usr_createerr"] = "Bei der Erstellung des Benutzers ist ein Fehler aufgetreten";
$lang["usr_addok"] = "Benutzer wurde hinzugefügt";
$lang["pwd_mismatcherr"] = "Kennwörter stimmen nicht überein oder das Kennwort wurde leer gelassen";

//  ---------- Admin Mail-----
$lang["usrinvalid"] = "Nicht berechtigt für den ausgewählten Benutzer Konten hinzuzufügen.";
$lang["infoincomp"] = "Die Kontoinformation ist unvollständig. Konto wurde nicht hinzugefügt.";
$lang["mail_addok"] = "Konto wurde hinzugefügt.";
$lang["mail_err_usrinvalid"] = "Benutzer ist nicht berechtigt das Konto zu aktualisieren";
$lang["mail_editok"] = "Konto wurde aktualisiert.";
$lang["mail_delete_account_ok"] ="Konto wurde gelöscht";
$lang["mail-server-domaincontroller"] ="E-Mail-Domäne";
$lan['mail_server_userpwdmissing'] = "Kennwort des E-Mail-Servers fehlt";

//  ----------- Filemanager --------

$lang["Date"] = "Datum";

$lang["filemanager-label-name"] = "Name";
$lang["filemanager-title-permissions"] = "Berechtigungen";
$lang["filemanager-label-permission-owner"] = "Eigentümer";
$lang["filemanager-label-permission-owner-read"] = "lesen";
$lang["filemanager-label-permission-owner-write"] = "schreiben";
$lang["filemanager-label-permission-owner-execute"] = "ausführen";
$lang["filemanager-label-permission-group"] = NAME." users";
$lang["filemanager-label-permission-group-read"] = "lesen";
$lang["filemanager-label-permission-group-write"] = "schreiben";
$lang["filemanager-label-permission-group-execute"] = "ausführen";
$lang["filemanager-label-permission-other"] = "Nicht angemeldet in";
$lang["filemanager-label-permission-other-read"] = "lesen";
$lang["filemanager-label-permission-other-write"] = "schreiben";
$lang["filemanager-label-permission-other-execute"] = "ausführen";

$lang["filemanager-mkdir-dialog-button-label"] = "Ordner erstellen";
$lang["filemanager-mkdir-dialog-title"] = "Einen neuen Ordner erstellen";
$lang["filemanager-delete-dialog-button-label"] = "Löschen";
$lang["filemanager-delete-dialog-title"] = "Dateien und Ordner löschen";
$lang["filemanager-delete-fail-message"] = "Das Löschen der folgenden Dateien/Ordner ist fehlgeschlagen: %s";
$lang["filemanager-delete-dialog-message"] = "Die ausgewählten Dateien und/oder Ordner löschen?";
$lang["filemanager-rename-dialog-title"] = "Umbenennen";
$lang["filemanager-permission-dialog-title"] = "Berechtigungen ändern";
$lang["filemanager-perm-dialog-button-label"] = "Berechtigungen ändern";

$lang['filemanager_mkdir_error_nodir'] = "Bei der Erstellung des Ordners ist ein Fehler aufgetreten, es wurde kein Name angegeben";
$lang['filemanager_mkdir_error_file_exists'] = "Bei der Erstellung des Ordners ist ein Fehler aufgetreten, der Name wird bereits verwendet";
$lang['filemanager_mkdir_error_create'] = "Erstellung des Ordners ist fehlgeschlagen";
$lang['filemanager-rename-error'] = "Bei der Umbenennung der Datei '%s' ist ein Fehler aufgetreten";
$lang["filemanager-copy-fail-message"] = "Beim Kopieren der folgenden Dateien und Ordner ist ein Fehler aufgetreten: %s";
$lang["filemanager-move-fail-message"] = "Beim Verschieben der folgenden Dateien und Ordner ist ein Fehler aufgetreten: %s";
$lang["filemanager-perm-fail-message"] = "Bei der Änderung der Berechtigung für die folgenden Dateien und Ordner ist ein Fehler aufgetreten: %s";
$lang["filemanager-album-dialog-message"] = "Ausgewählte Bilder/Ordner an das Fotoalbum hinzufügen?";

$lang["help_box_header"] = NAME." Help";

//  ----------- Mail --------

$lang["mail-retrieve-edit-host-label"] = "Host";
$lang["mail-retrieve-edit-protocol-label"] = "Protokoll";
$lang["mail-retrieve-edit-ruser-label"] = "Remote-Benutzer";
$lang["mail-retrieve-edit-password-label"] = "Kennwort";
$lang["mail-retrieve-edit-luser-label"] = "Lokaler Benutzer";
$lang["mail-retrieve-edit-usessl-label"] = "Verschlüsselung verwenden";
$lang["mail-retrieve-edit-keep-label"] = "Kopie der E-Mail auf dem Server lassen";
$lang["mail-retrieve-add-button-label"] = "Neues E-Mail-Konto hinzufügen";
$lang["mail-validation-error"] = "Prüfung des Eingangs fehlgeschlagen";
$lang["mail-auth-error"] = "Autorisierung fehlgeschlagen";
$lang["mail-retrieve-title"] = "E-Mail abrufen";
$lang["mail-server-title"] = "E-Mail-Server";
$lang["SSL"] = "Verschlüsselt";

//  ----------- Printing --------

$lang["printing-add-button-label"] = "Neuen Drucker hinzufügen";
$lang["printing-title"] = "Drucker";
$lang["printing-label-share"] = "Name";
$lang["printing-label-info"] = "Beschreibung";
$lang["printing-label-location"] = "Tatsächlicher Standort";
$lang["printing-label-state"] = "Zustand";
$lang["printing-list-edit-printer-label"] = "Drucker";
$lang["printing-list-edit-name-label"] = "Name";
$lang["printing-list-edit-location-label"] = "Tatsächlicher Standort";
$lang["printing-list-edit-info-label"] = "Beschreibung";

//  ----------- Stat --------

$lang["stat-shutdown-label"] = "Herunterfahren";
$lang["stat-reboot-label"] = "Neustart";

// ----------- Shutdown view --------
$lang["shutdown-shutdown-label"] = "Herunterfahren von ".NAME;
$lang["shutdown-restart-label"] = "Zum Neustart von ".NAME.", die Einschalttaste drücken";
$lang["shutdown-restarting"] = "Neustart von ".NAME;
$lang["shutdown-LED-stopflash"] = "Wenn die LED aufhört zu blinken, ist ".NAME." wieder für die Verwendung bereit";

//  ---------- Album  -----
$lang['album-users-edit-username-label'] = 'Viewer-Name';
$lang['album-users-edit-password1-label'] = 'Neues Kennwort';
$lang['album-users-edit-password2-label'] = 'Kennwort bestätigen';

// ------------------ Wizard -------------
$lang["wizard-title-lang"]="Schritt 1/4: System sprache";
$lang["wizard-title-datetime"]="Schritt 2/4: Datum und Uhrzeit";
$lang["wizard-title-users"]="Schritt 3/4: Benutzer erstellen";
$lang["wizard-title-network"]="Schritt 4/4: Netzwerk-Setup";

$lang['network-wizard-enjoy'] = 'Viel Spaß mit Ihrem ' . NAME;
$lang['network-wizard-easyfind'] = "Verwenden Sie den 'Easyfind' Suchdienst, um ".NAME." über das Internet zu finden";
$lang['network-firewall-allow-wan'] = "Externen (WAN) Zugriff auf ".NAME." Dienste erlauben";

$lang['wizard-title'] = "Willkommen zu ".NAME;
$lang['wizard-msg1'] = "Bitte nehmen Sie einen Moment, um die Basisfunktion für ".NAME. "einzurichten";
$lang['wizard-msg1'] = "Alle eingegebenen Werte können später mithilfe der Verwaltungs-Interface einfach geändert werden.";

//  ---------- First page  -----

$lang['For more information'] = "Weitere Informationen";
$lang['Support'] = "Support";
$lang['Contact'] = "Kontakt";
$lang['Manual'] = "Handbuch";


$lang['Unable to update IP on server.']="IP wurde vom Server nicht akzeptiert";
$lang['Unable to set name on server.']="Der Name wurde vom Server nicht akzeptiert";
$lang['Name not available.']="Der Name ist nicht verfügbar";
$lang["Unable to disable 'easyfind' service."]="EasyFind Service kann nicht abgeschaltet warden";
$lang['Name is not valid.']="Der Name ist nicht gültig";
$lang['Unable to change name on server.']="Der Name konnte auf dem Server nicht geändert warden";
$lang['Unable to get record data from server.']="Unable to get record data from server.";
$lang['Server responded:']="Server antwortet:";

// ------ Misc unsorted extracted automatically ----
$lang["Run every"]="Ausführen, alle";
$lang["Every other hour"]="Jede andere Stunde";
$lang["Click to retreive backup information from backup target"]="Klicken, um Sicherungsinformation vom Sicherungsziel abzurufen";
$lang["Port forward to internal network"]="Vorwärts an internes Netzwerk übertragen";
$lang["FTP"]="FTP";
$lang["Password"]="Kennwort";
$lang["Date and time"]="Datum und Sprache";
$lang["Update error"]="Update-Fehler";
$lang["Error starting/stopping DHCP server"]="Fehler beim Starten/Stoppen des DHCP-Servers";
$lang["Overwrite files"]="Dateien überschreiben";
$lang["Source"]="Quelle";
$lang["Existing viewers"]="Vorhandene Viewer";
$lang["No info"]="Keine Info";
$lang["Remove selected image from album?"]="Ausgewähltes Bild aus dem Album entfernen?";
$lang["Only A-Z,a-z,0-9 and \"-\" allowed"]="Nur A-Z,a-z,0-9 und \"-\" sind erlaubt";
$lang["Home partition"]="Home-Partition";
$lang["Drag and drop to move images/albums"]="Verwenden Sie die Drag und Drop-Funktion, um Foton/Alben zu verschieben";
$lang["Excluded folders"]="Ausgeschlossene Ordner";
$lang["to install squeezecenter"]="zur Installation von Squeezecenter";
$lang["HHmm"]="HHmm";
$lang["Add viewer"]="Viewer hinzufügen";
$lang["Show logs"]="Protokolle anzeigen";
$lang["Downloading"]="Herunterladen";
$lang["Time of day"]="Tageszeit";
$lang["Upload"]="Hochladen";
$lang["Respond to ping"]="Antwort auf Ping";
$lang["Required for webmail access"]="Für Webmail-Zugriff benötigt";
$lang["month"]="Monat";
$lang["User"]="Benutzer";
$lang["Up and downloads"]="Up- und Downloads";
$lang["Software update"]="Softwareupdate";
$lang["New user"]="Neuer Benutzer";
$lang["Anonymous access not granted to parent album."]="Anonymer Zugriff auf übergeordnetes Album nicht erlaubt.";
$lang["No files selected"]="Keine Dateien ausgewählt";
$lang["Finish setup"]="Setup fertig stellen";
$lang["Error listing disks."]="Fehler bei der Auflistung der Festplatten.";
$lang["No jobs found"]="Keine Aufträge gefunden";
$lang["Tu"]="Di";
$lang["Error retreiving data from target"]="Fehler beim Abrufen der Daten vom Ziel";
$lang["Software version"]="Softwareversion";
$lang["Allocating disk"]="Festplatte zuordnen";
$lang["Auto adjust date and time"]="Datum und Uhrzeit automatisch einstellen";
$lang["Updating settings falied"]="Aktualisierung der Einstellungen fehlgeschlagen";
$lang["Streaming"]="Streaming";
$lang["Read only"]="Nur lesen";
$lang["Email"]="E-Mail";
$lang["Send and recieve"]="Senden und erhalten";
$lang["Menu"]="Menü";
$lang["None"]="Keine";
$lang["Invalid gateway address"]="Ungültige Gatewayadresse";
$lang["Every 12 hours"]="Alle 12 Stunden";
$lang["Select folder to include."]="Ordner auswählen, um einzuschließen";
$lang["Invalid hostname"]="Ungültiger Hostname";
$lang["Data security"]="Datensicherheit";
$lang["On the"]="Auf dem";
$lang["Network profile"]="Netzwerkprofil";
$lang["Retreiving file information ..."]="Dateninformation wird abgerufen...";
$lang["No access"]="Kein Zugriff";
$lang["Enable jumbo frames."]="Jumbo-Rahmen aktivieren.";
$lang["Max upload speed"]="Max. Upload-Geschwindigkeit";
$lang["Use -1 for unlimited traffic"]="-1 für unbegrenzten Datenverkehr verwenden";
$lang["Seeding"]="Seeding";
$lang["Total Speed"]="Gesamtgeschwindigkeit";
$lang["Acknowledge"]="Bestätigen";
$lang["Backupjob added."]="Sicherungsauftrag hinzugefügt.";
$lang["Failed to upload file(s), aborting."]="Hochladen der Datei(n) fehlgeschlagen, wird abgebrochen.";
$lang["The 'Restore to folder' field can not be empty."]="Das Feld 'Zu Ordner wiederherstellen' darf nicht leer sein.";
$lang["Primary DNS"]="Primäre DNS";
$lang["Netmask"]="Netzmaske";
$lang["Queued for checking"]="In der Warteschlange für Prüfung";
$lang["Please select profile"]="Bitte Profil auswählen";
$lang["Show"]="Anzeigen";
$lang["Please do not remove power until all leds are turned off"]="Die Stromversorgung bitte erst trennen, wenn alle LEDs ausgeschaltet sind";
$lang["LAN"]="LAN";
$lang["Included folder"]="Einschließlich Ordner";
$lang["System messages"]="Systemmitteilungen";
$lang["Preparing to"]="Vorbereiten für";
$lang["update system"]="System aktualisieren";
$lang["Album deleted"]="Album gelöscht";
$lang["SSH"]="SSH";
$lang["Current restore operations"]="Aktuelle Wiederherstellungsvorgänge";
$lang["Close"]="Schließen";
$lang["Invalid IP range entered"]="Ungültiger IP-Bereich wurde eingegeben";
$lang["Number of full backups to keep"]="Anzahl vollständiger Sicherungen, die zu behalten sind";
$lang["Restore"]="Wiederherstellen";
$lang["Uploading to"]="Hochladen auf";
$lang["Size"]="Größe";
$lang["Encrypt data"]="Daten verschlüsseln";
$lang["Time until full backup is invalid"]="Zeit, bis die vollständige Sicherung ungültig ist";
$lang["day"]="Tag";
$lang["Run every month"]="Jeden Monat ausführen";
$lang["Lease range start"]="Beginn des Leasebereichs";
$lang["Delete"]="Löschen";
$lang["Total Upload"]="Gesamt-Upload";
$lang["Profile"]="Profil";
$lang["Outgoing email server"]="Ausgehender E-Mail-Server";
$lang["Add user"]="Benutzer hinzufügen";
$lang["Invalid DNS address"]="Ungültige DNS-Adresse";
$lang["Backup status"]="Sicherungsstatus";
$lang["Disk information"]="Datenträger-Information";
$lang["Create job"]="Auftrag erstellen";
$lang["Partition size"]="Partitionsgröße";
$lang["Download speed"]="Download-Geschwindigkeit";
$lang["Private port"]="Privater Port";
$lang["Start upload"]="Hochladen beginnen";
$lang["File backup"]="Dateisicherung";
$lang["Uploading"]="Hochladen läuft";
$lang["File sharing"]="Filesharing";
$lang["Error updating image"]="Fehler beim Aktualisieren des Bildes";
$lang["Default gateway"]="Standardgateway";
$lang["Remote password"]="Remote-Kennwort";
$lang["Error"]="Fehler";
$lang["No files included"]="Keine Dateien inbegriffen";
$lang["Backup"]="Sicherung";
$lang["No system messages available"]="Keine Systemmitteilungen verfügbar";
$lang["Start setup wizard"]="Setup-Assistent starten";
$lang["Max download speed"]="Max. Download-Geschwindigkeit";
$lang["Error removing image"]="Fehler beim Entfernen des Bildes";
$lang["Destination"]="Ziel";
$lang["days"]="Tage";
$lang["Extend"]="Erweitern";
$lang["Package name"]="Paketname";
$lang["Name"]="Name";
$lang["rd"]="rd";
$lang["Format"]="Format";
$lang["seeds"]="Seeds";
$lang["Su"]="So";
$lang["Run hourly"]="Stündlich ausführen";
$lang["Real name"]="Echter Name";
$lang["Remove from album"]="Aus Album entfernen";
$lang["Allow anonymous access"]="Anonymen Zugriff erlauben";
$lang["WAN"]="WAN";
$lang["Currently running backup of file(s) from backupjob: "]="Zurzeit wird Sicherung der Datei(en) vom Sicherungsauftrag ausgeführt: ";
$lang["Package version"]="Paketversion";
$lang["nd"]="nd";
$lang["We"]="Mi";
$lang["Use authentication"]="Authentifizierung verwenden";
$lang["Network configuration"]="Netzwerkkonfiguration";
$lang["Permission denied"]="Erlaubnis abgelehnt";
$lang["Either no wireless network card is available or no valid timezone is set"]="Entweder keine Karte für ein wireless Netzwerk verfügbar oder es ist keine gültige Zeitzone eingestellt";
$lang["Restore to folder"]="Zu Ordner wiederherstellen";
$lang["Partitions"]="Partitionen";
$lang["Connecting to tracker"]="An Tracker verbinden";
$lang["Partition information"]="Partitionsinformation";
$lang["IP-address"]="IP-Adresse";
$lang["BitTorrent"]="BitTorrent";
$lang["Upload complete"]="Upload abgeschlossen";
$lang["Backup job scheduled"]="Sicherungsauftrag eingeplant";
$lang["Add new download"]="Neuen Download hinzufügen";
$lang["Every 6 hours"]="Alle 6 Stunden";
$lang["By Config"]="Durch Config";
$lang["week"]="Woche";
$lang["Browse"]="Durchsuchen";
$lang["Channel"]="Kanal";
$lang["Never expires"]="Verfällt nie";
$lang["Existing jobs"]="Vorhandene Aufträge";
$lang["Restore target dirctory missing"]="Zielverzeichnis für die Wiederherstellung fehlt";
$lang["Public port"]="Öffentlicher Port";
$lang["Remove dir"]="Verzeichnis entfernen";
$lang["Remote user"]="Remote-Benutzer";
$lang["Squeezebox Server"]="Squeezebox Server";
$lang["DHCP leases"]="DHCP-Leases";
$lang["Restoring backup history"]="Sicherungsverlauf wiederherstellen";
$lang["Retreiving information started"]="Abruf der Information begonnen";
$lang["Disk size"]="Festplattengröße";
$lang["Public port range accepted as start-port:stop-port"]="Öffentlicher Portbereich als Start-Port:Stopp-Port akzeptiert";
$lang["Email server"]="E-Mail-Server";
$lang["Error reading jobsettings."]="Fehler beim Lesen der Auftragseinstellungen.";
$lang["Device"]="Gerät";
$lang["B3 start page"]="B3 Startseite";
$lang["Cancel"]="Abbrechen";
$lang["Target"]="Ziel";
$lang["Error updating user access"]="Bei der Aktualisierung des Benutzerzugriffs ist ein Fehler aufgetreten";
$lang["Disk capacity"]="Festplattenkapazität";
$lang["Jobname missing"]="Auftragsname fehlt";
$lang["st"]="st";
$lang["Restoring file(s) from backupjob: "]="Datei(en) von Sicherungsauftrag wiederherstellen: ";
$lang["Maximum total upload is 2GByte."]="Maximaler Gesamt-Upload ist 2 Gbyte.";
$lang["Image updated"]="Bild aktualisiert";
$lang["System partitions"]="Systempartitionen";
$lang["Existing albums"]="Vorhandene Alben";
$lang["Host"]="Host";
$lang["Invalid IP"]="Ungültige IP";
$lang["Downloader"]="Downloader";
$lang["These settings are locked"]="Diese Einstellungen sind gesperrt";
$lang["Source IP"]="Quellen-IP";
$lang["Retreiving package information"]="Paketinformation wird abgerufen";
$lang["Backup target settings undefined."]="Zieleinstellungen der Sicherung nicht definiert.";
$lang["Retreiving information"]="Information wird abgerufen";
$lang["Easyfind"]="Easyfind";
$lang["Extend Logical Volume"]="Logical Volume erweitern";
$lang["Lease range end"]="Ende des Lease-Bereichs";
$lang["User defined open / forwarded ports"]="Vom Benutzer definierte offene / weitergeleitete Ports";
$lang["Location"]="Ort";
$lang["Restore selection"]="Auswahl wiederherstellen";
$lang["Save settings"]="Einstellungen speichern";
$lang["No backup medium found"]="Kein Sicherungsmedium gefunden";
$lang["Job settings"]="Auftragseinstellungen";
$lang["Setup wizard"]="Setup-Assistent";
$lang["Next"]="Nächste";
$lang["Private IP"]="Private IP";
$lang["Empty name not allowed"]="Leerer Name ist nicht erlaubt";
$lang["Partition"]="Partition";
$lang["Router + Firewall + Server"]="Router + Firewall + Server";
$lang["This page should not be reached"]="Diese Seite konnte nicht erreicht werden";
$lang["Adding images is done using the"]="Hinzufügen von Foton wird durchgeführt mithilfe von";
$lang["Name not available or failed to validate request"]="Name nicht verfügbar oder Anfrage konnte nicht überprüft werden";
$lang["Restore missing files"]="Fehlende Dateien wiederherstellen";
$lang["Album name"]="Albumname";
$lang["Status"]="Status";
$lang["Select folder to exclude."]="Ordner auswählen, um auszuschließen";
$lang["Access allowed"]="Zugriff erlaubt";
$lang["Disabled"]="Deaktiviert";
$lang["Username"]="Benutzername";
$lang["Confirm key"]="Schlüssel bestätigen";
$lang["Image removed from album"]="Bild aus Album entfernen";
$lang["Use static IP address settings"]="Statische IP-Adresseneinstellungen verwenden";
$lang["Th"]="Do";
$lang["Viewer"]="Viewer";
$lang["Create empty album"]="Leeres Album erstellen";
$lang["Handle email for domain"]="E-Mail für Domäne verarbeiten";
$lang["Email retrieval"]="E-Mail-Abruf";
$lang["Run now"]="Jetzt ausführen";
$lang["UPNP streaming"]="UPNP Streaming";
$lang["Backup complete"]="Sicherung abgeschlossen";
$lang["Obtain IP-address automatically"]="IP-Adresse automatisch erhalten";
$lang["MAC-address"]="MAC-Adresse";
$lang["Squeezebox server isn't installed, please click"]="Squeezebox Server ist nicht installiert, bitte klicken auf";
$lang["IP"]="IP";
$lang["Mo"]="Mo";
$lang["Done."]="Fertig.";
$lang["Exclude"]="Ausschließen";
$lang["Other"]="Sonstiges";
$lang["Album updated"]="Album aktualisiert";
$lang["Back"]="Zurück";
$lang["Easyfind name"]="Easyfind Name";
$lang["Run every week"]="Jede Woche ausführen";
$lang["Update successful"]="Aktualisierung erfolgreich";
$lang["Please enter a jobname to identify your backup job."]="Bitte geben Sie einen Auftragsnamen ein, um Ihren Sicherungsauftrag zu identifizieren.";
$lang["your-easyfind-name"]="Ihr-easyfind-Name";
$lang["Disconnect"]="Trennen";
$lang["Private port is start port if public port range entered"]="Privater Port ist der Startport, wenn der öffentliche Portbereich eingegeben wurde";
$lang["Abort"]="Abbrechen";
$lang["Setup complete"]="Setup abgeschlossen";
$lang["Delete album"]="Album löschen";
$lang["Backup and restore settings"]="Einstellungen sichern und wiederherstellen";
$lang["Delete backup job:"]="Sicherungsauftrag löschen:";
$lang["no valid WAN port connection"]="keine gültige WAN-Portverbindung";
$lang["Read and write"]="Lesen und schreiben";
$lang["Included files"]="Eingeschlossene Dateien";
$lang["Delete job"]="Auftrag löschen";
$lang["Restore started"]="Wiederherstellung gestartet";
$lang["Change timezone"]="Zeitzone ändern";
$lang["WWW"]="WWW";
$lang["Upload to"]="Hochladen zu";
$lang["Leave copy"]="Kopie lassen";
$lang["Restore user data"]="Benutzerdaten wiederherstellen";
$lang["Enable DNS service"]="DNS-Dienst aktivieren";
$lang["Partition label"]="Partitionsetikett";
$lang["with"]="mit";
$lang["Traffic"]="Datenverkehr";
$lang["here"]="hier";
$lang["peers"]="Peers";
$lang["Use plain text authentication"]="Nur-Text-Authentifizierung verwenden";
$lang["Disk error"]="Festplattenfehler";
$lang["wlan_title_band_2_4"]="wlan_title_band_2_4";
$lang["Destination folder"]="Zielordner";
$lang["YYYYMMDD"]="JJJJMMTT";
$lang["Invalid IP address"]="Ungültige IP-Adresse";
$lang["Sa"]="Sa";
$lang["Backup date"]="Sicherungsdatum";
$lang["Every hour"]="Jede Stunde";
$lang["Enable DHCP server"]="DHCP-Server aktivieren";
$lang["Image name"]="Bildname";
$lang["Unknown state"]="Unbekannter Status";
$lang["Error updating album"]="Fehler beim Aktualisieren des Albums aufgetreten";
$lang["wlan_title_band_5_0"]="wlan_title_band_5_0";
$lang["Initializing"]="Wird initialisiert";
$lang["Current package versions"]="Aktuelle Paketversionen";
$lang["Current timezone is"]="Aktuelle Zeitzone ist";
$lang["Settings updated successfully"]="Einstellungen erfolgreich aktualisiert";
$lang["Target settings"]="Zieleinstellungen";
$lang["Protocol"]="Protokoll";
$lang["Connect"]="Verbinden";
$lang["Network settings"]="Netzwerkeinstellungen";
$lang["Error starting/stopping DNS service"]="Fehler beim Starten/Stoppen des DNS-Dienstes";
$lang["Excito"]="Excito";
$lang["Please select files to restore from the list of included files."]="Bitte wählen Sie die wiederherzustellenden Dateien aus der Liste der inbegriffenen Dateien aus.";
$lang["Uptime"]="Betriebszeit";
$lang["Invalid netmask"]="Ungültige Netzmaske";
$lang["Add entry"]="Eintrag hinzufügen";
$lang["DAAP streaming"]="DAAP Streaming";
$lang["Invalid DNS setting"]="Ungültige DNS-Einstellung";
$lang["Type"]="Typ";
$lang["Explain"]="Erklären";
$lang["Error updating user access to public"]="Fehler bei der Aktualisierung des Benutzerzugriffs zu öffentlich";
$lang["Mount path"]="Mount-Pfad";
$lang["Available"]="Verfügbar";
$lang["th"]="th";
$lang["Automatic network settings"]="Automatische Netzwerk-Einstellungen";
$lang["Hostname"]="Hostname";
$lang["Add"]="Hinzufügen";
$lang["Server only"]="Nur Server";
$lang["Selecting a folder will also select all files within the folder."]="Die Auswahl eines Ordners wird ebenfalls sämtliche Dateien im Ordner auswählen.";
$lang["Error deleting album"]="Fehler beim Löschen des Albums aufgetreten";
$lang["The specified backupdisk is not attached."]="Die spezifizierte Sicherungsfestplatte ist nicht angeschlossen.";
$lang["Download failed"]="Download fehlgeschlagen";
$lang["(Not recommended, passwords will be sent unencrypted.)"]="(Wird nicht empfohlen, Kennwörter werden unverschlüsselt verschickt.)";
$lang["Checking existing files"]="Vorhandene Dateien prüfen";
$lang["Job name"]="Auftragsname";
$lang["No local data found"]="Keine lokalen Daten gefunden";
$lang["disk"]="Datenträger";
$lang["Timezone"]="Zeitzone";
$lang["No disks found"]="Keine Datenträger gefunden";
$lang["Lease expires"]="Lease verfällt";
$lang["Exit setup"]="Setup beenden";
$lang["Local user"]="Lokaler Benutzer";
$lang["Update"]="Aktualisieren";
$lang["Fr"]="Fr";
$lang["(Please read manual before enabling)"]="(Vor der Aktivierung bitte erst die Handbuch lesen)";
$lang["Invalid gateway"]="Ungültiger Gateway";
$lang["filemanager"]="Dateimanager";
$lang["Existing users"]="Vorhandene Benutzer";
$lang["Backup schedule"]="Sicherungsplan";
$lang[" for user: "]=" für Benutzer: ";
$lang["Remote"]="Remote";
$lang["Anonymous FTP access"]="Anonymer FTP-Zugriff";
$lang["Encryption passwords do not match"]="Verschlüsselungskennwörter stimmen nicht überein";
$lang["Done downloading (But missing data)"]="Download abgeschlossen (Aber Daten fehlen)";
$lang["Include"]="Einschließlich";
$lang["Encryption key"]="Verschlüsselungsschlüssel";
$lang["Album access rights updated"]="Album-Zugriffsrechte aktualisiert";
$lang["Description"]="Beschreibung";
$lang["Current backup operations"]="Aktuelle Sicherungsvorgänge";

