<?php
/**
 * [One 求最后剩下的一个元素]
 * @param [int] $n [生成1~n的编号]
 * @param [int] $m [数到m时,将对应的元素删除]
 */
function One($n,$m)
{
    if ($n < 1 || $m < 1) {
        return -1;
    }
    for ($i=1; $i <= $n ; $i++) { 
       
        if ($m % $i == 0) {
            $n--;
        }
    }
    return $n;
}
/**
 *      $n = 3  $m = 2    $i=1 <=$n  ++
 *      1 2 3
 */
//编号1-3
$n = 3;
//数到2 删掉元素 从下一个开始
$m = 1;
echo One($n,$m);