<?php
function to_ordinal($number) {
	$absolute = abs((int)$number);
    switch($absolute % 10) {
    case 1:
        $suffix = "st";
        break;
    case 2:
        $suffix = "nd";
        break;
    case 3:
        $suffix = "rd";
        break;
    default:
        $suffix = "th";
        break;
	}
	// special case
	if( $absolute >= 11 && $absolute <= 13 ) {
		$suffix = "th";
	}
    return "$number$suffix";
}
