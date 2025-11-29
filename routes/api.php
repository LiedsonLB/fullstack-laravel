<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;

Route::prefix('v1')->group(function () {
    Route::get('urls', [ShortUrlController::class, 'index']);
    Route::post('urls', [ShortUrlController::class, 'store']);
    Route::get('urls/{id}', [ShortUrlController::class, 'show']);
    Route::delete('urls/{id}', [ShortUrlController::class, 'destroy']);
});