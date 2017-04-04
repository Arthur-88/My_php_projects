<?php
$url = $_SERVER['REQUEST_URI'];
// возвращает относительный путь URL из адресной строки
$routes = require './routes.php';
// присваивает массив из routes.php переменной $routes
//$data;
$route = searchRoute($routes, $url);
// проверяет наличие перехваченного относительного пути URL в массиве $routes. Если URL есть, элемент массива передается в $route
if ($route)
{	$data = parseRoute($route);	
}
else
{	$URLParts = explode('/', $url);
	if($URLParts[1]='user')
	{	$route = $routes['/user'];
//		var_dump($URLParts);
		$data = parseRoute($route);
		$data['params'] = $URLParts[2];
	}
	else
	{	throw new Exception('Путь не найден!');
	}
}
// преобразует строку с адресом $route в массив $data с индексами 'class', 'method', 'params'
// var_dump($data); // проверка содержимого массива $data
var_dump($data);
echo '<br>';
echo call($data['class'], $data['method'], $data['params']);
// выводит на экран результат выполнения метода $data['method'] класса $data['class'] с параметрами $data['params'] из папки (namespace) 'Controllers\\'

/**
 * Ищет ссылку в массиве
 *
 * @param $routes
 * @param $url
 * @return mixed
 * @throws Exception
 */
function searchRoute($routes, $url)
{	// проверяет наличие перехваченного относительного пути URL в массиве $routes
    if (isset($routes[$url])) 
	{	$result = $routes[$url];
    }
	else 
	{	$result = false;
	}
return $result;
// Если перехваченный URL есть в массиве путей $routes, элемент массива передается в $route
}
/**
 * Разбирает путь на части
 *
 * @param $route
 * @return array
 */
function parseRoute($route)
{
    $routeParts = explode('/', $route);
// explode - делит текст в $route на подстроки с помощью разделителя '/' и возвращает массив из подстрок в $routeParts
	$data = array(
// присваивает элементы массива $routeParts массиву $data по одному с индексами 'class', 'method', 'params'
// array_shift() - извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент
        'class' => array_shift($routeParts),
        'method' => array_shift($routeParts),
        'params' => $routeParts
		);
// оставшиеся элементы массива записываются в $data['params'][]
    return $data;
}
/**
 * Вызывает метод в указанном классе с параметрами
 *
 * @param $className
 * @param $methodName
 * @param $params
 * @return mixed
 */
function call($className, $methodName, $params)
{	// Вызывает метод, указанный в $methodName класса, указанного в $className и передает массив $params в качестве параметров функции
// возвращает результат выполнения метода
	return call_user_func(['Controllers\\' . $className, $methodName], $params);
// call_user_func_array - Вызывает пользовательскую функцию с массивом параметров
}

function check_URL($url)
{	$URLParts = explode('/', $url);
}