<?php
function _system( /* $command, $args... */ ) {
	$args = func_get_args();
	$command = array_shift( $args );
	$shell_cmd = implode(
		' ',
		array(
			$command,
			implode( 
				' ',
				array_map( 
					'escapeshellarg', 
					$args 
				)
			)
		)
	);
	exec( $shell_cmd , $output, $retval );
	if( $retval == 0 ) {
		return $output;
	} else {
		return null;
	}
}
