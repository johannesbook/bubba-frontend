<?
	$CI = &get_instance();
	$CI->load->library('browser_cap');
	$browser = $CI->browser_cap->getBrowser(null, true);
?>
<?="<?xml version=\"1.0\" encoding=\"UTF-8\"?>"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title><?=NAME?> - <?=$this->menu->resolve($this->uri->segment(1))?> (<?=php_uname("n")?>)</title>

<!--[if IE]><link rel="shortcut icon" href="<?=FORMPREFIX.'/views/'.THEME?>/favicon_ie.ico"><![endif]-->
<link rel="icon" type="image/png" href="<?=FORMPREFIX.'/views/'.THEME?>/favicon_64px.png" />


<? /* <link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.ui.css?v='<?=$this->session->userdata('version')?>'" /> */ ?>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.ui.theme.default.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/admin.css?v='<?=$this->session->userdata('version')?>'" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/IE7styles.css" /><![endif]-->  

<?if($browser['Browser'] === 'Safari'):?>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/Safaristyles.css" />
<?endif?>

<!-- jQuery and jQueryUI javascript libraries -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery-ui.js?v='<?=$this->session->userdata('version')?>'"></script>

<!-- Validation -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ba-resize.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.validate.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/additional-methods.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.throbber.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.pubsub.js?v='<?=$this->session->userdata('version')?>'"></script>


<!-- Config -->
<script type="text/javascript">
config = <?=json_encode(
	array(
		'prefix' => FORMPREFIX,
		'theme' => THEME,
		'version' => $this->session->userdata('version'),
		'ua' => $browser,
		'name' => NAME
	)
)?>;
</script>
<!-- Internationalization -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.sprintf.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/locale/'.LANGUAGE.'/LC_MESSAGES/bubba.json'?>?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/Gettext.js?v='<?=$this->session->userdata('version')?>'"></script>
<meta http-equiv=”content-language” content=”<?=LANGUAGE?>” />

<!-- Sideboard gadgets -->
<!--[if IE]><script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/excanvas.compiled.js"></script><![endif]-->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/coolclock.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.jclock.js"></script>

<?if(false):?>
<!-- jQuery lint debug -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.lint.js?v='<?=$this->session->userdata('version')?>'"></script>
<?endif?>

<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.iCheckbox.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/main.js?v='<?=$this->session->userdata('version')?>'"></script>


<script type="text/javascript">

    var gt = new Gettext({
        'domain': 'bubba',
        'locale_data': json_locale_data
	});
    function _ (msgid) { return gt.gettext(msgid); }
    function gettext (msgid) { return gt.gettext(msgid); }
    function ngettext (msgid, msgid_plural, n) { return gt.ngettext(msgid, msgid_plural, n); }
    function npgettext (msgctxt, msgid, msgid_plural, n) { return gt.npgettext(msgctxt, msgid, msgid_plural, n); }
    function pgettext (msgctxt, msgid) { return gt.pgettext(msgctxt, msgid); }

var login_dialog;
var window_music;
var window_pim;
var window_album;

