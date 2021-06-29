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
 */


/**
 * 
 * 使用PDO
 * 1、执行数据操作语句
 * 方法：$pdo->exec($sql),执行数据增、删、改语句，执行成功返回数影响的记录数，如果SQL语句错误返回false
 * 
 * 实例化PDO
 * $dsn = 'mysql:host=localhost;port=3306;dbname=data;charset=utf8';
 * $pdo = new PDO($dsn, 'root', 'root');
 * 
 * 执行数据操作语句
 * 执行增加
 * if($pdo->exec("insert into news value (null, 'bb', 'bbbbbb', unix_timestamp())");)
 *  echo '自动增长的编号是：',$pdo->lastInsertId(),'<br>';
 * 
 * 执行修改
 * echo $pdo->exec("update news set title='静夜思' where id in (3, 4)");
 * 
 * 执行删除
 * 
 * echo $pdo->exec("delete from news where id=5");
 * 
 * 完善
 * $sql = "";
 * $rs = $pdo->exec($sql);
 * if($rs) {
 *      echo "SQL语句执行成功<br>";
 *      if(substr($sql, 0, 6) == 'insert') {
 *          echo '自动增长的编号是：',$pdo->lastInsertId(),'<br>';
 *      } else {
 *          echo '受到影响的记录数是：'.$rs,'<br>';
 *     }
 * } elseif ($rs === 0) {
 *      echo '数据没有变化<br>';
 * } elseif($rs === false) {
 *     echo 'SQL语句执行失败<br>';
 *      echo '错误编号：'.$pdo->errorCode(),'<br>';
 *      var_dump($pdo->errorInfo());
 *      echo '错误信息：'.$pdo->errorInfo()[2];
 * }
 * 
 * 2、执行查询语句
 * 方法：$pdo->query($sql),返回的是PDOStatement对象
 * 
 * $dsn = 'mysql:host=localhost;port=3306;dbname=data;charset=utf8';
 * $pdo = new PDO($dsn, 'root', 'root');
 * 
 * 执行查询语句
 * $stmt = $pdo->query('select * from products');
 * 
 * 2、获取数据
 * 获取二维数组
 * $rs = $stmt->fetchAll();     默认是关联和索引数组
 * 
 * $rs = $stmt->fetchAll(PDO::FETCH_BOTH);  返回关联和索引数组
 * $rs = $stmt->fetchAll(PDO::FETCH_NUM);       返回索引数组
 * $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);     返回关联数组
 * rs = $stmt->fetchAll(PDO::FETCH_OBJ);     返回对象数组
 * 
 * echo '<pre>';
 * var_dump($rs);
 * 
 * 获取一维数组
 * 
 * $rs = $stmt->fetch();        关联和索引数组
 * $rs = $stmt->fetch(PDO::FETCH_NUM);       索引数组
 * 
 *  通过while循环获取所有数据
 * while($row = $stmt->fecth(PDO::FETCH_ASSOC)) {
 *      $rs[] = $row;
 * }
 * echo '<pre>';
 * var_dump($rs);
 * 
 * 匹配列:匹配当前行的第n列，列的编号从0开始，匹配完毕指针下移一条
 * 
 * echo $stmt->fetchColumn();   获取当前行的第0列（指针会下移）
 * 
 * echo $stmt->fetchColumn(1);   获取当前行的第1列
 * 
 * 
 * 总行数、总列数
 * echo '总行数：'.$stmt->rowCount(),'<br>';
 * echo '总列数：'.$stmt->columnCount(),'<br>';
 * 
 * stdClass类是所有PHP类的父类
 * 
 * 遍历PDOStatement对象(PDOStatement对象是迭代器)
 * foreach($stmt as $row) {
 *  echo $row['proname'],'-',$row['proprice'],'<br>';
 * }
 * 
 * 
 * 3、PDO操作事务
 * 事务：是一个整体，要么一起执行，要么一起回滚
 * 事务的特性：原子性，一致性，隔离性，永久性
 * 需要将多个SQL语句作为一个整体执行，就需要使用到事务
 * 语法：
 * start transaction  或 begin      开启事务
 * commit   提交事务
 * callback     回滚事务
 * 
 * create table bank{
 *      cardid char(4) primary key comment '卡号',
 *      balance decimal(10, 2)  not null comment '余额'
 * }
 * insert into bank values ('1001', 1000),('1002', 1);
 * 
 * 
 * 4、PDO操作预处理
 * 复现MYSQL中预处理
 * 预处理好处：编译一次多次执行，用来解决一条SQL语句多次执行的问题，提高列执行效率
 * 
 * 预处理语句：
 * prepare 预处理名字 from 'sql语句';
 * 
 * 执行预处理
 * execute 预处理名字 [using 变量];
 * 
 *  PDO中的预处理---位置占位符
 * 
 * 
 * $dsn = 'mysql:host=localhost;port=3306;dbname=data;charset=utf8';
 * $pdo = new PDO($dsn, 'root', 'root');
 * 
 * 创建预处理对象
 * $stmt = $pdo->prepare("insert into bank values (?,?)");  ?是占位符
 * 
 * 
 * $cards = [['1003', 500], ['1004', 100]]
 *      
 * foreach($cards as $card) {
 * 
 *      //绑定参数，并执行预处理 方法一：
 *      $stmt->bindParam(1, $card[0]);   //占位符位置从1开始
 *      $stmt->bindParam(2, $card[1]);
 *      $stmt->execute();               //执行预处理
 * 
 *      方法二：
 * 
 *      $stmt->bindValue(1, $card[0]);
 *      $stmt->bindValue(2, $card[1]);
 *      $stmt->execute();
 *  
 *      方法三：如果占位符的顺序和数组的顺序一致，可以直接传递数组
 *      $stmt->execute($card);
 *      
 * }
 * 
 * 
 * 
 * PDO中的预处理---参数占位符
 * 
 * 创建预处理对象
 * $stmt = $pdo->prepare("insert into bank values (:p1,:p2)");  :p1,:p2是参数占位符
 * 
 * 
 * $cards = [['p1'=>'1003', 'p2'=>500], ['p1'=>'1004', 'p2'=>100]]
 *      
 * foreach($cards as $card) {
 * 
 *      //绑定参数，并执行预处理 方法一：
 *      $stmt->bindParam(:p1, $card[0]);   //占位符位置从1开始
 *      $stmt->bindParam(:p2, $card[1]);
 *      $stmt->execute();               //执行预处理
 * 
 *      方法二：
 * 
 *      $stmt->bindValue(:p1, $card[0]);
 *      $stmt->bindValue(:p2, $card[1]);
 *      $stmt->execute();
 *  
 *      方法三：如果数组的下标和参数名一致的时候可以直接传递关联数组
 *      $stmt->execute($card);
 *      
 * }
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 小结：
 * （1）?是位置占位符
 * （2）参数占位符以冒号开头
 * （3）$stmt->bindParam()和$stmt->bindValue()区别
 *   $stmt->bindParam()只能绑定变量
 *  $stmt->bindValue()可以绑定变量，也可以绑定值
 * （4）预处理的好处
 * 提高执行效率
 * 提高安全性
 * 
 * 
 * 
 * 
 * 
 */










