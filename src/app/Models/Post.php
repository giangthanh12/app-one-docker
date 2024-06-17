<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;

    public function getCachedCommentsCountAttribute() {
        return Cache::remember($this->cacheKey() . ':comments_count', 15, function() {
            return $this->comments->count();
        });
    }

    public function fetchAll() {
        $result = Cache::remember('blog_posts_cache', 60, function() {
            return $this->get();
        });
        return $result;
    }

    public function cacheKey()
    {
        return sprintf(
            "%s/%s-%s",
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