jQuery.validator.setDefaults({ 
	errorPlacement: function(label, element) {
		label.insertAfter( element );
		label.position({
			'my': 'left bottom',
			'at': 'right center',
			'of': element,
			'offset': "10 0"
		});
	},
	invalidHandler: function() {
		$(this).closest('ui-dialog').children('.ui-dialog-buttonpane').find('.ui-button').button('enable');
	}	
});


	
$(document).ready(function(){
	$.each( $.browser, function( key, value ) {
		if( value && key !== 'version' ) {
			$('body').addClass(key);
		}
	});

	help_dialog = $.dialog(
		$('#fn-help-dialog').show(),
		"<?=sprintf(_("%s Help"), NAME)?>",
		{},
		{autoOpen: false, 'modal' : false, dialogClass : "ui-help-box", position : ['right','top']});

	menu_dialog = $.dialog(
		$("#menu"),
			"",
			{},
		{ 
			autoOpen: false, 
			dialogClass: 'ui-dialog-menu', 
			width : '674' ,
			position : [-800, 200], 
			'collision': 'none' 
		}
		);
	$('a', menu_dialog).click(function(){menu_dialog.dialog('close')});

	$('#fn-topnav-logout').click(function(event) {
		<? if($this->Auth_model->CheckAuth("web_admin")):?>
			logout_dialog();
		<?else:?>
			dialog_login();
		<? endif ?>
  	});
    $('#fn-topnav-home').click(function() {
    	window.location.href = '<?=FORMPREFIX?>';
    });
    $('#fn-topnav-settings').click(function() {
    	window.location.href = '<?=FORMPREFIX?>/stat';
    });
  
    $('#fn-menu-trigger').click(function() {
    	display_menu();
		});
  
	  $(document).keydown(function(e) {
		  if(e.which == 77 && ($(e.target).is(':not(:input)') && !$('.ui-dialog:not(.ui-dialog-menu)').is(':visible') || $(e.target).hasClass('ui-dialog-menu'))) {
		  	display_menu();
		  }
		});


  	$(".ui-login-menubar-a").mouseover(function(e) {	
		$(this).find("div").show();
	});	

	$(".fn-login-dialog-a").click(function(e) {
		if(login_dialog) {
			login_dialog.dialog('close');
			login_dialog.dialog('destroy');
		}
	});
	$('.fn-menubar-link-music').click(function(event){
			event.preventDefault();
			// we need to stop here
			event.stopImmediatePropagation();
			$.throbber.show();
			$(
				window.open(
					event.target.href,
					"musicWindow",
					"menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes"
				)
			)
			.ready(function(){
				$.throbber.hide();
			}).focus();

			//return false;
		}
	);	
	$(".ui-login-menubar-a").mouseout(function(e) {
		$(this).find("div").hide();
	});	


	$("#fn-topnav-help").mouseover(function(e) {		$("#s-topnav-help").show();	});	
	$("#fn-topnav-help").mouseout(function(e) {		$("#s-topnav-help").hide();	});	
	$("#fn-topnav-settings").mouseover(function(e) {		$("#s-topnav-settings").show();	});	
	$("#fn-topnav-settings").mouseout(function(e) {		$("#s-topnav-settings").hide();	});	
	$("#fn-topnav-home").mouseover(function(e) {		$("#s-topnav-home").show();	});	
	$("#fn-topnav-home").mouseout(function(e) {		$("#s-topnav-home").hide();	});	
	$("#fn-topnav-logout").mouseover(function(e) {		$("#s-topnav-logout").show();	});	
	$("#fn-topnav-logout").mouseout(function(e) {		$("#s-topnav-logout").hide();	});

	
	$('#sideboard_switch').click(function(event) {
		if($('#sideboard_switch').hasClass("ui-icon-open")) {
			$('#sideboard').show('slide', {duration: 600, direction: 'right', easing: 'easeInOutCubic'});
			$('#sideboard_switch').addClass('ui-icon-close');
			$('#sideboard_switch').removeClass('ui-icon-open');		
			$.get(config.prefix+"/users/config/json/show_sideboard/1");
		} else {
			$('#sideboard').hide('slide', {duration: 600, direction: 'right', easing: 'easeInOutCubic'});
			$('#sideboard_switch').addClass('ui-icon-open');
			$('#sideboard_switch').removeClass('ui-icon-close');		
			$.get(config.prefix+"/users/config/json/show_sideboard/0");
		}
	});
<?if(  !$this->session->userdata("run_wizard") && ($this->session->userdata("show_sideboard") && $this->Auth_model->CheckAuth("web_admin") ) || (isset($show_sideboard) && $show_sideboard && !$this->Auth_model->CheckAuth("web_admin")) ):?>
	$("#sideboard").show();
	$("#sideboard_switch").removeClass("ui-icon-open");
	$("#sideboard_switch").addClass("ui-icon-close");
<?endif?>

<?if(isset($update) && is_array($update)):?>

	update_status(
		<?=( isset($update['success']) && $update['success'] ) ? "true" : "false"?>,
		"<?=isset($update['message']) ? _($update['message']) : ""?>"
	);

<?endif?>

	$("#fn-topnav-help").click( function() {
		if(!$(".ui-help-box").is(":visible")) {
			<?
			$uri = $this->uri->segment(1,"index");
			if($this->uri->segment(2)) {
				$uri .= "_".$this->uri->segment(2);
			}
			?>
			<?if($this->session->userdata("user") == "admin"):?>
				help_uri = config.prefix+"/help/load/html/<?=$uri?>";
			<?else:?>
				help_uri = config.prefix+"/help/load/html/user_<?=$uri?>";
			<?endif?>
			$.post(help_uri, function(data) {
				help_dialog.html(data).dialog('open');
			});
		};
	});

});
</script>

