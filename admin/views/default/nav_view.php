<?

$children = array();


/* Top level navigation */
$navbar  = "<div id='nav'>";
$navbar = "<ul>\n";

foreach($menu as $level) {
	if(isset($level["children"]) && is_array($level["children"])) {
		$children = $level["children"];
	}
	$navbar .= "<li class='";
	if(isset($level["selected"]) && $level["selected"]) {
		$navbar .= "active";
	}
	if(end($menu) == $level) {
		$navbar .= " last";
	}

	$navbar .= "'>";
	$navbar .= "	<a href=\"" . FORMPREFIX . "/" . $level["uri"] . "\"><span>".t("title_" . $level["id"]) . "</span></a>";
	$navbar .= "</li>\n";
}
$navbar .= "</ul>\n";


/* Sub level navigaion */

$subnav = "<ul>\n";

foreach($children as $level) {
	$subnav .= "<li class='";
	if(isset($level["selected"]) && $level["selected"]) {
		$subnav .= "active";
	}
	if(end($children) == $level) {
		$subnav .= " last";
	}

	$subnav .= "'>";
	$subnav .= "	<a href=\"" . FORMPREFIX . "/" . $level["uri"] . "\"><span>".t("title_" . $level["id"]) . "</span></a>";
	$subnav .= "</li>\n";
}

$subnav .= "</ul>\n";

// print the navigation menus

if( !isset($show_level1) || (isset($show_level1) && $show_level1) ) { 
	print "<div id='nav'>\n";
	print $navbar;
	print "</div>\n";
	print "<div id='subnav'>\n";
	print $subnav;
	print "</div>\n";
} else {  // do not print the first level, and use second level as primary
	print "<div id='nav'>\n";
	print $subnav;
	print "</div>\n";
}



?>
