<?php

$title = '锄禾';
$str = file_get_contents('./index.html');
$str = str_replace('{', '<?php echo', $str);        //替换左大括号
$str = str_replace('}', '?>', $str);            //替换右大括号
// echo $str;

file_put_contents('./index.html.php', $str);
require './index.html.php';

/**
 * Smarty的引入
 * （1）为了分工合作，模板页面中最好不要出现PHP的代码
 * （2）要将表现和内容相分离
 * 
 * 自定义Smarty
 * 1、演化一：（smarty生成混编文件）
 * 在模板中不能出现PHP定界符，标准写法如下：
 * 1、html代码
 * 
 * $title = '锄禾';
 * $str = file_get_contents('./index.html');
 * $str = str_replace('{', '<?php echo', $str);        //替换左大括号
 * $str = str_replace('}', '?>', $str);            //替换右大括号
 * // echo $str;
 * 
 * file_put_contents('./index.html.php', $str);
 * require './index.html.php';
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
