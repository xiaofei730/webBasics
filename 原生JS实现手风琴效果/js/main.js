//思路
    //鼠标移入哪张图片，这张图片需要放大800px ,其余图片需要变成100px

//代码实现
var li = document.querySelectorAll(".box li");
console.log(li);
for (var k = 0; k < li.length; k++){
    //移入的那个变成800px 鼠标移入事件
    li[k].onmouseenter = function(){
        //排他
        //所有元素都变成100px
        for(var m = 0; m < li.length; m++){
            li[m].style.width = "100px";
        }
        this.style.width = "800px";
    };
    //鼠标移出事件
    li[k].onmouseleave = function(){
        for(var m = 0; m < li.length; m++){
            li[m].style.width = "240px";
        }
    };
}