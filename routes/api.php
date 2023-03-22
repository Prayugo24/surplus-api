<?php

use Illuminate\Http\Request;
use App\Http\Controllers\api\v1\CategoryController;
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

Route::group(['prefix' => 'v1/categories', 'namespace' => 'V1'], function () use ($router){
    
    Route::post('/', [CategoryController::class, 'save']);
    Route::get('/', [CategoryController::class, 'List']);
    Route::get('/{id?}',[CategoryController::class, 'Detail'] );
    Route::put('/{id?}', [CategoryController::class, 'update']);
    Route::delete('/{id?}',[CategoryController::class, 'delete'] );
});