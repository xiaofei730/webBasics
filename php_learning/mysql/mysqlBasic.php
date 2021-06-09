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
 * 电话号码一般使用什么数据类型存储？
 * varchar 不使用整型是因为整型一般运用在需要运算的数据，或者有可能运算的数据比如成绩，年龄
 * 
 * 手机号码用什么数据类型？     
 * char
 * 
 * 性别一般使用什么数据类型存储？   
 * enum char tinyint
 * 
 * 学生的年龄一般使用什么数据类型存储？
 * tinyint
 * 
 * 照片信息一般使用什么数据类型存储？
 * binary（在开发中一般是把照片的地址放在数据库）
 * 
 * 薪水一般使用什么数据类型存储？
 * decimal
 * 
 * 
 */


/**
 * 
 * 列属性
 * 
 * 一、是否为空（null|not null）
 * null表示字段值可以为null
 * not null字段值不能为空
 * 
 * 学员姓名允许为空吗？
 * 不能 not null
 * 
 * 家庭地址允许为空吗？
 * 不能 not null
 * 
 * 电子邮件信息允许为空吗？
 * null
 * 
 * 考试成绩允许为空吗？
 * null
 * 
 * 二、默认值（default）
 * 如果一个字段没有插入值，可以默认插入一个指定的值
 * 
 * 三、自动增长（auto_increment）
 * 字段值从1开始，每次递增1，自动增长的值就不会有重复，适合用来生成唯一的ID。
 * 在mysql只要是自动增长列必须是主键
 * 
 * 四、主键（primary key）
 * 主键：唯一标识表中的记录的一个或一组列称为主键
 * 主键的特点：主键不能为空，不能重复，一个表只能有一个主键
 * 作用：
 * （1）：保证数据完整性
 * （2）：加快查询速度
 * 
 * 选择主键的原则：
 * q 最少性：尽量选择单个键作为主键
 * q 稳定性：尽量选择数值更新少的列作为主键
 * 
 * 比如，学号，姓名，地址，这三个字段不重复，选哪个做主键
 * 选学号，因为学号最稳定
 * 
 * 添加主键
 * alter table stu add primary key(id, name);
 * 
 * 删除主键
 * alter table stu drop primary key；
 * 
 * 小结：
 * 1、只要是auto_increment必须是主键，但是主键不一定是auto_increment
 * 2、主键特点是不能重复不能为空
 * 3、一个表只能有一个主键，但是一个主键可以有很多个字段组成
 * 4、自动增长列通过插入null值让器递增
 * 5、自动增长列的数据被删除，默认不再重复使用。truncate table删除数据后，再次插入从1开始
 * 
 * 如果插入的主键重复会报错
 * 语法一：replace into stu values ('s001', 'tom'); 如果插入的主键不重复就直接插入，如果主键重复就替换（删除原来的记录，插入新的记录）
 * 
 * 
 * 语法二（推荐）：insert into stu values('soo2', 'berry') on duplicate key update name='berry'; 插入的数据和主键或唯一键起冲突
 * 
 * 
 * 练习：
 * 1、在主键列输入的数值，允许为空吗？
 * 不可以
 * 
 * 2、一个表可以有多个主键吗？
 * 不可以
 * 
 * 3、在一个学校数据库中，如果一个学校内允许重名的学员，但是一个班级内不允许学员重名，可以组合班级和姓名两个字段一起来作为主键吗？
 * 可以
 * 
 * 4、标识列（自动增长列）允许为字符数据类型吗？
 * 不允许
 * 
 * 5、一个自动增长列中，插入3行，删除2行，插入3行，删除2行，插入3行，删除2行，在插入是多少？10
 * 
 * 
 * 五、唯一键（unique）
 * 主键：1、不能重复，不能为空。2、一个表只能有一个主键
 * 唯一键：1、不能重复，可以为空。2、一个表可以有多个唯一键
 * 
 * 添加唯一键
 * alter talbe stu add unique(name),add unique(addr);
 * 
 * 删除唯一键
 * lter talbe stu drop index name；
 * 
 * 通过唯一键的名字删除唯一键
 * 通过show create table查看唯一键的名字
 * 
 * 
 * 六、备注（comment）
 * 说明性文本
 * create table stu(id int primary key comment '学号', name varchar(20) not null comment '姓名');
 * 注意：备注属于SQL语句的一部分
 * 
 * 
 * 
 * 
 */


