<?
	// -----  Default page -----
?>
<form id="OTHCFG" action="<?=FORMPREFIX?>/network/update_profile" method="post">

	<table class="networksettings ui-table-outline">
		<thead>
	    <tr><th colspan="2" class="ui-state-default ui-widget-header"><?=t("Network profile")?></th></tr>
	  </thead>
		<? if($custom): ?>
		<tr>
			<td></td>
			<td><span class="highlight"><?=t("Please select profile")?></td>
		</tr>


		<? endif ?>
		<tr>
			<td><input type="radio" name="profile" value="auto" <?=isset($auto)?$auto:""?>/></td><td><?=t("Automatic network settings")?></td>
		</tr>
		

		<tr>
			<td><input type="radio" name="profile" value="router" <?=isset($router)?$router:""?>/></td><td><?=t("Router + Firewall + Server")?></td>
		</tr>
		<tr>
			<td><input type="radio" name="profile" value="server" <?=isset($server)?$server:""?>/></td><td><?=t("Server only")?></td>
		</tr>
		
		
		<tr>
			<td colspan="2">
				<input
			                type="button"
			                class="submit"
			                id="networkprofile_update" 
			                value='<?=t('Update')?>' 
		     />
			</td>
		</tr>
	</table>
</fieldset>
</form>
    <table id="profile">
      <tr><td><h2><?=t("Profile explaination")?></h2></td></tr>
      <tr>
        <td>
	        <h3><?=t("Automatic network settings")?></h3>
      	  <div class="profile_legend"><?=t("Bubba will automatically try to set an appropriate network configuration.")?><br>
      	  </div>
        </td>
        <td>
        </td>
      </tr>

      <tr>
        <td>
      	  <h3><?=t("Router + Firewall + Server")?></h3>
      	  <div class="profile_legend"><?=t("Bubba will automatically try to retreive network settings on WAN (internet),")?><br>
      	  <?=t("and use fixed network settings on the local network providing other computers with network information.")?><br>
      	  &nbsp;<br>
      	  <?=t("(Bubba|2 will use DHCP on WAN and static IP on LAN with DHCP server active)")?><br>
      	  </div>
        </td>
        <td>
          <? // placeholder for "profile" images
          ?>
        </td>
      </tr>	  
      <tr>
        <td>
          <h3><?=t("Server only")?></h3>
      	  <div class="profile_legend"><?=t("Bubba will automatically try to retreive network settings on LAN (local network) and the WAN port should be left unconnected")?></div>
        </td>
        <td>
          <? // placeholder for "profile" images
          ?>
        </td>
      </tr>
    

  </table>
	</fieldset>
