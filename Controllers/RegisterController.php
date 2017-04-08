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
		$user = User::registerUser($name,$role,$pass);
		return 'Пользователь '.$name.' зарегистрирован под '.$user.', роль '.$role;
	}
	public function company()
	{
		return 'Регистрация компании';
	}
}
// public - можно получить доступ из любого контекста
//static - Для того, что бы можно было воспользоваться этим методом класса не создавая объект.