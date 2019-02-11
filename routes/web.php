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
Route::get('/backlog/activity', 'BackLogController@activity')->name('backlog.activity');
Route::post('/backlog/activity', 'BackLogController@report')->name('backlog.report');

Route::get('/tncn/index', 'TNCNController@index')->name('tncn');
Route::post('/tncn/index', 'TNCNController@post')->name('tncn.post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
