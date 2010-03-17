<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>

<script type="text/javascript">
title=<?=json_encode($title)?>;
initial_progress=<?=json_encode($progress)?>;
</script>

<script type="text/javascript">

$(document).ready( function() {
<?if($is_running):?>
	meter = new $.progress();
	meter.update(initial_progress.progress, initial_progress.status);
	dialog = $.dialog(
		meter.root(),
		title,
		[],
		{
			closeOnEscape: false,
			modal: true,
			draggable: false,
			resizable: false,
			beforeclose: function() {
				return false;
			},
			close: function() {
				location.assign("/admin/disk");
			}
		}
	);

	waiting = false;
	is_aborted = false;
	tim = setInterval(
		function() {
			if( waiting || is_aborted ) return;
			waiting = true;
			$.post('<?=site_url("ajax_disk/query_progress")?>', {},
				function(data) {
					if( data.ret.done || is_aborted ) {
						if( ! is_aborted ) {
							meter.update(data.ret.progress,data.ret.status);
						}
						meter.is_done();
						clearInterval( tim );
						dialog.dialog('option', 'beforeclose', function(){return true});
						dialog.dialog('option', 'buttons', [
							{
								'label': $.message("button-label-close"),
								'callback': function(){$(this).dialog('close')}
							}
						]);
					} else {
						meter.update( data.ret.progress, data.ret.status);
						meter.poke();
					}
					waiting = false;
				}
			, 'json' );
		}, 2000);
<?if($type == 'format'):?>
<? /*	div.append(
		$("<input />").attr({
			type: 'button',
			id:'do_create',
			value: '<?=t("Abort")?>',
			disabled:'disabled'
		})
		.addClass('yes disabled')
		.click(
			function(e) {
				is_aborted = true;
				meter.is_done();
				clearInterval( tim );
				$.post('<?=site_url("ajax_disk/abort_format")?>', {},
					function(data) {
						location.assign("/admin/disk");
					}
				, 'json' );
			}
		)
	);
*/?>
<?endif?>
<?else:?>
	location.assign("/admin/disk");
<?endif?>
});
</script>
