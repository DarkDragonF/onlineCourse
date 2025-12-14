<?php
//version 1.2.0 
class Database {

    private static $instance = null;
    public $conn;

    private function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "onlinecourse";

        try {
            $this->conn = new PDO("mysql:host=$servername; dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
?>
