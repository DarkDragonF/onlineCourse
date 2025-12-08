<?php

class Database {

    private static $host = "localhost";
    private static $dbname = "onlinecourse";
    private static $username = "root";
    private static $password = "";

    private static $connection = null;

    // Hàm kết nối PDO
    public static function connect()
    {
        if (self::$connection === null) {
            try {

                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4";

                self::$connection = new PDO($dsn, self::$username, self::$password);

                // Chế độ báo lỗi
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Trả về dạng associative array
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                die("❌ Kết nối thất bại: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    // Ngắt kết nối (không bắt buộc)
    public static function disconnect()
    {
        self::$connection = null;
    }
}
?>
