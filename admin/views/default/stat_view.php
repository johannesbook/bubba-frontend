<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/notify.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/raphael-min.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/pie.js"></script>
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
<p style="font-size: large; text-align: center; "><img src="<?=FORMPREFIX.'/views/'.THEME?>/_img/bubba2_logo.jpg" /></p>
<table class="blank">
<tr>
<td>
<table id="pie_data">
	<tr class="pie">
		<td class="pie"><?=100-($percentused)?>%</td>
	</tr>
	<tr class="pie">
		<td class="pie"><?=$percentused?>%</td>
	</tr>
</table>
<fieldset><legend><i><?=t('Info')?></i></legend>

	<div id="pie"></div>
		
	<table class="blank stat">
		<tr>
			<td><?=t('Total diskspace:')?>	</td>
			<td><?printf("%2d",$totalspace)?> GB 	</td>
		</tr>
		<tr>
			<td><?=t('Free diskspace:')?>	</td>
			<td><?printf("%2d",$freespace)?> GB 	</td>
		</tr>
	
		<tr>
			<td>
				<?=t('Version')?>
			</td>
			<td>
				<?=$version?>
			</td>
		</tr>

		<tr>
			<td>
				<?=t('Uptime')?>
			</td>
			<td>	
			<? if($uptime[0]>0) print($uptime[0]." ".t('days')." "); ?>
			<? printf("%02d",$uptime[1])?>:<? printf("%02d",$uptime[2])?>:<? printf("%02d",$uptime[3])?>
			</td>
		</tr>
	</table>
</fieldset>
</td>
<? /*
<? if( !is_null($notifications) ):?>
*/ ?>
<? if(1):?>
<td style="width: 50%;">
<fieldset><legend><i><?=t('System messages')?></i></legend>
<table class="notifications">
<?
if(sizeof($notifications)) {
	foreach( $notifications as $index => $notification ):?>
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
<?php } else {?>
<tr >
	<td class="notification-type"></td>
	<td class="notification-content">
		<div class="notification-desc"><?=t("No active system messages")?></div>
<?if(isset($notification['Message'])):?>
		<div class="notification-data">
			<div class="notification-msg"</div>
		</div>
<?endif?>
	</td>
	<td class="notification-ack">
</tr>
<?php } ?>

</table>
</fieldset>

</td>
<?endif?>
</tr>
</table>
<div class="excito_link"><a href="http://www.excito.com"><img src="<?=FORMPREFIX.'/views/'.THEME?>/_img/excito_logo_bg_gray.gif" alt="http://www.excito.com"/></a></div>

