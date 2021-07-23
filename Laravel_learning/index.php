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
 * 继承语法：
 * 子模板中按以下语法书写：
 * @extends('需要继承的模板文件名')其名称要是完整的路径，类似view视图路径
 * 通过section标签绑定区块/部件到父级页面yield标签的参数名。
 * @section(区块名称)
 * 代码
 * @ensection
 * 
 * 
 * @yield 用于指定需要子视图继承实现的内容区块，我们可以通过传递第二个参数给该指令用于指定子视图未继承时的默认值，
 * section/@show 也用于指定子视图需要继承实现的内容区块，
 * 并且提供了默认区块内容，与 @yield 不同之处在于，
 * @section/@show 指定的默认内容子视图可以通过 @parent 访问，而 @yield 指定的默认内容对子视图不可见。
 * 
 * 模板包含：
 * 语法：@include(模板文件名)   文件名不含后缀，语法类型view方法参数
 * 
 */



/**
 * 
 * CSRF攻击
 * 1、什么是CSRF攻击？
 * CSRF是跨站请求伪造（Cross-site request forgery）的英文缩写
 * 
 * Laravel 通过自带的 CSRF 保护中间件让避免应用遭到跨站请求伪造攻击变得简单：
 * Laravel 会自动为每一个被应用管理的有效用户会话生成一个 CSRF “令牌”，
 * 然后将该令牌存放在 Session 中，该令牌用于验证授权用户和发起请求者是否是同一个人。
 * 
 * Laravel提供来一个全局帮助函数csrf_token来获取该Token值，因此只需在视图提交
 * 表单中添加如下HTML代码即可在请求中带上Token
 * <input type='hidden' name="_token" value="<?php echo csrf_token();?>">
 * 
 * 
 * Laravel框架默认开启来csrf认证
 * 
 * {{csrf_token}}   表示直接输出token值；
 * {{csrf_field()}}     表示的是直接输出整个隐藏域的input框
 * 
 * csrf验证机制与图形验证码的原理是一致的，都是将用户提交的值与session中的值进行对比
 * 如果一致则通过，否则不通过
 * 
 * 针对从csrf_token与csrf_field()的选择问题
 * 如果只需要使用值（例如，在ajax的post提交的时候），则使用csrf_token，如果需要的是隐藏域（在表单里），则使用csrf_field()
 * 
 * 2、从CSRF验证中排除例外路由
 * 并不是所有请求都需要避免CSRF攻击，比如去第三方API获取数据的请求
 * 可以通过在VerifyCsrfToken(App\Http\Middleware\VerifyCsrfToken.php)中间件将要排除的
 * 请求URL添加到$except属性数组中
 * 
 * 
 * 
 * 
 */

