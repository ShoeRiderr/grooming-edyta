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
        'only' => ['index', 'store']
    ]);

    Route::resource('physiotherapy', \App\Http\Controllers\Json\PhysiotherapyController::class, [
        'except' => ['edit', 'show']
    ]);

    Route::resource('grooming', \App\Http\Controllers\Json\GroomingController::class, [
        'except' => ['edit', 'show']
    ]);

    Route::resource('dog-hotel', \App\Http\Controllers\Json\DogHotelController::class, [
        'except' => ['edit', 'show']
    ]);

    Route::get('about-company/edit', '\App\Http\Controllers\Json\AboutCompanyController@edit');
    Route::put('about-company', '\App\Http\Controllers\Json\AboutCompanyController@update');
});

Route::get('grooming-image/{groomingImage}', '\App\Http\Controllers\Json\GroomingImageController@show');

Route::get('physiotherapy/{physiotherapy}', '\App\Http\Controllers\Json\PhysiotherapyController@show');

Route::get('grooming/{grooming}', '\App\Http\Controllers\Json\GroomingController@show');

Route::get('dog-hotel/{dogHotel}', '\App\Http\Controllers\Json\DogHotelController@show');

Route::get('about-company', '\App\Http\Controllers\Json\AboutCompanyController@show');


