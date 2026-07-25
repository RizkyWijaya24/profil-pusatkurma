<?php

use App\Http\Controllers\Api\ProfileApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Web Profile API Routes
|--------------------------------------------------------------------------
|
| Direct access endpoints for fetching web profile, product catalog,
| testimonials, and all-in-one store data across external websites.
|
*/

Route::get('/profile', [ProfileApiController::class, 'profile'])->name('api.profile');
Route::get('/products', [ProfileApiController::class, 'products'])->name('api.products');
Route::get('/testimonials', [ProfileApiController::class, 'testimonials'])->name('api.testimonials');
Route::get('/all', [ProfileApiController::class, 'all'])->name('api.all');

// OPTIONS fallback for CORS preflight requests
Route::options('/{any}', function () {
    return response('', 204, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With',
    ]);
})->where('any', '.*');
