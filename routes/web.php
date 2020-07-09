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

Route::get('/', 'MicropostsController@index');

// 認証用
// Route:group()は、ルーティングをグループ化して処理をまとめる。
// ['middleware' => 'auth']とすることでログイン認証を確認される。
Route::group(['middleware' => ['auth']], function () {
  // Route::resource('controller名','コントローラ', ['only' => ['show', 'destroy', ex...]])
  Route::resource('users', 'UsersController', ['only' => ['show', 'index', 'edit', 'update']]);
  // ユーザーのidをURLのパラメーターに含ませることができる
  Route::group(['prefix' => 'users/{id}'], function () {
    Route::post('follow', 'UserFollowController@store')->name('users.follow');
    Route::delete('unfollow', 'UserFollowController@destroy')->name('users.unfollow');
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
  });
  Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy', 'edit', 'update', 'show']]);

  // 良いね機能のルーティング
  Route::post('microposts/{micropost}/likes', 'LikesController@store')->name('likes.store');
  Route::delete('/posts/{post}/likes/{like}', 'LikesController@destroy')->name('likes.destroy');

  ## コメント機能のルーティング
  Route::post('microposts/{micropost}/comments', 'CommentsController@store')->name('comments.store');
  Route::delete('microposts/{micropost}/comments', 'CommentsController@store')->name('comments.delete');
});
