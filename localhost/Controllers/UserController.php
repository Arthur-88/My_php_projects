<?php

namespace Controllers;

use Models\User;

class UserController
{
    public function all()
    {
        $users = User::all();
// Вызывает функцию 'all' класса Model
        return 'Все пользователи. Количество пользователей: '. count($users);
//count - Посчитать количество элементов массива или количество свойств объекта
    }

    public function getById($id)
    {
        $user = User::getById($id);
// Вызывает функцию 'getById' с параметром 'id' класса Model
        return 'Пользователь c ID '. $user[0] . ' ' . $user[1];
    }
}