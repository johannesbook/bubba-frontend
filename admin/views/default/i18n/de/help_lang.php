<?php

// External links

$lang["help_box_manual_link"] = "Kurzanleitung";
$lang["help_box_forum_link"] = "Forum";
$lang["help_box_excito_link"] = "Excito-Website";
$lang["help-box-further-info"] = "Weitere Ressourcen";

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
<h3>Willkommen bei Excito ".NAME."!</h3>
<p>Hören Sie Musik, betrachten Sie Ihre Fotos und greifen Sie auf Ihre E-Mails und Dateien zu. Ein einziger Mausklick bringt Sie zu allen wichtigen Informationen oder sorgt für unterhaltsame Abwechslung!</p>
<p></p>
";

// Help box - Default page logged in as admin
$lang['help_box_login']=$lang['help_box_index']="
<h3>".NAME."-Administration</h3>
<p>Als Administrator haben Sie Zugriff auf die Systemeinstellungen. Klicken Sie auf das <strong>Zahnrad</strong>, um Ihr ".NAME." zu verwalten.</p>
<p>Das Administrator-Login sollte nur für die Verwaltung von ".NAME." verwendet werden. Für den täglichen Gebrauch melden Sie sich als anderer Benutzer (Standardbenutzer) an.</p>
";


// User pages
$lang['help_user_users']="?page=users.html#USERINFO";
$lang['help_user_mail']="?page=users.html#MAIL";
$lang['help_user_downloads']="?page=users.html#DOWNLOADS";
$lang['help_user_userinfo']="?page=users.html#USERINFO";
$lang['help_user_albums']="?page=users.html#PHOTOALBUM";


// Help box - Admin

$lang['help_box_stat']="
<h3>Status</h3>
<p>Hier finden Sie Informationen über die installierte Festplatte und den verbleibenden Speicherplatz, die Aktivitätszeit von ".NAME." und die installierte Software-Version.</p>
<h3>Systemmeldungen</h3>
<p>Hier werden wichtige Meldungen des Systems angezeigt.</p>
<p>Die Taste '<strong>Ausschalten</strong>' schaltet ".NAME." auf die gleiche Weise aus wie die Taste auf der Rückseite des Gerätes. Um ".NAME." wieder zu starten, drücken Sie die Taste auf der Rückseite.</p>
<p>Mit der Taste \'<strong>Neu starten</strong>\' wird".NAME." neu gestartet.</p>
";

$lang['help_box_filemanager']=$lang['help_box_filemanager_cd']="
<p>Im Dateimanager können Sie auf Ihre Dateien auf ".NAME." zugreifen - sogar von unterwegs.</p>
<h3>Navigation</h3>
<p>Navigieren Sie zu einem Ordner, indem Sie auf den Pfeil rechts neben dem Ordnernamen anklicken oder auf den Ordnernamen doppelklicken, und navigieren Sie eine Ebene nach oben, indem Sie den Pfeil links anklicken oder in die Zeile /home/username/ klicken.</p>
<h3>Datei- und Ordnerfunktionen</h3>
<p>Klicken Sie auf Dateien oder Ordner und verwenden Sie die Symbole in der Dateifunktionsleiste, um verschiedene Aktionen durchzuführen. Folgende Funktionen stehen zur Verfügung (von links nach rechts):</p>
<ul>
	<li>Ordner erstellen</li>
	<li>Datei hochladen</li>
	<li>Als ZIP herunterladen</li>
	<li>Dateien verschieben</li>
	<li>Dateien kopieren</li>
	<li>Umbenennen</li>
	<li>Rechte ändern</li>
	<li>Zum Fotoalbum hinzufügen</li>
	<li>Löschen</li>
</ul>
<h3>Fotoalbum</h3>
<p>Als Administrator sind Sie nicht berechtigt, Fotos in das".NAME."-Fotoalbum einzufügen. Loggen Sie sich als Ihr Standardbenutzer ein, um Fotos hinzuzufügen und Fotos  und Alben zu verwalten.</p>
";

	$lang['help_box_filemanager_backup']="
	<h3>Sicherung erstellen</h3>
	<ol>
    <li>Geben Sie in das Textfeld links im Bildschirm unter <strong>Jobname </strong>einen Namen für die Sicherung ein und klicken Sie auf \'Job erstellen\'. Der neue Sicherungsjob wird in der Spalte \'Vorhandene Jobs\' automatisch hervorgehoben.</li>
    <li>Fügen Sie die <strong>Dateien, die Sie in die Sicherung einschließen möchten</strong> ein, indem Sie im Menü \'Eingeschlossene Ordner\' auf die Taste \'Durchsuchen\' klicken. Unterordner werden automatisch in die Sicherung einbezogen.</li>
    <li>Wenn die Unterordner Dateien enthalten, die Sie <strong>ausschließen</strong> möchten, klicken Sie im Menü \'Ausgeschlossene Ordner\' auf die Taste \'Durchsuchen\' und markieren Sie die Ordner, die Sie nicht eingeschlossen werden sollen. </li>
    <li><strong>Wählen Sie das Ziel </strong>für den Sicherungsjob, indem Sie das Dropdown-Menü rechts neben \'Ziel\' öffnen. Wenn der Zielordner noch nicht bereits vorhanden ist, wird er automatisch erstellt.</li>
		  <ul>
		    <li>Bei Auswahl von lokaler USB / eSATA-Disk muss die Festplatte in der Dropdown-Liste \'Disk\' ausgewählt werden. Geben Sie den \'Zielordner\' ein (z. B. \'my_ backup_folder\important\\') oder lassen Sie das Feld leer, um die Sicherung im Root-Ordner zu speichern.</li>
		    <li>Bei Auswahl von Remote SSH / FTP müssen Sie den \'Host\' (z. B. eine IP-Adresse), den \'Zielordner\' (z. B. \'my_ backup_folder/important/\'), den \'Remote-Benutzer\' und das \'Remote-Passwort\' angeben. Wenn Sie das Feld \'Zielordner\' leer lassen, wird die Sicherung im Root-Ordner gespeichert.</li>
		  </ul>
    <li>Klicken Sie auf \'<strong>Sicherungsplanung</strong>\', um die Uhrzeit und die Häufigkeit der Sicherungen einzustellen. Geben Sie außerdem an, wie viele vollständige Sicherungen gespeichert werden sollen.</li>
    <li>Für zusätzliche Sicherheit können Sie den<strong> Sicherungsjob verschlüsseln</strong>. Klicken Sie auf \'Datensicherheit\' und \'Daten verschlüsseln\' und wählen Sie dann einen Verschlüsselungscode.</li>
    <li>Klicken Sie auf \'Job aktualisieren\', um die Einstellungen zu speichern.</li>
    <li>Mit \'Jetzt ausführen\' können Sie den Sicherungsjob sofort ausführen lassen.</li>
  </ol>
 	<h3>Sicherung wiederherstellen</h3>
 	<p>Klicken Sie im Menü auf die Option Wiederherstellen, um eine Sicherung wiederherzustellen.</p>
 	<h3>Sicherungsjobs speichern</h3>
 	<p>Führen Sie aus Sicherheitsgründen eine Sicherung Ihrer Einstellungen durch, um bei einer eventuellen Neuinstallation von".NAME." Ihre Sicherungsjobs parat zu haben. Klicken Sie im Menü auf <Strong>Einstellungen</Strong> und dann auf <Strong>Einstellungen sichern</Strong></p>
  ";
  
	$lang['help_box_filemanager_restore']=" 
	<h3>Sicherung wiederherstellen</h3>
	<ol>
    <li>Wählen Sie unter \'Benutzerdaten wiederherstellen\' den gewünschten Sicherungsjob, den Sie wiederherstellen möchten. </li>
    <li>Wählen Sie das \'Sicherungsdatum\' für die Wiederherstellung.</li>
    <li>Wählen Sie die Dateien oder Ordner (Unterordner werden automatisch einbezogen), die wiederhergestellt werden sollen. Die Dateien für die Wiederherstellung werden blau hervorgehoben.</li>
    <li>Wählen Sie das Verfahren für die Wiederherstellung: \'Fehlende Dateien wiederherstellen\', \'Dateien überschreiben\' oder \'In Ordner wiederherstellen\'.</li>
    <li>Klicken Sie auf \'Auswahl wiederherstellen\'</li>
  </ol>
  ";

