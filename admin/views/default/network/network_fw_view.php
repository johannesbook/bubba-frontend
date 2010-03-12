<?if (isset($success) && !$success):?>
<?=t('Update failure')?><br />
<?endif?>

<script language ="JavaScript">

function SubmitForm(form_to_submit) {
	var myform = getElementByName(form_to_submit);
	myform.submit();
}	

function enable_portforward() {
  var frm=document.getElementById("PORTCFG");
  var tags=frm.getElementsByTagName("input");
  var i;

  for(i=0;i<tags.length;i++){
  switch(tags[i].name){
    case "to_port":
    case "to_ip":
         tags[i].disabled=false;
    default:
    	break;
    }
  }
}	
function disable_portforward() {
  var frm=document.getElementById("PORTCFG");
  var tags=frm.getElementsByTagName("input");
  var i;

  for(i=0;i<tags.length;i++){
  switch(tags[i].name){
    case "to_port":
    case "to_ip":
         tags[i].disabled=true;
         tags[i].value="";
    default:
    	break;
    }
  }
}	

function copy_fields(formid) {

   var frm=document.getElementById(formid);
   var tgs=frm.getElementsByTagName("input");
   var PORTCFG=document.getElementById("PORTCFG");
   var i;

   for(i=0;i<tgs.length;i++){
       switch(tgs[i].name){
          case "removerule[portforward]":
             PORTCFG.portforward.value = tgs[i].value;
             PORTCFG.o_portforward.value = tgs[i].value;
             break;
          case "removerule[source]":
             PORTCFG.source.value = tgs[i].value;
             PORTCFG.o_source.value = tgs[i].value;
             break;
          case "removerule[dport]":
             PORTCFG.dport.value = tgs[i].value;
             PORTCFG.o_dport.value = tgs[i].value;
             break;
          case "removerule[to_port]":
             if(frm.to_port.value) { // Portforward
               
               PORTCFG.to_port.value = tgs[i].value;
               PORTCFG.o_to_port.value = tgs[i].value;
             } else {
               PORTCFG.to_port.value = "";
               PORTCFG.o_to_port.value = "";
             }
             break;
          case "removerule[to_ip]":
             if(frm.to_port.value) { // Portforward
               PORTCFG.to_ip.value = tgs[i].value;
               PORTCFG.o_to_ip.value = tgs[i].value;
               PORTCFG.o_portforward.value = 1;
               PORTCFG.p_forward.checked = true;
               enable_portforward();
             } else { // Bubba|Two port
               PORTCFG.to_ip.value = "";
               PORTCFG.o_to_ip.value = "";
               PORTCFG.B2public.checked = true;
               PORTCFG.o_portforward.value = 0;
               disable_portforward();
            }
             break;
          case "removerule[protocol]":
             PORTCFG.protocol.value = tgs[i].value;
             PORTCFG.o_protocol.value = tgs[i].value;
             break;
          default:
          	break;
          }

    }
}

</script>

<form id="FWCFG" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
<fieldset >
<table id="firewall">
    <tr><td colspan="5" class="ui-state-default ui-widget-header"><?=t('Integrated Bubba services')?></td></tr>
	<tr>
		
		<td>
			<?=t('Allow SSH from WAN')?>:<br /><div class="portnumber">(Port 22)</div>
		</td>
		<td>
			<input type="checkbox" class="checkbox_radio" name="allowSSH" <?if($allowSSH) echo "checked=\"checked\""?>/>
		</td>
		
		<td>
			<?=t('Allow WAN access to mail server')?>:<br /><div class="portnumber">(Port 25)</div>
		</td>
		<td>
			<input type="checkbox" class="checkbox_radio" name="allowMail" <?if($allowMail) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		
		<td>
			<?=t('Allow WWW from WAN')?>:<br /><div class="portnumber">(HTTP / HTTPS Ports 80 / 443)</div>
		</td>
		<td>
			<input type="checkbox" class="checkbox_radio" name="allowWWW" <?if($allowWWW) echo "checked=\"checked\""?>/>
		</td>
		
		<td>
			<?=t('Allow WAN access to Mail')?>:<br /><div class="portnumber">(IMAP / IMAPS Ports 143 / 993)</div>
		</td>
		<td>
			<input type="checkbox" class="checkbox_radio" name="allowIMAP" <?if($allowIMAP) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		<td>
			<?=t('Allow FTP from WAN')?>:<br /><div class="portnumber">(Port 21)</div>
		</td>
		<td>
			<input type="checkbox" class="checkbox_radio" name="allowFTP" <?if($allowFTP) echo "checked=\"checked\""?>/>
		</td>
		
		<td>
			<?=t('Open ports for torrent downloader')?>:<br /><div class="portnumber">(Ports 10000-14000)</div>
		</td>
		<td>
			<input type="checkbox" class="checkbox_radio" name="allowTorrent" <?if($allowTorrent) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>		
		<td>
			<?=t('Allow Ping from WAN')?>:<br /><div class="portnumber">(ICMP type 8)</div>
		</td>
		<td>
			<input type="checkbox" class="checkbox_radio" name="allowPing" <?if($allowPing) echo "checked=\"checked\""?>/>
		</td>
		<td width="20" colspan="3"></td>
	</tr>
	<tr>
    <td colspan="5">&nbsp;</td>
	</tr>
	
