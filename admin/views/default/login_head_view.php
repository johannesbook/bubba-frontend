<script type="text/javascript">

function dialog_login(e) {
	require_admin = <?=(isset($require_admin) && $require_admin)?"true":"false"?>;
	if($(this).hasClass("fn-login-require-admin")) {
		require_admin = true;
	}
	link_locked = $(this).hasClass("fn-login-state-lock");
	// check if already logged in.
	$.post("<?=FORMPREFIX.'/login/checkauth'?>",function(data){
		if(!data.valid_session || link_locked || e.uri) {
   		/* Show login if 
   			* no active session or
   			* the user does not have access rights or
   			* if the user has been redirected here
   		*/
			$.confirm(
				$("#div-login-dialog").show(),
				"<?=t('login-dialog-header')?>",
				{
					"<?=t('login-dialog-continue')?>": function() { // continue button
					
						$.post("<?=FORMPREFIX.'/login/index/json'?>",
						$("#fn-login-dialog-form").serialize(),
						function(data){
							// make sure to hide error messages								
							$("#fn-login-error").children().hide();
							if(data.authfail) {
								if(data.auth_err_remote) {
									$("#fn-login-error-wanaccess").show();
								} else {
									$("#fn-login-error-pwd").show();
									$("#password").select();
								}
							} else {
								$(this).dialog('close');
								if(e.uri) {
									window.location.href = e.uri;
								} else {
									window.location.href = $(e.target).attr('href');
								}
							}
						},"json");
					},
					"<?=t('login-dialog-cancel')?>": function() { // cancel button
						// make sure to hide error messages								
						$("#fn-login-error").children().hide();
						$("#password").val("");
						$(this).dialog('close');
					}
				}
			);
			if(link_locked && data.user && data.valid_session) {
				// show no-access message if the target is locked for the current user.
				$("#fn-login-error-grantaccess").show();
			}
			if(require_admin && (data.user != "admin") ) {
				$("#username").val("admin");
				$("#password").focus();
			} else {
				$("#username").val("");
				$("#username").focus();
			}
		} else {
			window.location.href = $(e.target).attr('href');
		}
	},"json");
	return false;
}

$(document).ready(function(){

  // do not use css to hide login as it is then impossible to login if javascripts are not working.
	$("#div-login-dialog").hide();

	$(".fn-login-auth-required").click(function(e) {
		dialog_login.apply(this,[e]);
		return false;
	});

	<?if(isset($show_login) && $show_login):?>
		//show dialog_login
		var redirect = new Array();
		redirect.uri = "<?=$redirect_uri?>";
		dialog_login(redirect);
	<?endif?>

});
</script>
