<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
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
