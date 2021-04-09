const fs = require('fs');
var str = [
    { id: 1, names: '路飞', sex: '男', img: '' },
    { id: 2, names: '乌索普', sex: '男', img: '' },
    { id: 3, names: '娜美', sex: '女', img: '' },
]

var content = JSON.stringify(str);

fs.writeFile('./hzw.json', content, err => {
    if (err) {
        console.log(err);
        console.error(err);
        return;
    }

})

fs.readFile('./hzw.json', 'utf8', function (err, data) {
    if (err) {
        console.error(err);
        return;
    }

    var obj = { id: 4, names: '罗宾', sex: '女', img: ''}
    var arr = JSON.parse(data);
    arr.push(obj);

    var appendStr = JSON.stringify(arr);

    fs.writeFile('./hzw.json', appendStr, err => {
        if (err) {
            console.log(err);
            console.error(err);
            return;
        }
        console.log("添加成功");
    })
})

fs.readFile('./hzw.json', 'utf8', function (err, data) {
    if (err) {
        console.error(err);
        return;
    }

    var arr = JSON.parse(data);
    var newArr = [];
    for (let i = 0; i < arr.length; i++) {
        if (arr[i].id != 2) {
            newArr.push(arr[i]);
        }
    }

    var appendStr = JSON.stringify(newArr);

    fs.writeFile('./hzw.json', appendStr, err => {
        if (err) {
            console.log(err);
            console.error(err);
            return;
        }
        console.log("删除成功");
    })
})
