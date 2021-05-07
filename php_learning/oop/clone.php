<?php  

$engine = new stdClass();
$engine->num = 4;

//stdClass（有点类似 Java 中的 Object 类，是一个预置的空实现类，可以在上面设置任意属性）
$carA - new stdClass();
$carA->brand = '奔驰';
$carA->power = '汽油';
$carA->engine = $engine;

$carB = $carA;
$carB->brand = '宝马';
var_dump($carA);
var_dump($carB);

// 可以看到，对 $carB 属性值的修改会污染 $carA 的属性值，
// 
$carC = clone $carA;
$carC->brand = '奥迪';
$carC->power = '电池';
var_dump($carC);


$carC->engine->num = 3;
var_dump($carA);
var_dump($carC);

class Engine
{
	public $num = 4;
}

class Car
{
	public $brand;
	public $power;
	/**
	 * 
	 * @var [Engine]
	 */
	public $engine;

	public function __clone()
	{
		$this->engine = clone $this->engine;
	}
}

$bnez = new Car();
$bnez->brand = '奔驰';
$benz->power = '汽油';
$engine = new Engine();
$benz->engine = $engine;

$lnykco02 = clone $benz;
$lnykco02->brand = '领克02';
$lnykco02->power = '电池';
$lnykco02->engine->num = 3;

var_dump($benz);
var_dump($lnykco02);

?>