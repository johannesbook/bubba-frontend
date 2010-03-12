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


<table>
	<tr><td colspan="2" class="ui-state-default ui-widget-header"><?=t('Info')?></td></tr>
</table>

<table>
	<tr>
		<td>
			<legend><i><?=t('System status')?></i></legend>
			<table>
				<tr>
					<td>
						<canvas id="piechart" width="120" height="70" rel="<?=$percentused?>">
							<div class="progress">
								<div class="bar" style="width:<?=$percentused?>%"><span><?=$percentused?>%</span></div>
							</div>
							</canvas>
					</td>
					<td></td>
				</tr>
				<tr><td><?=t('Total disk size')?></td><td><?=$totalspace?> MB</td></tr>
				<tr><td><?=t('Free disk space')?></td><td><?=$freespace?> MB</td></tr>
			
				<tr><td><?=t('Uptime')?></td>
					<td>
						<? if($uptime[0]>0) print($uptime[0]." ".t('days')." "); ?>
						<? printf("%02d",$uptime[1])?>:<? printf("%02d",$uptime[2])?>:<? printf("%02d",$uptime[3])?>
					</td>
				</tr>
				<tr><td><?=t('Version')?></td><td><?=$version?></td></tr>
			
				<?if($this->session->userdata('user')=="admin"):?>
					<tr>
						<td>
							<form action="shutdown" method="post">
						  <input id="stat-shutdown" class='submitbutton' type='submit' name='powerdown' value='<?=t('Power down')?>'/>
							</form>
						</td>
					</tr>
				<?endif?>
			</table>
		</td> <!-- end status info -->
	
			<td style="width: 50%;">
				<legend><i><?=t('System messages')?></i></legend>
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
		</td>
	</tr>
</table>
