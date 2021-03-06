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

    index: function (res) {
        fs.readFile('./db.json', 'utf8', (err, json_str) => {
            var json_arr = JSON.parse(json_str);
            var obj = { dt: json_str};
            var htmls = template('./index.html', obj);
            resp.end(htmls);
        });
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
                    }
                    var newData = JSON.stringify(json_arr);
                    //直接覆盖原先的数据不好，后续可以用数据库处理，更新某条记录即可
                    fs.writeFile('./db.json', (err) => {
                        console.log('修改成功！');
                    });
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
            fs.writeFile('./db.json', appendStr, err => {
                if (err) {
                    console.log(err);
                    console.error(err);
                    return;
                }
                console.log("删除成功");
            })
        })
    }
}









