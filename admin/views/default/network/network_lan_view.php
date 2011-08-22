<? if($this->session->userdata("network_profile") == "auto" || $this->session->userdata("network_profile") == "custom"): ?>
	<div class="ui-network-information-panel">
	<?=sprintf(_("These settings are locked")." ("._("%s is using automatic network settings"), NAME).")"?>&nbsp;.&nbsp;<br />
	<?=_("To unlock, select Router or Server profile under the ")?><a href="<?=FORMPREFIX?>/network/profile"><?=_("Profile")?></a> tab
	</div>
<? endif ?>
<form id="LANCFG" action="<?=FORMPREFIX?>/network/lanupdate" method="post">
<table id="table-network-lan" class="ui-table-outline">
    <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=_("LAN")?></td></tr>

	<tr>
		<td>
        <input 
            id="net_dhcp" 
            type="radio" 
            class="" 
            name='netcfg' 
            value='dhcp' 
            onclick="dhcp_onclick()" 
            <?if($dhcp):?>checked="checked"<?endif?>
        />
		</td>
		<td colspan="3">
			<label for=""><?=_('Obtain IP-address automatically')?> (DHCP)</label>
		</td>
	</tr>
	
	<tr>
		<td>
            <input 
                id="net_static" 
                type="radio" 
                class="" 
                name='netcfg' 
                value='static' 
                onclick="static_onclick(<?=$disable_gw?>)" 
                <?=$dhcp?"":"checked=\"checked\""?>
            />
		</td>
		<td colspan="3">
			<label for=""><?=_('Use static IP address settings')?></label>:
		</td>
	</tr>

	<tr id="tr-network-ip">
		<td></td>
		<td><label for=""><?=_("IP")?></label>:</td>
        <td>
            <input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olip[0]?>' 
                class='ip' 
                name='ip[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olip[1]?>' 
                class='ip' 
                name='ip[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olip[2]?>' 
                class='ip' 
                name='ip[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
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
		* <?=_("Invalid IP")?>
<? } ?>
		</td>
	</tr>
	<tr id="tr-network-netmask">
		<td></td>
		<td><label for=""><?=_("Netmask")?></label>:</td>
        <td>
            <input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olmask[0]?>' 
                class='ip' 
                name='mask[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olmask[1]?>' 
                class='ip' 
                name='mask[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if(!$dhcpd):?>disabled="disabled"<?endif?> 
                value='<?=$olmask[2]?>' 
                class='ip' 
                name='mask[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
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
		* <?=_("Invalid netmask")?>
<? } ?>
	</td>
	</tr>


	<tr id="tr-network-gateway">
		<td></td>
		<td><label for=""><?=_('Default gateway')?></label>:</td>
        <td>
            <input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
                value='<?=$olgw[0]?>' 
                class='ip' 
                name='gw[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
                value='<?=$olgw[1]?>' 
                class='ip' 
                name='gw[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
                value='<?=$olgw[2]?>' 
                class='ip' 
                name='gw[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
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
	<tr id="tr-network-dns">
		<td></td>
		<td><label for=""><?=_('Primary DNS')?></label>:</td>
        <td>
            <input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
                value='<?=$oldns[0]?>' 
                class='ip' 
                name='dns[0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
                value='<?=$oldns[1]?>'
                class='ip' 
                name='dns[1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
                value='<?=$oldns[2]?>' 
                class='ip' 
                name='dns[2]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                <?if($disable_gw || $dhcp):?>disabled="disabled"<?endif?> 
                value='<?=$oldns[3]?>' 
                class='ip' 
                name='dns[3]' 
                type='text' 
                size='3' 
                maxlength='3'
            />
        </td>
		<td />
	</tr>
	<tr>
		<td />
		<td><label for="cb_dns"><?=_('Enable DNS service')?></label></td>
		<td>
        <input 
            type="checkbox" 
            class="slide dnsmasq" 
            id="cb_dns" 
            name='dnsmasq[running]' 
            value='dns' 
            <?if(isset($dnsmasq_settings["running"]) && $dnsmasq_settings["running"]):?>checked="checked"<?endif?>
        />
		</td>
