<?php  

/**
 * 魔术方法
 * 已经学习的魔术方法
 * __construct()
 * __destruct()
 * __clone()
 * 
 * __tostring():
 * 
 * 
 * class Student {
 * 		//把对象当成字符串使用的时候自动执行
 * 		public function __tostring() {
 * 			return '这是一个对象，不是字符串<br>';
 * 		}
 * 		//把对象当成函数使用的时候自动执行
 * 		public function __invoke() {
 * 			echo '这是一个对象，不是函数<br>';
 * 		}
 * 
 * }
 * 
 * $stu = new Student();
 * 
 * echo $stu;  将对象当成字符串使用
 * $stu();		把对象当成函数使用
 * 
 * __set($key, $value): 给无法访问的属性赋值的时候自动执行
 * __get($key):获取无法访问的属性值的时候自动调用
 * __isset($key):判断无法访问的属性是否存在
 * __unset($key)：销毁无法访问的属性的时候自动执行
 * 
 * class Student {
 * 		private $name;		//读写属性
 * 		private $add = '中国';		//只读属性
 * 		private $age;		//只写属性
 * 
 * 		public function __set($key, $value) {
 * 			if(in_array($key, array('name', 'age')))
 * 				$this->$key = $value;
 *			else 
 * 				echo "{$key}属性是只读属性<br>";
 * 
 * 		}
 * 
 * 		public function __get($key) {
 * 			if(in_array($key, array('name', 'add')))
 * 				return $this->$key;
 * 			else
 * 				echo "{$key}属性是只写属性<br>";
 * 
 * 		}
 * 
 * 		public function __isset($key) {
 * 			return isset($this->$key)
 * 		}
 * 
 * 		public function __unset($key) {
 * 			unset($this->$key);
 * 		}
 * 
 * }
 * 
 * $stu = new Student();
 * $stu->name = 'tom';
 * $stu->set = '男';
 * $stu->age = 22;
 * 
 * print_r($stu);
 * echo $sut->name;
 * 
 * var_dump(isset($stu->name));
 * unset($stu->age);
 * 
 * 
 * 
 * 
 * __call：调用无法访问的方法时自动执行
 * 
 * __callStatic：调用无法访问的静态方法时自动执行
 * 
 * class Student {
 * 		public function __call($fn_name, $fn_args) {
 * 			echo "{$fn_name}不存在<br>";
 * 		}
 * 
 * 		public function __callStatic($fn_name, $fn_args) {
 * 			echo "{$fn_name}静态方法不存在<br>";
 * 		}
 * 
 * }
 * 
 * $stu = new Stundent();
 * 
 * $stu->show(10, 20);
 * 
 * Student::show();
 * 
 * __sleep():当序列化的时候自动调用
 * __wakeup():当反序列化的时候自动调用
 * 
 * class Stident{
 * 		private $name;
 * 		private $sex;
 * 		private $add = '中国';
 * 		public function __construct($name, $sex) {
 * 			$this->name = $name;
 * 			$this->sex = $sex;
 * 		}
 * 		//返回数组，序列化的字段名
 * 		public function __sleep() {
 * 			return array('name', 'sex');
 * 		}
 * 		
 * 		public function __wakeup() {
 * 			$this->type = '学生';
 * 		}
 * 
 * }
 * //测试
 * $stu = new Student('tom', '男');
 * $str = serialize($stu);
 * echo $str;
 * $stu2 = unserialize($str);
 * print_r($stu2);
 * 
 * 
 */


/**
 * 模拟方法重载
 * 
 * class Math {
 * 		public function __call($fn_name, $fn_args) {
 * 			$sum = 0;
 * 			foreach($fn_args as $v) {
 * 				$sum += $v;
 * 			}
 * 
 * 			echo implode(',', $fn_args).'的和是：'.$sum,'<br>';
 * 		}
 * 
 * }
 * 
 * $math = new Math();
 * 
 * $math->call(10, 20);
 * $math->call(10, 20, 30);
 * $math->call(10, 20, 30, 40);
 * 
 * 
 */


/**
 * 
 * 遍历对象
 * 通过foreach遍历对象
 * 
 * class Student {
 * 		public $name = 'tom';
 * 		protected $sex = '男';
 * 		private $age = 22;
 * 
 * 		public function show() {
 * 			foreach($this as $k=>$v) {
 * 				echo "{$k}-{$v}<br>";
 * 			}
 * 		}
 * }
 * 
 * $stu = new Student();
 * 
 * foreach($stu as $k=>$v) {
 * 	echo "{$k}-{$v}<br>";
 * }
 * 
 * echo '<hr>';
 * $stu->show();
 * 
 * 结论：遍历当前位置所能访问的属性
 * 
 */



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