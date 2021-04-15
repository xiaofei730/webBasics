const http = require('http');

const url = require('url'); 

const fs = require('fs');

var server = http.createServer();

server.listen('9000', () => {
    console.log('9000服务器启动成功！');
});

server.on('request', (req, resp) => {
    var baseURL = 'http://' + req.headers.host + '/';
    const myURL = new URL(req.url, baseURL);
    // console.log(req.url);
    // console.log(myURL.pathname);
    resp.setHeader('Access-Control-Allow-Origin','http://127.0.0.1:8000');
    if (req.method == 'GET') {
        if (myURL.pathname == '/') {
            resp.end('ggggeeee');
        } else if (myURL.pathname == '/gets'){
            //服务端返回的 Access-Control-Allow-Origin: * 表明，该资源可以被任意外域访问。如果服务端仅允许来自 http://foo.example 的访问，该首部字段的内容如下：
            // Access-Control-Allow-Origin: http://foo.example
            // resp.setHeader('Access-Control-Allow-Origin','*');
            ///多个域名设置 解决方法判断请求头的来源
            console.log(baseURL);
            // if(req.headers.orgin ==)
            resp.setHeader('Access-Control-Allow-Origin','http://127.0.0.1:8000');

            resp.end('999');
        } else if (myURL.pathname  == '/kuayus'){
            var fun_name =  myURL.searchParams.get('callback');
            console.log(fun_name);
            var json_str = '[{"id": "2", "name": "lisi"}]';
            // resp.end('alert("90")');
            // resp.end('console.log('+json_str+')');
            resp.end(fun_name + '('+json_str+')');
        }else {
            //myURL.pathname
            fs.readFile('.' + myURL.pathname, (err, data_str) => {
                if(!err) {
                    resp.end(data_str);
                }else{
                    console.log(err);
                    resp.end('');
                }
            });
        }
    } else if(req.method == 'POST') {
        
    } else if(req.method == 'OPTIONS') {
        //CORS跨域有两种请求方式
        //1、简单请求
        //2、需预检请求 需要先发送OPTIONS请求，来征得服务器的同意后，才会发送真正的请求
        resp.setHeader('Access-Control-Allow-Methods','POST, GET, OPTIONS, DELETE');
        resp.end();
    }else{
        resp.end('methods');
    }
});

//同域代理 