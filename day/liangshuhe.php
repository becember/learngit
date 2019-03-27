<?php
/**
 * [Add 求两个整数得和]
 * @param [int] $num1 [整数1]
 * @param [int] $num2 [整数2]
 */
function Add($num1,$num2)
{
    $num = array_sum(array($num1,$num2));
    return $num;
}
$num1 = 10;
$num2 = 20;
echo Add($num1,$num2);