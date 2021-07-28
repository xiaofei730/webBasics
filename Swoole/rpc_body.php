<?php

$server = new \Swoole\Server('0.0.0.0', 6061);

//配置 可选
$server->set([
    //守护进程
    'daemonize' => 1,
 //启动是的worker进程数量
 'worker_num' => 1
]);


//监听的事件
//连接上tcp事件
//参数1 Server对象
//参数2 客户端的ID号
//参数3 接受处理的线程ID号
$server->on('connnect', function(Swoole\Server $server, int $fd, int $reactorId){
    ///向客户端发送数据
    $server->send($fd, "<article>内容区域</article>");
});

$server->start();