<?php
/**
 * Returns either Active or Inactive depending on Status
 */
if ($status == TRUE || $status == 1) {
	echo 'Active';
} else {
	if ($status == FALSE || $status == 0){
	echo 'Inactive';
	} else {
	echo 'Unknown';
	}
}
?>
