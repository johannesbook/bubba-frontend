<?="<?xml version=\"1.0\" encoding=\"UTF-8\"?>"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Bubba|2 - <?=t('title_'.$this->uri->segment(1))?> (<?=php_uname("n")?>)</title>

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.ui.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.ui.theme.default.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/admin.css?v='<?=$this->session->userdata('version')?>'" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/IE7styles.css" /><![endif]-->  

<!-- jQuery and jQueryUI javascript libraries -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery-ui.js?v='<?=$this->session->userdata('version')?>'"></script>

<!-- currently diverted from original -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.dialog.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.button.js?v='<?=$this->session->userdata('version')?>'"></script>

<!-- Validation -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ba-resize.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.validate.js?v='<?=$this->session->userdata('version')?>'"></script>

<!-- Internationalization -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.sprintf.js?v='<?=$this->session->userdata('version')?>'"></script>
<?if(file_exists(APPPATH.'views/'.THEME.'/i18n/'.LANGUAGE.'/messages.js')):?>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME.'/i18n/'.LANGUAGE.'/messages.js'?>?v='<?=$this->session->userdata('version')?>'"></script>
<?else :?>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME.'/i18n/default/messages.js'?>?v='<?=$this->session->userdata('version')?>'"></script>
<?endif?>

<!-- Sideboard gadgets -->
<!--[if IE]><script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/excanvas.compiled.js"></script><![endif]-->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/coolclock.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.jclock.js"></script>

<?if(false):?>
<!-- jQuery lint debug -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.lint.js?v='<?=$this->session->userdata('version')?>'"></script>
<?endif?>

<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/main.js?v='<?=$this->session->userdata('version')?>'"></script>


<script type="text/javascript">

config = <?=json_encode(
	array(
		'prefix' => FORMPREFIX,
		'theme' => THEME,
		'version' => $this->session->userdata('version')
)
)?>;

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
	help_dialog = $.dialog(
		$('#fn-help-dialog').show(),
		"<?=t('help_box_header')?>",
		{},
		{autoOpen: false, 'modal' : false, dialogClass : "ui-help-box", position : ['right','top']});
	menu_dialog = $.dialog(
		$("#menu").show(),
			"",
			{},
			{ autoOpen: false, dialogClass: 'ui-dialog-menu', width : 650 }
		);
	$('a', menu_dialog).click(function(){menu_dialog.dialog('close')});
	$('#fn-topnav-logout').click(function(event) {
		<? if($this->session->userdata('valid')):?>
			logout_dialog();
		<?else:?>
			dialog_login();
		<? endif ?>
  	});
    $('#fn-topnav-home').click(function(event) {
		menu_dialog.dialog('open').show();
	});
  	$(".ui-login-menubar-a").mouseover(function(e) {	
		$(this).find("span").show();
	});	

	$(".fn-login-dialog-a").click(function(e) {
		if(login_dialog) {
			login_dialog.dialog('close');
			login_dialog.dialog('destroy');
		}
	});
	$(".ui-login-menubar-a").mouseout(function(e) {
		$(this).find("span").hide();
	});	
	$("#fn-topnav-help").mouseover(function(e) {		$("#s-topnav-help").show();	});	
	$("#fn-topnav-help").mouseout(function(e) {		$("#s-topnav-help").hide();	});	
	$("#fn-topnav-home").mouseover(function(e) {		$("#s-topnav-home").show();	});	
	$("#fn-topnav-home").mouseout(function(e) {		$("#s-topnav-home").hide();	});	
	$("#fn-topnav-logout").mouseover(function(e) {		$("#s-topnav-logout").show();	});	
	$("#fn-topnav-logout").mouseout(function(e) {		$("#s-topnav-logout").hide();	});
	$('#wrapper').resize(function(){
		$('#content_wrapper').width($('#wrapper').width()-160);
	});
	
	$('#sideboard_switch').click(function(event) {
		$('#sideboard').animate({width : 'toggle'},200);
		if($('#sideboard_switch').hasClass("ui-icon-open")) {
			// show sideboard
			$('#content_wrapper').animate({width : '-=160'},200);
			$("#topnav").animate({width : '+=160'},200);		
			$('#sideboard_switch').addClass('ui-icon-close');
			$('#sideboard_switch').removeClass('ui-icon-open');		
			$.get(config.prefix+"/users/config/json/show_sideboard/1");
		} else {
			// close sideboard
			$('#content_wrapper').animate({width : '+=160'},200);
			$("#topnav").animate({width : '-=160'},200);		
			$('#sideboard_switch').addClass('ui-icon-open');
			$('#sideboard_switch').removeClass('ui-icon-close');		
			$.get(config.prefix+"/users/config/json/show_sideboard/0");
		}
	});
