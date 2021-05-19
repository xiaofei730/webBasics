<?php
/**
 * 表单提交数据的两种方式
 */

//1、get
// <form method="post" action=""></form>

//2、post
// <form method="get" action=""></form>

//区别
//1、外观上看
//get提交在地址上可以看的参数
//post提交在地址栏上看不到参数

//2、安全性
//get不安全
//post安全

//3、提交原理
//get提交是参数一个一个的提交
//post提交是所有参数作为一个整体一起提交

//4、提交数据大小
//get提交一般不超过255个字节
//post提交的大小取决于服务器   在php.ini中，可以配置post的提交的大小  post_max_size = 6M

//5、灵活性
//get很灵活，只要有页面的跳转就可以传递参数
//post不灵活，post提交需要有表单的参与
//1、html跳转
//<a href="index.php?name=tom&age=20"></a>
//2、js跳转
/*
<script>
    location.href = 'index.php?name=tom?age=20';
    location.assign('index.php?name=tom?age=20');
    location.replace('index.php?name=tom?age=20');
</script>
*/
//3、php跳转
//header('location:index.php?name=tom&age=20')


//服务器接受数据的三种方式
//通过名字获取名字对应的值
//$_POST：数组类型，保存的POST提交的值
//$_GET：数组类型，保存的GET提交的值
//$_REQUEST：数组类型，保存的GET和POST提交的值
   
var_dump($_POST);
if (!empty($_POST)) {
    echo '语文'.$_POST['ch'],'<br>';
    echo '数学'.$_POST['math'],'<br>';
}
echo '<br>';  
if (!empty($_GET)) {
    echo '语文'.$_GET['ch'],'<br>';
    echo '数学'.$_GET['math'],'<br>';
}
echo '<br>';
echo '语文'.$_REQUEST['ch'],'<br>';
echo '数学'.$_REQUEST['math'],'<br>';

//在一个请求中，既有get又有post，get和post传递的名字一样的，这时候通过$_REQUEST获取的数据是什么？
//答：结果取决于配置文件
//request_order = "GP"  //先获取GET,再获取POST值
/*
<?php
    if(!empty($_POST)){
        echo '姓名：'.$_REQUEST['username'],'<br>'
    }
?>
<form method="post" action="?username=berry">
    姓名：<input type="text" name="username"> <br>
    <input type="submit" name="button" value="提交">
</form>
*/

//1、在开发的时候，如果明确是post提交就使   用$_POST获取，如果明确get就使用$_GET获取
//2、request获取效率低，尽可能不要使用，除非提交的类型不确定的情况才使用

//参数传递
//1、复选框值的传递 





















