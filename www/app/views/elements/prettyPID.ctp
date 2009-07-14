<?php
/**
 * Returns a string left-padded with 0's to 9 digits, split up into groups
 * of three
 */
echo chunk_split(str_pad($pid, 9, '0', STR_PAD_LEFT), 3, ' ');
?>
