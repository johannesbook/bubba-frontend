<?php
function write_ini_file( $filename, $array )
{
    $res = array();
    foreach( $array as $key => $val )
    {
        if( is_array($val) ) {
            $res[] = "[$key]";
			foreach($val as $skey => $sval) {
				if( is_array( $sval ) ) {
					foreach($sval as $sskey => $ssval) {
						$res[] = "  $sskey\[\] = $ssval";
					}
				} else {
					$res[] = "  $skey = $sval";
				}
			}
		} else {
			$res[] = "$key = $val";
		}
	}
	file_put_contents( $filename, implode("\n",$res), LOCK_EX );
}
