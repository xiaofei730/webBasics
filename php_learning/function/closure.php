<?php  
/**
 * 通过匿名函数定义两数相加函数 add
 * @var [type]
 */
$add = function (int $a, int $b):int {
	return $a + $b;
};

$n1 = 1;
$n2 = 2;
$sum = $add($n1, $n2);
echo "$n1 + $n2 = $sum".PHP_EOL;

var_dump($add);

$sum = call_user_func($add,$n1,$n2);
echo "$n1 + $n2 = $sum".PHP_EOL;

/**
 * 通过匿名函数定义两数相加函数 add
 * @var [type]
 */
$add2 = function (int $a, int $b = 2) : int {
	return $a + $b;
};

$multi = function (int $a, int $b) : int {
	return $a + $b;
};

$n3 = 1;
$n4 = 3;
$sum2 = $add2($n3, $n4); 
echo "$n3 + $n4 = $sum2".PHP_EOL;

$add2 = $multi;
$product = $add2($n3,$n4);
echo "$n3 x $n4 = $product" . PHP_EOL;

$n5 = 1;
$n6 = 3;
//只需要通过 use 关键字传递当前上下文中的变量，它们就可以在闭包函数体中直接使用，而不需要通过参数形式传
$add3 = function ()use ($n5, $n6) {
	return $n5 + $n6;
};

$multi2 = function () use ($n5, $n6) {
	return $n5 * $n6;
};

$sum3 = $add3();
echo "$n5 + $n6 = $sum3" . PHP_EOL;
$product2 = $multi2();
echo "$n5 x $n6 = $product2" . PHP_EOL;

function add4($n7,$n8){
	return function () use ($n7, $n8){
		return $n7 + $n8;
	};
}

function add5(){
	return function(){
		global $n7,$n8,$n9;
		return $n7 + $n8 + $n9;
	};
}

$n7 = 1;
$n8 = 3;
$n9 = 4;
$add6 = add4($n7,$n8);
$sum4 = $add6();
echo "$n7 + $n8 = $sum4" . PHP_EOL;

$add7 = add5();
$sum5 = $add7();
echo "$n7 + $n8 + $n9 = $sum5" . PHP_EOL;

function test() {
    printf("n7 = %d, n8 = %d, n9 = %d\n", $GLOBALS['n7'], $GLOBALS['n8'], $GLOBALS['n9']);
}

test();

?>