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
});
