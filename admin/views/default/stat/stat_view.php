<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/notify.js?v='<?=$this->session->userdata('version')?>'"></script>
<script>
$('form.ack').live( 'submit', function(e) {
	uuid=$(this).find('input.uuid').val();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: "/admin/ajax_notify/ack",
		data: {uuid: uuid} ,
		timeout: 20000,
		success: function( data ) {
		}
	});
	if( $(this).closest('table').find('tr').size() <= 1 ) {
	$(this).closest('fieldset').closest('td').remove();
	} else {
		table = $(this).closest( 'table' );
		$(this).closest( 'tr' ).remove();
		table.stripe();
	}
	return false;
});
</script>


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
				<tr><td class="ui-stat-list-col1"><?=t('Disk capacity')?></td><td class="ui-stat-list-col2"><?=$totalspace?> MB</td><td /></tr>
				<tr><td><?=t('Available')?></td><td><?=$freespace?> MB</td><td /></tr>
				<tr><td><?=t('Uptime')?></td><td>
						<? if($uptime[0]>0) print($uptime[0]." ".t('days')." "); ?>
						<? printf("%02d",$uptime[1])?>:<? printf("%02d",$uptime[2])?>:<? printf("%02d",$uptime[3])?>
				</td><td /></tr>
				<tr>
					<td><?=t('Software version')?></td>
					<td><?=$version?></td><td />
				</tr>
			</table>
			<a href="<?=FORMPREFIX?>/settings/software"><button id="ui-stat-swupdate" class="submit"><?=t("Software update")?></button></a>
		</td>
	</tr>
	<tr>
</table>

<table class="ui-table-outline">
	<tr><th colspan="2" class="ui-state-default ui-widget-header"><?=t('System messages')?></th></tr>
</table>

<table class="notifications">
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
					<form class="ack" method="post">
						<input type="hidden" class="uuid" name="uuid" id="uuid_<?=$index?>" value="<?=$notification['UUID']?>" />
						<input type="submit" value="<?=t("Acknowledge")?>" <?if( ! $notification['AllowedToAck']):?>disabled="disabled"<?endif?>/>		
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