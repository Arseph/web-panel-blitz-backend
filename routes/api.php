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

Route::middleware('auth:sanctum')->group(function() { // Sanctum Middleware
    Route::prefix('v1')->group(function () { // Api v1

        Route::prefix('websites')->group(function () { // Websites resource
            Route::post('/get', 'App\Http\Controllers\WebsiteController@show');
            Route::get('/list', 'App\Http\Controllers\WebsiteController@list');
            Route::post('/', 'App\Http\Controllers\WebsiteController@store');
            Route::patch('/{id}', 'App\Http\Controllers\WebsiteController@update');
            Route::delete('/delete/{id}', 'App\Http\Controllers\WebsiteController@destroy');

            Route::prefix('{websiteId}/details ')->group(function() { // Details resource
                Route::post('/', 'App\Http\Controllers\WebsiteDetailController@store');
            });
        });

        Route::prefix('pages')->group(function() { // Pages resource
            Route::post('/get', 'App\Http\Controllers\WebsitePageController@show');
            Route::post('/', 'App\Http\Controllers\WebsitePageController@store');
            Route::post('/{id}', 'App\Http\Controllers\WebsitePageController@update');

            Route::prefix('{pageId}/headings')->group(function() { // Pages.headings resource
                Route::post('/', 'App\Http\Controllers\HeadingController@store');
            });

            Route::prefix('{pageId}/carousels')->group(function() { // Pages.carousels resource
                Route::post('/', 'App\Http\Controllers\CarouselController@store');
                Route::post('/{carouselId}', 'App\Http\Controllers\CarouselController@update');
            });
        });

        Route::prefix('users')->group(function() { // Users resource
            Route::get('/me', 'App\Http\Controllers\UserController@index');
            Route::patch('/me', 'App\Http\Controllers\UserController@update');
        });

        Route::prefix('images')->group(function() { // Images resource
            Route::get('/search', 'App\Http\Controllers\ImageController@search');
        });

        Route::prefix('fonts')->group(function() { // Fonts resource
            Route::post('/', 'App\Http\Controllers\FontController@store');
        });

    });
});