/**
 * SQL注释        
 * -- 单行注释
 * # 单行注释
 * 多行注释 
 * 
 * 
 * create table stu(id int primary key comment '学号',  -- 主键  name varchar(20) not null comment '姓名'  # 姓名 );
 * 
 */


/**
 * 数据完整性
 * 
 * 一、数据完整性包括
 * 1、实体完整性 
 * 主键约束、唯一约束、标识列
 * 
 * 2、域完整性
 * 数据类型约束、非空约束、默认值约束
 * 
 * 3、引用完整性
 * 主外键约束
 * 
 * 4、自定义完整性
 * 存储过程、触发器
 * 
 * 
 * 
 */


/**
 * 主表和从表
 * 
 * 1、主表中没有的，从表不允许插入
 * 2、从表中有的，主表中不允许删除
 * 3、删除主表前，先删子表
 * 
 * 
 * 外键
 * 从表中的公共字段
 * 
 * create table stu1(id tinyint primary key,name varchar(20))engine=innodb;
 * 
 * 创建外键
 * create table stu2(sid tinyint primary key,score tinyint unsigned, foreign key(sid) references stu1(id))engine=innodb;
 * 
 * 
 * alter  table stu2 add foreign key(sid) references stuinfo(id)
 * 
 * 通过修改表的时候添加外键
 * alter table 从表 add foreign key(公共字段) references 主表(公共字段)
 * 
 * 删除外键
 * show create table stu2
 * alter table stu2 drop foreign key 'stu2_ibfk_1';
 * 
 * 小结：1、只有innodb才能支持外键
 * 2、公共字段的名字可以不一样，但是数据类型要一样
 * 
 * 外键操作
 * 1、严格现在（参加主表和从表）
 * 2、置空操作（set null）:如果主表记录删除， 或关联字段更新，则从表外键字段被设置为null
 * 3、级联操作（cascade）：如果主表记录删除，从表记录也被删除，主表更新，从表外键也更新
 * 
 * 置空、级联外键不能是从表的主键
 * 一般说删除是置空，更新时级联
 * create table stuinfo(
 *      id tinyint primary key comment '学号，主键',
 *      name varchar(20) comment '姓名'
 * )engine=innodb;
 * 
 * create table stuscore(
 *      id int auto_increment primary key comment '主键',
 *      sid tinyint comment '学号，外键',
 *      score tinyint unsigned comment '成绩',
 *      foreign key(sid) references stuinfo(id) on delete set null on update
 * )engine=innodb;
 * 
 * 
 * 
 */


/**
 * 
 * 实体之间的联系
 * 
 * 
 * 一、一对多（1:N）
 * 主表中的一条记录对应从表中的多条记录
 * 
 * 实现一对多的方式：主键和非主键的关系
 * 
 * 说出几个一对多的关系
 * 班主任表---学生表
 * 品牌表--商品表
 * 
 * 二、多对一（N：1）
 * 多对一就是一对多
 * 
 * 三、一对一（1:1）
 * 学生信息表和信息扩展表
 * 
 * 如何实现一对一
 * 主键和主键的关系
 * 
 * 问：一对一两个表完全可以用一个表实现，为什么还要分成两个表？
 * 在字段数量很多的情况下，数据量也就很大，每次查询都需要检索大量数据，这样效率低下，
 * 我们可以将所有字段分成两个部分，“常用字段”和“不常用字段”，这样对大部分查询者来说效率就提高了。【表的垂直分割】
 * 
 * 四、多对多（N：M）
 * 
 * 
 * 如何实现多对多：利用第三张关系表
 * 
 * 说出几个多对多的关系？
 * 讲师表--学生表
 * 课程表--学生表
 * 商品表--订单表
 * 
 * 
 * 
 */


