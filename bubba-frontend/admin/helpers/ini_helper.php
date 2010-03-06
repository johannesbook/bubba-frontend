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
						$res[] = "  $sskey\[\] = " . ( is_numeric($ssval) ? $ssval : '"' . $ssval . '"' );
					}
				} else {
					$res[] = "  $skey = " . ( is_numeric($sval) ? $sval : '"' . $sval . '"' );
				}
			}
		} else {
			$res[] = "$key = " . ( is_numeric($val) ? $val : '"' . $val . '"' );
		}
	}
	file_put_contents( $filename, $res, LOCK_EX );
}
