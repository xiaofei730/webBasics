<?php

$title = '锄禾';
$str = file_get_contents('./index.html');
$str = str_replace('{', '<?php echo', $str);        //替换左大括号
$str = str_replace('}', '?>', $str);            //替换右大括号
// echo $str;

file_put_contents('./index.html.php', $str);
require './index.html.php';


require './Smarty/Smarty.class.php';

$title = '锄禾';
$smarty = new Smarty();
$smarty->template_dir = './view/';  //更改模板目录
$smarty->templatec_dir = './viewc/';  //更改混编目录
$smarty->assign('title', $title);
$smarty->assign('name', 'tom');
$smarty->display('index.html');

/**
 * Smarty的引入
 * （1）为了分工合作，模板页面中最好不要出现PHP的代码
 * （2）要将表现和内容相分离
 * 
 * 自定义Smarty
 * 1、演化一：（smarty生成混编文件）
 * 在模板中不能出现PHP定界符，标准写法如下：
 * 1、html代码
 * 
 * $title = '锄禾';
 * $str = file_get_contents('./index.html');
 * $str = str_replace('{', '<?php echo', $str);        //替换左大括号
 * $str = str_replace('}', '?>', $str);            //替换右大括号
 * // echo $str;
 * 
 * file_put_contents('./index.html.php', $str);
 * require './index.html.php';
 * 
 * 
 * 2、演化二：（smarty（封装））
 * 由于每个页面要替换定界符，所以需要将替换定界符的代码封装起来
 * 由于封装中，所有访问的方法需要通过面向对象的方式来访问
 * {$title}
 * <?php echo $this->tpl_var['title']; ?>
 * 
 * 小结：
 * （1）需要将外部的变量赋值到对象的内部
 * （2）要通过面向对象的方式访问
 * 
 * 
 * 3、演化三：（有条件的生产混编文件）
 * 混编文件存在并且是最新的就直接包含，否则就重新生成
 * 模板文件修改时间<混编文件修改的时间 => 混编文件是最新的
 * 
 * 
 * 小结
 * 生成混编文件的条件
 * （1）混编不存在
 * （2）模板修改来，模版文件修改时间>混编文件修改时间，说明模板修改过了
 * 
 * 
 * 4、演化四：文件分类存放
 * 模板文件：templates
 * 混编文件：templates_c
 * Smarty文件：smarty
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


/**
 * 
 * 官方smarty
 * 
 * 1、需要掌握的smarty的属性和方法  
 * public $left_delimiter = "{";                            //左界定
 * public $right_delimiter = "}";                           //右界定
 * protected $template_dir = array('./templates/');         //默认模板目录
 * protected $complie_dir = './templates_c';                //默认混编目录
 * protected $config_dir = 'arrary('./configs/')';          //默认配置目录
 * protected $cache_dir = './cache/';                       //默认缓存目录
 * 
 * public function setTemplateDir(){}                       //设置模板文件夹
 * public function setConfigDir(){}                         //设置配置文件夹
 * public function setCompileDir(){}                        //设置混编文件夹
 * public function setCacheDir(){}                          //设置缓存文件夹
 * 
 * 
 * 2、smarty简单的操作
 * （1）将libs目录拷贝到站点下，改名为smarty
 * （2）创建模板目录templates
 * （3）创建混编目录templates_c
 * （4）在站点下创建1-demo.php
 * 
 * 
 * 3、注释
 * 语法：{* *}
 * 
 * 
 * 注意：smarty注释在源码中看不见
 * 
 * 思考：已知smarty的定界符是{*和*}那么它的注释是什么》
 * 答：{** **}
 * 
 * 
 */


/**
 * 
 * 变量
 * 
 * smarty中变量有3种，普通变量、配置变量、保留变量
 * 
 * 1、普通变量
 * 普通变量就是我们自己定义的变量
 * 方法一：在PHP种定义
 * 
 * $smarty->assign('name', 'tom');
 * 
 * 方法二：可以在模板定义
 * 语法：{assign var='变量名' value='值'}
 * 例如：{assign var='sex' value='男'}
 * 
 * 简化写法
 * {$sex='男'}
 * 
 * 
 * 2、保留变量
 * Smarty中有个特殊的保留变量（内置变量），类似于PHP中的所有的超全局变量、常量、时间等信息
 * 
 * 
 * 3、配置变量
 * 从配置文件中获取变量值，配置文件默认的文件是configs
 * （1）在站点下创建配置文件夹configs
 * （2）在configs目录下创建smarty.conf
 * 
 * 
 * 小结：
 * （1）要使用配置文件中的值，首先必须引入配置文件，通过{config_load}标签引入
 * （2）获取配置文件中的值的方法有两种
 * 第一：{#变量名#}
 * 第二：{$smarty.config.变量名}
 * 
 * 
 * 
 * 配置文件中的节
 * 
 * color=#FF0000
 * size=30px;
 * [spring]        #配置文件中的段落
 * color=#009900;  
 * size=20px;
 * [winter]
 * color=#000000;
 * size=5px;
 * 
 * （1）全局的一定要写在节的前面
 * （2）配置文件中[]表示节
 * （3）配置文件中的注释是#
 * 
 * 
 */


/**
 * 
 * 
 * 运算符                               描述
 * eq                              equal    相等
 * neq                          not equal   不等于
 * gt                           greater than    大于
 * lt                           less than       小于
 * lte                          less than or equal      小于等于
 * gte                          great than or equal     大于等于
 * is even                      是偶数
 * is odd                       是奇数
 * is not even                      不是偶数
 * is not odd                       不是奇数
 * not                          非
 * mod                          求模取余
 * div by                       被整除
 * is [not] div by              能否被某数整除，例如
 * is [not] even by             商的结果是否为偶数
 * is [not] odd by              商的结果是否为奇数
 * 
 * 
 * 
 */


