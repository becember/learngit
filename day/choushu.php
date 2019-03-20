<?php
/**
 * [GetUglyNumber_Solution 定义函数]
 * @param [int] $index [求除第N个丑数]
 */
function GetUglyNumber_Solution($index)
{
	$count = 0;
	$m = 0;
	$number;
	while ($count < $index) {
		$m++;
		$number=$m;
		while ($number % 2 == 0) {
				$number /= 2;
		}
		while ($number % 3 == 0) {
			$number /= 3;
		}
		while ($number % 5 == 0) {
			$number /= 5;
		}
		if ($number == 1) {
			$count++;
		}
	}
	return $m;
}
$index = 100;
echo GetUglyNumber_Solution($index);
