<?

// External links

$lang["help_box_manual_link"] = NAME." Manual";
$lang["help_box_forum_link"] = "Foro";
$lang["help_box_excito_link"] = "Web de Excito";
$lang["help-box-further-info"] = "Recursos adicionales";

/*  ------------------- Texts to locate help pages.  -------------------*/
//General pages
$lang['help_stat']="?page=";
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


// Help box - Default page not logged in. AND logged in as standard user.
$lang['help_box_user_login']=$lang['help_box_user_index']="
<h3>Bienvenido a ".NAME."!</h3>
<p>Escucha m&uacute;sica, mira tus fotos, y accede a tus correos y ficheros. Tienes toda tu informaci&oacute;n importante y tu diversi&oacute;n a un click del rat&oacute;n!</p>
<p></p>
";

// Help box - Default page logged in as admin
$lang['help_box_login']=$lang['help_box_index']="
<h3>".NAME." administration</h3>
<p>Conectado como administrador tienes acceso a la configuraci&oacute;n del sistema. Pincha en <strong>gear wheel</strong> para administrar tu ".NAME.".</p>
<p>Utiliza la conexi&oacute;n de administrador para gestionar la configuraci&oacute;n de ".NAME.". Tu conexi&oacute;n habitual debe realizarse con otro usuario.</p>
";


// User pages
$lang['help_user_users']="?page=users.html#USERINFO";
$lang['help_user_mail']="?page=users.html#MAIL";
$lang['help_user_downloads']="?page=users.html#DOWNLOADS";
$lang['help_user_userinfo']="?page=users.html#USERINFO";
$lang['help_user_albums']="?page=users.html#PHOTOALBUM";


// Help box - Admin

$lang['help_box_stat']="
<h3>Estado</h3>
<p>Aqu&iacute; encontrar&aacute;s informaci&oacute;n sobre la utilizaci&oacute;n de espacio del disco, tiempo en marcha de ".NAME." y la versi&oacute;n de software instalado.</p>
<h3>System messages</h3>
<p>Las notificaciones importantes del sistema se muestran aqu&iacute;</p>
<p>El bot&oacute;n '<strong>Apagar</strong>' desconecta ".NAME." de la misma forma que apretando el interruptor trasero del equipo. Para iniciar de nuevo, presiona el interruptor trasero.</p>
<p>El bot&oacute;n '<strong>Reiniciar</strong>' rearranca ".NAME.".</p>
";

$lang['help_box_filemanager']=$lang['help_box_filemanager_cd']="
<p>Con el Administrador de archivos tiens la posibilidad de acceder a tus ficheros en ".NAME." incluso desde fuera de casa.</p>
<h3>Navegaci&oacute;n</h3>
<p>Accede a un carpeta mediante la flecha de la derecha o con un doble click, pasa al niver superior mediante la flecha de la izquierda o seleccionando la linea /home/usuario/.</p>
<h3>Acciones de fichero y carpeta</h3>
<p>Selecciona ficheros o carpetas y utiliza los icones en la barra de funciones para realizar diferentes acciones. Las funciones de izquierda a derecha son:</p>
<ul>
	<li>Crear carpeta</li>
	<li>Subir fichero</li>
	<li>Descargar como zip</li>
	<li>Mover ficheros</li>
	<li>Copiar ficheros</li>
	<li>Renombrar</li>
	<li>Cambiar permisos</li>
	<li>A&ntilde;adir a &aacute;lbum</li>
	<li>Eliminar</li>
