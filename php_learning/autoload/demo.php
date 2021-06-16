<?php
// require './Goods.class.php';
// require './Book.class.php';
// require './Phone.class.php';

// function __autoload($class_name) {
//     require "./{$class_name}.class.php";
// }

// function loadClass($class_name) {
//     require "./{$class_name}.class.php";
// }

// spl_autoload_register('loadClass');

spl_autoload_register(function ($class_name) {
    require "./{$class_name}.class.php";
});


$book = new Book('面向对象编程');
$book->setName();
$phone = new Phone('苹果6s');
$phone->setName();
$book->getNAme();
$phone->getName();

