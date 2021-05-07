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

?>