<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


// 新規登録用のrooting
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('/', function () {
    return view('welcome');
});

// 認証用
// Route:group()は、ルーティングをグループ化して処理をまとめる。
// ['middleware' => 'auth']とすることでログイン認証を確認される。
Route::group(['middleware' => ['auth']], function() {
  Route::resource('users', 'UsersController', ['only' => ['show', 'index', 'edit', 'update']]);
});