</table>
<input type="submit" value='<?=t('Update')?>' name='update'/>

</form>

<form id="PORTCFG" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
<fieldset id="firewall">
<table id="firewall">
    <tr><td colspan="6" class="ui-state-default ui-widget-header"><?=t('Open port')." / ".t('Add port forward')?></td></tr>
	<tr>
		<td class="p_fw_c0"></td>
		<td class="p_fw_c3" colspan="2">
			<input id="p_forward" type="radio" name="portforward" value=1 class="checkbox_radio" <? if($portforward) echo "checked=\"checked\"";?> onclick="enable_portforward()"/>&nbsp;&nbsp;
			<?=t('Port forward')?>
		</td>
		<td class="p_fw_c1" colspan="2">
			<input id="B2public" type="radio" name="portforward" value=0 class="checkbox_radio" <? if(!$portforward) echo "checked=\"checked\"";?> onclick="disable_portforward()"/>&nbsp;&nbsp;
			<?=t('Open BUBBA|TWO public port')?>
		</td>
		<td class="p_fw_c5">
		</td>
		<td class="p_fw_c6"></td>
	</tr>
	<tr>
		<td class="p_fw_c0"></td>
		<td class="p_fw_c1">
			<?=t('Source IP')?>
		</td>
		<td class="p_fw_c2">
			<?=t('Public port')?>
		</td>
		<td class="p_fw_c3">
			<?=t('Private port')?>
		</td>
		<td class="p_fw_c4">
			<?=t('Private IP')?>
		</td>
		<td class="p_fw_c5">
			<?=t('Protocol')?>
		</td>
		<td class="p_fw_c6"></td>
	</tr>
	<tr>
		<td  class="p_fw_c0"></td>
		<td class="p_fw_c1">
			<?
			if(isset($new_port["source"]))
				if(!$new_port["source"])
					$new_port["source"] = "all";
			?>
			<input type="text" name="source" size="15" <?=isset($err_portforward["source"])?"class=\"err\" ":""?><?=isset($new_port["source"])?"value=\"".$new_port["source"]."\"":"value=\"all\""?>/>
		</td>
		<td class="p_fw_c2">
			<input type="text" name="dport" size="15" <?=isset($err_portforward["dport"])?"class=\"err\" ":""?><?=isset($new_port["dport"])?"value=\"".$new_port["dport"]."\"":""?>/>
		</td>
		<td class="p_fw_c3">
			<input type="text" name="to_port" size="15" <?=$disabled?> <?=isset($err_portforward["to_port"])?"class=\"err\" ":""?><?=isset($new_port["to_port"])?"value=\"".$new_port["to_port"]."\"":""?>/>
		</td>
		<td class="p_fw_c4">
			<input type="text" name="to_ip" size="15" <?=$disabled?> <?=isset($err_portforward["to_ip"])?"class=\"err\" ":""?><?=isset($new_port["to_ip"])?"value=\"".$new_port["to_ip"]."\"":""?>/>
		</td>
		<td class="p_fw_c5">
			<select name="protocol">
				<option value="tcp">TCP</option>
				<option value="udp">UDP</option>
			</select>
		</td>
		<td class="p_fw_c6">
		</td>
	</tr>
	<tr>
		<td class="p_fw_c0">&nbsp;</td>
		<td class="err" colspan="6">
			<input type="hidden" name="o_source" />
			<input type="hidden" name="o_dport" />
			<input type="hidden" name="o_to_port" />
			<input type="hidden" name="o_to_ip" />
			<input type="hidden" name="o_protocol" />
			<input type="hidden" name="o_portforward" />
				<?
			$br="";
			if(isset($err_portforward["rm"])) {
				print $br . $err_portforward["rm"];
				$br = "<br />";
			}
			if(isset($err_portforward["add"])) {
				print $br . $err_portforward["add"];
				$br = "<br />";
			}
			if(isset($err_portforward["source"])) {
				print $br . $err_portforward["source"];
				$br = "<br />";
			}
			if(isset($err_portforward["dport"])) {
				print $br . $err_portforward["dport"];
				$br = "<br />";
			}
			if(isset($err_portforward["to_port"])) {
				print $br . $err_portforward["to_port"];
				$br = "<br />";
			}
			if(isset($err_portforward["to_ip"])) {
				print $br . $err_portforward["to_ip"];
				$br = "<br />";
			}
			?>
		</td>
	</tr>
	<tr>
		<td class="p_fw_c0"></td>
		<td>
			
		</td>
		<td colspan="6" class="legend">
			<?=t('Public port range accepted as start-port:stop-port')?><br />
			<?=t('Private port is start port if public port range entered')?><br />
		</td>
	</tr>
