<?php

/**
 * 
 * Session(会话)
 * 
 * 1、原理
 * （1）session是服务端的技术
 * （2）session是基于cookie技术的
 * 
 * 第一次访问，服务器给客户分配一个空间，每个空间都有一个唯一的编号，比如A11
 * 将编号（A11）放到响应头带回客户端，保存在cookie中
 * 
 * 自己只能访问自己的session
 * 
 * 
 * 
 * 
 * 
 * 2、session操作
 * （1）默认情况下，会话不会自动开启，通过session_start()开启会话
 * （2）通过session_id()获取会话编号
 * （3）通过$_SESSION操作会话
 * （4）会话可以保存除了资源以外的所有类型
 * （5）重复开启会话会报错，一般出现在包含文件中
 * 
 * session_start();
 * @session_start();        重复开启会话会报错，可以通过错误抑制符来屏蔽错误，加@可以屏蔽报错
 * $_SESSION['name'] = 'tom';
 * $_SESSION['age'] = 20;
 * 
 * echo $_SESSION['name'],'<br>';
 * echo $_SESSION['age'],'<br>';
 * echo '会话编号：'.session_id();
 * 
 * 
 * 3、与会话有关的配置
 * 在php.ini文件
 * 重要：
 * （1）session_save_path = "F:\wamp\tmp"       session保存的地址
 * （2）session_auto_start = 1          session自动开启，默认不自动开启
 * （3）session.save_handler = files            会话以文件的形式保存
 * （4）session.gc_maxlifetime = 1440           会话的生命周期是1440秒
 * 
 * 了解
 * （1）session.name = PHPSESSID
 * （2）session.cookie_lifetime = 0     会话编号过期时间
 * （3）session.cookie_path = /         会话编号整站有效
 * （4）session.cookie_domain =             会话编号在当前域名下有效
 * 
 * 
 * 
 * 4、销毁会话
 * 通过session_destroy()销毁会话
 * 销毁会话就是删除自己的会话文件
 * session_start()
 * session_destroy()
 * 
 * 
 * 5、垃圾回收
 * （1）会话文件超过了生命周期是垃圾文件
 * （2）PHP自动进行垃圾回收
 * （3）垃圾回收的概率默认是1/1000
 * session.gc_probability = 1;
 * session.gc_divisor = 1000;
 * 
 * 6、session和cookie的区别
 * 
 *                  cookie              session
 * 保存位置        客户端               服务端
 * 数据大小         小（4K）                  大
 * 数据类型         字符串              除了资源以外的所有类型
 * 安全性           不安全              安全
 * 
 * 
 * 
 * 7、禁用cookie对session的影响
 * session是基于cookie的，如果禁用cookie，session无法使用
 * 
 * 
 * 解决：
 * 默认情况下，session只依赖于cookie，session的编号只能通过cookie传输
 * 可以设置为session不仅仅依赖于cookie
 * 
 * session.use_only_cookies = 0;            //session 不仅仅依赖于cookie
 * session.use_trans_sid = 1;               //允许通过其他方式传递session_id
 * 
 * 设置后，PHP自动添加get和post传递session_id
 * 
 * 
 * 
 * 
 */


/**
 * 
 * session入库
 * 
 * session默认情况下存储到文件中，我们可以将session存储到数据库中
 * 
 * 
 * 1、创建sess表
 * sess_value如果使用了text类型就不能使用memory
 * drop table if exists sess;
 * create table sess{
 *  sess_id varchar(50) primary key comment '会话编号',
 *  sess_value text comment '会话值',
 *  sess_time int unsigned not null comment '会话产生时间'
 * }engine=innodb charset=utf8 comment '会话表';
 * 
 * 
 * 
 * memory引擎数据存储在内存中
 * drop table if exists sess;
 * create table sess{
 *  sess_id varchar(50) primary key comment '会话编号',
 *  sess_value varchar(2000) comment '会话值',
 *  sess_time int unsigned not null comment '会话产生时间'
 * }engine=memory charset=utf8 comment '会话表';
 * 
 * memory注意事项
 * （1）memory引擎数据存储在内存中，速度快，但是重启服务后数据情况
 * （2）memory引擎中的字段不可以是text类型
 * 
 * 
 * 2、更改会话存储（session入库）
 * （1）知识点
 * 
 * //打开会话
 * function open()
 * {
 *      echo 'open','<br>';
 *      global $link;
 *      $link = mysqli_connect('localhost', 'root', 'root', 'data');
 *      mysqlo_set_charset($link, 'utf8');
 *      return true;
 * }
 * 
 * //关闭会话
 * function close()
 * {
 *      echo 'close','<br>';
 * 
 *      return true;
 * }
 * 
 * //读取会话
 * function read($sess_id)
 * {
 *      global $link;
 *      $sql = "select sess_value from sess where sess_id=$sess_id";
 *      $rs = mysqli_query($link, $sql);
 *      $rows = mysqli_fetch_row($rs);
 *      
 *      echo 'read','<br>';
 *      return (string)$rows[0];
 * }
 * 
 * //写入会话
 * function write($sess_id, $sess_value)  
 * {
 *      global $link;
 *      $sql = "insert into sess values ('$sess_id', 'sess_value', unix_timestamp()) on duplicate key update sess_value='$sess_value',sess_time=unix_timestamp()  ";
 * 
 *      echo 'write','<br>';
 *      return mysqli_query($link, $sql);
 * }
 * 
 * //销毁会话
 * function destroy($sess_id)
 * {
 *      global $link;
 *      $sql = "delete from sess where sess_id='$sess_id'";
 *      return mysqli_query($sql);
 * }
 * 
 * //垃圾回收 
 * function gc($lifetime)
 * {
 *      global $link; 
 *      $expires = time() - $lifetime;       //过期时间点
 *      $sql = "delete from sess where sess_time<$expires";
 * 
 *      return mysqli_query($sql);
 * }
 * 
 * //更改会话存储
 * session_set_save_handler('open', 'close', 'read', 'write', 'destroy', 'gc');
 * session_start();
 * session_destroy();
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */








