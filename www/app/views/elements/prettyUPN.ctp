<?php
/**
 * Returns a prettified UPN in the format xxx-xxx-xxxxx
 */
if (!empty($pid)){
	if(strlen($pid) == 11){
		$part1 = substr($pid, 0, 3);
		$part2 = substr($pid, 3, 3);
		$part3 = substr($pid, -5);
		$prettyUPN = $part1 . '-' . $part2 . '-' . $part3;
		echo $prettyUPN;
		unset($part1,$part2,$part3,$prettyUPN);
	} else {
		echo $pid;
	}
} else{
	echo 'Unknown';
}
?>
