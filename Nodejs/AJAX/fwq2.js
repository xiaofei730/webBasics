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
    if (req.method == 'GET') {
        if (myURL.pathname == '/') {
            
        } else if (myURL.pathname == '/gets'){
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
        
    }
});