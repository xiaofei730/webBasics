<?php

/**
 * 
 * Swoole
 * 
 * 相对于node.js更为底层
 * 
 * 
 * 1、进程管理
 * swoole是一个多进程，多线程的服务
 * master主进程负责创建多个线程来接受和处理用户请求，同时生成一个manager进程，
 * manager进程负责生成和管理N多个worker和task进程，worker和task进程是负责干活的
 * 
 * 
 * //参数1:监听网卡0.0.0.0 监听服务器所有的网卡
 * //参数2:监听的端口号1-1024系统保留       建议从5000开始      最多的端口号65535
 * //参数3：是否开启多进程  默认就是使用多进程
 * //参数4: 协议tcp udp 默认就是tcp服务
 * 
 * $server = new \Swoole\Server('0.0.0.0', 6060);
 * 
 * //配置 可选
 * $server->set([
 *  //启动是的worker进程数量
 *  'worker_num' => 2
 * ]);
 * 
 * //监听的事件
 * //连接上tcp事件
 * //参数1 Server对象
 * //参数2 客户端的ID号
 * //参数3 接受处理的线程ID号
 * $server->on('connnect', function(Swoole\Server $server, int $fd, int $reactorId){
 *      echo "有新连接接入：".$fd."\n";
 * });
 * 
 * $server->on('Receive', function(Swoole\Server $server, int $fd, int $reactorId, string $data){
 *      echo "接受的数据为：".$data."\n";
 * 
 *      $server->send($fd,"服务器说：".$data);
 * });
 * 
 * $server->on('Close', function(Swoole\Server $server, int $fd, int $reactorId){
 *      echo $fd."离开类我们\n";
 * });
 * 
 * 测试使用telnet
 * 
 * telnet 127.0.0.1 6060
 * 
 * 回车进入，按下ctrl+]再次回车，就可以发内容，退出，按ctrl+]输入quit退出
 * 
 * $server->start();
 * 
 * 
 */





