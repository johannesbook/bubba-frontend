<script type="text/javascript">

$(document).ready(function(){

	$("#ntp").change(function() {
		if($(this).attr('checked')) {
			$(".timedate").attr("disabled","true");
		} else {
			$(".timedate").removeAttr("disabled");
		}	
	})

});

</script>
