<script type="text/javascript">

function postlogin_callback(e) {
	$("#fn-login-dialog-button").attr('disabled','disabled');
	$("#fn-login-dialog-button").addClass("ui-state-disabled");
	$("#fn-login-error").children().hide();
	$.post(config.prefix+'/login/index/json',
	$("#fn-login-dialog-form").serialize(),
		function(data){
			if(data.authfail) {
				if(data.auth_err_remote) {
					$("#fn-login-error-wanaccess").show();
				} else {
					$("#fn-login-error-pwd").show();
					$("#password").select();
				}
				$("#fn-login-dialog-button").removeAttr('disabled');
				$("#fn-login-dialog-button").removeClass("ui-state-disabled");
			} else {
				$(this).dialog('close');
				$(this).dialog('destroy');
				if(e) {
					if(e.uri) {
						window.location.href = e.uri;
					} else {
						window.location.href = $(e.target).attr('href');
					}
				} else {
					window.location.reload();
				}
			}
		},"json");
}

function dialog_loginclose_callback() {
	$("#fn-login-error").children().hide();
}

function dialog_login(e) {
	that = this;
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
			$.dialog(
				$("#div-login-dialog").show(),
				"",
				[
					{
						'label': $.message("login-dialog-continue"),
						'callback': function(){ return postlogin_callback.apply( that, [e])},
						options: { 'id': 'fn-login-dialog-button', 'class' : 'ui-element-width-100' }
					}
				],
		{dialogClass : "ui-login-dialog", draggable: false, close : dialog_loginclose_callback, open: function(){
			if(link_locked && data.user && data.valid_session) {
				// show no-access message if the target is locked for the current user.
				$("#fn-login-error-grantaccess").show();
			}
			var self =this;
			if(required_user && (data.user != required_user) ) {
				var username = $("input[name=username]", self);
				var password = $("input[name=password]", self);
				$("input[name=username]", self).val(required_user);
				if( $.browser.msie ) {
				// IE makes men cry
					setTimeout(function(){$("input[name=password]", self).focus().focus()},50);
				} else {
					$("input[name=password]", self).focus()
				}
			} else {
				$("input[name=username]", self).val("");
				if( $.browser.msie ) {
				// IE makes men cry
					setTimeout(function(){$("input[name=username]", self).focus().focus()},50);
				} else {
					$("input[name=username]", self).focus()
				}
			}
			
		}}
			);
		} else {
			window.location.href = $(e.target).attr('href');
		}
	},"json");
	return false;
}

$(document).ready(function(){
	
	<? if(!$this->session->userdata('valid')):?>
		$('#fn-topnav-logout span:first').removeClass("ui-icon-logout").addClass("ui-icon-login");
		$('#s-topnav-logout').text('<?=t("Login")?>');
		
	<? endif ?>
	$("#fn-login-dialog-form input").keypress(function(e) {
		if( e.which == $.ui.keyCode.ENTER ) {
			//postlogin_callback.apply(this,[e]);
			$("#fn-login-dialog-button").click();
		}
	});		

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
	
	<?if(isset($show_login) && $show_login):?>
		//show dialog_login
		var redirect = new Array();
		redirect.uri = "<?=$redirect_uri?>";
		dialog_login(redirect);
	<?endif?>

});
</script>
