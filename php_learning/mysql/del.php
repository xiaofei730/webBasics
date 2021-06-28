<?php

require './inc/conn.php';

$sql = "delete from news where id={$_GET['id']}";

if ($mysqli->query($sql)) {
    header('location:./list.php');
} else {
    echo '删除失败';
}
