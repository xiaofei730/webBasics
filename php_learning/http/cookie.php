<?php

if (isset($_GET['action']) && $_GET['action'] == 'get_cookies') {
	$name = $_COOKIE['name'];
	$website = $_COOKIE['website'];
	printf('从用户请求中读取的 Cookie 数据：{name: %s, website: %s}', $name, $website);
	exit();
}


if (isset($_GET['action']) && $_GET['action'] == 'set_cookies') {
	$expires = time() + 3600 * 24;
	setcookie('name', '学院君', $expires);
	echo "更新 Cookie 成功";
	exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'del_cookies') {
	$expires = time() - 1;
	setcookie('website', '', $expires);
	echo "删除 Cookie：website";
	exit();
}

setcookie('name', '学院君');
$expires = time() + 3600;
setcookie('website','https://xueyuanjun.com', $expires);

header('Location: /http/cookie.php?action=del_cookies');
echo "设置 Cookie 成功";
?>