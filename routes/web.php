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

Route::get('/debugbar', function () {

    $data = ['foo' => 'bar'];
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';
});

// Pratice -- dynamically loads
Route::any('/practice/{n?}', 'PracticeController@index');


// Book
Route::get('/book/create', 'BookController@create');
Route::post('/book', 'BookController@store');

Route::get('/book', 'BookController@index');
Route::get('/book/{title}', 'BookController@show');

Route::get('/search/', 'BookController@search');


// Examples mirroring P3
Route::get('/trivia/', 'TriviaController@index');
Route::get('/trivia/check-answer', 'TriviaController@checkAnswer');


// Homepage
Route::get('/', 'WelcomeController');
