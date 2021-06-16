<?php

/**
 * 
 * 自动加载类
 * 在项目开发中，因为一个文件中只
 * 能写一个类，并且在执行过程中会有很多的类参与，如果一个一个的加载很麻烦
 * 所以，就需要一个机制实现在PHP执行过程中自动加载需要的类
 * 
 * 1、书写类的规则
 * （1）一个文件中只能放一个类（必须）
 * （2）文件名和类名同名（必须）
 * （3）类文件以.class.php结尾（不是必须）
 * 
 * 
 * 2、自动加载类 方法一：__autoload()函数
 * 当缺少类的时候自动调用__autoload()函数，并且将缺少的类名作为参数传递给__autoload().
 * 
 * 
 * 注意：__autoload()函数在PHP7.2以后就不支持了
 * 
 * 3、自动加载类： 方法二：spl_autoload_register()
 * 注册__autoload()
 * 
 * 
 * spl_autoload_register()可以注册多个自动加载函数，队列注册
 * 
 * 4、类文件存储不规则的加载方法
 * 将类名和文件地址做一个映射，组成一个关联数组。
 * spl_autoload_register(function($class_name){
 *      //将类名和文件地址做一个映射，组成一个关联数组。
 *      $map = array(
 *          'Goods' => './aa/Goods.class.php',
 *          'Book' => './bb/Book.class.php',
 *          'Phone' => './cc/Phone.class.php',
 *      );
 *      if(isset($map[$class_name]))
 *          require $map[$class_name];
 * 
 * })
 * 
 */








