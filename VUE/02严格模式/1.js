"use strict"

//在严格模式，变量必须先声明后使用
a = 1;

console.log(a);


function f(a,b,a) {
    console.log(a,b,a)
}
f(1,2,3)

var s = '123'
s.length = 6
console.log(s.length)
