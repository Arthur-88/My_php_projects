<?php

$url = $_SERVER['REQUEST_URI'];

$routes = include'./routes.php';

$data = parseRoute($url, $routes);

echo call($data['class'], $data['method'], $data['params']);

function parseRoute($url, $routes)
{
	if(isset($routes[$url])) 
	{
		$data = array
		(
			'class' => $routes[$url][0],
			'method' => $routes[$url][1],
			'params' => array_slice(parseURL($url),3)
		);
	}
	else
	{
		$data = searchByPattern($url, $routes);
	}
	return $data;
}

function parseURL($url)
{
	$URLparts = explode('/', $url);
	return $URLparts;
}

function searchByPattern($url, $routes)
{
	foreach ($routes as $key => $value)
	{
		$pattern = str_replace(':num', '([\d]+)', $key);
		$pattern = str_replace(':text', '([\w]+)', $pattern);
		if (preg_match('{^'. $pattern .'$}', $url, $matches))
		{
//			array_shift($matches);
			$data = array
			(
				'class' => $routes[$key][0],
				'method' => $routes[$key][1],
				'params' => array_slice(parseURL($url),3)
//				'params' => $matches,
			);
			return $data;
		}
	}
	throw new Exception('Путь не найден!');
}

function call($className, $methodName, $paramsArray)
{
//	var_dump($paramsArray);
	return call_user_func_array(['Controllers\\' . $className, $methodName], $paramsArray);
}