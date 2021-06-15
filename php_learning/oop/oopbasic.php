<?php
/**
 * 
 * 面向对象
 * 
 * 
 * 1、介绍
 * 面向对象是一个编程思想。编程思想有面向过程和面向对象
 * 面向过程：编程思路集中的是过程上
 * 面向对象：编程思路集中在参与的对象
 * 
 * OOP:面向对象编程
 * OOA：面向对象分析
 * OOD：面向对象设计
 * 
 * 3、类和对象
 * （1）对象是具体存在的事务，对象是由属性（变量）和方法（函数）组成的
 * 
 * （2）类是具有相同属性和行为的一组对象的集合
 * 
 * 
 * 
 * 4、在PHP中实现类和对象
 * （1）创建类
 * class 类名 { 属性  方法  常量  }
 * 
 * 类名的命名规则：
 * 1、以字母、下划线开头，后面跟的是字母、数字、下划线
 * 2、不能用PHP关键字做类名
 * 3、类名不区分大小写（变量名区分，关键字、类名不区分大小写）
 * 4、类名用帕斯卡命名方法（大驼峰 单词的首字母大写）
 * 
 * <?php
 * class Student {}
 * 
 * (2)对象实例化
 * $stu1 = new Student();
 * $stu2 = new Student;
 * 
 * (3)对象比较
 * 注意：对象的传递是地址传递
 * 
 * 相等：结构和保存的值一样就相等
 * 全等：指向同一个对象才是全等
 * $stu3 = $stu2;
 * 
 * $stu1 == $stu2;   bool(true)
 * 
 * $stu1 === $stu2;     bool(false)
 * 
 * $stu2 === $stu3;     boll(true)
 * 
 * 5、属性
 * 属性本质就是变量
 * 通过->调用对象的成员 对象名->属性名，对象名->方法名();
 * 
 * class Student {
 *  public $name;
 *  public $add = '地址不详';
 * 
 * }
 * 
 * $stu4 = new Student();
 * 操作属性
 * (1)给属性赋值
 * $stu4->name = 'tom';
 * $stu4->add = '北京';
 * 
 * （2）获取属性的值
 * echo '姓名'.$stu4->name,'<br>'
 * echo '地址'.$stu4->add,'<br>'
 * 
 * （3）添加属性
 * $stu4->age = 20;
 * 
 * 
 * （4）删除属性
 * unset($stu4->add);
 * 
 * 6、方法
 * class Student {
 *  public function show() {
 *      echo '这是show方法<br>';
 *  }
 * 
 *  function test() {
 *      echo '这是测试方法';
 *  }
 * }
 * 
 * $stu5 = new Student();
 * $stu5->show();
 * $stu5->test();
 * 
 * （1）方法前面的public是可以省略的，如果省略，默认就是public
 * （2）属性前面的public不能省略
 * 
 * 7、访问修饰符
 * 用来控制成员的访问权限
 * public（公有的）         在类的内部和外部都能访问
 * private（私有的）        只能在类的内部访问
 * protected（受保护的）
 * 
 * class Student {
 *  private $name;
 *  private $sex;
 * 
 * 通过公有的方法对私有属性进行赋值和取值
 *  public function setInfo($name, $sex) {
 *      $this->name = $name;    //$this代表当前对象
 *      $this->sex = $sex;
 *  }
 * 
 *  public function getInfo() {
 *      echo '姓名：'.$this->name,'<br>';
 *      echo '性别：'.$this->sex,'<br>';
 * }
 * 
 * }
 * 
 * $stu6 = new Student;
 * $stu6->setInfo('tom','男');
 * 
 * 
 * 
 * 一般来说，属性都用私有的，通过公有的方法对私有属性进行赋值和取值
 * 作用：保证数据的合法性
 * 
 * 
 * 提示：$this表示调用当前方法的对象
 * 
 * 8、类和对象在内存中的分布
 * （1）对象的本质是一个复杂的变量
 * （2）类的本质是一个自定义的复杂数据类型
 * （3）栈区：运行速度快，体积小，保存基本数据类型
 * （4）堆区：运行速度稍慢，体积大，保存复杂数据类型
 * （5）实例化的过程就是分配内存空间的过程
 * （6）对象保存在堆区，将堆区的地址保存到栈区
 * 
 * 内存：
 * （1）堆区：  对象保存在堆区
 * new Student(0x11111)
 * $name  $sex
 * 
 * （2）栈区：  将堆区的地址保存到栈区
 * $stu7 0x11111
 * 
 * 
 * （3）静态区和常量区：
 * （4）代码区：
 * class Student {
 *      public $name;
 *      public $sex;
 *      public function show() {
 * 
 *      }
 * }
 * 
 * $stu7 = new Student;
 * 
 * $stu7->show()会直接去代码区调用方法
 * 
 * 9、封装
 * 封装就是有选择性的提供数据
 * 
 * 通过访问修饰符来实现封装
 * 
 * 10、构造方法
 * 构造方法也叫构造函数，当实例化对象的适合自动执行
 * 
 * 语法：
 * function __construct(){
 * }
 * 
 * 构造函数的作用：初始化成员变量
 * 构造函数可以带有参数，但不能有return
 * 
 * 11、析构函数
 * 当对象销毁的时候自动调用
 * 语法：
 * function __destruct() {
 * }
 * 
 * class Student {
 *      private $name;
 *      public function __construct($name) {
 *          $this->name = $name;
 *          echo "{$name}出生了<br>";
 *      }
 * 
 *      public function __destruct(){
 *          echo "$this->name销毁了";
 *      }
 * }
 * 
 * $stu = new Student('tom');
 * $stu2 = new Student('berry');
 * $stu3 = new Student('kitty');
 * 
 * 计算机的内存管理
 * 计算机内存管理方式：先进先出，先进后出
 * 先进先出的内存管理方式一般在业务逻辑中，比如秒杀、购票等等
 * (1)调用unset会先销毁
 * unset(stu2);
 * 
 * （2）没有变量引用就是垃圾，会被直接销毁
 * new Student('tom');
 * new Student('berry');
 * new Student('kitty');
 * 
 * （3）变量重新赋值，原先的对象会被销毁
 * $stu = new Student('tom');
 * $stu = new Student('berry');
 * $stu = new Student('kitty');
 * 
 * 
 * 
 * 先进后出是计算机的默认内存管理方式
 * 
 * 12、继承
 * （1）继承使得代码具有层次结构
 * 
 * （2）子类继承了父类的属性和方法，实现了代码的可重用性
 * 
 * （3）使用extend关键字实现继承
 * 
 * （4）父类和子类是相对的
 * 
 * 语法：
 * 
 * class 子类 extends 父类{
 * }
 * 
 * 继承中的构造函数
 * 规则：
 * （1）如果子类有构造函数就调用子类的，如果子类没有就调用父类的构造函数
 * （2）子类的构造函数调用后，默认不再调用父类的构造函数
 * 
 * 通过类名调用父类的构造函数
 * 类名::__construct()
 * 
 * 注意：Parent关键字表示父类的名字，可以降低程序的耦合性
 * 
 * 
 * $this详解
 * $this表示当前对象的引用，也就是$this保存的当前对象的地址
 * 
 * PHP不允许多重继承，因为多重继承容易产生二义性ß
 * 
 * 
 * 
 */


