<?php
namespace Models;
use PDO;
class Model
{
    protected $pdo=mysql();
//  protected $table;

    public static function mysql()
    {
	$param =array(
            'host' => '127.0.0.1',
            'db' => 'app',
            'USER' => 'root',
            'user' => '',
            'charset' => 'utf8',
            );

        $dsn = "mysql:host=$param[host];dbname=$param[db];charset=$param[charset]";
	$opt = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];
		$pdo = new PDO($dsn, $param[user], $param[pass], $opt);
                return $pdo;
    }
	
	public static function all()
	{
/*		$file = fopen(static::getTable(), 'r');
		$rowCounter = 0;
		$data = array();
		while ($row = fgetcsv($file, null, ';'))	
		{
			$rowCounter++;
			if ($rowCounter <= 1) continue;
			array_push($data, $row);
		}
		return $data;*/
	}
	public static function getById($id)
	{
		$stmt = $this->$pdo->prepare('SELECT Name FROM'. static::$table .'WHERE id = ?');
		$stmt->execute(array($id));
		return $stmt->fetchColumn(2);
	}
	
	public static function getTable()
	{
		return 'Tables/' . static::$table;
	}
	
	public static function authById($id,$pass)
	{
		$file = fopen('Tables/'.static::$table, 'r');
		$rowCounter = 0;
		while ($row = fgetcsv($file, null, ';'))
		{
			$rowCounter++;
			if ($rowCounter <= 1) continue;
			if (($row[0] == $id)&&($row[3] == $pass))
			{
				return $row;
			}
		}
		return false;
		fclose($file);
	}
	
	public static function registerUser($name,$role,$pass)
	{
		$file = fopen('Tables/'.static::$table, 'a+');
		$rowCounter = 1;
		while ($row = fgetcsv($file, null, ';'))
			$rowCounter++;
		$newUser[] = $rowCounter;
		$newUser[] = $name;
		$newUser[] = $role;
		$newUser[] = $pass;
		$write = fwrite($file,"\n");
		$write = fputcsv($file,$newUser,';');
		if($write) return $rowCounter;
		else return false;
		fclose($file);
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