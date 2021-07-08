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

$smarty->assign('title', $title);
$smarty->assign('name', 'tom');
$smarty->display('1-demo.html');
