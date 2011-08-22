<form action="<?=FORMPREFIX?>/mail/server_update" method="post" id="frm_mail_server_settings">
<table class="ui-table-outline">
	<thead>
	<tr>
		<th 
			colspan="2"
			class="ui-state-default ui-widget-header"
		>
			<?=_("Email server")?>
		</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<th><label><?=_('Outgoing email server')?> (SMTP)</label></th>
		<td>
			<input
				type="text"
				name="smarthost"
				value="<?=$smarthost?>"
			/>
		</td>
	</tr>

	<tr>
		<? // indent this and the below "hidden" section" ?>
		<th><label><?=_('Use authentication')?></label></th>
		<td>
			<input
				type="checkbox"
				class="checkbox_radio"
				name="useauth"
				id="useauth"
				value="yes"
				<?if($smtp_auth):?>checked="checked"<?endif?>

			 />
		</td>
	</tr>

	<? // -----  this should be a hidden section until "use auth" is selected. --- ?>
	<tr>
		<th>
			<label><?=_('Use plain text authentication')?></label>
			<div class="ui-text-comment"><?=_("(Not recommended, passwords will be sent unencrypted.)")?></div>
		</th>
		<td>
			<input
				type="checkbox"
				class="checkbox_radio"
				name="useunsecure"
				id="useunsecure"
				value="yes"
				<?if(!$smtp_auth):?>disabled="disabled"<?endif?> 
				<?if($smtp_plain_auth):?>checked="checked"<?endif?> 
			/>
		</td>
	</tr>
	<tr>
		<th><label><?=_("User")?></label></th>
		<td>
			<input
				type="text"
				name="smtpuser"
				value="<?=$smtp_user?>"
			/>
		</td>
	</tr>
	<tr>
		<th><label><?=_("Password")?></label></th>
		<td>
			<input
				type="password"
				name="smtppasswd"
			/>
		</td>
	</tr>
	<? // -----  end hidden section --- ?>
  </tbody>
<tfoot>
<tr>
<td colspan="2">
<input
	type="submit"
	name="update"
	value="<?=_("Update")?>"
/>
</td>
</tr>
</tfoot>
</table>
</form>


<form action="<?=FORMPREFIX?>/mail/mc_update" method="post" id="frm_mail_domaincontroller_settings">
<table class="ui-table-outline">
	<thead>
	<tr>
		<th 
			colspan="2"
			class="ui-state-default ui-widget-header"
		>
			<?=_("Email domain")?>
		</th>
	</tr>
	</thead>
	<tbody>
   <tr>
	  <th><label><?=_('Handle email for domain')?></label></th>
	  <td>
			<input
				type="text"
				name="domain"
				value="<?=$receive["domain"]?>"
			/>
	</td>
   </tr>
  </tbody>
<tfoot>
<tr>
<td colspan="2">
<input
	type="submit"
	name="update"
	value="<?=_("Update")?>"
/>
</td>
</tr>
</tfoot>
</table>
</form>
