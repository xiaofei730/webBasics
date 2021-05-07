<?php  

//接口和抽象类一样，也不能被实例化，只能被其他类实现，但是和抽象类不同，接口中不包含任何具体的属性和方法，完全是待实现的「契约」，实现接口的类就相当于和它签了契约，必须要通过实现接口中声明的所有方法来履行契约
interface Car
{
	public function drive();
}

class LynkCo01 implements Car
{
	protected $brand;

	public function __construct($brand)
	{
		$this->brand = $brand;
	}

	public function drive()
	{
		echo "启动{$this->brand}汽车" . PHP_EOL;;
	}
}


//在上述代码中，如果只有接口和具体实现类两级结构，那么所有的实现类都要定义 $brand 属性，这破坏了代码的复用性，我们可以插入一个抽象类 BaseCar 作为中间层，来定义具体实现类的共有属性，然后让抽象类实现接口，把接口方法声明为抽象方法就不需要在这一层实现，再让具体实现类继承抽象类并实现接口方法：
//
interface CarContract
{
	public function drive();

}


abstract class BaseCar implements CarContract
{
	protected $brand;

	public function __construct($brand)
    {
        $this->brand = $brand;
    }

    //将接口方法声明为抽象方法，让子类去实现
    abstract public function drive();
}

/**
 * 
 */
class LynkCo02 extends BaseCar
{
	
	function __construct()
	{
		$this->brand = '领克02';
		parent::__construct($this->brand);
	}

	public function drive()
	{
		echo "启动{$this->brand}汽车" . PHP_EOL;
	}
}


class LynkCo03 extends BaseCar
{
    public function __construct()
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
	public function testDrive(CarContract $car)
	{
		$car->drive();
	}
}

$lynkCo02 = new LynkCo02();
$lynkco03 = new LynkCo03();

$testCar = new TestCar();
$testCar->testDrive($lynkCo02);
echo "============================" . PHP_EOL;
$testCar->testDrive($lynkco03);

//还提供了一个类型运算符 instanceof，用于判断某个对象实例是否实现了某个接口，或者是某个父类/抽象类的子类实例：
//
var_dump($lynkCo02 instanceof CarContract);
var_dump($lynkco03 instanceof BaseCar);

var_dump($testCar instanceof CarContract);
var_dump($testCar instanceof BaseCar);


?>