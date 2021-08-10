<?php
//发布频道

//实例化redis对象
$redis = new Redis();

//连接redis
$redis->connect('127.0.0.1', 6379, 5);

//认证
$redis->auth('admin123');

//发布
$redis->publish('php', $_GET('msg'));


