<?php
require_once '../config.php'; 

class Database {
    private $host;
    private $user;
    private $password;
    private $dbname;

    public function __construct() {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        $this->dbname = DB_NAME;
    }

    public function getConnection() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        try {
            $connection = new PDO($dsn, $this->user, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
}
?>