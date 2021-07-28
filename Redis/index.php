<?php


/**
 * Redis
 * 
 * 简介
 * 
 * Redis 是由意大利开发者 Salvatore Sanfilippo（antirez）通过 C 语言开发的、基于内存的、可持久化的开源键值对存储数据库（英文全称是 REmote DIctionary Server，中文译作远程字典服务器），
 * 由于其简单易用、高性能、支持丰富的数据结构和原子操作，已逐渐成为目前互联网最流行的存储中间件解决方案，
 * 被广泛应用于缓存、NoSQL、消息队列等技术领域。
 * 
 * Redis是一个单进程单线程，非阻塞I/O
 * 
 * Redis 目前支持的数据结构包含以下五种：
 * String：字符串
 * List：列表
 * Set：集合
 * SortedSet：有序集合
 * Hash：哈希字典
 * 
 * 
 * redis和memcache区别
 * 
 * （1）redis支持数据的持久化，而memcache不支持
 * （2）redis不但有string类型的key-value还有更多的数据结构存储，而memcache则只有string类型的key和value
 * （3）memcache 的集群很弱，而redis支持主从集群
 * （4）端口不同memcache 11211 redis 6379       
 * 
 * 1、Linux下安装redis服务
 * 
 * 官方地址：https://redis.io/
 * 
 * 下载
 * wget http://download.redis.io/releases/redis-5.0.5.tar.gz
 * 解压
 * tar zxf redis-5.0.5.tar.gz
 * 进入解压后目录
 * cd redis-5.0.5
 * 编译
 * make
 * 安装
 * make PREFIX=/usr/local/redis install (注意：PREFIX指定安装后软件所在位置，注意必须大写)
 * 
 * 
 * 在安装的源码包中复制redis.conf文件到安装目录下面新建etc目录下面
 * mkdir /usr/local/redis/etc
 * cp /src/redis-5.05/redis.conf /usr/local/redis/etc/
 * 
 * 
 * 
 * 2、启动
 * cd /usr/local/redis
 * /usr/local/redis/bin/redis-server /usr/local/redis/etc/redis.conf
 * 
 * 后台守护(以后台运行的方式来启动redis)
 * vi etc/redis.conf
 * daemonize yes
 * 
 * 查看端口
 * netstat -tunpl|grep 6379
 * 
 * 查看进程
 * ps -ef|grep redis
 * 
 * 关闭
 * pkill redis
 * 
 * 
 * 3、客户端链接
 * 
 * 命令行工具连接
 * /usr/local/redis/bin/redis-cli -h xxx -p xxx
 * 
 * 图形工具连接
 * 连接失败的原因
 * （1）远程服务器防火墙拦截
 * （2）启动服务是指定连接的IP
 * vi etc/redis.conf
 * 
 * bind 127.0.0.1改为 bind 0.0.0.0
 * 
 * 
 * 
 */



/**
 * 
 * 数据结构类型操作
 * 
 * Redis 目前支持的数据结构包含以下五种：
 * String：字符串
 * List：列表
 * Set：集合
 * SortedSet：有序集合
 * Hash：哈希字典
 * 
 * 1、Redis对key的操作命令
 * （1）查找所有符合给定模式的key
 * keys 查询相应的key或通配符（*）
 * 
 * （2）用于检查指定key是否存在 返回0/1
 * exists key
 * 
 * （3）查看当前数据库中设置key的数量
 * 
 * dbsize
 * 
 * （4）清除当前数据库中的数据
 * flushdb
 * 
 * （5）切换数据库
 * select N
 * 
 * （6）清除所有数据库中的数据
 * flushall
 * 
 * 注意：flushdb还是flushall两个尽量不要用，知道就行，在开发时可以用用，上线一定不用
 * 
 * 2、字符串（string）操作命令
 * 用于设置给定key的值，如果可以已经存储其他值，SET就覆写旧值，且无视类型
 * set key value [ex 秒数]/[px 毫秒数] [nx]/[xx]
 * 
 * 注意后两个参数一般不写
 * 
 * ex/px 缓存有效期 ex
 * nx：表示key不存在时，执行添加操作，存在，添加失败（锁）
 * xx：表示key存在时，则修改，不存在，执行添加操作，默认
 * 
 * 
 * 
 * set id 100
 * set name zhang san ex 10
 * 
 * ttl id
 * 查看类型
 * type id
 * 
 * 设置key有效期
 * expire name 300
 * 
 * 
 * 用于获取指定指定key的值，如果key不存在，返回nil，如果key储存的值不是字符串类型，返回一个错误
 * get key
 * 
 * 
 * 一次性设置多个键值
 * mset key1 value1 key2 value2...
 * 
 * mset id 1 age 20 name zhangsan
 * 
 * 一次性获取多个key的值
 * mget key1 key2 key3...
 * 
 * mget id age name
 * 
 * 自增与自减
 * 
 * incr key         //自增      每次自增1
 * decr key         //自减      每次自减1
 * incrby key step      //指定步长的自增  可为负数
 * decrby key step      //指定步长的自减
 * 
 * 
 * 把value追加到key的原值上
 * append key value
 * 
 * 设置新值同步返回旧值
 * getset key newValue
 * 
 * 
 * 
 */


/**
 * 
 * 列表（list）操作命令
 * 类似PHP中的索引数组，列表中的值是可以重复的。可以用列表来实现简单的队列
 * 可以实现先进后出，还可以实现先进先出
 * 
 * 把值插入到列表的头部（左边）
 * lpush key value
 * 
 * 从列表右边（尾部）删除元素，并返回删除的元素值
 * rpop key
 * 
 * 获取列表的长度
 * llen key
 * 
 * 返回指定区间内的元素，下标从0开始
 * lrange key startIndex endIndex
 * 注：默认从左开始向右获取指定索引的值，从右开始负数开始，-1就是右边第一个元素
 * 
 * 从尾部添加
 * rpush key value
 * 
 * 从头部删除元素并返回删除元素
 * lpop key
 * 
 * 移除列表的最后一个元素，并将元素添加到另一个列表并返回
 * rpoplpsuh mylist otherlist
 * 
 * 
 * 
 */





/**
 * 
 * 
 * 哈希（hash）操作命令
 * 
 * 类似于PHP的关联数组。一般用于存储数据库中一条记录值
 * 
 * 
 * 关于hash的key的起名称：一般和数据表关联
 * 表名：主键字段名：id值   user：id：1 hash的key值
 * 
 * 把key中field字段的值设置为value，如果没有field字段，直接添加，如果有，则覆盖员field字段的值
 * 
 * hset key field value
 * 
 * 一次性设置多个
 * hmset key field1 value1 field2 <value2 class=""></value2>
 * 
 * 
 * 
 * 获取key中指定field字段的值
 * hget key field
 * 
 * 一次性获取多个key中field字段的值
 * hmget key field1 field2...
 * 
 * 删除可以中指定的field字段
 * hdel key field
 * 
 * 获取key中的所有字段
 * hgetall key
 *  
 * 
 * 返回key中元素的数量
 * hlen key
 * 
 * 判断key中有没有field字段
 * hexists key field
 * 
 * 把key中field字段的值自增长
 * hincrby key field step   步长可以为负数
 * 
 * 
 * 
 * 
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


















