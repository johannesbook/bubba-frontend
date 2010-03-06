<script>
$(document).ready(function(){
	$("#easyfind_enabled").change(function(){
		if($(this).is(':checked'))  {
			$('#easyfind_name').removeAttr('disabled');
		} else {
			$('#easyfind_name').attr('disabled', 'disabled');
		}
	});
});
</script>
