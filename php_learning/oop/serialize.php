<?php  

class Car
{
	protected $brand;

	private $no;

	public static $WHEELS = 4;

	/**
	 * getter
	 * @return mixed
	 */
	public function getBrand()
	{
		return $this->brand;
	}
	/**
	 * setter
	 * @param mixed $brand 
	 */
	public function setBrand($brand):void
	{
		$this->brand = $brand;
	}

//__sleep() 和 __wakeup() 是一组相对的魔术方法，__sleep() 如果在类中存在的话，会在序列化方法 serialize 执行之前调用，以便在序列化之前对对象进行清理工作，相对的，__wakeup() 如果在类中存在的话，会在反序列化方法 unserialize 执行之前调用，以便准备必要的对象资源
	public function __sleep()
	{
		return ['brand', 'no'];
	}

	public function __wakeup()
	{
		$this->no = 10001;
	}

	
}

$car = new Car();
$car->setBrand('领克01');

//对象序列化是一种持久化对象的方式，并且序列化对象只会保留对象属性。
$string = serialize($car);
file_put_contents("car", $string);

$content = file_get_contents("car");
$object = unserialize($content);
echo "汽车品牌：".$object->getBrand().PHP_EOL;


// echo "汽车No.：".$object->getNo().PHP_EOL;
// 



?>