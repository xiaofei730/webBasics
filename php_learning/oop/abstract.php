<?php

//抽象类指的是包含抽象方法的类，而抽象方法是通过 abstract 关键字修饰的方法，抽象方法只是一个方法声明，不能有具体实现：
//包含了抽象方法的类必须声明为抽象类。
abstract class Car
{
	protected $brand;

	/**
     * Car constructor.
     * @param $brand
     */
    public function __construct($brand)
    {
        $this->brand = $brand;
    }

	abstract public function drive();
}


/**
 * 抽象类本身不能被实例化，只能被子类继承，继承了抽象类的子类必须实现父类中的抽象方法，否则会报错：
 */
class LynkCo01 extends Car
{
	public function __construct()
    {
        $this->brand = '领克01';
        parent::__construct($this->brand);
    }
	
	public function drive()
	{
		echo "启动领克01汽车" . PHP_EOL;
	}
}

class LynkCo03 extends Car
{
	
	function __construct()
	{
		$this->brand = '领克03';
		parent::__construct($this->brand);
	}

	public function drive()
	{
		echo "提示：手动档需要踩离合器" . PHP_EOL;
        echo "启动{$this->brand}汽车" . PHP_EOL;
	}

}

class TestCar
{
	public function testDrive(Car $car)
	{
		$car->drive();
	}
}

$lynkCo01 = new LynkCo01();
$lynkco03 = new LynkCo03();

$testCar = new TestCar();
$testCar->testDrive($lynkCo01);
echo "============================" . PHP_EOL;
$testCar->testDrive($lynkco03);


 ?>