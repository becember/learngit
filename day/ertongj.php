<?php
/**
 * [LastRemaining_Solution 六一儿童节,最后的礼物]
 * @param [int] $n [代表人数]
 * @param [int] $m [表示喊到就要被淘汰的数返回小朋友的编号]
 */
function LastRemaining_Solution($n, $m)
{
    if ($n < 1 || $m < 1) {
        return -1;
    }
    $count = 0;
    for ($i=2; $i <= $n ; $i++) { 
        $count = ($count + $m) % $i;
    }
    return $count;
}
$n = 2;
$m = 1;
/**
 * 传入参数
 */
echo LastRemaining_Solution($n,$m);