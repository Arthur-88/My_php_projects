<?php
namespace Models;
use PDO;
class Model
{
    protected $config;	// Конфиг БД
    protected $mysql;	// Обьект соединения с БД при помощи PDO
    protected $table;	// Используемая таблица
    protected $attributes;

//	Загружает конфиг
//	Model constructor.
    public function __construct()
    {
        $this->config = [
            'HOST' => '127.0.0.1',
            'DATABASE' => 'app',
            'USER' => 'root',
            'PASSWORD' => '',
            'CHARSET' => 'utf8',
        ];
        $this->mysql = $this->mysql();
    }

//	Возвращает обьект PDO (соединение с бд)
    protected function mysql()
    {
        $host = $this->config['HOST'];
        $db   = $this->config['DATABASE'];
        $user = $this->config['USER'];
        $pass = $this->config['PASSWORD'];
        $charset = $this->config['CHARSET'];
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new PDO($dsn, $user, $pass, $opt);
    }

	//	Получаем одну строку данных по ID
    public function getById($id)
    {
        $stmt = $this->mysql->prepare('SELECT * FROM '. $this->table .' WHERE `id`=?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }
    public function authById($id,$pass)
	{
//        var_dump($id,$pass);
            $stmt = $this->mysql->prepare('SELECT * FROM '. $this->table .' WHERE id=:id AND Pass=:pass');
            $stmt->execute([':id'=>$id,':pass'=>$pass]);
//            var_dump($stmt->fetch());
            return $stmt->fetch();
	}
        
    public function registerUser($name,$role,$pass)
	{
        $stmt = $this->mysql->prepare('INSERT INTO '. $this->table .' (Name, Role, Pass) values (:name, :role, :pass)');
        $stmt->execute([':name'=>$name,':role'=>$role,':pass'=>$pass]);
        return $this->mysql->lastInsertId();
        }
       
/*        public static function all()
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
    */
}