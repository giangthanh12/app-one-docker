<?php
namespace App\Helper;

use App\Helper\LoggerInterface;

class FileLogger implements LoggerInterface {
    private static $instanceCount = 0;

    public function __construct()
    {
        self::$instanceCount++;
    }

    public function log(string $message)
    {
        return $message;
    }

    public static function getInstanceCount()
    {
        return self::$instanceCount;
    }
}
