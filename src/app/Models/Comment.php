<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['post'];
    /**
     * $touches property là một array chứa các associations mà nó
     * sẽ được cập nhật khi một comment được tạo ra, hoặc xóa đi.
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
