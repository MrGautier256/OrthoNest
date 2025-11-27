<?php

use App\Http\Controllers\Api\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'app' => 'OrthoNest',
    ]);
});

Route::get('/items', [ItemController::class, 'index']);
