var fs = require('fs');

var moment = require('moment');

//读取当前目录的文件
fs.readdir('./', (err, files)=>{
    console.log(err);
    console.log(files);
    for(let i=0; i<files.length; i++ ){
        //读取文件属性
        fs.stat('./'+files[i], (err, stats) => {
            // console.log(stats.atime);
            // var dd = new Date();
            // var y = dd.getFullYear(stats.atime);
            // console.log(y); 
            var m =moment(stats.atime).format("YYYY-MM-DD *** hh:mm:ss");
            console.log(m);
        });
    }
});

