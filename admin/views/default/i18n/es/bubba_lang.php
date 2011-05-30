<?php
// $lang['']="";

$lang["name"] = NAME;

$lang['Login']="Conexi&oacute;n";
$lang['Home']="Inicio";
$lang['Users']="Usuarios";
$lang['Services']="Servicios";
$lang['Mail']="Correo";
$lang['Network']="Red";
$lang['Printing']="Impresi&oacute;n";
$lang['Settings']="Configuraci&oacute;n";
$lang['Filemanager']="Gestor de Archivos";
$lang['Album']="&Aacute;lbum de Fotos";
$lang['Stat']="Inicio";
$lang['Downloads']="Descargas";
$lang['Disk']="Disco";
$lang['Userinfo']="Informaci&oacute;n de usuario";
$lang['Shutdown']="Confirmar Apagado";

/* Main navigation categories  */
$lang['title_']=$lang['Home'];
$lang['title_home']="Status";
$lang['title_login']=$lang['Login'];
$lang['title_users']=$lang['Users'];
$lang['title_services']=$lang['Services'];
$lang['title_mail']=$lang['Mail'];
$lang['title_network']=$lang['Network'];
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

$lang['topnav-settings'] = "Administraci&oacute;n";
$lang['topnav-help'] = "Ayuda";
$lang['topnav-home'] = "Inicio";
$lang['topnav-logout'] = "Desconexi&oacute;n";


/* 'Elevated' sub navigation */
$lang['title_usersettings-info'] = "Informaci&oacute;n de Usuario";
$lang['title_usersettings-mail'] = "Correo";
$lang['title_albums'] = "Gestor de &Aacute;lbumes";
$lang['title_album-users'] = "Invitados a &Aacute;lbumes";


/* Sub navigation categories  */
$lang['title_filemanager-browse']="Hojear";
$lang['title_filemanager-backup']="Respaldar";
$lang['title_filemanager-restore']="Restaurar";
$lang['title_mail-retrieve']="Recuperar correo";
$lang['title_mail-server_settings']="Configuraci&oacute;n de servidor";
$lang['title_network-profile']="Perfil";
$lang['title_network-lan']="LAN";
$lang['title_network-wan']="WAN";
$lang['title_network-wlan']="Inal&Aacute;mbrico";
$lang['title_network-firewall']="Cortafuegos";
$lang['title_disk-info']="Informaci&oacute;n de disco";
$lang['title_disk-lvm']="LVM";
$lang['title_disk-raid']="RAID";
$lang['title_settings-wizard']="Asistente de configuraci&oacute;n";
$lang['title_settings-identity']="Identidad";
$lang['title_settings-traffic']="Apertura Torrent";
$lang['title_settings-date']="Hora e idioma";
$lang['title_settings-sysbackup']="Configuraci&oacute;n de respaldo";
$lang['title_settings-update']="Actualizaci&oacute;n de software";
$lang['title_settings-logs']="Logs";
$lang['title_photo-albums']="&Aacute;lbumes de Fotos";



/* Generic button labels and texts */

$lang['button_label_continue']='Continuar';
$lang['button_label_delete']='Borrar';
$lang['button_label_cancel']='Cancelar';
$lang['button-label-cancel']='Cancelar'; // TODO FIXME
$lang['generic_dialog_text_please_wait'] = "Por favor espera...";
$lang['generic_dialog_text_warning'] = "Precauci&oacute;n";
$lang['generic-permission-denied'] = "Permiso denegado";

/* Login texts  */
$lang["topnav-authorized"] = "Conectado como '%s'";
$lang["topnav-not-authorized"] = "No conectado";
$lang["login-dialog-header"] = "Conexi&oacute;n requerida";
$lang["login-dialog-username"] = "Usuario";
$lang["login-dialog-password"] = "Contrase&ntilde;a";
$lang["login-dialog-cancel"] = "Cancelar";
$lang['login-error-grantaccess'] = "Acceso no autorizado para usuario '%s'.";
$lang['login-error-wanaccess'] = "Usuario Admin no puede conectarse en la interface WAN.";
$lang['login-error-wanaccess-quickstart'] = "Por favor lee el manual de usuarios para consejos.";
$lang['login-error-noaccess'] = "User isn't allowed to login to web admin.";
$lang['login-error-pwd'] = "Combinaci&oacute;n usuario/contrase&ntilde;a inv&Aacute;lida.";

/* Menu bar texts */

$lang['menubar-link-pim'] = "CorreoWeb";
$lang['menubar-link-music'] = "M&uacute;sica";
$lang['menubar-link-album'] = "Fotos";
$lang['menubar-link-usersettings'] = "Configuraci&oacute;n&nbsp;de usuario";
$lang['menubar-link-filemanager'] = "Gestor de&nbsp;archivos";
$lang['menubar-link-backup'] = "Respaldo&nbsp;de fichero";
$lang['menubar-link-systemsettings'] = "Configuraci&oacute;n&nbsp;del sistema";
$lang['menubar-link-downloads'] = "Descargas";


// backup field translations
$lang['current_job'] = "Nombre de tarea";
$lang['target_protocol'] = "Destino";

// disk
$lang['disk_action_title_extend_lvm'] = 'Ampliando el espacio de almacenamiento de usuario';
$lang['disk_action_title_create_raid'] = 'Convirtiendo el sistema a RAID';
$lang['disk_action_title_restore_raid'] = 'Recuperando RAID';
$lang['disk_action_title_format'] = 'Formateando disco';
$lang['in_sync'] = 'Sincronizado';
$lang['faulty'] = 'Error de disco';
$lang['active'] = 'Activo';
$lang['clean'] = 'Limpio';

$lang['disk_format_title'] = "Formatear disco";
$lang['disk_format_error_mounts_exists_message'] = "Parece haber discos montados, p.f. desm&oacute;ntalos y vuelve a intentarlo";
$lang['disk_format_message'] = "Por favor especifica etiqueta para tu nueva partici&oacute;n";
$lang['disk_format_format_button_label'] = "Formatea disco";
$lang['disk_format_label_label'] = "Etiqueta";
$lang['disk_format_warning_1'] = "Formatear el disco destruir&Aacute; todos los datos del mosmo";
$lang['disk_format_warning_2'] = "¿Continuar con el formateo del disco?";
$lang['disk_format_format_progress_title'] = "Formateando disco";
$lang['disk_format'] = "";

