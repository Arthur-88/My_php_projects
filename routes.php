<?php
return array(
    '/users' => 'UserController/all',
    '/user/1' => 'UserController/getById/1',
	'/user/2' => 'UserController/getById/1/3',	// для проверки садержимого массива $data в router.php
    '/register' => 'RegisterController/index',
    '/register/user' => 'RegisterController/user',
    '/register/company' => 'RegisterController/company',
    '/auth' => 'AuthController/index',
    '/' => 'HomeController/index',
);