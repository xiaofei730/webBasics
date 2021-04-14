const http = require('http');

const url = require('url'); 

const fs = require('fs');

var server = http.createServer();

server.listen('8000', () => {
    console.log('服务器启动成功！');
});

server.on('request', (req, resp) => {
    var baseURL = 'http://' + req.headers.host + '/';
    const myURL = new URL(req.url, baseURL);
    console.log(myURL.pathname);
    console.log(req.method);
    if(myURL.pathname == '/gets') {
        //接收post的参数值
        if(req.method == 'POST'){
            var d = '';
            req.on('data', (post_data) => {
                d += post_data;
            });
            req.on('end', () => {
                //解析接收的数据
                var obj = require('querystring').parse(d);
                console.log(obj);
            });
        }else{
            //接收get请求参数值
            console.log(myURL.searchParams.get('name'));
            if (myURL.searchParams.get('name')) {
                
            }
            resp.end('12314');
        }
        
        
    }else{
        //myURL.pathname 或者req.url
        fs.readFile('.' + myURL.pathname, (err, data_str) => {
            if(!err) {
                resp.end(data_str);
            }else{
                console.log(err);
                resp.end('');
            }
        });
    }
});