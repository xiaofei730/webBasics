//实现思路
    //第一组横向摆放， 第二组数据开始去寻找每一列的高度最低的那个，将元素放到他的下面（定位或者每一列就是个容器）


//代码实现：
//每个的宽度
var colWidth = 200;

//计算可以容纳多少列
var colNum = Math.floor(window.innerWidth/colWidth);
console.log(colNum);
//间隙是多少
var jx = Math.floor((window.innerWidth - colNum * colWidth)/(colNum+1));
console.log(jx);
//存储高度的数组（每一次将每一列的高度存储起来）
var saveH = [];

    //数据没有

    //创建100个div，不同的高度，不同的颜色

function createDiv(){
    var doc = document.createDocumentFragment();
    for(var i = 0; i < 100; i++){
        var div = document.createElement("div");
        div.innerHTML = i + 1;
        div.className = "item";
        //随机高度
        var h = Math.floor(Math.random()*100)+200  //(200-299)
        //随机背景颜色 0-255
        var r = Math.floor(Math.random()*256);
        var g = Math.floor(Math.random()*256);
        var b = Math.floor(Math.random()*256);
        var bgColor = "rgb("+r+","+g+","+b+")";
        div.style.backgroundColor = bgColor;
        div.style.height = h + "px";
        div.style.lineHeight = h + "px";
        div.style.width = colWidth + "px";
        doc.appendChild(div);
    }
    document.body.appendChild(doc);

    //实现瀑布流
    show();
}

createDiv();


function show(){
    //遍历所有的的item
    var item = document.querySelectorAll(".item");
    for(var i = 0; i < item.length; i++){
        //需要colNum列
        if(i<colNum){
            item[i].style.top = jx + "px";
            item[i].style.left = jx * (i + 1) + colWidth * i + "px";
            //存储高度
            saveH.push(jx + item[i].offsetHeight);
        }else{
            //找到高度最小的那一列
            console.log(saveH);
            var index = getMin(saveH);
            item[i].style.top = jx + saveH[index] + "px";
            item[i].style.left = jx * (index + 1) + colWidth * index + "px";
            //
            console.log(saveH[index] + item[i].style.offsetHeight + jx);
            saveH[index] = saveH[index] + jx + item[i].offsetHeight;
        }
    }
}

/*
获取数组里的最小值的下标
*/
function getMin(arr){
    var min = arr[0];
    var curIndex = 0;
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] < min) {
            min = arr[i];
            curIndex = i;
        }
    }
    console.log(min);
    return curIndex;
}

window.onresize = function(){
    //计算可以容纳多少列
    colNum = Math.floor(window.innerWidth/colWidth);
    console.log(colNum);
    //间隙是多少
    jx = Math.floor((window.innerWidth - colNum * colWidth)/(colNum+1));
    console.log(jx);
    //存储高度的数组（每一次将每一列的高度存储起来）
    saveH = [];

    show();
};