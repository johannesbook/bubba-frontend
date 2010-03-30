<script  type="text/javascript">

$(document).ready(function(){
	$("input[name='ftp_enabled']").change(function() {
		if($("input[name='ftp_enabled']").not(':disabled').is(':checked') ) {
			$("input[name='anon_ftp']").attr('disabled',false);
		} else {
			$("input[name='anon_ftp']").attr('disabled',true);
		}
	}).change();

	$("input[type='submit']").click( function () {
		$("input").attr("disabled","disabled");
	});
		
});

</script>