/**
 * 
 * 模型操作（AR模式）
 * 
 * Laravel 内置的 Eloquent ORM 提供了一个美观、简单的与数据库打交道的 ActiveRecord 实现，
 * 每张数据表都对应一个与该表进行交互的模型（Model），
 * 通过模型类，你可以对数据表进行查询、插入、更新、删除等操作。
 * 
 * AR模式三个核心（映射关系）
 * 每个数据表               与数据表进行交互的Model模型映射(实例化模型)
 * 记录中的字段             与模型类的属性映射（给属性赋值，字段名就是属性名）
 * 表中的每个记录           与一个完整的请求实例映射（具体的CURD操作）
 * 
 * 
 * 1、定义模型
 * 
 * 模型类通常位于 app 目录下，你也可以将其放在其他可以被 composer.json 文件自动加载到的地方。
 * 所有 Eloquent 模型都继承自 Illuminate\Database\Eloquent\Model 类
 * 
 * 命名规则
 * 本身laravel对模型的命名没有严格的要求，一般采用 表名（首字母大写）.php
 * 比如：Member.php  User.php   Goods.php
 * 
 * 创建模型实例最简单的办法就是使用 Artisan 命令 make:model：（模型也可以分目录管理）
 * php artisan make:model Member
 * 
 * 
 * 注意我们并没有告诉 Eloquent 我们的 Member 模型使用哪张表，
 * 默认规则是小写的模型类名复数格式作为与其对应的表名（除非在模型类中明确指定了其它名称）。
 * Eloquent 认为 Member 模型存储记录在 members 表中。你也可以在模型中定义 table 属性来指定自定义的表名：
 * 
 * 注意事项
 * 第一：（必做）定义一个$table属性，值是不要前缀的表名（真实表名），如果不指定则使用类名的复数形式作为表名
 * 如果模型为Member模型在不知道table属性的情况下，其默认会去找members表，修饰词：protected
 * 
 * 第二：（可选）定义$primaryKey属性，值是主键名称，如果需要使AR模式的find方法，则可能需要指定主键（Model::find(n)）,
 * 在主键字段不是id的时候需要指定主键。修饰词：protected
 * 
 * 第三：（可选）定义$timestamps属性，值是false，如果不设置为false，则默认会操作表中的created_at和updated_at字段
 * 我们表中一般没有这两个字段，所以设置为false，表示不要操作这两个字段。修饰词：public
 * 
 * 第四：（可选）定义$fillable属性，表示使用模型插入数据时，允许插入到数据库的字段信息。格式是一维数组形式
 * 修饰词：protected（当使用模型的create、save方法的时候最好就得写上这个属性）反向指定的属性：$guarded
 * 
 * 
 * 2、模型控制器中调用
 * （1）直接像使用DB门面一样的操作方式，以调用静态方法为主的形式，该形式下模型不需要实例化
 * 例如：Member::get() 等价于 DB::table('member')->get()
 * （2）实例化模型然后再去使用模型类（普通）
 * 例如：$model = new Member(); $model->get();
 * 
 * 两种形式的选择标准：
 * 如果使用的方法都是laravel框架自带的，则任意选择
 * 如果使用的方法有用户自己在模型中定义的，则选择第二种
 * 
 * 3、基本操作    
 * 
 * （1）添加数据
 * 在laravel里面完成数据的添加可以使用两种方式
 * 方式一（AR模式）：使用AR模式必须要实例化模型
 * 注意：在laravel里面添加数据的时候，需要先实例化模型，然后为模型设置属性，最后调用save方法即可
 * 
 * $member = new Member();
 * $member->name = value;   
 * $member->age = value;  
 * $member->save();
 * 
 * 方式二：（隐性的效果）  
 * 
 * Member::create($request->all())      //返回值是一个对象
 * 
 * 注意：Member模型一定要设置$fillable，否则会报错
 * $fillable = ['name', 'age', 'email'];
 * 
 * 
 * 
 * 
 * Request类的使用：
 * （1）对象的传递，需要在方法的括号里以形参的形式接收Request类，只有接收类才能在方法中使用
 * 
 * （2）request语法（与input门面有点类似，方法名一致，但是input调用的是静态方法，而request不是）
 * $request->all();         //获取全部传递数据
 * $request->input('name');     //获取指定
 * $request->only(['name1', 'name2',...]);
 * $request->except(['name1', 'name2'...]);
 * $request->has('name');
 * $request->get('name');
 * 
 * 注意：a：DB类中的insert方法，在模型中也是可以使用的（其他方法也是如此）
 * b：insert方法必须要求先排除不写入数据表的字段，模型中的fillable属性对insert不生效，如果不事先排除如‘token’字段，则会报错
 * 
 * 
 * （2）查询操作
 * 获取指定主键的一条数据
 * $info = Member::find(4);     //静态方法调用，获取主键为4的数据【等价与条件where id=4】
 * 
 * 其结果集默认是一个对象
 * 
 * 如果需要在laravel中对象的结果集转化成数组，则需要在最终添加方法的调用：
 * ->get()->toArray()
 * $data = Member::find(4)->toArray();
 * 
 * 
 * 查询多行并且指定字段
 * Member::all()        //查询全部的数据，类似与get()
 * Member::all([字段1，字段2])          //与get方法的区别，all不支持其他的辅助查询方法
 * Member::get();
 * Member::get([字段1，字段2]) 
 * 
 * 按条件查询指定多个字段
 * Member::where('id', '>', 2)->get(['列1', '列2'])     //数组选列 
 * Member::where('id', '>', 2)->select(['列1', '列2'])->get()     //字符串选列 
 * Member::where('id', '>', 2)->selec(['列1', '列2'])->get()      //数组选列 
 * 
 * 
 * （3）修改数据
 * 注意：在laravel里面如果需要更新数据（ORM模型方式），需要先调用模型的find方法获取对应的记录，返回一个模型对象，
 * 然后为该模型对象设置要更新的数据（对象的属性）。最后调用save方法即可
 * 例如
 * $user = User::find($id);
 * $user->title = $_POST['title'];
 * $user->content = $_POST['content'];
 * $user->save() ? 'OK' : 'Fail'
 * 
 * Member::where('id', 2)->update(['age' => 55]) 
 * 
 * （4）删除数据
 * 注意：在laravel里面如果要删除数据，如果需要使用AR模式删除数据必须先根据主键id查询对应的记录，
 * 返回一个模型对象，然后调用模型对象的delete方法即可
 * $user = User::find($id);
 * $user->delete() ? 'OK' : 'Fail'
 * 
 * 比较常见的使用模型的场景
 * a、可能在数据入表之前需要对数据进行比较的处理步骤，
 * 这个时候建议在模型中自定义方法对数据进行处理
 * b、如果需要使用关联模型的话，则必须要定义与使用模型
 * 
 * 
 * 
 */



