var http = require('http');
var fs = require('fs');
const { url } = require('node:inspector');
var server = http.createServer();

server.listen(8000, () => {
    console.log('启动成功');
});

server.on('request', (request, response) => {
    console.log(request.url);
    var urls = request.url;
    if(request.url == '/') {
        response.setHeader('content-type','text/html;charset=utf-8');
        fs.readFile('./index.html', 'utf8', (err, data) => {
            response.write(data);
            response.end();
        });
    }else if(request.url == '/animalOne.jpg'){
        fs.readFile('./animalOne.jpg', (err, data) => {
            response.write(data);
            response.end();
        });

    }else if(request.url == '/dong.jpeg'){
        fs.readFile('./dong.jpeg', (err, data) => {
            response.write(data);
            response.end();
        });
    }else{
        fs.readFile('.' + urls, (err, data) => {
            if (!err) {
                response.write(data);
            }else{
                response.write('');
            }
            
            response.end();
        });
    }

    
});




