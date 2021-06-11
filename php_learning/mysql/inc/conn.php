<?php

$host = '127.0.0.1';  // MySQL 服务器主机地址
$port = 3306;         // MySQL 服务器进程端口号
$user = 'root';       // 用户名
$password = '337262953';    //密码
$dbname = 'data';     // 使用的数据库名称

$mysqli = new mysqli($host, $user, $password, $dbname, $port);
$mysqli->set_charset("utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
    printf("Current character set: %s\n", $mysqli->character_set_name());
}

$mysqli->close();
