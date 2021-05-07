<?php  

//我们通过 static 关键字来修饰静态属性和方法，这里我们定义了一个静态属性$WHEELS 和静态方法 getWheels，由于静态属性和方法可以直接通过类引用，所以又被称作类属性和类方法（相应的，非静态属性和非静态方法需要实例化后通过对象引用，因此被称作对象属性和对象方法），静态属性和方法可以通过 类名::属性/方法 的方式调用
class Gas
{
	public static $POWER = '汽油';
}

class Car
{
	public static $WHEELS = 4;

	public static function getWheels()
	{
		return self::$WHEELS;
	}

	public static function printCar()
	{
		printf("这辆车有 %d 个轮子，使用 %s 作为动力来源\n",self::$WHEELS,Gas::$POWER);
	}

	public function __toString()
	{
		return self::printCar();
	}

	public static function getClassName()
	{
		return __CLASS__;
	}

	public static function who()
	{
		echo self::getClassName().PHP_EOL;
	}

	public static function whoName()
	{
		echo static::getClassName().PHP_EOL;
	}
}

/**
 * 
 */
class LynkCo01 extends Car
{
	
	public static function getClassName()
	{
		return __CLASS__;
	}
}

echo "WHEELS:".Car::$WHEELS.PHP_EOL;
echo "getWheels:".Car::getWheels().PHP_EOL;


Car::$WHEELS = 8;
echo "getWheels:".Car::getWheels().PHP_EOL;

Car::printCar();

$car = new Car();
$car->__toString();

echo Car::getClassName().PHP_EOL;
echo LynkCo01::getClassName().PHP_EOL;

//为什么第二个打印的结果是父类名 Car 而不是子类名 LynkCo01？这是因为，和 $this 指针始终指向持有它的引用对象不同，self 指向的是定义时持有它的类而不是调用时的，为了解决这个问题，从 PHP 5.3 开始，新增了一个叫做后期静态绑定的特性。
Car::who();
LynkCo01::who();

//后期静态绑定（Late Static Bindings）针对的是静态方法的调用，使用该特性时不再通过 self:: 引用静态方法，而是通过 static::，如果是在定义它的类中调用，则指向当前类，此时和 self 功能一样，如果是在子类或者其他类中调用，则指向调用该方法所在的类
//
//
/**
 * 
 */
class LynkCo02 extends Car
{
	
	public static function getClassName()
	{
		return __CLASS__;
	}
}

LynkCo02::whoName();


?>