<?php
function to_ordinal($number) {
	$nf = new NumberFormatter(textdomain(null), NumberFormatter::ORDINAL);
	return $nf->format($number);
}

function get_weekday($nbr) {
	switch($nbr){
	case 1:
		return _('Monday');
		break;
	case 2:
		return _('Tuesday');
		break;
	case 3:
		return _('Wednesday');
		break;
	case 4:
		return _('Thursday');
		break;
	case 5:
		return _('Friday');
		break;
	case 6:
		return _('Saturday');
		break;
	case 7:
	case 0:
		return _('Sunday');
		break;
	}
	return '';
}
