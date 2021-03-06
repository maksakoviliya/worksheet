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
Route::get('/test', function (){
    $worksheet = \App\Worksheet::with('filial')->find(6);
    $users = \App\User::all();
    $filials = \App\Filial::all();
   return view('mails.worksheet', compact(['worksheet', 'users', 'filials']));
});

Auth::routes(['register' => false]);



Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('banks', 'HomeController@banks')->name('banks.index');
});

Route::group(['middleware' => ['role:admin|head', 'auth']], function () {
    Route::get('/users', 'HomeController@index')->name('users');
});

//Route::group(['middleware' => ['role:user', 'auth']], function () {
//    Route::get('/', function () { return redirect('')->route('worksheets'); });
//});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('worksheets', 'HomeController@worksheets')->name('worksheets.index');
    Route::get('worksheets/{worksheet}', 'HomeController@worksheet')->name('worksheets.show')->where('worksheet', '[0-9]+')->middleware('CanViewWorksheet');
    Route::get('worksheets/create', 'HomeController@createWorksheet')->name('worksheets.create');

    Route::get('voidable/create', 'HomeController@createVoidable')->name('voidable.create');
//    Route::resource('worksheets', 'WorksheetController')->only('index', 'show');
});
