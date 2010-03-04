<?

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

