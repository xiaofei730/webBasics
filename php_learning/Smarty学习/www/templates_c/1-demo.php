<?php
require './Smarty/Smarty.class.php';

$title = '锄禾';
$smarty = new Smarty();

// $stu = ['tom', 'berry'];

$stu = array('tom', 'berry');

$emp = array('name' => 'rose', 'sex'=>'女');

$goods = array(
    array( 'name'=> '手机', 'price' => 22),
    array('name' => '钢笔', 'price' => 11)

);


$smarty->assign('stu', $stu);

$smarty->assign('emp', $emp);

$smarty->assign('stu2', array('first'=>'tom', 'second'=>'berry', 'third'=>'ketty', 'forth'=>'rose'));

$smarty->assign('stu3', array('tom', 'berry'));

$smarty->assign('title', $title);
$smarty->assign('name', 'tom');
$smarty->caching =true;         //开启缓存
$smarty->force_cache = true;    //强制更新缓存
$smarty->display('1-demo.html');


$smarty->display('1-demo.html', $_GET['pageno']);       //缓存分页

$color = $_GET['color'];
$size = $_GET['size'];

$smarty->display('1-demo.html', "$color|$size"); 
