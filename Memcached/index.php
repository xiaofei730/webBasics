<?php


/**
 * 
 * Memcached
 * 
 * Free & open source, high-performance, distributed memory object caching system, generic in nature, but intended for use in speeding up dynamic web applications by alleviating database load.
 * 
 * Memcached is an in-memory key-value store for small chunks of arbitrary data (strings, objects) from results of database calls, API calls, or page rendering.
 * 
 * Memcached is simple yet powerful. Its simple design promotes quick deployment, ease of development, and solves many problems facing large data caches. Its API is available for most popular languages.
 * 
 * 
 * 缺点：
 *  数据没有永久保存，不能宕机或断电也不能重启服务，它的信息全部在内存当中，一但完成上述操作，数据将全部丢失
 * 
 * 使用场景：
 *  不重要且还很小很碎的数据，如登录成功后的session信息就可以存放memcached。
 * memcahced服务作为缓存使用，所以一般项目中读取数据使用它可以，写入或修改数据，几乎不用它
 * 
 * 
 * 2、应用图解
 * 减少数据库访问，提高web速度
 * 实质：不用去请求读取mysql，减少mysql的并发量和读写量
 * 
 * 3、与mysql进行比较
 * （1）与mysql一样是一个软件服务，需要启动服务
 * （2）mysql里面的数据，是存储到磁盘里面的，memcached里面的数据是存储到内存里面
 * （3）mysql使用表结构来存储数据，而memcached里面数据的存储是键值对（key=>value）;
 * 
 * 4、memcached中的一些参数限制
 * key原则
 * memcached的key的长不超过250字节，value大小限制为1M，默认端口号为11211；
 * 
 */



/**
 * 
 * 
 * 服务安装与启动
 * 
 * yum search memcached|grep ^memcached
 * 
 * yum install -y memcached.x86_64 memcached-devel.x86_64
 * 
 * 或者源码安装
 * 
 * 编译工作要提前安装好
 * 安装依赖
 * centos安装依赖所用的命令
 * yum install -y gcc gcc-c++ automake autoconf make cmake libevent-devel.x86_64
 * 
 * wget http://www.memcached.org/files/memcached-1.6.10.tar.gz
 * 源码安装memcached
 * tar zxf memcached.tar.gz
 * 
 * ccd memcached
 * ./configure --prefix=/usr/local/memcached
 * 
 * make && make install
 * 
 * 
 * 
 * 启动
 * memcached -n 16m -p 11211 -d -u root
 * 
 * -m 启动16兆内存   一个原则，指定的内存大小比物理内存小
 * -p  默认端口11211 
 * -d  启动守护进程
 * -u   指定用户
 * -c   指定连接数（并发数）
 * -l   是监听的服务器IP地址  127.0.0。1   0.0.0.0谁都可以访问
 * 
 * netstat -tunpl|grep 11211
 * 
 * telnet 127.0.0.1 11211
 * 
 * pkill memcached
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