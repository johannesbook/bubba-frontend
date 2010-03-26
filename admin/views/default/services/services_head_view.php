<script  type="text/javascript">

$(document).ready(function(){
	$("input[name='ftp_enabled']").change(function() {
		if($("input[name='ftp_enabled']").attr('checked')) {
			$("input[name='anon_ftp']").attr('disabled',false);
		} else {
			$("input[name='anon_ftp']").attr('disabled',true);
		}
	});

	$("input[type='submit']").click( function () {
		$("input").attr("disabled","disabled");
	});
		
});

</script>
