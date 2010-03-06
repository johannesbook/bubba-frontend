<?php

function get_thumb_path( $id ) {
		$CI =& get_instance();
		return "/var/lib/album/admthumbs/$id";
}

function get_image_path( $path ) {
		$CI =& get_instance();
		return $path;
}

function create_thumb( $orig, $target ) {
		$CI =& get_instance();
		$width = 300;
		$height = 225;
		$mod_width = $width * 1.2;
		$mod_height = $height * 1.2;
		$max = max($width, $height) * 2;

		$dir = dirname( $target );
		if( ! file_exists( $dir ) ) {
				mkdir( $dir, 0755, true );
		}
		$tmpfname = tempnam("/tmp", "thumb");
		exec("epeg -v -w $width -h $height \"$orig\" \"$target\"");
		unlink( $tmpfname);
}

function cache_control( $file ) {
		if( ! file_exists( $file ) ) {
				return true;
		}
		$last_modified_time = filemtime($file);

		$CI =& get_instance();
		$CI->output->set_header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");

		if (
				isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && @strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time
		) {
				$CI->output->set_header("HTTP/1.1 304 Not Modified");
				$CI->output->set_output("");
				return false;
		}
		return true;

}