</ul>
<h3>&aacute;lbum de fotos</h3>
<p>Conectado como administrador no puedes a&ntilde;adir fotos al &aacute;lbum de ".NAME.". Conecta con tu usuario estandar para a&ntilde;adir y gestionar tus fotos y tus &aacute;lbumes.</p>
";

	$lang['help_box_filemanager_backup']="
	<h3>Crea una copia de seguridad</h3>
	<ol>
    <li>Introduce un <strong>nombre de tarea</strong>para la copia de seguridad en el cuadro de texto a la izquierdathe left on the screen and click 'Create job'. La nueva tarea de respaldo queda resaltada autom&aacute;ticamente en la columna de 'Tareas existentes'.</li>
    <li>A&ntilde;ade los <strong>ficheros que quieres incluir</strong> en la tarea de respaldo seleccionando el bot&oacute;n 'Browse' bajo el men&uacute; de 'Carpetas inclu&iacute;das'. Las subcarpetas quedan a&ntilde;adidas autom&aacute;ticamente.</li>
    <li>Si hay ficheros en subcarpetas que quieras <strong>excluir</strong>, selecciona el bot&oacute;n 'Browse' bajo el men&uacute; de 'Carpetas exclu&iacute;das' y selecciona las no deseadas. </li>
    <li><strong>Selecciona destino </strong>para la tarea de respaldo seleccionando el men&uacute; desplegable a la derecha de 'Destino'. La carpeta destino ser&aacute; creada en caso de no existir previamente.</li>
		  <ul>
		    <li>Si eliges un disco local USB / eSATA tienes que seleccionar el 'Disco' mediante lista desplegable. Rellena la 'Carpeta destino' (p.e. 'mi_carpeta_respaldo\importante\') o d&eacute;jala en blanco para salvarlo en la carpeta ra&iacute;z.</li>
		    <li>Si eliges un SSH / FTP remoto tienes que rellenar 'Host' (p.e. una direcci&oacute;n-IP), 'Carpeta destino' (p.e. 'mi_carpeta_respaldo/importante/') o dejarlo en blanco para salvarlo en la carpeta ra&iacute;z remota, 'Usuario remoto' y 'Contrase&ntilde;a remota'.</li>
		  </ul>
    <li>Selecciona '<strong>Planificar respaldo</strong>' para establecer la hora e intensidad de ejecuci&oacute;n de la tarea. Selecciona tambi&eacute;n cuantos respaldos completos deben salvarse.</li>
    <li>Para incrementar la seguridad tienes la opci&oacute;n de<strong> encriptar la tarea de respaldo</strong>. Selecciona 'Seguridad de datos', 'Encriptar datos' y elige una clave de encriptaci&oacute;n.</li>
    <li>Selecciona 'Actualizar tarea' para salvar la configuraci&oacute;n.</li>
    <li>Para ejecutar la tarea inmediatemente, selecciona 'Ejecutar ahora'.</li>
  </ol>
	<h3>Restaurar un respaldo</h3>
	<p>Selecciona Restaurar en el men&uacute; para restaurar una copia de seguridad.</p>
	<h3>Sava tus tareas de respaldo</h3>
	<p>Como medida de seguridad, efect&uacute;a un copia de seguridad de la configuraci&oacute;n para salvar tus tareas de respaldo por si tienes que reinstalar tu ".NAME.". Selecciona <Strong>Configuraci&oacute;n</Strong> en el men&uacute; y luego <Strong>Configuraci&oacute;n de respaldo</Strong></p>
  ";

	$lang['help_box_filemanager_restore']="
	<h3>Restaurar un respaldo</h3>
	<ol>
    <li>Seleciona la tarea de respaldo que quieres restaurar bajo 'Restaurar datos de usuario'. </li>
    <li>Selecciona la 'Fecha de respaldo' de la que restaurar.</li>
    <li>Selecciona los ficheros y carpetas (con ficheros incluidos) que necesitas recuperar. Los ficheros que van a ser restaurados ser&aacute;n resaltados en azul.</li>
    <li>Elige de que manera quieres restaurar los ficheros: 'Restaura ficheros faltantes', 'Sobreescribe ficheros' o 'Restaura a carpeta'.</li>
    <li>Pulsa 'Restaura selecci&oacute;n'</li>
  </ol>
  ";

$lang['help_box_users']="
	<h3>Usuarios</h3>
	<p>Aqu&iacute; est&aacute;n todos los usuarios registrados en tu ".NAME.". Marca en 'Editar usuario' para cambiar la informaci&oacute;n del mismo.</p>
	<p>Para permitir al administrador acceso remoto (via el puerto WAN) edita el usuario administrador marca '<strong>Permitir acceso remoto a configuraci&oacute;n del sistema</strong>'.</p>
	<p><strong>Permitir conexi&oacute;n shell</strong> permite a un usuario conexi&oacute;n mediante SSH</p>

	<h3>A&ntilde;adir usuarior</h3>
	<p>Marca '<strong>A&ntilde;adir nuevo usuario</strong>' y rellena la informaci&oacute;n para a&ntilde;adir al nuevo usuario.</p>

	<h3>Editar usuario</h3>
	  <p><strong>Nombre de usuario</strong> - No se puede cambiar el nombre de usuario (nombre de conexi&oacute;n). Para realizarlo tienes que borrar el usuario y a&ntilde;adir uno nuevo conel nombre correcto.</p>
	  <p><strong>Nombre real</strong> - Para a&ntilde;adir el aut&eacute;ntico nombre del usuario; rellena &eacute;sta informaci&oacute;n.</p>
	  <p><strong>Cambiar contrase&ntilde;a</strong> - El administrador puede cambiar la contrase&ntilde;a de todos los usuarios. Cada usuario puede cambiar su propia contrase&ntilde;a una vez conectado. Se sugiere v&iacute;vamente que la <strong>contrase&ntilde;a de admin se cambie</strong> en lugar de la 'por defecto'.</p>
		<p><strong>Idioma de usuario</strong> - Cambia el idioma de la interface para el usuario seleccionado.</p>

";

$lang['help_box_services']="
	<h3>File sharing</h3>
  <p><strong>FTP</strong> - El servidor FTP de ".NAME.".</p>
  <p><strong>Acceso FTP an&oacute;nimo</strong>  - Permite conexi&oacute;n de usuarios al servidor FTP sin contrase&ntilde;a.</p>
  <p><strong>AFP</strong> - El Apple Filing Protocol (AFP) es un protocolo de red que ofrece servicios de fichero para Sistemas Mac OS.</p>
	<p><strong>Samba</strong> - Samba se utiliza para compartir ficheros e impresoras en una red Windows.</p>
	<h3>Difusi&oacute;n</h3>
	<p><strong>Difusi&oacute;n UPnP</strong> - Servidor para Universal Plug and Play (UPnP). Comparte/difunde datos como audio/video/fotos/ficheros a clientes-UPnP en la red. Ojo, si te encuentras en una red no segura, desabilita UPnP porque todo el sistema puede navegarse mediante la interface web de Mediatomb, lo que puede ser un riesgo de seguridad. </p>
	<p><strong>Difusi&oacute;n DAAP</strong> - Servidor para Digital Audio Access Protocol (DAAP). Sirve media para el Roku SoundBridge e iTunes.</p>
	<p><strong>Servidor Squeezebox</strong>- es un servidor de difusi&oacute;n de audio soportado por Logitech que difunde m&uacute;sica a los productos Squeezebox.</p>
	<h3>Correo</h3>
	<p><strong>Enviar y recibir</strong> -  Para el servidor smtp de postfix: Env&iacute;o y recepti&oacute;n de correos electr&oacute;nicos.</p>
	<p><strong>IMAP</strong> - Para el servidor IMAP dovecot. Se requiere para que funcione el acceso webmail.</p>
	<p><strong>Recuperaci&oacute;n de correos</strong>- Para fetchmail, un demonio que recolecta correos electr&oacute;nicos para ".NAME."</p>
	<h3>Otros</h3>
	<p><strong>Impresi&oacute;n</strong> - servidor de impresi&oacute;n en ".NAME.".</p>
	<p><strong>Carga y descarga</strong> - posibilita subir / descargar ficheros en ".NAME.", p.e. enlaces y torrents.</p>
";

$lang['help_box_mail']=$lang['help_box_mail_index']="
	<h3>Correo</h3>
	<p>".NAME." recupera tu correo de todas tus diferentes cuentas que tengas. El correo se almacena en ".NAME." y est&aacute; disponible via IMAP o webmail, est&eacute;s donde est&eacute;s.</p>
	<p>Muestra las cuentas de correo activas.</p>
	<h3>Configura ".NAME." para recuperar correo electr&oacute;nico</h3>
	<p><strong>A&ntilde;ade nueva cuenta de correo</strong> - Para comenzar a descargar el correo desde una cuenta externa, entra aqu&iacute;. Rellena la informaci&oacute;n facilitada por tu proveedor de correo.</p>
	<p>Debes seleccionar a que usuario dirigir el correo descargado, en cada una de las cuentas de correo a&ntilde;adidas. Previamente has debido a&ntilde;adir un usuario a ".NAME.".</p>

";

$lang['help_box_mail_server_settings']="
	<h3>Servidor de correo</h3>
  <p>Deja campos en blanco para que ".NAME." gestione tu correo saliente. Si tu ISP bloquea tu tr&aacute;fico saliente en el puertoon port 25 debes utilizar un servidor SMTP alternativo, rellena la informaci&oacute;n suministrada por tu ISP.</p>
	<h3>Dominio de correo</h3>
	<p>Si tienes tu propio nombre de dominio ".NAME." manejara tu correo entrante y saliente.</p>
	<p><strong>Maneja correo del dominio</strong> - Pon tu nombre de dominio aqu&iacute;. Si tienes varios dominios, tecl&eacute;alos separados por espacios.</p>
";


$lang['help_box_network']=$lang['help_box_network_profile']=$lang['help_box_update_profile']="
	<h3>Perfil de red</h3>
  <p>La configuraci&oacute;n autom&aacute;tica funcionar&aacute; en la mayor&iacute;a de los casos, y no necesitar&aacute;s cambiar esto. Lee el manual t&eacute;cnico si necesitas mayor informaci&oacute;n.</p>
	<p><strong>Configuraci&oacute;n de red autom&aacute;tica</strong> - ".NAME." intentar&aacute; establecer una configuraci&oacute;n de red adecuada.</p>
	<p><strong>Router + Firewall + Servidor</strong> - ".NAME." obtendr&aacute; autom&aacute;ticamente la configuraci&oacute;n de red para WAN (internet), y utiliza configuraci&oacute;n de red fija en la red local poveyendo otros equipos con con informaci&oacute;n de red.</p>
	<p><strong>Servidor &uacute;nicamente</strong> - ".NAME." obtendr&aacute; autom&aacute;ticamente la configuraci&oacute;n de red para LAN (local network) y el puerto WAN debe quedar desconectado.</p>
	<p>Tras editar la configuraci&oacute;n de red puede ser necesario reiniciar tus ordenadores y otros dispositivos de tu LAN.</p>
	<p><i>Actualiza</i> salva tus cambios.</p>
";

$lang['help_box_network_wan']="
	<h3>WAN</h3>
	<p>Aqu&iacute; se configura como tu ".NAME." maneja tu puerto Wide Area Network (WAN). La configuraci&oacute;n por defecto es Obtener una direcci&oacute;n IP.</p>
	<p><strong>Obtain IP-address automatically (DHCP)</strong> - El protocolo DHCP automatiza la asignaci&oacute;n de direcciones IP, m&aacute;scaras, gateways, y otros par&aacute;metros IP. Usa esta opci&oacute;n si tu proveedor de internet requiere que utilices DHCP. El la opci&oacute;n por defecto y la m&aacute;s habitual.</p>
	<p><strong>Usa configuraci&oacute;n est&aacute;tica de IP</strong> - Direcci&oacute;n IP, Netmask, Gateway y DNS primario se asignan manualmente a ".NAME." por el administrador. Usa esta opci&oacute;n si tu proveedor de internet requiere que introduzcas los valores manualmente.</p>
  <p>Observa que la configuraci&oacute;n de WAN no es editable el el perfil 'Configuraci&oacute;n autom&aacute;tica de red', mostrada como informaci&oacute;n.</p>
	<p><i>Actualiza</i> salve tus cambios.</p>
";

$lang['help_box_network_lan']="
	<h3>LAN</h3>
	<p>Aqu&iacute; configuras como acceder a ".NAME." desde ordenadores en tu LAN. Tu ".NAME." tiene una funci&oacute;n de autodetecci&oacute;n en el puerto LAN. Esto significa que al conectarse, ".NAME." buscar&aacute; un servidor DHCP en la LAN. Si encuentra un servidor DHCP, ".NAME." se autoconfigura para obtener una direcci&oacute;n IP en el puerto LAN. Si no encuentra servidor DHCP, ".NAME." establecer&aacute; la direcci&oacute;n IP est&aacute;tica <strong>192.168.10.1</strong>. </p>
	<p><strong>Obtener direci&oacute;n IP autom&aacute;ticamente</strong> - Usa esta opci&oacute;n si utilizas otro servidor DHCP que ".NAME." en tu LAN, por ejemplo un router o gateway. ".NAME." obtendr&aacute; una direcci&oacute;n IP autom&aacute;ticamente.</p>
  <p><strong>Usar configuraci&oacute;n IP est&aacute;tica</strong>Tu ".NAME." es accesible en esta direcci&oacute;n IP en tu LAN. La IP &uacute;ltimo recurso es: <a href='http://192.168.10.1' target='_blank'>192.168.10.1</a>.</p>
  <ul>
	<li><strong>Habilitar servicio DNS</strong> - The Domain Name System (DNS) translates domain names into IP addresses. Cuando entras un nombre de dominio, el servidor DNS traduce el nombre a la direcci&oacute;n IP correspondiente. </li>
    <li><strong>Enable DHCP server</strong> - El servidor DHCP facilita direcciones IP cuando un dispositivo, conectado al puerto LAN de ".NAME.", se inicializa y solicita una direcci&oacute;n IP. El dispositivo debe estar configurado como un cliente DHCP para 'Obtener direcci&oacute;n IP autom&aacute;ticamente'.</li>
    <li><strong>Rango de pr&eacute;stamo</strong> - El pool de direcciones DHCP(Lease range) contiene el rango de las direcciones IP que ser&aacute;n asignadas autom&aacute;ticamente a los clientes (por ejemplo ordenadores, difusores de media) en la red.</li>
  </ul>
  <p><strong>Permitir frames Jumbo</strong> - Esta opci&oacute;n habilita la transmisi&oacute;n de mayores bloques de datos soble la interface LAN. <strong>PRECAUCION</strong> - esto requiere que todo el equipamiento de la LAN trabaja en este entorno. Usar con cuidado. Si es as&iacute;, esta opci&oacute;n puede mejorar el rendimiento de la transferencia de ficheros entre ".NAME." y los dispositivos con capacidad Gigabit.</p>
	<p><strong>DHCP leases </strong>- Muestra los actuales dispositivos de red en tu LAN que tienen ".NAME." como tu router. Si varios dispositivos de red tienen el mismo hostname, el &uacute;ltimo conectado se ver&aacute; como un *.</p>
	<p>Observa que la configuraci&oacute;n de LAN no es editable en el perfil 'Configuraci&oacute;n autom&aacute;tica de red', es mostrada a nivel informativo.</p>
	<p><i>Actualiza</i> salva tus cambios.</p>
";

$lang['help_box_network_wlan']="
	<p>".NAME." can act as your access point, both in 'Router + Firewall + Server' or in 'Server only' mode.</p>
	<h3>Inal&aacute;mbrico</h3>
  <p><strong>Punto de acceso inal&aacute;mbrico</strong> - Switch to enable the wireless access point in ".NAME.".</p>
  <p><strong>Nombre de red (SSID)</strong> - This is the name that identifies a particular wireless network. The SSID can be up to 32 characters long.</p>
  <p><strong>Contrase&ntilde;a</strong> - La contrase&ntilde;a (o palabra de paso) es un conjunto de carac&eacute;res que deben coincidir tanto en tu ".NAME." como en tu cliente de red. Introduce la contrase&ntilde;a en caracteres ASCII. La longitud debe estar entre 8 a 63 para WPA y 5 o 13 caract&eacute;res para WEP.</p>
  <h3>Configuraci&oacute;n inal&aacute;mbrica avanzada</h3>
  <p><strong>Band </strong>- Elige la banda de frecuencia a utilizar. 802.11n opera en dos frecuencias: 5 GHz y 2.4 GHz. S&oacute;lo los dispositivos que operan en la misma banda de frecuencia pueden comunicarse entre s&iacute;.</p>
  <p><strong>Modo </strong>- Selecciona en que modo 802.11 operar. Los modos son los siguientes: 'Modo compatibilidad (802.11a/g)' - hasta 54 Mbit/s y 'Modo mixto (802.11n + 802.11a/g)' - hasta 300 Mbit/s.</p>
  <p><strong>Amplitud de canal </strong>- El ratio de transferencia m&aacute;ximo para 20 MHz es 130 Mbit/s. Para 40 MHz es 270 Mbit/s.</p>
  <p><strong>Encriptaci&oacute;n </strong>- Elige entre WEP, WPA1 or WPA2. WEP no se recomienda debido a su baja seguridad.</p>
  <p><strong>Canal </strong>- Selecciona el canal de tu punto de acceso inal&aacute;mbrico en ".NAME.". En zonas con muchas redes inal&aacute;mbricas, se pueden experimentar velocidades de trasferencia menores. En ese caso prueba con un canal diferente. La disponibilidad de canales difiere debido a las regulaciones de los distintos pa&iacute;ses.</p>
  <p><strong>Difusi&oacute;n de SSID </strong>- Mostrar u ocultar el SSID de ".NAME." a los dispositivos inal&aacute;mbricos. Por defecto el se muestra el SSID.</p>
  <p><i>Update</i> salva tus cambios.</p>
";

$lang['help_box_network_fw']="
	<p>".NAME." tiene integrado un cortafuegos para proteger tu red interna y al mismo ".NAME.".</p>
	<h3><strong>Permitir servicios de acceso externo (WAN) a ".NAME."</h3>
  <p><strong>SSH (Puerto 22)</strong> - Permite Secure Shell (SSH) a ".NAME." desde WAN.</p>
  <p><strong>Servidor de correo (Puerto 25)</strong> - Permite el acceso desde WWW al puerto 25 de ".NAME.". Es el puerto del servidor de correo por defecto para enviar y recibir correos.</p>
  <p><strong>WWW (HTTP / HTTPS Puertos 80 / 443)</strong> - Permite tr&aacute;fico WWW hacia ".NAME." desde WAN.</p>
  <p><strong>Correo (IMAP / IMAPS Puertos 143 / 993)</strong> - Permite acceso desde WWW a los puertos 143 y 993 de ".NAME.". Estos puertos se utilizan para enviar y recibir correo.</p>
  <p><strong>FTP (Puerto 21)/strong> - Permite conexiones FTP desde WAN al puerto 21 de ".NAME.".</p>
  <p><strong>Descargador (Puertos 10000-14000)</strong> - Permite acelerar la descarga de torrents. Esta regla abre los puertos 10000-14000.</p>
  <p><strong>Responder a ping (ICMP tipo 8)</strong> - Permite el ping desde WAN. La configuraci&oacute;n por defecto impide que las computadoras de internet obtengan respuesta desde ".NAME." cuando esta siendo 'pingado'. Esto incrementa la seguridad.</p>
  <h3>Configuraci&oacute;n avanzada del cortafuegos</h3>
	<p>Elige 'Redirige puerto a red interna' o 'Abrir puerto ".NAME."|2' con los selectores. El primero abrir&aacute; un puerto desde Internet (WAN) a un dispositivo de tu red interna (LAN). El &uacute;ltimo abrir&aacute; un puerto desde  Internet (WAN) a ".NAME.".</p>
	<p><strong>IP origen</strong> - La direcci&oacute;n IP origen en el lado WAN a la que apuntar&aacute; la redirecci&oacute;n. Entra 'todos' si la redirecci&oacute;n no est&aacute; restringida a una direcci&oacute;n IP espec&iacute;fica.</p>
  <p><strong>Puerto p&uacute;blico</strong> - El n&uacute;mero de puerto en el lado WAN. Puedes poner un puerto &uacute;nico o un rango de puertos (p.e. 4001:4005).</p>
  <p><strong>Puerto privado</strong> - El n&uacute;mero de puerto en el lado LAN. Entra un &uacute;nico puerto de comienzosi se utiliza rango en el Puerto p&uacute;blico (p.e. 4001).</p>
  <p><strong>IP privada</strong> - La IP destino en la red LAN que va a dispensar los servicios virtuales (redirecci&oacute;n de puerto deseada).</p>
  <p><strong>Protocolo</strong> - El protocolo utilizado por el servicio virtual: TCP or UDP.</p>
  <h3>Puertos abiertos / redirigidos definidos por el usuario</h3>
	<p>Aqu&iacute; se muestran las redirecciones habilitadas. Pulsa en el s&iacute;mbolo de l&aacute;piz a la derecha de la regla para editar la redirecci&oacute;n del puerto. Pulsa la x roja a la derecha de la regla para eliminar la redirecci&oacute;n del puerto.</p>
  <p><i>Update</i> salva tus cambios.</p>
";

$lang['help_box_disk']="
	<h3>Disco</h3>
	<p>Aqu&iacute; se muestra el estado de los discos interno y externo y dispositivos de almacenamiento. Cuando se inserta un nuevo dispositivo debes pulsar 'Conectar' para poder utilizar el dispositivo.</p>
	<p><strong>Informaci&oacute;n de disco</strong> - Muestra nombre de disco, tama&ntilde;o, tipo y disposici&oacute;n gr&aacute;fica de las particiones.</p>
	<p><strong>Informaci&oacute;n de partici&oacute;n</strong> - Descripci&oacute;n de las particiones.</p>
	<h3>Discos externos</h3>
	<p><strong>Conectando</strong></p>
	<ol>
	<li>Inserta un disco externo, USB o disco eSATA.</li>
	<li>Pulsa '<strong>Conectar</strong>' a la derecha de la partici&oacute;n que quieres conectar</li>
	<li>Ahora tienes acceso a tus ficheros en el cat&aacute;logo 'storage/extern'o utilizando por ejemplo el explorador Windows.</li>
  </ol>
  <p><strong>Desconectando</strong></p>
  <ol>
	<li>Cuando quieras extraer el disco externo, USB o disco eSATA debes hacer antestclic en 'Desconectar' para asegurar de que es seguro extraer el dispositivo.</li>
	<li>Entonces desconecta el cable.</li>
	</ol>
";

$lang['help_box_disk_lvm']="
	<h3>Ampliando tu disco</h3>
	<p>Amplia tu partici&oacute;n home conectando un disco externo. Esto crear&aacute; un &uacute;nico volumen l&oacute;gico de la partici&oacute;n home interna y el disco adjunto. En otras palabras, percibir&aacute;s un &uacute;nico disco grande en lugar de dos mas peque&ntilde;os. El tama&ntilde;o total de disco ser&aacute; el tama&ntilde;o del disco externo a&ntilde;adido al tama&ntilde;o de la partici&oacute;n home.</p>

	<h3>Precauci&oacute;n</h3>
	<p><strong>Por favor se consciente de que esta es una operaci&oacute;n no reversible. Una vez que tu sistena ha sido ampliado junto con el disco externo, &eacute;ste siempre necesita la conexi&oacute;n del disco externo y no funcionar&aacute; sin &eacute;l. Para poder volver a utilizar tu ".NAME." independientemente de nuevo, deber&aacute;s reinstalar todo el sistema.</strong></p>
  <p><strong>Un disco tipo LVM ser&aacute; conectado autom&aacute;ticamente e inclu&iacute;do  en el sistema ".NAME." para el arranque, incluso aunque no hayas configurado tu ".NAME." para una extensi&oacute;n LVM. Es imposible eliminar la extensi&oacute;n sin  reinstalaci&oacute;n. Para formatear un disco tipo LVM extendido, conecta el disco a un ".NAME." que est&eacute; arrancado. Entonces elige 'Formatear' en el men&uacute; 'Informaci&oacute;n-&gt;de disco'.</strong></p>

	<h3>Crear disco extendido (LVM)</h3>
	<ol>
	<li>Insertar un disco externo, USB o eSATA. Aseg&uacute;rate de que el disco est&eacute; preformateado, sin anteriores sistemas  RAID o LVM.</li>
	<li>Selecciona la 'partici&oacute;n Home' y la partici&oacute;n del disco externo (por ejemplo /dev/sdb). </li>
	<li>Haz clic 'Ampliar partition'.</li>
	<li>Espera a que la barra de progreso finalice.</li>
	<li>Una vez terminado, tu sistema ha sido ampliado junto con el disco externo.</li>
  </ol>
  <h3>Eliminar disco extendido (LVM)</h3>
	<p>Para eliminar el disco extendido (LVM) de tu sistema debes resintalar el sistema completo.</p>
";

$lang['help_box_disk_raid']="
	<p>La funci&oacute;n RAID en ".NAME." combina la partici&oacute;n /home y un disco duro externo en una &uacute;nica unidad l&oacute;gica.</p>

	<h3>Importante</h3>
	<ul>
		<li><strong>&iexcl;Precauci&oacute;n!</strong> El proceso destruir&aacute; todos los datos de usuario - tanto en el disco interno como en el externo.</li>
		<li>Un disco RAID antigüo ser&aacute; conectado autom&aacute;ticamente e inclu&iacute;do en el sistema ".NAME." en el arranque, incluso aunque no hayas configurado tu ".NAME." para una extensi&oacute;n RAID. Es imposible eliminar la extensi&oacute;n sin reinstalaci&oacute;n. Para formatear un disco externo RAID antigüo, conecta el disco a un sistema ".NAME." ya arrancado. Entonces elige 'Formatear' en el men&uacute; 'Informaci&oacute;n -&gt; de disco' menu.</li>
	<li>Para sacar el mejor rendimiento a tus discos, utiliza un disco externo del mismo tama&ntilde;o que tu disco interno en ".NAME.".</li>
	<li>La capacidad total del conjunto es igual a la capacidad del menor de los discos del grupo.</li>
	<li>Lleva un cierto tiempo crear o restaurar un grupo RAID. Para un disco de 1TB puede llevar unas 4 horas. Esto se ejecuta en el interior del sistema ".NAME." y no ser&aacute; mostrado al usuario.</li>
	<li>Para vulver a utilizar tu ".NAME." de forma aut&oacute;noma sin la configuraci&oacute;n RAID deber&aacute;s reinstalar tu sistema ".NAME.".</li>
  </ul>

  <h3>Crear grupo RAID</h3>
	<ol>
	<li>Inserta un disco eSATA. Aseg&uacute;rate de que el disco est&eacute; preformateado, sin antigüos sistemas RAID o LVM.</li>
	<li>Haz clic en 'Crear grupo RAID'</li>
	<li>Selecciona el disco externo a incluir en el grupo.</li>
	<li>&iexcl;Precauci&oacute;n! Todos los datos de ambos discos ser&aacute;n borrados. Haz clic en 'Crear RAID'.</li>
	<li>Espera a que se completa la barra de progreso. Ten paciencia, llevar&aacute; alg&uacute;n tiempo crear un grupo RAID si est&aacute;s utilizando discos grandes.</li>
	<li>Cuando finalice, tu disco externo habr&aacute; sido inclu&iacute;do en tu grupo RAID.</li>
  </ol>

  <h3>Estado del RAID</h3>
	<p><strong>Lista de grupos RAID</strong> - muestra el espacio en disco total, p.e. el del menor disco disponible (la partici&oacute;n /home  ".NAME." o el disco externo eSATA) del conjunto.</p>
  <p><strong>Lista de discos RAID</strong> - muestra los discos agregados al grupo RAID.</p>

	<h3>Recuperar un disco externo</h3>
	<p>Si tienes un fallo de disco en tu unidad externa o si has desconectado por error el disco externo debes hacer lo siguiente.</p>
	<ol>
    <li>Desconecta el disco externo averiado de la trasera de ".NAME.".</li>
    <li>Inserta un nuevo disco externo (o reconecta el desconectado por error).</li>
    <li>Haz clic en '<strong>Recupera grupo RAID</strong>'.</li>
    <li>Selecciona el disco externo a a&ntilde;adir al grupo RAID. Haz clic en 'Recuperar grupo'.</li>
    <li>&iexcl;Precauci&oacute;n! Todos los datos del disco externo ser&aacute;n borrados. Haz clic en 'Recuperar grupo'.</li>
    <li>Pulsa 'Cerrar' para continuar trabajando con ".NAME.". La sincronizaci&oacute;n est&aacute; en progreso y llevar&aacute; un rato.</li>
  </ol>

  <h3>Recuperar un disco interno</h3>
	<p>Si tienes un fallo de tu disco interno en ".NAME." tienes que comenzar por cambiar el disco y reinstalarlo mediante una memoria USB. Despu&eacute;s actualiza ".NAME." al software m&aacute;s reciente.</p>
	<ol>
		<li>Inserta el disco RAID externo que contiene tus datos.</li>
	<li>Haz clic en '<strong>Recuperar grupo RAID</strong>'.</li>
	<li>Selecciona el disco externo para agregar al grupo RAID. Haz clic en 'Recuperar grupo'.</li>
	<li>&iexcl;Precauci&oacute;n! Todos los datos de usuario y el &aacute;rea storage ser&aacute;n borrados del disco interno disco. Haz clic en 'Recuperar grupo'.</li>
	<li>Pulsa 'Cerrar' para continuar trabajando con ".NAME.". La sincronizaci&oacute;n est&aacute; en progreso y le llevar&aacute; un buen rato.</li>
  </ol>

";

$lang['help_box_printing']="
<h3>Servidor de impresi&oacute;n</h3>
<p>Con el Servidor de Impresi&oacute;n tienes una manera f&aacute;cil y c&oacute;moda de acceder a la impresora. ".NAME." te facilita una manera m&aacute;s eficiente de usas la impresora en tu casa- o en la red de tu oficina. El servidor de impersi&oacute;n permite a m&uacute;ltiples usuarios compartir una impresora desde cualquier punto de la red sin compartir un PC. S&oacute;lo necesitas una impresora USB y sus drivers.</p>
<h3>Instalaci&oacute;n</h3>
<ol>
  <li>Conecta tu impresora USB a la entrada USB de ".NAME.".</li>
  <li>Pulsa 'A&ntilde;adir nueva impresora'.</li>
  <li>Se muestra el nombre de la impresora, y a&ntilde;adeadd this impresora and fill out  the requested information.</li>
  <li>Desde tu PC, navega mediante samba (mediante el Explorador de Windows) a <a href='file:///\\".NAME."\'>\\".NAME."\</a>. </li>
  <li>La impresora aparecer&aacute; junto a las carpetas home y storage. Haz doble clic en el icono de la impresora.  </li>
  <li>Se te pedir&aacute; el driver de la impresora, sigue las instrucciones e instala la impresora. Una vez realizado, la  impresora est&aacute; lista para usar. Repite los pasos 4 a 6 para todos los ordenadores que utilicen la impresora.</li>
</ol>
";

$lang['help_box_settings']=$lang['help_box_settings_startwizard']="
<h3>Asistente de configuraci&oacute;n</h3>
<p>Utiliza el asistente de configuraci&oacute;n integrado para establecer la configuraci&oacute;n inicial de tu ".NAME." tal como idioma, hora y fecha, a&ntilde;adir usuarios y elegir un nombre Easyfind. Puedes ejecutar el asistente en cualquier momento.</p>
<p><strong>Paso 1 - Selecciona el idioma por defecto</strong></p>
<p>Selecciona el idioma por defecto del sistema. Haz clic en 'Siguiente' para continuar.</p>
<p><strong>Paso 2 - Hora y fecha</strong></p>
<p>Elije el huso horario y la fecha y hora. Tambi&eacute;n tienes la posibilidad de utilizar un servidor de hora de Internet. De esta manera la fecha y hora se establece y actualiza autom&aacute;ticamente y no tienes que realizar ajustes manuales. Haz clic en 'Siguiente' para continuar.</p>
<p><strong>Paso 3 - Crear usuarios</strong></p>
<p>Crea un usuario, o tantos como desees. Haz clic en 'A&ntilde;adir usuario' tras rellenar la informaci&oacute;n de usuario. Haz clic en 'Siguiente' para continuar.</p>
<p><strong>Paso 4 - Configuraci&oacute;n de red</strong></p>
<p>Elige si quieres register un nombre Easyfind gratu&iacute;to. Podr&aacute;s acceder a ".NAME." navegando a www.-tu nombre easyfind-.myown".NAME.".com. Haz clic en 'Siguiente' para continuar.</p>
<p><strong>Configuraci&oacute;n finalizada</strong></p>
<p>Haz clic en 'Terminar configuraci&oacute;n' para salir del asistente.</p>
";

$lang['help_box_settings_identity']="
<h3>Identidad del sistema</h3>
<p><strong>Hostname</strong> - es el nombre &uacute;nico por el que un dispositivo conectado a la red es conocido en la misma.</p>
<p><strong>Grupo de trabajo</strong> - Los dispositivos del mismo grupo de trabajo pueden permitir mutuo acceso a sus ficheros, impresoras, o conexi&oacute;n a Internet. Utiliza el mismo nombre de grupo de trabajo en ".NAME." que en tus ordenadores.</p>
<h3>Opciones Easyfind</h3>
<p><strong>Utiliza 'Easyfind' para localizar tu ".NAME."</strong> - Usando nuestro servicio gratu&iacute;to Easyfind podr&aacute;s acceder a tu ".NAME." dondequiera que est&eacute;s. Encontrar&aacute;s tu ".NAME." desde cualquier parte tecleando www.-tu nombre easyfind-.myown".NAME.".com.</p>
<p><strong>Nombre Easyfind</strong> - Elige un nombre para tu ".NAME." en la red Easyfind.</p>
";

$lang['help_box_settings_trafficsettings']="
<h3>Tr&aacute;fico</h3>
<p>Para controlar la m&aacute;xima velocidad de subida / descarga de tus torrents ajusta la configuraci&oacute;n de 'Tr&aacute;fico'.</p>
<p>Por ejemplo, si tienes una conexi&oacute;n de banda ancha limitada no querr&aacute;s agotar completamente tu capacidad de subida. Establece la 'Velocidad m&aacute;xima de subida' al valor preferido. Utiliza 'velocidad m&aacute;xima de descarga' de la misma manera.</p>
<p>Usando el valor -1 = sin l&iacute;mite de velocidad.</p>
<p><i>Actualizar</i> salva tus cambios.</p>
";

$lang['help_box_settings_datetime']="
<h3>FEcha y hora</h3>
<p><strong>Actual huso horario</strong> - Muestra el uso horario selecionado.</p>
<p><strong>Selecciona horo horario</strong> - Selecciona tu huso horario en la lista desplegable.</p>
<p><strong>Establece la hora autom&aacute;ticamente</strong> - Esto permite a ".NAME." establecer la fecha y hora a trav&eacute;s de un servidor de internet.</p>
<p><strong>Fecha</strong> - Establece manualmente la fecha del sistema.</p>
<p><strong>Hora</strong> - Establece manualmente la hora del sistema.</p>
<h3>Idioma por defecto</h3>
<p><strong>Idioma del sistema</strong> - Selecciona idioma para la interface de usuario.</p>
";

$lang['help_box_settings_backuprestore']=$lang['help_box_settings_backup']=$lang['help_box_settings_restore']="
<h3>Configuraci&oacute;n de Respaldo y recuperaci&oacute;n</h3>
<p>'Configuraci&oacute;n de respaldo' respaldar&aacute; toda la configuraci&oacute;n de tu ".NAME.", resulta muy &uacute;til en caso de que tengas que reinstalar ".NAME." o muevas la configuraci&oacute;n a otra unidad ".NAME.". Se salva la siguiente configuraci&oacute;n :</p>
<ul>
  <li>Cuentas de usuario (incluyendo conexi&oacute;n de admin mediante WAN, contrase&ntilde;as) pero no datos de usuario</li>
  <li>Tareas de respaldo</li>
  <li>Configuraci&oacute;n de servicios</li>
  <li>Configuraci&oacute;n de cuentas de correo</li>
  <li>Ajustes de red (toda la configuraci&oacute;n p.e. perfil, hostname, configuraci&oacute;n inal&aacute;mbrica, reglas de cortafuefos etc)</li>
  <li>Impresoras</li>
</ul>
<h3>Realizar un respaldo</h3>
<ol>
  <li>Inserta un dispositivo de almacenamiento externo (memoria USB o disco USB) en ".NAME.". </li>
  <li>Elige la Fuente/Destino y pulda Respaldo. </li>
  <li>Toda la configuraci&oacute;n queda salvada en un fichero del almacenamiento externo elegido. </li>
</ol>

<h3>Restaurar un respaldo</h3>
<ol>
  <li>Inserta el dispositivo de almacenamiento que contiene el fichero de respaldo en ".NAME.".</li>
  <li>Observa que los actuales usuarios en ".NAME." ser&aacute;n eliminados y los usuarios almacenados en el fichero de respaldo ser&aacute;n restaurados. Aunque los datos de usuario de los usuarios actuales en ".NAME." permanecer&aacute;n intactos en el cat&aacute;logo /home/[usuario].</li>
  <li>Pulsa restaurar. </li>
  <li>Puede que tengas que reconectar tu ".NAME." en funci&oacute;n de la configuraci&oacute;n de red restaurada.</li>
 </ol>
";

$lang['help_box_settings_software']="
<h3>Actualizaci&oacute;n de software</h3>
<p>El software de ".NAME." puede ser actualizado f&aacute;cilmente para obtener nuevas funcionalidades. Pulsa 'Actualizar sistema', y la actualizaci&oacute;n se realiza autom&aacute;ticamente. Por favor ten paciencia, puede llevar un rato realizar una actualizaci&oacute;n.</p>
<p>Tras la actualizaci&oacute;n, se muestra informaci&oacute;n de estado. Pulsa el signo '+' para mostrar el mensaje completo.</p>
<h3>Parches</h3>
<p>Esta opci&oacute;n recoge informaci&oacute;n de estado de tu ".NAME." y la env&iacute;a a Excito para un an&aacute;lisis automatizado. El servidor de actualizaciones puede decidir las acciones adecuadas si tu sistena tiene problemas. La informaci&oacute;n del sistema se env&iacute;a a Excito mediante una conexi&oacute;n cifrada, y las respuestas del servidor se certifican con GPG para asegurar que el contenido es distribu&iacute;do por Excito.</p>
<p>Por defecto &eacute;sta facilidad est&aacute; activada. Utiliza el interruptor para desactivar los Parches. En este caso puede que no obtengas actualizaciones primordiales para tu ".NAME.". </p>
<p><strong>Cualquier informaci&oacute;n recogida por Excito no se facilitar&aacute; nunca a otra compa&ntilde;ia distita de Excito. La informaci&oacute;n solo se utilizar&aacute; para recabar errores y facilitar las actualizaciones m&aacute;s pertinentes para tu ".NAME.".</strong></p>
<p>Abajo se lista toda la informaci&oacute;n recogida.</p>
<ul>
  <li>Direcci&oacute;n MAC</li>
  <li>Direcciones IP</li>
  <li>N&uacute;mero de serie y clave</li>
  <li>Tama&ntilde;o de memoria RAM</li>
  <li>Modelo de CPU</li>
  <li>Estado de los paquetes instalados espec&iacute;ficamente en ".NAME."</li>
  <li>El fichero de log /tmp/".NAME."-apt.log de existir</li>
  <li>Actual versi&oacute;n de software distribu&iacute;do</li>
  <li>Actual kernel en ejecuci&oacute;n</li>
  <li>Uso de la partici&oacute;n ra&iacute;z del disco</li>
  <li>Configuraci&oacute;n de particiones (LVM/RAID) </li>
</ul>
<h3>Versiones actuales de paquetes</h3>
<p>Aqu&iacute; se muestra informaci&oacute;n detallada sobre las versiones de software de ".NAME.".</p>

";

$lang['help_box_settings_logs']="
<h3>Historiales</h3>
<p>Para analizar fallos en tu ".NAME." sin conectarte con SSH utiliza la funci&oacute;n Historiales. Selecciona el fichero de historial deseado en el men&uacute; desplegable y haz clic en 'Mostrar'.</p>
";


// Help box - User

$lang['help_box_user_users']=$lang['help_box_user_users_edit']="
<h3>Informaci&oacute;n de usuario</h3>
<p>Aqu&iacute; los usuarios pueden cambiar informaci&oacute;n personal tal como 'Nombre real' y contrase&ntilde;a.</p>
<p>No es posible cambiar el numbre de usuario (nombre de conexi&oacute;n). Para poder hacer esto tienes que borrar al usuario mediante accediendo como administrador y a&ntilde;adir un nuevo usuario con el nombre correcto.</p>
<p>El idioma de la interface de usuario se puede cambiar aqu&iacute;.</p>
";

$lang['help_box_user_filemanager']="
<p>Desde el Administrador de archivos puedes acceder a tus ficheros en ".NAME." incluso desde fuera de casa.</p>
<h3>Navegaci&oacute;n</h3>
<p>Entra en una carpeta haciendo clic en la flecha de la derecha de la carpeta o haci&eacute;ndole doble clic, asciende un nivel haciendo clic en la flecha izquierda o el la l&iacute;nea /home/usuario/ </p>
<h3>Acciones de fichero y carpeta</h3>
<p>Haz clic en ficheros or carpetas y utiliza los iconos de la barra de funcio&oacute;n de fichero para realizar diferentes acciones. Las funciones de izquierda a derecha son:</p>
<ul>
	<li>Crear carpeta</li>
	<li>Subir fichero</li>
	<li>Descargar como zip</li>
	<li>Mover ficheros</li>
	<li>Copiar ficheros</li>
	<li>Renombrar</li>
	<li>Cambiar permisos</li>
	<li>A&ntilde;adir a &aacute;lbum</li>
	<li>Eliminar</li>
</ul>
<h3>&aacute;lbum de fotos</h3>
<p>Para ver tus fotos en el &aacute;lbum de fotos de ".NAME." tienes que poner tus fotos en el cat&aacute;logo home/storage/pictures. </p>
<p>Entonces seleccionas los ficheros o carpetas y utilizas el icono <strong>A&ntilde;adir a &aacute;lbum</strong> en la barra de funciones para a&ntilde;adir tus fotos al &aacute;lbum de fotos de ".NAME.". </p>
<p>Sigue con el gestor de &aacute;lbum (mediante la p&aacute;gina de inicio de ".NAME.") para publicar las fotos.</p>
";

$lang['help_box_user_mail']="
<h3>Correo</h3>
<p>".NAME." se encargar&aacute; de recuperar tu correo desde todas las cuentas de correo externas que puedas tener. El correo se almacenar&aacute; en ".NAME." y est&aacute; disponible v&iacute;a IMAP o webmail, donde quiera que est&eacute;s.</p>
<p>Las cuentas de correo activas se mostrar&aacute;n aqu&iacute;.</p>
<h3>Configura ".NAME." para recibir correo</h3>
<p><strong>A&ntilde;ade nueva cuenta de correo</strong> - Para comenzar a recuperar correo de una cuenta externa, Haz clic aqu&iacute;. Rellena la informaci&oacute;n facilitada por el proveedor de tu cuenta de correo.</p>
";


$lang['help_box_user_mail_editfac']="
<p><strong>Editar cuenta</strong> - Edita la configuraci&oacute;n de correo para la cuenta de correo externa. Utiliza la informaci&oacute;n facilitada por el proveedor de tu cuenta.</p>
";


$lang['help_box_user_downloads']="
<h3>Descargas</h3>
<p>Usa el gestor de descargas de ".NAME." para descargar ficheros directamente a tu ".NAME.", desde donde est&eacute;s. Lo &uacute;nico que necesitas es una conexi&oacute;n a internet y un navegador.</p>
<p>Navega a tu www.-tu nombre easyfind-.myown".NAME.".com. Por supuesto si ya est&aacute;s en tu red dom&eacute;stica vete a http://".NAME."/admin.</p>
<p>Las enormes y lentas descargas se manejan por ".NAME." mientras tu ordenador est&aacute; apagado. Cuando inicias tu primera descarga se crea un cat&aacute;logo en tu carpeta /home/[usuario]/ folder: /home/[usuarioname]/downloads. </p>
<h3>Como descargar</h3>
<ol>
  <li>En casa accede a http://".NAME."/admin o si fuera www.-tu nombre easyfind name-.myown".NAME.".com/admin.</li>
  <li>Con&eacute;ctate con tu usuario normal. </li>
  <li>Selecciona 'Descargas'.</li>
  <li>Para iniciar una descarga necesitas copiar* la URL del fichero (o torrent) que deseas descargar y pegarla en el campo 'Ubicaci&oacute;n' de tu ".NAME." pulsando 'A&ntilde;adir'. </li>
  <li>Cuando la barra de progreso alcanza el 100% tu descarga est&aacute; completa. </li>
  </ol>
<p>*Para copiar la URL simplemente selecciona con el bot&oacute;n de la derecha sobre el fichero (o torrent). Dependiendo del navegador que uses y el tipo de fichero que desees descargar selecciona lo adecuado en el men&uacute; del click derecho: 'Copiar Acceso directo', 'Copiar direcci&oacute;n del Enlace', 'Copiar direcci&oacute;n de la imagen'</p>
<h3>Mas informaci&oacute;n</h3>
<p>Seg&uacute;n a&ntilde;ades ficheros para descarga, ".NAME." habilita espacio en disco para los ficheros. Si miras en el cat&aacute;logo /home/[usuario]/downloads/ parece como si los ficheros existen pero en tanto la barra de progreso no alcance el 100% los ficheros no est&aacute;n completos.</p>
<p>Actualmente el gestor de descargas soporta los est&aacute;ndares HTTP, FTP y bittorrent. No necesitas abrir puertos en tu cortafuegos cuando utilizas el gestor de descargas, pero para las descargas Bit-torrent se recomienda abrir los puertos 10000-14000 en la configuraci&oacute;n del Cortafuegos.</p>
<p>NOTA: Al descargar bittorrents, ten en cuenta que el gestor de descargas continuar&aacute; compartiendo el fichero hasta que pulses 'Cancelar' o 'Limpiar'. </p>
";


$lang['help_box_user_music']="
<p>Haz sonar tu m&uacute;sica almacenada en ".NAME." desde cualquier PC del mundo! Tu colecci&oacute;n musical est&aacute; disponible cuando te conectas con tu usuario est&aacute;ndar.</p>
";


$lang['help_box_user_album_albums']="
<p>&iexcl;Comparte tus fotos digitales con familia y amigos! &iexcl;con ".NAME." tienes un sencillo, disponible &aacute;lbum de fotos! &iexcl;S&oacute;lo necesitas tus fotos digitales!</p>

<h3>A&ntilde;adir invitados al &aacute;lbum</h3>
<p>Selecciona el elemento de men&uacute; <b>invitados a &aacute;lbum</b> para a&ntilde;adir usuarios que puedan ver el &aacute;lbum de fotos.</p>

<h3>A&ntilde;adir &aacute;lbumes</h3>
<p>Todo usuario de ".NAME." puede crear y publicar &aacute;lbumes de fotos, excepto el administrador.</p>
<ol>
  <li>Copia las carpetas con las fotos a \\".NAME."\storage\pictures, con el Gestor de archivos incorporado o el Explorador de Windows. </li>
  <li>Con&eacute;ctate con tu usuario standard a ".NAME.".</li>
  <li>Pulsa 'Gestor de archivos'.</li>
  <li>Vete hasta /home/storage/pictures.</li>
  <li>Selecciona las carpetas o fotos que quieres a&ntilde;adir como &aacute;lbumes de fotos.</li>
  <li>Selecciona el icono <strong>'A&ntilde;adir al &aacute;lbum'</strong> en la barra de funciones.</li>
  <li>Abre el <strong>Gestor de &aacute;lbumes</strong>. Decide si los &aacute;lbumes a&ntilde;adidos deben ser p&uacute;blicos o privados. Por defecto todos los &aacute;lbumes son privados.</li>
  <li>Selecciona tu &aacute;lbum, a la izquierda de la pantalla.</li>
  <ul>
	<li>Bien seleccionas los usuarios con los que quieres compartir el &aacute;lbum, y pulsas Actualizar.</li>
	<li>O marcas 'P&uacute;blico' si quieres que el &aacute;lbum est&eacute; disponible para cualquiera que acceda a tu ".NAME.", y pulsas Actualizar.</li>
  </ul>
  <li>&iexcl;Hecho!</li>
</ol>

<h3>Editar &aacute;lbumes</h3>
<p>Selecciona el &aacute;lbum que quieres editar. </p>
<ul>
  <li>Para editar un &aacute;lbum- o pi&eacute; de foto selecciona el objeto, introduce el texto y marca 'Actualizar'. </li>
  <li>Para borrar un &aacute;lbum, selecciona el &aacute;lbum y pulsa 'Borrar &aacute;lbum'.</li>
  <li>Para borrar una foto, selecciona la foto y pulsa 'Quitar del &aacute;lbum'.</li>
</ul>

<p>Tus &aacute;lbumes de fotos ser&aacute;n visibles navegando a <a href='http://".NAME."/album' target='_blank'>http://".NAME."/album</a> (<a href='http://".NAME.".local/album' target='_blank'>http://".NAME.".local/album</a> si utilizas Mac o Linux) desde tu red dom&eacute;stica, o navegando a www.-to nombre easyfind-.myown".NAME.".com desde fuera de tu red.</p>
";

$lang['help_box_user_album_users']="
<h3>A&ntilde;adir Invitados</h3>
<ul>
  <li>&aacute;lbum p&uacute;blico puede ser visto por cualquiera, no necesitas a&ntilde;adir invitados. </li>
	<li>&aacute;lbum privado protegido con contrase&ntilde;a, a&ntilde;ade aqu&iacute; invitados.</li>
	<li>Recuerda que los usuarios de ".NAME." y los invitados a &aacute;lbum de fotos no son lo mismo.</li>
<ol>
  <li>Haz clic en 'A&ntilde;adir invitado'.</li>
  <li>Rellena la informaci&oacute;n requerida.</li>
</ol>

";
