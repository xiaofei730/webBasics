<?php

//tcp客户端
$client = new Swoole\Client(SWOOLE_SOCK_TCP);

//连接
//参数3 超时时间 秒
if (!$client->connect('127.0.0.1', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}

//发送数据
$client->send("hello world\n");

//接受服务器传过来的数据
echo $client->recv();

//关闭
$client->close();