/**
 * 
 * 数据库设计
 * 
 * 一、数据库设计的步骤
 * 1、收集信息：与改系统有关人员进行交流，座谈，充分理解数据库需要完成的任务
 * 2、标识对象（实体-Entity）:标识数据库要关联的关键对象或实体
 * 3、标识每个实体的属性（attribute）
 * 4、标识对象之间的关系（relationship）
 * 5、将模型转化成数据库
 * 6、规范化 
 * 
 * 二、绘制E-R图
 * 
 * 三、将E-R图转成表
 * 
 * 
 * 数据规范化
 * 一、第一范式的目标式确保每列的原子性
 * 如果每列都是不可再分的最小数据单元（也称为最小的原子单元），则满足第一范式（1NF）
 * 
 * 例如：福建省福州市鼓楼区------福建省、福州市、鼓楼区
 * 
 * 思考：地址包含省、市、县、地区是否需要拆分
 * 如果仅仅起地址作用，不需要统计，可以拆分；如果有按地区统计的功能需要拆分，
 * 在实际项目中，建议拆分
 * 
 * 二、第二范式：非键字段必须依赖于键字段
 * 第二范式（2nd NF）在满足第一范式的前提下，要求每个表只能描述一个事情
 * 
 * 
 * 三、第三范式：消除传递依赖
 * 第三范式（3nd NF）在满足第二范式的前提下，除了主键以外的其他列消除传递依赖
 * 
 * 四、反3NF
 * 范式越高，数据冗余越少，但是效率有时就越低下，为了提高允许效率，可以适当让数据冗余
 * 学号     姓名        语文        数字        总分
 * 1        李白          77         88         165
 * 
 * 上面的设计不满足第三范式，但是高考分数表就是这样设计的，为什么？
 * 答：高考分数峰值访问量非常大，这时候就是性能更重要，当性能和规范化冲突的时候，我们首选性能，这就是“反三范式”
 * 
 * 
 * 小结：
 * 1、第一范式约束的所有字段
 * 2、第二范式约束主键和非主键的关系
 * 3、第三范式约束的非主键之间的关系
 * 4、范式越高，冗余越少，但表也越多
 * 5、规范化和性能的关系；性能必规范化更重要
 * 
 * 
 * 
 * 
 */


