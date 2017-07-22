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

Route::group(['prefix' => 'photo', 'middleware' => 'auth'], function() {
    Route::get('index', 'PhotoController@index')->name('photo.index');
    Route::get('create', 'PhotoController@create')->name('photo.create');
    Route::post('store', 'PhotoController@store')->name('photo.store');
    Route::get('edit/{id}', 'PhotoController@edit')->name('photo.edit');
    Route::post('update/{id}', 'PhotoController@update')->name('photo.update');
    Route::get('delete/{id}', 'PhotoController@delete')->name('photo.delete');
});