/**
 * 
 * 自动验证
 * 自动验证：前端会有一些对表单的验证操作（通过JavaScript），但是JavaScript有些情况下
 * 是不好用的（例如禁用JavaScript）。因此后端也需要有一套类似的机制，能够在后端实现对用户提交的数据进行验证，
 * 这个就是后端的自动验证
 * 
 * 1、编写验证逻辑
 * 
 * 现在我们准备用验证新博客文章输入的逻辑填充 store 方法。我们使用 Illuminate\Http\Request 对象提供的 validate 方法来实现这一功能，
 * 如果验证规则通过，代码将会继续往下执行；
 * 反之，如果验证失败，将会抛出一个异常，相应的错误响应也会自动发送给用户。
 * 在这个传统的 HTTP 请求案例中，将会生成一个重定向响应，如果是 AJAX 请求则会返回一个 JSON 响应。
 * 
 * 
 * 存储博客文章
 *
 * @param  Request  $request
 * @return Response
 *
 * public function store(Request $request){
 *     $validatedData = $request->validate([
 *         'title' => 'required|unique:posts|max:255',
 *         'body' => 'required',
 *         'filesize' => 'required|integer|min:1|max:100',
 *         'email' => 'required|email',
 * 
 *     ]);
 * 
 *     // 验证通过，存储到数据库...
 * }
 * 
 * 验证规则还可以通过数组方式指定，而不是通过 | 分隔的字符串：
 * 
 * $validatedData = $request->validate([
 *     'title' => ['required', 'unique:posts', 'max:255'],
 *     'body' => ['required'],
 * ]);
 * 
 * 实际执行代码之前，需要在数据库中创建 posts 数据表，因为这里用到了 unique:posts 这个验证规则，
 * 该规则会去数据库中查询传入标题是否已存在以保证唯一性。
 * 
 * 首次验证失败后中止后续规则验证
 * 
 * 有时候你可能想要在首次验证失败后停止检查该属性的其它验证规则，要实现这个功能，可以在规则属性中分配 bail 作为首规则：
 * 
 * $request->validate([
 *     'title' => 'bail|required|unique:posts|max:255',
 *     'body' => 'required',
 * ]);
 * 
 * $validator = Validator::make($input, $rules, $messages);
 * 
 * 2、显示验证错误信息
 * 
 * 再次强调，我们并没有在 GET 路由中显式绑定任何错误信息到视图。
 * 这是因为 Laravel 总是从 Session 数据中检查错误信息，而且如果有的话会自动将其绑定到视图。
 * 所以，值得注意的是每次请求返回的响应视图中总是存在一个 $errors 变量，你可以通过它获取表单验证错误信息。
 * 
 * 
 * 3、把输出效果转成中文
 * 方法一：
 * 可以在自定义验证的时候，给validate方法传递第三个参数，第三个参数即错误提示
 * 
 * 
 * $this->validate($request,[
 *     'title' => 'bail|required|unique:posts|max:255',
 *     'body' => 'required',
 * ],[
 *      'title.required' => '标题不能为空',
 *      'title.max' => '标题不能超过255'
 * ]);
 * 
 * 该方式比较繁琐，每个规则都有自己定义错误信息
 * 
 * 方法二：借助于第三方语言包
 * 在官网搜索laravel-lang
 * 
 * （1）需要寻找下载命令
 * （2）使用composer进行安装，在项目根目录下允许上述命令
 * （3）语言包文件在vendor/caoue/laravel-lang中，将你需要的语言目录复制到resources/lang目录下即可
 * （4）在文件(config/app.php)中修改locale的值，改成你需要使用的语言简称
 * 
 * 注意：并不是所有的字段都有对应的反应（或者有的翻译可能不是很准确），如果想自己定义翻译，则需要去修改语言包文件代码
 * 
 * 
 * 
 * 
 */



