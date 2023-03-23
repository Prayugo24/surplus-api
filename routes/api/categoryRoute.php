<?php

use App\Http\Controllers\api\v1\CategoryController;

Route::group(['prefix' => 'v1/categories', 'namespace' => 'V1'], function () use ($router){
    Route::get('/{id}',[CategoryController::class, 'detail'] );
    Route::get('/', [CategoryController::class, 'listData']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::put('/', [CategoryController::class, 'update']);
    Route::delete('/{id?}',[CategoryController::class, 'delete'] );
    Route::any('{any}', function(){
        return response()->json([
            'status'    => false,
            'message'   => 'Page Not Found.',
        ], 404);
    })->where('any', '.*');

});
