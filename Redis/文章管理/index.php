<?php

/**
 * 
 * 文章管理
 * 
 * 1、项目需求
 * 
 * 后台：
 * 用户登录，登录成功后要有发送邮件功能（异常发送）
 * 
 * 文章管理：
 * 文章列表、添加文章、修改文章、删除文章
 * 
 * 前台
 * 热门文章推荐
 * 
 * 数据保存的数据库为redis
 * 
 * 2、用户登录与邮件发送
 * 用户表key设计
 * 账号、密码
 * 
 * 
 * 3、设计文章key
 * 列表 zset crc32
 * 记录  hash
 * id  string
 * 
 * article:id        string  key
 * article:id:1     字段 
 * 
 * 以ID来排序
 * article:zset:id
 * 
 * 4、消费队列发邮件
 * 安装发送邮件类库  phpmailer
 * 
 * composer require phpmailer/phpmailer
 * 
 * 
 * 
 */