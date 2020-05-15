<?php

use Illuminate\Support\Facades\Route;


Auth::routes();
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser');
});
Route::get('/', 'ArticleController@index')->name('articles.index'); 
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::post('/{name}', 'UserController@store')->name('store');//顔写真
    Route::get('/{name}/edit', 'ProfielController@index')->name('edit');//プロフィール
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});
Route::get('/{name}/message', 'MessageController@index')->name('message');
Route::post('/{name}/message', 'MessageController@send')->name('message.send');
Route::get('/{name}/message_list', 'MessageController@list_index')->name('message_list');
Route::post('/article/comment', 'CommentController@create');
Route::post('/profiel_edit/{name}', 'ProfielController@store');
Route::post('/{name}/edit', 'ProfielController@index');
Route::get('/background', 'ProfielController@background_index')->name('background');
Route::delete('/background_destroy', 'ProfielController@destroy')->name('background_destroy');
Route::get('/background_edit', 'ProfielController@background_edit')->name('background_edit');
Route::post('/background_update', 'ProfielController@update')->name('background_update');
Route::post('/newbackground', 'ProfielController@create')->name('create');
