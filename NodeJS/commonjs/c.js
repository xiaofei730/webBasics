var aa = require('./a');

var str = '567';
//exports 指向module.exports
//如果直接给exports赋值，数据无法导出
exports.k = str;

console.log(module);

function Pon(){
    this.name = 'lisi';
};

//1、开辟空的内存空间 对象
//2、指向原型
//3、this指向内存地址
//4、为对象赋值
//5、返回这个对象的内存地址

var p = new Pon();
p.name;