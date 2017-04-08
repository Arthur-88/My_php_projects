<?php
return array
(
    '/users' => array('UserController','all'),
	'/user/:num' => array('UserController','getById'),
    '/register' => array('RegisterController','index'),
    '/register/user/:text/:text/:text' => array('RegisterController','user'),
    '/register/company' => array('RegisterController','company'),
    '/auth/:num/:num' => array('AuthController','index'),
);