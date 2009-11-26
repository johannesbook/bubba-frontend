<script type="text/javascript">
$(document).ready(function(){
	$('#useauth').change(function(){
		$('#useunsecure').attr( 'disabled', ! $(this).is(':checked') );
	});
});
</script>
