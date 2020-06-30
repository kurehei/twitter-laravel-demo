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
    // $fillableを付けないと関連テーブルのモデルにデータを入れられない。
    // 操作対象のモデルにfillableをつける　Eloquentモデルの設定上複数代入から守るため。
    protected $fillable = ["micropost_id", "user_id"];
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
