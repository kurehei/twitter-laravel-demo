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
                'post_id' => $micropostId
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
        $micropost->lile_by()->findOrfail($likeId)->delete();

        return back();
    }
}
