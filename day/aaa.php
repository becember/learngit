<?php
/**
 * [FindNumbersWithSum 在数组中查找两个数，使得他们的和正好是S，如果有多对数字的和等于S，输出两个数的乘积最小的]
 * @param [array] $array [一个递增排序的数组]
 * @param [int] $sum   [一个数字S]
 */
function FindNumbersWithSum($array,$sum)
{
    $lenth = count($array);
    if ($lenth<2 || $lenth==0) {
        return false;
    }
    $list = array();
    $start = 0;
    $end = $lenth-1;
    while ($start<$end && $start<$lenth-1 && $end>0) {
        if ($array[$start] + $array[$end] == $sum) {
            array_push($list,$array[$start]);
            array_push($list,$array[$end]);
            return $list;
        }
        if ($array[$start] + $array[$end] < $sum) {
            $end--;
        }
        if ($array[$start] + $array[$end] > $sum) {
            $start++;
        }
        return $list;
    }
}
print_r(FindNumbersWithSum(array(1,2,3,4,5),7));