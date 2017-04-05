<?php

namespace Controllers;

use Models\User;

class HomeController
{
    public function index()
    {
// Вызывает функцию 'getById' с параметром '1' класса Model
        $user = User::getById(1);
// Выводит на экран имя пользователя с параметрами $user
        return \View::render($user);
    }
}