/**
 * 
 * 文件上传
 * 在laravel里面实现文件的上传是很简单的，压根不用引入第三方的类库，
 * 作者把上传作为一个简单的http请求看待的
 * 
 * 问题：请你说出文件上传的本质（核心思想）？
 * 就是临时文件的移动，move_upload_file
 * a、先去判断文件是否正常和存在
 * b、先获取相关的信息（可选）
 * c、保存文件
 * 
 * 获取文件的方式：既可以通过file方法来获取也可以通过动态属性来获取，二选一
 * 可以使用 Illuminate\Http\Request 实例提供的 file 方法或者动态属性来访问上传文件， 
 * file 方法返回 Illuminate\Http\UploadedFile 类的一个实例，
 * 该类继承自 PHP 标准库中提供与文件交互方法的 SplFileInfo 类：
 * 
 * $file = $request->file('photo');
 * $file = $request->photo;
 * 
 * 
 * 创建上传文件的保存路径：（一定要在public下，确保浏览器能够访问）
 * 
 * //判断文件是否上传正常与存在
 * if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
 *     //对文件进行重新的命名
 *      $name = sha1(time().rand(100000, 999999)).'.'.$request->photo->extension();
 *      //文件的移动操作
 *      $request->file('photo') -> move('statics/upload', $name);
 *      $path = '/statics/upload'.$name;
 * }
 * 
 * $data = $request->except(["_token", "photo"]);
 * $data['avatar'] = isset($path) ? $path : '';
 * $result = Member::insert($data);
 * 
 * 注意：关于项目中使用路径（"./"与“/”）的说明：
 * 如果一个路径是给PHP代码使用的则建议使用“./”，如果路径是给前端浏览器使用的则使用“/”
 * 
 * 
 */


/**
 * 
 * 数据分页
 * 在laravel里面完成分页是很简单的，它的思想与之前的框架有些不一样，
 * 之前框架使用的是分页类完成分页，laravel是直接调用模型的分页方法，返回对应的数据和分页的字符串
 * 
 * 案例：使用分页功能实现当前member数据表的分页效果，由于数据量较，可以考虑每页显示一个记录
 * a、查询符合分页条件的总的记录数
 * b、计算总的页数（总记录数/每页记录数，并且向上取整）
 * c、拼凑分页的链接
 * d、（核心）使用limit语法来限制分页的记录数
 * e、展示分页的页码和分页数据
 * f、如果可以，建议去考虑下分页的样式显示问题
 * 
 * 在laravel中分页有2个提供者：DB查询构建器，另外可以使用模型来实现
 * 用法基本一致
 * 
 * 
 * 让我们先来看看如何在查询中调用 paginate 方法。
 * 在本例中，传递给 paginate 的唯一参数就是你每页想要显示的数目，这里我们指定每页显示 15 个：
 * 
 * $users = DB::table('users')->paginate(15);
 * 
 * 基于 Eloquent 结果集进行分页
 * 
 * 分页的基本语法：
 * Model::paginate(每页显示的记录数)        同样，paginate和get一样，支持使用where以及orderBy等辅助查询的方法
 * 
 * $users = App\Models\User::paginate(15);
 * 
 * 显示分页结果
 * 
 * <div class="container">
 *     @foreach ($users as $user)
 *         {{ $user->name }}
 *     @endforeach
 * </div>
 *     
 * {{ $users->links() }}
 * 
 * 通过数据对象调用links方法显示分页码
 * 语法：   {{ $保存数据的对象 -> links() }} 生成的链接（使用render方法替代也可以）
 * 
 * 
 */




/**
 * 
 * 验证码：captcha，全自动区分人与计算机的图灵测试
 * 
 * 回顾：生产验证码需要经过：画画布、生成干扰线、生成噪点、生成验证码、生成验证码存入session、输出图片
 * 
 * 常见的验证码类型：字符验证码、短信验证码、电话验证码、12306类型验证码、拖拽验证码等。
 * 1、验证码依赖安装
 * 去packageist(http://packagist.p2hp.com)网站搜索验证码的代码依赖：关键词：captcha mews/captcha
 * 
 * 
 *  注意：验证码有校性验证规则，captcha
 * 
 * $request->validate([
 *     'title' => 'bail|required|unique:posts|max:255',
 *     'body' => 'required',
 *     'code' => 'required|captcha'
 * ]);
 * 
 */


