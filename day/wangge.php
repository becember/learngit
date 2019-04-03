<?php
/**
 * [CountSeps 计算小团的走法数目]
 * @param [int] $x [X轴网格]
 * @param [int] $y [Y轴网格]
 */
function  CountSeps($x,$y)
{
    if ($x == 0 || $y == 0) {
        return 0;
    }
    if ($x == 1 && $y == 1 ) {
        return 2;
    }
    $a = (($x-1)*$y)+($x*$y);
    return $a;
}
$x = 2;
$y = 2;
echo CountSeps($x,$y);