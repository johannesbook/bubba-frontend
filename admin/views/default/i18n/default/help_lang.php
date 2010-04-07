<?

// External links
$lang["help_box_manual_link"] = "Bubba Manual";
$lang["help_box_forum_link"] = "Forum";
$lang["help_box_excito_link"] = "Excito web site";
$lang["help-box-further-info"] = "Additional resources";

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
<p>Welcome to Bubba!</p>
<p>Listen to music, look at your photos, and access your emails and files. You have all your important information and fun just a mouse click away!</p>
<p></p>
";

// Help box - Default page logged in as admin
$lang['help_box_login']=$lang['help_box_index']="
<p>Logged in as administrator you have access to the system settings. Click the <strong>gear wheel</strong> to administrate your Bubba.</p>
<p>Only use the administrator login to manage Bubbas settings. Your everyday use should be done with another user.</p>
";


// User pages
$lang['help_user_users']="?page=users.html#USERINFO";
$lang['help_user_mail']="?page=users.html#MAIL";
$lang['help_user_downloads']="?page=users.html#DOWNLOADS";
$lang['help_user_userinfo']="?page=users.html#USERINFO";
$lang['help_user_albums']="?page=users.html#PHOTOALBUM";


// Help box - Admin

$lang['help_box_stat']="
<p>This is the default administrator log in page.</p>
<p>Here you find information about the installed hard drive size and remaining disk space, Bubba uptime and the installed software revision number.</p>
<p>The '<strong>Shutdown</strong>' button powers off Bubba in the same way as pressing the button on the backside of the unit. To start up again, press the button on the backside.</p>
<p>The '<strong>Restart</strong>' button reboots Bubba.</p>
";

$lang['help_box_filemanager']=$lang['help_box_filemanager_cd']="
<p>From the File manager you are able to reach your files on Bubba if you are away from home.</p>
<h3>Navigation</h3>
<p>Navigate into a folder by clicking the arrow to the right of the folder name or double clicking it, navigate up one level by clicking the left arrow or click the /home/username/ line.</p>
<h3>File and folder actions</h3>
<p>Click files or folders and use the file function bar to perform different actions. The functions from left to right are:</p>
<ul>
	<li>Create folder</li>
	<li>Upload file</li>
	<li>Download as zip</li>
	<li>Move files</li>
	<li>Copy files</li>
	<li>Rename</li>
	<li>Change permissions</li>
	<li>Add to album</li>
	<li>Delete</li>
