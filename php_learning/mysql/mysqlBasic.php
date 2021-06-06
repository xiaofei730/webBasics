<?php
/**
 * 命令行连接
 * host         -h      主机
 * port         -p      端口号
 * user         -u      用户名
 * password     -p      密码
 * 
 * 例如：mysql -h127.0.0.1 -p3306 -uroot -proot
 * 
 * 如果连接本地数据库    -h可以升入 如果服务器端口是3306，端口号也可以省略
 * mysql -uroot -proot          明文
 * 
 * mysql -uroot -p   密文
 */

/**
 * 退出登录
 * 
 * quit
 * exit
 * q
 */


/**
 * 数据库基本概念
 * 
 * 1、数据库：数据库中存放的是表，一个数据库中可以存放多个表
 * 2、表：表是用来存放数据的
 * 3、关系：两个表的公共字段
 * 4、行：也称记录，也称实体
 * 5、列：也称字段，也称属性
 * 
 * 脚下留心：
 * 就表结构而言，表分为行和列；
 * 就表数据而言，表分为记录和字段；
 * 就面向对象而言，一个记录就是一个实体，一个字段就是一个属性
 */

/**
 * 数据相关
 * 1、数据冗余：相同的数据存储在不同的地方（分表）
 * 冗余只能减少，不能杜绝
 * 
 * 2、数据完整性  （正确性+准确性）
 * 正确性：数据类型正确
 * 准确性：数据范围要准确
 * 
 * 学生年龄是整型，输入1000岁，正确性和准确性如何？
 * 正确，但是不准确，失去了数据的完整性
 */


/**
 * 创建数据库
 * create database stu;  
 * 
 * create database if not exists stu;
 * 
 * //创建特殊字符、关键字做数据库名，使用反引号将数据库名括起来
 * create database `create`;
 * 
 * create database `%$`;
 * 
 * //创建数据库时指定存储的字符编码
 * create database emp charset=gbk;
 */

/**
 * Mysql数据库的目录
 * 数据库保存的路径在安装mysql的时候就配置好
 * 也可以在my.ini配置文件中修改数据库的保存地址
 * 一个数据库就对应一个文件夹，在文件夹中有一个db.opt文件，在此文件中设置数据库的字符集和校对集
 */

/**
 * 删除数据库
 * drop database 数据库名
 */

/**
 * 显示创建数据库的语句
 * 
 * show create database emp
 */

/**
 * 修改数据库
 * 
 * alter database emp charset=utf8
 * 1、修改数据库只能修改数据库的字符编码
 * 2、在Mysql中utf字符编码之间没有横杆 utf8
 */

/**
 * 选择数据库
 * 
 * use 数据库名
 */


/***
 * 创建表
 * 
 * create table if not exists '表名' ( '字段名' 数据类型 [null|not null] [default] [auto_increment] [primary key] [comment], '字段名' 数据类型...) [engine=存储引擎] [charset=字符编码]
 * 
 * null|not null        是否为空
 * default              默认值
 * auto_increment       自动增长，默认从1开始，每次递增1
 * primary key          主键，主键的值不能重复，不能为空，每个表必须只能有一个主键
 * comment              备注
 * engine               引擎决定了数据的存储和查找  myisam、innodb
 * 
 * 脚下留心：表名和字段名如果用了关键字，要用反引号引起来
 * 
 * 例子：
 * create table stu( id int auto_increment primary key, name varchar(20) not null )engine=innodb charset=gbk;
 * 
 * 1、如果不指定引擎，默认是innodb
 * 2、如果不指定字符编码，默认和数据库编码一致
 * 
 * 
 * 数据表的文件
 * 一个数据库对应一个文件夹
 * 一个表对应一个或多个文件
 * 引擎是myisam,一个表对应三个文件
 * .frm     ：存储的是表结构
 * .myd     ：存储的是表数据
 * .myi     ：存储的表数据的索引
 * 
 * 引擎是innodb,一个表对应一个表结构文件，innodb的所有表数据都保存在ibdata1文件中，如果数据量很大
 * 会自动的创建ibdata2，ibdata3...
 * 
 * innodb和myisam的区别
 * myisam
 * 1、查询数独快
 * 2、容易产生碎片
 * 3、不能约束数据
 * 
 * innodb
 * 1、以前没有myisam查询数据快，现在已经提速
 * 2、不产生碎片
 * 3、可以约束数据
 * 
 * 推荐使用innodb
 */

