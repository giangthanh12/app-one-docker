<?php

namespace App\Http\Controllers;

use App\DB\DatabaseConnection;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use PDO;

class PostController extends Controller
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function get()
    {
        DB::connection()->enableQueryLog();
        $posts = $this->post->fetchAll();
        $log = DB::getQueryLog();
        return $posts;
    }
}
