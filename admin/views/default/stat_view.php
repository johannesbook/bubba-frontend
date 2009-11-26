<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/notify.js"></script>
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
<p style="font-size: large; text-align: center; "><?=t('Welcome to your BUBBA|TWO')?></p>
<table class="blank">
<tr>
<td>
<fieldset><legend><i><?=t('Info')?></i></legend>
<table>
<tr><td><?=t('Total disk size')?></td><td><?=$totalspace?> MB</td></tr>
<tr><td><?=t('Free disk space')?></td><td><?=$freespace?> MB</td></tr>
<tr>
	<td></td>
	<td>
		<div class="space-indicator"><div style="width: <?=$percentused?>%"></div></div>
	</td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
<tr><td><?=t('Uptime')?></td><td>
<? if($uptime[0]>0) print($uptime[0]." ".t('days')." "); ?>
<? printf("%02d",$uptime[1])?>:<? printf("%02d",$uptime[2])?>:<? printf("%02d",$uptime[3])?>
</td></tr>
<tr><td><?=t('Version')?></td><td>
<?=$version?>
</td></tr>
</table>

<?if($this->session->userdata('user')=="admin"):?>
<br/>
<form action="shutdown" method="post"><fieldset >
<table>
<tr><td><?=t('Press button to shut down Bubba Server now')?>.</td></tr>
<tr><td><input class='submitbutton' type='submit' name='powerdown' value='<?=t('Power down')?>'/></td></tr>
</table>
</fieldset></form>
<?endif?>

</fieldset>
</td>
<?if( !is_null($notifications) ):?>
<td style="width: 50%;">
<fieldset><legend><i><?=t('System messages')?></i></legend>
<table class="notifications">
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
</table>
</fieldset>

</td>
<?endif?>
</tr>
</table>

