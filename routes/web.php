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

Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});


// Homepage
Route::get('/', 'WelcomeController');

// Book
Route::get('/book/', 'BookController@index');
Route::get('/book/{category}/{title}', 'BookController@show');

// Pratice -- dynamically loads
Route::any('/practice/{n?}', 'PracticeController@index');

// Examples mirroring P3
Route::get('/trivia/', 'TriviaController@index');
Route::get('/trivia/check-answer', 'TriviaController@checkAnswer');