</table>
<input type="submit" value='<?=t('Update')?>' name='newport'/>

</form>


<fieldset id="firewall">
<table  id="firewall">
    <tr><td colspan="7" class="ui-state-default ui-widget-header"><?=t('User defined open / forwarded ports')?></td></tr>
	<tr>
		<td class="p_fw_c0"></td>
		<td class="p_fw_c1"><?=t('Source IP')?></td>
		<td class="p_fw_c2"><?=t('Public port')?></td>
		<td class="p_fw_c3"><?=t('Private port')?></td>
		<td class="p_fw_c4"><?=t('Private ip')?></td>
		<td class="p_fw_c5"><?=t('Protocol')?></td>
		<td class="p_fw_c6"></td>
	</tr>
</table>
  <?
  $i=1;
  foreach($fwports as $value):?>
	<form id="RMPORT_<?=$i?>" name="RMPORT_<?=$i?>" class="firewall" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
	<table id="firewall">
	<tr>
		<td class="p_fw_c0"></td>
		<!--
		<td>
			<input type="checkbox" class="checkbox_radio" name="cb_remove[<?=$i?>][remove]"/>
		</td>
		-->
		<td class="p_fw_c1">
			<?
			if($value["source"] == "0.0.0.0/0") $value["source"] = "all";
			?>
			<?/* <input type="hidden" name=removerule[portforward] id="portforward" value="<?=$value["to_ip"]?>" /> */?>
			<input type="hidden" name="removerule[source]" id="source" value="<?=$value["source"]?>" /><?=$value["source"]?>
		</td>
		<td class="p_fw_c2">
			<input type="hidden" name="removerule[dport]"  id="dport" value="<?=$value["dport"]?>" /><?=$value["dport"]?>
		</td>
		<td class="p_fw_c3">
			<input type="hidden" name="removerule[to_port]" id="to_port" value="<?=$value["to_port"]?>" /><?=$value["to_port"]?>
		</td>
		<td class="p_fw_c4">
			<input type="hidden" name="removerule[to_ip]" id="to_ip" value="<?=$value["to_ip"]?>" /><?=$value["to_ip"]?>
		</td>
		<td class="p_fw_c5">
			<input type="hidden" name="removerule[protocol]" id="protocol" value="<?=$value["protocol"]?>" /><?=$value["protocol"]?>
		</td>
		<td class="edit">
				<a href="javascript: copy_fields('RMPORT_<?=$i?>')"><img src="<?=FORMPREFIX.'/views/'.THEME?>/_img/edit16.png" alt="<?=t("Edit")?>"</a>
				<a href="javascript: document.RMPORT_<?=$i?>.submit()"><img src="<?=FORMPREFIX.'/views/'.THEME?>/_img/x15.png" alt="<?=t("Delete")?>"</a>
		</td>
	</tr>
</table>
</form>
<?
$i++;
endforeach;
?>
<table  id="firewall">
	<tr class="ui-filemanager-state-header">
		<td class="p_fw_c0"></td>
		<td class="p_fw_c1"></td>
		<td class="p_fw_c2"></td>
		<td colspan="4" class="legend">
			<img src="<?=FORMPREFIX.'/views/'.THEME?>/_img/edit16.png" alt="<?=t("Edit")?>" />&nbsp;&nbsp;Edit rule&nbsp;&nbsp;
			<img src="<?=FORMPREFIX.'/views/'.THEME?>/_img/x15.png" alt="<?=t("Edit")?>" />&nbsp;&nbsp;Delete rule
		</td>
	</tr>

</table>



