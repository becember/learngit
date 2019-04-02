<?php
/**
 * [NumberOf1 输入一个正整数，输出该数二进制表示中1的个数]
 * @param [int] $n [一个正整数]
 */
function NumberOf1($n)
{
    $count = 0;
    while($n)
    {
        ++$count;
        $n = ($n-1) & $n;
    }
    return $count;
}
echo NumberOf1(100);die;