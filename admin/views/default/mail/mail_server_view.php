<form action="<?=FORMPREFIX?>/mail/server_update" method="post" id="frm_mail_server_settings">
<table>
	<thead>
	<tr>
		<th 
			colspan="2"
			class="ui-state-default ui-widget-header"
		>
			<?=t('mail-server-title')?>
		</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<th><label><?=t('Outgoing email server')?></label></th>
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
		<th><label><?=t('Use authentication')?></label></th>
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
			<label><?=t('Use plain text authentication')?></label>
			<div class="ui-text-comment"><?=t("(Not recommended, passwords will be sent unencrypted.)")?></div>
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
		<th><label><?=t('User')?></label></th>
		<td>
			<input
				type="text"
				name="smtpuser"
				value="<?=$smtp_user?>"
			/>
		</td>
	</tr>
	<tr>
		<th><label><?=t('Password')?></label></th>
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
	value="<?=t('Update')?>"
/>
</td>
</tr>
</tfoot>
</table>
</form>


<form action="<?=FORMPREFIX?>/mail/mc_update" method="post" id="frm_mail_domaincontroller_settings">
<table>
	<thead>
	<tr>
		<th 
			colspan="2"
			class="ui-state-default ui-widget-header"
		>
			<?=t('mail-server-domaincontroller')?>
		</th>
	</tr>
	</thead>
	<tbody>
   <tr>
	  <th><label><?=t('Handle email for domain')?></label></th>
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
	value="<?=t('Update')?>"
/>
</td>
</tr>
</tfoot>
</table>
</form>
