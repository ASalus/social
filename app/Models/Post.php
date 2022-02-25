<?php

namespace App\Models;

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
        'image'
    ];

    public function user(){
        return $this->BelongsTo(User::class);
    }

    public function role(){
        return $this->hasOne(Category::class);
    }
}