/**
 * 
 * 查询语句   
 * 语法：select [选项] 列名 [from 表面] [where 条件] [group by 分组] [order by 排序][having 条件][limit 限制]
 * 
 * 1、字段表达式
 * 
 * 
 * 
 * 
 * 2、from子句
 * 
 * 3、dual表
 * 
 * 4、where子句
 * where后面跟的是条件，在数据源中进行筛选，返回条件为真记录
 * MySQL支持的运算符
 * ---比较运算符
 * >
 * <
 * <=
 * =
 * !=
 * ----逻辑运算符
 * and
 * or
 * not
 * ---其它
 * in | not in                      字段值在枚举范围内
 * between_and | not between_and    字段值在数字范围内
 * is null | is not null            字段值不为空
 * 
 * 例子
 * select * from stu where ch>=60;
 * 
 * select * from stu where ch>=60 and math>=60;
 * 
 * select * from stu where ch<60 or math<60;
 * 
 * select * from stu where 1;       --输出所有数据
 * select * from stu where 0;       --不输出数据
 * 
 * select * from stu where stuaddress='北京' or  stuaddress='上海';
 * 
 * select * from stu where stuaddress in('北京','上海');
 * 
 * select * from stu where stuaddress not in('北京','上海');
 * 
 * select * from stu where stuage>=20 and stuage<=25;
 * 
 * select * from stu where not(stuage<20 or stuage>25);
 * 
 * select * from stu where between stuage>=20 and stuage<=25);
 * 
 * select * from stu where not between stuage>=20 and stuage<=25);
 * 
 * select * from stu where ch is null or math is null;
 * 
 * select * from stu where ch is not null or math is not null;
 * 
 * select * from stu where ch is null or math is null or ch<60 or math<60;
 * 
 * 
 * 
 * 5、group by [分组]
 * 将查询的结果分组，分组查询目的在于统计数据
 * ----查询男生和女生各自的平均分
 *              
 * selec stusex,avg(ch) '平均分' from stu group by stusex;
 * 
 * selec stusex,count(*) 人数 from stu group by stusex;
 * 
 * selec stuaddress,avg(math) 数学平均分 from stu group by stuaddress;
 * 
 * 
 * （1）如果是分组查询，查询字段必须是分组字段和聚合函数
 * （2）查询字段是普通字段，只取第一个值
 * selec stuname,stusex,avg(math) 数学平均分 from stu group by stusex;
 * 
 * 通过group_concat()函数将同一组的值连接起来显示
 * selec group_concat(stuname),stusex,avg(math) 数学平均分 from stu group by stusex;
 * 
 * 多列分组
 * selec stuaddress,stusex,avg(math) 数学平均分 from stu group by stuaddress,stusex;
 * 
 * 
 * 6、order by排序
 * asc:升序（默认）
 * desc：降序
 * 
 * select * from stu order by stuage asc;
 * 
 * select *,ch+math '总分' from stu order by ch+math desc;
 * 
 * 多列排序
 * 年龄升序，如果年龄一样，按ch降序排列
 * select * from stu order by stuage asc,ch desc;
 * 
 * select * from stu order by stuage,ch desc;
 * 
 * 7、having条件
 * having：是结果集上进行条件筛选
 * 
 * having和where的区别
 * where是对原始数据进行筛选，having是对记录进行筛选
 * 
 * 
 * 8、limit
 * 语法：limit起始位置，显示长度
 * select * from stu limit 0,3;
 * 
 * 起始位置可以省略，默认是从0开始
 * select * from stu limit 3;
 * 
 * 9、查询语句中的选项
 * 查询语句中的选项有两个：
 * 1、all：显示所有数据【默认】；
 * 2、distinct：去除结果集中重复的数据
 * 
 * select all stuaddress from stu;
 * 
 * select distinct stuaddress from stu;
 * 
 * 
 * 
 */


/**
 * 
 * 聚合函数
 * sum()    求和
 * 
 * avg()    求平均值
 * 
 * max()    求最大值
 * 
 * min()    求最小值
 *   
 * count()  求记录数
 * 
 * 
 * 例子
 * select max(ch) '语文最大值' from stu
 * 
 * select max(ch) '语文最大值',min(ch) 语文最小值,sum(ch) 语文总分,avg(ch) 语文平均分,count(*) 总人数 from stu
 * 
 * 
 * 
 */


/**
 * 
 * 模糊查询
 * 一、通配符
 * （1）_[下划线]表示任意一个字符
 * （2）%表示任意字符
 * 
 * 练习
 * 1、满足“T_m”的有（A、C）A、Tom   B、Toom     C：Tam      D：Tm       E：Tmo
 * 
 * 2、满足“T_m_”的有（B C）A：Tmom      B:Tmmm      C:T1m2      D:Tmm   E:Tm
 * 
 * 3、满足“张%”的是（ABCD） A：张三     B：张三丰       C：张牙舞爪     D：张   E：小张
 * 
 * 二、模糊查询（like）
 * 模糊查询的条件不能用“=”，要使用like
 * 
 * select * from stu where stuname like 'T_m';
 * 
 * select * from stu where stuname like '张%';
 * 
 * 
 */


/**
 * 
 * union(联合)
 * 
 * 1、union的使用
 * 作用：将多个select语句结果集纵向联合起来
 * 语法：select 语句 union [选项] select 语句 union [选项] select 语句
 * 
 * 查询stu表中的姓名和emp表中的姓名，结果自动合并的重复的记录
 * selec stuname from stu union select name from emp;
 * 
 * select * from stu where (stuaddress='上海' and stusex='男') or (stuaddress='上海' and stusex='女');
 * 
 * select * from stu where stuaddress='上海' and stusex='男' union select * from stu where stuaddress='上海' and stusex='女';
 * 结论：union可以将一个复杂的条件转成两个简单的条件
 * 
 * 
 * 2、union的选项
 * union的选项两个
 * （1）all：显示所有数据               selec stuname from stu union all select name from emp;
 * （2）distinct：去除重复的数据【默认】    selec stuname from stu union select name from emp;
 * 
 * 
 * 3、union的注意事项
 * （1）union两边的select语句的字段个数必须一致
 * （2）union两边的select语句的字段名可以不一致，最终按第一个select语句的字段名
 * （3）union两边的select语句中的数据类型可以不一致
 * 
 * 
 * 
 * 
 * 
 */


