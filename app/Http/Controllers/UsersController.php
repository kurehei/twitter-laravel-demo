<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index() {
       // take(10)->get()で上位10件取得する
       $users = User::orderBy('id', 'desc')->take(10)->get();

       return view('users.index',[
         'users' => $users
       ]);
    }
}
