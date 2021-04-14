//图片懒加载：
    //优化网站。提高网站响应速度的常见手段
    //先将用户能看到的区域图片先加载出来
    //原理，是先将图片的真实地址存储在自定义属性上面，所有的图片src设置为一个默认的占位图，页面滚动的时候判断这些图片是否已经达到了可视范围之内，达到了那么将图片的真实地址放入到src，浏览器会自动加载图片

//代码实现

//在浏览器的范围可视之内的图显示出来
var img = document.images;
var curIndex = 0;

function showImg(){
    //已经加载的不需要再处理
    for (var i = curIndex; i < img.length; i++){
        console.log(img[i].offsetTop);
        //滚动出去的距离
        var st = document.documentElement.scrollTop || document.body.scrollTop;
        if(img[i].offsetTop<(window.innerHeight + st -120)){
            console.log("在浏览器里面");
            img[i].src = img[i].getAttribute("data-trueSrc");
            curIndex = i;
        }
    }
}

window.onload = function(){
    showImg();
};

window.onscroll = function(){
    showImg();
}