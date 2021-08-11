<?php

session_start();

$redis = include __DIR__ . '/conn.php';
$post = $_POST;

//查询key
$key = 'user:username:'.$post['username'];

//判断用户是否存在
$bool = $redis->exists($key);

if (!$bool) {
    header('location:login.php');
    return;
}

//得到用户信息
$user = $redis->hgetall($key);

//进行密码的比对
if ($post['password'] != $user['password']) {
    header('location:login.php');
    return;
}

//写session
$_SESSION['user'] = $key;

//把发送任务发送给队列中   生产与消费
//list key sendmaillist
$listkey = 'sendmaillist';
$redis->lpush($listkey, $user['email']);

//文章列表
header('location:list.php');











