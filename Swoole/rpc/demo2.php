<?php

//原生php发起一个tcp

//socket当作成一个网络中的文件
$socket = stream_socket_client('tcp:://140.143.30.117:6060', $errno, $errstr, 10);

//发送数据 写文件的过程
fwrite($socket, "我是是一个php");

//接收
$header = fread($socket, 9000);

//关闭
fclose($socket);


//socket当作成一个网络中的文件
$socket = stream_socket_client('tcp:://140.143.30.117:6061', $errno, $errstr, 10);

//发送数据 写文件的过程
fwrite($socket, "我是是一个php");

//接收
$body = fread($socket, 9000);

//关闭
fclose($socket);


//socket当作成一个网络中的文件
$socket = stream_socket_client('tcp:://140.143.30.117:6062', $errno, $errstr, 10);

//发送数据 写文件的过程
fwrite($socket, "我是是一个php");

//接收
$footer = fread($socket, 9000);

//关闭
fclose($socket);

echo $header;
echo $body;
echo $footer;

