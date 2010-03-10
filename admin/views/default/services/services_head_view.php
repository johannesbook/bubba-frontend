<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.iCheckbox.js" type="text/javascript"></script>

<script  type="text/javascript">

$(document).ready(function(){
	var options = {
	switch_container_src: '<?=FORMPREFIX.'/views/'.THEME?>/_img/bubba_switch_container.png',
	class_container: 'ui-icon-bubba-switch-container',
	class_switch: 'ui-icon-bubba-switch',
	switch_speed: 50,
	switch_swing: -60,
	checkbox_hide: true,
	switch_height: 21,
	switch_width: 127
	};
	$(':input[type=checkbox]').iCheckbox( options );

	$("input[name='ftp_enabled']").change(function() {
		if($("input[name='ftp_enabled']").attr('checked')) {
			$("input[name='anon_ftp']").attr('disabled',false);
		} else {
			$("input[name='anon_ftp']").attr('disabled',true);
		}
	});
		
});

</script>
