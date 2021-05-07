<?php 
/**
 * 数据类型有两种：强类型和弱类型  （所谓弱类型的意思是变量是什么类型取决于值是什么类型）
 * PHP是弱类型
 */
	$name = "Laravel 精品课";
	$author = '学员君';


if (is_string($name)) {
	echo "$name 是字符串".PHP_EOL;
}

if (is_string($author)) {
	echo "$author 也是字符串".PHP_EOL;
}

var_dump($name);
var_dump($author);

//单引号与双引号的区别
////单引号字符串中引用变量不会对变量值进行解析，如果是双引号，则会对引用变量值进行解析：
///因此日常可以用单引号字符串的地方，尽量用单引号字符串，除非某些场景必须使用双引号字符串，比如像上面那样包含转移字符
if (is_string($name)) {
	echo "\"$name\" 是字符串".PHP_EOL;
}

if (is_string($author)) {
	echo "'$author' 也是字符串".PHP_EOL;
}

$publish_at = 2020;
var_dump($publish_at);

echo "当前系统 PHP 整型有效值范围: " . PHP_INT_MIN . '~' . PHP_INT_MAX;

$price = 99.0;
var_dump($price);

$published = false;
var_dump($published);

$str = '123';
$int = 2020;
$float = 99.0;
$bool = false;

var_dump((int) $str);
var_dump((bool) $str);
var_dump((string) $str);

exit();

 ?>