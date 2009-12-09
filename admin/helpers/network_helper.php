<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function parse_ip( $ip ) {
	if( !is_array( $ip ) ) {
		$ip = explode( '.', $ip );
		foreach( $ip as &$i ) {
			$i = (int)$i;
		}
		unset( $i );
	}

	return $ip;
}

function validate_ip( array $ip ) {
	if ( count( $ip ) != 4 ) {
		return false;
	}
	foreach($ip as $i){
		if( (!is_numeric($i)) || ($i>255) || ($i<0) ){
			return false;
		}
	}
	return true;
}

function validate_ports( $range ) {
	$ports = explode( ':', $range );
	$number_ports =  count( $ports );
	if( $number_ports == 1 ) {
		$port = $ports[0];
		if( 
			!is_numeric( $port ) || 
			$port < 0 || 
			$port > 65535 
		) {
			return false;
		}
	} elseif( $number_ports == 2 ) {
		list( $low, $high ) = $ports;
		if( 
			!is_numeric( $low ) ||
			!is_numeric( $high ) ||
			$high < $low ||
			$low < 0 ||
			$high > 65535 
		) {
			return false;
		}
	} else {
		return false;
	}
	return true;
}

function validate_ip_range( $range_start, $range_end, $local_ip, $local_mask ) {
	$range_start = parse_ip( $range_start );
	$range_end = parse_ip( $range_end );
	$local_ip = parse_ip( $local_ip );
	$local_mask = parse_ip( $local_mask );

	if( 
		!validate_ip( $range_start ) ||
		!validate_ip( $range_end ) ||
		!validate_ip( $local_ip ) ||
		!validate_ip( $local_mask )
	) {
		return false;
	}
	$local_network = array(
		(int)$local_ip[0] & (int)$local_mask[0],
		(int)$local_ip[1] & (int)$local_mask[1],
		(int)$local_ip[2] & (int)$local_mask[2],
		(int)$local_ip[3] & (int)$local_mask[3]
	);

	// check that start range is in correct network.
	$wanted_network = array(
		(int)$range_start[0] & (int)$local_mask[0],
		(int)$range_start[1] & (int)$local_mask[1],
		(int)$range_start[2] & (int)$local_mask[2],
		(int)$range_start[3] & (int)$local_mask[3]
	);
	if(  
		($local_network[0] != $wanted_network[0]) || 
		($local_network[1] != $wanted_network[1]) || 
		($local_network[2] != $wanted_network[2]) || 
		($local_network[3] != $wanted_network[3]) 
	) { 
		return false;
	}

	// check that end range is in correct network.
	$wanted_network = array(
		(int)$range_end[0] & (int)$local_mask[0],
		(int)$range_end[1] & (int)$local_mask[1],
		(int)$range_end[2] & (int)$local_mask[2],
		(int)$range_end[3] & (int)$local_mask[3]
	);
	if( 
		($local_network[0] != $wanted_network[0]) ||
		($local_network[1] != $wanted_network[1]) ||
		($local_network[2] != $wanted_network[2]) ||
		($local_network[3] != $wanted_network[3]) 
	) { 
		return false;
	}
	$retval = false;
	if($range_end[0]>$range_start[0]) {
		$retval=true;
	} elseif ($range_end[0] == $range_start[0]) {
		if($range_end[1]>$range_start[1]) {
			$retval=true;
		} elseif ($range_end[1] == $range_start[1]) {
			if($range_end[2]>$range_start[2]) {
				$retval=true;
			} elseif ($range_end[2] == $range_start[2]) {
				if($range_end[3]>$range_start[3]) {
					$retval=true;
				}
			}
		}
	}
	return $retval;
}

?>
