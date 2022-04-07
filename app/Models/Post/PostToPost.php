<?php

namespace App\Models\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostToPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'to_post_id'
    ];

    public function toPost()
    {
        return $this->belongsTo(Post::class, 'to_post_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