$lang['help_box_users']="
	<h3>Benutzer</h3>
	<p>Hier finden Sie alle Benutzer, die für Ihr ".NAME." registriert sind. Klicken Sie auf \'Benutzer bearbeiten\', wenn Sie die Daten eines Benutzers ändern möchten.</p>
	<p>Damit der Administrator sich extern einloggen kann (über den WAN-Port), bearbeiten Sie den Administrator-Benutzer und klicken auf \'<strong>Remote-Zugriff auf die Systemeinstellungen erlauben</strong>\'.</p>
	<p><strong>Shell-Login zulassen</strong> erlaubt einem Benutzer, sich per SSH einzuloggen</p>
	
	<h3>Benutzer hinzufügen</h3>
	<p>Klicken Sie auf \'<strong>Neuen Benutzer hinzufügen</strong>\' und machen Sie die erforderlichen Angaben.</p>
	
	<h3>Benutzer bearbeiten</h3>
	  <p><strong>Benutzername</strong> - Der Benutzername (Login-Name) kann nicht verändert werden. Sie müssen den Benutzer stattdessen löschen und mit seinem korrekten Namen neu anlegen.</p>
	  <p><strong>Echter Name</strong> - Hier geben Sie den \'Echten Namen\' des Benutzers ein.</p>
	  <p><strong>Passwort ändern</strong> - Der Administrator kann die Passwörter der einzelnen Benutzer ändern. Jeder Benutzer hat die Möglichkeit, sein eigenes Passwort zu ändern, indem er sich einloggt. Es wird dringend empfohlen, das <strong>Admin-Passwort</strong> zu ändern und nicht das Standard-Passwort zu verwenden.</p>

	  
";

$lang['help_box_services']="
	<h3>Dateien veröffentlichen</h3>
  <p><strong>FTP</strong> - Der FTP-Server von ".NAME.".</p>
  <p><strong>Anonymer FTP-Zugang</strong>  - Erlaubt Benutzern die Anmeldung am FTP-Server ohne Passwort.</p>
  <p><strong>AFP</strong> - Das Apple Filing Protocol (AFP) ist ein Netzwerkprotokoll, das Dateidienste für Mac OS X- und Original Mac-Betriebssysteme anbietet.</p>
	<p><strong>Windows Dateifreigabe</strong> - Windows Dateifreigabe (Samba) wird verwendet, um Dateien und Drucker in Netzwerken freizugeben.</p>
	<h3>Streaming</h3>
	<p><strong>UPnP Streaming</strong> - Universal Plug and Play (UPnP)-Server. Der Server veröffentlicht/streamt Mediendateien wie Audio/Video/Bild/Dateien an UPnP-Clients im Netzwerk. Beachten Sie, dass UPnP in einem unsicheren Netzwerk deaktiviert werden sollte, andernfalls können Sie über die Mediatomb-Internetoberfläche das gesamte Dateisystem durchsuchen - was ein Sicherheitsrisiko darstellen kann. </p>
	<p><strong>DAAP Streaming</strong> - Digital Audio Access Protocol (DAAP)-Server. Medienserver für Roku SoundBridge und iTunes. </p>
	<p><strong>Squeezebox-Server </strong>- ein Streaming Audio-Server, der von Logitech unterstützt wird und Musik zur Squeezebox-Produktlinie streamt.</p>
	<h3>E-Mail</h3>
	<p><strong>Senden und Empfangen</strong> -  Postfix als SMTP-Server: Senden und Empfangen von E-Mails.</p>
	<p><strong>IMAP (für Webmail-Zugang)</strong> - Dovecot als IMAP-Server. Dieser Dienst ist für den Zugriff auf Webmail erforderlich.</p>
	<p><strong>E-Mail-Abruf </strong>- Für Fetchmail, wenn E-Mails im Daemon-Modus zu ".NAME." abgerufen werden</p>
	<h3>Sonstige</h3>
	<p><strong>Drucken</strong> - Der Druckserver von ".NAME.".</p>
	<p><strong>Uploads/Downloads</strong> - Möglichkeit zum Hoch- und Herunterladen von Dateien auf bzw. von ".NAME.", z. B. Dateimanager und torrents.</p>
";

$lang['help_box_mail']=$lang['help_box_mail_index']="
	<h3>E-Mail</h3>
	<p>".NAME." kann Ihre E-Mail von allen externen E-Mail-Konten abrufen, die Sie besitzen. Die E-Mails werden auf ".NAME." gespeichert und sind per IMAP oder Webmail von überall aus zugänglich.</p>
	<p>Aktive E-Mail-Konten werden hier angezeigt.</p>
	<h3>".NAME." für E-Mail-Abruf einrichten</h3>
	<p><strong>Neues E-Mail-Konto hinzufügen</strong> - Klicken Sie hier, um mit dem Abrufen von externen E-Mail-Konten zu beginnen. Geben Sie die Daten ein, die Sie vom Provider für Ihr E-Mail-Konto erhalten haben.</p>
	<p>Sie müssen angeben, zu welchem Benutzer die abgerufene E-Mail geleitet werden soll; dies muss für jedes hinzugefügte E-Mail-Konto einzeln festgelegt werden. Zuvor muss ein ".NAME."-Benutzer hinzugefügt worden sein.</p>
	
";
	
$lang['help_box_mail_server_settings']="
	<h3>E-Mail-Server</h3>
  <p>Lassen Sie die Felder leer, wenn ".NAME." Ihre ausgehenden E-Mails verarbeiten soll. Wenn Ihr ISP ausgehenden Traffic an Port 25 blockiert, müssen Sie einen anderen SMTP-Server als ".NAME." verwenden; geben Sie die Daten an, die Sie von Ihrem ISP erhalten haben.</p>
	<h3>E-Mail-Domäne</h3>
	<p>Wenn Sie einen eigenen Domänennamen besitzen, verarbeitet ".NAME." Ihre ein- und ausgehenden E-Mails.</p>
	<p><strong>E-Mail für Domäne verarbeiten</strong> - Geben Sie hier den Namen Ihrer Domäne ein. Mehrere Domänennamen können durch ein Leerzeichen getrennt eingegeben werden.</p>
