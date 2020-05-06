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

Route::post('login', 'RegisterController@login');
Route::post('register', 'RegisterController@register');
 
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'RegisterController@details');
 
    Route::resource('colis', 'ColisController');
});