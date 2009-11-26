<script type="text/javascript">
<!--
</script>

	<? if(isset($confirmed)) { ?>
		<? if(isset($powerdown) && $powerdown) { ?>
				<form action="<?=FORMPREFIX?>/network/confirm_profile"" method="post">
		<? } else { ?>
				<form action="<?=FORMPREFIX?>/network/profile"" method="post">
		<? } ?>
		<table id="wizard">
			<? if(isset($powerdown) && $powerdown) {
			  ?>
				<tr><td colspan="2"><?=t('Network profile updated.')?></td></tr>
				<tr><td colspan="2">
					<?=t('A change in network settings that require a system shutdown has been detected.')?><br>
					<?=t('Press "Continue" to apply the new settings and shut down.')?><br>
					<?=t('Reconnect cables if needed, then press the button to restart Bubba|Two.')?>
				</td></tr>

				<?
				if(isset($lan_ext_dhcpd) && $lan_ext_dhcpd) { ?>
					<tr><td colspan=\"2\">
						<?=t('An external dhcp-server has been detected, please take actions to disable this function in order for your network to function correctly.')?>
					</td></tr>
				<? } ?>
				<tr><td colspan="2"><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Exit setup')?>'/><span class="wiz_spacer">&nbsp;</span><input class='submitbutton' type='submit' name="wiz_data[confirm]" value='<?=t('Continue')?>'/></td></tr>

			<? } elseif (isset($lan_was_static) && $lan_was_static  && $profile=="server") { ?>
				<tr><td colspan="2"><?=t('Network profile updated.')?></td></tr>
				<tr><td colspan="2"><?=t('A change to automatic network settings has been detected.')?><br>
					<?=t('Please check you existing router/dhcp server for the new Bubba|Two network settings')?><br>
					<? if(!$wanaccess) { ?>
						(<?=t('or try this:') ?><a href="http://<?=$hostname?>">http://<?=$hostname?></a>)
					<? } ?>

			<? } else { ?>
				<tr><td colspan="2"><?=t('Network profile updated.')?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				
				<?
				if(isset($lan_ext_dhcpd) && $lan_ext_dhcpd && ($profile == "router")) { ?>
					<tr><td colspan=\"2\">
						<?=t('An external dhcp-server has been detected, please take actions to disable this function in order for your network to function correctly.')?>
							<? if(!$wanaccess) {
							 print "<br>" . t('When disabled, your network needs to be restarted to function properly.');
							 print "<br>" . t('(One way to restart your network is to restart your computer.)');
 							} else {
								print "</td></tr><tr><td><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='";
							 	print(t('Finish setup'));
							 	print "'/>";
							} ?>
					</td></tr>
				<? } ?>
			<? } ?>

			<?
				if( ((isset($restart_wan) && $restart_wan) || (isset($restart_lan) && $restart_lan)) && (!isset($powerdown)) ) {
					print "<tr><td>" . t("Applying network settings takes approximately 30 seconds. During this time Bubba|Two will be inaccessible")."</td></tr>";
				}
			?>
		</table>
	</form>

<?
	} else {
			
	// -----  Default page -----
?>
<form id="OTHCFG" action="<?=FORMPREFIX?>/network/update_profile" method="post">
<fieldset><legend><?=t("Network Profile")?></legend>
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td></td>
			<td><input class="checkbox_radio" type="radio" name="profile" value="router" <?=isset($router)?$router:""?>/></td><td><?=t("Router / Firewall / Server mode")?></td>
			<td></td>
			<? if(isset($err_profile)){?>
			<td><?=t($err_profile)?>.</td>
			<? } ?>
		</tr>
		<tr>
			<td></td>
			<td><input class="checkbox_radio" type="radio" name="profile" value="server" <?=isset($server)?$server:""?>/></td><td><?=t("Server mode only")?></td>
			<td></td>
			<? if(isset($err_profile)){?>
			<td><?=t($err_profile)?>.</td>
			<? } ?>
		</tr>
		
		<? if(isset($custom) || isset($err_profile)) {
		$custom = "CHECKED";
		}
		?>
		<tr>
			<td></td>
			<td><input class="checkbox_radio" type="radio" name="profile" value="custom" <?=isset($custom)?$custom:""?>/></td><td><?=t("Custom settings")?></td>
			<td></td>
			<?=isset($err_profile)?"<td>".t($err_profile)."</td>":""?>
		</tr>
		
		<tr>
			<td></td>
			<td><input type="submit" value='<?=t('Update')?>' name='profile_update'/></td>	
			<td></td>
			<td></td>
		</tr>
	</table>
</fieldset>
</form>
  <fieldset><legend><?=t("Profile explaination")?></legend>
    <table id="profile">
      <tr>
        <td>
      	  <div class="profile_legend_h"><?=t("Router / Firewall / Server mode")?></div>
      	  <div class="profile_legend"><?=t("Bubba will automatically try to retreive network settings on WAN (internet),")?><br>
      	  <?=t("and use fixed network settings on the local network providing other computers with network information.")?><br>
      	  &nbsp;<br>
      	  <?=t("(Bubba|Two will use DHCP on WAN and static IP on LAN with DHCP server active)")?><br>
      	  </div>
        </td>
        <td>
          <? // placeholder for "profile" images
          ?>
        </td>
      </tr>	  
      <tr>
        <td>
          <div class="profile_legend_h"><?=t("Server mode only")?></div>
      	  <div class="profile_legend"><?=t("Bubba will automatically try to retreive network settings on LAN (local network) and the WAN port should be left unconnected")?></div>
        </td>
        <td>
          <? // placeholder for "profile" images
          ?>
        </td>
      </tr>
    
      <tr>
        <td>
	        <div class="profile_legend_h"><?=t("Custom settings")?></div>
      	  <div class="profile_legend"><?=t("Bubba will use the settings defined in the WAN/LAN sections")?><br>
      	  </div>
        </td>
        <td>
        </td>
      </tr>

  </table>
	</fieldset>
<?}?>
