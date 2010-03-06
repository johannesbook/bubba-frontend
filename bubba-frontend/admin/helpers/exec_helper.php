<?php
function _system( /* $command, $args... */ ) {
    $shell_cmd = escapeshellargs( func_get_args() );
	exec( $shell_cmd , $output, $retval );
	if( $retval == 0 ) {
		return $output;
	} else {
		return null;
	}
}

function escapeshellargs( array $cmd ) {
	$command = array_shift( $cmd );
	$shell_cmd = implode(
		' ',
		array(
			$command,
			implode( 
				' ',
				array_map( 
					'escapeshellarg', 
					$cmd 
				)
			)
		)
    );
    return $shell_cmd;
}

function invoke_rc_d( $name, $action ) {
    $cmd = array(
        "/usr/sbin/invoke-rc.d", 
        "--try-anyway", 
        $name, 
        $action
    );
    exec( escapeshellargs( $cmd ), $output, $retval );
    return $retval == 0;
}

function update_rc_d( $name, $action="defaults", $priority=0, $runlevel=0) {
		if( ($runlevel != 0) && ($priority != 0) ) {
		  $cmd = array(
		      "/usr/sbin/update-rc.d", 
		      $name, 
		      $action,
		      $priority,
		      $runlevel,
		      "."
		  );
		} else {
		  if($action == "remove") {
			  $cmd = array(
		      "/usr/sbin/update-rc.d", 
		      "-f", 
		      $name, 
		      $action
			  );
		  } else {
			  $cmd = array(
		      "/usr/sbin/update-rc.d", 
		      $name, 
		      $action
				);
			}
		}
	exec( escapeshellargs( $cmd ), $output, $retval );
	return $retval == 0;
}
