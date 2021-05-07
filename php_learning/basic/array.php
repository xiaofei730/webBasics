<?php 

$nums = [2,4,8,16,32];
$lans = ['PHP','Golang','JavaScript'];

var_dump($nums);
var_dump($lans);

print_r($nums);
print_r($lans);

$fruits = [];
$fruits[] = 'Apple';
$fruits[] = 'Orange';
$fruits[] = 'Pear';

print_r($fruits);

$fruit = $fruits[0];
$fruits[2] = 'Banana';
unset($fruits[1]);

print_r($fruits);
//PHP 数组并没有自动重新编排索引，而是留出了一个「空洞」，打印 var_dump($fruits[1]) 将会报错，提示对应元素值不存在：
//
$fruits = array_values($fruits);
print_r($fruits);

//要删除整个数组，可以用 unset($fruits) 实现，删除之后，$fruits 值变为 NULL并且不可用。

$book = ['Laravel精品课','学院君',2020,99.0,false];
print_r($book);

//PHP 没有字典（map/dict）这种数据类型，而是将其融入到数组中以关联数组的方式提供支持，与索引数组不同，关联数组通常需要显式指定数组元素的键

$book = ['name' => 'Laravel精品课','author' => '学院君','publish_at' => 2020,'price' => 99.0,'published' => true];
print_r($book);

$book = [
    'name' => 'Laravel精品课',
    'author' => '学院君',
    'publish_at' => 2020,
    'price' => 99.0,
    'published' => true,
    '掌握 Laravel 和 Vue 技术栈，成为合格的 PHP 全栈工程师！',
    'https://xueyuanjun.com/books/master-laravel',
];

print_r($book);


$book = [];

$book['name'] = 'Laravel精品课';
$book['author'] = '学院君';
$book['publish_at'] = 2020;
$book['price'] = 99.0;
$book['published'] = false;
$book['desc'] = '掌握 Laravel 和 Vue 技术栈，成为合格的 PHP 全栈工程师！';
$book['url'] = 'https://xueyuanjun.com/books/master-laravel';

$name = $book['name'];

$book['price'] = 199.0;

unset($book['url']);

print_r($book);
 ?>