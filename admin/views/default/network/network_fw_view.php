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
             } else { // Bubba|2 port
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
<? if(isset($disable_fw) && $disable_fw): ?>
	<div class="ui-network-information-panel">
	<?=_("These settings are locked")?> (<?=_("no valid WAN port connection")?>).
	</div>
<? endif ?>

<form id="FWCFG" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
<table id="firewall" class="ui-table-outline">
	<thead>
    <tr><td colspan="3" class="ui-state-default ui-widget-header"><?=sprintf(_("Allow external (WAN) access to %s services"), NAME)?></td></tr>
	</thead>
	<tbody>
	<tr>
		<td>
			<?=_("SSH")?> (Port 22)
		</td>
		<td>
			<input class="slide" type="checkbox" name="allowSSH" <?if($allowSSH) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		<td>
			<?=_('Email server')?> (Port 25)
		</td>
		<td>
			<input class="slide" type="checkbox" name="allowMail" <?if($allowMail) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		<td>
			<?=_("WWW")?> (HTTP / HTTPS Ports 80 / 443)
		</td>
		<td>
			<input class="slide" type="checkbox" name="allowWWW" <?if($allowWWW) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		<td>
			<?=_("Email")?> (IMAP / IMAPS Ports 143 / 993)
		</td>
		<td>
			<input class="slide" type="checkbox" name="allowIMAP" <?if($allowIMAP) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		<td>
			<?=_("FTP")?> (Port 21)
		</td>
		<td>
			<input class="slide" type="checkbox" name="allowFTP" <?if($allowFTP) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		<td>
			<?=_("Downloader")?> (Ports 10000-14000)
		</td>
		<td>
			<input class="slide" type="checkbox" name="allowTorrent" <?if($allowTorrent) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	<tr>
		<td>
			<?=_('Respond to ping')?> (ICMP type 8)
		</td>
		<td>
			<input class="slide" type="checkbox" name="allowPing" <?if($allowPing) echo "checked=\"checked\""?>/>
		</td>
	</tr>
	</tbody>
	<tfoot>
	<tr><td>
		<button class="submit fn-network-button_submit"><?=_("Update")?></button>
		<input type="hidden" value='1' name='update'/>
	</td></tr>
	</tfoot>
	
</table>

</form>

<div class="ui-expandable ui-state-default ui-widget-header ui-div-header"><?=_("Advanced firewall settings")?></div>
<div id="network-firewall-advanced" class="ui-helper-hidden">

<form id="PORTCFG" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
<table id="firewall" class="ui-table-outline">
	<tbody>
	<tr>
		<td colspan="4">
				<input id="p_forward" type="radio" name="portforward" value=1 class="checkbox_radio" <? if($portforward) echo "checked=\"checked\"";?> onclick="enable_portforward()"/>&nbsp;&nbsp;
				<?=_('Port forward to internal network')?>
				<br>
				<input id="B2public" type="radio" name="portforward" value=0 class="checkbox_radio" <? if(!$portforward) echo "checked=\"checked\"";?> onclick="disable_portforward()"/>&nbsp;&nbsp;
				<?=sprintf(_("Open %s port"), NAME)?>
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td>
			<?
			if(isset($new_port["source"]))
				if(!$new_port["source"])
					$new_port["source"] = "all";
			?>
			<?=_('Source IP')?><br>
			<input type="text" name="source" size="15" <?=isset($err_portforward["source"])?"class=\"err\" ":""?><?=isset($new_port["source"])?"value=\"".$new_port["source"]."\"":"value=\"all\""?>/>
		</td>
		<td>
			<?=_('Public port')?><br>
			<input type="text" name="dport" size="11" <?=isset($err_portforward["dport"])?"class=\"err\" ":""?><?=isset($new_port["dport"])?"value=\"".$new_port["dport"]."\"":""?>/>
		</td>
		<td>
			<?=_('Private port')?><br>
			<input type="text" name="to_port" size="11" <?=$disabled?> <?=isset($err_portforward["to_port"])?"class=\"err\" ":""?><?=isset($new_port["to_port"])?"value=\"".$new_port["to_port"]."\"":""?>/>
		</td>
		<td>
			<?=_('Private IP')?><br>
			<input type="text" name="to_ip" size="15" <?=$disabled?> <?=isset($err_portforward["to_ip"])?"class=\"err\" ":""?><?=isset($new_port["to_ip"])?"value=\"".$new_port["to_ip"]."\"":""?>/>
		</td>
		<td>
			<?=_("Protocol")?><br>
			<select name="protocol">
				<option value="tcp">TCP</option>
				<option value="udp">UDP</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="ui-text-comment">
			<?=_('Public port range accepted as start-port:stop-port')?><br />
			<?=_('Private port is start port if public port range entered')?><br />
			<input type="hidden" name="o_source" />
			<input type="hidden" name="o_dport" />
			<input type="hidden" name="o_to_port" />
			<input type="hidden" name="o_to_ip" />
			<input type="hidden" name="o_protocol" />
			<input type="hidden" name="o_portforward" />
		</td>
	</tr>
	<?if(isset($err_portforward)):?>
	<tr>
		<td class="ui-state-error" colspan="6">
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
	<?endif?>
	</tbody>
	<tfoot>
	<tr><td colspan="6">
		<button class="submit fn-network-button_submit"><?=_("Update")?></button>
		<input type="hidden" value='1' name='newport'/>
	</td></tr>
	</tfoot>
</table>

</form>


<table  class="ui-firewall-defined ui-table-outline">
	<thead>
    <tr><td colspan="6" class="ui-state-default ui-widget-header"><?=_('User defined open / forwarded ports')?></td></tr>
	<tr class="ui-header">
		<th><?=_('Source IP')?></th>
		<th><?=_('Public port')?></th>
		<th><?=_('Private port')?></th>
		<th><?=_('Private IP')?></th>
		<th><?=_("Protocol")?></th>
		<th></th>
	</tr>
	</thead>
</table>
  <?
  $i=1;
  foreach($fwports as $value):?>
	<form id="RMPORT_<?=$i?>" name="RMPORT_<?=$i?>" class="firewall" action="<?=FORMPREFIX?>/network/fwupdate" method="post">
	<table class="ui-firewall-defined ui-table-outline">
	<tr>
		<td>
			<?
			if($value["source"] == "0.0.0.0/0") $value["source"] = "all";
			?>
			<?/* <input type="hidden" name=removerule[portforward] id="portforward" value="<?=$value["to_ip"]?>" /> */?>
			<input type="hidden" name="removerule[source]" id="source" value="<?=$value["source"]?>" /><?=$value["source"]?>
		</td>
		<td>
			<input type="hidden" name="removerule[dport]"  id="dport" value="<?=$value["dport"]?>" /><?=$value["dport"]?>
		</td>
		<td>
			<input type="hidden" name="removerule[to_port]" id="to_port" value="<?=$value["to_port"]?>" /><?=$value["to_port"]?>
		</td>
		<td>
			<input type="hidden" name="removerule[to_ip]" id="to_ip" value="<?=$value["to_ip"]?>" /><?=$value["to_ip"]?>
		</td>
		<td>
			<input type="hidden" name="removerule[protocol]" id="protocol" value="<?=$value["protocol"]?>" /><?=$value["protocol"]?>
		</td>
		<td class="ui-firewall-defined-edit">
			<div>
				<a href="javascript: copy_fields('RMPORT_<?=$i?>')">
    			    <span class="ui-icon ui-icon-pencil2"  title="Edit rule"></span>
                </a>
				<a href="javascript: document.RMPORT_<?=$i?>.submit()">
				    <span class="ui-icon ui-icon-closethick" title="Delete rule"></span>
				</a>
			</div>
		</td>
	</tr>
</table>
</form>
<?
$i++;
endforeach;
?>
</div>
