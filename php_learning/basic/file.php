<?php
require './type.php';   //包含多次
require './type.php';
require_once './type.php';   //包含一次
require_once './type.php';

include './var.php';    ////包含多次
include './var.php';
include_once './var.php';   //包含一次

//require 遇到错误抛出error类别的错误，停止执行
//include 遇到错误抛出error类别的错误，继续执行

//HTML类型的包含页面中存在PHP代码，如果包含到PHP中是可以被执行的  
//包含文件相当于把包含文件中的代码拷贝到主文件中执行，魔术常量除外，魔术常量获取的是所在文件的信息

//包含编译时不执行，运行时加载到内存、独立编译包含文件

/**
 * 包含文件的路径
 * './' 当前目录
 * '../'上一级目录
 */
// set_include_path('c:\\')
phpinfo();
exit;

require './type.php';   //在当前目录下查找
require 'type.php';     //收include_path配置影响

//正斜（/）web中目录分隔用正斜 http://www.sina.com/index
//反斜（\）物理地址的分隔用反斜，（Windows中物理地址正斜和反斜都可以） c:\\aa\\bb


//错误处理
// 错误的级别
//1、notice：提示
//2、warning：警告
//3、error：致命错误
//notice和warning报错后继续执行，error报错后停止执行

//错误的提示方法
//1、显示在浏览器上
//2、记录在日志中

//与错误处理有关的配置
//在php.ini中
//1、error_reporting = E_ALL;   //报告所有的错误
//2、display_errors = on;   将错误信息显示在浏览器中
//3、log_errors = on;  将错误记录在日志中
//4、error_log = '地址'；错误日志保存地址

$debug = true;    //开发模式
ini_set('error_reporting', E_ALL);    //所有的错误有报告
if ($debug) {
    ini_set('display_errors', 'on');   //错误显示在浏览器上
    ini_set('log_errors', 'off');       //错误不显示在日志中
} else {
    ini_set('display_errors', 'off');
    ini_set('log_errors', 'on');
    ini_set('error_log', './error.log');
}

//测试
echo $tesst;


//自定义错误 =处理
//通过trigger_error产生一个用户级别的error/warning/notice信息
///用户级别的错误的常量名中一定要带有USER
$age = 100;
if ($age > 80) {
    // trigger_error('年龄不能超过80岁');   //默认触发了notice级别的错误
    // trigger_error('年龄不能超过80岁', E_USER_NOTICE);
    // trigger_error('年龄不能超过80岁', E_USER_WARNING);
    // trigger_error('年龄不能超过80岁', E_USER_ERROR);
}

//定义错误处理函数
function error() {
    echo '这是自定义错误处理函数';
}
set_error_handler('error'); ///注册错误处理函数，只要有错误就会自动的调用错误处理的函数
echo $testste;

/**
 * 自定义错误处理函数
 * @param $errno int 错误类别
 * @param $errstr string 错误信息
 * @param $errfile string 文件地址
 * @param $errline int 错误行号
 */
function error2($errno, $errstr, $errfile, $errline) {
    switch ($errno) {
        case E_NOTICE:
        case E_USER_NOTICE:
            echo '记录在日志中，上班后再处理<br>';
            break;
        case E_WARNING:
        case E_USER_WARNING:
            echo '给管理员发邮件<br>';
            break;
        case E_ERROR:
        case E_USER_ERROR:
            echo '给管理员打电话<br>';
            break;
    }

    echo "错误信息： {$errstr}<br>";
    echo "文件地址： {$errfile}<br>";
    echo "错误行号： {$errline}<br>";
}
set_error_handler('error2');




