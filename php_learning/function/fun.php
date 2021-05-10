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











 