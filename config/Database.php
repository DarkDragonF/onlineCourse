<?php
// config/Database.php
class Database {
    private static $instance = null;
    public $conn;

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=onlinecourse;charset=utf8", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối DB: " . $e->getMessage());
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