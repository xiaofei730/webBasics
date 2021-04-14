//思路
    //考虑到需要用的数据，数组


//代码实现

//定义省的数组
var arr1 = ["浙江","安徽","江西"];

//定义市的数组（二维数组）
var arr2 = [
    ["杭州市","宁波市","温州市"],
    ["合肥市","宣城市","芜湖市"],
    ["南昌市","九江市","上饶市"]
];

//定义县的数组（三维数组）
var arr3 = [
    [
        ["西湖区","拱墅区","江干区"],
        ["海曙区","江北区","北仓区","镇海区"],
        ["鹿城区","龙湾区","瓯海区","洞头区","瑞安市"],
    ],
    [
        ["蜀山区","瑶海区","庐阳区","包河区","巢湖市","长丰县","肥西县","庐江县"],
        ["宣州区","郎溪县","广德市","宁国市","泾县","绩溪县","旌德县"],
        ["镜湖区","弋江区","鸠江区","三山区","芜湖县","繁昌县","南陵县","无为县"],
    ],
    [
        ["东湖区","西湖区","青云谱区","湾里区","青山湖区","新建区","红谷滩区","南昌县","安义县","进贤县"],
        ["浔阳区","濂溪区","柴桑区","武宁县","修水县","永修县","德安县","都昌县"],
        ["信州区","三江新区","广丰区","德兴市","上饶县","横峰县"],
    ],
]

//获取DOM节点
var sheng = document.getElementById("sheng");
var shi = document.getElementById("shi");
var xian = document.getElementById("xian");

//设置当前的省
var porIndex = 0;

//设置默认显示省的开始
var htmlStr = "";
for (var i = 0; i < arr1.length; i++) {
    htmlStr += "<option>" + arr1[i] + "</option>";
}

sheng.innerHTML = htmlStr;

//设置默认显示市的开始
var htmlStr2 = "";
for(var k = 0; k < arr2[0].length; k++){
    htmlStr2 += "<option>" + arr2[0][k] + "</option>";
}

shi.innerHTML = htmlStr2;

//设置默认显示县的开始
var htmlStr3 = "";
for(var j = 0; j < arr3[0][0].length; j++){
    htmlStr3 += "<option>" + arr3[0][0][j] + "</option>";
}

xian.innerHTML = htmlStr3;

//手动调整了省
sheng.onchange = function(){
    //获取到选中了哪个省
    var idx = this.selectedIndex; //select这个DOM节点有的属性，指向当前选中的下标

    porIndex = idx;

    console.log(idx);
    //自动更新市
    var htmlStr4 = "";
    for(var k = 0; k < arr2[idx].length; k++){
        htmlStr4 += "<option>" + arr2[idx][k] + "</option>";
    }

    shi.innerHTML = htmlStr4;

    //设置默认显示县的开始
    var htmlStr5 = "";
    for(var j = 0; j < arr3[idx][0].length; j++){
        htmlStr5 += "<option>" + arr3[idx][0][j] + "</option>";
    }

    xian.innerHTML = htmlStr5;
}

//手动调整了市
shi.onchange = function(){
    //获取到选中了哪个市
    var idx2 = this.selectedIndex; //select这个DOM节点有的属性，指向当前选中的下标
    console.log(idx2);

    //设置默认显示县的开始
    var htmlStr5 = "";
    for(var j = 0; j < arr3[porIndex][idx2].length; j++){
        htmlStr5 += "<option>" + arr3[porIndex][idx2][j] + "</option>";
    }

    xian.innerHTML = htmlStr5;
}




