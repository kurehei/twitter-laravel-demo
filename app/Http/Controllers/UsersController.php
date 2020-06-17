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
    return view('users.show', [
      'user' => $user
    ]);
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
}
