<?php
/**
 * 
 * 命名空间
 * 
 * 1、介绍
 * 在一个大的项目中，可能会遇到同名的类、函数、常量，为了区分这些元素，我们可以将这些元素分别存放在不同的命名空间中
 * （1）命名空间就是包，用来存放项目中的类、函数、常量
 * （2）通过namespace关键字来声明命名空间
 * 
 * 2、声明命名空间
 * namespace China;
 * 
 * function getInfo() {
 *      echo '我是中国人<br>';
 * }
 * namespace USA;
 * 
 * function getInfo() {
 *      echo 'I am America<br>';
 * }
 * 
 * getInfo();
 * \USA\getInfo();
 * \China\getInfo();
 * 
 * 注意：\表示公共空间
 * 
 * 3、多级命名空间
 * 命名空间的名字可以是多级的（子级命名空间）
 * 
 * namespace China\Beijing\shunyi;
 * 
 * class Student{
 * }
 * 
 * namespace USA\Washington;
 * class Student{
 * }
 *   
 * $stu1 = new Stundent();      //相对路径
 * $stu2 = new \USA\Washington\Student();       //绝对路径
 * $stu3 = new \China\Beijing\shunyi\Student();       //绝对路径
 * 
 * 总结：如果将相对路径转成绝对路径
 * 公共空间+命名空间+空间元素
 * 公共空间         命名空间                空间元素
 *    \            China\Beijing\shunyi\     Student()
 * 
 * 4、访问空间元素的三种方式
 * （1）非限定名称访问
 * （2）完全限定名称访问
 * （3）限定名称访问
 * 
 * namespace China\Beijing\Shunyi;
 * function getInfo() {
 *  echo '顺义....<br>';
 * }
 * 
 * 
 * namespace China\Beijing {
 *  echo '北京....<br>';
 * }
 * getInfo();       非限定名称访问
 * \China\Beijing\getInfo();       完全限定名称访问
 *  Shunyi\getInfo();               限定名称访问
 * 
 * 
 * 5、命名空间引入
 * 完全限定名称访问元素路径太长，可以将其他空间引入当前空间
 * 通过use引入命名空间
 * 
 * namespace China\Beijing\Shunyi;
 * function getInfo() {
 *  echo '李白....<br>';
 * }
 * 
 * namespace USA;
 * 
 * function getInfo() {
 *      echo '林肯<br>';
 * }
 * 
 * 
 * \China\Beijing\Shunyi\getInfo();
 * 
 * use China\Beijing\Shunyi;  
 * 
 * getInfo();   林肯
 * Shunyi\getInfo(); 李白....
 * 
 * 
 * 引入命名空间的拼接规则
 * 公共空间 + 引入空间 + （去除公共部分，公共部分只能有一级）空间元素
 * 
 * 比如：以下代码是错误的
 * namespace A\B\C;
 * function getInfo();
 * 
 * namespace D\E;
 * 
 * use A\B\C
 * C\getInfo();         正确        \A\B\C\getInfo(); 
 * B\C\getInfo();       错误         \A\B\C\B\C\getInfo();
 * 
 * 
 * 
 * 6、引入空间元素
 * 引入类：use
 * 引入函数：use function  [PHP7.0以后]
 * 引入常量：use const      [PHP7.0以后]
 * 
 * namespace China\Beijing\Shunyi;   
 * 
 * class Student {
 * }
 * 
 * function getInfo() {
 *  echo '李白....<br>';
 * }
 * 
 * const TYPE = '学生';   
 *   
 * namespace USA;
 * 
 * use China\Beijing\Shunyi\Student;
 * use function China\Beijing\Shunyi\getInfo;
 * use const China\Beijing\Shunyi\TYPE;
 * 
 * $stu = new Student;
 * getInfo();
 * 
 * echo TYPE;
 * 
 * 
 * 7、给类、函数取别名
 * 如果引入的类和函数与当前空间的类和函数名称相同，需要给引入的类和函数取别名
 * 通过as取别名
 * 
 * 
 * 
 * namespace China\Beijing\Shunyi; 
 * class Student {}
 * function getInfo() {
 *  echo '李白....<br>';
 * }
 * 
 * 
 * namespace USA\Washington;
 * function getInfo() {
 *      echo '林肯<br>';
 * }
 * 
 * class Student {}
 * 
 * use China\Beijing\Shunyi\Student as ChinaStudent;
 * use function China\Beijing\Shunyi\getInfo as info1;
 * 
 * $stu = new ChinaStudent;
 * 
 * getInfo();
 * info1();
 * 
 * 
 * 8、公共空间
 * 如果一个页面没有namespace声明空间，这个页面的元素在公共空间下
 * 公共空间用\表示
 * 
 * function getInfo() {
 *  echo '李白....<br>';
 * }
 * 
 * \getInfo();
 * 
 * 
 * 9、命名空间注意事项
 * （1）命名空间只能存放类、函数、const常量
 * （2）第一个namespace前面不能有任何的代码，空白字符，header()也不行
 * （3）包含文件不影响当前的命名空间 
 * 
 * define常量和const常量
 * const常量可以当作类成员和在命名空间存放
 * 
 * 
 */