/**
 * 
 * 数据表的迁移与填充
 * 迁移：创建数据表的操作+删除数据表的操作
 * 填充：往数据表里填充写入测试的数据（数据的插入操作）
 * 
 * 1、数据的迁移操作
 * 在迁移过程中，操作可以分为两个部分：创建与编写迁移文件、执行迁移文件
 * 
 * 迁移文件的创建与编写
 * 
 * 生成迁移
 * 使用 Artisan 命令 make:migration 就可以创建一个新的迁移：
 * php artisan make:migration 迁移文件名
 * 
 * php artisan make:migration create_users_table
 * 
 * 迁移文件不需要分目录进行管理，可以直接书写名称即可
 * 
 * 新的迁移位于 database/migrations 目录下，每个迁移文件名都包含时间戳从而允许 Laravel 判断其顺序。
 * 
 * 
 * 迁移文件结构
 * 迁移类包含了两个方法：up 和 down。up 方法用于新增表，列或者索引到数据库，
 * 而 down 方法就是 up 方法的逆操作，和 up 里的操作相反。
 * 
 * public function up()
 *     {
 *         Schema::create('flights', function (Blueprint $table) {
 *             $table->increments('id');
 *             $table->string('name');
 *             $table->string('airline');
 *             $table->timestamps();
 *         });
 *    }
 * 
 * 在创建数据表的列的时候遵循语法：
 * $table 表示整表的实例
 * 语法：$table->列类型方法(字段名, [长度/值范围]) -> 列修饰方法([修饰的值])
 * 
 * 列类型方法的作用：指定列的名称并且设置列的类型长度或者其值范围（针对枚举类型）
 * 修饰方法：主要补充列的一些特征，例如有些列不能为空，或者有默认值等等
 * 
 * 
 * 2、 运行迁移文件
 * 执行分为up执行和down执行
 * up方法的执行：
 * 如果当前项目中第一次执行迁移文件的话，则需要先去执行：
 * php artisan migrate:install
 * 
 * 在执行过上述的命令之后，在数据表中会多出一个数据表：migrations
 * 
 * migrations中的字段migration代表已经执行过的迁移文件名
 * 字段batch代表批次号，执行的序号
 * 
 * 作用：用于创建记录迁移文件的记录数据表（可以看作类似于SVN的版本控制机制）
 * 需要执行up方法，则需要执行命令：（注意：需要删除系统自带的迁移文件，只保留自己的）
 * 删除的原因，默认迁移操作会执行迁移文件中所有没有被执行的迁移文件。
 * 
 * 运行应用中所有未执行的迁移文件，可以使用 Artisan 命令 migrate：
 * php artisan migrate
 * 
 * 问题：如果再一次执行php artisan migrate会怎么样？
 * 不会怎么样，不会有任何操作（在执行迁移的时候系统会将迁移文件夹里面文件于数据表的迁移记录进行匹配，匹配上则不执行，匹配不上则执行）
 * 
 * 
 * down方法执行：（回滚操作，删除数据表）
 * php artisan migrate:rollback （想要回滚最新的一次迁移”操作“，可以使用 rollback 命令，注意这将会回滚最后一批运行的迁移，可能包含多个迁移文件：）
 * 
 * 
 * 回滚操作只删除迁移表中的记录和对应的数据表，其他操作不执行
 * 
 * 注意：删除（回滚）之后会删除上一个批次的迁移记录，并且同批次建立的数据表也会删除
 * 但是迁移文件依旧存在，方便后期继续迁移（创建数据表）
 * 
 * 批次号：同一次被执行的多个迁移文件其批次号相同
 * 
 * 针对迁移文件名的提示：如果迁移文件已经创建好并且执行了，就不要去修改迁移文件的名称，容易出错
 * 
 * 
 * 迁移操作与sql语句操作类似，区别在于迁移文件将原先的sql语句从标准查询语言形式转化成了面向对象的形式
 * 
 * 
 * 
 * 数据表填充器
 * 
 * 填充操作就是往数据表中写测试数据的操作（增加操作），在开发阶段是很实用的功能
 * Laravel 使用填充类提供了一个简单方法来填充测试数据到数据库。所有的填充类都位于 database/seeds 目录
 * 
 * 1、填充器（种子文件）的创建于编写
 * 要生成一个填充器，可以通过 Artisan 命令 make:seeder。所有框架生成的填充器都位于 database/seeds 目录：
 * 
 * php artisan make:seeder 填充器名称  【约定俗成的写法：大写表名+TableSeeder】
 * 
 * php artisan make:seeder UserSeeder
 * 
 * 
 * 2、编写填充器代码，实现往数据表中写入数据
 * 注意：在填充器文件中可以使用DB门面去新增数据，但是需要注意，DB门面在使用时候不需要用户自己引入，
 * 一旦引入则报错，可以直接使用，建议使用DB门面方法写入新的数据
 * 
 * 
 * 3、运行填充器
 * 命令：
 * 
 * 编写好填充器类之后，需要通过 dump-autoload 命令重新生成 Composer 的自动加载器：
 * 
 * composer dump-autoload
 * 运行之后可以使用 Artisan 命令 db:seed 来填充数据库。默认情况下，db:seed 命令运行 DatabaseSeeder 类，
 * 不过，你也可以使用 --class 选项来指定你想要运行的独立的填充器类：
 * 
 * php artisan db:seed
 * php artisan db:seed --class=需要执行的种子文件名（不需要） php artisan db:seed --class=UserSeeder
 * 
 * 
 * 
 * 
 * 
 */



