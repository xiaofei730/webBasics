var fs = require('fs');

function p1(filePath) {
    var ps = new Promise(function(success, failure){
        fs.readFile(filePath, 'utf8', (err, data) => {
            if (!err) {
                success(data);
            }else{
                failure(err);
            }
        });
    });

    return ps;
}

var prom = p1('./a.txt');
prom.then(function(val){
    console.log(val);
    return p1('./b.txt');
}).then(function(val){
    console.log(val);
    return p1('./c.txt');
}).then(function(val){
    console.log(val);
}).catch(function(err){
    console.log(err);
})

