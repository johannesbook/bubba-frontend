<script type="text/javascript">

$(document).ready(function(){

	$("#ntp").click(function() {
		if($(this).attr('checked')) {
			$(".timedate").attr("disabled","true");
		} else {
			$(".timedate").removeAttr("disabled");
		}	
	})

});

</script>