$lang['disk_lvm_extend_dialog_warning_message'] = "<p>Esto borrar&Aacute; todos los datos del nuevo, dispositivo externo. Click 'Create LVM' to continue.</p> <p>Nota: La retirada del nuevo disco del sistema requerir&Aacute; una reinstalaci&oacute;n completa del sistema.</p>";
$lang['disk_lvm_extend_dialog_warning_title'] = "Extender Volumen L&oacute;gico";
$lang['disk_lvm_extend_dialog_warning_button_label'] = "Crear LVM";
$lang['disk_lvm_extend_dialog_title'] = "Extendiendo disco";

/* RAID */
$lang['disk-examine-disks'] = "Examinando discos existentes";
$lang['disk_raid_setup_title'] = "Establecer grupo RAID";
$lang['disk_raid_create_label'] = "Crear grupo RAID";
$lang['disk_raid_create_message'] = "Establecer el disco interno y un disco externo como soluci&oacute;n RAID espejo (RAID 1)";
$lang['disk_raid_recover_label'] = "Recuperar grupo RAID";
$lang['disk_raid_recover_message'] = "Recuperar disco interno o a&ntilde;adir un nuevo disco externo al grupo RAID existente";
$lang['disk_raid_status_title'] = "Estado del RAID";
$lang['disk_raid_degraded_recover_status_message'] = "Recuperando grupo RAID '%s'";
$lang['disk_raid_degraded_recover_status_message_eta_hours'] = "El progreso actual de recuperaci&oacute;n es %d%% y se estima acabar en %d horas %d minutos";
$lang['disk_raid_degraded_recover_status_message_eta_minutes'] = "El progreso actual de recuperaci&oacute;n es %d%% y se estima acabar en %d minutes";
$lang['disk_raid_degraded_message'] = "Grupo RAID degradado";
$lang['disk_raid_degraded_missing_disk_message'] = "Falta disco en grupo RAID '%s'";
$lang['disk_raid_external_failure_title'] = "Error: El disco externo ha tenido fallos";
$lang['disk_raid_external_failure_message_1'] = "El disco externo RAID (<strong>%s</strong>) del grupo RAID ha tenido fallos";
$lang['disk_raid_external_failure_message_2'] = "Por favor sustituye el disco (tambi&eacute;n pulsa \"Quitar\" debajo para confirmar la retirada del disco)";
$lang['disk_raid_external_failure_message_3'] = "Cuando el disco haya sido remplazado, pulsa \"Recuperar grupo RAID\" para a&ntilde;adir el nuevo disco al grupo";
$lang['disk_raid_normal_op_message'] = "Operaci&oacute;n normal";
$lang['disk_raid_not_activated_message'] = "RAID no activado";
$lang['disk_raid_detailed_info_title'] = "Informaci&oacute;n detallada";
$lang['disk_raid_list_of_arrays_title'] = "Lista de grupos RAID";
$lang['disk_raid_table_list_of_arrays_array_name_title'] = "nombre de grupo";
$lang['disk_raid_table_list_of_arrays_level_title'] = "Nivel";
$lang['disk_raid_table_list_of_arrays_state_title'] = "Estado";
$lang['disk_raid_table_list_of_arrays_label_title'] = "Etiqueta";
$lang['disk_raid_table_list_of_arrays_size_title'] = "Tama&ntilde;o";
$lang['disk_raid_list_of_disks_title'] = "Lista de discos RAID";
$lang['disk_raid_table_list_of_disks_disk_title'] = "Disco";
$lang['disk_raid_table_list_of_disks_parent_title'] = "Padre";
$lang['disk_raid_table_list_of_disks_state_title'] = "Estado";
$lang['disk_raid_table_list_of_disks_size_title'] = "Tama&ntilde;o";
$lang['disk_raid_disk_faulty_remove_button_label'] = "Quitar";

# Create
$lang['disk_raid_create_progress_title'] = "Recuperando grupo RAID";
$lang['disk_raid_create_title'] = "Crear grupo RAID";
$lang['disk_raid_create_error_mounts_exists_message'] = "Parece haber discos montados, p.f. desm&oacute;ntalos y vuelve a intentarlo";
$lang['disk_raid_create_select_disk_message'] = "Selecciona que disco externo incluir en el grupo. Se recomienda un disco externo del mismo tama&ntilde;o";
$lang['disk_raid_create_warning_1'] = "Crear el grupo RAID <strong>destruir&Aacute; todo el contenido</strong> de tu disco interno (/home&nbsp;-&nbsp;incluyendo&nbsp;'storage') y borrar&Aacute; el disco externo seleccionado";
$lang['disk_raid_create_warning_2'] = "Aseg&uacute;rate de que tienes respaldo de todos los ficheros";
$lang['disk_raid_create_warning_3'] = "¿Continuar creando RAID?";
$lang['disk_raid_create_error_no_disks_found_message'] = "No se encuentra disco utilizable";
$lang['disk_raid_create_button_label'] = "Crear RAID";
$lang['disk_raid_nodisk_label_cancel'] = "Cerrar";
# Recover
$lang['disk_raid_recover_title'] = "Recuperar grupo RAID";
$lang['disk_raid_recover_broken_external_progress_title'] = "Recuperando disco externo en grupo RAID";
$lang['disk_raid_recover_broken_external_message'] = "Selecciona disco externo para a&ntilde;adir al grupo RAID";
$lang['disk_raid_recover_broken_external_warning_1'] = "La recuperaci&oacute;n del grupo RAID <strong>destruir&Aacute; todo el contenido</strong> en el disco externo seleccionado";
$lang['disk_raid_recover_broken_external_warning_2'] = "¿Continuar con la recuperaci&oacute;n RAID?";
$lang['disk_raid_recover_broken_external_button_label'] = "A&ntilde;ade disco al grupo RAID";
$lang['disk_raid_recover_broken_external_no_disks_message'] = "No hay conectados discos externos utilizables, por favor a&ntilde;ade un disco externo e-SATA y vuelve a intentarlo";
$lang['disk_raid_recover_broken_internal_progress_title'] = "Recuperando disco interno en grupo RAID";
$lang['disk_raid_recover_broken_internal_mount_exists_message'] = "Parece haber discos montados, por favor desm&oacute;ntalos y vuelve a intentarlo";
$lang['disk_raid_recover_broken_internal_message'] = "Selecciona que disco externo del que recuperar datos RAID";
$lang['disk_raid_recover_broken_internal_button_label'] = "Recuperar disco interno";
$lang['disk_raid_recover_broken_internal_warning_1'] = "La recuperaci&oacute;n del grupo RAID <strong>destruir&Aacute; todo el contenido</strong> de tu disco interno (/home&nbsp;-&nbsp;incluyendo&nbsp;'storage')";
$lang['disk_raid_recover_broken_internal_warning_2'] = "¿Continuar con la recuperaci&oacute;n RAID?";
$lang['disk_raid_recover_broken_internal_button_label'] = "Recuperar disco interno";
$lang['disk_raid_recover_broken_internal_no_raid_message'] = "No se encuentran discos con datos RAID";

