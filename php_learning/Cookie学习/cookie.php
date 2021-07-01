<?php

/**
 * 
 * Cookie
 * 思考：A页面中的变量如果提供给B页面访问
 * 方法一：包含文件
 * 方法二：get或post提交
 * 方法三：cookie，cookie就是保存在客户端的信息文件
 * 
 * 1、原理
 * cookie是保存在客户端的信息包（一个文件）
 * 
 * （1）客户端向服务器发送请求
 * （2）服务器将值放到响应头中发送到客户端
 * 浏览器自动的将信息放到请求头中带到服务器
 * 服务器从请求头中获取带来的信息
 * 
 * 通过header()、setcookie()操作响应头
 * 语法格式：header(键:值);
 * header('content-type:charset=gbk');
 * header('name:tom');
 * 
 * setcookie()作用：将值放到响应头中发送到客户端，并保存到客户端
 * 
 * 2、setcookie()
 * setcookie('name','tom');
 * 在响应头中可以看到cookie的信息
 * 
 * 客户端有cookie信息后，每次请求服务器，cookie的信息都会自动的放到请求头中带到服务器。
 * 
 * 3、获取cookie的值
 * $_COOKIE['name'];    //从请求头中获取名字是name的cookie
 * 
 * 注意：
 * （1）关闭浏览器后，cookie小时，这种cookie称为临时性cookie
 * （2）cookie的信息不可以在不同的浏览器中共享，不可以跨浏览器
 * 
 * 思考：如下代码为什么第一次执行报错，第二次执行正常
 * setcookie('name','tom');
 * echo $_COOKIE['name'];
 * 
 * 因为：第一次访问请求头中没有cookie的值所以获取不到，第二次访问由于第一次已经将cookie设置到响应头中
 * 第二次访问就会自动将cookie的信息放到请求头中，所以第二次访问就能获取cookie的值了
 * 
 * 
 * 4、永久性（持久化）cookie
 * 说明：关闭浏览器后cookie的值不消失
 * 
 * 语法：给cookie添加过期时间就形成了永久性cookie，过期时间是时间类型是时间戳
 * $time = time() + 3600;
 * setcookie('name','tom', $time);    //cookie有效时间3600秒
 * 
 * 5、cookie的有效目录
 * cookie默认在当前目录及子目录中有效
 * cookie一般要设置在整站有效
 * 
 * setcookie('name', 'tom', 0, '/');        //表示根目录
 * 
 * 6、支持子域名
 * 场景：每个域名代码一个网站，网站之间的cookie是不可以相互访问的
 * 问题：百度下有多个二级域名的网站，他们自己的cookie是要共享吗，如何实现？
 * setcookie('name', 'tom', 0, '/', 'baidu.com');       //在  baidu.com域名下有效
 * 
 * 
 * 7、是否安全传输
 * 安全传输就是https传输
 * 默认情况下https和http都可以传输cookie
 * setcookie('name', 'tom', 0, '/', '', true);      //true表示只能是https传输
 * 
 * 
 * 8、是否安全访问
 * 默认情况下，PHP和S都可以访问cookie
 * 安全访问：PHP可以访问，JS不可以
 * setcookie('name', 'tom', 0, '/', '', false, true);
 * 
 * <?php
 * $_COOKIE['name']; 
 * ?>
 * <script type="text/javascript">
 *  document.write(document.cookie);
 * </script>
 * 
 * 9、删除cookie
 * 注意：cookie只能保存数字和字符串
 * 方法一：
 * setcookie('name', false);       
 * 方法二：
 * setcookie('name');
 * 方法三：
 * setcookie('name', 'tom', tinme()-1);
 * 
 * 
 * 10、cookie的缺点
 * （1）因为在浏览器中可以看到cookie的值，所以安全性低
 * （2）因为只能保存字符串和数字，所以可控性差
 * （3）因为数据放在请求头中传输，增加了请求时候的数据负载
 * （4）因为数据存储在浏览器中，但浏览器存储空间是有限制的，一般4k;
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













