<script type="text/javascript">

$(document).ready( function() {
	$("#stat-shutdown").click(function() {

		var buttons = {};
		buttons[$.message("stat-shutdown-button-continue")] =  function() {
			$.post(
				config.prefix+"/shutdown/confirm/json",
				{shutdown : true},
				function(data) {
					if(!data.error) {
						window.location.href = config.prefix+"/login/confirmed";
					} else {
						window.location.href = config.prefix+"/login";
					}
				}
			)};
		$.confirm( 
				$.message("stat-shutdown-confirm-message"),
				$.message("stat-shutdown-confirm-title"),
				buttons
		);
		return false;
	});
		
	piechart($('#piechart'));
});

</script>