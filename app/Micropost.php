<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ["content", "user_id"];

    public function user()
    {
        //laravelでリレーションの設定mincopost->user()でmicropostに紐づくユーザの取得
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
    //
}
