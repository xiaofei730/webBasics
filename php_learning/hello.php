<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Hello</title>
	<style type="text/css">
		h1{
			background-color: #f4645f;
			color: #fff;
			padding: 1em;
			text-align: center;
		}
		a{
			background-color: black;
			color: white;
		}
	</style>
</head>
<body>
	<h1 id="h1"><?="你好，PHP！"?></h1>
	<ul>
		<li><a href="basic/var.php">PHP 变量与常量</a></li>
		<li><a href="basic/type.php">PHP 基本数据类型</a></li>
		<li><a href="basic/array.php">PHP 数组：索引数组与关联数组</a></li>
		<li><a href="basic/structure.php">PHP 控制结构</a></li>
		<li><a href="function/test.php">PHP 函数（上）：自定义函数和内置函数</a></li>
		<li><a href="function/closure.php">PHP 函数（下）：匿名函数和作用域</a></li>
	</ul>

	<ul>
		<li><a href="blog/index.php">博客首页</a></li>
		<li><a href="calculator/views/calculator.html">计算器</a></li>
	</ul>

	<ul>
		<li><a href="oop/class.php">PHP 类与对象、访问控制</a></li>
		<li><a href="oop/class.php">PHP 继承、封装与多态</a></li>
		<li><a href="oop/abstract.php">PHP 抽象类与接口（上）</a></li>
		<li><a href="oop/interface.php">PHP 抽象类与接口（下）</a></li>
		<li><a href="oop/compose.php">通过对象组合水平扩展 PHP 类功能</a></li>
		<li><a href="oop/trait.php">通过 Trait 水平扩展 PHP 类功能</a></li>
		<li><a href="oop/static.php">PHP 静态属性和静态方法</a></li>
		<li><a href="oop/serialize.php">PHP序列化</a></li>
		<li><a href="oop/magic.php">PHP魔术方法</a></li>
		<li><a href="oop/clone.php">PHP对象复制</a></li>
		<li><a href="oop/error.php">PHP 错误和异常处理（上）</a></li>
		<li><a href="oop/exception.php">PHP 错误和异常处理（下）</a></li>
	</ul>

	<ul>
		<li><a href='mysql/mysqli.php'>通过 PHP Mysqli 扩展与 MySQL 数据库交互</a></li>
	</ul>

	<ul>
		<li><a href='http/form.html'>PHP 用户请求数据获取与文件上传</a></li>
		<li><a href='http/cookie.php'>如何在 PHP 中使用和管理 Cookie</a></li>
		<li><a href='http/session.php'>在 PHP 中使用和管理 Session 并实现简单的用户登录功能</a></li>
	</ul>

	<ul>
		<li><a href='ns/App.php'>PHP 命名空间与类自动加载实现</a></li>
	</ul>
	
	<script>
		var h1Element = document.getElementById("h1")
		h1Element.onclick = function () {
		    alert("该页面由学院君通过 PHP + HTML 实现");
		}
	</script>
</body>
</html>