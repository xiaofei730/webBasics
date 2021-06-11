<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if (!empty($_POST)) {
    require_once './inc/conn.php';
    $time = time();  //获取时间戳
    $sql = "insert into news values (null,'{$_POST['title']}','{$_POST['content']}',$time)";
    if ($mysqli->query($sql)) {
        header('location:./list.php');
    } else {
        echo 'SQL语句插入失败';
        echo '错误码：'.mysqli_errno($link),'<br>';
        echo '错误信息：'.mysqli_error($link); 
    }
}

?>
    <form method="post" action="">
    标题：<input type="text" name="title"> <br>
    内容：<textarea name="content" rows="5" cols="30"></textarea> <br>
    <input type="submit" value="提交" name="button">
    
    </form>
</body>
</html>