// Network

$lang['network-settings-locked-1'] = "Esta Configuraci&oacute;n est&Aacute; bloqueada";
$lang['network-settings-locked-2'] = NAME." esta usando configuraci&oacute;n de red autom&Aacute;tica";
$lang['network-settings-locked-3'] = "Para desbloquearla, selecciona perfir Router o perfil Servidor bajo el ";

$lang['network-firewall-openport'] = "Abrir puerto ".NAME."";

$lang['wlan_title'] = 'Inal&Aacute;mbrico';
$lang['wlan_title_ssid'] = 'Nombre de red (SSID)';
$lang['wlan_title_ssid_popup'] = 'El nombre de red (tambi&eacute;n llamado SSID) ser&Aacute; difundido por '.NAME.' y aparecer&Aacute; en los clientes cuando busquen redes inal&Aacute;mbricas.';
$lang['wlan_title_enable'] = 'Punto de acceso inal&Aacute;mbrico';
$lang['wlan_title_enable_popup'] = 'Marca esta casilla para habilitar la funcionalidad inal&Aacute;mbrica para tu '.NAME.'';

$lang['wlan_title_advanced'] = 'Configuraci&oacute;n inal&Aacute;mbrica avanzada';

$lang['wlan_title_band'] = 'Banda';
$lang['wlan_title_band_1'] = 'Banda 2.4GHz usada por 802.11g';
$lang['wlan_title_band_2'] = 'Banda 5GHz usada por 802.11a';

$lang['wlan_title_mode'] = 'Modo';
$lang['wlan_title_mode_popup'] = 'El modo de operaci&oacute;n para la banda seleccionada';
$lang['wlan_title_legacy_mode_2'] = 'Modo compatible (802.11a)';
$lang['wlan_title_legacy_mode_1'] = 'Modo compatible (802.11g)';
$lang['wlan_title_mixed_mode_2'] = 'Modo mixto (802.11n + 802.11a)';
$lang['wlan_title_mixed_mode_1'] = 'Modo mixto (802.11n + 802.11g)';
$lang['wlan_title_greenfield_mode'] = 'Modo s&oacute;lo N (802.11n only)';

$lang['wlan_title_encryption'] = 'Encriptaci&oacute;n';
$lang['wlan_title_encryption_popup'] = 'La encriptaci&oacute;n a utilizar';
$lang['wlan_title_encryption_wpa2'] = 'WPA2';
$lang['wlan_title_encryption_wpa12'] = 'WPA1 o WPA2';
$lang['wlan_title_encryption_wpa1'] = 'WPA1';
$lang['wlan_title_encryption_wep'] = 'WEP';
$lang['wlan_title_encryption_none'] = 'Ninguna';

$lang['wlan_title_width'] = 'Amplitud de Canal';
$lang['wlan_title_width_popup'] = 'La amplitud de canal en MHz';
$lang['wlan_title_width_20MHz'] = '20MHz';
$lang['wlan_title_width_40MHz'] = '40MHz';

$lang['wlan_title_password'] = 'Contrase&ntilde;a';
$lang['wlan_title_password_popup'] = 'La contrase&ntilde;a que se necesita para conectar con '.NAME.' de forma inal&Aacute;mbrica';

$lang['wlan_title_channel'] = 'Canal';
$lang['wlan_title_channel_popup'] = 'El canal principal a utilizar';

$lang['wlan_title_broadcast'] = 'Difusi&oacute;n de SSID';
$lang['wlan_title_broadcast_popup'] = 'Desactiv&Aacute;ndolo oculta la red - los usuarios tendr&Aacute;n que teclear manualmente el SSID en los clientes';

$lang['fw_title_advanced'] = 'Configuraci&oacute;n avanzada de cortafuegos';

# Services
$lang['service_update_success'] = "Servicios actualizados";

# Settings
$lang['settings-start-wizard'] = "To configure basic functionality of ".NAME.", press the button to start the setup wizard.";

$lang['settings_traffic_success'] = "Limite de tr&Aacute;fico actualizado";
$lang['settings_traffic_error_service_unavailable'] = "Servicio de tr&Aacute;fico no accesible";
$lang['settings_traffic_error_set_dl_throttle'] = "Fallo al establecer velocidad de descarga";
$lang['settings_traffic_error_set_ul_throttle'] = "Fallo al establecer velocidad de subida";

$lang['settings_backup_error_no_path'] = "Fallo al establecer punto de montaje para respaldo";
$lang['settings_backup_error_failed'] = "El sistema no es capaz de crear un respaldo";
$lang['settings_backup_success'] = "Respaldo de la configuraci&oacute;n del sistema creado correctamente";

$lang['settings_restore_error_no_path'] = "Fallo al establecer punto de montaje para recuperaci&oacute;n";
$lang['settings_restore_error_failed'] = "El sistema no es capaz de recuperar desde un respaldo";
$lang['settings_restore_success'] = "La Configuraci&oacute;n del sistema se ha recuperado correctamente";

$lang['settings_datetime_success'] = "Timezone, fecha y/o hora actualizados correctamente";
$lang['settings_datetime_error_set_timezone'] = "Fallo al establecer timezone <strong>%s</strong>";
$lang['settings_datetime_error_set_date_time'] = "Fallo al establecer fecha <strong>%s</strong> y hora <strong>%s</strong>";
$lang['settings-default-lang'] = "Idioma del sistema";
$lang['settings-default-lang-header'] = "Idioma del sistema por defecto";
$lang['settings_defaultlang_success'] = "Idioma del sistema por defecto actualizado";

$lang['settings_software_install_package'] = "Instalar %s";
$lang['settings_software_update_software'] = "Actualizar software";
$lang['settings_software_update_system'] = "Actualizar sistema";
$lang['settings_software_include_hotfixes'] = "Incluir parches y actualizaciones espec&iacute;ficas del sistema";
$lang['help_hotfix']="?page=sw_upgrade.html#hotfix";


