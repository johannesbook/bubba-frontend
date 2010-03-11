<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FirePlay</title>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/AC_RunActiveContent.js" language="javascript"></script>
</head>
<body bgcolor="#ffffff">
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0',
			'width', '100%',
			'height', '100%',
			'src', 'FirePlay',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'FirePlay',
			'bgcolor', '#ffffff',
			'name', 'FirePlay',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '<?=FORMPREFIX.'/views/'.THEME?>/music/FirePlay?host=<?=$host?>/music&port=<?=$port?>&preventdownload=0',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="100%" height="100%" id="FirePlay" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="<?=FORMPREFIX.'/views/'.THEME?>/music/FirePlay.swf?host=<?=$host?>/music&port=<?=$port?>&preventdownload=0" />
	<param name="quality" value="high" />
	<param name="bgcolor" value="#ffffff" />
	<embed src="<?=FORMPREFIX.'/views/'.THEME?>/music/FirePlay.swf?host=host=<?=$host?>/music&port=<?=$port?>&preventdownload=0" quality="high" bgcolor="#ffffff" width="100%" height="100%" name="FirePlay" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
</body>
</html>
