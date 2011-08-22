<?
	// -----  Default page -----
?>
<form id="OTHCFG" action="<?=FORMPREFIX?>/network/update_profile" method="post">

	<table class="networksettings ui-table-outline">
		<thead>
	    <tr><th colspan="2" class="ui-state-default ui-widget-header"><?=_("Network profile")?></th></tr>
	  </thead>
		<? if($custom): ?>
		<tr>
			<td></td>
			<td><span class="highlight"><?=_("Please select profile")?></td>
		</tr>


		<? endif ?>
		<tr>
			<td><input type="radio" name="profile" value="auto" <?=isset($auto)?$auto:""?>/></td><td><?=_("Automatic network settings")?></td>
		</tr>
		

		<tr>
			<td><input type="radio" name="profile" value="router" <?=isset($router)?$router:""?>/></td><td><?=_("Router + Firewall + Server")?></td>
		</tr>
		<tr>
			<td><input type="radio" name="profile" value="server" <?=isset($server)?$server:""?>/></td><td><?=_("Server only")?></td>
		</tr>
		
		
		<tr>
			<td colspan="2">
				<input
			                type="button"
			                class="submit"
			                id="networkprofile_update" 
			                value='<?=_("Update")?>'
		     />
			</td>
		</tr>
	</table>
</form>