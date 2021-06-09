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


// 通过 mysqli 扩展建立与 mysql 服务器的连接
$conn = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;

// 在连接实例上进行查询
$sql = 'SELECT * FROM `post`';
$res = mysqli_query($conn, $sql);

// 获取所有结果
$rows = mysqli_fetch_all($res);
var_dump($rows);

//// 释放资源
mysqli_free_result($res);
// 关闭连接
mysqli_close($conn);

?>