<?php 


/**
 * 计算两数相加之和
 * @param [type] $a [description]
 * @param [type] $b [description]
 */
function add1($a, $b)
{
	$sum = $a + $b;
	return $sum;
}

$a = 1;
$b = 2;
$c = add($a, $b);
echo "$a + $b = $c".PHP_EOL;

/**
 * 计算两数相加之和
 * @param int $a [description]
 * @param int $b [description]
 */
function add2(int $a, int $b): int {
    $a += $b;
    return $a;
}

/*$n3 = 8.0;
$n4 = 9.1;
$s2 = add($n3, $n4);

$n5 = '学院君';
$n6 = 2;
$s3 = add($n5, $n6);*/

//值传递和引用传递
//函数参数默认以值传递方式进行传递，也就是说，我们传递到函数内部的实际上是变量值的拷贝，而不是变量本身
/**
 * 计算两数相加之和
 * @param int $a [description]
 * @param int $b [description]
 */
function add3(int $a, int $b) {
	$a += $b;
	return $a;
}
//形参（形式参数）和实参（实际参数），函数签名中的 $a、$b 仅仅是形参而已，外面定义的变量 $a、$b 才是实参
$a = 1;
$b = 2;
$c = add($a, $b);
printf("\$a = %d\n",$a);
printf("\$c = %d\n",$c);


//如果我们想要形参 $a 的赋值和修改与实参 $m 关联起来，可不可以做到呢？当然可以，这就需要引入引用传递的概念 —— 上面的实现传递的是值拷贝，我们把实参的指针赋值给形参，这样，修改形参的值就等同于修改实参值了，因为操作的是同一个内存地址中的值，在 PHP 中，不支持指针的概念，可以通过引用来替代，引用和指针一样，都是通过 & 获取

function add(int &$a, int $b) {
	$a += $b;
}

$m = 1;
$n = 2;
add($m, $n);
printf("\$m = %d\n",$m);

$str = "Hello，PHP!";
printf("字符串长度：%d\n",strlen($str));
printf("大写格式：%s\n",strtoupper($str));
printf("小写格式：%s\n",strtolower($str));

$arr = [1, 3, 8, 7, 6];
sort($arr);
print_r($arr);
rsort($arr);
print_r($arr);
printf("数组最大值：%d\n",max($arr));
printf("数组最小值：%d\n",min($arr));


$num = 100;
$n1 = pow($num,2);
$n2 = sqrt($num);
$n3 = decbin($num);
$n4 = mt_rand(0, 100);
 ?>
