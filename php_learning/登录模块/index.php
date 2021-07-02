<?php

/**
 * 登录模块
 * 
 * 
 * 1、
 * drop table if exists `user`;
 * create table `user` {
 *  user_id smallint unsigned auto_increment primary key comment '主键',
 *  user_name varchar(20) not null comment '用户名',
 *  user_pwd char(32) nut null comment '密码',
 *  user_face varchar(50) comment '头像',
 *  user_login_ip int comment '最后登录的IP',
 *  user_login_time int unsigned comment '最后登录的时间',
 *  user_login_count smallint unsigned comment '登录次数',
 *  is_admin tinyint default 0 comment '超级管理员'
 * }engine=innodb charset=utf8 comment '用户表';
 * 
 * //IP和整型转换
 * $ip = '153.152.56.123';
 * echo ip2long($ip),'<br>';
 * echo long2ip(-1718077317);
 * 
 * 注意：
 * 在HTML中路径要使用绝对路径，从根目录开始匹配
 * 在CSS页面图片的路径要使用相对路径，相对于当前页面本身
 * 
 * 
 * 
 * 多学一招：md5是单向加密，md5解密是数据字典实现的
 * 
 * 
 * 2、防止SQL注入
 * 
 * 通过输入的字符串和SQL语句拼成具有其他含义的语句，以达到攻击的目的
 * 
 * 登录名输入 'or 1=1 or'
 * 
 * 原理
 * 
 * select * from `user` where user_name='' and user_pwd='';
 * 插入'or 1=1 or'
 * select * from `user` where user_name='' or 1=1 or '' and user_pwd='';
 * select * from `user` where user_name='' or 1=1 -- '' and user_pwd='';
 * select * from `user` where user_name='' or 1 # '' and user_pwd='';
 * 
 * 防范措施
 * （1）给特殊字符添加转义
 * echo addslashes("aa'bb'"),'<br>';        //aa\'bb\'
 * 
 * （2）将单引号替换为空
 * str_replace("'", '', "aa'bb'");          //aabb
 * 
 * 
 * （3）md5加密
 * 
 * （4）预处理
 * select * from `user` where user_name=？ and user_pwd=？;
 * 
 * 
 * （5）如果确定传递的参数是整数，就需要进行强制类型转换
 * //通过union修改查询数据，参数需要强制转换成整数
 * select * from products where proid=20 union select * from products;
 * 
 * 
 * 3、防止翻墙
 * 通过直接在地址栏输入URL地址进入模板页面
 * 
 * 解决：用户登录成功以后，给用户一个令牌（session），在整个访问的过程中，令牌不消失
 * 
 * 
 * 
 * 
 */