<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Micropost;
use App\Like;

class LikesController extends Controller
{
    //
    public function store(Request $request, $micropostId)
    {
        Like::create(
            $array = [
                'user_id' => \Auth::user()->id,
                'micropost_id' => $micropostId
            ]
        );
        // findOrfailはモデルが見つからないときに例外を投げる

        $post = Micropost::findOrfail($micropostId);
        // ここにリダイレクトのパス
        return back();
    }

    public function destroy($micropostId, $likeId)
    {
        $micropost = Micropost::findOrfail($micropostId);
        $micropost->like_by()->findOrfail($likeId)->delete();

        return back();
    }
}
