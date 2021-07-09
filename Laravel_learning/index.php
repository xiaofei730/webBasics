<?php


/**
 * 
 * Laravel 应用的目录结构
 * 
 * 
 * 1、目录
 * 根目录默认包含一下一级子目录：
 * 
 * app：存放应用核心代码，如模型、控制器、命令、服务等
 * bootstrap：存放 Laravel 框架每次启动时用到的文件
 * config：用于存放项目所有配置文件
 * database：存放数据库迁移和填充类文件
 * public：Web 应用入口目录，用于存放入口文件 index.php 及前端资源文件（CSS、JS、图片等）
 * resources：用于存放与非 PHP 资源文件，如视图模板、语言文件、待编译的 Vue 模板、Sass、JS 源文件
 * routes：项目的所有路由文件都定义在这里
 * storage：用于存放缓存、日志、上传文件、已经编译过的视图模板等
 * tests：存放单元测试及功能测试代码
 * vendor：通过 Composer 安装的依赖包都存放在这里，通常该目录会放到 .gitignore 文件里以排除到版本控制系统之外
 * 
 * 
 * 2、文件
 * 
 * .env.example/.env：用于配置环境变量，.env.example 是一个示例模板，而 .env 是真正的配置文件，由于包含敏感信息，通常也将其放到 .gitignore 文件中。
 * artisan：允许你在项目根目录下通过 php artisan 执行 Artisan 命令
 * .gitignore 和 .gitattributes：Git 配置文件
 * composer.json 和 composer.lock：Composer 配置文件
 * webpack.mix.js：Laravel Mix Webpack 配置文件，用于编译和打包前端资源
 * package.json：配置前端资源依赖和脚本（类似于 composer.json 之于 PHP）
 * phpunit.xml：PHPUnit 配置文件
 * server.php：用于通过 php artisan serve 启动 PHP 内置服务器进行一些简单的本地预览
 * yarn.lock：类似于 composer.lock 之于 Composer，指定 NPM 包版本
 * .editorconfig：用于在不同 IDE 或编辑器中维护代码风格的一致性
 * 
 * 
 * 3、启动方式
 * 
 * 方法一：Laravel框架提供了更简单的方式启动（相比配置apache）
 * 执行命令：#php artisan serve
 * 
 * 不推荐使用：
 * （1）能够跑php代码，但是不启动数据库
 * （2）该方式启动后，如果修改类项目的配置.env的话，需要重新启动才会生效
 * （3）如果使用命令行方式进行启动，则如果继续访问页面，需要命令行不能关闭
 * 
 * 方法二：使用wamp或lamp环境（常见）
 * 
 * <VirtualHost *：80>
 *  #站点管理员的邮箱，当站点产生500错误（服务器内部错误）的时候会显示页面上
 * ServerAdmin webmaster@yourdomain.com
 * #站点的根目录
 * DocumentRoot:"E:\webdocs\20190708\public"
 * #站点需要绑定的域名
 * ServerName edu.i-lyn.cn
 * #针对站点的详细配置
 * <Directory "E:\webdocs\20190708\public">
 *  allow from all
 * AllowOverride all
 * Options +indexes
 * </Directory>
 * </VirtualHost>
 * 
 * 修改之后要重启apache
 * 
 * 修改hosts文件（修改之后不需要重启apache）
 * 
 * 
 * 
 */


/**
 * 
 * 路由
 * 在 Laravel 应用中，定义路由有两个入口，一个是 routes/web.php，用于处理终端用户通过 Web 浏览器直接访问的请求，
 * 另一个是 routes/api.php，用于处理其他接入方的 API 请求（通常是跨语言、跨应用的请求）
 * 
 * 
 * 1、路由定义的格式：
 * Route::请求方式('请求的URL', 匿名函数或控制器响应的方法)
 * 
 * Route::get('/', function () {
 *     return view('welcome');
 * });
 * 
 * Route::get('home', function () {
 *     return view('welcome');
 * });
 * 
 * 注意：路由地址中额第一个"/"可以不写，（包括“根路由”）
 * 
 * 路由的请求方式
 * 
 * Route::post('/', function () {}); 
 * Route::put('/', function () {});
 * Route::delete('/', function () {});
 * Route::any('/', function () {});
 * Route::match(['get', 'post'], '/', function () {});
 * 
 * 如果要解决“<form action='' method='post'>“这样的问题，需要下面的两个方法解决：
 * 
 * 有时候还需要注册路由响应多个HTTP请求---这可以通过match方法来实现，或者，
 * 可以使用any方法注册一个路由来响应所有HTTP请求
 * 
 * Route::match(['get', 'post'], '/', function() {
 *  //
 * });
 * 
 * Route::any('foo', function(){
 *  //
 * });
 * 
 * 
 * 注意：如果路由方法与实际的请求类型不一致，则会报错
 * 
 * 
 * 2、路由参数
 * 路由参数其实就是给路由传递参数
 * 参数分为必须参数和可选参数
 * 
 * 必选参数：一旦在路由中定义来，则必须传递，不传递就会报错
 * 
 * Route::get('user/{id}', function ($id) {
 *     return "用户ID: " . $id;
 * });
 * 
 * 路由参数的传递通过路由地址中的“{参数名}”的形式，该形式是必选参数的形式，可以选的则使用“{参数名?}”
 * 
 * Route::get('user/{id?}', function ($id = 1) {
 *     return "用户ID: " . $id;
 * });
 * 
 * 传统的方法
 * Route::get('user', function () {
 *     return "用户ID: " . $_GET['id'];
 * });
 * 
 * 
 * 3、路由别名
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
 * 
 */