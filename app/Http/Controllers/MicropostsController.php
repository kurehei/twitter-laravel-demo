<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;

use Illuminate\Http\Request;


class MicropostsController extends Controller
{
    //
    public function index()
    {
        $data = [];

        if (\Auth::check()) {
            $user = \Auth::user();
            $microposts = $user->micropost()->take(10)->get();
            $data = [
                'user' => $user,
                'microposts' => $microposts
            ];
        }

        return view('welcome', $data);
    }

    public function store(Request $request) {
        $microposts= Auth::user()->microposts()->create();
    }
}
