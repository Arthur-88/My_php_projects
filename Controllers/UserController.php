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
        
        public function updateUser($id,$name,$role,$pass)
	{
		$user = (new User())->updateUser($id,$name,$role,$pass);
		var_dump($user);
		return 'Пользователь c id '.$id.' '.$user.' заменен на '.$name;       
	}
        
        public function deleteUser($id)
	{
		$user = (new User())->deleteUser($id);
		var_dump($user);
		return 'Пользователь c id '.$id.' '.$user.' удален';       
	}
}
// Вызывает функцию 'getById' с параметром '1' класса Model
// Выводит на экран имя пользователя с параметрами $user
// Вызывает функцию 'getById' с параметром 'id' класса Model
// Вызывает функцию 'all' класса Model
//count - Посчитать количество элементов массива или количество свойств объекта