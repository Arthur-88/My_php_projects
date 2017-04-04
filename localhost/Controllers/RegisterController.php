<?php

namespace Controllers;

class RegisterController
{
    public static function index()
// public - можно получить доступ из любого контекста, static - Для того, что бы можно было воспользоваться этим методом класса не создавая объект.
    {
        return 'Регистрация';
    }
    public function user()
    {
        return 'Регистрация пользователя';
    }

    public function company()
    {
        return 'Регистрация компании';
    }
}