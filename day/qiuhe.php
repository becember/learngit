<?php
/**
 * [Sum_Solution 求1到n的和]
 * @param [int] $n [传入参数]
 */
function Sum_Solution($n)
{
    $sum = array_sum(range(1,$n));
    return $sum;
}
$n = 100;
echo Sum_Solution($n);