<? if($update && $err_dnsmasq["dns"]){ ?>
		<td>* <?=_("Error starting/stopping DNS service")?></td>
<? } ?>
	</tr>

	<tr>
		<td />
		<td class="ui-indent1"><label for="dhcpd"><?=_('Enable DHCP server')?></label></td>
		<td>
        <input 
            type="checkbox" 
            class="slide dnsmasq" 
            id="dhcpd" 
            name='dnsmasq[dhcpd]' 
            value='dhcpd' 
            <?if($dnsmasq_settings["dhcpd"]):?>checked="checked"<?endif?>
        />
		</td>
		<td>
<? if($update && $err_dnsmasq["dhcpd"]){ ?>
		* <?=_("Error starting/stopping DHCP server")?>
<? } ?>
		</td>

	</tr>

	<tr>
		<td></td>
		<td class="ui-indent1"><label for=""><?=_('Lease range start')?></label></td>
        <td>
            <input 
                class="dnsmasq ip" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][0]?>' 
                name='dnsmasq[range_start][0]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                class="dnsmasq ip" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][1]?>' 
                name='dnsmasq[range_start][1]' 
                type='text' 
                size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                class="dnsmasq ip" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][2]?>' 
                name='dnsmasq[range_start][2]' 
                type='text' size='3' 
                maxlength='3'
            />&nbsp;.&nbsp;<input 
                class="dnsmasq ip" 
                <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?> 
                value='<?=$dnsmasq_settings["range_start"][3]?>' 
                name='dnsmasq[range_start][3]' 
                type='text' 
                size='3' 
                maxlength='3'
            />
        </td>
      </tr>
		 	<tr>
				<td></td>
				<td class="ui-indent1"><label for=""><?=_('Lease range end')?></label></td>
        <td>

        <input
            class="dnsmasq ip" 
            <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?> 
            value='<?=$dnsmasq_settings["range_end"][0]?>' 
            name='dnsmasq[range_end][0]' 
            type='text' 
            size='3' 
            maxlength='3'
        />&nbsp;.&nbsp;<input 
            class="dnsmasq ip" 
            <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?> 
            value='<?=$dnsmasq_settings["range_end"][1]?>' 
            name='dnsmasq[range_end][1]' 
            type='text' 
            size='3' 
            maxlength='3'
        />&nbsp;.&nbsp;<input 
            class="dnsmasq ip" 
            <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?> 
            value='<?=$dnsmasq_settings["range_end"][2]?>' 
            name='dnsmasq[range_end][2]' 
            type='text' 
            size='3' 
            maxlength='3'
        />&nbsp;.&nbsp;<input
            class="dnsmasq ip"
            <?if(!$dnsmasq_settings["dhcpd"]):?>readonly="readonly"<?endif?>
            value='<?=$dnsmasq_settings["range_end"][3]?>'
            name='dnsmasq[range_end][3]'
            type='text'
            size='3'
            maxlength='3'
        />
<? if($update && $err_dnsmasq["dhcpdrange"]){ ?>
	<?="* "._("Invalid IP range entered")?>
<? } ?>
		</td>
		<td />
	</tr>
	
	<tr>
        <td>
        </td>
		<td><label for="jumbo"><?=_('Enable jumbo frames.')?> <span class="ui-text-comment"><?=_('(Please read manual before enabling)')?></span></label></td>
		<td>
			<input 
				id="jumbo"
			  type="checkbox" 
			  <?if($jumbo):?>checked="checked"<?endif?> 
			  class="slide" 
			  name="jumbo" 
			  value="1"
			/>
		</td>
	</tr>

	<tr>
	<td colspan="4">
		<button class="submit .fn-network-button_submit"><?=_("Update")?></button>
		<input type="hidden" value='1' name='update'/>
	</td>
</tr>
		

</table>
</form>


<table class="ui-table-outline">
	<thead>

    <tr><th colspan="4" class="ui-state-default ui-widget-header"><?=_('DHCP leases')?></td></tr>
		<tr class="ui-header">
			<th><?=_("Hostname")?></th><th><?=_("IP-address")?></th><th><?=_("MAC-address")?></th><th><?=_("Lease expires")?></th>
		</tr>
	</thead>
	<tbody>
		<?
		foreach ($dhcpd_leases as $mac => $lease) { ?>
			<tr>
				<td><?=$lease["hostname"]?></td><td><?=$lease["ip"]?></td><td><?=$mac?></td><td><?=date("M jS, H:i",$lease["exp_time"])?></td>
			</tr>
		<? } ?>
	</tbody>
	
</table>


