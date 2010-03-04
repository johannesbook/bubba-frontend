<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Bubba|TWO - <?=t('title_'.$this->uri->segment(1))?> (<?=php_uname("n")?>)</title>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.ui.all.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/admin.css?v='<?=$this->session->userdata('version')?>'" />
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery-ui.js?v='<?=$this->session->userdata('version')?>'"></script>

<?if(false):?>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.lint.js?v='<?=$this->session->userdata('version')?>'"></script>
<?endif?>

<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/main.js?v='<?=$this->session->userdata('version')?>'"></script>
<?
if(isset($head)) {
	echo $head;
}
?>


<script type="text/javascript">
	
$(document).ready(function(){
	// Make a striped effect on tables in content
	$('table:not(.blank)').stripe();
	
	
	$('#home_switch').click(function(event) {  
            event.preventDefault();
            $('#home').toggle()
        } );
	$('#sideboard_switch').click(function(event) {  
            event.preventDefault();
            
            if($('#sideboard').is(":visible")) {
                $('#sideboard').hide();
                $('#content').css( 'width', '100%' );
            } else {
                $('#sideboard').show();
                $('#content').css( 'width', '70%' );
            }
            
        } );
	
<?if(preg_match("/Opera/i",$_SERVER['HTTP_USER_AGENT'])):?>
	
	$("input[type='checkbox']").removeClass("checkbox_radio");
	$("input[type='radio']").removeClass("checkbox_radio");

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
		$.post("<?=FORMPREFIX?>/help/load/html/<?=$uri?>", function(data) {
			$.dialog(
				data,
				"<?=t("help_box_header")?>",
				{},
				{'modal' : false, dialogClass : "ui-help-box", position : ['right','top']});
		});
	});

});
</script>
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
                <button id="fn-topnav-help" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" title="Help" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-lightbulb"></span><span class="ui-button-text">&nbsp;</span></button>
                <button id="home_switch" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" title="Home" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-home"></span><span class="ui-button-text">&nbsp;</span></button>
                <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" title="Log out" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-power"></span><span class="ui-button-text">&nbsp;</span></button>                
                <a id="sideboard_switch" href="#" class="ui-state-default" ></a>
            </div>	
            <a href="#" id="a_logo" onclick="location.href='<?=FORMPREFIX?>';"><img id="img_logo" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/logo.png" alt="BUBBA | 2" title="BUBBA | 2" /></a>
            <div id="nav"><?=$navbar?></div>
            <div id="subnav"><?=$subnav?></div>
        </div>		
        <div id="content">
        	<div id="<?=$this->uri->segment(1)?>">
            <?=$content?>
          </div>
        </div>
        <div id="sideboard" >
            <img id="img_sideboard" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/sideboard_tmp.png" alt="tempfil för dashboard" title="tempfil för dashboard" />
        </div>
    </div>
    <div id="home" style="display:none">   
        <ul>
            <li>
                <a class="default-icon default-icon-mail">
                    <span class="ui-icon ui-icon-locked"></span>
                </a>    
                <span class="" style="display:none">Webmail</span>
            </li>
            <li>
                <a class="default-icon default-icon-help"></a>
                <span class="" style="display:none">Help</span>
            </li>
            <li>
                <a class="default-icon default-icon-filemanager">
                    <span class="ui-icon ui-icon-locked"></span>
                </a>                
                <span class="" style="display:none">Help</span>
            </li>
            <li>
                <a class="default-icon default-icon-music">
                    <span class="ui-icon ui-icon-locked"></span>
                </a>
                <span class="" style="display:none">Music</span>
            </li>
            <li>
                <a class="default-icon default-icon-logout"></a>
                <span class="" style="display:none">Logout</span>
            </li>            
        </ul>
        <a id="home_close" class="ui-icon ui-icon-closethick" onclick="$('#home').toggle()"></a>
    </div>
    <div id="update_status"></div>
</body>
</html>
