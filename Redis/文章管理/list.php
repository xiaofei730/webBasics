<?php
 
$redis = include __DIR__ . '/conn.php';

//文章列表key
$listKey = 'article:zset:id';

$bool = $redis->exists($key);

$data = $bool ? $redis->zRange($key, 0, -1) : [] ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章列表</title>
    <style>
        body{
            font-size: 14px;
        }
    </style>
</head>
<body>
<div>
    <a href="add.php">添加文章</a>
</div>
<div>
    <ul>
        <?php foreach($data as $item):
                $value = $redis->hgetall('article:id'.$item);
             ?>
        <li><?php echo $item.'-----------'.$value['title']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>