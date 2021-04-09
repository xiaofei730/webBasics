//思路：

//1、左边内部内容滑块可以移动，同时不能超出范围

	//知道鼠标在内部的一个位置（box和页面的位置，鼠标和页面的位置，求差值）

	//不超出范围
//2、鼠标移入左边区域，右边内容展示

//3、鼠标移入坐标区域移动，对应右边内容展示

// move/show = zoom/big

//代码实现


//找到DOM节点
var box = document.querySelector(".box");
var show = document.querySelector(".show");
var move = document.querySelector(".move");
var zoom = document.querySelector(".zoom");
var big = document.querySelector(".big");

//获取宽高
var showWidth = show.offsetWidth;   //获取元素的宽度
var showHeight = show.offsetHeight; 	//获取元素的高度
//不能一开始获取宽高，因为display:none，所以宽高伟0
var moveWidth;
var moveHeight;
//求出宽高的比例
var pixW;
var pixH;

show.onmouseenter = function(){
	//滑块显示
	move.style.display = "block";
	//右边内容区域展示
	zoom.style.display = "block";
	//获取宽高
	moveWidth = move.offsetWidth;
	moveHeight = move.offsetHeight;
	//求出宽高的比例
	pixW = moveWidth/showWidth;
	pixH = moveHeight/showHeight;
	//zoom的宽高
	var zoomWidth = zoom.offsetWidth;
	var zoomHeight = zoom.offsetHeight;
	//右边大图的尺寸
	big.style.width = zoomWidth/pixW + "px";
	big.style.height = zoomHeight/pixH + "px";
}
show.onmouseleave = function(){
	//滑块隐藏
	move.style.display = "none";
	//右边内容区域因此
	zoom.style.display = "none";
}
//show 添加mousemove事件
show.onmousemove = function(ev){
	var event = ev || window.event;
	console.log(event.clientX,event.clientY);
	// 鼠标相对于浏览器页面
	var clX = event.clientX;
	var clY = event.clientY;
	//获取show区域相对于浏览器左上角的距离
	var clX2 = box.offsetLeft;
	var clY2 = box.offsetTop;
	//offsetLeft offsetTop求得这个节点相对于父类中含有定位的那一层的偏移
	console.log(clX2,clY2);
	//鼠标在show区域内的偏移
	var lt = clX - clX2;
	var tp = clY - clY2;
	console.log(lt, tp);
	//设置move的位置
	//边缘处理
	if (lt <= (moveWidth/2)) {
		move.style.left = "0px";
	} else if (lt >= (showWidth-moveWidth/2)) {
		move.style.left = showWidth-moveWidth + "px";
	}else {
		move.style.left = lt - (moveWidth/2) + "px";
	}
	if (tp <= (moveHeight/2)) {
		move.style.top = "0px";
	} else if (tp >= (showHeight-moveHeight/2)) {
		move.style.top = showHeight-moveHeight + "px";
	}else {
		move.style.top = tp - (moveHeight/2) + "px";
	}

	//设置右边对应的显示区域
	big.style.left = -parseFloat(move.style.left)/pixW + "px";
	big.style.top = -parseFloat(move.style.top)/pixH + "px";
}






























