<?php
/**
 * Integer division.
 *
 * @param int $n
 * @param int $d
 * @return int
 */
function intdiv($n, $d)
{
	$n = (int)$n;
	$d = (int)$d;
	return floor(($n + 0.5) / $d);
}
?>