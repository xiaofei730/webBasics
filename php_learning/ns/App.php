<?php

// namespace App;
include_once 'vendor/autoload.php';

use App\Test;
use App\Testing\Test as SubTest;

// spl_autoload_register(function ($className) {
// 	$path = explode('\\', $className);
// 	if ($path[0] == 'App') {
// 		$base = __DIR__;
// 	}

// 	$filename = $path[count($path) - 1] . '.php';
// 	$filepath = $base;
// 	foreach ($path as $key => $val) {
// 		if ($key == 0 || $key == count($path) - 1) {
// 			continue;
// 		}

// 		$filepath .= DIRECTORY_SEPARATOR . strtolower($val);
// 	}

// 	$filepath .= DIRECTORY_SEPARATOR . $filename;
// 	require_once $filepath;
// });

Test::print();
SubTest::print();

 ?>