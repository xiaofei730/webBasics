<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- <form method="post" action="http://localhost:8000/basic/get和post.php">
    语文：<input type="text" name="ch"> <br>
    数学：<input type="text" name="math"> <br>
    <input type="submit" name="button" value="提交">
</form> -->

<?php   
    if(isset($_POST['button'])){
        echo '姓名：'.$_POST['username'],'<br>';
        echo '密码：'.$_POST['pwd'],'<br>';
        echo '性别：'.$_POST['sex'],'<br>';
        echo '爱好：',isset($_POST['hobby'])?implode(',',$_POST['hobby']):'没有爱好','<br>';
        echo '籍贯：'.$_POST['jiguan'],'<br>';
        echo '留言：'.$_POST['words'],'<br>';
    }
?>
<form method="post" action="">
    姓名：<input type="text" name="username"> <br>
    密码：<input type="password" name="pwd"> <br>
    性别：<input type="radio" name="sex" value="1">男 
        <input type="radio" name="sex" value="0">女 <br>
    爱好：
    <input type="checkbox" name="hobby[]" value="爬山">爬山
    <input type="checkbox" name="hobby[]" value="抽烟">抽烟
    <input type="checkbox" name="hobby[]" value="喝酒">喝酒
    <input type="checkbox" name="hobby[]" value="烫头">烫头 <br>
    籍贯：
    <select name="jiguan">
        <option value="021">上海</option>
        <option value="010">北京</option>
    </select> <br>
    留言：
    <textarea name="words" rows="5" cols="30"></textarea> <br>
    <input type="submit" name="button" value="提交">
</form>

</body>
</html>