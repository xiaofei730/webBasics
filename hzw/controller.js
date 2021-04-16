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
    }
}









