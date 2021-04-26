function ff(a, b){

}

//基本的箭头函数
var ff = (a, b) => {
    return 11;
}

//只有return的时候，可以简写
var ff = (a, b) => 11;

//只有一个参数，并且只有return的时候，可以这么简写
var ff = a => 11;

//没有参数的情况下必须加括号
var ff = ()=>1

//1、箭头函数没有自己的this，函数内部写的this，指向的是外层代码块的this
//2、箭头函数内部的this是定义时所在的对象，而不是使用时所在的对象并且不会改变
//3、箭头函数不能用作构造函数（因为this被固定了，指向外部对象）
//4、箭头函数内部不存在arguments，箭头函数体中使用的arguments其实指向的是外层函数的arguments

// 不要给变量命名name，在window环境下，本身就有name属性
// var name = '王武';
// module.name = '王武';
var obj3 = {
    name: 'lisi',
    ff:()=>{
        //在node运行此脚本会输出undefine，this指向空对象，在浏览器运行会输出王武
        console.log(this.name);
    }
}

//node的顶层对象module
console.log(module);

obj3.ff();

function Man(){
    this.name = '121';
    this.age = '12'
}

var m = new Man();

//new 的过程
//1、创建空对象
//2、为空对象指向默认原型对象（继承、伪继承）
//3、将构造函数中的this指向当前的空对象
//4、为空对象添加属性和值
//5、返回对象的地址