</ul>
<h3>Photos</h3>
<p>Logged in as administrator you are not able to add photos. Log with your standard user to add and manage photos.</p>
";

	$lang['help_box_filemanager_backup']="
	<ol>
    <li>Fill in a <strong>job name </strong>for the backup in the text box to the left on the screen and click 'Create job'. The new backup job gets automatically highlighted in the 'Existing jobs' column.</li>
    <li>Add the <strong>files you want to include</strong> in the backup job by clicking the 'Browse' button under the 'Included directories' menu. Subdirectories will automatically be included.</li>
    <li>If there are files in subdirectories that you want to <strong>exclude</strong>, click the 'Browse' button under the 'Excluded directories' menu and select the non wanted directories. </li>
    <li><strong>Select target </strong>for the backup job by clicking on the drop down menu to the right of 'Target'. If the destination directory will be created if it does not exist already.<br>
		  <ul>
		    <li>If choosing local USB / eSATA disk you have to select the disk by pressing the 'Disk' drop down list. Fill in the 'Destination directory' (i.e. 'my_ backup_folder\important\') or leave it blank for saving backup in the root directory.</li>
		    <li>If choosing remote SSH / FTP you have to fill in 'Host' (i.e. an IP-address), 'Destination directory' (i.e. 'my_ backup_folder/important/') or leave it blank for saving backup in the remote root directory, 'Remote user' and 'Remote password'.</li>
		   </li>
		  </ul>
	 </li>
    <li>Click '<strong>Backup schedule</strong>' to set the time and intensity to run the backup job. Also select how many full backups that should be saved.</li>
    <li>To increase security you have the option to<strong> encrypt the backup job</strong>. Click 'Data security', click 'Encrypt data' and select an encryption key.</li>
    <li>Click 'Update job' to save the settings.</li>
    <li>To run the job immediately, click 'Run now'.</li>
  </ol>
  ";
  
	$lang['help_box_filemanager_restore']=" 
	<ol>
    <li>Select the backup job under 'Existing jobs' you need to restore. </li>
    <li>Select the 'Backup date' to restore from.</li>
    <li>Select the files or folders (with automatically included files) you need to restore. The files that will be restored will be highlighted in blue.</li>
    <li>Choose in what way you want to restore the files: 'Restore missing files', 'Overwrite files' or 'Restore to directory'.</li>
    <li>Click 'Restore selection'</li>
  </ol>
  ";

$lang['help_box_users']="
	<h3>Add user</h3>
	  <p><strong>Users</strong> - Here you find all the registered users on your Bubba. Click on 'Edit user' to change user information.</p>
	  <p><strong>Add new user</strong> - To add a new user; fill in the information and click 'Add user'.</p>
	<h3>Edit user</h3>
	  <p><strong>Username</strong> - Changing the user name (login name) is not possible. To achieve this you will have to delete the user and add a new user with the correct name.</p>
	  <p><strong>Real name</strong> - To add the user's 'Real name'; fill in the information here.</p>
	  <p><strong>Remote administration</strong> - The default setting is to block remote access (from the WAN port) for the 'admin' account. To be able to administrate your Bubba from outside (Internet) of your network, edit the Administrator user and choose 'Allow remote access to config interface: Yes'.</p>
	  <p><strong>Change password</strong> - The administrator can change every users password. Every user has the possibility to change their own password via their own log in. It is strongly suggested that the <strong>admin password is changed</strong> from the default password.</p>
";

$lang['help_box_services']="
	 <h3>File sharing</h3>
  <p><strong>FTP</strong> - The Bubba FTP server.</p>
  <p><strong>Anonymous FTP access</strong>  - Allow users to log in to FTP server without a password.</p>
  <p><strong>AFP</strong> - The Apple Filing Protocol (AFP) is a network protocol that offers file services for Mac OS X and original Mac OS.</p>
	<p><strong>Windows file share</strong> - Windows file share (Samba) is used to share files and printerns in a Windows network.</p>
	<h3>Streaming</h3>
	<p><strong>UPnP streaming</strong> - Universal Plug and Play (UPnP) server. The server shares/streams media data  like audio/video/picture/files to UPnP-clients on the network. Please notice that if  you are located in a unsecure network; disable UPnP because otherwise you are able to  browse the whole file system via Mediatomb's web interface which could be a security risk. </p>
	<p><strong>DAAP streaming</strong> - Digital Audio Access Protocol (DAAP) server. Media server for the Roku SoundBridge and iTunes. </p>
	<p><strong>Squeezebox Server </strong>-  is a streaming audio server supported by Logitech that streams music to The Squeezebox product line.</p>
	<h3>Email</h3>
	<p><strong>Send and receive</strong> -  This is for postfix the smtp server: Sending and receiving emails.</p>
	<p><strong>Imap (Required for webmail access)</strong> - This is for dovecot the IMAP server. This service is required for the webmail access to be functional.</p>
	<p><strong>Email retrieval </strong>- This is for fetchmail, a daemon that collects emails to Bubba</p>
	<h3>Other</h3>
	<p><strong>Printing</strong> - Bubba  print server.</p>
	<p><strong>Up and downloads</strong> - possibility to up / download files on Bubba, i.e. filemanager and torrents.</p>
";

$lang['help_box_mail']=$lang['help_box_mail_index']="
	<p>If you set up Bubba to fetch your email from different external email accounts you may have, they will be stored on Bubba and available via IMAP or webmail, wherever you are. Logged in as administrator you must select to which user the retrieved email should be directed, this must be done for every retrieved email account added. Prior to this you must have added a user.</p>
	<p><strong>Retrieve email from individual accounts</strong> - Shows your current accounts for email retrieval.</p>
	<p><strong>Add account</strong> - To fetch email from an external accout, fill in the information given to you by your email account provider.</p>
";
	
$lang['help_box_mail_server_settings']="
	<h3>Outgoing email</h3>
  <p><strong>Outgoing email server</strong> - Leave fields empty to let Bubba handle your outgoing emails. If your ISP blocks your outgoing traffic on port 25you must use an alternative SMTP server than Bubba, fill in the information provided to you by your ISP.</p>
	<h3>Your own domain</h3>
	<p>If you have your own domain name it is possible to let Bubba handle your incoming and outgoing email.</p>
	<p><strong>Handle email for domain</strong> - Enter your domain name here. If you have several domains, just type them in the box space separated.</p>
";


$lang['help_box_network']=$lang['help_box_network_profile']=$lang['help_box_update_profile']="
  <p>Automatic settings will work in most cases, you do probably not need to change this. Read the technical manual if you need further information.</p>
	<p><strong>Automatic network settings</strong> - Bubba will automatically try to set an appropriate network configuration.</p>
	<p><strong>Router + Firewall + Server</strong> - Bubba will automatically try to retreive network settings on WAN (internet), and use fixed network settings on the local network providing other computers with network information.</p>
	<p><strong>Server only</strong> - Bubba will automatically try to retreive network settings on LAN (local network) and the WAN port should be left unconnected.</p>
	<p>After editing the network settings you might need to reboot your computers and other network devices in your LAN.</p>
	<p><i>Update</i> saves your changes.</p>
";
	
$lang['help_box_network_wan']="
	<p>Here you configure how your Bubba will handle your Wide Area Network (WAN) port. The default setting is to Obtain an IP address.</p>
	<p><strong>Obtain IP-address automatically (DHCP)</strong> - The Dynamic Host Configuration Protocol (DHCP) automates  the assignment of IP address, Netmask, Default gateway, and other IP  parameters. Use this option if your internet provider requires you to use DHCP. This is the default and most common option.</p>
	<p><strong>Use static IP address settings</strong> - Static IP address, Netmask, Default gateway and Primary DNS are  manually assigned to Bubba by the administrator. Use this option if your internet provider requires you to manually enter the values.</p>
  <p>Please notice that the WAN settings are not editable in the profile 'Automatic network settings', shown for information only.</p>
	<p><i>Update</i> saves your changes.</p>
";
	
$lang['help_box_network_lan']="
	<p>Here you configure how you reach your Bubba from computers in your Local Area Network (LAN). Your Bubba has an auto detect function on the LAN port. This means that when connected, Bubba will search the LAN for a DHCP server. If a DHCP server is found, Bubba will configure itself to obtain an IP address on  the LAN port. If no DHCP server is found, Bubba will fall back to the static IP address <strong>192.168.10.1</strong>. </p>
	<p><strong>Obtain IP-address automatically</strong> - Use this option if you use another DHCP server than Bubba in your LAN, for example a router or gateway. Bubba will obtain an IP address automatically.</p>
  <p><strong>Use static IP address settings - </strong>Your Bubba will be reached on this static IP address in your LAN. The default fall back IP is : <a href='http://192.168.10.1' target='_blank'>192.168.10.1</a>.</p>
  <ul>
  	<li><strong>Enable DNS service</strong> - The Domain Name System (DNS) translates domain names into IP addresses. When you type in a domain name, the DNS server translates the name into the corresponding IP address. </li>
    <li><strong>Enable DHCP server</strong> - The  DHCP server gives out IP addresses when a device, connected into Bubba's LAN port, is starting up and  requests an IP address. The device must be set as a DHCP client to 'Obtain  IP address automatically'.</li>
    <li><strong>Lease range</strong> - The DHCP address pool  (Lease range) contains the range of the IP address that will automatically be  assigned to the clients (for example computers, media players) on the network.</li>
  </ul>
  <p><strong>Enable Jumbo frames</strong> - This option enables transmissions of larger data chunks on the LAN interface. <strong>WARNING</strong> - this requires that all equipment on the LAN works in this environment. Use with caution. That said, this feature can improve performance on file transfers between Bubba and Gigabit capable devices.</p>
	<p><strong>DHCP leases </strong>- Shows the current network devices in your LAN when having Bubba as your router. If several network devices has the same hostname the last connected will be shown as a *.</p>
	<p>Please notice that the LAN settings are not editable in the profile 'Automatic network settings', shown for information only.</p>
	<p><i>Update</i> saves your changes.</p>
";
	
$lang['help_box_network_wlan']="
	<p>Bubba can act as your access point, both in 'Router + Firewall + Server' or in 'Server only' mode.</p>
	<h3>Wireless</h3>
  <p><strong>Enable wireless</strong> - Select this box to enable the wireless access point in Bubba.</p>
  <p><strong>Network name (SSID</strong>) - This is the name that identifies a particular wireless network. The default name is your Bubbas host name. The SSID can be up to 32 characters long.</p>
  <p><strong>Password</strong> - The password (aka pass phrase) is a set of characters that must be entered exactly the same in both your Bubba and your network clients. Enter the password in ASCII characters. The length must be between 8 to 63 for WPA and 5 or 13 characters for WEP.</p>
  <h3>Advanced wireless settings</h3>
  <p><strong>Encryption </strong>- Choose between WEP, WPA1 or WPA2. WEP is not recommended due to low security.</p>
  <p><strong>Channel </strong>- Select the channel on your wireless access point in Bubba. In areas with several wireless networks, lower transfer speeds may be experienced. Then try a different channel. Channel availability is different for different countries due to regulations.</p>
  <p><strong>Broadcast SSID </strong>- Uncheck this box to hide Bubbas SSID. By default the SSID is  broadcasted.</p>
  <p><i>Update</i> saves your changes.</p>
";
	
$lang['help_box_network_fw']="
	<p>Bubba has an built in firewall to protect your internal network and Bubba itself.</p>
	<h3><strong>Allow external (WAN) access Bubba services</h3>
  <p><strong>SSH (Port 22)</strong> - Enables Secure Shell (SSH) to Bubba from WAN.</p>
  <p><strong>Email server (Port 25)</strong> - Enables access from WWW to Bubba's port 25. This is the default emailserver port for sending and receiving email.</p>
  <p><strong>WWW (HTTP / HTTPS Ports 80 / 443)</strong> - Enables WWW traffic to Bubba from WAN.</p>
  <p><strong>Email (IMAP / IMAPS Ports 143 / 993)</strong> - Enables access from WWW to Bubba's ports 143 and 993. These ports are used for sending and receiving email.</p>
  <p><strong>FTP (Port 21)/strong> - Enables FTP connections from WAN to Bubba's port 21.</p>
  <p><strong>Downloader (Ports 10000-14000)</strong> - Enables faster torrent download. This rule opens the ports 10000-14000.</p>
  <p><strong>Respond to ping (ICMP type 8)</strong> - Enables ping from WAN. The default setting disables computers on the Internet to get a reply back from Bubba when it is being 'pinged'. This increases the security.</p>
  <h3>Advanced firewall settings</h3>
	<p>Choose 'Port forward to internal network' or '   Open Bubba|2 port' with the radio buttons. The first will open a port from Internet (WAN) to a network device in your internal network (LAN). The later one will open a port from Internet (WAN) to Bubba.</p>
	<p><strong>Source IP</strong> - The source IP on the WAN side that the port forward will be directed to. Enter 'all' if all the port forward are not directed to a specific IP address.</p>
  <p><strong>Public port</strong> - The port number on the WAN side. You can input a single port or a range of  ports (ex. 4001:4005).</p>
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
	<p>Extend your home partition with an attached external disk. This will create a single logical volume of the internal home partition and an attached disk. In other words, you will experience one big disk instead of two smaller. The total disk size will be the external disk size added to home partition size.</p>
	
	<h3>Warning</h3>
	<p><strong>Please notice that this is an non reversible operation. After your system has been extended together with the external drive, your system will always need to be connected to the external drive - and will not function without it. To be able to use your Bubba standalone again, you will need to reinstall the whole system.</strong></p>
  <p><strong>An old LVM disk will automatically be connected and included into the Bubba system upon boot, even though you have not set up your Bubba for an LVM extension. It is impossible to remove the extension without reinstallation. To format an old external LVM extended disk, connect the disk to a already running Bubba. Then choose 'Format' in the 'Disk -&gt; Information' menu.</strong></p>
		
	<h3>Create Extended disk (LVM)</h3>
	<ol>
  	<li>Attach a external disk, USB or eSATA. Please notice that the disk should be pre formatted, without old RAID or LVM systems.</li>
  	<li>Select the 'Home partition' and the partition from the external disk (for example /dev/sdb). </li>
  	<li>Click 'Extend partition'.</li>
  	<li>Wait for the progress bar to complete.</li>
  	<li>When finished, your system has been extended together with the external drive.</li>
  </ol>
  <h3>Remove Extended disk (LVM)</h3>
	<p>To remove Extended disk (LVM) from your system you need to reinstall the whole system.</p>
";
	
$lang['help_box_disk_raid']="
	<p>The RAID function in Bubba combines the /home partition and one external hard disk into a single logical unit.</p>
	
	<h3>Important</h3>
	<ul>
		<li><strong>Warning!</strong> The process will destroy all user data - both on the internal and external disk.</li>
		<li>An old RAID disk will automatically be connected and included into the Bubba system upon boot, even though you have not set up your Bubba for a RAID extension. It is impossible to remove the extension without reinstallation. To format an old external RAID extended disk, connect the disk to a already running Bubba. Then choose 'Format' in the 'Disk -&gt; Information' menu.</li>
  	<li>To get out the most of your disks, use an external disk in the same size as your internal disk in Bubba.</li>
  	<li>Total capacity of the array equals the capacity of the smallest disk in the array.</li>
  	<li>It will take some time to create or restore a RAID array. For a 1TB disk it will take about 4 hours. This is handheld in the background of the Bubba system and will not be indicated to the user.</li>
  	<li>To reuse your Bubba standalone without the RAID setup you have to reinstall your Bubba system.</li>
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
	<p><strong>List of RAID arrays</strong> - shows the total disk space, i.e. the smallest available disk (the Bubba /home partition or the external eSATA disk) in the array.</p>
  <p><strong>List of RAID disks</strong> - shows the disks attached to the RAID system.</p>

	<h3>Recover an external disk</h3>
	<p>If you have a disc failure or if you have by mistake disconnected the external disk you will need to do the following.</p>
	<ol>
  	<li>Delete the external disc from the 'List of RAID disks' by clicking 'Remove'.</li>
    <li>Disconnect the external disk from the backside of Bubba.</li>
    <li>Attach a new external disk.</li>
    <li>Click 'Recover RAID array'.</li>
    <li>Select which external disk to add to RAID array. Click 'Recover array'.</li>
    <li>Warning! All data will be erased from the external disk. Click 'Recover array'.</li>
    <li>Press 'Close' to continue working with Bubba. The synchronization is in progress.</li>
  </ol>
  
";
$lang['help_box_printing']="
<p>With the Print Server you will get easy and comfortable printer access. Bubba gives you a more efficient way of using your printer in your home- or in your office-networks. The print server allows multiple users to share a printer from anywhere on the network without sharing one PC. All you need is a USB printer and its drivers.</p>
<h3>Installation</h3>
<ol>
  <li>Connect your USB printer to Bubba's USB connector.</li>
  <li>Press 'Add new'.</li>
  <li>The printer name shows, add this printer and fill out  the requested information.</li>
  <li>From your PC, browse via samba (use for example Explorer in Windows) to <a href='file:///\\bubba\'>\\bubba\</a>. </li>
  <li>The printer will now show up next to the home and  storage folders. Double click the printer icon.  </li>
  <li>You will be prompted for the printer driver, follow  the instructions and install the printer. When this is done, the printer is ready to be used. Repeat steps 4-6 for all computers using the printer.</li>
</ol>
";

$lang['help_box_settings']=$lang['help_box_settings_startwizard']="
<p>Use the integrated Setup wizard to make the very first important settings on your Bubba such as time and date, add users and make network settings. You can run the wizard at any time later on as well to do this setup.</p>
<p><strong>Step 1 - Date and time</strong></p>
<p>Choose time zone and the date and time. You also have the possibility to use an Internet time server. By doing this the date and time is automatically set and updated and you do not have to do any manual time settings. Click 'Next' to continue.</p>
<p><strong>Step 2 - Create user</strong></p>
<p>Create a user, or as many as you desire. Click 'Add user' after filling in the user information. Click 'Next' to continue.</p>
<p><strong>Step 3 - Network setup</strong></p>
<p>Choose if you would like to register for a free Easyfind name. You will reach your Bubba by surfing to www.-your easyfind name-.bubbaserver.com. Click 'Next' to continue.</p>
<p><strong>Setup complete</strong></p>
<p>Click 'Finish setup' to exit the wizard.</p>
";

$lang['help_box_settings_identity']="
<h3>System identity</h3>
<p><strong>Hostname</strong> - is the unique name by which a network-attached device is known on a network.</p>
<p><strong>Workgroup</strong> - Devices in the same Workgroup may allow each other access to their files, printers, or Internet connection. Use the same workgroup name on Bubba as on your computer.</p>
<h3>Easyfind options</h3>
<p><strong>Use 'Easyfind' to locate your Bubba</strong> - Using our free service Easyfind you will be able to reach your Bubba wherever you are. You will be able to find your Bubba wherever you are typing www.-your easyfind name-.bubbaserver.com. <strong>Easyfind only works with http and https protocols</strong>.</p>
<p><strong>Easyfind name</strong> - Choose a name for your Bubba on the Easyfind network.</p>
";

$lang['help_box_settings_trafficsettings']="
<p>To control the maximum upload / download speed on your torrents adjust the 'Traffic' setting.</p>
<p>For example if you have a limited broadband connection you do not want to fill your uplink completely. Then set the 'Max upload speed' to a preferred value. Use 'Max download speed' in the same manner.</p>
<p>Using  -1 as value = no speed limit.</p>
<p><i>Update</i> saves your changes.</p>
";

$lang['help_box_settings_datetime']="
<h3>Date and time</h3>
<p><strong>Current timezone is</strong> - Shows the selected timezon.</p>
<p><strong>Select timezone</strong> - Select your timezone in the drop down list.</p>
<p><strong>Set time automatically</strong> - This enables Bubba to set the date and time automatically via an internet server.</p>
<p><strong>Date</strong> - Set the system date manually.</p>
<p><strong>Time</strong> - Set the system time manually.</p>
";

$lang['help_box_settings_backuprestore']="
<p>'Config backup' will backup all your Bubba settings, nice to have in case you reinstall Bubba or move the settings to another Bubba unit. The following settings will be saved :</p>
<ul>
  <li>User accounts (including admin login via WAN setting, passwords) but no user data</li>
  <li>Backup jobs</li>
  <li>Services settings</li>
  <li>Email account settings</li>
  <li>Network setup (all settings ie profile, hostname, wireless settings, firewall rules etc)</li>
  <li>Printers</li>
</ul>
<h3>Perform a backup</h3>
<ol>
  <li>Insert an external storage device (USB memory or USB disk) into Bubba. </li>
  <li>Choose the Source/Destination and press Backup. </li>
  <li>All settings are now saved on a file on the chosen external storage device. </li>
</ol>

<h3>Restore a backup</h3>
<ol>
  <li>Insert the storage device containing the backup file into Bubba.</li>
  <li>Observe that the current users on Bubba will be removed and the users stored in the backup file will be restored. Although the user data from current users on Bubba will be left intact in the /home/[user] catalogue.</li>
  <li>Press restore. </li>
  <li>You might need to reconnect your Bubba depending on how your restored network settings are configured.</li>
  </ol>
";

$lang['help_box_settings_software']="
<h3>Update software</h3>
<p>Bubba's software can easily be updated to gain new functionality. Press 'Update', and the update is automatically performed. Please have patient, it might take a while to perform an update.</p>
<p>After an update, status information is shown. Press the '+' sign to show the complete message.</p>
<h3>Hotfixes</h3>
<p>This feature collects status information from your Bubba and sends to Excito for automated analysis. The update server can then take appropriate actions if your system has problems. The system information is sent to Excito via an encrypted connection, and server responses are GPG signed to ensure the security and that the content is distributed by Excito.</p>
<p>By default this feature is enabled. To disable it uncheck the box. If doing so you might not get the most important updates to your Bubba. </p>
<p><strong>Any information collected by Excito will never be exposed to any other party than Excito. The information will only be used to pin point errors and perform the best matched updates for your Bubba.</strong></p>
<p>All information that is collected is listed below.</p>
<ul>
  <li>MAC address </li>
  <li>IP addresses</li>
  <li>Serial number and key</li>
  <li>RAM memory size</li>
  <li>CPU modell </li>
  <li>Status for the installed bubba specific packages</li>
  <li>The log file /tmp/bubba-apt.log if existing</li>
  <li>Current software release version</li>
  <li>Current running kernel</li>
  <li>Root disc partition usage</li>
  <li>Disc partition setup (LVM/RAID) </li>
</ul>

";

$lang['help_box_settings_logs']="
<p>To fault trace on your Bubba without logging in with SSH use the Logs function. Select the desired log file in the drop down menu and click 'Show'.</p>
";
	

// Help box - User

$lang['help_box_user_users']=$lang['help_box_user_users_edit']="
<p>Here every user can change the personal information, such as 'Real name' and password. Changing the user name (login name) is not possible. To achieve this you will have to delete the user via the administrator login and add a new user with the correct name.</p>
";

$lang['help_box_user_filemanager']="
<p>From the File manager you are able to reach your files on Bubba if you are away from home.</p>
<h3>Navigation</h3>
<p>Navigate into a folder by clicking the arrow to the right of the folder name or double clicking it, navigate up one level by clicking the left arrow or click the /home/username/ raw.</p>
<h3>File and folder actions</h3>
<p>Click files or folders and use the file function bar to perform different actions. The functions from left to right are:</p>
<ul>
	<li>Create folder</li>
	<li>Upload file</li>
	<li>Download as zip</li>
	<li>Move files</li>
	<li>Copy files</li>
	<li>Rename</li>
	<li>Change permissions</li>
	<li>Add to album</li>
	<li>Delete</li>
</ul>
<h3>Photos</h3>
<p>You have to place your photos in the catalog home/storage/pictures. Then select the files or folders and use the <strong>Add to album</strong> icon in the file function bar to add your photos to the Bubba photo album. Then continue to the Album manager to publish the photos.</p>
";

$lang['help_box_user_mail']="
<p>If you set up Bubba to fetch your email from other external email accounts you may have, they will be stored on Bubba and available via IMAP or webmail, wherever you are.</p>
<p><strong>Retrieve email from individual accounts</strong> - Shows your current accounts for email retrieval.</p>
<p><strong>Add account</strong> - To fetch email from an external accout, fill in the information given to you by your email account provider.</p>
";


$lang['help_box_user_mail_editfac']="
<p><strong>Edit account</strong> - Edit the email settings for the external email account. Use the information given to you by your email account provider.</p>
";


$lang['help_box_user_downloads']="
<p>Use the Bubba download manager to download files directly to your Bubba, wherever you are. The only thing you need is a internet connection and a web browser. Surf to www.-your easyfind name-.bubbaserver.com. Of course if you already are in your home network browse to http://bubba/admin.</p>
<p>Large, time consuming downloads are handled by Bubba while your computer is turned off. When you initiate your first download a catalogue is created in your /home/[username]/ directory: /home/[username]/downloads. </p>
<h3>How to download</h3>
<ol>
  <li>At home browse to http://bubba/admin or away from home www.-your easyfind name-.bubbaserver.com/admin.</li>
  <li>Log in as your standard user. </li>
  <li>Click 'Downloads'.</li>
  <li>To initiate a download you need to copy* the URL to the file (or torrent) you desire to download and paste it into the 'Location' field on your Bubba and click 'Add'. </li>
  <li>When the progress bar reaches 100% your download is completed. </li>
  </ol>
<p>*To copy the URL simply right click on the file (or torrent). Depending on which browser you use and what type of file you desire to download select the appropriate in the right click menu: 'Copy Shortcut', 'Copy Link Location', 'Copy Image Location'</p>
<p>As you add files for download, Bubba allocates disk space for the files. If you look in the /home/[username]/downloads/ catalogue it seems as if the files exist but as long as the progress bar still not has reached 100% the files are not complete.</p>
<p>Currently the download manager support the standards HTTP, FTP and bittorrent downloads. You don't need to open any ports in your firewall when using the download manager, but for torrent downloads it is recommended to open the ports 10000-14000 under 'Integrated Bubba services' in section Network-&gt;Firewall.</p>
<p>NOTE: When downloading bittorrents, note that the download manager will continue to share the file until you press 'Cancel' or 'Clear'. </p>
";


$lang['help_box_user_music']="
<p>Play your music stored on Bubba from any PC in the world! Your music library is available when logged in as your standard user.</p>
";


$lang['help_box_user_album_albums']="
<p>Share your digital photos with friends and family! With Bubba you get easy to use, out of the box photo album! All you need is your digital pictures!</p>
<p><strong>Features:</strong></p>
<ul>
  <li>Automatic thumbnail creation - fast and convenient album viewing for those with limited bandwidth.</li>
  <li>Drag and drop image support in administrator interface.</li>
  <li>Add captions for each photo or album in your collection.</li>
  <li>Your images are safe on your own Bubba instead of hosted somewhere else.</li>
  <li>Slide show function.</li>
  <li>Public or password protected albums.</li>
  <li>Easy to use.</li>
</ul>

<h3>Add albums</h3>
<p>Every user on Bubba can create and publish photo albums, except for the administrator.</p>
<ol>
  <li>Copy the folders containing your pictures to \\bubba\storage\pictures, with for example the built in Filemanager or Windows Explorer. </li>
  <li>Log in as your standard user on Bubba.</li>
  <li>Click 'Filemanager'.</li>
  <li>Browse to /home/storage/pictures.</li>
  <li>Select the checkboxes next to the catalogs you wish to add as photo albums.</li>
  <li>In the Action drop down list, select 'Add to album'.  </li>
  <li>Click Add.</li>
  <li>Now you have to decide if the added albums should be public or private. Click 'Photo album' -&gt; 'Albums'.</li>
  <li>Click your album, on the left side of the screen.</li>
  <li>By default all added albums are private.</li>
  </ol>
<ul>
  <li>Ether select the users who you would like to share the album with.</li>
  <li>Or click 'Public' if you want the album to be open to anyone who can access your Bubba.</li>
  </ul>
  <li>Done!</li>
</ol>
<p>To add an empty album, press 'Add album' in the 'Photo album' -&gt; 'Albums' section. Now you can drag and drop photos and albums to create sub albums.</p>

<h3>Edit albums</h3>
<p>Click the album you wish to edit. </p>
<ul>
  <li>To edit album or picture caption select the object, enter text and click 'Update'. </li>
  <li>To delete an album, select the album and press 'Delete album'.</li>
  <li>To delete a picture, select the picture and press 'Remove from album'.</li>
</ul>

<p>Your photo album will be visible by browsing to <a href='http://bubba/album' target='_blank'>http://bubba/album</a> (<a href='http://bubba.local/album' target='_blank'>http://bubba.local/album</a> if using Mac) from inside your home network, or by browsing to 'http://www.&lt;my domain&gt;.com/album' from outside your network.</p>
";

$lang['help_box_user_album_users']="
<h3>Add users</h3>
<p>If you your albums should be public and seen by anyone, you do not have to add any album users. But you have the possibility to add users and create password protected albums to keep your pictures private for you and your family. Remember that the Bubba users and photo album users are not the same. </p>
<ol>
  <li>Click 'Add user'.</li>
  <li>Fill in the required information.</li>
</ol>

";

