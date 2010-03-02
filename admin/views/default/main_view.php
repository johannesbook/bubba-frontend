<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Bubba|TWO - <?=t('title_'.$this->uri->segment(1))?> (<?=php_uname("n")?>)</title>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/admin.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery-ui-default.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.ui.all.css?v='<?=$this->session->userdata('version')?>'" />
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
                <span id="topnav_status">Inloggad som Admin</span>
                <a class="ui-icon ui-icon-lightbulb"></a>
                <a class="ui-icon ui-icon-home"></a>
                <a class="ui-icon ui-icon-power"></a>
                <a id="sideboard_switch" class="ui-icon-carat-1-w"></a>
            </div>	
            <a href="#" id="a_logo" onclick="location.href='<?=FORMPREFIX?>';"><img id="img_logo" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/logo.png" alt="BUBBA | 2" title="BUBBA | 2" /></a>
            <div id="nav"><?=$navbar?></div>
            <div id="subnav"><?=$subnav?></div>
        </div>		
        <div id="content">
            <?=$content?>				
        </div>
        <div id="sideboard" >
            <img id="sideboard" src="<?=FORMPREFIX.'/views/'.THEME?>/_img/sideboard_tmp.png" alt="tempfil för dashboard" title="tempfil för dashboard" />
        </div>
    </div>
    <div id="update_status"></div>
</body>
</html>