/**
 * 
 * 多表查询
 * 
 * 一、内连接
 * 规则：返回两个表的公共记录
 * 
 * 语法一
 * select * from 表1 inner join 表2 on 表1.公共字段=表2.公共字段
 * 语法二
 * select * from 表1,表2 where 表1.公共字段=表2.公共字段
 * 
 * 
 * 
 * select * from stuinfo inner join stumarks on stuinfo.stuno=stumarks.stuno;
 * 
 * 相同的字段值只显示一次
 * select s.stuno,stuname,stusex,writtenexam,labexam from stuinfo s inner join stumarks m on s.stuno=m.stuno;
 * 
 * select * from stuinfo,stumarks where stuinfo.stuno=stumarks.stuno;
 * 
 * 如何实现三表查询
 * select * from 表1 inner join 表2 on 表1.公共字段=表2.公共字段 inner join 表3 on 表2.公共字段=表3.公共字段
 * 
 * 表连接越多，效率越低
 * 
 * 
 * 多学一招
 * （1）内连接中inner可以省略
 * select * from 表1 join 表2 on 表1.公共字段=表2.公共字段
 * 
 * 
 * 问：select * from 表1 join 表2 on 表1.公共字段=表2.公共字段和select * from 表2 join 表1 on 表1.公共字段=表2.公共字段一样吗？
 * 答：一样
 * 
 * 二、左外连接
 * 规则：以左边的表为准，右边如果没有对应的记录用null显示
 * 语法：
 *  select * from 表1 left join 表2 on 表1.公共字段=表2.公共字段
 * 
 * select stuname,writtenexam,labexam from stuinfo left join stumarks on stuinfo.stuno=stumarks.stuno;
 * 
 * 问：select * from 表1 left join 表2 on 表1.公共字段=表2.公共字段和select * from 表2 left join 表1 on 表1.公共字段=表2.公共字段一样吗？
 * 答：不一样，第一个SQL以表1为准，第二个SQL以表2为准
 * 
 * 三、右外连接
 * 规则：以右边的表为准，右边如果没有对应的记录用null显示
 * 语法：
 * select * from 表1 right join 表2 on 表1.公共字段=表2.公共字段
 * 
 * select stuname,writtenexam,labexam from stuinfo right join stumarks on stuinfo.stuno=stumarks.stuno;
 * 问：select * from 表1 left join 表2 on 表1.公共字段=表2.公共字段和select * from 表2 right join 表1 on 表1.公共字段=表2.公共字段一样吗？
 * 答：一样
 * 
 * 
 * 四、交叉连接
 * 语法：返回笛卡尔积 
 * select * from 表1 cross join 表2
 * 
 * select * from stuinfo cross join stumarks;
 * 
 * select * from stuinfo cross join stumarks on stuinfo.stuno=stumarks.stuno;
 * 
 * 小结：
 * （1）交叉连接如果没有连接条件返回笛卡尔积
 * （2）如果有条件和内连接是一样的
 * 
 * 五、自然连接
 * 自动判断条件连接，判断的条件是依据同名字段
 * 1、自然内连接    natural join
 * select * from stuinfo natural join stumarks on stuinfo.stuno=stumarks.stuno;
 * 
 * 
 * 2、自然左外连接  natural left join  
 * select stuname,writtenexam,labexam from stuinfo natural left join stumarks on stuinfo.stuno=stumarks.stuno;
 * 
 * 
 * 
 * 3、自然右外连接  natural right join 
 * select stuname,writtenexam,labexam from stuinfo natural right join stumarks on stuinfo.stuno=stumarks.stuno;
 * 
 * 
 * 小结
 * （1）表连接是通过同名字段来连接的
 * （2）如果没有同名字段就是返回笛卡尔积
 * （3）同名的连接字段只显示一个，并且该字段放在最前面
 * 
 * 4、using
 * using用来指定连接字段
 * 
 * select * from stuinfo inner join stumarks using(stuno);
 * 
 * using 的结果也会对公共字段进行优化，优化的规则和自然连接是一样的
 *  
 * 
 * 
 */


