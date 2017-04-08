<?php
namespace Models;
class Model
{
	protected static $table;
	public static function all()
	{
		$file = fopen(static::getTable(), 'r');
		$rowCounter = 0;
		$data = array();
		while ($row = fgetcsv($file, null, ';'))	
		{
			$rowCounter++;
			if ($rowCounter <= 1) continue;
			array_push($data, $row);
		}
		return $data;
	}
	public static function getById($id)
	{
		$file = fopen(static::getTable(), 'r');
		$rowCounter = 0;
		while ($row = fgetcsv($file, null, ';'))
		{
			$rowCounter++;
			if ($rowCounter <= 1) continue;
			if ($row[0] == $id) return $row;
		}
		return false;
	}
	
	public static function getTable()
	{
		return 'Tables/' . static::$table;
	}
}
// Указывает относительный путь к базе
// protected - разрешает доступ наследуемым и родительским классам
// static - значение переменной сохраняется после выполнения функции
// Получаем все строки виде массива данных из базы
// public - можно получить доступ из любого контекста
// static - Для того, что бы можно было воспользоваться этим методом класса не создавая объект
// fopen - Открывает файл или URL
// static:: - обращение к вызывющему классу
// 'r' - открывает файл только для чтения, помещает указатель в начало файла
// fgetcsv - Читает строку из файла и производит разбор данных CSV, возвращает FALSE в случае ошибки, а также по достижению конца файла. NULL - максимальная длина строки не ограничена
// ! fgetcsv ситывает построчно! и переходит к следующей строке
// Добавляет в массив $data новые строки из таблицы. 1-я строка пропускается		
// Получаем одну строку данных по ID
// array_push - Добавить один или несколько элеметов в конец массива
// Добавляет префикс к пути
// Возвращает путь к файлу таблицы
