<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    private $id;
    public function get( $id )
    {
        $this->id = $id;
        $storage = Redis::connection();

        if($storage->zScore('articleViews', 'article:' . $this->id)) {
            $storage->pipeline(function($pipe) {
                $pipe->zIncrBy('articleViews', 1, 'article:' . $this->id);
                $pipe->incr('article:' . $this->id . ':views');
            });
        } else {
            $views = $storage->incr('article:' . $this->id . ':views');
            $storage->zIncrBy('articleViews', 1, 'article:' . $this->id);
        }

        $views = $storage->get('article:' . $this->id . ':views');
        return 'id:'. '' . $id .' - views:'. $views;
    }

    public function index() {
        $popular = Redis::zRevRange('articleViews', 0, -1);
        foreach($popular as $value) {
            $id = str_replace('article:', '', $value);
            echo "Article " . $id . " is popular" . "<br>";
        }
    }
}
