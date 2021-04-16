var http = require('http');

var server = http.createServer();

server.listen('9000', () => {
    console.log('9000服务器启动成功');
});

var router = require('./router');
router.start(server);