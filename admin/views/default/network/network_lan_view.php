<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js"></script>
<fieldset><legend><i><?=t('LAN')?></i></legend>
<form id="LANCFG" action="<?=FORMPREFIX?>/network/lanupdate" method="post">
<table class="networksettings">

	<? if($this->session->userdata("network_profile") == "auto" || $this->session->userdata("network_profile") == "custom"): ?>
		<tr>
			<td valign="top"></td>
			<td valign="top" colspan="3" >
				<?=t("These settings are locked")." (".t("Bubba is using automatic network settings").")"?>.<br />
				<?=t("To unlock, select Router or Server profile under the ")?><a href="<?=FORMPREFIX?>/network/profile"><?=t("Profile")?></a> tab
			</td>
		</tr>
	<? endif ?>

	<tr>
		<td valign="top">
        <input 
            id="net_dhcp" 
            type="radio" 
            class="checkbox_radio" 
            name='netcfg' 
            value='dhcp' 
            onclick="dhcp_onclick()" 
            <?if($dhcp):?>checked="checked"<?endif?>
        />
		</td>
		<td valign="top" colspan="3">
			<?=t('Obtain IP-address automatically')?> (DHCP)<br/>&nbsp;
		</td>
	</tr>
	
	<tr>
		<td valign="top">
            <input 
                id="net_static" 
                type="radio" 
                class="checkbox_radio" 
                name='netcfg' 
                value='static' 
                onclick="static_onclick(<?=$disable_gw?>)" 
                <?=$dhcp?"":"checked=\"checked\""?>
            />
		</td>
		<td valign="top" colspan="3">
			<?=t('Use static IP address settings')?>:<p/>
		</td>
	</tr>

	<tr>
		<td></td>
		<td><?=t('IP')?>:&nbsp;&nbsp;</td>
        <td>
            <input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olip[0]?>' 
                class='ip' 
                name='ip[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olip[1]?>' 
                class='ip' 
                name='ip[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olip[2]?>' 
                class='ip' 
                name='ip[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olip[3]?>' 
                class='ip' 
                name='ip[3]' 
                type='text' 
                size='3' 
                maxlength='3'
            />
        </td>
		<td>
<? if($update && $err_ip){ ?>
		* <?=t("Invalid IP")?>
<? } ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><?=t('Netmask')?>:&nbsp;&nbsp;</td>	
        <td>
            <input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olmask[0]?>' 
                class='ip' 
                name='mask[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olmask[1]?>' 
                class='ip' 
                name='mask[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olmask[2]?>' 
                class='ip' 
                name='mask[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olmask[3]?>' 
                class='ip' 
                name='mask[3]' 
                type='text' 
                size='3' 
                maxlength='3'
            />
        </td>
		<td>
<? if($update && $err_netmask){ ?>
		* <?=t("Invalid netmask")?>
<? } ?>
	</td>
	</tr>


	<tr>
		<td></td>
		<td><?=t('Default gateway')?>:&nbsp;&nbsp;</td>	
        <td>
            <input 
                disabled="disabled" 
                value='<?=$olgw[0]?>' 
                class='ip' 
                name='gw[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                disabled="disabled" 
                value='<?=$olgw[1]?>' 
                class='ip' 
                name='gw[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                disabled="disabled" 
                value='<?=$olgw[2]?>' 
                class='ip' 
                name='gw[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                disabled="disabled" 
                value='<?=$olgw[3]?>' 
                class='ip' 
                name='gw[3]' 
                type='text' 
                size='3' 
                maxlength='3'
            />
		</td>
		<td />
	</tr>
	<tr>
		<td></td>
		<td><?=t('Primary DNS')?>:&nbsp;&nbsp;</td>	
        <td>
            <input 
                disabled="disabled" 
                value='<?=$oldns[0]?>' 
                class='ip' 
                name='dns[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                disabled="disabled"
                value='<?=$oldns[1]?>'
                class='ip' 
                name='dns[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                disabled="disabled" 
                value='<?=$oldns[2]?>' 
                class='ip' 
                name='dns[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                disabled="disabled" 
                value='<?=$oldns[3]?>' 
                class='ip' 
                name='dns[3]' 
                type='text' 
                size='3' 
                maxlength='3'
            />
            <br>&nbsp;
        </td>
		<td />
	</tr>


	<tr>
		<td></td>
		<td valign="top" colspan="3">
        <input 
            type="checkbox" 
            class="checkbox_radio dnsmasq" 
            id="cb_dns" 
            <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
            name='dnsmasq[running]' 
            value='dns' 
            <?if(isset($dnsmasq_settings["running"]) && $dnsmasq_settings["running"]):?>checked="checked"<?endif?>
        />
			<label for="cb_dns"><?=t('Enable DNS service')?></label>
		</td>
