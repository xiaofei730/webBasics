var http = require('http');

var url = require('url');

var server = http.createServer();

server.listen(8000, function(){
    console.log("服务器启动成功！");
});

server.on('request', (req, resp) => {
    console.log(req.headers);
    var myURL = new URL(req.url, `http://${req.headers.host}`);
    console.log(myURL.searchParams.get('name'));
    // console.log(req.baseUrl);
    // url.UrlWithStringQuery()
    // const myURL = new URL(req.url);
    // //路径解析
    // myURL.searchParams.forEach((value, name, searchParams) => {
    //     console.log(name, value, myURL.searchParams === searchParams);
    //   });
    // var urls = url.(req.url, true);
    // console.log(urls);
    // console.log(urls.query.name);
    resp.end();
});