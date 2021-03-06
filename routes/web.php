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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::get('/threads', 'ThreadController@index')->name('threads.index');
Route::post('/threads', 'ThreadController@store')->name('threads.store');
Route::get('/threads/{channel}', 'ThreadController@index');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
Route::patch('/threads/{channel}/{thread}', 'ThreadController@update')->name('threads.show');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy');
Route::post('/threads/{channel}/{thread}/subscriptions', 'SubscriptionController@store');
//Route::post('/threads/{thread}/favourites');

Route::delete('/replies/{reply}', 'ReplyController@destroy');
Route::patch('/replies/{reply}', 'ReplyController@update');


// profile
Route::get('/profiles/{user}','ProfileController@show');

// For otp send test
Route::post('replies/{reply}/favourites','FavouriteController@store');
Route::get('/otp-show','OtpController@show');


