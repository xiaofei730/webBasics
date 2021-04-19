// var url = require('url')  //不需要此模块了
var controller = require('./controller');
module.exports = {
    start: function(server){
        server.on('request', (req, resp) => {
            var baseURL = 'http://' + req.headers.host + '/';
            const myURL = new URL(req.url, baseURL);
            if (req.method == 'DELETE' ) {
                //处理ajax的删除
                console.log(myURL.searchParams.get('id'));
                controller.ajaxDel(req, resp, myURL.searchParams.get('id'));
            } else {
                if (myURL.pathname == '/') {
                    controller.index(resp);
                } else if(myURL.pathname == '/getall'){
                    controller.getall(req, resp);
                } else if(myURL.pathname == '/getone'){
                    controller.getone(req, resp, myURL.searchParams.get('id'));
                } else if(myURL.pathname == '/edituser'){
                    controller.getedit(req, resp, myURL.searchParams.get('id'));
                } else if(myURL.pathname == '/editpost'){
                    controller.editpost(req, resp, myURL.searchParams.get('id'));
                } else if(myURL.pathname == '/deluser'){
                    controller.deluser(req, resp, myURL.searchParams.get('id'));
                } else {
                    controller.other(req, resp);
                }
            }
            
        });
    }
}