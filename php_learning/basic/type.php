<?php 
/**
 * 数据类型有两种：强类型和弱类型  （所谓弱类型的意思是变量是什么类型取决于值是什么类型）
 * PHP是弱类型 7.0以后就可以指定强类型
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
/**
 * 字符串型
 * 单引号字符串是真正的字符串
 * 双引号字符串要解析字符串中的变量
 */
echo '我的名字叫$name','<br>';
echo "我的名字叫$name",'<br>';

echo '$name是我的我的名字','<br>';
// echo "$name是我的名字",'<br>';     //会报错，变量名从$开始
echo "{$name}是我的名字",'<br>';     //{}表示获取变量的值
echo "${name}是我的名字",'<br>';    //$和{}只要挨着一起就可以

echo '文件保存在c:\\';  //转义字符，输出特殊字符

//字符串界定符 heredoc 
//必须由<<<开头，后面跟着的是标识符
//字符串定界符的结束符必须顶格写，前面不能由任何的空白字符
//字符串定界符分为两种，heredoc（双引号） ，nowdoc(单引号)
echo <<<shi
$name <br>
<strong>锄禾日当午</strong>
<em>汗滴禾下土</em>
<u>谁知盘中餐</u> 
shi;

echo <<<'shi'
$name <br>
<strong>锄禾日当午</strong>
<em>汗滴禾下土</em>
<u>谁知盘中餐</u>
shi;

if (is_string($name)) {
	echo "\"$name\" 是字符串".PHP_EOL;
}

if (is_string($author)) {
	echo "'$author' 也是字符串".PHP_EOL;
}

$publish_at = 2020;
var_dump($publish_at);

echo "当前系统 PHP 整型有效值范围: " . PHP_INT_MIN . '~' . PHP_INT_MAX;

/**
 * 浮点数
 * 浮点数在内存中保存的是近似值
 * 浮点数不能参与比较
 * 如果浮点数要比较，必须确定比较的位数
 * 注意如果一个整数超出来整型的范围，会自动转成浮点型
 */

 var_dump(0.9 == (1-0.1));  //bool(true)
 echo '<br>';
 var_dump(0.1 == (1-0.9));  //bool(false)
 echo '<br>';
 var_dump(bccomp(0.1,1-0.9,5));  //比较小数点后面5位 int(0) 0表示相等

$price = 99.0;
var_dump($price);

/**
 * 布尔型
 * 不能使用echo、print输出，要使用var_dump
 */
echo true;
print false;
$published = false;
var_dump($published);

$str = '123';
$int = 2020;
$float = 99.0;
$bool = false;

/**
 * 特殊类型
 * 1、资源
 * 2、null 在PHP中null和NULL是一样的，不区分大小写
 */

/**
 * 自动类型转换: 当提供的类型和需要的类型不一致的时候会自动进行类型转换
 */
$num2 = 10;
if ($num2) {
	echo 'aa';
} else {
	echo 'bb';
}

echo '20' - 10;

/**
 * 强制类型转换
 * 语法：（数据类型）数据
 * 其他类型和布尔型之间的转换
 * 规则：0、空为false，非0非空为true
 * 1、数字转换规律：0为false，非0为true
 * 2、字符串数组转换规则：0和空是false，其他是true
 */
var_dump((int) $str);
var_dump((bool) $str);
var_dump((string) $str);

var_dump((bool)'abc'); echo '<br>';    //bool(true)
var_dump((bool)''); echo '<br>';		//bool(false)
var_dump((bool)'0'); echo '<br>';		//bool(false)
var_dump((bool)'0.0'); echo '<br>';		//bool(true)
var_dump((bool)'false'); echo '<br>';	//bool(true)
var_dump((bool)'null'); echo '<br>';	//bool(true)
var_dump((bool)1); echo '<br>';			//bool(true)
var_dump((bool)0); echo '<br>';			//bool(false)
var_dump((bool)-10); echo '<br>';		//bool(true)
var_dump((bool)0.0); echo '<br>';		//bool(false)
var_dump((bool)array()); echo '<br>';		//bool(false)
var_dump((bool)array(1)); echo '<br>';		//bool(true)
var_dump((bool)array(false)); echo '<br>';		//bool(true)
var_dump((bool)null); echo '<br>';		//bool(false)



 ?>