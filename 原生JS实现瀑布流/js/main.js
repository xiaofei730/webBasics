//实现思路
    //第一组横向摆放， 第二组数据开始去寻找每一列的高度最低的那个，将元素放到他的下面（定位或者每一列就是个容器）


//代码实现：

    //数据每一

    //创建100个div，不同的高度，不同的颜色

function createDiv(){
    var doc = document.createDocumentFragment();
    for(var i = 0; i < 100; i++){
        var div = document.createElement("div");
        div.innerHTML = i + 1;
        div.className = "item";
        //随机高度
        var h = Math.floor(Math()*100)+200  //(200-299)
        div.style.height = h + "px";
        div.style.width = "200px"
    }
}