<?php

/**
 * 单例模式
 * 一个类只能有一个对象
 * 应用场景：多次请求数据库值需要一个连接对象
 * 实现：三私一公
 * （1）私有的静态属性用来保存对象的单例
 * （2）私有的构造方法用来阻止在类的外部实例化
 * （3）私有的__clone阻止在类的外部clone对象
 * （4）公有的静态方法用来获取对象的单例
 * 
 * class DB {
 *      private static $instance;
 *      //私有的构造方法阻止在类的外部实例化
 *      private function __construct() {
 *      }
 *      
 *      //私有的__clone()阻止在类的外部clone对象
 *      private function __clone(){}
 * 
 *      public static function getInstance() { 
 *          //保存的值不属于DB类的类型就实例化
 *          if (self::$instance instanceof self)
 *              self::$instance = new self();
 *          return self::$instance;
 *      }
 * 
 * }
 * 
 * $db = DB::getInstance;
 * $db2 = clone $db;
 * $db2 = DB::getInstance;
 * var_dump($db, $db2)
 * 
 */


/**
 * 
 * 工厂模式
 * 
 * 特点：传递不同的参数获取不同的对象
 * 
 * class ProductsA{
 * 
 * }
 * class ProductsB{
 * 
 * }
 * 
 * class ProductsFactory {
 *      public function create($num) {
 *          switch($num) {
 *              case 1:
 *                  return new ProductsA;
 *              case 2:
 *                  return new ProductsB;
 *              default:
 *                  return null;
 *          }
 *      }
 * 
 * }
 * $factory = new ProductsFactory();
 * 
 * $obj1 = $factory->create(1);
 * $obj2 = $factory->create(2);
 * 
 * var_dump($obj1, $obj2);
 * 
 */



/**
 * 策略模式
 * 特点：传递不同的参数调用不同的策略（方法）
 * 
 * class Walk
 * 
 * 
 * 
 * 
 * 
 */




