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
    
    Route::get('/{id}',[CategoryController::class, 'detail'] );
    Route::get('/', [CategoryController::class, 'listData']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::put('/', [CategoryController::class, 'update']);
    Route::delete('/{id?}',[CategoryController::class, 'delete'] );
    
});



