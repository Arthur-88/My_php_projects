<?php
namespace Controllers;
use Models\User;
class RegisterController
{
	public static function index()
	{
		return 'Регистрация';
	}
	public function user($name,$role,$pass)
	{
            var_dump($name,$role,$pass);
		$user = (new User())->registerUser($name,$role,$pass);
                var_dump($user);
		return 'Пользователь '.$name.' зарегистрирован под id '.$user.', роль '.$role;
	}
	public function company()
	{
		return 'Регистрация компании';
	}
}
// public - можно получить доступ из любого контекста
//static - Для того, что бы можно было воспользоваться этим методом класса не создавая объект.