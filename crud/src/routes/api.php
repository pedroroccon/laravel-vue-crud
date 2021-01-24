<?php

/**
 * Define as rotas e os endpoints 
 * referentes a API.
 * 
 */
Route::prefix('api')->middleware('api')->group(function() {
    Route::apiResource('/produto', 'Crud\Http\Controllers\ProdutoController');
});