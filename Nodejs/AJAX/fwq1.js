const http = require('http');

const url = require('url'); 

const fs = require('fs');

var server = http.createServer();

server.listen('8000', () => {
    console.log('8000服务器启动成功！');
});

server.on('request', (req, resp) => {
    var baseURL = 'http://' + req.headers.host + '/';
    const myURL = new URL(req.url, baseURL);
    if (req.method == 'GET') {
        if (myURL.pathname == '/') {
            
        } else {
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
    } else {
        
    }
});