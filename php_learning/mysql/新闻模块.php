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
    //1、连接数据库
    require_once './inc/conn.php';
    //2、获取数据
    $rs = $mysqli->query("select * from news");   //返回结果集对象
    $list = $mysqli->fetch_all(MYSQLI_ASSOC);


?>
<a href="./add.php">添加新闻</a>
<table>
    <tr>
        <th>编号</th>
        <th>标题</th>
        <th>内容</th>
        <th>时间</th>
        <th>修改</th>
        <th>删除</th>
        <?php foreach($list as $rows):?>
        <tr>
            <td><?php echo $rows['id']?></td>
            <td><?php echo $rows['title']?></td>
            <td><?php echo $rows['content']?></td>
            <td><?php echo date('y-m-d H:i:s',$rows['createtime']) ?></td>
            <td><input type="button" value="修改" onclick="location.href='./del.php?id=<?php echo $rows['id']?>'"></td>
            <td><input type="button" value="删除" onclick="if(confirm('确定删除吗？'))location.href='./del.php?id=<?php echo $rows['id']?>'"></td>
        </tr>
        <?php endforeach;?>
    </tr>
</table>

</body>
</html>

