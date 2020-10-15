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

Auth::routes(['register' => false]);



Route::group(['middleware' => ['role:admin|head', 'auth']], function () {
    Route::get('/users', 'HomeController@index')->name('users');
});

//Route::group(['middleware' => ['role:user', 'auth']], function () {
//    Route::get('/', function () { return redirect('')->route('worksheets'); });
//});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::resource('worksheets', 'WorksheetController');
});
