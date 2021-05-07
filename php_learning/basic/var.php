<?php 
//变量的本质就是内存中的一段空间

/*
1、变量必须以$开头，$符不是变量的一部分，仅表示后面的标识符是变量名
2、除了$以外，以字母、下划线开头，后面跟着数字、字母、下划线
3、变量名区分大小写，$aa 和 $Aa是两个空间

注意：PHP语句必须以分号结尾
*/


// PHP_EOL 是 PHP 内置的跨平台换行符常量
$greeting = "你好，PHP！";
echo $greeting . PHP_EOL;

printf("%s\n", $greeting);

$greeting = "你好，学员君！";
echo $greeting;

$greeting2 = "你好，PHP！";
$_greeting = "你好，PHP！";
$greeting_2 = "你好，PHP！";

// $欢迎语句 = "你好，PHP！";
// greeting = "你好，PHP！";
// $2greeting = "你好，PHP！";
// $greeting-2 = "你好，PHP！";
// 

$Greeting = "学员君，你好！";
echo $Greeting;

$varname = "greeting";
//可变变量 变量名可以变，将变量名存储在另外一个变量中
echo $$varname;


/**
 * 变量的传递有值传递和地址传递（引用传递）
 */
$num1 = 10;   //将10赋给$num1
$num2 = $num1;  //将$num1的值赋给$num2
$num2 = 20;    //更改$num2
echo $num1;   //10

$num3 = 10;   //将10赋给$num3
$num4 = &$num3;   //将$num3的地址赋给$num4
$num4 = 30;    //更改$num4
echo $num3;    //30

/**
 * 用unset销毁变量，销毁的是变量名，变量值有PHP垃圾回收机制销毁（没有变量引用的值是垃圾）
 */
unset($num3);
echo($num4);


/**
 * 在整个运行过程中，固定不变的值
 * 1、用define()函数定义常量
 * define(常量名，值，是否区分大小写) true不区分，默认是false
 * 2、常量名前没有$符
 * 3、常量名推荐使用大写
 * 使用特殊字符做变量名,调用的时候必须用constant关键字调用
 * 判断常量是否定义，通过defined()判断
 * 还可以使用const定义常量
 */
define("LANGUAGE", "PHP");
define("AUTHOR", "学员君");
echo LANGUAGE.":".AUTHOR.PHP_EOL;

define('%-%', 'tom');
echo constant('%-%');

const FRAMEWORK = "Laravel";
echo LANGUAGE.'-'.FRAMEWORK.'-'.AUTHOR.PHP_EOL;

/**
 * 预定义常量 PHP预先定义好的常量
 */
echo PHP_VERSION,'<br>';
echo PHP_OS,'<br>';
echo PHP_INT_MAX,'<br>';

/**
 * 魔术常量
 */

 echo __LINE__,'<br>'; //文件的当前行号
 echo __LINE__,'<br>'; //文件的完整路径和文件名
 echo __FILE__,'<br>';  //文件所在的目录
 ?>