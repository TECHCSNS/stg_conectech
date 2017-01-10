<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/redis',function(){
   $redis = app()->make('redis');
   $view = $redis->incr('views');
   return "The redis value " . $redis->get('hi') . " has " . $view;//Redisの確認
});

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('profile/edit','ProfileController@edit');
Route::get('profile/create','ProfileController@create');
Route::get('profile/{username}','ProfileController@show');
Route::resource('profile', 'ProfileController');
Route::post('/tweet','TweetController@store');

Route::get('blog','ArticleController@index');
Route::get('/article/{username}', 'ArticleController@showList');
Route::get('/article/detail/{id}', 'ArticleController@showDetail');
Route::post('/article', 'ArticleController@store');
Route::post('/article/comment', 'ArticleController@commentStore');
Route::match(['put','patch'],'/article/{id}', 'ArticleController@update');
Route::delete('/article/{id}', 'ArticleController@destroy');
Route::delete('/article/comment/{id}', 'ArticleController@commentDestroy');

Route::get('/home', 'ProfileController@testImg');

Route::get('/timeline', 'HomeController@timeline');
