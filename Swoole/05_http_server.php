<?php

//内置 HTTP 服务器的支持，通过几行代码即可写出一个高并发，高性能，异步 IO 的多进程 HTTP 服务器。

$http_server = new Swoole\Http\Server("127.0.0.1", 9501);

$http_server->set([
    'worker_num' => 2,
    // 配置静态文件根目录，与 enable_static_handler 配合使用。
    //虚拟目录指向位置 只针对静态的资源 html、htm、css、js 图片 swf avi mp4 （视频）
    'document_root' => '/data/webroot/example.com', // v4.4.0以下版本, 此处必须为绝对路径
    'enable_static_handler' => true,
]);

$http_server->on('request', function(\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
    $response->status(404);
    $response->header('content-type', 'text/html;charset=utf-8');

    $response->header('Content-Length', '100002 ');
    $response->header('Test-Value', [
        "a\r\n",
        'd5678',
        "e  \n ",
        null,
        5678,
        3.1415926,
    ]);
    $response->header('Foo', new SplFileInfo('bar'));
    $response->end("<h1>hello swoole</h1>");
});
$http->start();