<?php 
namespace Cisco\Shadow\ORM;
use PDO;
class db {
    protected $pdo;
    const DB_NAME = "transport_db";
    const USERNAME = "root";
    const PWD = "cyberlyne";
    const HOST = "localhost";
    public function __construct() {
        $fconnect = new PDO('mysql:host='.self::HOST.';', self::USERNAME, self::PWD);
        $result = $fconnect->query("SHOW DATABASES LIKE '".self::DB_NAME."'")->fetchAll();
        if (count($result) == 0) {
        // Create the database if it does not exist
        $fconnect->exec("CREATE DATABASE ".self::DB_NAME);
        }
        $this->pdo = new PDO('mysql:host='.self::HOST.';dbname='.self::DB_NAME, self::USERNAME, self::PWD);
    }
    function connect(){
        return $this->pdo = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME, self::USERNAME, self::PWD);

    }
}