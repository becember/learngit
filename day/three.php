<?php
class Three 
{
	/**
	 * [dg description]
	 * @param  [type] $n [description]
	 * @return [type]    [description]
	 */
	static function dg($n){
		if ($n <= 0) {
			# code...
			return 0;
		}
		if ($n == 1 || $n == 2) {
			# code...
			return 1;
		}
		return self::dg($n-1) + self::dg($n-2);
	}
	/**
	 * [dt description]
	 * @param  [type] $n [description]
	 * @return [type]    [description]
	 */
	static function dt($n){
		$array = [];
		$array[1] = 1;
		$array[2] = 1;
		for ($i=3; $i <= $n; $i++) { 
			$array[$i] = $array[$i-1] + $array[$i-2];
		}
		return $array;
	}
}
$wjf = new Three();
$res = Three::dg(6);
echo $res;
echo "<br>";
$res1 = $wjf->dt(6);
print_r($res1);
echo "<br>";
echo "递推效率要比递归高";