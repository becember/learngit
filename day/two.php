<?php
/**
 * [ShuiXianHua description]
 * @param [type] $i [description]
 */
function ShuiXianHua($i){
	$lenth = strlen($i);
	$i = (string)$i;
	$sum = 0;
	for ($j=0; $j < $lenth; $j++) { 
		# code...
		$sum+=pow($i{$j},$lenth);
	}
	return $sum==$i;
}
// $i = rand(100,999);
$i = 153;
$a = ShuiXianHua($i);
var_dump($a);die;
?>
