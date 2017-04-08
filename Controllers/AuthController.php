<?php
namespace Controllers;
use Models\User;
class AuthController
{
	public function index($id,$pass)
	{
//		var_dump($id,$pass);
		$user = User::authById($id,$pass);
		if($user)
			return \View::render($user);
		else
			return 'Введены неверные данные';
	}
}