/**
 * 
 * 判断
 * 语法：
 * {if 条件}
 * 
 * {elseif 条件}
 * 
 * {else}
 * 
 * {/if}
 * 
 * 
 * {if is_numeric($smarty.get.score)}
 *         {if $smarty.get.score gte 90}
 *         A
 *         {elseif $smarty.get.score gte 80}
 *         B
 *         {else}
 *         C
 *         {/if}
 *     {else}
 *         不是数字
 *     {/if}
 * 
 *     <hr>
 *     {if $smarty.get.score is even}
 *         是偶数
 *     {elseif $smarty.get.score is odd}
 *         是奇数
 *     {/if}
 * 
 * 
 * 
 * 
 */


/**
 * 
 * 数组
 * 
 * smarty中访问数组的方式有两种
 * 数组[下标]
 * 数组.下标
 * 
 * 学生：{$stu[0]}--{$stu.1}      <br>
 *     雇员：{$emp['name']} ---{$emp.sex}  <br>
 * 
 *     <ul>
 *         <li>{$goods[0]['name']}</li>
 *         <li>{$goods[0].price}</li>
 *         <li>{$goods.1['name']}</li>
 *         <li>{$goods.1.price}</li>
 *     </ul>
 * 
 * 
 * 
 * 
 */





/**
 * 
 * 循环
 * 
 * smarty中支持的循环有：{for}、{while}、{foreach}、{section}。对于开发来说用的最多就是{foreach}循环
 * 
 * 1、for
 * {for 初始值 to 结束值 step 步长}
 * 
 * {/for}
 * 
 *     {for $i=1 to 5}
 *         {$i}：锄禾日当午<br>
 *     {/for}
 *     <hr>
 *     {for $i=1 to 5 step 2}
 *         {$i}：锄禾日当午<br>
 *     {/for}
 * 
 * 
 * 2、while
 * {while 条件}
 * 
 * {/while}
 *    {$i=1}
 *    {while $i<=5}
 *        {$i++}：锄禾日当午<br>
 *    {/while}
 * 
 * 
 * 
 * 3、foreach
 * 
 * 语法：
 * {foreach 数组 as $k=$v}
 * 
 * {foreachelse}
 *  没有数组输出
 * {/foreach}
 * 
 * foreach的属性
 * @index:从0开始的索引
 * @iteration:从1开始的编号
 * @first:是否是第一个元素
 * @last:是否是最后一个元素
 * 
 * 
 * 4、section
 * section不支持关联数组，只能遍历索引数组
 * 
 * 语法：
 * {section name=自定义名字 loop=数组}
 * 
 * {/section}
 * 
 *  
 * 
 * 
 * 
 */



/**
 * 
 * 函数
 * 函数有两种，自定义函数和内置函数
 * smarty的内置函数就是封装的PHP的关键字
 * 
 * 
 */

/**
 * 变量修饰符
 * 1、变量修饰器
 * 变量修饰器的本质就是PHP函数，用来转换数据 
 * 
 * 注意：
 * （1）将PHP的关键字或函数封装成标签称为函数，将PHP关键字封装成smarty关键字称为修饰器，内部的本质都是PHP函数或PHP关键字
 * （2）｜称为管道运算符，将前面的参数传递给后面的修饰器使用
 * 
 * 2、自定义变量修饰器
 * 变量修饰器存放在plugins目录中
 * 规则：
 * （1）文件的命名规则：modifier.变量修饰器名称.php
 * （2）文件内方法命名规则：smarty_modifier_变量修饰器名称(形参..){}
 * 
 * <?php
 * function smarty_modifier_cal($num1, $num2, $num3)
 * {
 *     return $num1 + $num2 + $num3;
 * }
 * 
 * {10|cal:20:30}
 * 
 * 
 */



/**
 * 
 * 避免Smarty解析
 * 
 * smarty的定界符和css、js的大括号产生冲突的时候，css、js中的大括号不要被smarty解析
 * 
 * 方法一：更换定界符
 * 方法二：左大括号后面添加空白字符
 * 方法三：{literal}{/literal}
 * smarty不解析{literal}中的内容
 * 
 * 
 * 
 */


/**
 * 
 * 缓存
 * 缓存：页面缓存、空间缓存、数据缓存。smarty中的缓存就是页面缓存
 * 
 * 1、开启缓存
 * $smarty->caching=true|1;
 * 
 * 
 * 
 * 2、缓存的更新
 * 方法一：删除缓存，系统会重新生产新的缓存文件
 * 方法二：更新了模板文件，配置文件，缓存自动更新
 * 方法三：过了缓存的生命周期，默认是3600秒
 * 方法四：强制更新
 * 
 * 3、缓存的生命周期
 * $samrty->cache_lifetime = -1 | 0 |N
 * -1:永远不过期
 * 0：立即过期
 * N:有效期是N秒，默认是3600秒
 * 
 * 
 * 4、局部不缓存
 * 局部不缓存有两种方法
 * （1）变量不缓存      {$变量名 nocache}
 * （2）整个块不缓存        {nocache}  {/nocache}
 * 
 * 
 * 5、缓存分页
 * 通过$smarty->display(模板, 识别id)。通过识别id来缓存集合
 * 
 * $smarty->display('1-demo.html', $_GET['pageno']);       //缓存分页
 * 
 * 
 * 6、清除缓存
 * $samrty->clearCache(模板, [识别id])；
 * $samrty->clearAllCache()；       //清除所以缓存
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

































