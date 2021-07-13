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
 * 在laravel中友好输出函数：dd(需要打印的内容)
 * dd=dump+die;
 * 
 * dd函数之后的内容将不会继续执行
 * 
 * dump方法可以打印，但是后续代码会继续执行
 * 
 * dump(Input::get('addr', '北京市顺义区京顺路99号'))
 * dump($_GET['mobile'])
 * 
 * 
 */


/**
 * 
 * DB类操作数据库（重点）
 * 
 * 按照MVC的架构，对数据的操作应该放在Model中完成，但如果不使用Model，
 * 我们也可以用laravel框架提供的DB类操作数据库，而且，对于某些极其复杂的sql
 * 用Model已经很难完成，需要开发者自己手写sql语句，使用DB类去执行原生sql。laravel中
 * DB类的基本用法DB::table('tableName')获取操作tableName表的实例（对象）
 * 
 * 1、数据表的创建与配置
 * 
 * 建立数据库
 * （1）sql语句
 * （2）图形节目   phpAdmin   Navicat
 * 
 * 
 * 数据库的连接配置文件位于 config/database.php，
 * 和很多其他 Laravel 配置一样，你可以为数据库配置多个「连接」，然后决定将哪个「连接」作为默认连接。
 * 
 * 'default' => env('DB_CONNECTION', 'mysql'),
 * 
 * 当然，默认数据库连接、数据库名称以及数据库用户名和密码等敏感信息都保存到 .env 文件中了，然后通过 env 辅助函数读取：
 * 
 * 
 * 2、增加信息（insert）
 * 
 * 对数据库中的某个表增加数据主要有两个函数可以实现，分别是insert()和insertGetId();
 * 
 * insert(数组)可以同时添加一条或多条，返回值是布尔类型
 * 
 * insertGetId(一维数组)，只能添加一条数据，返回自增的id。
 * 
 * 说明：数组里的元素要求是键值对的关系（关联数组）
 * 
 * 语法：
 * DB::table('表名')->insert();      连贯操作/链式操作
 * 
 * 
 * 3、修改数据（update）
 * 数据修改可以使用update(), increment()和decrement()方法来实现
 * 
 * （1）Update方法可以修改整个记录中的全部字段
 * （2）increment()和decrement()表示修改数字字段的数值（递增或者递减），典型的应用：记录登录次数、积分的增加
 * 
 * 语法：
 * DB::table('表名')->where()->update([]);
 * 
 *  注意：where方法之后可以继续调用where之类的方法
 * ->where()->where()->where()..这个语法是并且(and)关系语法
 * ->where()->orWhere()->orWhere()...       这个语法是或者（or）关系语法
 * orwhere方法的参数与where一致
 * Where参数顺序:
 * ->where(字段名，运算符，字段值)。例如id=1，则可以写成:where('id', '=', '1'),简写成where('id',1);
 * 只有=号可以简写
 * 
 * 
 * 注意：where和update方法的顺序是不能颠倒的，update必须在最后
 * 
 * DB::table('member')->increment('age');       每次加1
 * DB::table('member')->increment('age', 5);        每次加5
 * 
 * DB::table('member')->decrement('age');       每次减1
 * DB::table('member')->decrement('age', 5);        每次减5
 * 
 * 
 * 
 * 4、查询数据（get）
 * （1）取出基本数据
 * 案例1:获取member表中所有数据
 * DB::table['member']->get();      //相当于select * from member
 * 返回值是一个集合对象
 * 
 * 注意：由于一条记录都是一个对象，因此在循环或者访问字段的值的时候需要使用对象调用
 * 属性的方法进行访问，不能再用数组形式进行访问，否则会报错
 * 
 * （2）获取id<3
 * DB::table['member']->where('id', '<', 3)->get();
 * 
 * （3）查询id>2 且年龄<25
 * 
 * select * from memeber where id>2 and age<25
 * 
 * DB::table['member']->where('id', '>', 2)->where('age', '<', 25)->get();
 * 
 * 
 * （4）取出单行数据
 * DB::table['member']->where('id', 1)->first();   返回值是一个对象
 * first方法等价于limit 1
 * 
 * 注意：first和get的区别，first返回的是一个对象，get即便其查询出只有一条记录，其也是一个collection结果集
 * 
 * 总结常见：
 * 使用first的场景：登录页面、详情页面、修改功能等
 * 使用get的场景：列表页面、设计接口等
 * 
 * （5）获取某个具体的值（一个字段）
 * DB::table['member']->where('id', 1)->value('name');
 * 
 * 案例1:查询出id为1的用户的名字（只想要名字）
 * 
 * （6）获取某些字段数据（多个字段）
 * 
 * DB::table['member']->select(['name', 'email'])->get();
 * 
 * DB::table['member']->select([name as user_name])->get();   //  起别名
 * 
 * $db->select(DB::raw('name,age'))->get();     //不解析字段，原样使用，例如count(*)
 * 
 * 
 * DB::table['member']->select(['name', 'email'])->where('id', 1)->get();
 * 
 * 
 * 
 * （7）排序操作
 * DB::table['member']->orderBy('age', 'desc')->get();
 * 
 * 语法：orderBy(排序字段，排序规则)
 * 
 * 案例：查询列表，要求按照age字段降序排列
 * 
 * asc：升序
 * desc：降序
 * 
 * （8）分页操作
 * DB::table['member']->limit(3)->offset(2)->get();
 * limit:表示限制输出的条数（分页中每页显示记录数）
 * 
 * offset：从什么地方开始
 * 组合起来等价于limit 2,3       limit 2(offset),3(length)
 * 
 * 归纳：具体的查询等操作方法一般都是放在连贯操作的最后，辅助方法可以放在中间，并且其先后顺序是无所谓的
 * 
 * （9）删除数据（delete）
 * 在删除中，有两种方式：物理删除（本质就是删除），逻辑删除（本质是修改）
 * 
 * 数据删除可以通过delete函数和truncate函数实现
 * 
 * delete 表示删除记录
 * truncate 表示清空整个数据表
 * DB::table['member']->where('id',1)->delete()
 * 
 * 
 * 
 * (10)执行任意的SQL语句（补充了解）
 * 
 * （1）执行原生查询语句
 * DB::select("select 语句");
 * 
 * (2)执行原生插入语句
 * DB::insert("insert 语句");
 * 
 * （3）执行原生修改语句
 * DB::update("update 语句");
 * 
 * （4）执行原生删除语句
 * 
 * DB::delete("delete 语句");
 * 
 * （5）执行一个通用语句（没有返回值的语句，例如create table 等）
 * DB::statement("语句");
 * 
 */


