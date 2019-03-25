<?php
/**
 * [Three 最大值]
 * @param [array] $array [传入数组]
 */
function Three($array)
{
    $max = max($array);
    $arr = implode('',$array);
    $res = strrev($arr);
    return $res;
}

$array = array(1,2,3,4,5);
echo Three($array);