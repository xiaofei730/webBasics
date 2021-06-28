<?php
require './inc/conn.php';
$sql = "select * from news where id='{$_GET['id']}'";
$res = $mysqli->query($sql);

$row = $res->fetch_assoc();  //
if (!empty($_POST)) {
    $id=$_GET['id'];
    $title = $_POST['title'];
    $content=$_POST['content'];
    $sql="update news set title='$title',content='$content' where id=$id";
    if ($mysqli->query($sql)) {
        header('location:./list.php');
    }else{
        echo '错误';
    }
    
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="post" action="">
    标题：<input type="text" name="title" value='<?php echo $row['title']?>'> <br>
    内容：<textarea name="content" rows="5" cols="30"><?php echo $row['content']?></textarea> <br>
    <input type="submit" value="提交" name="button">
    <input type="button" value="返回" onclick="location.href='list.php'">
    </form>
</body>
</html>