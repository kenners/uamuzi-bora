<?php
/**
 * Takes $date as an input and returns a pretty date via date() or 'Unknown'
 */
if (!empty($date)) {
	echo date('d/m/Y', strtotime($date));
} else {
	echo 'Unknown';
}
?>