";


$lang['help_box_network']=$lang['help_box_network_profile']=$lang['help_box_update_profile']="
	<h3>Netzwerk-Profil</h3>
  <p>In den meisten Fällen funktionieren die automatischen Einstellungen, und Sie müssen hier nichts ändern. Weitere Informationen entnehmen Sie dem technischen Handbuch.</p>
	<p><strong>Automatische Netzwerkeinstellungen</strong> - ".NAME." versucht, die passende Netzwerkkonfiguration automatisch einzustellen.</p>
	<p><strong>Router + Firewall + Server</strong> - ".NAME." versucht, die Netzwerkeinstellungen für WAN (Internet) automatisch abzurufen und verwendet fixe Netzwerkeinstellungen im lokalen Netzwerk, wobei Netzwerkdaten für andere Computer zur Verfügung gestellt werden.</p>
	<p><strong>Nur Server</strong> - ".NAME." versucht, die Netzwerkeinstellungen für LAN (lokales Netzwerk) automatisch abzurufen; der WAN-Port sollte frei bleiben.</p>
	<p>Nach Bearbeitung der Netzwerkeinstellungen müssen die Computer und andere Geräte im LAN unter Umständen neu gestartet werden.</p>
	<p><i>Aktualisieren</i> speichert Ihre Änderungen.</p>
";
	
$lang['help_box_network_wan']="
	<h3>WAN</h3>
	<p>Hier können Sie konfigurieren, wie ".NAME." Ihren Wide Area Network (WAN)-Port behandelt. Die Standardeinstellung lautet IP-Adresse beziehen.</p>
	<p><strong>IP-Adresse automatisch beziehen (DHCP)</strong> - Das Dynamic Host Configuration Protocol (DHCP) automatisiert die Zuweisung von IP-Adresse, Netmask, Default Gateway und anderen IP-Parametern. Verwenden Sie diese Option, wenn Ihr Internetprovider die Verwendung von DHCP verlangt. Dies ist die Standardeinstellung und zugleich die gängigste Option.</p>
	<p><strong>Statische IP-Adresse verwenden</strong> - Statische IP-Adresse, Netmask, Default Gateway und Primary DNS werden vom Administrator manuell zu ".NAME." zugewiesen. Verwenden Sie diese Option, wenn Ihr Internetprovider die manuelle Eingabe dieser Daten verlangt.
  <p>Bitte beachten Sie, dass die WAN-Einstellungen im Profil \'Automatische Netzwerkeinstellungen\' nicht bearbeitet werden können; sie können nur gelesen werden.</p>
	<p><i>Aktualisieren</i> speichert Ihre Änderungen.</p>
";
	
$lang['help_box_network_lan']="
	<h3>LAN</h3>
	<p>Hier können Sie konfigurieren, wie Sie ".NAME." von anderen Computern in Ihrem Local Area Network (LAN) erreichen. Ihr ".NAME." verfügt über eine automatische Erkennung am LAN-Port. Das heißt, dass ".NAME." nach einem DHCP-Server im LAN sucht, wenn es angeschlossen wird. Wenn ein DHCP-Server gefunden wird, konfiguriert sich ".NAME.".
  <p><strong>IP-Adresse automatisch erhalten</strong> - Verwenden Sie diese Option, wenn Sie einen anderen DHCP-Server als den ".NAME." in Ihrem LAN verwenden, wie beispielsweise einen Router oder Gateway. ".NAME." wird automatisch eine IP-Adresse erhalten.</p>
  <p><strong>Statische IP-Adresse verwenden - </strong>Ihr ".NAME." kann im LAN an dieser statischen IP-Adresse erreicht werden. Die standardmäßige Rückgriff-IP lautet: <a href='http://192.168.10.1' target='_blank'>192.168.10.1</a>.</p>
  <ul>
  	<li><strong>DNS-Service aktivieren</strong> - Das Domain Name System (DNS) übersetzt Domänennamen in IP-Adressen. Wenn Sie einen Domänennamen eingeben, übersetzt der DNS-Server den Namen in die entsprechende IP-Adresse. </li>
    <li><strong>DHCP-Server aktivieren</strong> - Der DHCP-Server vergibt IP-Adressen, wenn ein Gerät, das am LAN-Port von ".NAME." angeschlossen ist, hochgefahren wird und eine IP-Adresse anfordert. Das Gerät muss als DHCP-Client für \'IP-Adresse automatisch beziehen\' konfiguriert sein.</li>
    <li><strong>Lease-Bereich</strong> - Der DHCP-Adressenpool (Lease-Bereich) enthält den Bereich an IP-Adressen, die automatisch an Clients im Netzwerk (z. B. Computer, Media-Player) vergeben werden.</li>
  </ul>
  <p><strong>Jumbo-Frames aktivieren</strong> - Diese Option ermöglicht die Übertragung von größeren Datenblöcken über die LAN-Schnittstelle. <strong>WARNUNG</strong> - Voraussetzung hierfür ist, dass alle Geräte im LAN entsprechend konfiguriert sind. Diese Einstellung muss mit Vorsicht verwendet werden, kann aber die Übertragungsleistung zwischen ".NAME." und Gigabit-fähigen Geräten deutlich steigern.</p>
	<p><strong>DHCP Leases </strong>- Zeigt die aktuellen Netzwerkgeräte in Ihrem LAN, wenn ".NAME." als Router fungiert. Wenn mehrere Netzwerkgeräte den gleichen Hostnamen tragen, wird das zuletzt angeschlossene mit * angezeigt.</p>
	<p>Bitte beachten Sie, dass die LAN-Einstellungen im Profil \'Automatische Netzwerkeinstellungen\' nicht bearbeitet werden können; sie können nur gelesen werden.</p>
	<p><i>Aktualisieren</i> speichert Ihre Änderungen.</p>
";
	
$lang['help_box_network_wlan']="
	<p>".NAME." kann sowohl im \'Router + Firewall + Server\'-Modus als auch im \'Nur Server\'-Modus als Zugangspunkt fungieren.</p>
	<h3>Wireless</h3>
  <p><strong>Wireless-Accesspoint</strong> - Für die Aktivierung des Wireless-Accesspoint in ".NAME.".</p>
  <p><strong>Netzwerkname (SSID)</strong> - Dies ist der Name, der ein bestimmtes Netzwerk identifiziert. Die SSID darf max. 32 Zeichen lang sein.</p>
  <p><strong>Passwort</strong> - Das Passwort (Aka-Passphrase) ist eine Zeichenfolge, die sowohl bei ".NAME." als auch bei Ihren Netzwerk-Clienten exakt gleich eingegeben werden muss. Geben Sie das Passwort in ASCII-Zeichen ein. Das Passwort muss für WPA zwischen 8 und 63 Zeichen und für WEP 5 oder 13 Zeichen lang sein.</p>
  <h3>Erweiterte Wireless-Einstellungen</h3>
  <p><strong>Verschlüsselung </strong>- Wählen Sie zwischen WEP, WPA1 oder WPA2. WEP wird aufgrund der geringen Sicherheit nicht empfohlen.</p>
  <p><strong>Kanal </strong>- Wählen Sie den Kanal für Ihren Wireless-Accesspoint in ".NAME.". In Gebieten mit mehreren Wireless-Netzwerken kann sich die Übertragungsgeschwindigkeit verlangsamen. Probieren Sie dann einen anderen Kanal. Die Kanalverfügbarkeit ist aufgrund der unterschiedlichen Regulierungen in jedem Land anders.</p>
  <p><strong>Broadcast SSID </strong>- SSID von ".NAME." für Wireless-Geräte ein- oder ausblenden. Die Standardeinstellung ist SSID zeigen.</p>
  <p><i>Aktualisieren</i> speichert Ihre Änderungen.</p>
