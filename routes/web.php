<?php

Route::get('/', function() {
    return response()->redirectTo('home');
});

Route::get('/prize/random', "HomeController@getRandomPrize");
Route::get('/prizes/list', "PrizeController@index");
Route::get('/prizes/changeStatus', "PrizeController@changeStatus");
Route::get('/prizes/exchange', "PrizeController@exchange");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
