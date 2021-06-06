<?php
/**
 * 文件夹操作
 * 1、创建目录
 */
// mkdir('./aa');   创建aa目录
// mkdir('./aa/bb');  //在aa目录下创建bb（aa目录必须存在）
mkdir('./aa/bb/cc/dd', 0777, true); //递归创建  0777表示文件夹的权限 true表示递归创建，默认false


//2、删除文件夹
rmdir('./aa/bb/cc/dd');   //删除dd文件夹 删除的文件夹必须是空的，PHP基于安全考虑，没有提供递归删除

//3、重命名文件夹 rename(旧名字, 新名字)
rename('./aa', './aaa');

//4、是否是文件夹
echo is_dir('./aa') ? '是文件夹' : '不是文件夹';

//5、打开文件夹、读取文件夹、关闭文件夹
$folder = opendir('./');  //打开目录
var_dump($folder);   //资源类型数据
// echo readdir($folder),'<br>';
while ($f = readdir($folder)) {
    // echo  $f,'<br>';
    if($f == '.' || $f == '..')  //每个文件夹都有.和..
        continue;
    echo  iconv('gbk', 'utf-8', $f),'<br>';
}

closedir($folder);

//文件操作
//1、将字符串写入文件
$str = "床前明月光，\r\n疑似地上霜。\r\n举头望明月，\r\n低头思故乡。";
file_put_contents('./test.text', $str);   
/**
 * 所有的“写操作”都是清空重写
 * 在文本中换行是\r\n
 * \r: 回车 光标移动到当前行的最前面
 * \n:换行  将光标下移动一行
 */

 //将整个文件读入一个字符串中
 echo file_get_contents('./test.text');

readfile('./test.text'); //读取输出文件内容

//打开文件并操作
//fopen(地址, 模式);
//模式：
//r:读    w：写      a：追加
$fp = fopen('./test.text', 'w');   //打开文件返回文件指针（文件地址）
var_dump($fp);
for ($i=0; $i < 10; $i++) { 
    fputs($fp, '关关雉鸠'.'\r\n');  //写入文件
}
fclose($fp);    //关闭文件

$fp2 = fopen('./test.text', 'r');  //打开文件读取
while ($line = fgets($fp2)){
    echo $line,'<br>';
}

$fp3 = fopen('./test.text', 'q');  //打开文件追加
fputs($fp3, '在河之洲'.'\r\n');    //在文件末尾追加

echo is_file('./test.text') ? '是文件' :'不是文件';

echo file_exists('./test.text') ? '文件（夹）存在' :'文件（夹）不存在';

//6、输出文件
$path = './test.text';
if (file_exists($path)) {
    
    if (is_dir($path)) {
        rmdir($path);
    } elseif (is_file($path)) {
        unlink($path);
    }
}


///二进制读取（fread(文件指针，文件大小)）
//文件的存储有两种：字符流和二进制流
//二进制流的按读取文件大小来读的

$path = './face.jpg';
$fp = fopen($path, 'r');
header('content-type:image/jpeg');    //告知浏览器下面的代码通过jpg图片方式解析
echo fread($fp, filesize($path));   //二进制读取

header('content-type:image/jpeg');
echo file_get_contents('./face.jpg');   //file_get_contents也可读取二进制流

//文件上传
//客户端上传文件
//文件域
// <input type="file" name="image">

/**
 * 表单的enctype属性
 * 默认情况下，表单传递的是字符流，不能传递二进制刘，通过设置表单的enctype属性传递复合数据
 * enctype属性的值有：
 * 1、application/x-www-form-urlencoded:[默认]，表示传递的是带格式的文本数据
 * 2、mutipart/form-data：复合的表单数据（字符串，文件），文件上传必须设置此值
 * 3、text/plain ：用于向服务器传递无格式的文本数据，主要用于电子邮件
 */

 //与文件上传有关的配置
//  post_max_size = 8M; 表单允许的最大值
//upload_max_filesize = 2M;  允许上传的文件大小
//upload_tmp_dir = "F:\wamp\tmp" ;  指定临时文件地址
//file_uploads = on: 是否允许文件上传
//max_file_uploads = 20; 允许同时上传20个文件

/**
 * 优化文件上传
 * 1、更改文件名
 */
$path = 'face.stu.jpg';
//strrchr($path, '.') 从最后一个点开始截取，一直截取到最后
echo time().rand(100, 999).strrchr($path, '.');

//方法二
echo uniqid().strrchr($path, '.'),'<br>';     //生产唯一的ID
echo uniqid('goods_').strrchr($path, '.'),'<br>';     //带有前缀
echo uniqid('goods_', true).strrchr($path, '.'),'<br>';  //唯一ID + 随机数


/**
 * 验证文件格式
 * 方法一：判断文件的扩展名（不能识别文件伪装）
 */
if(!empty($_POST)) {
    $allow = array('.jpg', '.png', '.gif');  //允许的扩展名
    $ext = strrchr($_FILES['face']['name'], '.'); //上传文件扩展名
    if (in_array($ext, $allow)) {
        echo '允许文件上传';
    } else {
        echo '不允许文件上传';
    }
}


//方法二：判断mime类型（不能识别文件伪装）
if(!empty($_POST)) {
    $allow = array('image/jpeg', 'image/png', 'image/git');  //允许的扩展名
    $mime = $_FILES['face']['type']; //上传文件扩展名
    if (in_array($mime, $allow)) {
        echo '允许文件上传';
    } else {
        echo '不允许文件上传';
    }
}

//方法三：php_fileinfo扩展（可以防止文件伪装）
//在php.ini中开启fileinfo扩展
//extension = php_fileinfo.dll
if (!empty($_POST)) {
    //第一步：创建finfo资源
    $info = finfo_open(FILEINFO_MIME_TYPE);
    var_dump($info);
    //第二步：将finfo资源和文件比较
    $mime = finfo_file($info, $_FILES['face']['tmp_name']);
    $allow = array('image/jpeg', 'image/png', 'image/git');  //允许的扩展名
    if (in_array($mime, $allow)) {
        echo '允许文件上传';
    } else {
        echo '不允许文件上传';
    }
}
























