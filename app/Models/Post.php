<?php

namespace App\Models;

use App\Models\Post\PostStat;
use App\Models\Post\PostToPost;
use App\Models\Post\UserPostStat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'full_text',
        'image',
        'video',
        'mentions',
        'tags',
        'to_post'
    ];

    public function user(){
        return $this->BelongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function stats()
    {
        return $this->hasOne(PostStat::class);
    }

    public function userPostStat()
    {
        return $this->hasMany(UserPostStat::class, 'post_id', 'id');
    }


    /*
        Return post,to which post was made
    */
    public function toPost()
    {
        return $this->hasOne(PostToPost::class, 'post_id', 'id');
    }

    /*
        Return all posts to a post
    */
    public function postsToPost()
    {
        return $this->hasMany(PostToPost::class, 'to_post_id', 'id');
    }

}