/**
 * 
 * 响应
 * 
 * 在laravel中，响应正常情况下有2个类型：常规的直接响应，另外一个ajax的响应
 * 其中展示视图以及直接响应字符串都属于常规的响应
 * 
 * 例如：常规响应
 * 展示视图
 * 
 * return view('welcome')
 * 
 * 直接返回某个字符串
 * 
 * return 'hello world'
 * 
 * 提示：在laravel框架中，不允许响应布尔值
 * 
 * 
 * 1、ajax请求的响应
 * 
 * 语法：return response()->json(需要json输出的数据)  //数据是数组格式，对象也可以
 * 
 * 注意：在框架中建议不要再去使用php自带json_encode 方法 对数据进行json编码
 * 
 * 两者的区别，框架自带的json输出方式不会解析当前页面中其它的所有Html代码，只会原样输出，
 * PHP自带的json_encode，则会解析当前页面的其它html标记
 * 
 * 
 * 2、跳转响应（重定向）
 * 
 * 在有一些页面，例如同步添加操作，完成操作之后不能停留在当前页面，最好做一个跳转操作，
 * 也就是需要一个跳转的响应
 * 
 * 以之前的“上传操作代码”为例：后续比较理想的情况应该是在处理完成之后需要一个跳转提示，
 * 告知用户是否成功，成功则应该返回上一页，失败则应该输出错误提示
 * 
 * 两个跳转方式任选一个：
 * return redirect(路由)->withErrors([])        该参数的路由可以是完整的请求路由，也可以是通过route方法+别名获取的路由
 * 
 * return redirect()->to(路由)   简写成redirect(路由)
 * 
 * 错误信息的获取与之前自动验证那里的方式一样，通过$errors变量来获取即可
 * 
 * 
 */


/**
 * 
 * 会话控制
 * 
 * 常见应用--增删改查
 * 
 * session默认存到文件中
 * session文件的目录：storage/framework/sessions
 * 
 * Session 配置文件位于 config/session.php。默认情况下，Laravel 使用的 Session 驱动为 file 驱动，
 * 这对许多应用而言是没有什么问题的。
 * 在生产环境中，你可能考虑使用 memcached 或者 redis 驱动以便获取更佳的 Session 性能，
 * 尤其是线上同一个应用部署到多台机器的时候，这是最佳实践。
 * 
 * Session 的 driver 配置项用于定义请求的 Session 数据存放在哪里，Laravel 可以处理多种类型的驱动：
 * 
 * file – Session 数据存储在 storage/framework/sessions 目录下。
 * cookie – Session 数据存储在经过安全加密的 Cookie 中。
 * database – Session 数据存储在数据库中。
 * memcached / redis – Session 数据存储在 Memcached/Redis 缓存中，访问速度最快。
 * array – Session 数据存储在简单 PHP 数组中，在多个请求之间是非持久化的。
 * 
 * 
 * 1、使用session类
 * 
 * 控制器头部引用 use Illuminate\Support\Facades\Session;
 * 
 * 由于session类在app.php中已经定义好别名，所以在控制器中引入的时候可以直接use Session
 * 
 * Session::put('key', 'value');            Session中存储一个变量
 * $value = Session::get('key');            Session中获取一个变量
 * $value = Session::get('key', 'default');     Session中获取一个变量或返回一个默认值（如果变量不存在）
 * 
 * $value = Session::get('key', function(){ return 'default'})
 * 
 * Session::all()       Session中获取所有变量
 * 
 * Session::forget('key')       Session中删除一个变量
 * 
 * Session::flush()         Session中删除所有变量
 * 
 * 补充：session()方法也可以在视图中使用，如： {{ Session::get('code') }}
 * 
 * 在后期如果使用laravel框架自带的验证功能模块（Auth）的话，则session就可以不需要使用了
 * 
 */


