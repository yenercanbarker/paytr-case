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

Route::get('test', function () {
   \App\Models\User::create(['name' => 'a', 'email' => 'a@a.com', 'password' => bcrypt('12341234')]);
});

Route::middleware('auth:api')->get('test2', function () {
    return auth('api')->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
