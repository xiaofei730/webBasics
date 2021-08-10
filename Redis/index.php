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
 * 返回所有key对应的field字段
 * hkeys key
 * 
 * 返回所有key对应的field字段对应的值
 * hvals key
 * 
 * 
 */


/**
 * 集合（set）操作命令
 * 
 * redis的set是无序集合。集合里不允许有重复的元素
 * 
 * set元素最大可以包含（2的32次方-1）个元素
 * 
 * Redis 集合中所有元素都是互异的，即任意一个元素都是唯一的，当我们尝试向集合中添加相同元素时，会忽略后续添加的值，
 * 
 * 场景：存放用户id，不重复的信息   抽奖，好友关系 
 * 
 * 想集合key中添加元素
 * 
 * sadd key value1 value2
 * 
 * 
 * 返回key集合中所有的元素
 * smembers key
 * 
 * 返回key集合中元素的个数
 * scard key
 * 
 * 删除key集合中为value1的元素
 * srem key value1
 * 
 * 随机删除key集合中的一个元素并返回
 * spop key
 * 
 * 
 * 判断value是否存在于key集合中
 * sismember key value
 * 
 * 把源集合中value删除，并添加到目标集合中（移动）
 * smove sSet dSet value
 * 
 * 求出key1，key2两个集合的交集，并返回
 * sinter key1 key2
 * 求出key1，key2的两个集合的并集，并返回
 * sunion key1 key2
 * 
 * 求出key1 与key2 的差集
 * sdiff key1 key2  以key1集合为主，求出key1中和key2不同的元素并返回
 * 
 * 
 * 有序集合（zset）操作命令
 * 和set一样有序集合，元素不允许重复，不同的是每个元素都会关联一个分值。
 * 可以通过它的分值来进行排序。如实现手机APP市场的软件排名等需求的实现
 * 
 * 给key有序集合中添加元素
 * zadd key score（分值） value
 * 
 * 删除key有序集合中指定的元素
 * zrem key value1
 * 
 * 返回有序集合中，指定区间位置内的成员
 * zrange key start end [withscores]        //从小到大排列
 * zrevrange key start end [widthscores]        //从大到小排列
 * 
 * 按照分值来删除元素，删除score 在min<=score<=max之间的
 * zremrangebyscore key min max
 * 
 * 返回集合的个数
 * zcard key
 * 
 * 返回min<=score<=max分值区间元素的数量
 * zcount key minScore maxScore
 * 
 * 
 * 返回有序集合中，成员的分数值
 * zscore key value
 * 
 * 对有序集合中指定成员的分数加上增量  把value的分数+score值
 * zincrby key score 元素
 * 
 * 
 * 
 * 
 */


/**
 * 
 * 发布与订阅
 * 
 * Redis 发布订阅（publish/subscribe）是一种消息通信模式
 * 发送者（publish）发送消息，订阅者（subscribe）订阅后接受频道消息
 * 
 * 
 * 订阅频道
 * subscribe 频道1[,频道2..]
 * 支持通配符
 * psubscribe 名称*
 * 
 * 
 * 发布频道
 * publish 频道 发送消息
 * 
 * 
 */


