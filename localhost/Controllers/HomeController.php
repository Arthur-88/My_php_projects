<?php

namespace Controllers;

use Models\User;

class HomeController
{
    public function index()
    {
        $user = User::getById(1);
// Вызывает функцию 'getById' с параметром '1' класса Model
        return \View::render($user);
    }
}