";
	
$lang['help_box_network_fw']="
	<p>".NAME." verfügt über eine integrierte Firewall, die Ihr internes Netzwerk und ".NAME." schützt.</p>
	<h3><strong>Externen (WAN) Zugriff auf ".NAME."-Dienste erlauben</h3>
  <p><strong>SSH (Port 22)</strong> - Ermöglicht Secure Shell (SSH) zu ".NAME." (vom WAN).</p>
  <p><strong>E-Mail-Server (Port 25)</strong> - Ermöglicht den Zugang vom WWW zum ".NAME."-Port 25. Dies ist der Standard-E-Mail-Server-Port für das Senden und Empfangen von E-Mails.</p>
  <p><strong>WWW (HTTP / HTTPS-Ports 80 / 442)</strong> - Ermöglicht WWW-Traffic zu ".NAME." (vom WAN).</p>
  <p><strong>E-Mail (IMAP / IMAPS-Ports 143 / 993)</strong> - Ermöglicht den Zugang vom WWW zu den ".NAME."-Ports 143 und 993. Diese Ports werden für das Senden und Empfangen von E-Mails verwendet.</p>
  <p><strong>FTP (Port 21)/strong> - Ermöglicht FTP-Verbindungen vom WAN zum ".NAME."-Port 21.</p>
  <p><strong>Downloader (Ports 10000-14000)</strong> - Ermöglicht schnelleren Torrent-Download. Diese Regel öffnet die Ports 10000-14000.</p>
  <p><strong>Auf Ping antworten (ICMP-Typ 8)</strong> - Ermöglicht Pingen vom WAN. Die Standardeinstellung verhindert, dass Computer im Internet eine Antwort von ".NAME." erhalten, wenn ".NAME." \'angepingt\' wird. Dies erhöht die Sicherheit.</p>
  <h3>Erweiterte Firewall-Einstellungen</h3>
	<p>Wählen Sie mithilfe der Optionsschaltflächen entweder \'Portweiterleitung in internes Netzwerk\' oder \'".NAME."|2 Port öffnen\'. Die erste Option öffnet einen Port im Internet (WAN) für ein Netzwerkgerät in Ihrem internen Netzwerk (LAN). Die zweite Option öffnet einen Port im Internet (WAN) für ".NAME.".</p>
	<p><strong>Source IP</strong> - Die Source IP (auf der WAN-Seite), an die die Portweiterleitung gerichtet wird. Geben Sie \'Alle\' ein, wenn die Portweiterleitung nicht an eine spezifische IP-Adresse gerichtet ist.</p>
  <p><strong>Public Port</strong> - Die Portnummer auf der WAN-Seite. Sie können einen Port oder einen Portbereich eingeben (z. B. 4001:4005).</p>
  <p><strong>Private Port</strong> - Die Portnummer auf der LAN-Seite. Geben Sie einen Startport ein, wenn für Public Port ein Portbereich verwendet wird (z. B. 4001).</p>
  <p><strong>Private IP</strong> - Die Ziel-IP im LAN-seitigen Netzwerk, das die virtuellen Dienste zur Verfügung stellt (gewünschte Portweiterleitung).</p>
  <p><strong>Protokoll</strong> - Das Protokoll für den virtuellen Dienst: TCP oder UDP.</p>
  <h3>Benutzerdefiniert geöffnete / weitergeleitete Ports</h3>
	<p>Dies zeigt die aktivierten Portweiterleitungen an. Drücken Sie das Stiftsymbol rechts neben der Regel, um die Portweiterleitung zu bearbeiten. Drücken Sie das rote X rechts neben der Regel, um die Portweiterleitung zu löschen.
  <p><i>Aktualisieren</i> speichert Ihre Änderungen.</p>
";

$lang['help_box_disk']="
	<h3>Disk</h3>
	<p>Hier finden Sie den Status der internen und externen Disks und Speichergeräte. Wenn ein neues Gerät angeschlossen wird, müssen Sie auf \'Verbinden\' drücken, damit das Gerät benutzt werden kann.</p>
	<p><strong>Diskdaten</strong> - Zeigt den Disknamen, die Größe, den Disktyp und eine grafische Übersicht der Partitionen an.</p>
	<p><strong>Partitionsdaten</strong> - Beschreibung der Partitionen.</p>
	<h3>Externe Disks</h3>
	<p><strong>Verbinden</strong></p>
	<ol>
  	<li>Anschluss einer externen Disk oder eines USB- oder eSATA-Laufwerkes.</li>
  	<li>Drücken Sie rechts neben der Partition, die verbunden werden soll, auf \'<strong>Verbinden</strong>\'</li>
  	<li>Nun können Sie auf Ihre Dateien im \'Speicher/Extern\'-Katalog oder z. B. mit dem Windows Explorer öffnen.</li>
  </ol>
  <p><strong>Verbindung trennen</strong></p>
  <ol>
  	<li>Bevor eine externe Disk, ein USB- oder ein eSATA-Laufwerk getrennt wird, müssen Sie durch Anklicken von \'Trennen\' sicherstellen, dass das Gerät ohne Datenverlust oder Beschädigung getrennt werden kann.</li>
  	<li>Ziehen Sie dann das Kabel ab.</li>
	</ol>
";