<?if(  !$this->session->userdata("run_wizard") && ($this->session->userdata("show_sideboard") && $this->session->userdata("valid") ) || (isset($show_sideboard) && $show_sideboard && !$this->session->userdata("valid")) ):?>
	$("#content_wrapper").width($("#content_wrapper").width()-160);
	$("#topnav").width($("#topnav").width()+160);
	$("#sideboard").show();
	$("#sideboard_switch").removeClass("ui-icon-open");
	$("#sideboard_switch").addClass("ui-icon-close");
<?endif?>

<?if(isset($update) && is_array($update)):?>

	update_status(
		<?=( isset($update['success']) && $update['success'] ) ? "true" : "false"?>,
		"<?=isset($update['message']) ? t($update['message']) : ""?>"
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

	<?if(isset($wizard) && $wizard): ?>
		// load wizard dialog here
		$.dialog(
			$("#wizard").children(),
			"",
			{},
			{dialogClass : 'ui-widget-wizard', draggable : false, close : exit_wizard}
		);
	<?endif?>
});
</script>

<?
if(isset($head)) {
	echo $head;
}
?>
</head>
<body id="body_<?=$this->uri->segment($this->uri->total_segments())?>">
    <div id="wrapper">	    
    
        <div id="topnav">
            <?if ($this->session->userdata("valid")) { ?>
	            <span id="topnav_status"><?=t("topnav-authorized",$this->session->userdata("user"))?></span>
            <?} else {?>
	            <span id="topnav_status"><?=t("topnav-not-authorized")?></span>
            <? } ?>
            <button id="fn-topnav-logout" class="ui-button" role="button" aria-disabled="false"><span class="ui-icons ui-icon-logout"></span><span id="s-topnav-logout" class="ui-button-text" style="display:none">Logout</span></button>
            
            <button id="fn-topnav-home" class="ui-button" role="button" aria-disabled="false"><span class="ui-icons ui-icon-home"></span><span id="s-topnav-home" class="ui-button-text" style="display:none">Home</span></button>
            
            <button id="fn-topnav-help" class="ui-button" role="button" aria-disabled="false"><span class="ui-icons ui-icon-help"></span><span id="s-topnav-help" class="ui-button-text" style="display:none">Help</span></button>
            
            <a id="sideboard_switch" href="#" class="ui-icons ui-icon-open"></a>
        </div>	<!-- topnav -->    
    
        <div id="content_wrapper">	
            <div id="header">		
                
                <a href="#" id="a_logo" onclick="location.href='<?=FORMPREFIX?>';"><img id="img_logo" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/logo.png" alt="BUBBA | 2" title="BUBBA | 2" /></a>
                <?=$navbar?>
            </div>	<!-- header -->		
            <?if(! (isset($wizard) && $wizard)):?>
            <div id="content">
            	<div id="<?=$this->uri->segment(1)?>"> 	<!-- section -->
                	<?=$content?>
              	</div> 	<!-- section -->
            </div>	<!-- content -->
          	<?endif?>
            
    		<div id="update_status" class="ui-corner-all ui-state-highlight ui-helper-hidden"></div>
        </div>	<!-- content_wrapper -->
        <?include("sideboard_view.php")?>
    </div> <!-- wrapper -->
		<?=$dialog_menu?>

  <?if(isset($wizard) && $wizard):?>
		<div id="wizard" class="ui-wizard-<?=$this->uri->segment(1)?>" style="display:none">
		  	<?=$wizard?>
		</div> <!-- wizard -->
	<?endif?>
	<div id="fn-help-dialog" class="ui-help-dialog ui-helper-hidden"></div>

</body>
</html>
