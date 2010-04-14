<?php
/**
 * Returns a prettified UPN in the format xxx-xxx-xxxxx
 */
if (!empty($pid)) {
	if (strlen($pid) == 13) {
		$part1 = substr($pid, 0, 8);
		$part2 = substr($pid, 8, 5);
		$prettyUPN = $part1 . '-' . $part2;
		echo $prettyUPN;
		unset($part1, $part2, $part3, $prettyUPN);
	} else {
		echo $pid;
	}
} else {
	echo 'Unknown';
}
?>
