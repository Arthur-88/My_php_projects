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
/*    public function __construct()
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
*/

    protected function DB_connect()
    {
        $this->config = [
            'HOST' => '127.0.0.1',
            'DATABASE' => 'app',
            'USER' => 'root',
            'PASSWORD' => '',
            'CHARSET' => 'utf8',
        ];
        $this->mysql = $this->mysql();
        $dsn = "mysql:host=$config[HOST];dbname=$config[DATABASE];charset=$config[CHARSET]";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $mysql = new PDO($dsn, $config[USER], $config[PASSWORD], $opt);
    }

	//	Получаем одну строку данных по ID
    public function getById($id)
    {
        $stmt = this->mysql->prepare('SELECT * FROM '. $this->table .' WHERE `id`=?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }
}