$lang['help_box_disk_lvm']="
	<h3>Disk erweitern</h3>
	<p>Erweitern Sie Ihre Home-Partition mit einer externen Disk. Die interne Home-Partition und eine angeschlossenen Disk werden dann zu einem logischen Volume zusammengefasst. Mit anderen Worten, Sie erhalten eine große Disk anstelle von zwei kleinen. Die Gesamtgröße der Disk ist die Größe der Home-Partition plus die Größe der externen Disk.</p>
	
	<h3>Warnung</h3>
	<p><strong>Beachten Sie bitte, das dieser Vorgang nicht rückgängig gemacht werden kann. Systeme, die mit einem externen Laufwerk erweitert wurden, müssen immer mit diesem externen Laufwerk verbunden bleiben, andernfalls funktionieren sie nicht mehr. Erst durch eine Neuinstallation des gesamten Systems kann ".NAME." wieder allein benutzt werden.</strong></p>
  <p><strong>Alte LVM-Disks werden automatisch verbunden und beim Hochfahren in das ".NAME."-System eingeschlossen, selbst wenn ".NAME." nicht für eine LVM-Erweiterung konfiguriert ist. Die Erweiterung kann nur durch eine Neuinstallation entfernt werden. Um eine alte, externe LVM-Disk, die als Erweiterung verwendet wurde, zu formatieren, verbinden Sie die Disk mit dem hochgefahrenen ".NAME.". Wählen Sie dann im Menü \'Disk -> Informationen\' die Option \'Formatieren\'.</strong></p>
		
	<h3>Erweiterte Disk (LVM) erstellen</h3>
	<ol>
  	Schließen Sie eine externe Disk oder ein USB- oder eSATA-Laufwerk an. Beachten Sie, dass die Disk bereits formatiert sein sollte und keine alten RAID- oder LVM-Systeme enthalten sollte.</li>
  	<li>Wählen Sie \'Home-Partition\' und die Partition der externen Disk (z. B. /dev/sdb). </li>
  	<li>Klicken Sie auf \'Partition erweitern\'.</li>
  	<li>Warten Sie, bis die Fortschrittsanzeige beendet ist.</li>
  	<li>Ihr System wurde jetzt auf das externe Laufwerk erweitert.</li>
  </ol>
  <h3>Erweiterte Disk (LVM) entfernen</h3>
	<p>Eine erweiterte Disk (LVM) kann nur durch eine komplette Neuinstallation des Systems entfernt werden.</p>
";
	
$lang['help_box_disk_raid']="
	<p>Die RAID-Funktion von ".NAME." kombiniert die /Home-Partition und eine externe Harddisk zu einer logischen Einheit.</p>
	
	<h3>Wichtig</h3>
	<ul>
		<li><strong>Warnung!</strong> Dieser Vorgang vernichtet sämtliche Benutzerdaten - sowohl auf der internen als auch auf der externen Disk.</li>
		<li>Alte RAID-Disks werden automatisch verbunden und beim Hochfahren in das ".NAME."-System eingeschlossen, selbst wenn ".NAME." nicht für eine RAID-Erweiterung konfiguriert ist. Die Erweiterung kann nur durch eine Neuinstallation entfernt werden. Um eine alte, externe RAID-Disk, die als Erweiterung verwendet wurde, zu formatieren, verbinden Sie die Disk mit dem hochgefahrenen ".NAME.". Wählen Sie dann im Menü \'Disk -> Informationen\' die Option \'Formatieren\'.</li>
  	<li>Für optimale Leistung sollte die angeschlossene externe Disk genauso groß sein wie die interne Disk in ".NAME.".</li>
  	<li>Die Gesamtkapazität des Array entspricht der Kapazität der kleinsten Disk im Array.</li>
  	<li>Die Erstellung bzw. die Wiederherstellung eines RAID-Array kann einige Zeit in Anspruch nehmen, für eine Disk mit 1 TB ungefähr 4 Stunden. Der Vorgang läuft im Hintergrund des ".NAME."-Systems ab und wird dem Benutzer nicht angezeigt.</li>
  	<li>Um ".NAME." wieder als eigenständiges System ohne RAID-Konfiguration zu benutzen, muss das ".NAME."-System neu installiert werden.</li>
  </ul>
  
  <h3>RAID-Array erstellen</h3>
	<ol>
  	<li>Schließen Sie eine eSATA-Disk an. Beachten Sie, dass die Disk bereits formatiert sein sollte und keine alten RAID- oder LVM-Systeme enthalten sollte.</li>
  	<li>Klicken Sie auf \'RAID-Array erstellen\'</li>
  	<li>Wählen Sie, welche externe Disk in das Array aufgenommen werden soll.</li>
  	<li>Warnung! Auf beiden Disks werden alle Daten gelöscht. Klicken Sie auf \'RAID erstellen\'.</li>
  	<li>Warten Sie, bis die Fortschrittsanzeige beendet ist. Seien Sie geduldig, bei größeren Disks kann das Erstellen eines RAID-Array einige Zeit in Anspruch nehmen.</li>
  	<li>Nach Abschluss des Vorgangs ist die externe Disk in das RAID-Array aufgenommen.</li>
  </ol>
  
  <h3>RAID-Status</h3>
	<p><strong>Liste der RAID-Arrays</strong> - zeigt die Gesamtkapazität an, d. h. die kleinste verfügbare Disk im Array (die ".NAME." /Home-Partition oder die externe eSATA-Disk).</p>
  <p><strong>Liste der RAID-Disks</strong> - zeigt die an das RAID-System angeschlossenen Disks an.</p>

	<h3>Externe Disk wiederherstellen</h3>
	<p>Wenn auf der externen Disk ein Fehler auftritt oder wenn die externe Disk versehentlich getrennt wurde, müssen Sie wie folgt vorgehen.</p>
	<ol>
    <li>Trennen Sie die fehlerhafte externe Disk vom ".NAME." (an der Rückseite).</li>
    <li>Schließen Sie eine neue externe Disk an (oder schließen Sie die versehentlich getrennte Disk wieder an).</li>
    <li>Klicken Sie auf \'<strong>RAID-Array wiederherstellen</strong>\'.</li>
    <li>Wählen Sie, welche externe RAID-Disk in das Array aufgenommen werden soll. Klicken Sie auf \'Array wiederherstellen\'.</li>
    <li>Warnung! Alle Daten, die sich auf der externen Disk befinden, werden gelöscht. Klicken Sie auf \'Array wiederherstellen\'.</li>
    <li>Drücken Sie auf \'Schließen\', um die Arbeit mit ".NAME." fortzusetzen. Die Synchronisation wird durchgeführt und nimmt einige Zeit in Anspruch.</li>
  </ol>
  
  <h3>Interne Disk wiederherstellen</h3>
	<p>Wenn bei einer internen Disk in ".NAME." ein Fehler auftritt, müssen Sie die Disk zunächst austauschen und über einen USB-Speicher wiederherstellen. Danach wird ".NAME." auf die neuste Software aktualisiert.</p>
	<ol>
		<li>Schließen Sie die externe RAID-Disk an, die Ihre Daten enthält.</li>
  	<li>Klicken Sie auf \'<strong>RAID-Array wiederherstellen</strong>\'.</li> 
  	<li>Wählen Sie, welche externe RAID-Disk in das Array aufgenommen werden soll. Klicken Sie auf \'Array wiederherstellen\'.</li>
  	<li>Warnung! Alle Benutzerdaten und der Speicherbereich auf der internen Disk werden gelöscht. Klicken Sie auf \'Array wiederherstellen\'.</li>
  	<li>Drücken Sie auf \'Schließen\', um die Arbeit mit ".NAME." fortzusetzen. Die Synchronisation wird durchgeführt und nimmt einige Zeit in Anspruch.</li>
  </ol>
  
";

