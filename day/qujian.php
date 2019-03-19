<?php
/**
 * [calFn 函数定义]
 * @param  [int] $n [表示区间最小值]
 * @param  [int] $m [表示区间最大值]
 * @return [int]    [返回整数区间1出现的次数]
 */
function calFn($n,$m)
{
	$array = range($n,$m);
	$str = implode('',$array);
	$num = substr_count($str,1);
	return $num;
}

/**
 * [$n 区间最小值]
 * @var integer
 */
$n=13;

/**
 * [$m 区间最大值]
 * @var integer
 */
$m=1000;

echo calFn($n,$m);die;