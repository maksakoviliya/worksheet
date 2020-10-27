<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/banks', 'BankController@index')->name('banks.index');
});

Route::middleware(['auth:sanctum', 'can:manage users'])->group(function() {
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::get('/user/permissions', function (Request $request) {
        if (Auth()->user()->can('manage users')) {
            echo 'can';
        } else {
            echo 'cannot';
            echo Auth()->user()->getPermissionsViaRoles();
        }
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', 'UsersController');
    Route::get('users-data', 'UsersController@getUsersData');
    Route::apiResource('worksheets', 'WorksheetController');
    Route::post('/banks/upload', 'BankController@upload');
    Route::apiResource('banks', 'BankController')->only(['destroy', 'upload']);
});
