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

/*Route::get('/', function () {
    return view('welcome');
});
*/

//Route::view('/','welcome');

Route::get('/', 'WelcomeController');
Route::get('/book/', 'BookController@index');
Route::get('/book/{category}/{title}', 'BookController@show');

//Route::get('/example', 'BookController@example');

Route::get('/trivia/', 'TriviaController@index');
Route::get('/trivia/check-answer', 'TriviaController@checkAnswer');
