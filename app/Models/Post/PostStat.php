<?php

namespace App\Models\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'like',
        'resend'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