/**
 * 
 * 视图操作
 * 
 * 视图可以分目录管理
 * 视图的后缀在laravel中一般都是“blade.php”
 * 视图的创建无法通过artisan来实现
 * 
 * 1、视图文件的命名和渲染
 * 
 * （1）文件名习惯小写（建议小写）
 * （2）文件名的后缀是blade.php（因为laravel里面有一套模板引擎就是使用blade，可以直接使用标签语法{{$title}},也可以使用原生的PHP语法显示数据 ）
 * （3）需要注意的是也可以使用.php结尾，但是这样的话就不能使用laravel提供的标签{{$title}}语法显示数据，只能使用原生语法
 * <?php echo $title ?>显示数据
 * 两个文件视图同时存在，则blade.php后缀的优先显示
 * 
 * 展示视图的方法：
 * return view('视图文件的名称');
 * 
 * 视图可以进行分目录管理的，例如需要展示home/test/test2视图，
 * 则可以写成return view('home/test/test2');当然也支持点写法：view('home.test.test2');
 * 
 * 
 * 2、变量的分配与展示
 * 语法：
 * （1）view(模板文件名称，数组)     数组就是需要分配的变量集合，数组是一个键值数组，其键与变量名尽量一致
 * （2）view(模板文件名称)->with(数组)
 * （3）view(模板文件名称)->width(名称，值)->width(名称，值)
 * 使用view()方式渲染一个视图后，在blade.php的视图文件中，模板中输出变量使用“{{$变量名}}” （变量名就是分配过来数组的键）
 * $data = time();
 * view('admin.test.test3', ['data' => $data]);
 * 
 * 3、扩展：compact函数使用（传参）
 * compact函数，是PHP内置函数跟laravel框架没有关系，作用主要是用于打包数组的
 * 语法：compact('变量名1', '变量名2',....)
 * 
 * $data = time();
 * $data2 = 'aaa';
 * $data3 = 'ccc';
 * $data4 = ['1', '3'];
 * 
 * var_dump(compact('data', 'data2', 'data3', 'data4'));
 * 
 * view('admin.test.test3', compact('data', 'data2', 'data3', 'data4'));
 * 
 * 4、循环与分支语法标签
 * 在视图里面遍历数据
 * //PHP的写法
 * foreach($variable as $key => $value){
 * 
 * }
 * 
 * //laravel中视图的写法
 * @foreach($variable as $key => $value)
 * 
 * @endforeach
 * 
 * //在视图里面可以执行if判断
 * //PHP写法
 * if() {
 * 
 * }elseif() {
 * 
 * }elseif() {
 * 
 * }else{
 * }
 * 
 * //laravel中视图if语句
 * @if() 
 * 
 * @elseif() 
 * 
 * @elseif() 
 * 
 * @else
 * 
 * @endif
 * 
 * 
 * 5、模板继承/包含
 * 
 * 继承不仅仅在PHP类中存在，在视图中同样存在。一般用于做有公共部分的页面。
 * 以上图为例，可以将头和为单独的放到一个页面中去（父页面），可变的区域称之为子页面
 * 如果子页面需要用到父页面的东西，则需要使用继承
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */



