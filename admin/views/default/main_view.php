<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Bubba|TWO - <?=t('title_'.$this->uri->segment(1))?> (<?=php_uname("n")?>)</title>
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/screen.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/admin.css?v='<?=$this->session->userdata('version')?>'" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery-ui.css?v='<?=$this->session->userdata('version')?>'" />
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery-ui.min.js?v='<?=$this->session->userdata('version')?>'"></script>

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


<div id="site_wrapper">
	<div id="content">
		<div id="header_wrapper">
			<div id="header">
				<div id="logo" style="cursor:pointer;" onclick="location.href='<?=FORMPREFIX?>';"></div>
				<div id="nav">
					<?=$navbar?>
				</div>
			</div>
		</div>
		<div id="site">
			<div class="segment">
				<div id="sub_nav">
					<?=$subnav?>
				</div>
				<div class="clear"></div>
				<?
				if($topic=$this->uri->segment(1)) {
					$help_topic = "help_" . $this->uri->segment(2);
					if(t($help_topic) != $help_topic) {
						// t-function returned a translated link
					} else {
						$help_topic = "help_".$topic;
					}
				} else {
					$topic = "stat";
					$help_topic = "help_stat";
				}
				?>
				<h1 class="segment_title"><?
					if(USER!="none"){?>
						<span class="help"><a href="/manual/<?=t($help_topic)?>" target="_blank"><?=t('Help')?></a></span>
					<?} else {?>
						<span class="help"><a href="/manual/<?=t("help_login")?>" target="_blank"><?=t('Help')?></a></span>
					<?}?>
					<span class="title"><img class="icon" src="<?=FORMPREFIX.'/views/'.THEME?>/_icons/<?=$topic?>.gif" alt=""></img><?=t('title_'.$topic)?></span></h1>
				<div class="content">
					<div class="header">
						<div class="footer">
							<?=$content?>
						</div>
					</div>
				</div>
				<div id="update_status"></div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
