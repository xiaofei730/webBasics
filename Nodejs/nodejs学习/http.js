//1、导入http模块
var http = require('http');

//2、使用http这个模块中的createServer()创建一个服务器实例对象
var server = http.createServer();

server.listen(8000, () => {
    console.log("启动成功");
});

server.on("request", (request, response) => {

    console.log(request.method);
    // response.setHeader('content-type', 'text/plain;charset=utf-8');
    // response.write('这是中国');

    //响应一个页面
    //1:响应页面实际上是将html文件中的代码响应回去
    //2：利用fs模块读取文件内容
    response.setHeader('content-type', 'text/html;charset=utf-8');
    var fs = require('fs');
    fs.readFile('./hhe.html', 'utf8', function(err, data){
        response.write(data);
        response.end();  
    });
     
});