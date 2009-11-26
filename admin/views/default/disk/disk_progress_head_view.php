<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js"></script>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css" />

<script type="text/javascript">

$(document).ready( function() {
<?if($is_running):?>
	div = $('<div />');
	div.append($("<div class='header'><?=$title?></div>"));
	$.modal(div,{
		onClose: function() {
			location.assign("/admin/disk");
		}
	});
	meter = new $.progress();
	meter.update("<?=$progress['progress']?>","<?=$progress['status']?>");
	div.append( meter.root().addClass("text") );
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
						//location.assign("/admin/disk");
						div.append(
							$('<div class="buttons" />')
							.append(
								$("<input type='button' class='no simplemodal-close' value='<?=t("Close")?>' />")
							)
						);
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