$lang['help_box_printing']="
<h3>Druckerserver</h3>
<p>Mit dem Druckserver erhalten Sie einfach und bequem Zugang zum Drucker. ".NAME." bietet Ihnen die Möglichkeit, Ihre Drucker in Ihrem Heim- oder Büronetzwerk noch effizienter einzusetzen. Der Druckserver erlaubt mehreren Benutzern die gemeinsame Nutzung eines Druckers aus dem gesamten Netzwerk, d. h. ohne von einem gemeinsamen PC zu arbeiten. Sie benötigen lediglich einen USB-Drucker und die entsprechenden Treiber.</p>
<h3>Installation</h3>
<ol>
  <li>Schließen Sie Ihren USB-Drucker am USB-Anschluss von ".NAME." an.</li>
  <li>Drücken Sie auf \'Neuen Drucker hinzufügen\'.</li>
  <li>Der Name des Druckers erscheint. Fügen Sie diesen Drucker hinzu und machen Sie die erforderlichen Angaben.</li>
  <li>Navigieren Sie vom PC über Samba (z. B. mit dem Explorer von Windows) zu <a href='file:///\\".NAME."\'>\\".NAME."\</a>. </li>
  <li>Der Drucker erscheint neben dem Home- und dem Speicher-Ordner. Doppelklicken Sie auf das Druckersymbol.  </li>
  <li>Das System fragt nach dem Druckertreiber; befolgen Sie die Anweisungen und installieren Sie den Drucker. Nach Abschluss der Installation ist der Drucker einsatzbereit. Wiederholen Sie die Schritte 4 bis 6 für alle Computer, die den Drucker verwenden.</li>
</ol>
";

$lang['help_box_settings']=$lang['help_box_settings_startwizard']="
<h3>Setup-Assistent</h3>
<p>Verwenden Sie den integrierten Setup-Assistenten für die ersten, wichtigen Einstellungen Ihres ".NAME." vorzunehmen, z. B. die Einstellung von Datum und Uhrzeit, das Hinzufügen von Benutzern oder die Auswahl eines Easyfind-Namen. Der Assistent kann jederzeit durchgeführt werden.</p>
<p><strong>Schritt 1 - Datum und Uhrzeit</strong></p>
<p>Wählen Sie die Zeitzone sowie Datum und Uhrzeit. Sie haben auch die Möglichkeit, einen Timeserver im Internet zu benutzen, um das Datum und die Uhrzeit automatisch einzustellen und zu aktualisieren. In diesem Fall müssen Sie keine manuellen Einstellungen vornehmen. Klicken Sie auf \'Weiter\', um fortzufahren.</p>
<p><strong>Schritt 2 - Benutzer erstellen</strong></p>
<p>Erstellen Sie einen oder mehrere Benutzer. Machen Sie alle erforderlichen Angaben und klicken Sie dann auf \'Benutzer hinzufügen\'. Klicken Sie auf \'Weiter\', um fortzufahren.</p>
<p><strong>Schritt 3 - Netzwerk einrichten</strong></p>
<p>Entscheiden Sie, ob Sie einen kostenlosen Easyfind-Namen registrieren möchten. Sie erreichen Ihr ".NAME." dann über www.-your easyfind name-.myownb3.com. Klicken Sie auf \'Weiter\', um fortzufahren.</p>
<p><strong>Die Einrichtung ist fertig</strong></p>
<p>Klicken Sie auf \'Setup fertig stellen\', um den Assistenten zu beenden.</p>
";

$lang['help_box_settings_identity']="
<h3>Systemidentität</h3>
<p><strong>Hostname</strong> - der eindeutige Name, unter dem ein an das Netzwerk angeschlossenes Gerät im Netzwerk bekannt ist.</p>
<p><strong>Arbeitsgruppe</strong> - Geräte, die sich in einer gemeinsamen Arbeitsgruppe befinden, können einander Zugang zu ihren Dateien, Druckern oder zu ihrer Internetverbindung gewähren. Verwenden Sie für ".NAME." den gleichen Arbeitsgruppennamen wie auf Ihrem Computer.</p>
<h3>Optionen für Easyfind</h3>
<p><strong>".NAME." mit \'Easyfind\' lokalisieren</strong> - Mit unserem kostenlosen Easyfind-Dienst können Sie Ihr ".NAME." von überall erreichen, indem Sie www.-your easyfind name-.myownb3.com eingeben.</p>
<p><strong>Easyfind funktioniert nur mit http- und https-Protokoll</strong>.</p>
<p><strong>Easyfind-Name</strong> - Wählen Sie für Ihr ".NAME." einen Namen für das Easyfind-Netzwerk.</p>
";

$lang['help_box_settings_trafficsettings']="
<h3>Traffic</h3>
<p>Ändern Sie die \'Traffic\'-Einstellungen, um die maximalen Upload-/Download-Geschwindigkeiten für Ihre Torrents einzustellen.</p>
<p>Bei einer beschränkten Breitbandverbindung sollte z. B. der Uplink nicht vollständig belegt werden. Stellen Sie dann die \'Max. Upload-Geschwindigkeit\' auf den gewünschten Wert ein. Verwenden Sie \'Max. Download-Geschwindigkeit\' analog.</p>
<p>Eingabe von -1 = keine Geschwindigkeitsbeschränkung.</p>
<p><i>Aktualisieren</i> speichert Ihre Änderungen.</p>
";

$lang['help_box_settings_datetime']="
<h3>Datum und Uhrzeit</h3>
<p><strong>Aktuelle Zeitzone</strong> - Zeigt die ausgewählte Zeitzone.</p>
<p><strong>Zeitzone auswählen</strong> - Wählen Sie Ihre Zeitzone in der Dropdown-Liste aus.</p>
<p><strong>Zeit automatisch einstellen</strong> - Diese Einstellung erlaubt ".NAME.", das Datum und die Uhrzeit automatisch über einen Internetserver abzurufen.</p>
<p><strong>Datum</strong> - Manuelle Einstellung des Systemdatums.</p>
<p><strong>Uhrzeit</strong> - Manuelle Einstellung der Systemzeit.</p>
";
 
$lang['help_box_settings_backuprestore']=$lang['help_box_settings_backup']=$lang['help_box_settings_restore']="
<h3>Backup- und Wiederherstellungseinstellungen</h3>
<p>\'Backup-Einstellungen\' sichert alle ".NAME."-Einstellungen, diese Funktion ist nützlich, wenn Sie ".NAME." neu installieren müssen oder Ihre Einstellungen auf ein anderes ".NAME." übertragen möchten. Folgende Einstellungen werden gespeichert:</p>
<ul>
  <li>Benutzerkonten (inklusive Einstellung für Admin-Login über WAN, Passwörter), jedoch ohne Benutzerdaten</li>
  <li>Backup-Aufgaben</li>
  <li>Diensteinstellungen</li>
  <li>Einstellungen für E-Mail-Konto</li>
  <li>Netzwerkkonfiguration (alle Einstellungen, z. B. Profil, Hostname, Wireless-Einstellungen, Firewall-Regeln usw.)</li>
  <li>Drucker</li>
</ul>
<h3>Sicherung erstellen</h3>
<ol>
  <li>Schließen Sie ein externes Speichergerät (USB-Speicher oder USB-Disk) an ".NAME." an. </li>
  <li>Wählen Sie die Quelle und das Ziel und drücken Sie auf Sicherung. </li>
  <li>Alle Einstellungen werden jetzt in einer Datei auf dem gewählten externen Speichergerät gespeichert. </li>
