<?php
//php脚本永不超时
set_time_limit(0);
//发布频道

//实例化redis对象
$redis = new Redis();

//连接redis
$redis->connect('127.0.0.1', 6379, 5);

//认证
$redis->auth('admin123');


//订阅
$redis->subscribe(['php'], function($redis, $channel, $msg) {
    echo $msg.'<hr>';
});