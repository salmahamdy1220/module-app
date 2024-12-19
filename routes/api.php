<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperAdmin\SuberAccessTokenController;


Route::prefix('v1')->group(function () {

    Route::post('/super-login', [SuberAccessTokenController::class, 'store']);

});
