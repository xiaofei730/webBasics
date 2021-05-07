<?php  


try {
	$content = file_get_contents('https://xueyuanjun.com/error');
} catch (Error $error) {
	 var_dump($error);
}

var_dump($content);

//排除对 E_WARNING 级别的错误报告可以这么做
// error_reporting(E_ALL^E_WARNING);

// error_reporting(E_ALL); //报告所有错误（默认配置）
// 
set_error_handler("myErrorHandler");

$content = file_get_contents('https://xueyuanjun.com/error');
// echo $content;
var_dump($content);


function myErrorHandler($errno, $errstr, $errfile, $errline)
{
	// 该级别错误不报告的话退出
	if (!(error_reporting()&$errno)) {
		return;
	}

//在写入指定日志文件之前，先通过 PHP 文件系统函数 创建对应的日志目录（运行 PHP 脚本所在目录下创建 logs 子目录），生成的日志将存放在该目录下，然后在写入日志函数 error_log 中，第一个参数是错误消息，第二个参数是写入目标（3 表示指定文件，1 表示邮箱，0 表示系统日志），第三个参数即目标值，这里是自定义的日志文件
	$logDir = __DIR__.DIRECTORY_SEPARATOR.'logs';
	if (!file_exists($logDir)) {
		mkdir($logDir);
	}

	$logFile = $logDir.DIRECTORY_SEPARATOR.'err.log';

	switch ($errno) {
		case E_ERROR:
			{
				echo "致命错误类型: [$errno] $errstr\n";
				error_log("致命错误类型: [$errno] $errstr",3,$logFile);
			}
			break;
		case E_WARNING:
			{
				echo "警告错误类型: [$errno] $errstr\n";
				error_log("警告错误类型: [$errno] $errstr",3,$logFile);
			}
			break;
		case E_NOTICE:
			{
				echo "一般错误类型: [$errno] $errstr\n";
				error_log("一般错误类型: [$errno] $errstr",3,$logFile);
			}
			break;
		default:
			{
				echo "未知错误类型: [$errno] $errstr\n";
				error_log("未知错误类型: [$errno] $errstr",3,$logFile);
			}
			break;
	}


}

?>