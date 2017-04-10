<?php
namespace Controllers;
use Models\User;
class UserController
{
	public function all()
	{
		$users = User::all();
		return 'Все пользователи. Количество пользователей: '. count($users);
	}
	
	public function getById($id)
	{
		$user = (new User())->getById($id);
//		var_dump($user);
		if($user) return 'User ID '. $user['id'] . ' is ' . $user['Name'];
		else
			return 'Пользователь c id '.$id.' не зарегистрирован';
	}
}
// Вызывает функцию 'getById' с параметром '1' класса Model
// Выводит на экран имя пользователя с параметрами $user
// Вызывает функцию 'getById' с параметром 'id' класса Model
// Вызывает функцию 'all' класса Model
//count - Посчитать количество элементов массива или количество свойств объекта