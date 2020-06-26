<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // CounterCashの記述
    public $counterCacheOptions = [
        'Post' => [
            'fields' => 'likes_count',
            'foreign_key' => 'post_id'
        ]
    ];
    //
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}
