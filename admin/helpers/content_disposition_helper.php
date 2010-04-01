<?php
/*
 * per http://greenbytes.de/tech/tc2231
 */
function content_disposition( $type, $filename ) {
	$CI = &get_instance();
	$CI->load->library('browser_cap');
	$browser = $CI->browser_cap->getBrowser();

	if( 
		($browser->Browser == 'Firefox' && $browser->MajorVer >= 3)
		||
		($browser->Browser == 'Opera' && $browser->MajorVer >= 10) 
	) {
		// only Firefox and Opera handles RFC2231 encoding
		return "Content-Disposition: $type; filename*=utf-8''".rawurlencode($filename);
	}
	elseif( 
		($browser->Browser == 'Chrome' && $browser->MajorVer >= 3 ) 
		||
		($browser->Browser == 'Konqueror' && $browser->MajorVer >= 4 ) 
	) {
		// Chrome and Konqueror supports RFC2047 encoding even though it's wrongful
		// Firefox and opera also seems to do this, but we uses RFC 2231 for them
		
		return "Content-Disposition: $type; filename=\"".mb_encode_mimeheader($filename, 'UTF-8', 'Q')."\"";
	} elseif(
		($browser->Browser == 'IE' && $browser->MajorVer >= 7)
	){
	
		return "Content-Disposition: $type; filename=".rawurlencode($filename);

	} else {

		// Poor MSIE gets the bad name, nothing to do sadly, as it doesn't support standards
		// Safari goes here too as it seems to lack finess as well.
		return "Content-Disposition: $type; filename=\"".$filename."\"";

	}
}
