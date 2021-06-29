<?php

try {

    $dsn = 'mysql:host=localhost;port=3306;dbname=data;charset=utf8';
    $pdo = new PDO($dsn, 'root', 'root');
    //这是PDO错误模式属性，PDO自动抛出异常
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->query('select * from newsss');
} catch (PDOException $ex) {
    echo '错误信息'.$ex->getMessge(),'<br>';
    echo '错误文件'.$ex->getFile(),'<br>';
    echo '错误行号'.$ex->getLine(),'<br>';
}

/**
 * 
 * 小结：
 * 1、PDOException是PDO的异常类
 * 2、实例化PDO会自动抛出异常
 * 3、其他操作不会抛出异常，需要设置PDO的异常模式
 * 
 * 4、PDO异常模式
 * PDO::ERRMODE_EXCEPTION       抛出异常
 * PDO::ERRMODE_SILENT          中断
 * PDO::ERRMODE_WARNING         警告
 * 
 */








