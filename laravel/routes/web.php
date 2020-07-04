<?php

use Illuminate\Support\Facades\Route;

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


//Route::get('books', 'BookController@index')->name('books');
//Route::get('books/create', 'BookController@create')->name('books.create');
//Route::get('books/edit/{book}', 'BookController@edit')->name('books.edit')->middleware('auth');
//Route::post('books/add', 'BookController@add')->name('books.add');
//Route::post('books/save/{id}', 'BookController@save')->name('books.save');
//Route::get('books/delete/{id}', 'BookController@delete')->name('books.delete');

//Route::group(['prefix' => 'books', 'middleware' => 'ololo'], function(){
//    Route::get('/', 'BookController@index')->name('books');
//    Route::get('create', 'BookController@create')->name('books.create');
//    Route::get('edit/{book}', 'BookController@edit')->name('books.edit');
//    Route::post('add', 'BookController@add')->name('books.add');
//    Route::post('save/{id}', 'BookController@save')->name('books.save');
//    Route::get('delete/{id}', 'BookController@delete')->name('books.delete');
//});

Route::group(['prefix' => 'books', 'middleware' => 'auth'], function () {
    Route::get('/', 'BookController@index')->name('books');
    Route::get('create', 'BookController@create')->name('books.create');
    Route::get('edit/{book}', 'BookController@edit')->name('books.edit');
    Route::post('add', 'BookController@add')->name('books.add');
    Route::post('save/{id}', 'BookController@save')->name('books.save');
    Route::get('delete/{id}', 'BookController@delete')->name('books.delete');
});