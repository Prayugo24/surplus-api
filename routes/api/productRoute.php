<?php

use App\Http\Controllers\api\v1\ProductController;


Route::group(['prefix' => 'v1/products', 'namespace' => 'V1'], function () use ($router){
    Route::get('/{id}',[ProductController::class, 'detail'] );
    Route::get('/', [ProductController::class, 'listData']);
    Route::post('/{id}', [ProductController::class, 'update']);
    Route::post('/', [ProductController::class, 'create']);

    Route::delete('/{id?}',[ProductController::class, 'delete'] );
    Route::any('{any}', function(){
        return response()->json([
            'status'    => false,
            'message'   => 'Page Not Found.',
        ], 404);
    })->where('any', '.*');

});
