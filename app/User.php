<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // 書き換えたい値を保護する
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function microposts()
    {
        // リレーションの設定userに紐付くmicropostを取得できる。user->micropost()で取得出来る。
        return $this->hasMany(Micropost::class);
    }
    // 中間テーブル多対多 belongsToMany()を使う。第一引数モデル、第二引数には中間テーブル、第三引数には中間テーブルの自分のID、第４テーブルには関係先のID
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }

    public function follow($userId)
    {
        // followしているかどうかのチェック
        $followCheck = $this->is_following($userId);
        // フォローしている人が自分かどうかのチェック
        $its_me = $this->id == $userId;

        if ($followCheck || $its_me) {
            return false;
        } else {
            // attach()は中間テーブル保存用のメソッド
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        $followCheck = $this->is_following($userId);
        // フォローしている人が自分かどうかのチェック
        $its_me = $this->id == $userId;

        if ($followCheck && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    // whereで、follow_idにすでに、idが存在しているかどうかのチェック
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    public function timeline_microposts()
    {
        // フォローしているユーザーのIDを抜き出してきて表示している
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        // micropostのユーザーIDの中で、フォローしているIDだけぬき出す。
        // whrereINは、第一引数に指定からむ、第二引数に抜き出したい条件
        return Micropost::whereIn('user_id', $follow_user_ids);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
