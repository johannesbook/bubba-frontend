<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript">
<!--

$(document).ready(function(){


	$("#en_easyfind").change(function() {
		if($(this).attr('checked')) {
			$("#easyfind_name").removeAttr("disabled");
      if($("#easyfind_name").val() == <?="\"".t("Set easyfind name")."\""?>) {
			  $("#easyfind_name").val("");
			  $("#mybubba").text("");
			}
		} else {
			$("#easyfind_name").attr("disabled","true");
      if($("#easyfind_name").val() == "") {
			  $("#easyfind_name").val(<?="\"".t("Set easyfind name")."\""?>);
			}
		}	
	})

	$("#easyfind_name").bind("keyup", function() {
    $("#mybubba").html($("#easyfind_name").val());
  })  
  
	$("#img_router").click(function() {
		$(".wizard_imglarge").html(<?="\"<img class='wizard_imglarge' src='" . FORMPREFIX . "/views/".THEME."/_img/scenario1.png'>\""?>);
		if(!$(".wizard_imglarge").attr("display")) {
  		$(".wizard_imglarge").show('slow');
  	}
	})

	$("#img_server").click(function() {
		$(".wizard_imglarge").html(<?="\"<img class='wizard_imglarge' src='" . FORMPREFIX . "/views/".THEME."/_img/scenario6.png'>\""?>);
		if(!$(".wizard_imglarge").attr("display")) {
  		$(".wizard_imglarge").show('slow');
  	}
	})

	$(".wizard_imglarge").click(function() {
  	$(".wizard_imglarge").hide('slow');
	})
	
});


	
// -->
</script>


	<? if(isset($confirmed)) { ?>
	<table id="wizard">
		<tr><td class="wiz_head" colspan="2"><?=t('Setup complete')?></td></tr>
	</table>
	<? if(isset($wiz_data['powerdown']) && $wiz_data['powerdown']) { ?>
			<form action="<?=FORMPREFIX?>/network/confirm_profile"" method="post">
	<? } else { ?>
			<form action="<?=FORMPREFIX?>/network/wizard"" method="post">
	<? } ?>
	<fieldset id="wizard"><legend><?=t("Bubba|Two")?></legend>
		<table id="wizard">


			<? if (isset($wiz_data['lan_was_static']) && $wiz_data['lan_was_static'] && $wiz_data['profile']=="server") { ?>
				<tr><td colspan="2"><?=t('Setup is now complete.')?></td></tr>
				<tr><td colspan="2"><?=t('A change to automatic network settings has been detected.')?><br>
					<?=t('Please check you existing router/dhcp server for the new Bubba|Two network settings.')?><br>
					<? if(!$wiz_data['wanaccess']) { ?>
						(<?=t('or try this:') ?><a href="http://<?=$wiz_data['hostname']?>">http://<?=$wiz_data['hostname']?></a>)
					<? } ?>

			<? } else { ?>
				<tr><td colspan="2"><?=t('Setup is now complete.')?></td></tr>
				<tr><td colspan="2"><?=t('Enjoy Bubba|Two.')?></td></tr>
				
				<?
				if(isset($wiz_data['lan_ext_dhcpd']) && $wiz_data['lan_ext_dhcpd'] && $wiz_data['profile']=="router" ) { ?>
					<tr><td colspan=\"2\">
						<?=t('An external dhcp-server has been detected, please take actions to disable this function in order for your network to function correctly.')?>
							<? if(!$wiz_data['wanaccess']) {
							 print "<br>" . t('When disabled, your network needs to be restarted to function properly.');
							 print "<br>" . t('(One way to restart your network is to restart your computer.)');
							} else {
								print "</td></tr><tr><td><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='";
							 	print(t('Finish setup'));
							 	print "'/>";
							} ?>
					</td></tr>
				<? } else {?>
						<tr><td><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Finish setup')?>'/></td></tr>
				<? } ?>
			<? } ?>
			<? if(isset($wiz_data['powerdown']) && $wiz_data['powerdown']) { ?>
					<tr><td colspan="2"><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/><span class="wiz_spacer">&nbsp;</span><input class='submitbutton' type='submit' name="wiz_data[confirm]" value='<?=t('Continue')?>'/></td></tr>
			<? }

				if( ((isset($wiz_data['restart_wan']) && $wiz_data['restart_wan']) || (isset($wiz_data['restart_lan']) && $wiz_data['restart_lan'])) && (!isset($wiz_data['powerdown'])) ) {
					print "<tr><td>" . t("Applying network settings takes approximately 30 seconds. During this time Bubba|Two will be inaccessible")."</td></tr>";
				}
			?>
		</table>
	</fieldset>
	</form>
		
	<?	
	} else {
		// ----   Default page  ------
	?>

  <div class="wizard_imglarge"></div>

	<table id="wizard">
		<tr><td class="wiz_head" colspan="2"><?=t('Step 3/3: Network setup')?></td></tr>
	</table>

	<form action="<?=FORMPREFIX?>/network/wizard"" method="post" id="OTHCFG">
	<fieldset id="wizard"><legend><?=t("Network profile")?></legend>
		<table id="wizard">
			<tr><td colspan="2"><?=t('Please select Bubba|Two network scenario.')?></td>
			  <td rowspan="3"><img id="img_router" class="wizard_img" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/scenario1_small.png" /></td>
			  <td rowspan="3"><img id="img_server" class="wizard_img" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/scenario6_small.png" /></td>   
			</tr>
			<tr>
			  <td><input name="profile" type="radio" class="checkbox_radio" value="auto" <?=isset($wiz_data['auto'])?"CHECKED":""?> ></td><td><?=t('Automatic network settings')?></td>
			</tr>
			<tr>
			  <td><input name="profile" type="radio" class="checkbox_radio" value="router" <?=isset($wiz_data['router'])?"CHECKED":""?> ></td><td><?=t('Router + Firewall + Server')?></td>
			</tr>
			<tr>
			  <td><input name="profile" type="radio" class="checkbox_radio" value="server" <?=isset($wiz_data['server'])?"CHECKED":""?> ></td><td><?=t('Server only')?></td>
			  <td><?=t("Router")?><br><span style="font-size:0.8em"><?=t("Click to enlarge")?></span></td>
			  <td><?=t("Server")?></td>
		  </tr>
		  <tr>
			<?=isset($wiz_data['custom'])?
			"<td><input name=\"profile\" type=\"radio\" class=\"checkbox_radio\" value=\"custom\" CHECKED></td><td>".t('Custom settings')."</td>":"<td></td><td></td>"
			?>
		</tr>
		</table>
	</fieldset>
	<fieldset id="wizard"><legend><?=t("Easyfind")?></legend>
		<table id="wizard">
			<tr><td><input id="en_easyfind" name="wiz_data[en_easyfind]" type="checkbox" class="checkbox_radio" <?=isset($wiz_data['en_easyfind'])?"CHECKED":""?>/>&nbsp;&nbsp;<?=t('Use "Easyfind" to locate Bubba|Two from the internet')?></td></tr>
			<tr><td><input <?=isset($wiz_data['err_easyfind'])?"class='highlight'":""?> id="easyfind_name" name="wiz_data[easyfind_name]" type="text" value="<?=isset($wiz_data['easyfind_name'])?$wiz_data['easyfind_name']:t("Set easyfind name")?>" <?=isset($wiz_data['en_easyfind'])?"":"DISABLED"?>/> (http://<span id="mybubba"><?=isset($wiz_data['easyfind_name'])?$wiz_data['easyfind_name']:t("mybubba")?></span>.bubbaserver.com)<?=isset($wiz_data['err_easyfind'])?"<br><span class='highlight'>".$wiz_data['err_easyfind']."</span>":""?></td></tr>
		
			<tr>
				<td colspan="2">
					<input class='submitbutton' type='submit' name='wiz_data[back]' value='<?=t('Back')?>'/>
					<input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/><span class="wiz_spacer">&nbsp;</span>
					<input class='submitbutton' type='submit' id="networkprofile_update" value='<?=t('Next')?>'/>
					<input type="hidden" value="0" name="wiz_data[postingpage]" id="post_value"/>
				</td>
			</tr>
		</table>
	</fieldset>
	</form>


<? } ?>