/**
 * 
 * 多态
 * 1、多态：多种形态
 * 多态分为两种：方法重写和方法重载
 * 
 * （1）方法重写
 * 子类重写了父类同名的方法
 * class Person{
 *      public function show(){
 *          echo '这是父类<br>';
 *      }
 * }
 * 
 * class Student extends Person{
 *      public function show(){
 *          echo '这是子类<br>';
 *      }
 * }
 * （2）方法重载
 * 在同一个类中，有多个同名的函数，通过参数不同来区分不同的方法，称为方法重载
 * class Student {
 *      public function show() {}
 *      public function show($name) {}
 *      public function show($name,$num2) {}
 * }
 * PHP不支持方法重载，但是PHP可以通过其他方法来模拟方法重载
 * 
 * 2、私有属性继承和重写
 * 私有属性可以继承但不能重写
 * 子类和父类有相同的私有属性，子类可以继承父类的私有属性，此时子类会存在两个相同的属性
 * 
 * 
 * 3、方法的修饰符
 * 方法的修饰符有：static、final、abstract
 * （1）static   静态的
 * static修饰的属性叫静态属性，static修饰的方法叫静态方法
 * 静态成员加载类的时候分配空间，程序执行完毕后销毁
 * 静态成员在内存中就一份
 * 调用语法  类名::属性     类名::方法名（）
 * class Person{
 *      public static $add = '北京';
 *      public static function show() {
 *          self::$add;      //表示当前类名
 *      }
 * }
 * Person::$add;
 * Person::show();
 * 
 * 静态成员可以继承
 * 
 * 
 * 静态延时绑定
 * static表示当前对象所属的类
 * 
 * class Person{
 *      public static $type = '人类';
 *      public function show1() {
 *          var_dump($this);        //object(Student)
 *          echo self::$type,'<br>';        //人类  
 *          echo static ::$type,'<br>';      //学生  延时绑定
 *      }
 * 
 * }
 * class Student extends Person{
 *      public static $type = '学生';
 *      public function show2() {
 *          var_dump($this);         //object(Student)
 *          echo self::$type,'<br>';        //学生
 *          echo static ::$type,'<br>';     //学生
 *      }
 * 
 * }
 * $obj = new Student();
 * $obj->show1();
 * $obj->show2();
 * 
 * 小结：
 * static在内存中就一份，在类加载的时候分配空间
 * 如果有多个修饰符，修饰符之间是没有顺序的
 * self表示所在类的别名
 * static表示当前对象所属的类
 * 
 * 
 * 
 * （2）final   最终的
 * final修饰的方法不能被重写
 * final修饰的类不能被继承
 * 
 * 作用：
 * 1、如果一个类确定不被继承，一个方法确定不会被重写，用final修饰可以提高执行效率
 * 2、如果一个方法不允许被其他类重写，可以用final修饰
 * 
 * 
 * （3）abstract 【抽象的】
 * 1、abstract修饰的方法是抽象方法，修饰的类是抽象类
 * 2、只有方法的声明没有方法的实现称为抽象方法
 * 3、一个类中至于有一个方法是抽象方法，这个类必须是抽象类
 * 4、抽象类的特点是不能被实例化
 * 5、子类继承类抽象类，就必须重新实现父类的所有的抽象方法，否则不允许实例化
 * 6、类中没有抽象方法也可以声明成抽象类，用来阻止类的实例化
 * 
 * abstract class Person {
 *      public abstract function setInfo();
 *      public function getInfo() {
 *          echo '获取信息','<br>';
 *      }
 * }
 * 
 * class Student extends Person {
 *      public function setInfo() {
 *          echo '重新实现父类的抽象方法<br>';
 *      }
 * }
 * 
 * $stu = new Student;
 * $stu->setInfo();
 * 
 * 抽象类的作用：
 * 1、定义命名规范
 * 
 * 2、阻止实例化，如果一个类中所有的方法都是静态方法，这时候没有必要区实例化，可以通过abstract来阻止实例化
 * 
 * 
 */


