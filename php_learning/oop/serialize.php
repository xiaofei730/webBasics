<?php  

/**
 * 序列化与反序列化
 * 在PHP中，数组和对象无法保存，如果需要保存就要将数组或对象转换成一个序列
 * 序列化：将数组或对象转换成一个序列（serialize）
 * 反序列化：将序列化的字符串转换成数组或对象。（unserialize）
 * 
 * 数组序列化
 * $stu = ['tom', 'berry', 'ketty'];
 * $str = serialize($stu);
 * file_put_contents('./stu.text', $str);
 * 
 * 
 * 数组反序列化
 * $str = file_get_contents('./stu.text');
 * $stu = unserialize($str);
 * print_r($stu);
 * 
 * 
 * 对象的序列化和反序列化
 * 注意：对象的反序列化需要有类的参与，如果没有类在反序列时候无法确定类
 * 
 * class Stundent{
 * 		public $name;
 * 		protected $sex;
 * 		private $add;
 * 
 * 		public function __construct($name, $sex, $add) {
 * 			$this->name = $name;
 * 			$this->sex = $sex;
 * 			$this->add = $add;
 * 		}
 * 
 * }
 * 
 * $stu = new Student('tom', '男', '北京');
 * 
 * $str = serialize($stu);
 * 
 * file_put_contents('./stu2.text', $str);
 * 
 * $str = file_get_contents('./stu2.text');
 * $stu = unserialize($str);
 * var_dump($stu);
 * 
 * 
 * 
 */


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