<?php
/**
 * [cust 定义函数]
 * @param  [int] $a [第一个数]
 * @param  [int] $b [第二个数]
 * @return [int]    [第三个数]
 */
function cust($a,$b)
{
    $res = intval($a.''.$b) > intval($b.''.$a);
    return $res;
}
/**
 * [PrintMinNumber 定义函数]
 * @param [array] $numbers [对数组进行排序处理]
 */
function PrintMinNumber($numbers)
{
    @usort($numbers,cust);
    $result = intval(implode('',$numbers));
    return $result;
}
$a = array(3,32,321);
$data = PrintMinNumber($a);
print_r($data);
