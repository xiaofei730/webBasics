<?php  

class Car
{

	protected $data = [];
	protected $brand;

	//当在指定对象上调用一个不存在的成员方法时，如果该对象包含 __call 魔术方法，则尝试调用该方法作为兜底，与之类似的，当在指定类上调用一个不存在的静态方法，如果该类包含 __callStatic 方法，则尝试调用该方法作为兜底。
	
	public function __call($name, $argument)
	{
		echo "调用的成员方法不存在".PHP_EOL;
	}

	public static function __callStatic($name, $argument)
	{
		echo "调用的静态方法不存在".PHP_EOL;
	}


	//__set() 方法会在给不可访问属性赋值时调用；__get() 方法会在读取不可访问属性值时调用；当对不可访问属性调用 isset() 或 empty() 时，__isset() 会被调用；当对不可访问属性调用 unset() 时，__unset() 会被调用。

	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}

	public function __get($name)
	{
		return $this->data[$name];
	}

	//__invoke 魔术方法会在以函数方式调用对象时执行
	public function __invoke($brand)
	{
		$this->brand = $brand;
		echo "蓝天白云，定会如期而至 -- ".$this->brand.PHP_EOL;
	}

}

(new Car())->drive();
Car::drive();

$car = new Car();
$car->brand = '奔驰';
var_dump($car->brand);


$car->wheels = 4;
var_dump($car->wheels);
$car('宝马');


?>