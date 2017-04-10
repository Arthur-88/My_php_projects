<?php
namespace Controllers;
use Models\User;
class AuthController
{
	public function index($id,$pass)
	{
//		var_dump($id,$pass);
                $user = (new User())->authById($id,$pass);
//                var_dump($user);
		if($user)
			return \View::render($user);
		else
			return 'Введены неверные данные';
	}
}