/**
 * 
 * 数据持久化操作
 * 
 * 数据持久化就是在服务重启或服务器重启后数据不丢失。实现持久化，就需要把数据
 * 存储到磁盘中
 * 
 * Redis的持久化有2种方式
 * （1）快照（rdb）默认开启
 * （2）aof日志方式（需要手动开启）
 * 两种持久化的机制不相同，rdb在某一个时间点把内存中的数据整体保存下来。aof是把用户
 * 操作的命令全部记录下来。记录全部命令会对性能有一定的损耗，所以默认redis就没有开启，
 * 有条件化建议开启
 * 
 * 
 * rdb快照
 * 
 * 相关配置选项 vi /usr/local/redis/redis.conf
 * 
 *      秒      命令次数
 * save 500     1           //500秒内，有1条写入，则产生快照
 * save 300     10          //300秒内，有10次写入，则产生快照
 * save 60      10000           //60秒内有10000次写入，则产生快照
 * 
 * dbfilename dump.rdb      //导出来rdb的默认文件名
 * dir ./       //持久化文件存放路径
 * 
 * 使用redis提供的压测命令来生成10001个key
 * ./bin/redis-benchmark -n 10001
 * 
 * 
 * aof日志持久化
 * 
 * 相关配置 vi /usr/local/redis/redis.conf
 * 
 * appendonly no        #是否打开aof日志功能no不打开，yes打开
 * 
 * #appendfsync always          #每一个命令，都立即同步到aof，安全，速度慢
 * appendfsync everysec         //推荐方案，每秒写一次
 * #appendfsync no              //写入工作交给操作系统，数据同步性没有保证，同步频率低，速度快
 * 
 * 
 * 
 */



/**
 * 
 * Redis中的事务
 * 
 * Redis支持简单的事务，事务就是：当同一个操作需要多条命令执行，一条执行有误，
 * 其它操作回滚到之前的状态
 * 
 * 例如：银行转账工作，从一个账号扣款并在另一个账户增款，要么都执行，要么都不执行
 * 
 * 执行的步骤
 * 开始事务
 * 命令入列
 * 执行事务
 * 
 * Redis事务实现
 * 
 * watch key1 key2      //监听key的变化
 * muti     //事务开始
 *  普通命令（string list hash set zset中的命令）
 * exec  //执行/    discard  //取消     exec和discard两个只能执行一个
 * unwatch      //解除监听
 * 
 * 如果执行的命令没有错，只是业务有问题则不会自动回滚，会执行可以操作的队列中的命令
 * 如果命令有错，则自动回滚
 * 
 * 
 * key的监听
 * 
 * 
 */


/**
 * Redis密码安全
 * 
 * IP限制
 * vi /usr/local/redis/etc/redis.conf  文件来通过配置文件限制IP访问，多个ip用空格隔开
 * 
 * bind  0.0.0.0
 * 
 * 密码
 * requirepass admin
 * 
 * 重启redis服务，测试
 * 
 * 使用auth 操作登录
 * 
 */


/**
 * 
 * Redis主从设置
 * 
 * 当数据量变得庞大的时候，读写分离还是很有必要的。redis提供了主从复制的机制
 * 从服务器可以复制主服务器的数据信息，就可以实现读写分离，从而降低单台服务器的压力
 * 
 * 1、主服务器配置
 * 开启rdb和aof日志记录，还有密码认证登录
 * 
 * 2、从服务器
 * 使用端口模拟服务器
 * 首先复制redis.conf  文件2个
 * cp redis.conf redis6380.conf
 * cp redis.conf redis6381.conf
 * 
 * 修改端口
 * port 6380
 * 
 * 修改pid文件
 * pidfile /var/run/redis_6380.pid
 * 
 * 修改rdb文件名称
 * 
 * 设置从服务器中连接主服务器IP和端口号
 * replicaof 127.0.0.1 6379
 * 
 * 
 * 设置主服务器连接口令
 * masterauth admin123
 * 
 * 关闭aof
 * 
 * 
 * vi /usr/local/redis/etc/redis6781.conf
 * 修改从那个主服务器中复制数据
 * 
 * 
 * 
 * 
 */



/**
 * 
 * PHP操作Redis
 * 
 *   Linux下安装redis扩展
 * 
 * 
 * （1）yum安装php所支持的扩展
 * yum search redis|grep ^php
 * 
 * （2）使用源码来安装，在php官网上下载对应的redis扩展源码
 * http://pecl.php.net/package/redis
 * 
 * $ wget https://pecl.php.net/get/redis-5.3.4.tgz
 * $ tar xzf redis-6.2.5.tar.gz
 * $ cd redis-6.2.5
 * $ make
 * 
 * 实例化redis对象
 * $redis = new Redis();
 * 
 * //连接redis
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


