$lang['settings_identity_error_change_hostname'] = "Fallo al cambiar hostname";
$lang['settings_identity_error_invalid_hostname'] = "Hostname <strong>%s</strong> es inv&Aacute;lido, solo valen los caracteres <strong>A-Za-z0-9-</strong>";
$lang['settings_identity_easyfind_error_fail_set_name'] = "Fallo al establecer el nombre Easyfind <strong>%s</strong>, este nombre probablemente est&Aacute; en uso. Por favor prueba otro nombre";
$lang['settings_identity_easyfind_error_invalid_name'] = "El nombre Easyfind <strong>%s</strong> es inv&Aacute;lido, solo valen los caracteres <strong>A-Za-z0-9-</strong>";
$lang['settings_identity_easyfind_error_fail_enable'] = "Fallo al habilitar Easyfind";
$lang['settings_identity_easyfind_error_fail_disable'] = "Fallo al desabilitar Easyfind";
$lang['settings_identity_title'] = "Identidad del sistema";
$lang['settings_identity_hostname_label'] = "Hostname";
$lang['settings_identity_workgroup_label'] = "Grupo de trabajo";
$lang['settings_identity_update_hostname_workgroup_label'] = "Actualizar hostname y grupo de trabajo";
$lang['settings_identity_easyfind_title'] = "Opciones Easyfind";
$lang['settings_identity_easyfind_message'] = "Servicio de localizaci&oacute;n 'Easyfind'";
$lang['settings_identity_update_easyfind_label'] = "Actualizar Easyfind";

//  ---------- Users  -----
$lang['users-list-edit-realname-label'] = 'Nombre real';
$lang['users-list-edit-username-label'] = 'Nombre de usuario';
$lang['users-list-edit-shell-label'] = 'Conexi&oacute;n shell';
$lang['users-list-edit-remote-label'] = 'Permitir acceso remoto a la configuraci&oacute;n del sistema';
$lang['users-list-edit-password1-label'] = 'Nueva contrase&ntilde;a';
$lang['users-list-edit-password2-label'] = 'Confirmar contrase&ntilde;a';
$lang['users-list-edit-sideboard-label'] = 'Mostrar gabinete de usuarios no conectados';
$lang['users-list-edit-language'] = 'Idioma de usuario';
$lang['users-list-edit-defaultlang'] = $lang['settings-default-lang-header'];
$lang['users-title'] = 'Usuarios';
$lang['user-users-title'] = 'Informaci&oacute;n de usuario';
$lang['users-label-username'] = 'Nombre de usuario';
$lang['users-label-realname'] = 'Nombre real';
$lang['users-label-shell-login'] = 'Permitir conexi&oacute;n shell';
$lang['users-add-button-label'] = 'A&ntilde;adir nuevo usuario';
$lang['users-edit-account-error'] = 'Fallo al editar cuenta para %s (%3$s) shell: %2$s';
$lang['users-system-default-lang'] = 'Valores por defecto';

$lang['illegal'] = 'Caracteres ilegales en la contrase&ntilde;a';
$lang["mismatch"]='Contrase&ntilde;as no coinciden';
$lang["sambafail"]='Fallo al actualizar la contrase&ntilde;a';
$lang["passwdfail"]=$lang["sambafail"];
$lang["user_update_error_auth_fail"] = "Fallo de autorizaci&oacute;n";
$lang["user_update_error"] = "Error actualizando informaci&oacute;n de usuario";
$lang["user_update_ok"] = "Informaci&oacute;n de usuario actualizada";

$lang["usr_caseerr"] = "No se permiten may&uacute;sculas en nombre de usuario";
$lang["usr_existerr"] = "Ya existe el usuario o es una cuenta administrativa";
$lang["usr_nonameerr"] = "Falta nombre de usuario";
$lang["usr_spacerr"] = "No se permiten espacios en nombre de usuario";
$lang["pwd_charerr"] = "Caracteres ilegales en la contrase&ntilde;a";
$lang["usr_charerr"] = "Caracteres ilegales en nombre de usuario";
$lang["usr_longerr"] = "Nombre de usuario demasiado largo. M&Aacute;ximo 32 caracteres";
$lang["usr_createerr"] = "Error creando usuario";
$lang["usr_addok"] = "Usuario a&ntilde;adido";
$lang["pwd_mismatcherr"] = "Contrase&ntilde;as no coinciden o contrase&ntilde;a vac&iacute;a";

//  ---------- Admin Mail-----
$lang["usrinvalid"] = "No autorizado para a&ntilde;adir cuentas para el usuario seleccionado.";
$lang["infoincomp"] = "Informaci&oacute;n de cuenta incompleta. Cuenta no a&ntilde;adida.";
$lang["mail_addok"] = "Cuenta a&ntilde;adida.";
$lang["mail_err_usrinvalid"] = "Usuario no autorizado para actualizar cuenta";
$lang["mail_editok"] = "Cuenta actualizada.";
$lang["mail_delete_account_ok"] ="Cuenta eliminada";
$lang["mail-server-domaincontroller"] ="Dominio de correo";
$lang['mail_server_userpwdmissing'] = "Falta contrase&ntilde;a del servidor de correo";

//  ----------- Filemanager --------

$lang["filemanager-label-name"] = "Nombre";
$lang["filemanager-title-permissions"] = "Permisos";
$lang["filemanager-label-permission-owner"] = "Propietario";
$lang["filemanager-label-permission-owner-read"] = "leer";
$lang["filemanager-label-permission-owner-write"] = "escribir";
$lang["filemanager-label-permission-owner-execute"] = "ejecutar";
$lang["filemanager-label-permission-group"] = NAME." usuarios";
$lang["filemanager-label-permission-group-read"] = "leer";
$lang["filemanager-label-permission-group-write"] = "escribir";
$lang["filemanager-label-permission-group-execute"] = "ejecutar";
$lang["filemanager-label-permission-other"] = "No conectado";
$lang["filemanager-label-permission-other-read"] = "leer";
$lang["filemanager-label-permission-other-write"] = "escribir";
$lang["filemanager-label-permission-other-execute"] = "ejecutar";

