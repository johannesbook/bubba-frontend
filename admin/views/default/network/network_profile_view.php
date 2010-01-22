<?
	// -----  Default page -----
?>
<form id="OTHCFG" action="<?=FORMPREFIX?>/network/update_profile" method="post">
<fieldset><legend><i><?=t("Network Profile")?></i></legend>
	<table class="networksettings">
		<? if($custom): ?>
		<tr>
			<td></td>
			<td colspan="2"><span class="highlight"><?=t("Please select profile")?></td>
		</tr>


		<? endif ?>
		<tr>
			<td><input class="checkbox_radio" type="radio" name="profile" value="auto" <?=isset($auto)?$auto:""?>/></td><td colspan="2"><?=t("Automatic network settings")?></td>
		</tr>
		

		<tr>
			<td><input class="checkbox_radio" type="radio" name="profile" value="router" <?=isset($router)?$router:""?>/></td><td colspan="2"><?=t("Router / Firewall / Server mode")?></td>
		</tr>
		<tr>
			<td><input class="checkbox_radio" type="radio" name="profile" value="server" <?=isset($server)?$server:""?>/></td><td colspan="2"><?=t("Server mode only")?></td>
		</tr>
		
		<tr>
			<td></td>
            <td>
            <input
                <?if(isset($custom)):?>disabled="disabled"<?endif?>
                type="submit"
                id="networkprofile_update" 
                value='<?=t('Update')?>' 
                name='profile_update'
            />
            </td>	
			<td></td>
		</tr>

	</table>
</fieldset>
</form>
  <fieldset><legend><i><?=t("Profile explaination")?></i></legend>
    <table id="profile">
      <tr>
        <td>
	        <div class="profile_legend_h"><?=t("Automatic network settings")?></div>
      	  <div class="profile_legend"><?=t("Bubba will automatically try to set an appropriate network configuration.")?><br>
      	  </div>
        </td>
        <td>
        </td>
      </tr>

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
    

  </table>
	</fieldset>
