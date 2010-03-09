<script type="text/javascript">

function dialog_login(e) {
	required_user = <?=(isset($required_user) && $required_user)?"\"$required_user\"":"false"?>;
	if($(this).hasClass("fn-require-auth") && $(this).attr("name")) {
		required_user = $(this).attr("name");
	}
	link_locked = $(this).hasClass("fn-state-login-lock");
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
				"",
				[
					{
						'label': $.message("login-dialog-continue"),
						'callback': function(data){
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
						options: { id: 'fn-login-dialog-button', class : 'ui-element-100' }
					}
				],
				{dialogClass : "ui-login-dialog", draggable: false}
			);
			if(link_locked && data.user && data.valid_session) {
				// show no-access message if the target is locked for the current user.
				$("#fn-login-error-grantaccess").show();
			}
			if(required_user && (data.user != required_user) ) {
				$("#username").val(required_user);
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

	$(".fn-require-auth").click(function(e) {
		dialog_login.apply(this,[e]);
		return false;
	});
	
	$(".ui-login-menubar-a").mouseover(function(e) {	
		$(this).find("span").show();
	});
	
	$(".ui-login-menubar-a").mouseout(function(e) {
		$(this).find("span").hide();
	});
	
	$("#fn-topnav-home").attr("disabled","disabled");

	<?if(isset($show_login) && $show_login):?>
		//show dialog_login
		var redirect = new Array();
		redirect.uri = "<?=$redirect_uri?>";
		dialog_login(redirect);
	<?endif?>

});
</script>