/**
 * 
 * 子查询
 * 
 * 语法：select * from 表1 where （子查询）
 * 
 * 外面的查询称为父查询
 * 子查询为父查询提供查询条件
 * 
 * 1、标量子查询
 * 特点：子查询返回的值是一个
 * 
 * select * from stuinfo where stuno=(select stuno from stumarks where writtenexam=80);
 * 
 * select * from stuinfo where stuno=(select stuno from stumakrs order by wwrittenexam desc limit 1);    
 * 
 * 2、列子查询
 * 特点：子查询的结果是一列         
 * 
 * 如果子查询的结果返回多条记录，不能使用等于，用in或not in
 * select * from stuinfo where stuno in (select stuno from stumarks where writtenexam>=60);
 * 
 * 3、行子查询
 * 特点：子查询返回的结果是多个字段组成
 * select * from stu where (stusex,ch) in (select stusex,max(ch) from stu group by stusex);
 * 
 * 4、表子查询
 * 特点：将子查询的结果作为表
 * select * from (select * from stu order by ch desc) t group by stusex;
 * 
 * 注意：from后面跟的是数据源，如果将子查询当成表来看，必须给结果集取别名
 * 
 * 5、exists子查询
 * 如果笔试成绩有人超过80，就显示所有学生信息
 * select * from stuinfo where exists (select * from stumarks where writtenexam>=80)
 * 
 * 作用：提高查询效率
 * 
 * 
 */


/**
 * 视图
 * 1、概述
 * （1）视图是一张虚拟表，它表示一张表的部分数据或多张表的综合数据，其结构和数据是建立在对表的查询基础上
 * （2）视图中并不存放数据，而是存放在视图所引用的原始表（基表）中
 * （3）同一张原始表，根据不同用户的不同需求，可以创建不同的视图
 * 
 * 2、作用
 * （1）筛选表中的行
 * （2）防止未晶许可的用户访问敏感数据
 * （3）隐藏数据表的结构
 * （4）降低数据表的复杂度
 * 
 * 3、创建视图
 * 语法 
 * create view 视图1 as select 语句;
 * 
 * 例子
 * --创建视图
 * create view view1 as select * from stu where stusex='男';
 * 
 * --查询
 * select * from view1;
 * 
 * create view view2 as select stuno,writtenexam,labexam from stuinfo natural join stumarks;
 * 
 * 4、修改视图
 * 语法
 * alter view 视图名 as select 语句
 * 
 * 例子
 * alter view view2 as select stuname from stuinfo;
 * 
 * 5、删除视图
 * 语法
 * drop view [if exists] 视图1，视图2.。。
 * 
 * 
 * 6、查看视图信息
 * show tables; --- 显示所有的表和视图
 * 
 * 精确查找
 * show * from information_schema.view;
 * show table_name from information_schema.view;
 * 
 * 通过
 * show table status where comment='view'\G;
 * 
 * 查询视图结构
 * desc view1；
 * 
 * 查询创建视图的语法
 * show create view view1\G;
 * 
 * 
 * 7、视图算法
 * 找出语文成绩最高的男生和女生
 * select * from (select * from stu order by ch desc) t group by stusex;
 * 
 * create view view3 as select * from stu order by ch desc;
 * select * from view3 group by stusex;
 * 两种方法结果不一样，这是因为视图的算法造成的
 * 
 * 视图的算法有
 * （1）merge：合并算法（将视图语句和外层语句合并后再执行）
 * （2）temptable：临时表算法（将视图作为一个临时表来执行）
 * （3）undefined：未定义算法（用哪一种算法由Mysql决定，这是默认算法，一般会选merge）
 * 
 * create or replace algorithm=temptable view view3 as select * from stu order by ch desc;
 * 
 * 
 */


