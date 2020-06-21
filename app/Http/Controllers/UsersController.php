<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function index()
  {
    // take(10)->get()で上位10件取得する
    $users = User::orderBy('id', 'desc')->take(10)->get();
    return view('users.index', [
      'users' => $users
    ]);
  }

  public function show($id)
  {
    $user = User::find($id);
    $microposts = $user->microposts()->take(10)->get();
    $data = [
      'user' => $user,
      'microposts' => $microposts
    ];
    // ここの$thisは、UsersController自身をさす。つまり、UsersControlerはConrtrollerを継承しているため、Controllerで定義されているcount$thisで呼び出すことが可能である。
    $data = $data + $this->count($user);
    return view('users.show', $data);
  }

  public function edit(User $user)
  {
    return view('users.edit', [
      'user' => $user
    ]);
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $user->name = $request->input('name');
    $user->update();
    return redirect('/');
  }
  // フォローの数の取得

  public function followings($id)
  {
    $user = User::find($id);
    $followings = $user->followings()->take(10)->get();

    $data = [
      'user' => $user,
      'users' => $followings
    ];

    $data += $this->count($user);
    return view('users.followings', $data);
  }
  // フォロワーの数の取得
  public function followers($id)
  {
    $user = User::find($id);
    $followers = $user->followers()->take(10)->get();
    $data = [
      'user' => $user,
      'users' => $followers
    ];
    $data += $this->count($user);
    return view('users.followers', $data);
  }
}