/**
 * 显示创建表的语句
 * show create table 表名;
 * show create table 表名\G;
 */

/**
 * 查看表结构
 * desc[ribe] 表名；
 */

/**
 * 复制表
 * 
 * create table 新表 select 字段 from 旧表
 * 特点：不能复制父表的键，能够复制父表的数据
 * 
 * create table stu2 select id,name from stu;
 * 
 * 
 * create table 新表 like 旧表
 * 特点：只能复制表结构，不能复制表数据
 * 
 * create table stu3 like stu;
 * 
 * `*`表示所有字段
 */



/**
 * 删除表
 * drop table [if exists] 表1，表2.。。
 */


/**
 * 修改表
 * alter table 表名
 * 
 * 1、添加字段： alter table 表名 add[column] 字段名 数据类型[位置]
 * alter table stu add `add` varchar(20);   --默认添加的字段放在最后
 * alter table stu add sex char(1) after name;   --在name之后添加sex；
 * alter table stu add age int first;   ---age放在最前面；
 * 
 * 
 * 2、删除字段：alter table 表 drop[column] 字段名
 * alter table drop age;   --删除age字段
 * 
 * 3、修改字段（改名）： alter table 表 change[column] 原字段名 新字段名 数据类型
 * alter table stu change name stuname varchar(10);     --将name改为stuname varchar(10)
 * 
 * 4、修改字段（不改名）：alter table 表 modify 字段名 字段属性
 * alter table stu modify stuname varchar(20);  
 * 
 * 5、修改引擎：alter table 表名 engine=引擎名
 * alter table stu engine=myisam;
 * 
 * 6、修改表名：alter table rename to 新表名
 * alter table stu rename to student;
 * 
 * 7、将表移动到其它数据库
 * alter table student rename to php74.stu     将student表移动到php74数据库并且改名stu
 */