</ol>

<h3>Sicherung wiederherstellen</h3>
<ol>
  <li>Schließen Sie das Speichergerät mit der Sicherungsdatei an ".NAME." an.</li>
  <li>Beachten Sie, dass die aktuellen Benutzer von ".NAME." entfernt werden und die Benutzer, die in der Sicherungsdatei gespeichert sind, hergestellt werden. Im /home/[user] Katalog bleiben die Benutzerdaten der aktuellen Benutzer von ".NAME." jedoch intakt.</li>
  <li>Drücken Sie auf Wiederherstellen. </li>
  <li>Unter Umständen muss ".NAME." neu angeschlossen werden; dies hängt von der Konfiguration der wiederhergestellten Netzwerkdaten ab.</li>
 </ol>
";

$lang['help_box_settings_software']="
<h3>Software-Aktualisierung</h3>
<p>Für neue Funktionalität haben Sie die Möglichkeit, die ".NAME."-Software zu aktualisieren. Drücken Sie einfach auf \'System aktualisieren\', um die Aktualisierung automatisch durchzuführen. Die Aktualisierung kann einige Zeit in Anspruch nehmen - bitte seien Sie geduldig.</p>
<p>Nach der Aktualisierung werden Statusinformationen angezeigt. Drücken Sie das \'+\' Zeichen, um die Fertigstellungsmeldung anzuzeigen.</p>
<h3>Hotfixes</h3>
<p>Diese Funktion erfasst Statusinformationen von Ihrem ".NAME." und sendet sie für eine automatische Analyse an Excito. Der Aktualisierungsserver kann dann ggf. die erforderlichen Maßnahmen durchführen, wenn es auf Ihrem System Probleme gibt. Die Systeminformationen werden über eine verschlüsselte Verbindung gesendet und die Antworten des Servers sind GPG-signiert, um die Sicherheit zu gewährleisten und zu bestätigen, dass die Inhalte von Excito stammen.</p>
<p>Diese Funktion ist standardmäßig aktiviert. Verwenden Sie den Schalter, um Hotfixes zu deaktivieren. Wenn Hotfixes deaktiviert sind, können Sie wichtige Aktualisierungen für ".NAME." unter Umständen nicht erhalten. </p>
<p><strong>Von Excito erfasste Informationen werden auf keinen Fall an Dritte weitergegeben. Die Informationen werden nur verwendet, um Fehler aufzuspüren und die am besten geeigneten Aktualisierungen für Ihr ".NAME." durchzuführen.</strong></p>
<p>Folgende Informationen werden erfasst.</p>
<ul>
  <li>MAC-Adresse </li>
  <li>IP-Adresse</li>
  <li>Seriennummer und Code</li>
  <li>Größe des RAM-Speichers</li>
  <li>CPU-Modell</li>
  <li>Status der installierten, ".NAME."-spezifischen Pakete</li>
  <li>Sofern vorhanden, die Protokolldatei /tmp/bubba-apt.log</li>
  <li>Aktuelle Softwareversion</li>
  <li>Aktuell ausgeführtes Kernel</li>
  <li>Nutzung der Root-Disk-Partition</li>
  <li>Disk-Partition-Setup (LVM/RAID) </li>
</ul>
<h3>Aktuelle Paketversionen</h3>
<p>Detaillierte Informationen über die ".NAME."-Software-Versionen werden hier angezeigt.</p>

";

$lang['help_box_settings_logs']="
<h3>Protokolle</h3>
<p>Verwenden Sie die Protokollfunktionen, wenn Sie Fehler Ihres ".NAME." ohne SSH nachverfolgen möchten. Wählen Sie die gewünschte Protokolldatei und klicken Sie auf \'Zeigen\'.</p>
";
	

// Help box - User

$lang['help_box_user_users']=$lang['help_box_user_users_edit']="
<h3>Benutzerdaten</h3>
<p>Hier kann jeder Benutzer seine persönlichen Daten wie z. B. \'Echter Name\' und sein Passwort ändern. </p>
<p>Der Benutzername (Login-Name) kann nicht verändert werden. Sie müssen sich dazu als Administrator anmelden, den Benutzer löschen und mit seinem korrekten Namen neu anlegen.</p>
";

$lang['help_box_user_filemanager']="
<p>Im Dateimanager können Sie auf Ihre Dateien auf ".NAME." zugreifen - sogar von unterwegs.</p>
<h3>Navigation</h3>
<p>Navigieren Sie zu einem Ordner, indem Sie auf den Pfeil rechts neben dem Ordnernamen anklicken oder auf den Ordnernamen doppelklicken, und navigieren Sie eine Ebene nach oben, indem Sie den Pfeil links anklicken oder in die Zeile /home/username/ klicken.</p>
<h3>Datei- und Ordnerfunktionen</h3>
<p>Klicken Sie auf Dateien oder Ordner und verwenden Sie die Symbole in der Dateifunktionsleiste, um verschiedene Aktionen durchzuführen. Folgende Funktionen stehen zur Verfügung (von links nach rechts):</p>
<ul>
	<li>Ordner erstellen</li>
	<li>Datei hochladen</li>
	<li>Als ZIP herunterladen</li>
	<li>Dateien verschieben</li>
	<li>Dateien kopieren</li>
	<li>Umbenennen</li>
	<li>Rechte ändern</li>
	<li>Zum Album hinzufügen</li>
	<li>Löschen</li>
</ul>
<h3>Fotoalbum</h3>
<p>Um Ihre Fotos im ".NAME."-Fotoalbum anzuzeigen, müssen Sie die Fotos lediglich im home/storage/pictures-Katalog ablegen. </p>
<p>Wählen Sie dann die Dateien oder Ordner oder verwenden Sie das Symbol <strong>Zu Album hinzufügen</strong> in der Dateifunktionsleiste, um Ihre Fotos in das ".NAME."-Fotoalbum einzufügen. </p>
<p>Wechseln Sie zum Albummanager (über die ".NAME."-Startseite), um Ihre Fotos zu veröffentlichen.</p>
";

$lang['help_box_user_mail']="
<h3>E-Mail</h3>
<p>".NAME." kann Ihre E-Mails von allen externen E-Mail-Konten abrufen, die Sie besitzen. Die E-Mails werden auf ".NAME." gespeichert und sind per IMAP oder Webmail von überall aus zugänglich.</p>
<p>Aktive E-Mail-Konten werden hier angezeigt.</p>
<h3>".NAME." für E-Mail-Abruf einrichten</h3>
<p><strong>Neues E-Mail-Konto hinzufügen</strong> - Klicken Sie hier, um mit dem Abrufen von externen E-Mail-Konten zu beginnen. Geben Sie die Daten ein, die Sie vom Provider für Ihr E-Mail-Konto erhalten haben.</p>
";


$lang['help_box_user_mail_editfac']="
<p><strong>Konto bearbeiten</strong> - Bearbeiten Sie die E-Mail-Einstellungen für das externe E-Mail-Konto. Verwenden Sie die Daten, die Sie vom Provider für Ihr E-Mail-Konto erhalten haben.</p>
";


