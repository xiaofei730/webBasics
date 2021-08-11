<?php

$redis = include __DIR__ . '/conn.php';

if ($_POST['title']) {
    //自动增长key
    $idkey = 'article:id';

    //自增长
    $id = $redis->incr($idkey) ;

    //文章列表key
    $listKey = 'article:zset:id';


    //hash的key
    $hashKey = 'article:id'.$id;

    //向hash中写数据
    $post = $_POST;
    $post['id'] = $id;

    $redis->hmset($hashKey, $_POST);

    //向有序集合中写一条记录
    $redis->zAdd($listKey, $id, $id);

    //跳转到列表页
    header('location:list.php');
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加文章</title>
</head>
<body>
    <form method="post">
        <div>
            <input type="text" name="title" autocomplete="off">
        </div>
        <div>
            <input type="text" name="desn" autocomplete="off">
        </div>
        <div>
            <input type="submint" value="添加文章">
        </div>
    </form>
</body>
</html>




