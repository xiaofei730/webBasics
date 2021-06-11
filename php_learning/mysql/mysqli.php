<?php 

/**
 * 连接数据库
 * 1、开启mysqli扩展
 * 在php.ini中开启mysqli扩展
 * extension=php_mysqli.dll
 * 开启扩展后重启服务器，就可以使用mysqli函数
 * 
 * 2
 * 
 */


$host = '127.0.0.1';  // MySQL 服务器主机地址
$port = 3306;         // MySQL 服务器进程端口号
$user = 'root';       // 用户名
$password = '337262953';    //密码
$dbname = 'data';     // 使用的数据库名称


// 通过 mysqli 扩展建立与 mysql 服务器的连接，返回连接对象
$conn = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//设置字符编码
mysqli_set_charset($conn, 'utf8');

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;

// 在连接实例上进行查询
$sql = 'SELECT * FROM `post`';
$res = mysqli_query($conn, $sql);

if ($res)
    echo '受影响的记录数：'.mysqli_affected_rows();
else {
    echo '错误码：'.mysqli_errno($link),'<br>';
    echo '错误信息：'.mysqli_error($link);   
}

$conn2 = @mysqli_connect($host, $user, $password, $dbname, $port) or die ('错误信息：'.mysqli_connect_error());
mysqli_query($conn2, 'set names utf8');

//1、获取对象中的数据
//将对象中的一条数据匹配成索引数组，指针下移一条
// $rows = mysqli_fetch_row($res);

//将对象中的一条数据匹配成关联数组，指针下移一条
// $rows = mysqli_fetch_assoc($res);

//将对象中的一条数据匹配成索引、关联数组，指针下移一条
// $rows = mysqli_fetch_array($res);

//总列数、总行数
echo '总行数'.mysqli_num_rows($res),'<br>';
echo '总列数'.mysqli_num_fields($res),'<br>';


// 获取所有结果
// $rows = mysqli_fetch_all($res);  默认是索引数组
// $rows = mysqli_fetch_all($res,MYSQLI_NUM);  //匹配成索引数组
// $rows = mysqli_fetch_all($res,MYSQLI_ASSOC);  //匹配成关联数组
$rows = mysqli_fetch_all($res,MYSQLI_BOTH);  //匹配成关联、索引数组
var_dump($rows);

//// 释放资源
mysqli_free_result($res);
// 关闭连接
mysqli_close($conn);

?>