<?
if(isset($head)) {
	echo $head;
}
?>
</head>
<body id="body_<?=$this->uri->segment($this->uri->total_segments())?>">
<div id="bg-right"></div>

    <table id="wrapper">	    
    
		<tr>
		<td id="topnav">
		<div id="topnav-content">
		<div id="topnav-content-inner">
				<span id="topnav_status">
	
            <?if ($this->Auth_model->CheckAuth("web_admin")) { ?>
	            <?=sprintf(_("Logged in as '%s'"), $this->session->userdata("realname"))?>
            <?} else {?>
	            <?=_("Not logged in")?>
            <? } ?>
        </span>
            <button id="fn-topnav-logout" class="ui-button" role="button" aria-disabled="false"><div class="ui-icons ui-icon-logout"></div><div id="s-topnav-logout" class="ui-button-text"><?=_("Logout")?></div></button>
            <button id="fn-topnav-home" class="ui-button" role="button" aria-disabled="false"><div class="ui-icons ui-icon-home"></div><div id="s-topnav-home" class="ui-button-text"><?=_("Home")?></div></button>
            <button id="fn-topnav-settings" class="ui-button" role="button" aria-disabled="false"><div class="ui-icons ui-icon-settings"></div><div id="s-topnav-settings" class="ui-button-text"><?=_("Administration")?></div></button>
            <button id="fn-topnav-help" class="ui-button" role="button" aria-disabled="false"><div class="ui-icons ui-icon-help"></div><div id="s-topnav-help" class="ui-button-text"><?=_("Help")?></div></button>
		</div>
		</div>
            <a id="sideboard_switch" href="#" class="ui-icons ui-icon-open"></a>
		</td> 	<!-- topnav --> 
		<td id="empty-header"></td>
        </tr>   
    
		<tr>
		<td id="content_wrapper">	
            <div id="header">		
                
                	<?if(isB3()) :?>
                		<div id="main-excito-logo">
					<a href="http://www.excito.com" target="_tab" class="ui-excito-link"><img id="ex_logo" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/purple-X.png" alt="<?=_("Excito")?>" /></a>
                			<span id="ui-main-byExcito">by Excito Sweden</span>
                		</div>
		                <a href="#" id="a_logo" onclick="location.href='<?=FORMPREFIX?>'">
				<img id="img_logo" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/B3_logo.png" alt="<?=_("B3 start page")?>" title="<?=_("B3 start page")?>" />
                		</a>
					<?else:?>                	
		                <a href="#" id="a_logo" onclick="location.href='<?=FORMPREFIX?>'">
                		<img id="img_logo" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/logo.png" alt="BUBBA | 2" title="BUBBA | 2" />
                		</a>
                	<?endif?>
                <?=$navbar?>
            </div>	<!-- header -->		

            <div id="content">
            	<div id="<?=$this->uri->segment(1)?>"> 	<!-- section -->
                	<?=$content?>
              	</div> 	<!-- section -->
            </div>	<!-- content -->
            
    		<div id="update_status" class="ui-corner-all ui-state-highlight ui-helper-hidden"></div>
        </td>	<!-- content_wrapper -->

		<td id="sideboard-wrapper">
        <?include("sideboard_view.php")?>
		</td> <!-- sideboard -->
		</tr>
    </table> <!-- wrapper -->
<?/*
    <?if( $this->uri->total_segments() && ($this->uri->segment(1) != "login") ) :?>
	    <div id="menu-trigger">
		<button id="fn-menu-trigger" class="ui-button" role="button" aria-disabled="false"><div class="ui-icons ui-icon-menu-trigger"></div><div id="s-topnav-home" class="ui-button-text" style="display:none"><?=_("Menu")?></div></button>
	    </div>
	  <?endif?>
*/?>
		<?=$dialog_menu?>

	<div id="fn-help-dialog" class="ui-help-dialog ui-helper-hidden"></div>

</body>
</html>
