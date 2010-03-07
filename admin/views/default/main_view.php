<?="<?xml version=\"1.0\" encoding=\"UTF-8\"?>"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Bubba|TWO - <?=t('title_'.$this->uri->segment(1))?> (<?=php_uname("n")?>)</title>

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.ui.all.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/admin.css?v='<?=$this->session->userdata('version')?>'" />

<!-- jQuery and jQueryUI javascript libraries -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery-ui.js?v='<?=$this->session->userdata('version')?>'"></script>

<!-- currently diverted from original -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.dialog.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.button.js?v='<?=$this->session->userdata('version')?>'"></script>

<!-- Internationalization -->
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.sprintf.js?v='<?=$this->session->userdata('version')?>'"></script>
<?if(file_exists(APPPATH.'views/'.THEME.'/i18n/'.LANGUAGE.'/messages.js')):?>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME.'/i18n/'.LANGUAGE.'/messages.js'?>?v='<?=$this->session->userdata('version')?>'"></script>
<?else :?>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME.'/i18n/default/messages.js'?>?v='<?=$this->session->userdata('version')?>'"></script>
<?endif?>

<!-- Sideboard gadgets -->
<!--[if IE]><script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/excanvas.js"></script><![endif]-->
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
	
$(document).ready(function(){
	
	$('#fn-topnav-logout').click(function(event) {
		logout_dialog();
  	});
    $('#fn-topnav-home').click(function(event) {
        $('#menu').toggle();
  	});
  	$(".ui-login-menubar-a").mouseover(function(e) {	
		$(this).find("span").show();
	});	
	$(".ui-login-menubar-a").mouseout(function(e) {
		$(this).find("span").hide();
	});
	$('#sideboard_switch').click(function(event) {  
		if($('#sideboard').is(":visible")) {
			$('#sideboard').hide();
			$("#content").css("width","95%");
			$("#sideboard_switch").text("<");
			$.post(config.prefix+"/users/config/1/show_sideboard/0");
		} else {
			$('#sideboard').show();
			$("#content").css("width","75%");
			$("#sideboard_switch").text(">");
			$.post(config.prefix+"/users/config/1/show_sideboard/1");
		}
	});
<?if( ($this->session->userdata("show_sideboard") && $this->session->userdata("valid") ) || (isset($show_sideboard) && $show_sideboard && !$this->session->userdata("valid")) ):?>
	$("#content").css("width","75%");
	$("#sideboard").show();
	$("#sideboard_switch").text(">");
<?endif?>

<?if(isset($update) && is_array($update)):?>

	update_status(
		<?=( isset($update['success']) && $update['success'] ) ? "true" : "false"?>,
		"<?=isset($update['message']) ? t($update['message']) : ""?>"
	);

<?endif?>

	$("#fn-topnav-help").click( function() {
		<?
		$uri = $this->uri->segment(1,"index");
		if($this->uri->segment(2)) {
			$uri .= "_".$this->uri->segment(2);
		}
		?>
		$.post(config.prefix+"/help/load/html/<?=$uri?>", function(data) {
			$.dialog(
				data,
				"<?=t('help_box_header')?> - <?t('title'.$this->uri->segment(1))?>",
				{},
				{'modal' : false, dialogClass : "ui-help-box", position : ['right','top']});
		});
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
<?	
	if( $this->session->userdata("valid") ){
		if(isset($wizard)) {
			if($wizard) {
				print "<div class=\"wizard_bg\"></div>";
				print "<div class=\"wizard\">";
			  echo $wizard;
				print "</div>";
			}
		}
	}
?>
    <div id="wrapper">	
        <div id="header">		
            <div id="topnav">
            		<?if ($this->session->userdata("valid")) { ?>
	                <span id="topnav_status"><?=t("topnav-authorized",$this->session->userdata("user"))?></span>
            		<?} else {?>
	                <span id="topnav_status"><?=t("topnav-not-authorized")?></span>
            		<? } ?>
                <button id="fn-topnav-help" class="ui-button" role="button" aria-disabled="false"><span class="ui-icons ui-icon-help"></span><span class="ui-button-text">&nbsp;</span></button>
                <button id="fn-topnav-home" class="ui-button" role="button" aria-disabled="false"><span class="ui-icons ui-icon-home"></span><span class="ui-button-text">&nbsp;</span></button>
                <button id="fn-topnav-logout" class="ui-button" role="button" aria-disabled="false"><span class="ui-icons ui-icon-logout"></span><span class="ui-button-text">&nbsp;</span></button>                
                <a id="sideboard_switch" href="#">&lt;</a>
            </div>	<!-- topnav -->
            <a href="#" id="a_logo" onclick="location.href='<?=FORMPREFIX?>';"><img id="img_logo" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/logo.png" alt="BUBBA | 2" title="BUBBA | 2" /></a>
            <?=$navbar?>
        </div>	<!-- header -->		
        <div id="content">
        	<div id="<?=$this->uri->segment(1)?>"> 	<!-- section -->
            	<?=$content?>
          	</div> 	<!-- section -->
        </div>	<!-- content -->
         <?include("sideboard_view.php")?>
    </div>	<!-- wrapper -->
	<?=$dialog_menu?>
    <div id="update_status"></div>
</body>
</html>
