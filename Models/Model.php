<?php

namespace Models;


class Model
{
    // Указывает относительный путь к базе
    protected static $table;
// protected - разрешает доступ наследуемым и родительским классам
// static - значение переменной сохраняется после выполнения функции

    // Получаем все строки виде массива данных из базы
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
// fgetcsv - Читает строку из файла и производит разбор данных CSV, возвращает FALSE в случае ошибки, а также по достижению конца файла. NULL - максимальная длина строки не ограничена
// ! fgetcsv ситывает построчно! и переходит к следующей строке
		{
//			echo "\n".'$rowCounter = ';
//			var_dump($rowCounter);
//			echo "\n".'$row = ';
//			var_dump($row);
			$rowCounter++;
			if ($rowCounter <= 1) continue;
// Добавляет в массив $data новые строки из таблицы. 1-я строка пропускается		
			array_push($data, $row);
// array_push - Добавить один или несколько элеметов в конец массива
//			echo "\n".'$data = ';
//			var_dump($data);
//			echo "\n--- NEW LINE ---\n\n";
        }

        return $data;
    }

// Получаем одну строку данных по ID
    public static function getById($id)
    {
        $file = fopen(static::getTable(), 'r');
        $rowCounter = 0;
        while ($row = fgetcsv($file, null, ';'))
		{
//			var_dump($row);
            $rowCounter++;
            if ($rowCounter <= 1) continue;
            if ($row[0] == $id) return $row;
        }
    }

// Добавляет префикс к пути
    public static function getTable()
// Возвращает путь к файлу таблицы
    {
        return 'Tables/' . static::$table;
    }

}