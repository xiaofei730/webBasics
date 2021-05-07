<?php  

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