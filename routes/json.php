<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return UserResource::make($request->user());
});
Route::group(['prefix' => 'admin'], function () {
    Route::resource('user', \App\Http\Controllers\Json\Admin\UserController::class, [
        'only' => ['update']
    ]);

    Route::resource('grooming-image', \App\Http\Controllers\Json\GroomingImageController::class, [
        'only' => ['index', 'show', 'store']
    ]);

    Route::resource('physiotherapy', \App\Http\Controllers\Json\PhysiotherapyController::class, [
        'except' => ['edit']
    ]);

    Route::resource('grooming', \App\Http\Controllers\Json\GroomingController::class, [
        'except' => ['edit']
    ]);
});

