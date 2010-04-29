<script>
$(document).ready(function(){
	$("#easyfind_enabled").change(function(){
		if($(this).is(':checked'))  {
			$('#easyfind_name').removeAttr('disabled');
			$("#easyfind_name").select();
		} else {
			$('#easyfind_name').attr('disabled', 'disabled');
		}
	});
	$("#easyfind_name").bind("keyup",function(){
		$("#fn-settings-easyfind-url").text($('#easyfind_name').val());
	});
});
</script>
