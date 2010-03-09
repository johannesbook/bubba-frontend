<?

$children = array();


/* Top level navigation */
$navbar = "\t<ul>\n";

foreach($menu as $level) {
	if(isset($level["children"]) && is_array($level["children"])) {
		$children = $level["children"];
	}
	$navbar .= "\t\t<li class='";
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
$navbar .= "\t</ul>\n";


/* Sub level navigaion */

$subnav = "\t<ul>\n";

foreach($children as $level) {
	$subnav .= "\t\t<li class='";
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

$subnav .= "\t</ul>\n";

// print the navigation menus

print "\n<!-- ***********  navigation bars    *********** -->\n";

if( $this->Auth_model->policy("menu","show_level1") ) { 
	print "<div id='nav'>\n";
	print $navbar;
	print "</div>\n";
	print "<div id='subnav'>\n";
	print $subnav;
	print "</div> <!-- nav  -->\n";
} else {  // do not print the first level, and use second level as primary
	print "<div id='nav'>\n";
	print $subnav;
	print "</div> <!-- subnav  -->\n";
}
print "<!-- ***********  end navigation bars    *********** -->\n\n";



?>
