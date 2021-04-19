var fs = require('fs');
var template = require('art-template');

template.defaults.root = './';

module.exports = {
    other: function (req, resp) {
        fs.readFile('.' + req.url, (err, data) => {
            if (!err) {
                resp.end(data);
            } else {
                resp.end('');
            }
        });
    },

    index: function (resp) {
        fs.readFile('./index.html', (err, html_data) => {
            resp.end(html_data);
        });
    },

    getall: function (req, resp){
        fs.readFile('./db.json', 'utf8', function(err, json_data){
            resp.setHeader('Content-Type', 'text/plain;charset=utf-8')
            resp.end(json_data);
        });
    }, 

    ajaxDel: function(req, resp, id){
        fs.readFile('./db.json', 'utf8', function (err, data) {
            if (err) {
                console.error(err);
                return;
            }
        
            var arr = JSON.parse(data);
            var newArr = [];
            for (let i = 0; i < arr.length; i++) {
                if (arr[i].id != id) {
                    newArr.push(arr[i]);
                }
            }
        
            var appendStr = JSON.stringify(newArr);
            //直接覆盖原先的数据不好，后续可以用数据库处理，删除某条记录即可
            fs.writeFile('./db.json', appendStr, (err) => {
                if (err) {
                    console.log(err);
                    console.error(err);
                    resp.end('0');
                    return;
                }
                console.log("删除成功");
                resp.end('1');
            });
        })
    },

    getone: function (req, resp, id) {
        fs.readFile('./db.json', 'utf8', (err, json_str) => {
            var json_arr = JSON.parse(json_str);
            var s = '';
            for (let i = 0; i < json_arr.length; i++) {
                if (id == json_arr[i].id) {
                    s = json_arr;
                }
            }
            var htmls = template('./user.html', { data: s});
            resp.end(htmls);
        });
    },

    getedit: function (req, resp, id) {
        fs.readFile('./db.json', 'utf8', (err, json_str) => {
            var json_arr = JSON.parse(json_str);
            var s = '';
            for (let i = 0; i < json_arr.length; i++) {
                if (id == json_arr[i].id) {
                    s = json_arr;
                }
            }
        });
    },

    editpost: function (req, resp, id){

        var fd = require('formidable');
        var form = new fd.IncomingForm();
        // form.uploadDir = "";
        form.parse(req, (err, filds, files) => {
            fs.rename(files.img.path, './img/' + files.img.name, function (err) {
                fs.readFile('./db.json', 'utf8', function(err, json_str){
                    var json_arr = JSON.parse(json_str);
                    for (let i = 0; i < json_arr.length; i++) {
                        if (id == json_arr[i].id) {
                            json_arr[i].name = filds.name;
                            json_arr[i].nengli = filds.nengli;
                            json_arr[i].jituan = filds.jituan;
                            break;
                        }
                        var newData = JSON.stringify(json_arr);
                        //直接覆盖原先的数据不好，后续可以用数据库处理，更新某条记录即可
                        fs.writeFile('./db.json', (err) => {
                            console.log('修改成功！');
                        });
                    }
                });
            });
        })
    },

    deluser: function (req, resp, id){
        fs.readFile('./db.json', 'utf8', function (err, data) {
            if (err) {
                console.error(err);
                return;
            }
        
            var arr = JSON.parse(data);
            var newArr = [];
            for (let i = 0; i < arr.length; i++) {
                if (arr[i].id != id) {
                    newArr.push(arr[i]);
                }
            }
        
            var appendStr = JSON.stringify(newArr);
            //直接覆盖原先的数据不好，后续可以用数据库处理，删除某条记录即可
            fs.writeFile('./db.json', appendStr, (err) => {
                resp.setHeader('Content-type', 'text/html;charset=utf-8');
                if (err) {
                    console.log(err);
                    console.error(err);
                    resp.end('<script>alert("删除失败");location.href="/"</script>');
                    return;
                }
                console.log("删除成功");
                resp.end('<script>alert("删除成功");location.href="/"</script>');
            });
        })
    }
}


// var hzwArr = [{id: 1, name: '路飞', nengli: '超人系橡胶果实', jituan: '草帽海贼团', img: './img/dongman1.jpeg'},
// {id: 2, name: '苍井空', nengli: '美颜', jituan: '东京凉', img: './img/dongman2.jpeg'},
// {id: 3, name: '罗宾', nengli: '超人系花花果实', jituan: '草帽海贼团', img: './img/dongman3.jpeg'},
// {id: 4, name: '波导结衣', nengli: '霸王霸气色', jituan: '红发海贼团', img: './img/dongman4.jpeg'},
// {id: 5, name: '女帝-波雅', nengli: '超人系甜甜果实', jituan: '九蛇海贼团', img: './img/dongman5.jpeg'}]








