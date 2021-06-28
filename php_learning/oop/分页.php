<?php
spl_autoload_register(function ($class_name){
    require "./{$class_name}.class.php";
});
$param = array(  
    'host' => '127.0.0.1',
    'user' => 'root',
    'pwd' => 'root',
    'dbname' => 'data'
);

$db = MySQLDB::getInstance($param);

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
<?php
//页面大小
$pageSize = 10;    
//第一步：获取总记录数
$rowCount = $db->fetchColumn('select count(*) from products');

//第二步：求出总页数
$pageCount = ceil($rowCount/$pageSize);

//第四步：通过当前页面，求出起始位置
$pageno = $_GET('pageno') ?? 1;
$pageno = $pageno < 1 ? 1 : $pageno;
$pageno = $pageno > $pageCount ? $pageCount : $pageno;
$startno = ($pageno - 1) * $pageSize;

//第五步：获取当前页面数据，并遍历显示
// $sql = "select * from products limit $startno,$pageSize";
$sql = "select * from products where proid>=(select proid from products limit $startno,1) limit $pageSize ";
$rs = $db->fetchAll($sql);

?>
<table>
    <tr>
        <th>编号</th>
        <th>商品名称</th>
        <th>规格</th>
        <th>价格</th>
    </tr>
    <?php foreach($rs as $row): ?>
    <tr>
        <td><?=$row['proID']?></td>
        <td><?=$row['prname']?></td>
        <td><?=$row['proguige']?></td>
        <td><?=$row['proprice']?></td>
    </tr>
    <?php endforeach; ?>



</table>

<!-- 第三部 循环显示页码 -->
一共有<?=$pageCount?>条记录，每页放<?=$pageSize?>条记录，当前是第<?=$pageno?>页 <br>
【<a href="?pageno=1">首页</a>】
【<a href="?pageno=<?=$pageno-1?>">上一页</a>】
<?php for($i = 1; $i <= $pageCount; $i++):?>
    <a href="?pageno=<?=$i?>"><?=$i?></a>
<?php endfor; ?>
【<a href="?pageno=<?=$pageno+1?>">下一页</a>】
【<a href="?pageno=<?=$pageCount?>">末页</a>】
</body>
</html>