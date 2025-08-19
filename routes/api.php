<?php

use App\Http\Api\User\Controller\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::name('api.')->group(function() {
        Route::apiResource('users', UserApiController::class);
    });
}); 