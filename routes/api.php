<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::resource('/books', 'BookController')->only([
//    'index', 'show', 'store', 'update', 'destroy'
//]);

Route::group(['prefix' => 'books'], function() {
    Route::get('/', 'BookController@index')->name('books');
    Route::get('/{book}', 'BookController@show')->name('books.show');
    Route::post('/', 'BookController@store')->name('books.store');
    Route::put('/{book}', 'BookController@update')->name('books.update');
    Route::delete('/{book}', 'BookController@destroy')->name('books.delete');
    Route::get('/search/{title}', 'BookController@search')->name('books.search');
    Route::get('/search-by-author/{id}', 'BookController@searchByAuthor')->name('books.searchByAuthor');
});

Route::group(['prefix' => 'authors'], function() {
    Route::get('/', 'AuthorController@index')->name('authors');
    Route::get('/{author}', 'AuthorController@show')->name('authors.show');
    Route::post('/', 'AuthorController@store')->name('authors.store');
    Route::put('/{author}', 'AuthorController@update')->name('authors.update');
    Route::delete('/{author}', 'AuthorController@destroy')->name('authors.delete');
});
