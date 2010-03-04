<?

$children = array();

print "<div id='nav'>";
print "<ul>\n";

foreach($menu as $level) {
	if(isset($level["children"]) && is_array($level["children"])) {
		$children = $level["children"];
	}
	print "<li class='";
	if(isset($level["selected"]) && $level["selected"]) {
		print "active";
	}
	if(end($menu) == $level) {
		print " last";
	}

	print "'>";
	print "	<a href=\"" . FORMPREFIX . "/" . $level["uri"] . "\"><span>".t("title_" . $level["id"]) . "</span></a>";
	print "</li>\n";
}
print "</ul>\n";
print "</div>\n";

print "<div id='subnav'>";
print "<ul>\n";



foreach($children as $level) {
	print "<li class='";
	if(isset($level["selected"]) && $level["selected"]) {
		print "active";
	}
	if(end($children) == $level) {
		print " last";
	}

	print "'>";
	print "	<a href=\"" . FORMPREFIX . "/" . $level["uri"] . "\"><span>".t("title_" . $level["id"]) . "</span></a>";
	print "</li>\n";
}

print "</ul>\n";
print "</div>";

?>