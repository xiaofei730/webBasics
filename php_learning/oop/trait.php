<?php  

/**
 * 
 * trait (原型)
 * 
 * trait为类减少单继承语言的限制，可以在不同层次结构独立的类中复用类的方法集
 * 
 * 原型
 * trait A {
 * 
 * 		public function getInfo1() {
 * 			echo '锄禾日当午<br>';
 * 		}
 * 
 * }
 * trait B {
 * 
 * 		public function getInfo2() {
 * 			echo '床前明月光<br>';
 * 		}
 * 
 * }
 * 
 * 使用原型
 * class Student {
 * 		use A,B;		代码复用，引入多个trait
 * }
 * 
 * 
 * $stu = new Student;
 * $stu->getInfo();
 * 
 * 
 * trait A {
 * 
 * 		public function getInfo() {
 * 			echo '这是原型<br>';
 * 		}
 * }
 * 
 * class Person {
 * 		
 * 	public function getInfo() {
 * 		echo '这是person类<br>';
 * 	}
 * 
 * }
 * 
 * class Student extends Person {
 * 		use A; 		//继承类getInfo，又被A中的getInfo覆盖
 * }
 * 
 * $stu = new Student;
 * $stu->getInfo();
 * 
 * 命名冲突解决，使用别名,替换
 * trait A {
 * 
 * 		public function getInfo() {
 * 			echo '锄禾日当午<br>';
 * 		}
 * 
 * }
 * trait B {
 * 
 * 		public function getInfo() {
 * 			echo '床前明月光<br>';
 * 		}
 * 
 * }
 * class Student {
 * 		use A,B {
 * 			方法替换
 * 			A::getInfo insteadof B;			将A中的getInfo替换B中的getInfo
 * 			B::getInfo insteadof A;			将B中的getInfo替换A中的getInfo
 * 			改名
 * 			A::getInfo insteadof B;
 * 			B::getInfo as show;
 * 		}
 * }
 * 
 * $stu = new Student();
 * 
 * $stu->getInfo();
 * $stu->show();
 * 
 * 
 * 更改权限
 * trait A {
 * 
 * 		private function show() {
 * 			echo '锄禾日当午<br>';
 * 		}
 * 
 * }
 * 
 * class Student {
 * 		use A{
 * 
 * 			show as public;   将private方法权限设为public
 * 			show as public show2; 将show方法改为public并改名为show2；
 * 		}
 * 
 * }
 * 
 * $stu = new Student;
 * $stu->show();
 * 
 * 
 * 多学一招
 * （1）多个trait可以组成一个trait
 * （2）trait可以定义抽象成员
 * （3）trait可以定义静态成员
 * （4）trait可以定义属性
 * 
 * 
 * 
 * 
 * 
 */






//Trait 和类相似，支持定义方法和属性，但不是类，不支持定义构造函数，因而不能实例化，只能被其他类使用，要在一个类中使用 Trait，可以通过 use 关键字引入，然后就可以在类方法中直接使用 trait 中定义的方法了
//
//Trait 和类一样，支持属性和方法以及可见性设置（private、protected、public），并且即使是 private 级别的方法和属性，依然可以在使用类中调用：
//
//所以不同于类继承，这完全是把 Trait 的所有代码组合到使用类，变成了使用类的一部分。从另一个角度来印证，就是 Trait 中定义的属性不能再使用类中重复定义
trait Power
{

	protected $power;

	protected function gas()
	{
		$this->power = '汽油';
	}

	protected function battery()
	{
		$this->power = '电池';
	}

	private function water()
	{
		$this->power = '水';
	}
//如果引入多个 Trait 中包含同名方法会发生什么呢
	public function print()
	{
		echo "动力来源：" . $this->power . PHP_EOL;
	}
}

trait Engine
{
	protected $engine;

	protected function three()
	{
		$this->engine = 3;
	}

	protected function four()
	{
		$this->engine = 4;
	}

//如果引入多个 Trait 中包含同名方法会发生什么呢
	protected function print()
	{
		echo "发动机个数：".$this->engine.PHP_EOL;
	}
}

///同名方法重写的优先级依次是：使用 Trait 的类 > Trait > 父类
abstract class BaseCar
{
	abstract public function drive();
	protected function gas()
	{
		echo "动力来源：柴油".PHP_EOL;
	}

	abstract function battery();
}

class Car extends BaseCar
{

//指定使用多个 Trait 同名方法中的哪一个来替代其他的，这样会导致其他未选择方法被覆盖：
//如果你仍然想调用其他 Trait 中的同名方法，PHP 还提供了别名方案，我们可以通过 as 关键字为同名方法设置不同别名，再通过别名来调用对应方法，不过这种方式还是要先通过 insteadof 解决方法名冲突问题：
	use Power, Engine {
		Engine::print insteadof Power;
		Power::print as printPower;
	}

	// protected $power;

	public function drive()
	{
		$this->gas();
		$this->four();
		$this->print();
		$this->printPower();
		// echo "动力来源：".$this->power.PHP_EOL;
		// echo "发动机：".$this->four().PHP_EOL;
		echo "汽车启动...".PHP_EOL;
	}

	// protected function gas()
	// {
	// 	$this->power = '柴油';
	// }
}

//Trait 除了可以被类使用来扩展类功能，还可以组合多个 Trait 构建更复杂的 Trait 实现更强大的功能
trait Component
{
	use Power, Engine {
		Engine::print insteadof Power;
		Power::print as printPower;
		Engine::print as printEngine;
	}

	public function init()
	{
		$this->gas();
		$this->four();
	}
}

class CarTwo
{
	use Component;

	public function drive()
	{
		$this->init();
		$this->printPower();
		$this->printEngine();
		echo "汽车启动..." . PHP_EOL;
	}
}

$car = new Car();
$car->drive();


$carTwo = new CarTwo();
$carTwo->drive();


?>