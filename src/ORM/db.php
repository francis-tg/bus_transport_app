<?php 
namespace Cisco\Shadow\ORM;
use Cisco\Shadow\flash\Messages;
use PDO;


class db {
    protected $pdo;
    public $message;
    const DB_NAME = "transport_db";
    const USERNAME = "root";
    const PWD = "";
    const HOST = "127.0.0.1";
    

    public function __construct() {
        try {
            $fconnect = new PDO('mysql:host=' . self::HOST . ';', self::USERNAME, self::PWD);
$result = $fconnect->query("SHOW DATABASES LIKE '" . self::DB_NAME . "'")->fetchAll();
if (count($result) == 0) {
    // Create the database if it does not exist
    $fconnect->exec("CREATE DATABASE " . self::DB_NAME);
}
$this->pdo = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME, self::USERNAME, self::PWD);

        } catch (\Throwable $th) {
            echo $th;
        }
        $this->message = new Messages();
    }
    function connect(){
        return $this->pdo = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME, self::USERNAME, self::PWD);

    }
}