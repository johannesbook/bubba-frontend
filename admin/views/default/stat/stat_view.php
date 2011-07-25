<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/notify.js?v='<?=$this->session->userdata('version')?>'"></script>

<table class="ui-table-outline">
	<tr><th colspan="2" class="ui-state-default ui-widget-header"><?=t('Status')?></th></tr>
</table>

<table id="ui-stat-table">
	<tr>
		<td class="ui-stat-table-col1">
			<canvas id="piechart" width="175" height="150" rel="<?=$percentused?>">
				<div class="progress">
					<div class="bar" style="width:<?=$percentused?>%"><span><?=$percentused?>%</span></div>
				</div>
			</canvas>
		</td>
		<td>
			<table class="ui-table-outline" id="ui-stat-list">
                <tr>
                    <td class="ui-stat-list-col1"><?=t('Disk capacity')?></td>
                    <td><?=$totalspace?> MB</td>
                </tr>
                <tr>
                    <td class="ui-stat-list-col1"><?=t('Available')?></td>
                    <td><?=$freespace?> MB</td>
                </tr>
                <tr>
                    <td class="ui-stat-list-col1"><?=t('Uptime')?></td>
                    <td>
						<? if($uptime[0]>0) print($uptime[0]." ".t('days')." "); ?>
						<? printf("%02d",$uptime[1])?>:<? printf("%02d",$uptime[2])?>:<? printf("%02d",$uptime[3])?>
                    </td>
                </tr>
                <tr>
                    <td class="ui-stat-list-col1"><?=t("Attached printers")?></td>
					<td>
						<?=implode(', ', array_map(function($a){
							$info = $a['info'];
							if(!$a['enabled']) {
								$info .= " (".t($a['state']).")";
								$info = "<span class=\"ui-printer-unplugged\">$info</span>";
							}
							return $info;
						}, $printers))?>
					</td>
                </tr>
				<tr>
					<td class="ui-stat-list-col1"><?=t('Software version')?></td>
					<td><?=$version?></td>
				</tr>
			</table>
				<form action="settings/software" method="post">
					<input type="submit" id="ui-stat-swupdate" value="<?=t("Software update")?>"/>
				</form>
		</td>
	</tr>
	<tr>
</table>

<table class="ui-table-outline">
	<tr><th colspan="2" class="ui-state-default ui-widget-header"><?=t('System messages')?></th></tr>
</table>

<table class="notifications ui-table-outline">
	<?if(isset($notifications) && is_array($notifications)):?>
		<?foreach( $notifications as $index => $notification ):?>
			<tr class="notification notification-<?=$notification['Level']?>">
				<td class="notification-type"><img src="<?=$notification['Image']?>"/></td>
				<td class="notification-content">
					<div class="notification-desc">	<img class="notification-img" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/<?=$index > 0 ? 'plus' : 'minus'?>16.png" alt="toggle"/><?=$notification['Description']?></div>
					<?if(isset($notification['Message'])):?>
						<div class="notification-data">
						<div class="notification-msg" <?if($index > 0):?>style="display:none;"<?endif?>><?=$notification['Message']?></div>
						</div>
					<?endif?>
				</td>
				<td class="notification-ack">
					<form class="ack">
						<input type="hidden" class="uuid" name="uuid" id="uuid_<?=$index?>" value="<?=$notification['UUID']?>" />
						<button class="fn-ack submit" <?if( ! $notification['AllowedToAck']):?>disabled="disabled"<?endif?>><?=t("Acknowledge")?></button>		
					</form>
				</td>
			</tr>
		<?endforeach?>
	<?else:?>
		<tr><td><?=t("No system messages available")?></td></tr>
	<?endif?>
</table>

<div id="ui-stat-controls">
	<form action="shutdown/confirm" method="post" id="stat-shutdown">
		<input type="hidden" name="action" id="fn-stat-shutdown-action">
	  <input id="stat-button-shutdown" class='submitbutton' type='submit' name='shutdown' value='<?=t('stat-shutdown-label')?>'/>
	  <input id="stat-button-reboot" class='submitbutton' type='submit' name='reboot' value='<?=t('stat-reboot-label')?>'/>
	</form>
</div>
