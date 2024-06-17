<?php
namespace App\DB;

use PDO;
use PDOException;

class DatabaseConnection {
    private static $instance = null;
    private $connection;
    // Đặt constructor là private để ngăn chặn tạo instance từ bên ngoài
    private function __construct()
    {
        info("test1");
        try {
            $this->connection = new PDO("mysql:host=mysql_shared;dbname=db1", "root", "secret");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    // Phương thức để lấy instance duy nhất của lớp
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    // Phương thức để lấy kết nối cơ sở dữ liệu
    public function getConnection()
    {
        return $this->connection;
    }
}
