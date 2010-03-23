<script type="text/javascript">



$(document).ready( function(e) {

	$("#stat-shutdown input[type='submit']").click(function() {
		var buttons = {};
		var action = $(this).attr("name");
		var button_label;
		var message;
		var title;
		if(action == "shutdown") {
			button_label = $.message("stat-shutdown-button-continue");
			message = $.message("stat-shutdown-confirm-message");
			title = $.message("stat-shutdown-confirm-title");
		} else {
			button_label = $.message("stat-reboot-button-continue");
			message = $.message("stat-reboot-confirm-message");
			title = $.message("stat-reboot-confirm-title");			
		}
		buttons[button_label] =  function()  {
			$("#fn-stat-shutdown-action").val(action);
			$("#stat-shutdown").submit();
			};
		$.confirm( 
				message,
				title,
				buttons
		);
		return false;
	});
		
	piechart($('#piechart'));

});

</script>