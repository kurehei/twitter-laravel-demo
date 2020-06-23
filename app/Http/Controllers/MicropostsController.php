<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;
use App\Micropost;

use Illuminate\Http\Request;


class MicropostsController extends Controller
{
    //
    public function index()
    {
        $data = [];

        if (\Auth::check()) {
            $user = \Auth::user();
            $microposts = $user->timeline_microposts()->take(10)->get();
            $data = [
                'user' => $user,
                'microposts' => $microposts
            ];
        }

        return view('welcome', $data);
    }

    public function store(Request $request)
    {
        // requestから、ユーザーを引っ張ってきた
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);

        return back();
    }

    public function edit($id)
    {
        $micropost = Micropost::find($id);
        return view('microposts.edit', [
            'micropost' => $micropost
        ]);
    }

    public function update(Request $request, $id)
    {
        $micropost = Micropost::find($id);
        $micropost->content = $request->input('content');

        if ($micropost->user->id === \Auth::id()) {
            $micropost->update();
        }

        return view('welcome');
    }


    public function destroy($id)
    {
        $micropost = Micropost::find($id);

        if ($micropost->user->id === \Auth::id()) {
            $micropost->delete();
        }

        return back();
    }
}