/**
 * 类常量
 * 1、类常量是const常量
 * class Student {
 *  const ADD = '地址不详';
 * }
 * 
 * echo Student::ADD;
 * 
 * 问题：define常量和const常量的区别？
 * 答：const常量可以做类成员，define常量不可以做类成员
 * 
 * 问题：常量和静态属性的区别？
 * 答：相同点：都在加载类的时候分配空间
 *    不相同点：常量的值不可以更改，静态属性的值可以更改 
 * 
 * 
 */


/**
 * 接口（interface）
 * 
 * 1、接口
 * （1）如果一个类中所有的方法都是抽象方法，那么这个抽象类可以声明成接口
 * （2）接口是一个特殊的抽象类，接口中只能有抽象方法和常量
 * （3）接口中的抽象方法只能是public，可以省略，默认也是public的
 * （4）通过implements关键字来实现接口
 * （5）不能使用abstract和final来修饰接口中的抽象方法
 * 
 * 声明接口
 * interface IPerson {
 *  function func1();
 *  function func2();
 * }
 * 
 * class Student implements IPerson {
 *  public function fun1() {
 * 
 *  }
 *  public function fun2() {
 * 
 *  }
 * }
 * 
 * 
 * 2、接口的多重实现
 * 类不允许多重继承，但是接口允许多重实现
 * 
 * interface IPic1{
 *  function fun1();
 * }
 * interface IPic2{
 *  function fun2();
 * }
 * 
 * //接口允许多重实现
 * class Student implements IPic1,IPic2 {
 *  public function fun1() {
 * 
 *  }
 *  public function fun2() {
 * 
 *  }
 * }
 * 
 * 注意：在接口的多重实现中，如果有同名的方法，只要实现一次即可
 * 
 */


/**
 * 匿名类
 * <?php 
 * $stu = new class {
 *  public $name = 'tom';
 *  public function __construct() {
 *      echo '构造函数<br>';
 *  }
 * 
 * }
 * echo $stu->name;
 * 
 * 好处：
 * （1）如果类只被实例化一次就可以使用匿名类
 * （2）好处，实例化完毕后就回收类类的空间
 * 
 * 
 */


/**
 * 方法绑定（PHP7.0支持）
 * 
 * 将方法绑定到对象上
 * 语法：
 * 闭包->call(对象)
 * 
 * 
 * $lang = 'en';
 * class Student {
 * 
 * }
 * 
 * if($lang == 'ch') {
 *  $fun = function() {
 *      echo '我是一名学生';
 *  }
 * } else {
 *  $fun = function() {
 *      echo 'i am a student';
 *  }
 * }
 * $stu = new Student;
 * 
 * $fun->call($stu);
 * 
 * 
 * 
 */

/**
 * 
 * 异常处理
 * 集中处理在代码块中发生的异常。
 * 在代码块中发生了异常直接抛出，代码块中不处理异常，将异常集中起来一起处理
 * 
 * 1、使用的关键字
 * try:监测代码块
 * catch:捕获异常
 * throw:抛出异常
 * finally:无论有无异常都会执行，可以省略
 * Exception:异常类
 * 
 * 语法结构
 * try {
 * 
 * }catch(Exception $ex) {
 * 
 * } finally{
 * 
 * }
 * 
 * 
 * 2、自定义异常
 * 场景：如何实现异常的分类处理？比如 异常有三个级别异常对应三种处理方式
 * 自定义三种异常即可
 * 所有异常类的父类是Exception,Exception中的方法不允许重写
 * 
 * 
 */

































