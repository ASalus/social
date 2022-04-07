<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPostStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'liked',
        'resend'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }


    public function post()
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
