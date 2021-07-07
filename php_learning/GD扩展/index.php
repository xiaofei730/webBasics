<?php


/**
 * 
 * 1、开启GD扩展
 * GD库是用来处理图片的，使用GD库，首先在php.ini中开启gd扩展
 * 
 * extension=php_gd2.dll;
 * 开启以后就可以使用image开头的函数了
 * 
 * 2、创建最简单的图片
 * 步骤：
 * （1）创建画布
 * （2）给画布填充颜色（给画布分配的第一个颜色自动填充成背景色）
 * （3）显示图片
 * 
 * $img = imagecreate(200, 100) //创建图片
 * 
 * imagecolorallocate($img, 255, 0, 0)      //给图片分配第一个颜色，默认是背景颜色
 * 
 * header('content-type:image/jpeg');       //告知浏览器用jgp格式显示
 * 
 * imagejpeg($img);         //用jpg格式输出图片
 * 
 * imagejpeg($img, './tu.jpg');     //保存图片
 * 
 * 
 * 多学一招：
 * imagepng()    用png格式输出
 * imagegif()   用gif格式输出
 * 
 * 小结：
 * （1）第一个分配的颜色是背景色
 * （2）要在浏览器显示画布，需要设置header()头
 * （3）保存画布，不需要设置header()头
 * 
 * 
 * 3、填充颜色
 * 给图片分配的第一个颜色自动填充成背景色，如果要更换背景色需要手动的填充颜色
 * 
 * $img = imagecreate(200, 100);
 * 
 * $color = imagecolorallocate($img, 200, 200, 200);
 * 
 * switch(rand(1, 100)%3) {
 *      case 0:
 *          $color = imagecolorallocate($img, 255, 0, 0);       //颜色的索引编号
 *          break;
 *      case 1:
 *          $color = imagecolorallocate($img, 0, 255, 0);
 *          break;
 *      default:
 *          $color = imagecolorallocate($img, 0, 0, 255);
 * }
 * 
 * imagefill($img, 0, 0, $color);   //填充颜色
 * 
 * header('content-type:image/png');
 * 
 * imagepng($img);
 * 
 * 
 * 
 * 4、验证码
 * 验证码的作用：防止暴力破解
 * 
 * 
 * 
 * 
 * 
 * 原理
 * 创建一个图片，在图片上写上一串随机字符串
 * 实现步骤：
 * （1）生产随机字符串
 * （2）创建画布
 * （3）将字符串写到画布上
 * imagestring(图片资源,内置字体，起始点x，起始点y，字符串，颜色编号);
 * 
 * 难点：字符串居中
 * 
 * 第一步：创建随机字符串
 * $all_array = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));     //所有字符串数组
 * $div_array = ['1', 'l', '0', 'o', 'O', 'I'];      //出去容易混淆的字符
 * 
 * $array = array_diff($all_array, $div_array);         //剩余的字符数组
 * unset($all_array, $div_array);           //销毁不需要使用的数组
 * 
 * print_r($array);
 * 随机获取4个字符
 * $index = array_rand($array, 4);      //随机获取4个字符，返回字符下标，按先后顺序排列
 * shuffle($index);         //打乱字符
 * 
 * //通过下标拼接字符串
 * $code = '';
 * 
 * foreach($idne as $i) {
 *  $code.=$array[$i];
 * }
 * 
 * echo $code;
 * 
 * 第二步：创建画布
 * $img = imagecreate(150, 30);
 * imagecolorallocate($img, 255, 0, 0);     //分配背景色
 * $color = imagecolorallocate($img, 255, 255, 255);        //分配前景色
 * 
 * 第三步：将字符串写到画布上
 * $font = 5;       内置5号字体
 * $x = (imagesx($img) - imagefontwidth($font)*strlen($code)) / 2;         
 * $y = (imagesy($img) - imagefontheight($font)) / 2;
 * imagestring($ima, $font, $x, $y, $code, $color);
 * 
 * header('content-type:image/gif');
 * imagegif($img);
 * 
 * 
 * 5、打开图片创建验证码
 * 步骤：
 * （1）生产随机字符串
 * （2）打开图片
 * （3）将字符串写到图片上
 * 
 * //第一步：生产随机字符串
 * $charset = '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';
 * $code = '';
 * $max = strlen($codeSet);
 * for($i=1; $i<=4; $i++) {
 *  $index = rand(0, $max - 1);
 *  $code.=$codeset[$index];
 * 
 * }
 * echo $code;
 * 
 * 
 * //第二步：打开图片
 * $path = './captcha/captcha_bg'.rand(1, 5).'.jpg';
 * $img = imagecreatefromjpeg($path);
 * 
 * 第三步：将字符串写到画布上
 * $font = 5;       内置5号字体
 * $x = (imagesx($img) - imagefontwidth($font)*strlen($code)) / 2;         
 * $y = (imagesy($img) - imagefontheight($font)) / 2;
 * $color = imagecolorallocate($img, 255, 0, 0);
 * imagestring($ima, $font, $x, $y, $code, $color);
 * 
 * header('content-type:image/gif');
 * imagegif($img); 
 * 
 * 
 * 6、中文验证
 * 
 * （1）中文验证需要引入字体文件，内置字体不支持中文
 * （2）使用imagettftext(图片资源, 角度, 起始x左边, 起始y坐标, 颜色, 字体文件地址, 字符串)写入中文
 * （3）字体保存在c:\windows\Fonts 目录下
 * （4）用imagettfbox()测定中文字符串的高度
 * 
 * 
 * 步骤
 * （1）生成随机字符串
 * （2）创建画布
 * （4）将字符串写到画布
 * 
 * $codeSet = '我䃽心于死来说羊补牢经而能褟庆幸自己没在那敲响实公共警钟底应该何做系乎寥成为话题密问其木起质疑鼚涌出赔偿阳从左到臂中段基本废掉甯全事关每个生命绝不允许万危险皺什么屡发吃故背后都有政府监管部门产者保养维护和所失职人祸原因民网亲带着孩溲卷碯躡目睹这幕如此悲情面估计无数潸然泪下终止竟孤偶让陷表淋漓投资贪婪览遗见缝插针机想他考虑社利益牛弹琴大势文章称组织稽查执法力量集抛售票线索速及皌啬服推卸责兆历统谁望看蚄谓定忮改眺㕅䤟轻描淡写追甚负躺顶格惩罚期操汻怂王两天国股暴跌步把市脆弱性
 * 熟造月日上午湖北荆州安良百货商场内一名岁的女子被搅入手扶电梯身亡据广西梧视台报道位多小朋友太赚钱减敢地惹火烧三未合约主结算即沪深持增加张但仍例近萎缩比少沒恐慌沽現象并它移括香港新坡华富貨当核同声明队根退可户恶空分析指变化跑海或谋工具星疾呼过仅街老鼠喊打使证高调处金融交易仓限許卖单临规透缺却再也回才是最痛眰方运行既存就需要意识对拥否已尽了义务确正常转宣传尤进紧急制动样按钮播时候修些之众则件将会头尾答果任层现纰漏至重洞导致剧次以长鸣们注领域施与另外奏更毺郉平论家庭还学校给灌输各种救皋措办演练包含消防等容只够记像吝庥懂得示昌敪诌提前告知顾客通较初份达涉总值元宠模吗年热炒作显著升傍晚点美超亿由且开始聚早嗜血放屠刀立佛晃取衍润几用极灾难况招拆狠宝马奥拓展拳脚击败攻举解预决强获纷逃直崩盘清楚'
 * 
 * $code = '';
 * 
 * 因为每个汉子占三个字节，所以分割的时候每三个分割一次
 * $strdb = str_split($codeset, 3);
 * var_dump($strdb);
 * 
 * for($i = 0; $i < 4; $i++) {
 *  $fontcolor=imagecolorallocate($image, rand(0,120), rand(0,120), rand(0, 120));
 *  $index = rand(0, count($strdb));
 *  $cn = $strdb[$index];
 *  $captch_code.=$cn;
 *  imagettftext($image, mt_rand(20, 24), mt_rand(-60, 60), (40*$i+20), mt_rand(30, 35), $fontcolor, $fontface, $cn);
 * }
 * 
 * 
 *  
 * 方法二：开启多字节处理模式
 * $max = mb_strlen($codeSet);
 * for($i = 0; $i < 4; $i++) {
 *      $start = rand(0, $max);
 *      $code.=mb_substr($codeSet, $start, 1);
 * 
 * }
 * 
 * echo mb_substr($codeSet, 0, 1);
 * 
 * //创建画布
 * $img = imagecreate(150, 140);
 * imagecolorallocate($img, 255, 0, 0);
 * 
 * 第三步：将字符串写到画布上
 * $color = imagecolorallocate($img, 255, 255, 255);
 * $size = 25.5;            //字号
 * $angle = 30;             //角度
 * $fontfile = 'Arial Unicode.ttf';
 * 
 * $info = imagettfbbox($size, $angle, $fontfile, $code);
 * 
 * $code_w = $info[4] - $info[6];
 * $code_h = $info[1] - $info[7];
 * 
 * 
 * $x = (imagesx($img)-$code_w)/2;
 * $y = (imagesy($img)+$code_h)/2;
 * imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $captch_code);           //将文字写到画布上
 * 
 * 
 * 
 * header('content-type:image/jpeg');
 * imagejpeg($img); 
 * 
 * 
 * 
 * 小结：
 * （1）中文处理需要使用多字节处理
 * （2）使用多字节处理函数需要开启相应的扩展
 *      extension = php_mbstring.dll;
 * （3）使用imagettfbbox测定中文字符串的范围
 * （4）使用imagettftext将中文写到画布上
 * 
 * 
 * 
 * 
 * 7、水印
 * 
 * 文字水印
 * （1）在图片上添加文字或图片，目的：宣传，防止盗图
 * （2）水印有文字水印和图片水印
 * （3）文字水印实现原理和中文验证码一样的
 * 
 * 步骤
 * （1）打开图片
 * （2）将文字写到图片上
 * （3）输出图片（另存图片）
 * 
 * 第一步：打开图片
 * $img = imagecreatefromjpeg("./face.jpg");
 * $color = imagecolorallocate($img, 255, 255, 255);
 * $size = 25.5;            //字号
 * $angle = 30;             //角度
 * $fontfile = 'Arial Unicode.ttf';
 * $captch_code = "小飞哥";
 * 
 * $info = imagettfbbox($size, $angle, $fontfile, $captch_code);
 * 
 * $code_w = $info[4] - $info[6];
 * $code_h = $info[1] - $info[7];
 * 
 * 
 * $x = (imagesx($img)-$code_w)/2;
 * $y = (imagesy($img)+$code_h)/2;
 * imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $captch_code);  
 * 
 * header('content-type:image/jpeg');
 * imagejpeg($img); 
 * 
 * 
 * 8、图片水印
 * 原理：将水印图片拷贝复制到目标图片上
 * 步骤：
 * （1）打开原图
 * $src_img = imagecreatefromjpeg("./water.jpg");
 * 
 * （2）打开目标图
 * $dst_img = imagecreatefromjpeg("./face.jpg");
 * 
 * （3）复制原图拷贝到目标图上
 * $dst_x = imagesx($dst_img) - imagesx($src_img);
 * $dst_y = imagesy($dst_img) - imagesy($src_img);
 * $src_w = imagesx($src_img);
 * $src_h = imagesy($src_img);
 * imagecopy($dst_img, $src_img, $dst_X, $dst_y, 0, 0, $src_w, $src_h);
 * 
 * header('content-type:image/jpeg');
 * imagejpeg($img); 
 * 
 * 
 * 
 * 9、缩略图
 * 上传图片后，将图片变成统一大小的缩略图
 * 原理：将原图复制拷贝到目标图上，并缩放大小
 * 
 * 步骤：
 * （1）创建目标图
 * $dst_img = imagecreatetruecolor(200, 200);
 * 
 * （2）打开原图
 * $src_img = imagecreatefromjpeg("./face.jpg");
 * 
 * 
 * （3）复制原图，拷贝到目标图上
 * $src_w = imagesx($src_img);
 * $src_h = imagesy($src_img);
 * imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, 200, 200, $src_w, $src_h);
 * 
 * header('content-type:image/jpeg');
 * imagejpeg($img, './face1/jpg'); 
 * 
 * 
 * 10、验证码改错
 * 验证码错误不会具体的错误信息
 * 
 * （1）注释header，错误信息就出来了
 * 
 * 
 * （2）如果没有报错，就留心一下图片代码签有无字符串输出，图片前面是不允许有任何字符串输出
 * 
 * （3）查看源码，图片代码前是否有空白字符
 * 
 * （4）如果上面三点无效，在header前面ob_clean();
 * 
 * 
 * 
 * 
 * 注意：在IE在会存在缓存问题，需要在连接后面添加一个随机数，Math.random()
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


