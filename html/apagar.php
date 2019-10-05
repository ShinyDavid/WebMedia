<?php
	exec( 'shutdown -h now', $output, $return_val );

	print_r( $output );
	echo "\n";
	echo 'Error: '. $return_val ."\n";
?>
