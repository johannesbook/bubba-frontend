<fieldset id="fetchmail">
	<table>
<tr><td colspan="8" class="ui-state-default ui-widghet-header"><?=t('Retrieve mail from individual accounts')?> <?=$fstatus?"":"(".t('Disabled').")"?></td></tr>
<tr>
   <th><?=t('Host')?></th>
   <th><?=t('Protocol')?></th>
   <th><?=t('Username')?></th>
   <th><?=t('Local user')?></th>
   <th><?=t('SSL')?></th>
   <th><?=t('Leave email on server')?></th>
   <th>&nbsp;</th>
</tr>
<? if(count($accounts)>0){
	foreach($accounts as $account){?>
<tr>
	<td><?=$account['server']?></td>
	<td><?=$account['protocol']?></td>
	<td><?=$account['ruser']?></td>
	<td><?=$account['luser']?></td>
	<td><?=$account['ssl']==""?t("No"):t("Yes")?></td>
	<td><?=$account['keep']==""?t("No"):t("Yes")?></td>
	<td>
		<form action="<?=FORMPREFIX?>/mail/editfac" method="post">
				<input type="hidden" name="server" value="<?=$account['server']?>" />
				<input type="hidden" name="protocol" value="<?=$account['protocol']?>" />
				<input type="hidden" name="ruser" value="<?=$account['ruser']?>" />
				<input type="hidden" name="luser" value="<?=$account['luser']?>" />
				<input type="hidden" name="ssl" value="<?=$account['ssl']?>" />
				<input type="hidden" name="password" value="<?=$account['password']?>" />
				<input type="hidden" name="keep" value="<?=$account['keep']?>" />
				<input type="submit" name="edit" value="<?=t('Edit')?>"/>
   </form>
	</td>
</tr>
<?	}
}else{?>
<tr><td colspan="6"><?=t('No accounts added')?></td></tr>
<?}?>
</table>


<form action="<?=FORMPREFIX?>/mail/addfac" method="post">
<table>
    <tr><td colspan="4" class="ui-state-default ui-widghet-header"><?=t('Add account')?> </td></tr>
	<tr>
	   <td><?=t('Host')?></td>
	   <td>
	      <input 
	      	type="text" 
	      	name="server"
	      	<?if(isset($server) && $server):?>
	      		value = "<?=$server?>"
	      	<?endif?>
	      />
	   </td>
	</tr>
	<tr>
	   <td><?=t('Protocol')?></td>
	   <td>
	      <select name="protocol" size="1">
	         <option>AUTO</option>
	         <option>POP2</option>
	         <option>POP3</option>
	         <option>IMAP</option>
	         <option>ETRN</option>
	         <option>ODMR</option>
	      </select>
	   </td>
	</tr>
	<tr>
	   <td><?=t('Remote user')?></td>
	   <td>
	   	<input 
	   		type="text" 
	   		name="ruser"
	   	/>
	   </td>
	</tr>
	<tr>
	   <td><?=t('Password')?></td>
	   <td>
	   		<input
	   			type="password" 
	   			name="password"
	   		/>
	   	</td>
	</tr>
	<tr>
	   <td><?=t('Local user')?></td>
	   <td>
	      <select name="luser" size="1">
	      	<?foreach($userlist as $user){?>
	      		<option>
	      			<?=$user?>
	      		</option>
	      	<?}?>
	      </select>
	   </td>
	</tr>
	<tr>
	   <td><?=t('Use SSL')?></td>
	   <td>
	   	<input 
	   		type="checkbox" 
	   		class="checkbox_radio" 
	   		name="usessl"
	   	/>
	   </td>
	</tr>
	<tr>
		<td><?=t('Leave email on server')?></td>
		<td>
			<input 
				type="checkbox" 
				class="checkbox_radio" 
				name="keep" 
			/>
		</td>
	</tr>
	
</table>
<input 
				type="submit" 
				name="add_account" 
				value="<?=t('Add account')?>"
			/>
</form>

</fieldset>