/**
 * 查询数据
 * 
 * select 列名 from 表名；
 * 
 * 
 * select id from stu;          ---查询id字段值
 * 
 * select id,name from stu;     ---查询id,name字段值
 * 
 * select * from stu;           ---查询所有字段值  
 * 
 * 
 * 插入数据
 * 
 * insert into 表名 （字段名，字段名...） values (值1，值2.。。)；
 * insert into stu (id,stuname,sex,`add`) values (1,'tom','男','北京');
 * 
 * 插入默认值、null
 * insert into stu values (5,'jake',null,default);
 * 
 * 插入多条数据
 * insert into stu values (2,'李白','男','四川'),(3,'杜甫','男','湖北');
 * 无指定字段 就是插入一条完整的记录
 * 
 * 
 * 更新数据
 * update 表名 set 字段=值（where条件）
 * update stu set sex='女' where stuname='tom';     ---将tom的性别改为女
 * 
 * update stu set sex='男', `add`='上海' where id=1;  ---将id为1的性别改为男，地址改为上海
 * 
 * 删除数据
 * delete from 表名（where条件）
 * delete from stu where id=1;
 * 
 * delete from stu where stuname='tom';
 * delete from stu      ---删除所有数据
 * 
 * truncate from stu   
 * truncate from 和 delete from的区别
 * 1、delete from遍历表记录，一条一条删除
 * 2、truncate from 将原表销毁，再创建一个同结构的新表，就清空表而言，这中方法效率高
 * 
 * 
 * 数据传输时使用字符集
 * 问题：在插入数据的时候，如果有中文会报错、中文无法插入
 * show variables like 'character_set_%';
 * 查看当前数据库编码格式
 * 
 * | Variable_name            | Value                                                  |
 * +--------------------------+--------------------------------------------------------+
 * | character_set_client     | utf8mb4                                                |
 * | character_set_connection | utf8mb4                                                |
 * | character_set_database   | utf8mb3                                                |
 * | character_set_filesystem | binary                                                 |
 * | character_set_results    | utf8mb4                                                |
 * | character_set_server     | utf8mb4                                                |
 * | character_set_system     | utf8mb3
 * 
 * 客户端、数据库链接、结果展示，这些编码格式要一致
 * set names gbk; 一次性设置编码格式
 * 
 * 
 * 
 * 环境变量配置
 * 通过环境变量配置mysql，可以在任何目前下执行mysql指令
 * 原理：
 * 1、输入指令后，首先在当前目录下查找，如果当前目录下找不到，就到环境变量的PATH中查找
 * 2、PATH中有很多目录，从前往后查找
 * 
 * 校队集
 * 概念：在某种字符集下，字符之间的比较关系
 * 2、校对集依赖于字符集，不同的字符集的比较规则不一样，如果字符集更改，校对集也重新定义
 * 3、不同的校对集对同一字符序列比较的结果不一致的
 * 4、可以子啊定义字符集的同时定义校对集    collate = 校对集
 * 
 * 定义两个表，相同字符集不同校对集
 * create table stu1( name char(1) )charset=utf8 collate=utf8_general_ci;
 * create table stu2( name char(1) )charset=utf8 collate=utf8_bin;
 * 
 * 两个表的数据都是由小到大排序
 *  select * from stu1 order by name;
 * select * from stu3 order by name;
 * 校对集规则：
 * _bin:   按二进制编码比较，区分大小写
 * _ci: 不区分大小写
 */

