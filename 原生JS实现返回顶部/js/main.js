//思路：
//返回顶部，是固定在右下角的某个位置
//页面开始的时候，返回顶部的按钮不出现，到页面滚动到一定距离的时候，才自动出现
//点击返回顶部之后，页面慢慢的滚动到顶部


//代码实现
var back = document.querySelector(".back");
var timer = null;

//监听页面滚动
var st = 0;
window.onscroll = function(){
    //获取页面滚动出去的距离
    st = document.documentElement.scrollTop || document.body.scrollTop;
    console.log(st);
    if(st >= 500){
        back.classList.add("show");
    }else{
        back.classList.remove("show");
    }
};

//点击返回顶部
back.onclick = function(){
    //页面跳转到指定位置
    // window.scrollTo(0, 0);

    //清除上一次的定时器
    clearInterval(timer);

    timer = setInterval(function(){
        var now = st;
        var speed = (0-now)/10;
        speed = speed > 0 ? Math.ceil(speed) : Math.floor(speed);
        //回到顶部清除定时器
        // st -= 50;
        if(st == 0){
            clearInterval(timer);
        }
        document.documentElement.scrollTop = st + speed;
        document.body.scrollTop = st + speed;
    }, 30);
};