$lang['help_box_user_downloads']="
<h3>Downloads</h3>
<p>Verwenden Sie den Download-Manager von ".NAME.", um Dateien von überall direkt auf Ihr ".NAME." herunterzuladen. Sie benötigen lediglich eine Internetverbindung und einen Webbrowser.</p>
<p>Surfen Sie zu www.-your easyfind name-.myownb3.com. Wenn Sie sich bereits in Ihrem Heimnetzwerk befinden, navigieren Sie zu http://bubba/admin.</p>
<p>Große, zeitintensive Downloads werden von ".NAME." abgearbeitet, während der Computer ausgeschaltet ist. Wenn Sie den ersten Download starten, wird in Ihrem /home/[username]/ Ordner ein Katalog erstellt: /home/[username]/downloads. </p>
<h3>So können Sie etwas downloaden:</h3>
<ol>
  <li>Navigieren Sie zu http://bubba/admin (im Heimnetzwerk) oder zu www.-your easyfind name-.myownb3.com/admin.</li>
  <li>Melden Sie sich als Standardbenutzer bei ".NAME." an. </li>
  <li>Klicken Sie auf \'Downloads\'.</li>
  <li>Um einen Download zu starten, müssen Sie die URL zu der Datei (oder torrent), den Sie herunterladen möchten, kopieren* und in das Feld \'Speicherort\' auf Ihrem ".NAME." einfügen und auf \'Hinzufügen\' klicken. </li>
  <li>Wenn die Fortschrittleiste 100 % erreicht, ist der Download abgeschlossen. </li>
  </ol>
<p>*Zum Kopieren der URL klicken Sie einfach mit der rechten Maustaste auf die Datei (oder torrent). Je nach Browser und Datei wählen Sie im Rechtsklick-Menü die entsprechende Option: \'Shortcut kopieren\', \'Link-Ort kopieren\', \'Bildort kopieren\'</p>
<h3>Weitere Informationen</h3>
<p>Wenn Sie Dateien zum Downloaden hinzufügen, weist ".NAME." den Dateien einen Speicherort zu. Im /home/[username]/downloads/ Katalog kann es deshalb so aussehen, als wären die Dateien bereits heruntergeladen. Solange aber die Fortschrittleiste nicht 100 % erreicht hat, sind die Dateien noch nicht vollständig übertragen.</p>
<p>Der Download-Manager unterstützt die HTTP, FTP und bittorrent-Standarddownloads. Bei Verwendung des Download-Manager müssen in der Firewall keine Ports geöffnet werden; lediglich für torrent-Downloads wird empfohlen, die Ports 10000-14000 in den Einstellungen für die Firewall zu öffnen.</p>
<p> HINWEIS: Beachten Sie beim Herunterladen von bittorrents, dass der Download-Manager die Dateien freigibt, bis Sie \'Abbrechen\' oder \'Löschen\' drücken. </p>
";


$lang['help_box_user_music']="
<p>Geben Sie auf ".NAME." gespeicherte Musik auf jedem beliebigen PC wieder! Ihre Musikbibliothek ist verfügbar, wenn Sie sich als Standardbenutzer anmelden.</p>
";


$lang['help_box_user_album_albums']="
<p>Veröffentlichen Sie Ihre digitalen Fotos für Freunde und Familienmitglieder! ".NAME." bietet einfach zu verwendende, professionelle Fotoalben! Alles, was Sie benötigen, sind Ihre digitalen Fotos!</p>

<h3>Albumbetrachter hinzufügen</h3>
<p>Klicken Sie auf den Menüpunkt <b>Albumbetrachter</b>, um Benutzer für das nicht öffentliche Betrachten von Fotoalben hinzuzufügen.</p>

<h3>Alben hinzufügen</h3>
<p>Außer dem Administrator kann jeder, der bei ".NAME." registriert ist, Fotoalben erstellen und veröffentlichen.</p>
<ol>
  <li>Kopieren Sie die Ordner mit Ihren Bildern z. B. Mit dem integrierten Dateimanager oder mit dem Windows Explorer zu \\".NAME."\storage\pictures. </li>
  <li>Melden Sie sich als Standardbenutzer bei ".NAME." an.</li>
  <li>Klicken Sie auf \'Dateimanager\'.</li>
  <li>Navigieren Sie zu /home/storage/pictures.</li>
  <li>Wählen Sie die Ordner oder Bilder, die Sie als oder zu Fotoalben hinzufügen möchten.</li>
  <li>Wählen Sie das Symbol <strong>\'Zu Album hinzufügen\'</strong> in der Dateifunktionsleiste.</li>
  <li>Öffnen Sie den <strong>Album-Manager</strong>. Entscheiden Sie, ob die hinzugefügten Alben öffentlich sein sollen oder nicht. Die Standardeinstellung lautet nicht öffentlich.</li>
  <li>Klicken Sie auf Ihr Album auf der linken Seite des Bildschirms.</li>
  <ul>
  	<li>Wählen Sie nun entweder die Benutzer, die Ihr Album ansehen dürfen, und klicken Sie dann auf Aktualisieren.</li>
  	<li>Oder klicken Sie auf \'Öffentlich\', wenn das Album für jeden, der auf Ihr ".NAME." zugreifen kann, sichtbar sein soll. Klicken Sie dann auf Aktualisieren.</li>
  </ul>
  <li>Fertig!</li>
</ol>

<h3>Alben bearbeiten</h3>
<p>Klicken Sie auf das Album, Das Sie bearbeiten möchten. </p>
<ul>
  <li>Um den Alben- oder Bildtitel zu bearbeiten, geben Sie den Text ein und klicken dann auf \'Aktualisieren\'. </li>
  <li>Um ein Album zu löschen, markieren Sie das Album und klicken dann auf \'Album löschen\'.</li>
  <li>Um ein Bild zu löschen, markieren Sie das Bild und klicken dann auf \'Aus Album entfernen\'.</li>
</ul>

<p>Ihre Fotoalben können unter <a href='http://".NAME."/album' target='_blank'>http://".NAME."/album</a> (<a href='http://".NAME.".local/album' target='_blank'>http://".NAME.".local/album</a> für Mac) im Heimnetzwerk bzw.  unter www.-your easyfind name-.".NAME."server.com bei Zugriff von außerhalb des Netzwerkes angezeigt werden.</p>
";

$lang['help_box_user_album_users']="
<h3>Benutzer hinzufügen</h3>
<ul>
  <li>Öffentliche Alben können von jedem angesehen werden; Sie brauchen keine Albumbenutzer erstellen. </li>
	<li>Nicht öffentliche Alben sind passwortgeschützt; hier müssen Benutzer hinzugefügt werden.</li>
	<li>Denken Sie daran, dass ".NAME."-Benutzer und Albumbetrachter nicht identisch sind.</li>
<ol>
  <li>Klicken Sie auf \'Betrachter hinzufügen\'.</li>
  <li>Geben Sie die erforderlichen Daten ein.</li>
</ol>

";
?>
