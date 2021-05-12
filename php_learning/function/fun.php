<?php
/**
 * 函数
 * 1、函数就是一段代码块
 * 2、函数可以实现模块化编程
 */

 /**
  * 函数定义
  * function 函数名 (参数1,参数2,....) { // 函数体}
  */

  //通过函数名()调用函数
function show(){
    echo '锄禾日当午';
}

//调用 函数名不区分大小写
show();
SHOW();

/**
 * 小结：
 * 1、变量名区分大小写
 * 2、关键字、函数名不区分大小写
 */

/**
 * 可变函数
 * 将函数名存储到变量中
 */
function showName($args) {
    echo $args.'<br>';
}
$str = 'showName';
$str('锄禾日当午');

function showChinese() {
    echo '锄禾日当午';
}

function showEnglish() {
    echo 'to be or not to be , is a question';
}

$fun = rand(1,10)%2? 'showChinese' : 'showEnglish';   //可变变量
$fun();

/**
 * 匿名函数
 * 没有名字的函数
 */

$fun2 = function() {
    echo '锄禾日当午';
};
$fun2();

/**
 * 参数传递
 * 函数的参数有形式参数和实际参数
 * 形式参数是定义函数时候的参数
 * 实际参数是调函数时候的参数 
 */

 function fun3($num1, $num2){
    echo $num1+$num2;
 }

 fun3(10, 20);


 //默认情况下，参数的传递是值传递
 $num3 = 10;
 
 function fun4($args){
    $args = 100;
 }
 fun4($num3);
 echo $num3;

 //地址传递
 $num4 = 10;
 
 function fun5(&$args){
    $args = 100;
 }
 //只能放变量，不能用常量作为实参
 fun5($num4);
 echo $num4;


 //参数默认值
 //1、在定义函数的时候给形参赋值就是参数的默认值
 //2、默认值必须是值，不能用变量代替
 //$str = '地址不详';
 //function fun6($name, $address=$str){
//     echo '姓名：'.$name.'<br>';
//     echo '地址：'.$address.'<br>';
// }
 //3、默认值可以使用常量
//define('ADD', '地址不详');
//function fun6($name, $address=ADD){
//     echo '姓名：'.$name.'<br>';
//     echo '地址：'.$address.'<br>';
// }
//4、有默认值的写在后面，没有默认值的写在前面
function fun6($name, $address='地址不详'){
    echo '姓名：'.$name.'<br>';
    echo '地址：'.$address.'<br>';
}

fun6('tom', '北京');
fun6('berry');


//参数个数不匹配
function fun7($name, $address){
    echo '姓名：'.$name.'<br>';
    echo '地址：'.$address.'<br>';
}

fun7('tom', '北京','zhongh'); //实参多于形参，只取前面对应的值
// fun7('berry');       //实参少于形参，会报错

//获取所有传递的参数
function fun8(){
    echo func_num_args(),'<br>';   //获取参数个数
    $args = func_get_args();      //获取参数数组
    print_r($args);
}

//参数约束
//1、定义变长参数
function fun9($name, $age, ...$hobby) {
    echo '姓名：'.$name,'<br>';
    echo '年龄：'.$age,'<br>';
    print_r($hobby);
}

fun9('tom', 22);
fun9('berry', 18, '读书', '睡觉');

//参数类型约束
function fun10(string $name, int $age) {
    echo '姓名：'.$name,'<br>';
    echo '年龄：'.$age,'<br>';
}
fun10('tom', 20);   //约束$name是字符串型，$age是整型

//返回值约束
//可以约束：string、int float bool 数组（array）
function fun11(int $num1, int $num2):int {
    return $num1 + $num2;
}
echo fun11(10, 20);

function fun12():array {
    return array();
}

function fun13():void {
    return;
}


/**
 * 作用域
 * 1、变量作用域
 * 1）、全局变量：在函数外面
 * 2）、局部变量：在函数里面，默认情况下，函数内部是不会取访问函数外的变量
 * 3）、超全局变量：可以在函数内部和外部访问
 * $_COOKIE,$_ENV,$_FILES,$_GET,$_GET,$_POST,$_REQUEST,$_SERVER,$_SESSION
 */
$num5 = 10;  
function fun15(){
    // echo $num5;     //会报错，函数内部默认不能访问函数外部的值
}
fun15();

$_POST['num'] = 10;  //将值赋值给超全局变量
function fun14(){
    echo $_POST['num'];     //获取超全局变量的值
}
fun14();

function fun16(){
    echo $GLOBALS['num5'];     //输出全局的变量
}
fun16();

function fun17(){
    global $num5;
    echo $num5;     //global将全局变量的地址引入到函数内部
}

fun17();

//注意：常量没有作用域的概念

//静态变量
//常量和静态变量的区别
//1、常量和静态变量都是初始化一次
//2、常量不能改变值，静态变量可以改变值
//3、常量没有作用域，静态变量有作用域
function fun18(){
    static $num6 = 10;  //静态变量只初始化一次
    $num6++;
    echo $num6;     
}

fun18();

fun18();

//匿名函数use()
//默认情况下，函数内部不能访问函数外部的变量，但在匿名函数中，可以通过use将外部变量引入匿名函数中
$num7 = 10;  
$fun19 = function() use ($num7){
    echo $num7;    
};

$fun19();


//递归
//函数内部自己调用自己
function printer($num) {
    echo $num,'&nbsp';
    if ($num == 1) return;
    printer($num - 1);
}
printer(9);

//斐波纳切数
function fbnq($n) {
    if ($n == 1 || $n == 2) return 1;
    return fbnq($n - 1) + fbnq($n - 2);
}

fbnq(5);










 