$lang["filemanager-mkdir-dialog-button-label"] = "Crear carpeta";
$lang["filemanager-mkdir-dialog-title"] = "Crear nueva carpeta";
$lang["filemanager-delete-dialog-button-label"] = "Borrar";
$lang["filemanager-delete-dialog-title"] = "Borrar ficheros y carpetas";
$lang["filemanager-delete-fail-message"] = "Fallo al forrar los siguientes ficheros/carpetas: %s";
$lang["filemanager-delete-dialog-message"] = "¿Borrar ficheros y/o carpetas seleccionados?";
$lang["filemanager-rename-dialog-title"] = "Renombrar";
$lang["filemanager-permission-dialog-title"] = "Cambiar permisos";
$lang["filemanager-perm-dialog-button-label"] = "Cambiar permisos";

$lang['filemanager_mkdir_error_nodir'] = "Error creando carpeta, falta nombre";
$lang['filemanager_mkdir_error_file_exists'] = "Error creando carpeta, el nombre ya existe";
$lang['filemanager_mkdir_error_create'] = "Fallo al crear carpeta";
$lang['filemanager-rename-error'] = "Error renombrando fichero '%s'";
$lang["filemanager-copy-fail-message"] = "Fallo al copiar los siguientes ficheros y carpetas: %s";
$lang["filemanager-move-fail-message"] = "Fallo al mover los siguientes ficheros y carpetas: %s";
$lang["filemanager-perm-fail-message"] = "Fallo al cambiar permisos para los siguientes ficheros y carpetas: %s";
$lang["filemanager-album-dialog-message"] = "¿A&ntilde;adir las im&Aacute;genes/carpetas seleccionadas al &Aacute;lbum de fotos?";

$lang["help_box_header"] = NAME." Ayuda";

//  ----------- Mail --------

$lang["mail-retrieve-edit-host-label"] = "Host";
$lang["mail-retrieve-edit-protocol-label"] = "Protocolo";
$lang["mail-retrieve-edit-ruser-label"] = "Usuario remoto";
$lang["mail-retrieve-edit-password-label"] = "Contrase&ntilde;a";
$lang["mail-retrieve-edit-luser-label"] = "Usuario local";
$lang["mail-retrieve-edit-usessl-label"] = "Usar encriptaci&oacute;n";
$lang["mail-retrieve-edit-keep-label"] = "Dejar copia de correo en servidor";
$lang["mail-retrieve-add-button-label"] = "A&ntilde;adir nueva cuenta de correo";
$lang["mail-validation-error"] = "Fallo en validaci&oacute;n de entrada";
$lang["mail-auth-error"] = "Fallo de autorizaci&oacute;n";
$lang["mail-retrieve-title"] = "Recuperar correo";
$lang["mail-server-title"] = "Servidor de correo";
$lang["SSL"] = "Encriptado";

//  ----------- Stat --------

$lang["stat-shutdown-label"] = "Apagado";
$lang["stat-reboot-label"] = "Reinicio";

// ----------- Shutdown view --------
$lang["shutdown-shutdown-label"] = "Apagando ".NAME;
$lang["shutdown-restart-label"] = "Para reiniciar ".NAME.", presiona el bot&oacute;n de encendido";
$lang["shutdown-restarting"] = "Reiniciando ".NAME;
$lang["shutdown-LED-stopflash"] = "Cuando la luz del LED est&Aacute; completamente azul, ".NAME." esta listo para usarse de nuevo";

//  ---------- Album  -----
$lang['album-users-edit-username-label'] = 'Nombre invitado';
$lang['album-users-edit-password1-label'] = 'Nueva contrase&ntilde;a';
$lang['album-users-edit-password2-label'] = 'Confirma contrase&ntilde;a';

// ------------------ Wizard -------------
$lang["wizard-title-lang"]="Paso 1/4: Selecciona idioma por defecto";
$lang["wizard-title-datetime"]="Paso 2/4: Establece fecha y hora";
$lang["wizard-title-users"]="Paso 3/4: Crea usuarios";
$lang["wizard-title-network"]="Paso 4/4: Configura la red";

$lang['network-wizard-enjoy'] = 'Disfruta ' . NAME;
$lang['network-wizard-easyfind'] = "Para localizar ".NAME." desde internet, usa el servicio de localizaci&oacute;n 'Easyfind'";
$lang['network-firewall-allow-wan'] = "Permitir acceso externo (WAN) a servicios de ".NAME."";

$lang['wizard-title'] = "Bienvenido a ".NAME;
$lang['wizard-msg1'] = "Por favor dedica un momento a establecer la funcionalidad b&Aacute;sica para ".NAME;
$lang['wizard-msg1'] = "Todos los valores introducidos pueden cambiarse porteriormente usando la interface de administraci&oacute;n.";

