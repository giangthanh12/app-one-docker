<?php

namespace App\Http\Controllers;

use App\Helper\FileLogger;
use App\Helper\LoggerInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $logger1;
    protected $logger2;

    public function __construct(FileLogger $logger1, FileLogger $logger2)
    {
        $this->logger1 = $logger1;
        $this->logger2 = $logger2;
    }

    public function index()
    {
        $logger1 = $this->logger1;
    }
}