/**
 * 
 * 缓存操作
 * 
 * laravel为不同的缓存系统提供了统一的API，缓存配置于config/cache.php。
 * 该文件中你可以指定应用中默认使用哪个缓存驱动。laravel目前支持的缓存后端如：
 * Memcached和redis等
 * 
 * 主要方法：
 * Cache::put()
 * Cache::get()
 * Cache::add()
 * Cache::pull()
 * Cache::forever()
 * Cache::forget()
 * Cache::has()
 * 
 * 系统默认是使用文件缓存，其缓存文件存储的位置位于（storage/framework/cachae/data）
 * 
 * 1、设置缓存
 * 语法：Cache::put('key', 'value', $minutes);
 * key:键
 * Value：值
 * $minutes:有效期，单位是分钟
 * 注意：如果该键已经存在，则直接覆盖原来的值，有效期必须设置，单位是分钟
 * 
 * 语法：Cache::add('key', 'value', $minutes);
 * 
 * add方法只会在缓存项不存在的情况下添加数据到缓存，如果数据被成功添加到缓存返回true，否则，返回false
 * 
 * 永久存储
 * forever方法用于持久化存储数据到缓存，这些值必须通过forget方法手动从缓存中移除：
 * Cache::forever('key', 'value')       //永久存储并不是真的永久只不过其截止时间是比较大的值（到2286年）
 * 
 * 
 * 
 * 2、获取缓存数据
 * Cache门面的get方法用于从缓存中获取缓存项，如果缓存项不存在，返回null，如果
 * 需要的话你可以传递第二个参数到get方法指定缓存项不存在时返回的自定义默认值
 * $value = Cache::get('key');      //获取指定的key值
 * $value = Cache::get('key', 'default');           //获取指定的key值，如果不存在，则使用默认值
 * 
 * 可以传递一个匿名函数作为默认值，如果缓存项不存在的话闭包的结果会被返回，传递匿名函数
 * 允许你可以从数据库或其它外部服务获取默认值
 * $value = Cache::get('key', function(){
 *      return DB::table(...)->get();
 * });   
 * 
 * 检查缓存项是否存在
 * has 方法用于判断缓存项是否存在：
 * if(Cache::has('key')) {
 *      //
 * }
 * 
 * 3、删除缓存数据
 * 语法：
 * $value = Cache::pull('key')  从缓存中获取缓存项然后删除，如果缓存项不存在的话，返回null，
 * 一般设置一次性的存储的数据
 * 
 * Cache::forget('key')     使用forget方法从缓存中移除缓存项数据
 * Cache::flush('key')          清除所有缓存，并且删除对应的目录 
 * 
 * 
 * 4、缓存数值增加/减少
 * 
 * increment 和 decrement 方法可用于调整缓存中的整型数值。
 * 这两个方法都可以接收第二个参数来指明缓存项数值增加和减少的数目：一般会用作计数器
 * 
 * Cache::increment('key');
 * Cache::increment('key', $amount);
 * Cache::decrement('key');
 * Cache::decrement('key', $amount);
 * 
 * 
 * 例子：
 * Cache::add('count', '0', 1000);
 * Cache::increment('count');
 * 
 * 如果用计数器，则在初始化的时候不能使用put和forever，因为这2个方法都会重复的初始化计数器
 * 
 * 
 * 5、获取并存储
 * 有时候你可能想要获取缓存项，但如果请求的缓存项不存在时给它存储一个默认值。
 * 例如，你可能想要从缓存中获取所有用户，或者如果它们不存在的话，从数据库获取它们并将其添加到缓存中，
 * 你可以通过使用 Cache::remember 方法实现：
 * 
 * $value = Cache::remember('users', $seconds, function() {
 *     return DB::table('users')->get();
 * });
 * 
 * 如果缓存项不存在，传递给 remember 方法的闭包被执行并且将结果存放到缓存中。
 * 
 * 你还可以使用 rememberForever 方法从缓存中获取数据或者将其永久存储起来：
 * 
 * $value = Cache::rememberForever('users', function() {
 *     return DB::table('users')->get();
 * });
 * 
 * 
 */