// ------ Misc unsorted extracted automatically ----
$lang["Run every"]="Ejecutar cada";
$lang["Every other hour"]="Cada otra hora";
$lang["Click to retreive backup information from backup target"]="Marca para recuperar informaci&oacute;n de respaldo del destino de respaldo";
$lang["Port forward to internal network"]="Redirecci&oacute;n de puerto a red interna";
$lang["FTP"]="FTP";
$lang["Password"]="Contrase&ntilde;a";
$lang["Date and time"]="Fecha y hora";
$lang["Update error"]="Error de actualizaci&oacute;n";
$lang["Error starting/stopping DHCP server"]="Error arrancando/parando servidor DHCP";
$lang["Overwrite files"]="Sobreescribir ficheros";
$lang["Source"]="Fuente";
$lang["Existing viewers"]="Invitados existentes";
$lang["No info"]="Sin informaci&oacute;n";
$lang["Remove selected image from album?"]="¿Eliminar im&Aacute;gen seleccionada del &Aacute;lbum?";
$lang["Only A-Z,a-z,0-9 and \"-\" allowed"]="S&oacute;lo se permite A-Z,a-z,0-9 y \"-\"";
$lang["Home partition"]="partici&oacute;n Home";
$lang["Drag and drop to move images/albums"]="Arrastrar y soltar para mover im&Aacute;genes/&Aacute;lbumes";
$lang["Excluded folders"]="Carpetas exclu&iacute;das";
$lang["to install squeezecenter"]="para instalar squeezecenter";
$lang["system_language"]="Idioma";
$lang["HHmm"]="HHmm";
$lang["Add viewer"]="A&ntilde;adir invitado";
$lang["Show logs"]="Mostrar registros";
$lang["Downloading"]="Descargando";
$lang["Time of day"]="Hora del d&iacute;a";
$lang["Upload"]="Subida";
$lang["Respond to ping"]="Responder a ping";
$lang["Required for webmail access"]="Requerido para acceso webmail";
$lang["month"]="mes";
$lang["User"]="Usuario";
$lang["Up and downloads"]="Subidas y descargas";
$lang["Software update"]="Actualizaci&oacute;n de software";
$lang["New user"]="Nuevo usuario";
$lang["Anonymous access not granted to parent album."]="No permitido acceso an&oacute;nimo al &Aacute;lbum padre.";
$lang["No files selected"]="No hay ficheros seleccionados";
$lang["Finish setup"]="Finalizar ajustes";
$lang["Error listing disks."]="Error listando discos.";
$lang["No jobs found"]="No se encuentran tareas";
$lang["Tu"]="Ma";
$lang["Error retreiving data from target"]="Error recuperando datos del destino";
$lang["Software version"]="Versi&oacute;n de software";
$lang["Allocating disk"]="Reservando disco";
$lang["Auto adjust date and time"]="Auto adjustar fecha y hora";
$lang["Updating settings falied"]="Fallo de la actualizaci&oacute;n de configuraci&oacute;n";
$lang["Streaming"]="Difusi&oacute;n";
$lang["Read only"]="S&oacute;lo lectura";
$lang["Email"]="Correo";
$lang["Send and recieve"]="Enviar y recibir";
$lang["Menu"]="Men&uacute;";
$lang["None"]="Ninguno";
$lang["Invalid gateway address"]="Direcci&oacute;n de gateway inv&Aacute;lida";
$lang["Every 12 hours"]="Cada 12 horas";
$lang["Select folder to include."]="Seleciona carpeta a incluir.";
$lang["Invalid hostname"]="Hostname inv&Aacute;lido";
$lang["Data security"]="Seguridad de datos";
$lang["On the"]="En el";
$lang["Network profile"]="Perfil de red";
$lang["Retreiving file information ..."]="Recuperando informaci&oacute;n de fichero ...";
$lang["No access"]="Sin acceso";
$lang["Enable jumbo frames."]="Habilitar jumbo frames.";
$lang["Max upload speed"]="M&Aacute;xima velocidad de subida";
$lang["Use -1 for unlimited traffic"]="Usar -1 para tr&Aacute;fico ilimitado";
$lang["Seeding"]="Sembrando";
$lang["Total Speed"]="Velocidad total";
$lang["Acknowledge"]="Reconocer";
$lang["Backupjob added."]="Tarea de respaldo a&ntilde;adida.";
$lang["Failed to upload file(s), aborting."]="Fallo al subir fichero(s), abortando.";
$lang["The 'Restore to folder' field can not be empty."]="El campo 'Restaura a carpeta' no puede estar vac&iacute;o.";
$lang["Primary DNS"]="DNS primario";
$lang["Netmask"]="M&Aacute;scara de red";
$lang["Queued for checking"]="Encolado para verificaci&oacute;n";
$lang["Please select profile"]="Por favor selecciona perfil";
$lang["Show"]="Mostrar";
$lang["Please do not remove power until all leds are turned off"]="Por favor no desconectar de la red hasta que los led se hayan apagado";
$lang["LAN"]="LAN";
$lang["Included folder"]="Carpeta inclu&iacute;da";
$lang["System messages"]="Mensajes del sistema";
$lang["Preparing to"]="Preparandose a";
$lang["update system"]="actualizar el sistema";
$lang["Album deleted"]="&Aacute;lbum borrado";
$lang["SSH"]="SSH";
$lang["Current restore operations"]="Operaciones de recuperaci&oacute;n en marcha";
$lang["Close"]="Cerrar";
$lang["Invalid IP range entered"]="Rango de IP inv&Aacute;lido";
$lang["Number of full backups to keep"]="N&uacute;mero de respaldos completos a mantener";
$lang["Restore"]="Restaurar";
$lang["Uploading to"]="Subiendo a";
$lang["Size"]="Tama&ntilde;o";
$lang["Encrypt data"]="Encriptar datos";
$lang["Time until full backup is invalid"]="Hora hasta respaldo completo inv&Aacute;lida";
$lang["day"]="d&iacute;a";
$lang["Run every month"]="Ejecutar mensualmente";
$lang["Lease range start"]="Comienzo del rango de concesi&oacute;n";
$lang["Delete"]="Borrar";
$lang["Total Upload"]="Subida total";
$lang["Profile"]="Perfil";
$lang["Outgoing email server"]="Servidor de correo saliente";
$lang["Add user"]="A&ntilde;adir usuario";
$lang["Invalid DNS address"]="Direcci&oacute;n DNS inv&Aacute;lida";
$lang["Backup status"]="Estado del Respaldo";
$lang["Disk information"]="Informaci&oacute;n de disco";
$lang["Create job"]="Crear tarea";
$lang["Partition size"]="Tama&ntilde;o de partici&oacute;n";
$lang["Download speed"]="Velocidad de descarga";
$lang["Private port"]="Puerto privado";
$lang["Start upload"]="Comenzar subida";
$lang["File backup"]="Respaldando fichero";
$lang["Uploading"]="Subiendo";
$lang["File sharing"]="Compartiendo fichero";
$lang["Error updating image"]="Error actualizando imagen";
$lang["Default gateway"]="Gateway por defecto";
$lang["Remote password"]="Contrase&ntilde;a remota";
$lang["Error"]="Error";
$lang["No files included"]="No se incluyen ficheros";
$lang["Backup"]="Respaldo";
$lang["No system messages available"]="No hay mensajes del sistema";
$lang["Start setup wizard"]="Iniciar asistente de ajuste";
$lang["Max download speed"]="M&Aacute;xima velocidad de descarga";
$lang["Error removing image"]="Error eliminando imagen";
$lang["Destination"]="Destino";
$lang["days"]="dias";
$lang["Step 3/3: Network setup"]="Paso 3/3: ajustes de red";
$lang["Extend"]="Extensi&oacute;n";
$lang["Package name"]="Nombre de paquete";
$lang["Name"]="Nombre";
$lang["rd"]="rd";
$lang["Format"]="Formato";
$lang["seeds"]="semillas";
$lang["Su"]="Do";
$lang["Run hourly"]="Ejecutar cada hora";
$lang["Real name"]="Nombre real";
$lang["Remove from album"]="Eliminar del &Aacute;lbum";
$lang["Allow anonymous access"]="Permitir acceso an&oacute;nimo";
$lang["WAN"]="WAN";
$lang["Currently running backup of file(s) from backupjob: "]="Actualmente ejecutando respaldo de fichero(s) mediante tarea: ";
$lang["Package version"]="Versi&oacute;n de paquete";
$lang["nd"]="nd";
$lang["We"]="Mi";
$lang["Use authentication"]="Usar autentificaci&oacute;n";
$lang["Network configuration"]="Configuraci&oacute;n de red";
$lang["Permission denied"]="Permiso denegado";
$lang["Either no wireless network card is available or no valid timezone is set"]="O no se dispone de tarjeta inal&Aacute;mbrica o no se ha establecido un timezone v&Aacute;lido";
$lang["Restore to folder"]="Restaura a carpeta";
$lang["Partitions"]="Particiones";
$lang["Connecting to tracker"]="Conectando a tracker";
$lang["Partition information"]="Informaci&oacute;n de particiones";
$lang["IP-address"]="direcci&oacute;n-IP";
$lang["BitTorrent"]="BitTorrent";
$lang["Upload complete"]="Subida finalizada";
$lang["Backup job scheduled"]="Planificada tarea de respaldo";
$lang["Add new download"]="A&ntilde;adir nueva descarga";
$lang["Every 6 hours"]="Cada 6 horas";
$lang["By Config"]="Por Config";
$lang["week"]="semana";
$lang["Browse"]="Visualizar";
$lang["Channel"]="Canal";
$lang["Never expires"]="Nunca expira";
$lang["Existing jobs"]="Tareas existentes";
$lang["Restore target dirctory missing"]="Falta directorio destino de restauraci&oacute;n";
$lang["Public port"]="Puerto p&uacute;blico";
$lang["Remove dir"]="Borrar directorio";
$lang["Remote user"]="Usuario remoto";
$lang["Squeezebox Server"]="Servidor Squeezebox";
$lang["DHCP leases"]="Concesiones DHCP";
$lang["Restoring backup history"]="Recuperando historial de respaldos";
$lang["Retreiving information started"]="Comienza la recuperaci&oacute;n de informaci&oacute;n";
$lang["Disk size"]="Tama&ntilde;o de disco";
$lang["Public port range accepted as start-port:stop-port"]="Rango de puerto p&uacute;blico aceptado como puerto-arranque:puerto-parada";
$lang["Email server"]="Servidor de correo";
$lang["Error reading jobsettings."]="Error leyendo especificaciones.";
$lang["Device"]="Dispositivo";
$lang["B3 start page"]="P&Aacute;gina inicial B3";
$lang["Step 2/3: Create users"]="Paso 2/3: Crear usuarios";
$lang["Cancel"]="Cancelar";
$lang["Target"]="Destino";
$lang["Error updating user access"]="Error autualizando acceso de usuario";
$lang["Disk capacity"]="Capacidad de disco";
$lang["Jobname missing"]="Falta nombre de tarea";
$lang["st"]="st";
$lang["Restoring file(s) from backupjob: "]="Recuperando fichero(s) de respaldo: ";
$lang["Maximum total upload is 2GByte."]="El total m&Aacute;ximo de subida es 2GBytes.";
$lang["Image updated"]="Imagen actualizada";
$lang["System partitions"]="Particiones del sistema";
$lang["Existing albums"]="&Aacute;lbumes existentes";
$lang["Host"]="Host";
$lang["Invalid IP"]="IP inv&Aacute;lida";
$lang["Downloader"]="Descargador";
$lang["These settings are locked"]="Esta configuraci&oacute;n est&Aacute; bloqueada";
$lang["Source IP"]="IP origen";
$lang["Retreiving package information"]="Recuperando informaci&oacute;n de paquetes";
$lang["Backup target settings undefined."]="Configuraci&oacute;n de destino del respaldo no definida.";
$lang["Retreiving information"]="Recuperando informaci&oacute;n";
$lang["Easyfind"]="Easyfind";
$lang["Extend Logical Volume"]="Extender Volumen L&oacute;gico";
$lang["Lease range end"]="Fin de rango de concesi&oacute;n";
$lang["User defined open / forwarded ports"]="Puertos abiertos / redirigidos definidos por usuario";
$lang["Location"]="Ubicaci&oacute;n";
$lang["Restore selection"]="Restaurar selecci&oacute;n";
$lang["Save settings"]="Salvar configuraci&oacute;n";
$lang["No backup medium found"]="No se encuentra medio de respaldo";
$lang["Job settings"]="Configuraci&oacute;n de tareas";
$lang["Setup wizard"]="Asistente de ajuste";
$lang["Next"]="Siguiente";
$lang["Private IP"]="IP privada";
$lang["Empty name not allowed"]="No se permite nombre en blanco";
$lang["Partition"]="Partici&oacute;n";
$lang["Router + Firewall + Server"]="Router + Firewall + Server";
$lang["This page should not be reached"]="Esta p&Aacute;gina no debe ser accesible";
$lang["Adding images is done using the"]="Se a&ntilde;aden im&Aacute;genes usando el";
$lang["Name not available or failed to validate request"]="Nombre no disponible o no puede validar la solicitud";
$lang["Restore missing files"]="Restaurar ficheros que faltan";
$lang["Album name"]="Nombre de &Aacute;lbum";
$lang["Status"]="Estado";
$lang["Select folder to exclude."]="Selecciona carpeta a excluir.";
$lang["Access allowed"]="Acceso permitido";
$lang["Disabled"]="Deshabilitado";
$lang["Username"]="Nombre de usuario";
$lang["Confirm key"]="Confirmar clave";
$lang["Image removed from album"]="Imagen eliminada del &aacute;lbum";
$lang["Use static IP address settings"]="Usar configuraci&oacute;n de IP est&Aacute;tica";
$lang["Th"]="Ju";
$lang["Viewer"]="Visitante";
$lang["Create empty album"]="Crear album vac&iacute;o";
$lang["Handle email for domain"]="Manejar el correo del dominio";
$lang["Email retrieval"]="Recuperaci&oacute;n de correo";
$lang["Run now"]="Ejecutar ahora";
$lang["DLNA streaming"]="Difusi&oacute;n DLNA";
$lang["Backup complete"]="Respaldo completo";
$lang["Obtain IP-address automatically"]="Obtener direcci&oacute;n IP autom&Aacute;ticamente";
$lang["MAC-address"]="MAC-address";
$lang["Squeezebox server isn't installed, please click"]="Servidor Squeezebox no instalado, por favor selecciona";
$lang["IP"]="IP";
$lang["Mo"]="Lu";
$lang["Done."]="Realizado.";
$lang["Exclude"]="Excluir";
$lang["Other"]="Otros";
$lang["Album updated"]="Album actualizado";
$lang["Back"]="Atr&Aacute;s";
$lang["Easyfind name"]="nombre Easyfind";
$lang["Run every week"]="Ejecutar semanalmente";
$lang["Update successful"]="Actualizaci&oacute;n efectuada";
$lang["Please enter a jobname to identify your backup job."]="Pon un nombre de tarea para identificar tu tarea de respaldo.";
$lang["your-easyfind-name"]="tu-nombre-easyfind";
$lang["Disconnect"]="Desconectar";
$lang["Private port is start port if public port range entered"]="El puerto private es puerto inicial si se intoduce rango p&uacute;blico";
$lang["Abort"]="Abortar";
$lang["Setup complete"]="Ajuste completado";
$lang["Delete album"]="Borrar album";
$lang["Backup and restore settings"]="Respaldar y restaurar la configuraci&oacute;n";
$lang["Delete backup job:"]="Borrar tarea de respaldo:";
$lang["no valid WAN port connection"]="Puerto de conexi&oacute;n WAN no v&Aacute;lido";
$lang["Read and write"]="Leer y escribir";
$lang["Included files"]="Ficheros inclu&iacute;dos";
$lang["Delete job"]="Borrar tarea";
$lang["Restore started"]="Iniciada recuperaci&oacute;n";
$lang["Change timezone"]="Cambiar timezone";
$lang["WWW"]="WWW";
$lang["Upload to"]="Subir a";
$lang["Leave copy"]="Dejar copia";
$lang["Restore user data"]="Recuperar datos de usuario";
$lang["Enable DNS service"]="Habilitar servicio DNS";
$lang["Partition label"]="Etiqueta de Partici&oacute;n";
$lang["with"]="con";
$lang["Traffic"]="Tr&Aacute;fico";
$lang["here"]="aqu&iacute;";
$lang["peers"]="peers";
$lang["Use plain text authentication"]="Usar autentificaci&oacute;n en texto claro";
$lang["Disk error"]="Error de disco";
$lang["wlan_title_band_2_4"]="wlan_title_band_2_4";
$lang["Destination folder"]="Carpeta destino";
$lang["YYYYMMDD"]="YYYYMMDD";
$lang["Invalid IP address"]="Direcci&oacute;n IP inv&Aacute;lida";
$lang["Sa"]="Sa";
$lang["Backup date"]="Fecha de respaldo";
$lang["Every hour"]="Cada hora";
$lang["Enable DHCP server"]="Habilitar servidor DHCP";
$lang["Image name"]="Nombre de imagen";
$lang["Unknown state"]="Estado desconocido";
$lang["Error updating album"]="Error actualizando album";
$lang["wlan_title_band_5_0"]="wlan_title_band_5_0";
$lang["Initializing"]="Inicializando";
$lang["Current package versions"]="Versiones actuales del paquete";
$lang["Current timezone is"]="El timezone actual es";
$lang["Settings updated successfully"]="Configuraci&oacute;n correctamente actualizada";
$lang["Target settings"]="Configuraci&oacute;n de Objetivo";
$lang["Protocol"]="Protocolo";
$lang["Connect"]="Conectar";
$lang["Network settings"]="Configuraci&oacute;n de red";
$lang["Error starting/stopping DNS service"]="Error arrancando/parando servicio DNS";
$lang["Excito"]="Excito";
$lang["Please select files to restore from the list of included files."]="Selecciona ficheros a restaurar de la lista de ficheros inclu&iacute;dos.";
$lang["Uptime"]="Uptime";
$lang["Invalid netmask"]="M&Aacute;scara inv&Aacute;lida";
$lang["Add entry"]="A&ntilde;adir entrada";
$lang["DAAP streaming"]="difusi&oacute;n DAAP";
$lang["Invalid DNS setting"]="Configuraci&oacute;n inv&Aacute;lida de DNS";
$lang["Type"]="Tipo";
$lang["Explain"]="Explicar";
$lang["Error updating user access to public"]="Error actualizando acceso de usuario a p&uacute;blico";
$lang["Mount path"]="Ruta de montaje";
$lang["Available"]="Disponible";
$lang["th"]="Ju";
$lang["Automatic network settings"]="Configuraci&oacute;n autom&Aacute;tica de red";
$lang["Hostname"]="Hostname";
$lang["Add"]="Add";
$lang["Server only"]="Servidor &uacute;nicamente";
$lang["Selecting a folder will also select all files within the folder."]="Seleccionar una carpeta tambi&eacute;n selecciona todos los ficheros inclu&iacute;dos.";
$lang["Error deleting album"]="Error borrando album";
$lang["The specified backupdisk is not attached."]="El disco de respaldo especificado no est&Aacute; conectado.";
$lang["Download failed"]="Descarga fallida";
$lang["(Not recommended, passwords will be sent unencrypted.)"]="(No recomendado, las contrase&ntilde;as se enviar&Aacute;n sin cifrar.)";
$lang["Checking existing files"]="Verificando ficheros existentes";
$lang["Job name"]="Nombre de tarea";
$lang["No local data found"]="No encontrados datos locales";
$lang["wizard-msg2"]="wizard-msg2";
$lang["disk"]="disco";
$lang["Timezone"]="Zona horaria";
$lang["No disks found"]="Disco no hallado";
$lang["Lease expires"]="Concesi&oacute;n expirada";
$lang["Exit setup"]="Salir de configuraci&oacute;n";
$lang["Local user"]="Usuario local";
$lang["Update"]="Actualizar";
$lang["Fr"]="Vi";
$lang["(Please read manual before enabling)"]="(Por favor, leer el manual antes de habilitar)";
$lang["Invalid gateway"]="Gateway inv&Aacute;lido";
$lang["filemanager"]="gestor de ficheros";
$lang["Existing users"]="Usuarios existentes";
$lang["Backup schedule"]="Planificaci&oacute;n de respaldo";
$lang[" for user: "]=" para usuario: ";
$lang["Remote"]="Remoto";
$lang["Anonymous FTP access"]="Acceso FTP an&oacute;nimo";
$lang["Encryption passwords do not match"]="Contrase&ntilde;as de cifrado no coinciden";
$lang["Done downloading (But missing data)"]="Finalizada la descarga (pero faltan datos)";
$lang["Include"]="Include";
$lang["Encryption key"]="Clave de encriptaci&oacute;n";
$lang["Album access rights updated"]="Actualizados permisos de acceso al Album";
$lang["Description"]="Descripci&oacute;n";
$lang["Current backup operations"]="Operaciones de respaldo actuales";
