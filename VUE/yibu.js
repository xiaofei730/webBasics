var fs = require('fs');

// 回调地狱
fs.readFile('./a.txt', 'utf8', (err, fileData) => {
    console.log(fileData);
    fs.readFile('./b.txt', 'utf8', (err, fileData) => {
        console.log(fileData);
        fs.readFile('./c.txt', 'utf8', (err, fileData) => {
            console.log(fileData);
            fs.readFile('./c1.txt', 'utf8', (err, fileData) => {
                console.log(fileData);
                fs.readFile('./c2.txt', 'utf8', (err, fileData) => {
                    console.log(fileData);
                });
            });
        });
    });
});