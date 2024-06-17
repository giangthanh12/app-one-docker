<?php

namespace App\Http\Controllers;

use App\DB\DatabaseConnection;
use PDO;

class UserController extends Controller
{
    protected $dbConnection;
    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection->getConnection();
    }

    public function get()
    {
        // Sử dụng kết nối cơ sở dữ liệu để truy vấn dữ liệu
        $stmt = $this->dbConnection->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}
