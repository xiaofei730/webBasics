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
 * Route::请求类型（路由地址,响应方法）->name（别名）
 * 
 * Route::get('user/{id?}', function ($id = 1) {
 *     return "用户ID: " . $id;
 * })->name('user.profile');
 * 
 * <a href="{{ route('user.profile', ['id' => 100]) }}">
 * // 输出：http://blog.test/user/100
 * 
 * 查看系统所有的路由：php artisan route:list
 * 
 * 4、路由群组（理解）
 * 有后台路由如下：
 * /admin/login
 * /admin/logout
 * /admin/index
 * /admin/user/add
 * /admin/user/del
 * ....
 * 他们的共同点是，都有admin/前缀，为了管理方便，可以把他们放到一个路由分组中，这个分组称之为路由群组
 * 
 * 使用prefix属性指定路由前缀，也就是其路由中都 具备的相同部分
 * 
 * 语法：Route::group(公共属性数组，回调函数);    回调函数中放的剔除公共属性之后的路由
 * 
 * 比如：响应为所有路由URLs前面添加前缀admnin
 * 
 * Route::group(['prefix' => 'admin'], function(){
 *      Route::get('login', function(){});
 *      Route::get('logout', function(){});
 * })
 * 
 * Route::prefix('admin')->group(function () {
 *      Route::get('login', function(){});
 *      Route::get('logout', function(){});
 * }); 
 * 
 * 
 * 中间件
 * 
 * Route::group(['middleware' => 'auth'], function () { 
 *     Route::get('dashboard', function () { 
 *         return view('dashboard'); 
 *     }); 
 *     Route::get('account', function () { 
 *         return view('account'); 
 *     }); 
 * });
 * 
 * Route::middleware('auth')->group(function () {
 *     Route::get('dashboard', function () {
 *         return view('dashboard');
 *     });
 *     Route::get('account', function () {
 *         return view('account');
 *     });
 * });
 * 
 * 
 * 
 * 
 */



/**
 * 
 * M 代表模型（Model），V 代表视图（View），C 代表控制器（Controller），
 * 
 * 控制器负责组织路由和业务逻辑（当然，对于更加复杂的业务逻辑还会引入 Service 层），
 * 模型类负责底层数据存取与处理，
 * 而视图层负责数据渲染与页面交互
 * 
 * 1、控制器使用
 * 
 * 控制器主要作用负责接收用户输入请求，调度模型处理数据最后利用视图展示数据
 * 
 * 
 * 创建控制器：artisan指令
 * 默认在controller文件夹下
 * php artisan make:controller [目录路径/]控制器名(大驼峰)Controller
 * 
 * 2、控制器路由（项目以该方式为主）
 * 
 * 即。如何使用路由规则调用控制器下的方法，而不再走回调函数
 * 路由设置格式基本相同，只是将匿名函数缓存‘控制器类名@方法名’
 * 定义格式如下：
 * Route::请求方法("路由表达式", 控制器@方法名)
 * 
 * Route::get('task/create', 'TaskController@create');
 * 
 * Route::get('task/create', 'Admins\TaskController@create');
 * 
 * 
 * 3、接收用户输入
 * 
 * 接收用户输入的类：Illuminate\Support\facades\Input       【门面】
 * Facades：“门面”的思想。门面介于一个类的实例化与没有实例化中间的一个状态。
 * 其实是类的一个接口实现。在这个状态可以不实例化类但是可以调用类中的方法，说白了就是静态方法调用
 * 
 * 
 * input::all();        获取所有的用户输入
 * input::get('参数的名字');    获取单个的用户的输入
 * input::only(['id', 'age']);        获取指定几个用户的输入
 * input::except(['id', 'age']);      获取指定用户的输入以外的所有的参数
 * input::has('name');          判断某个输入的参数是否村镇
 * 
 * 4、在laravel中如果需要使用facades的话，但是又不想写那么长的引入操作
 * 
 * use Illuminate\Support\facades\Input
 * 则可以在config/app.php中定义长串的别名（在aliases数组中定义别名）
 * 
 * 
 * 
 * 
 */