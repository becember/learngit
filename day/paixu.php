<?php
function cust($a,$b)
{
    $res = intval($a.''.$b) > intval($b.''.$a);
    return $res;
}
function PrintMinNumber($numbers)
{
    @usort($numbers,cust);
    $result = intval(implode('',$numbers));
    return $result;
}
$a = array(3,32,321);
$data = PrintMinNumber($a);
print_r($data);