/**
 * 
 * 事务
 * 1、概述
 * （1）事务（TRANSACTION）是一个整体，要么一起执行，要么一起不执行
 * 
 * 2、事务特性
 * （1）事务必须具备以下四个属性，检查ACID属性：
 * 原子性（Atomicity）:事务是一个完整的操作，事务的各步骤操作是不可分的（原子的）；要么都执行，要么都不执行
 * 一致性（Consistency）：当事务完成时，数据必须处于一致状态
 * 隔离性（Isolcation）：对数据进行修改的所有并发事务是彼此隔离的
 * 永久性（Durability）:事务完成后，它对数据库的修改被永久保持
 * 
 * 3、事务处理
 * 开启事务
 * start transaction   或 begin [work]
 * 
 * 提交事务
 * commit
 * 
 * 回滚事务
 * rollback
 * 
 * 例子
 * 创建表
 * create table bank(card char(4) primary key comment '卡号',money decimal(10,2) not null)engine=innodb charset=utf8;
 * 插入数据
 * insert into bank values ('1001', 1000),('1002', 1);
 * 
 * 开启事务
 * begin;  或者start transaction;
 * 
 * 修改结束符 将;改为//
 * delimiter //
 * 
 * 数据处理
 * update  bank set money=money-100 where card='1001';
 * update  bank set money=money+100 where card='1002' //
 * 
 * //提交事务 （若提交则无法回滚）
 * commit
 * 
 * 事务回滚
 * rollback//
 * 
 * //设置事务的回滚点
 * savepoint a1//
 * 
 * rollback to a1//
 * 
 * 自动提交事务
 * 每一个SQL语句都是一个独立的事务
 * 
 * 小结：
 * 1、事务是事务开启的时候开始
 * 2、提交事务，回滚事务后事务都结束
 * 3、只有innodb支持事务
 * 4、一个SQL语句就是一个独立的事务，开启事务就是将多个SQL语句放到一个事务中执行
 * 
 * 
 */


/**
 * 
 * 索引
 * 1、概述
 * 优点：加快查询的速度
 * 缺点：带索引的表在数据库中需要更多的存储空间
 * 增、删、改命令需要更长的处理时间，因为它们需要对索引进行更新
 * 
 * 2、创建索引的指导原则
 * 适合创建索引的列
 * （1）该列用于频繁搜索
 * （2）该列用于对数据进行排序
 * （3）在WHERE子句中出现的列，在join子句中出现的列
 * 
 * 请不要使用下面的列创建索引
 * （1）列中仅包含几个不同的值
 * （2）表中仅包含几行，为小型表创建索引可能不太划算，因为mysql在索引中搜索数据所花的时间比在表中逐行搜索花的时间更长
 * 
 * 
 * 3、创建索引
 * （1）主键索引：只要创建了主键就会自动的创建主键索引
 * 
 * （2）唯一索引：创建了唯一键就创建了唯一索引
 * create table t1( id int primary key, name varchar(20), unique ix)name(name));
 * 
 * create unique index ix_name on t1(name);
 * 
 * alter table t1 add unique index ix_addr(addr);
 * 
 * （3）普通索引
 * create table t1( id int primary key, name varchar(20), index ix_name(name));
 * 
 * create index ix_name on t1(name);
 * 
 * alter table t1 add index ix_addr(addr);
 * 
 * （4）创建索引后，数据库根据查询语句自动选择索引
 * 
 * 4、删除索引
 * drop index 索引名 on 表名
 * drop index ix_name on t1;
 * 
 */



/**
 * 
 * 函数
 * 1、数字类
 * --获取随机数
 * select rand();
 * --随机排序
 * select * from stuinfo order by rand() limit 1;
 * --四舍五入，向上取整，向下取整
 * select round(3.141596, 3) '四舍五入',truncate(3.141596, 3) '截取数据',ceil(3.1) '向上取整',floor(3.9) '向下取整';
 * 四舍五入     截取数据        向上取整        向下取整
 * 3.142        3.141       4               3
 * 
 * 
 * 2、字符串类
 * 
 * 
 * 
 * 
 * 
 * 
 */
