/**
 * 
 * 联表查询
 * 内连接，左、右外连接，自然连接，交叉连接
 * 
 * 
 * 
 * 联表要求至少有2张表（除了自己连接自己，自联查询），并且还是存在关系的两张表
 * 
 * 左外连接
 * 
 * sql:
 * select t1.id,t1.article_name as article_name,t2.author_name as author_name from article as t1 left join author as t2 on t1.author_id = t2.id
 * 
 * 将上述的sql语句改成链式操作：
 * 语法：DB门面/模型->join联表方式名称（关联的表名，表1的字段，运算符，表2的字段）
 * 
 * $data = DB::table('article as t1')->leftJoin('author as t2', 't1.author_id', '=', 't2.id')->select('t1.id','t1.article_name as article_name','t2.author_name as author_name')->get();
 * 
 * 
 * 
 */


/**
 * 
 * 关联模型
 * 关联模型就是绑定模型（表）的关系（关联表），后续需要使用联表的时候就可以直接使用关联模型。注意，关联模型必须要创建模型
 * 
 * 1、一对一的关系
 * 
 * 例如：一篇文章只有一个作者
 * 
 * 关联模型的关联方法
 * 注意：在写关联模型的时候要分析出是谁关联谁（类似于联表查询的主、从表），谁做主动
 * 关联的模型？当前的案例是文章关联作者，需要关联代码写在主模型中（文章模型中）
 * 语法：
 * public function 被关联的模型名小写()
 * {
 *     return $this->hasOne('需要关联模型的命名间','被关联模型的关系字段','本模型的关系字段');
 * }
 * 
 * 例如：
 * 
 * <?php
 *     
 * namespace App\Models;
 *     
 * use Illuminate\Database\Eloquent\Model;
 *     
 * class User extends Model{
 *     
 *    //获取关联到用户的手机
 *     
 *     public function phone()
 *     {
 *         return $this->hasOne('App\Models\Phone');
 *         //return $this->hasOne('App\Phone', 'user_id', 'id');
 *     }
 * }
 * 
 * 关联关系定义好之后，我们可以通过访问动态属性phone来获取一条手机号信息
 * 动态属性名称就是先前定义的关联方法名称
 * 
 * $phone = User::find(1)->phone;
 * 
 * 使用一对一关联关系之后，其可以替代之前写join联表操作
 * 
 * 
 * 
 * 
 * 2、一对多关系
 * 例如：一篇文章有多个评论
 * 
 * 语法：
 * public function 被关联的模型名小写()
 * {
 *     return $this->hasMany('需要关联模型的命名间','被关联模型的关系字段','本模型的关系字段');
 * }
 * 
 * 
 * <?php
 *     
 * namespace App\Models;
 *     
 * use Illuminate\Database\Eloquent\Model;
 *     
 * class Post extends Model{
 *     
 *     获取博客文章的评论
 *     
 *     public function comments()
 *     {
 *          return $this->hasMany('App\Models\Comment');
 *     }
 * }
 * 
 * 
 * 3、多对多关系
 * 例如：一个文章可能有多个关键词，一个关键词可能被多个文章使用
 * 
 * 多对多关联比 hasOne 和 hasMany 关联关系要稍微复杂一些。
 * 这种关联关系的一个例子就是在权限管理中，一个用户可能有多个角色，同时一个角色可能被多个用户共用。
 * 例如，很多用户可能都有一个“Admin”角色。
 * 
 * 多对多的关系经过拆分之后就是两个一对多的关系。由于是双向一对多的关系，
 * 因此光靠2张表是无法建立的关系的，需要依靠第三张表建立关系
 * 
 * 要定义这样的关联关系，需要三张数据表：users、roles 和 role_user，role_user 表按照关联模型名的字母顺序命名，
 * 并且包含 user_id 和 role_id 两个列：
 * 
 * users
 *     id - integer
 *     name - string
 * 
 * roles
 *     id - integer
 *     name - string
 * 
 * role_user
 *     user_id - integer
 *     role_id - integer
 * 
 * 语法：
 * return $this->hasMany('被关联模型的元素空间路径', '多对多模型的关系表名','关系表中当前模型中的关系键','关系表中被关联模型的关系键');
 * 
 * 
 * <?php
 *     
 * namespace App\Models;
 *     
 * use Illuminate\Database\Eloquent\Model;
 *     
 * class User extends Model{
 *     
 *      //用户角色
 *     public function roles()
 *     {
 *         return $this->belongsToMany('App\Models\Role');
 *     }
 * }
 * 
 * 
 * 关联关系被定义之后，可以使用动态属性 roles 来访问用户的角色：
 * 
 * $user = App\Models\User::find(1);
 *     
 * foreach ($user->roles as $role) {
 *     //
 * }
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
















 
