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
    return Redirect::to('https://website.pagesnetwork.com');
});
Route::get('/images/update/{id}', 'App\Http\Controllers\WebsitePageController@update');
// Route::post('/fonts', 'App\Http\Controllers\FontController@store');

Route::post('auth/login', 'App\Http\Controllers\LoginController@authenticate')->name('login');
Route::post('auth/register', 'App\Http\Controllers\LoginController@register')->name('register');
Route::post('auth/logout', 'App\Http\Controllers\LoginController@logout');