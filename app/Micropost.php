<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Micropost extends Model
{
    protected $fillable = ["content", "user_id"];

    public function user()
    {
        //laravelでリレーションの設定mincopost->user()でmicropostに紐づくユーザの取得
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    // 良いねする人がログインしているユーザーかどうかをチェックする
    public function like_by()
    {
        return Like::where('user_id', \Auth::user()->id)->first();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
