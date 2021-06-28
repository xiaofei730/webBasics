<?php

/**
 * PDO介绍
 * 1、链接数据库方式
 * 方法一：mysql扩展【这种方式PHP7已经淘汰】
 * 方法二：mysqli扩展
 * 方法三：PDO扩展
 * 
 * 2、PDO（PHP Data Object）扩展为PHP访问各种数据库提供了一个轻量级，一致性的接口，无论访问什么数据库
 * 都可以通过一致性的接口去操作
 * 
 * 3、开启PDO扩展
 * 开启PDO链接Mysql扩展
 * extension=php_pdo_mysql.dll
 * 
 * 4、PDO核心类
 * （1）PDO类：表示PHP和数据库之间的一个连接
 * （2）PDOStatement类
 * 第一：表示数据查询语句(select, show)后的相关结果
 * 第二：预处理对象
 * （3）PDOException类：表示PDO的异常
 * 
 * 
 * 
 */

/**
 * 
 * 实例化PDO对象
 * 语法：
 * __construct($dsn, 用户名, 密码)
 * 
 * 1、DSN
 * DSN：data source name，数据源名称，包含的是连接数据库的信息，格式如下：
 * $dsn=数据库类型:host=主机地址;port=端口号;dbname=数据库名称;charset=字符集
 * 数据库类型
 * mysql数据库  =>mysql；
 * oracle数据库 => oci;
 * SQL server =>sqlsrv;
 * 
 * 
 * 2、实例化PDO
 * 实例话PDO的过程就是连接数据库的过程
 * $dsn = 'mysql:host=localhost;port=3306;dbname=data;charset=utf8';
 * $pdo = new PDO($dsn, 'root', 'root');
 * var_dump($pdo);
 * 
 * 
 * 
 * 3、注意事项
 * （1）如果连接的是本地数据库，host可以省略
 * dsn = 'mysql:port=3306;dbname=data;charset=utf8';
 * 
 * 
 * （2）如果使用的是3306端口，port可以省略
 * dsn = 'mysql:dbname=data;charset=utf8';
 * 
 * （3）charset也可以省略，如果省略，使用的是默认字符编码
 * dsn = 'mysql:dbname=data';
 * 
 * （4）dbname也可以省略，如果省略就没有选择数据库
 * dsn = 'mysql:';
 * 
 * （5）host、port、dbname、charset不区分大小写，没有先后顺序
 * 
 * （6）驱动名称不能省略，冒号不能省略（因为冒号是驱动组成部分），数据库驱动只能小写
 * 
 *          
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */










