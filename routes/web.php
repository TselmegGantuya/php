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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/admin', 'AdminController@index');
Route::get('/admin/{id}/view', 'AdminController@view');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/send', 'HomeController@newList');

Route::post('/newList', 'HomeController@newList');
Route::post('/listChange/{id}', 'HomeController@listChange');
Route::post('/newTask/{id}', 'HomeController@newTask');
Route::post('/taskChange/{id}', 'HomeController@taskChange');
Route::post('/deleteList/{id}', 'HomeController@listDelete');
Route::post('/deleteTask/{id}', 'HomeController@taskDelete');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
