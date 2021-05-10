<?php

# 初始化成绩等级	
define("A", "优秀");
define("B", "良好");
define("C", "合格");
define("D", "不合格");

#初始化科目编码
define("YUWEN", '1');
define("SHUXUE", '2');
define("JISUANJI", '3');

$data = [
	'1' => [
		YUWEN => 88,
		SHUXUE => 99,
		JISUANJI => 96
	],
	'2' => [
		YUWEN => 77,
		SHUXUE => 58,
		JISUANJI => 63
	],
	'3' => [
		YUWEN => 93,
		SHUXUE => 85,
		JISUANJI => 72
	],

];

$studentId = '1';
print_r($studentId);
$score = $data[$studentId][YUWEN];
if ($score >= 80 && $score < 90) {
	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,A);
}

$studentId = '2';
$score = $data[$studentId][YUWEN];
if ($score >= 80 && $score < 90) {
	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,A);
}else{
	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,"其他等级");
}

$studentId = '2';
$score = $data[$studentId][YUWEN];

//elseif之间没有空格
// if ($score >= 90) {
// 	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,A);
// }elseif ($score >= 80 && $score < 90) {
// 	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,B);
// }elseif ($score >= 60 && $score < 80) {
// 	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,C);
// }elseif ($score < 60) {
// 	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,D);
// }else {
// 	printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,"其他等级");
// }

switch ($score) {
	case $score >= 90:
		$level = A;
		break;
	case $score >= 80 && $score <  90:
		$level = B;
		break;
	case $score >= 60 && $score <  80:
		$level = C;
		break;
	case $score < 60:
		$level = D;
		break;
	default:
		$level = "其他等级";
		break;
}

printf("学生 %d 的语文分数：%0.1f，对应等级是：%s\n",$studentId,$score,$level);

/**
 * 1、for 、 while、 do-while可以相互替换
 * 2、如果明确知道循环多少次首先for循环，如果循环到条件不成立为止选while或do-while
 * 3、先判断在执行选while，先执行再判断do-while；
 */

$total = count($data);
$i = 1;
while ($i <= $total) {
	echo  "第 $i 个学生的成绩信息：\n";
	print_r($data[$i]);
	$i++;
}

do {

	echo "第 $i 个学生的成绩信息：\n";
	print_r($data[$i]);
	$i++;
}while($i < $total);

for ($i=1; $i <= $total ; $i++) {  
	echo "第 $i 个学生的成绩信息：\n";
	print_r($data[$i]);
}


/**
 * 1、语法一
 * foreach(数组 as 值){}
 * 2、语法二
 * foreach(数组 as 键=>值){}
 */

foreach ($data as $stId => $score) {
	echo "第 {$stId} 个学生的成绩信息：\n";
	print_r($score);
}

foreach ($data as $stId => $score) {
    echo "第 {$stId} 个学生的成绩信息：\n";
    print_r($score);
    if ($stId == 2) {
        break;
    }
}


foreach ($data as $stId => $score) {
	if ($stId == 1) {
		continue;
	}
	echo "第 {$stId} 个学生的成绩信息：\n";

	print_r($score);
	if ($stId == 2) {
		break;
	}

}

#作业九九乘法口诀表
for ($i=1; $i < 10 ; $i++) { 
	for ($j=1; $j <= $i; $j++) {
		$product = $i * $j;
		echo "$j x $i = $product ";
		if ($j == $i) {
			echo "\n";
		}
	}
}

/**
 * 替代语法
 * PHP中出了do-while以外，其他的语法结构都有替代语法
 * 规则：左大括号变冒号，右大括号变endXXX
 */
//if的替代语法
// if():
// endif

// if():
// elseif():
// else:
// endif

//switch替代语法
// switch():
// endswitch;

// for替代语法
// for():
// endfor;

//while替代语法
// while():
// endwhile; 

//foreach替代语法
//foreach():
//endforeach;

//在混编的时候使用替代语法

?>