/**
 * 数据类型
 * 
 * 一、数值型
 * 1、整型
 * 
 * 类型	        大小	    范围（有符号）	                    范围（无符号）	        用途
 * TINYINT	    1 byte	    (-128，127)	                    (0，255)	        小整数值
 * SMALLINT	    2 bytes	    (-32 768，32 767)	            (0，65 535)	        大整数值
 * MEDIUMINT	3 bytes	    (-8 388 608，8 388 607)	        (0，16 777 215)	    大整数值
 * INT或INTEGER	4 bytes	    (-2 147 483 648，2 147 483 647)	(0，4 294 967 295)	大整数值
 * BIGINT	    8 bytes	    (-9,223,372,036,854,775,808，9 223 372 036 854 775 807)	(0，18 446 744 073 709 551 615)	极大整数值
 * 
 * 选择的范围尽可能小，范围越小占用资源越小
 * create table stu(
 *     -> id tinyint,     范围尽可能小
 *     -> name varchar(20)
 *     -> );
 * 
 * 无符号整型（unsigned）无符号整型就是没有负数，无符号整数是整数的两倍
 * create table stu2( id tinyint unsigned );
 * 
 * 整型支持显示宽度，显示宽带最小的显示位数，如int(11)表示整型最少用11位表示，如果不够位数用0填充，显示宽度默认不起作用，必须结合zerofill才起作用
 * 
 * create table stu3( id int(5), num int(5) zerofill );
 * 
 * insert into stu3 values (12, 12);
 * mysql> select * from stu3;
 * +------+-------+
 * | id   | num   |
 * +------+-------+
 * |   12 | 00012 |
 * +------+-------+
 * 
 * 
 * 
 * 2、浮点型
 * 
 * 类型	大小	范围（有符号）	范围（无符号）	用途
 * FLOAT	4 bytes	(-3.402 823 466 E+38，-1.175 494 351 E-38)，0，(1.175 494 351 E-38，3.402 823 466 351 E+38)	0，(1.175 494 351 E-38，3.402 823 466 E+38)	单精度/浮点数值
 * DOUBLE	8 bytes	(-1.797 693 134 862 315 7 E+308，-2.225 073 858 507 201 4 E-308)，0，(2.225 073 858 507 201 4 E-308，1.797 693 134 862 315 7 E+308)	0，(2.225 073 858 507 201 4 E-308，1.797 693 134 862 315 7 E+308)	双精度/浮点数值
 * 
 * mysql> create table stu4(
 *     -> num1 float(5,2),      --浮点数
 *     -> num2 double(6,1)      --双精度数
 *     -> );
 * Query OK, 0 rows affected, 2 warnings (0.01 sec)
 * 
 * mysql> insert into stu4 values (3.1415,12.96);
 * Query OK, 1 row affected (0.01 sec)
 * 
 * mysql> select * from stu4;
 * +------+------+
 * | num1 | num2 |
 * +------+------+
 * | 3.14 | 13.0 |
 * +------+------+
 * 1 row in set (0.00 sec)
 * 
 * 
 * 浮点数支持科学计数法
 * 
 * mysql> insert into stu5 values (5E2),(6E-2);
 * Query OK, 2 rows affected (0.01 sec)
 * Records: 2  Duplicates: 0  Warnings: 0
 * 
 * mysql> select * from stu5;
 * +------+
 * | num  |
 * +------+
 * |  500 |
 * | 0.06 |
 * +------+
 * 2 rows in set (0.00 sec)
 * 
 * 浮点数精度会丢失
 * mysql> insert into stu5 values (99.9999999999);
 * Query OK, 1 row affected (0.00 sec)
 * 
 * mysql> select * from stu5;
 * +------+
 * | num  |
 * +------+
 * |  100 |
 * +------+
 * 3 rows in set (0.00 sec)
 * 
 * 
 * 3、小数（定点）
 * 原理：将整数部分和小数部分分开存储
 * 语法：
 * decimal(M,D)
 * 
 * mysql> create table stu6(
 *     -> num decimal(20,9)
 *     -> );
 * Query OK, 0 rows affected (0.01 sec)
 * 
 * mysql> insert into stu6 values (12.99999999);
 * Query OK, 1 row affected (0.01 sec)
 * 
 * mysql> select * from stu6;
 * +--------------+
 * | num          |
 * +--------------+
 * | 12.999999990 |
 * +--------------+
 * 1 row in set (0.00 sec)
 * 
 * decimal是变长的，大致是每9个数字用4个字节存储，整数和小数分开计算。M最大是65，D最大是30，默认是（10，2）。
 * 定点和浮点都支持无符号，显示宽度0填充
 * 
 * 
 * 二、字符型
 * 在数据库中没有字符串概念，只有字符。
 * 
 * 类型	            大小	            用途
 * CHAR	            0-255 bytes	        定长字符串
 * VARCHAR	        0-65535 bytes	    变长字符串
 * TINYTEXT	        0-255 bytes	        短文本字符串
 * TEXT	            0-65 535 bytes	    长文本数据
 * MEDIUMTEXT	    0-16 777 215 bytes	中等长度文本数据
 * LONGTEXT	        0-4 294 967 295 bytes	极大文本数据
 * 
 * char(4)  存放4个字符，中英文一样；
 * varchar(L) 实现变长机制，需要额外的空间来记录数据真实的长度。
 * L理论的长度是65535，但事实上达不到，因为有的字符是多字节字符，所以L达不到65535
 * 
 * utf8     1字符=3字节
 * gbk  1字符=2字节
 * mysql> create table stu7(
 *     -> name varchar(65535)
 *     -> )charset=utf8;
 * ERROR 1074 (42000): Column length too big for column 'name' (max = 21845); use BLOB or TEXT instead
 * 
 * mysql> create table stu7( name varchar(65535) )charset=gbk;
 * ERROR 1074 (42000): Column length too big for column 'name' (max = 32767); use BLOB or TEXT instead
 * 
 * 一个记录的所有字段（大数据不包含）的总长度也不能超过65535个字节
 * mysql> create table stu7(
 *     -> name varchar(21844),
 *     -> id int
 *     -> );
 * ERROR 1118 (42000): Row size too large. The maximum row size for the used table type, not counting BLOBs, is 65535. This includes storage overhead, check the manual. You have to change some columns to TEXT or BLOBs
 * 
 * text系列的类型在表中存储的是地址，占用大小约10个字节
 * mysql> create table stu7(
 *     -> id int,
 *     -> name longtext
 *     -> );
 * Query OK, 0 rows affected (0.01 sec)
 * 
 * 三、枚举（enum）
 * 从集合中选择一个值作为数据（单选）
 * 
 * mysql> create table stu8(
 *     -> name varchar(20),
 *     -> sex enum('男','女','保密')
 *     -> );
 * Query OK, 0 rows affected (0.00 sec)
 * 
 * mysql> insert into stu8 values ('tom','男');  ---插入的枚举值只能是枚举中提供的选项
 * Query OK, 1 row affected (0.01 sec)
 * 
 * 枚举值是通过整型数字来管理的，第一个值是1，第二个值是2，以此类推，枚举值在数据库存储的是整型数字
 * mysql> insert into stu8 values ('berry',2);
 * 
 * 枚举的优点
 * 1、限制值
 * 2、节省空间
 * 3、运行速度快（整型比字符串运行速度快）
 * 枚举占用两个字符的长度，所以最多可以写65535个枚举值，（枚举从1开始，所以不是65536）
 * 2个字节=2^16=65536
 * 
 * 四、集合（set）
 * 从集合中选择一些值作为数据（多选）
 * 
 * mysql> create table stu9(
 *     -> name varchar(20),
 *     -> hobby set('爬山','读书','游泳','烫头')
 *     -> );
 * Query OK, 0 rows affected (0.01 sec)
 * 
 * mysql> insert into stu9 values ('tom','爬山');
 * Query OK, 1 row affected (0.01 sec)
 * 
 * mysql> insert into stu9 values ('berry','爬山,游泳');   ---插入顺序不一样，显示顺序一样
 * Query OK, 1 row affected (0.00 sec)
 * 
 * mysql> select * from stu9;
 * +-------+---------------+
 * | name  | hobby         |
 * +-------+---------------+
 * | tom   | 爬山          |
 * | berry | 爬山,游泳     |
 * -------+---------------+
 * 
 * 集合和枚举一样，也为每个集合元素分配一个固定值，
 * 分配方式是从前往后按2的0，1，2，。。次方，转成二进制后只有以为是1，其它都是0
 * 
 * mysql> select hobby+0 from stu9;
 * +---------+
 * | hobby+0 |
 * +---------+
 * |       1 |
 * |       5 |
 * +---------+
 * 2 rows in set (0.00 sec)
 * 
 * 集合类型占8个字节，集合最多有64项
 * 
 * 
 * 五、日期时间型
 * 
 * 类型	大小( bytes)	范围	格式	用途
 * DATE	3	1000-01-01/9999-12-31	YYYY-MM-DD	日期值
 * TIME	3	'-838:59:59'/'838:59:59'	HH:MM:SS	时间值或持续时间
 * YEAR	1	1901/2155	YYYY	年份值
 * DATETIME	8	1000-01-01 00:00:00/9999-12-31 23:59:59	YYYY-MM-DD HH:MM:SS	混合日期和时间值
 * TIMESTAMP	4	 1970-01-01 00:00:00/2038结束时间是第 2147483647 秒，北京时间 2038-1-19 11:14:07，格林尼治时间 2038年1月19日 凌晨 03:14:07  YYYYMMDD HHMMSS	混合日期和时间值，时间戳
 * 
 * 六、boolean
 * Mysql不支持布尔型,true和false在数据库中对应的是1和0；
 * boolean型在mysql中对应的是tinyint
 * 
 * 
 * 
 */