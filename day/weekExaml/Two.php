<?php
/**
 * [Two 计算每组数组的和相近]
 * @param array $array [传入数组]
 */
function Two(array $array)
{
    $arr = array_chunk($array,2);
    for ($i=0; $i <= 2; $i++) { 
        $num = array_sum($arr[$i]);
        echo $num."<br>";
    }
}
$array = array(1,6,2,5,3,4);
echo Two($array);