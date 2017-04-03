<?php

namespace Models;


class Model
{
    // Указывает относительный путь к базе
    protected static $table;
// protected - разрешает доступ наследуемым и родительским классам
// static - значение переменной сохраняется после выполнения функции

    /**
     * Получаем все строки виде массива данных из базы
     *
     * @return array
     */
    public static function all()
// public - можно получить доступ из любого контекста
// static - Для того, что бы можно было воспользоваться этим методом класса не создавая объект
    {
        $file = fopen(static::getTable(), 'r');
// fopen - Открывает файл или URL
// 'r' - открывает файл только для чтения, помещает указатель в начало файла
        $rowCounter = 0;
        $data = array();
        while ($row = fgetcsv($file, null, ';'))	
// fgetcsv - Читает строку из файла и производит разбор данных CSV, возвращает FALSE в случае ошибки, а также по достижению конца файла
		{
            $rowCounter++;
            if ($rowCounter <= 1) continue;
            array_push($data, $row);
// array_push - Добавить один или несколько элеметов в конец массива
        }
        return $data;
    }

    /**
     * Получаем одну строку данных по ID
     *
     * @param $id
     * @return array
     */
    public static function getById($id)
    {
        $file = fopen(static::getTable(), 'r');
        $rowCounter = 0;
        while ($row = fgetcsv($file, null, ';')) {
            $rowCounter++;
            if ($rowCounter <= 1) continue;
            if ($row[0] == $id) return $row;
        }
    }

    /**
     * Добавляет префикс к пути
     *
     * @return string
     */
    public static function getTable()
// Возвращает путь к файлу таблицы
    {
        return 'Tables/' . static::$table;
    }

}