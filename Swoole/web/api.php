<?php

var_dump($_GET);

$arr = [ 'id' => 1, 'name' => '张三'];


echo json_encode($arr, JSON_UNESCAPED_UNICODE);
