<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;


class Like extends Model
{
    use CounterCache;
    // CounterCashの記述
    public $counterCacheOptions = [
        'Micropost' => [
            'field' => 'likes_count',
            'foreign_key' => 'micropost_id'
        ]
    ];
    // $fillableを付けないと関連テーブルのモデルにデータを入れられない。
    // 操作対象のモデルにfillableをつける　Eloquentモデルの設定上複数代入から守るため。
    // $guardは、複数代入を防ぐためのメソッド
    protected $fillable = ["micropost_id", "user_id"];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function micropost()
    {
        return $this->belongsTo(Micropost::class);
    }
}