<? if($update && $err_dnsmasq["dns"]){ ?>
		<td>* <?=t("Error starting/stopping DNS service")?></td>
<? } ?>
	</tr>

	<tr>
		<td></td>
		<td valign="top" colspan="2">
        <input 
            type="checkbox" 
            class="checkbox_radio dnsmasq" 
            id="dhcpd" 
            <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
            name='dnsmasq[dhcpd]' 
            value='dhcpd' 
            <?if($dnsmasq_settings["dhcpd"]):?>checked="checked"<?endif?>
        />
			<?=t('Enable DHCP server')?>
		</td>
		<td>
<? if($update && $err_dnsmasq["dhcpd"]){ ?>
		* <?=t("Error starting/stopping DHCP server")?>
<? } ?>
		</td>

	</tr>

	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=t('Lease range')?>:&nbsp;&nbsp;</td>
        <td>
            <input 
                class="dnsmasq" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][0]?>' 
                name='dnsmasq[range_start][0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                class="dnsmasq" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][1]?>' 
                name='dnsmasq[range_start][1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />.<input 
                class="dnsmasq" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][2]?>' 
                name='dnsmasq[range_start][2]' 
                type='text' size='3' 
                maxlength='3'
            />.<input 
                class="dnsmasq" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][3]?>' 
                name='dnsmasq[range_start][3]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;-&nbsp;
        <input
            class="dnsmasq" 
            <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?> 
            value='<?=$dnsmasq_settings["range_end"][0]?>' 
            name='dnsmasq[range_end][0]' 
            type='text' 
            size='3' 
            maxlength='3'
        />.<input 
            class="dnsmasq" 
            <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?> 
            value='<?=$dnsmasq_settings["range_end"][1]?>' 
            name='dnsmasq[range_end][1]' 
            type='text' 
            size='3' 
            maxlength='3'
        />.<input 
            class="dnsmasq" 
            <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?> 
            value='<?=$dnsmasq_settings["range_end"][2]?>' 
            name='dnsmasq[range_end][2]' 
            type='text' 
            size='3' 
            maxlength='3'
        />.<input
            class="dnsmasq"
            <?if(!$dnsmasq_settings["dhcpd"]):?>disabled="disabled"<?endif?>
            value='<?=$dnsmasq_settings["range_end"][3]?>'
            name='dnsmasq[range_end][3]'
            type='text'
            size='3'
            maxlength='3'
        />
<? if($update && $err_dnsmasq["dhcpdrange"]){ ?>
	<?="* ".t("Invalid IP range entered")?>
<? } ?>
		</td>
		<td />
	</tr>

	<tr>
		<td valign="top" colspan="4"><br/></td>
	</tr>


	<tr>
        <td>
            <input 
                type="checkbox" 
                <?if($jumbo):?>checked="checked"<?endif?> 
                class="checkbox_radio" 
                name="jumbo" 
                value="1"
            />
        </td>
		<td colspan="2"><?=t('Enable jumbo frames. Please read manual before enabling.')?></td>
		<td></td>
	</tr>

	<tr>
		<td valign="top" colspan="4"><br/></td>
	</tr>

	<tr>
		<td colspan="4"><input type="submit" value='<?=t('Update')?>' name='update'/></td>	
	</tr>

</table>
</form>
</fieldset>

<fieldset><legend><i><?=t('DHCP leases')?></i></legend>
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<td><?=t("Hostname")?></td><td><?=t("IP-address")?></td><td><?=t("MAC-address")?></td><td><?=t("Lease expires")?></td>
	</tr>
	<?
	foreach ($dhcpd_leases as $mac => $lease) { ?>
		<tr>
			<td><?=$lease["hostname"]?></td><td><?=$lease["ip"]?></td><td><?=$mac?></td><td><?=date("M jS, H:i",$lease["exp_time"])?></td>
		</tr>
	<? } ?>
	
</table>
</fieldset>


