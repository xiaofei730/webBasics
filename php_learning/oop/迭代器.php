<?php
/**
 * 
 * 1、遍历数组
 * 手动遍历数组
 * （1）复位数组指针
 * （2）检查指针是否合法
 * （3）获取当前值
 * （4）获取当前键
 * （5）指针下移
 * 
 * $stu = ['tom', 'ketty', 'berry', 'rose'];
 * 
 * reset($stu);
 * echo key($stu)===null;
 * 
 * while(key($stu)!==null) {
 *      echo key($stu),'_',current($stu),'<br>';
 *      next($stu);
 * 
 * }
 * 
 * 
 * 2、迭代器
 * 场景：遍历对象，获取的是对象中属性保存的数组
 * 
 * 定义类实现迭代器接口
 * class MyClass implements Iterator{
 *      $list属性用来保存学生数组
 *      private $list = array();
 *      添加学生
 *      public function addStu($name) {
 *          $this->list[] = $name;
 *      }
 *      实现接口中的复位方法
 *      public function rewind() {
 *          reset($this->list);
 *      }
 * 
 *      验证当前指针是否合法
 *      public function valid() {
 *          return key($this->list) !== null;
 *      }
 *      
 *      获取值
 *      public function current() {
 *          return current($this->list);
 *      }
 * 
 *      获取键
 *      public function key() {
 *          return key($this->list);
 *      }
 *      
 *      指针下移
 *      public function next() {
 *          next($this->list);
 *      }
 * }
 * 
 * $class = new MyClass();
 * $class->addStu('berry');
 * $class->addStu('tom');       
 * $class->addStu('ketty');
 * 
 * foreach($class as $k = $v) {
 *      echo "{$k} - {$v}<br>";
 * }
 * 
 * 
 * 
 */
