<?php  

function getItemFromBook($book, $key)
{

	if (empty($book) || !key_exists($key, $book)) {
		throw new InvalidArgumentException("数组为空或者对应索引不存在！");
		
	}

	return $book[$key];
}

$book = [
	'title' => 'Laravel 精品课',
	'summary' => '彻底掌握 Laravel 和 Vue.js 框架，成为合格的 PHP 全栈工程师',
	'author' => '学院君',
	'price' => 99.0,
	'website' => 'https://xueyuanjun.com/books/master-laravel',
	'created_at' => '2020',
	'is_published' => false
];

// var_dump(getItemFromBook($book,'desc'));

$exit = false;
try {
	$val = getItemFromBook($book, 'desc');
} catch (InvalidArgumentException $exception) {
	echo $exception->getMessage();
	$exit = true;
	//可以通过 Exception 基类捕获（或者其他父级异常类），也就是说，此处也符合父子类型的转化逻辑：
}	catch (Exception $exception) {
	echo $exception->getMessage();
	$exit = true;
}   catch (OutOfBoundsException $exception) {
	echo $exception->getMessage();
	$exit = true;
	//但是如果不是 InvalidArgumentException 或者其父类，就不能捕获了：
}	catch (RuntimeException $exception) {
    echo $exception->getMessage();
    $exit = true;
    //可以通过添加 finally 语句块定义一个兜底逻辑：
}   finally {
	$exit ? exit() : var_dump($val);
}

// // var_dump($val);
// // 也可以在捕获到异常后不进行处理，直接抛出，交给上一层调用代码进行进一步处理：
// try {
//     $val = getItemFromBook([], null);
//     $val = getItemFromBook($book, 'desc');
// } catch (InvalidArgumentException $exception) {
//     throw $exception;
// } catch (OutOfBoundsException $exception) {
//     throw $exception;
// } finally {
//     var_dump($val);
// }

function myExceptionHandler(Exception $exception)
{
	echo 'Uncaught Exception ['.get_class($exception).']: '.$exception->getMessage().PHP_EOL;
	echo 'Thrown in '.$exception->getFile().' on line ' .$exception->getLine().PHP_EOL;
}

set_exception_handler('myExceptionHandler');

try {
    $val = getItemFromBook($book, 'desc');
} catch (InvalidArgumentException $exception) {
    throw $exception;
} catch (OutOfBoundsException $exception) {
    throw $exception;
} finally {
    if (isset($val)) {
        var_dump($val);
    } else {
        echo '异常将通过全局异常处理器处理...' . PHP_EOL;
    }
}

// / final 关键字，通过该关键字修饰的方法不能被子类重写，
// //final 还可以用于修饰类，通过 final 修饰的类将不能被子类继承。
// 我们也可以根据需要创建自定义的异常类，只需要继承自 Exception 基类或者其子类即可，比如我们为索引不存在定义一个独立的异常类，并且继承自 LogicException 父类
class IndexNotExistsException extends LogicException
{

}

try {
    $val = getItemFromBook($book, 'desc');
} catch (InvalidArgumentException $exception) {
    throw $exception;
} catch (IndexNotExistsException $exception) {
    throw $exception;
} finally {
    if (isset($val)) {
        var_dump($val);
    } else {
        echo '异常将通过全局异常处理器处理...' . PHP_EOL;
    }
}

?>