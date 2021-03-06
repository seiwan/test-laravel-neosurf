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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Products
Route::prefix('products')->group(function() {
    Route::get('/', 'ProductsController@list');
    Route::get('{id}', 'ProductsController@get');
    Route::post('add', 'ProductsController@add');
    Route::put('edit/{id}', 'ProductsController@edit');
    Route::delete('remove/{id}', 'ProductsController@remove');
});
