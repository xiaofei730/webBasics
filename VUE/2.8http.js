var http = require('http');

var server = http.createServer();

server.listen(8000, () => {
    console.log('服务器请求成功');
})

server.on('request', (req, resp) => {
    var baseURL = 'http://' + req.headers.host + '/';
    const myURL = new URL(req.url, baseURL);
    if (myURL.pathname == '/') {
        if (myURL.searchParams.get('name') == 'admin') {
            resp.end('0');
        } else {
            resp.end('1');
        }
    }else{
        require('fs').readFile('.' + myURL.pathname, (err, data_str) => {
            if(!err) {
                resp.end(data_str);
            }else{
                console.log(err);
                resp.end('');
            }
        });
    }
    
});