function f1(){
    console.log(3);
}

var obj = {
    // f1:f1
    f1
}

obj.f1();

var obj2 = {
    name: 'lisi',
    hh: function(){
        console.log(this.name);
    },

    //方法声明的简洁表达式
    kk(){

    }
}

obj2.hh();
obj2.kk();